<?php

namespace Scrabble\Http\Requests\Member;

use Scrabble\Models\Member\Member;
use Illuminate\Foundation\Http\FormRequest;
use Scrabble\Services\Member\MemberDto;

class MemberManipulationRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            Member::ID => ['numeric', 'required', 'exists:members,id'],
            Member::NAME => ['string', 'required', 'max:255'],
            Member::SURNAME => ['string', 'required', 'max:255'],
            Member::JOINED_IN => ['date', 'required'],
        ];
    }

    public function getDto(): MemberDto
    {
        return new MemberDto(
            name: $this->get(Member::NAME),
            surname: $this->get(Member::SURNAME),
            joinedIn: $this->get(Member::JOINED_IN),
        );
    }
}
