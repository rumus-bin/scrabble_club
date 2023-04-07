<?php

namespace Scrabble\Models\Enums;

enum ContactType : string
{
    case EMAIL = 'email';
    case PRIMARY_EMAIL = 'primary_email';
    case PHONE = 'phone';

    public static function getTypeNames(): array
    {
        return [
            self::EMAIL->value => 'Email',
            self::PRIMARY_EMAIL->value => 'Primary Email',
            self::PHONE->value => 'Phone',
        ];
    }
}
