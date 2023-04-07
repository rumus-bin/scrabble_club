<?php

namespace Scrabble\Http\Requests\Member;

use Scrabble\Models\Contact;
use Scrabble\Models\Member\Member;
use Illuminate\Foundation\Http\FormRequest;
use Scrabble\Services\Contact\ContactDto;
use Scrabble\Services\Member\MemberDto;

class MemberStoreRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            Member::NAME => ['string', 'required', 'max:255'],
            Member::SURNAME => ['string', 'required', 'max:255'],
            Member::JOINED_IN => ['date', 'required'],
            Member::CONTACTS => ['array'],
        ];
    }

    public function getDto(): MemberDto
    {
        $contacts = $this->get(Member::CONTACTS, []);
        $contactsCollection = collect($contacts)->map(function ($contact) {
            return new ContactDto(
                type: $contact[Contact::TYPE],
                value: $contact[Contact::VALUE],
            );
        });
        return new MemberDto(
            name: $this->get(Member::NAME),
            surname: $this->get(Member::SURNAME),
            joinedIn: $this->get(Member::JOINED_IN),
            contacts: $contactsCollection,
        );
    }
}
