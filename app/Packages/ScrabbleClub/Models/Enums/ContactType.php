<?php

namespace Scrabble\Models\Enums;

enum ContactType : string
{
    case EMAIL = 'email';
    case PRIMARY_EMAIL = 'primary_email';

    case PHONE = 'phone';
}
