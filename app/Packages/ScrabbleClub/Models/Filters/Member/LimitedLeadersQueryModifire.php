<?php

namespace Scrabble\Models\Filters\Member;

use App\Core\Database\QueryModifierInterface;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\DB;
use Scrabble\Models\Game;
use Scrabble\Models\Member\Member;

class LimitedLeadersQueryModifire implements QueryModifierInterface
{
    public const DEFAULT_LIMIT = 10;
    private ?int $limit = null;

    public function setLimit(?int $limit = self::DEFAULT_LIMIT): void
    {
        $this->limit = $limit;
    }

    public function modify(Builder $builder)
    {
        $builder->when($this->limit, static function (Builder $query, int $limit) {
            $query->select(
                Member::column(Member::ID),
                Member::column(Member::NAME),
                Member::column(Member::SURNAME),
                DB::raw(
                    sprintf(
                        'ROUND( AVG(CASE WHEN %s = %s THEN %s ELSE %s END), 0) AS avg_score',
                        Game::column(Game::FIRST_PLAYER_ID),
                        Member::column(Member::ID),
                        Game::column(Game::FIRST_PLAYER_SCORE),
                        Game::column(Game::SECOND_PLAYER_SCORE)
                    )
                ),
                DB::raw('COUNT(*) AS games_count')
            )
                ->join(Game::TABLE_NAME, function($join) {
                    $join->on(Member::column(Member::ID), Game::column(Game::FIRST_PLAYER_ID))
                        ->orOn(Member::column(Member::ID), Game::column(Game::SECOND_PLAYER_ID));
                })
                ->whereNotNull(Game::column(Game::FIRST_PLAYER_SCORE))
                ->whereNotNull(Game::column(Game::SECOND_PLAYER_SCORE))
                ->groupBy(Member::column(Member::ID), Member::column(Member::NAME))
                ->havingRaw('COUNT(*) >= 10')
                ->orderByDesc('avg_score')
                ->limit($limit);
        });
    }
}
