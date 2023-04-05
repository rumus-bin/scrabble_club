<?php

namespace Scrabble\Services\Member;

use Scrabble\Models\Member\Member;
use Illuminate\Contracts\Support\Arrayable;

class MemberDto implements Arrayable
{
    public function __construct(
        public string $name,
        public string $surname,
        public string $joinedIn,
    ) {
    }

    public function toArray() : array
    {
        return [
            Member::NAME => $this->name,
            Member::SURNAME => $this->surname,
            'joined_in' => $this->joinedIn,
        ];
    }
}
