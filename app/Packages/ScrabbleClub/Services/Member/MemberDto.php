<?php

namespace Scrabble\Services\Member;

use Illuminate\Support\Collection;
use Scrabble\Models\Member\Member;
use Illuminate\Contracts\Support\Arrayable;
use Scrabble\Services\Contact\ContactDto;

/**
 * Class MemberDto
 * @package Scrabble\Services\Member
 *
 * @property string $name
 * @property string $surname
 * @property string $joinedIn
 * @property Collection|ContactDto[] $contacts
 */
class MemberDto implements Arrayable
{
    public function __construct(
        public string $name,
        public string $surname,
        public string $joinedIn,
        public ?Collection $contacts
    ) {
    }

    public function toArray() : array
    {
        return [
            Member::NAME => $this->name,
            Member::SURNAME => $this->surname,
            Member::JOINED_IN => $this->joinedIn,
            Member::CONTACTS => $this->contacts,
        ];
    }
}
