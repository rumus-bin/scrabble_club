<?php

namespace Scrabble\Models\Filters\Member;

use Illuminate\Database\Eloquent\Builder;

class MemberQueryModifire implements \App\Core\Database\QueryModifierInterface
{
    private ?int $memberId = null;

    public function setMemberId(int $memberId): void
    {
        $this->memberId = $memberId;
    }

    public function modify(Builder $builder): void
    {
        $builder->when($this->memberId, static function (Builder $query, int $memberId) {
            $query->where('members.id', $memberId);
        });
    }
}
