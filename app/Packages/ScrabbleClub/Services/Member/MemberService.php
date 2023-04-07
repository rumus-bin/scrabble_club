<?php

namespace Scrabble\Services\Member;

use Scrabble\Models\Member\Member;
use Scrabble\Repositories\MemberRepository;

class MemberService
{
    public function __construct(private readonly MemberRepository $memberRepository)
    {
    }

    public function createNew(MemberDto $memberDto): Member
    {
        $model = new Member($memberDto->toArray());
        $model = $this->memberRepository->store($model);

        $this->memberRepository->addContacts($model, $memberDto->contacts);

        return $model;
    }

    public function updateById(MemberDto $memberDto, int $id): Member
    {
        $member = $this->memberRepository->findById($id);
        $member->name = $memberDto->name;
        $member->surname = $memberDto->surname;
        $member->joined_in = $memberDto->joinedIn;

        return $this->memberRepository->store($member);
    }

    public function deleteById(int $id): void
    {
        $member = $this->memberRepository->findById($id);
        $this->memberRepository->delete($member);
    }
}
