<?php

namespace Scrabble\Models\Filters\Dashboard;

use App\Core\Database\QueryModifierInterface;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\DB;

class HighestLowestScoreModifier implements QueryModifierInterface
{
    public const DEFAULT_LIMIT = 10;

    private ?int $limit = null;

    public function setLimit(?int $limit = self::DEFAULT_LIMIT): void
    {
        $this->limit = $limit;
    }

    public function modify(Builder $builder)
    {
        $builder->select(
            DB::raw(
                'CASE WHEN g.first_player_score > g.second_player_score THEN g.first_player_score ELSE g.second_player_score END AS highest_score'
            ),
            DB::raw(
                'CASE WHEN g.first_player_score < g.second_player_score THEN g.first_player_score ELSE g.second_player_score END AS lowest_score'
            ),
            DB::raw('CONCAT(m1.name, " vs ", m2.name) AS match_up'),
            DB::raw('CASE WHEN g.first_player_score > g.second_player_score THEN m1.name ELSE m2.name END AS highest_scorer'),
            DB::raw('CASE WHEN g.first_player_score < g.second_player_score THEN m1.name ELSE m2.name END AS lowest_scorer'),
            DB::raw('g.date')
        )
            ->from('games AS g')
            ->join('members AS m1', 'g.first_player_id', '=', 'm1.id')
            ->join('members AS m2', 'g.second_player_id', '=', 'm2.id')
            ->groupBy(['g.id'])
            ->orderBy('highest_score', 'DESC')
            ->orderBy('lowest_score', 'ASC')
            ->limit($this->limit)
        ;


    }
}
