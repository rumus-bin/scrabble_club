<?php

namespace Scrabble\Models\Filters\Member;

use App\Core\Database\QueryModifierInterface;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\DB;

class MemberProfileQueryFilter implements QueryModifierInterface
{
    private int $memberId;
    public function setMemberId(int $memberId): void
    {
        $this->memberId = $memberId;
    }

    public function modify(Builder $builder): void
    {
        $builder->select(
            'members.name',
            'members.surname',
            'members.joined_in',
            'members.id',
            DB::raw('CONCAT(members.name, " ", members.surname) AS full_name'),
            DB::raw('COUNT(*) as games_played'),
            DB::raw('AVG(CASE WHEN games.first_player_id = members.id THEN games.first_player_score ELSE games.second_player_score END) as avg_score'),
            DB::raw('SUM(CASE WHEN games.first_player_id = members.id AND games.first_player_score > games.second_player_score THEN 1 WHEN games.second_player_id = members.id AND games.second_player_score > games.first_player_score THEN 1 ELSE 0 END) as games_won'),
            DB::raw('SUM(CASE WHEN games.first_player_id = members.id AND games.first_player_score < games.second_player_score THEN 1 WHEN games.second_player_id = members.id AND games.second_player_score < games.first_player_score THEN 1 ELSE 0 END) as games_lost')
        )
            ->where('members.id', $this->memberId)
            ->leftJoin('games', function ($join) {
            $join->on('members.id', '=', 'games.first_player_id')
                ->orOn('members.id', '=', 'games.second_player_id');
        })
            ->groupBy(['members.name', 'members.surname', 'members.joined_in', 'members.id']);
    }
}
