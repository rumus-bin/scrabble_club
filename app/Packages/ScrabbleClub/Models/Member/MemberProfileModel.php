<?php

namespace Scrabble\Models\Member;

use Illuminate\Support\Carbon;
use Illuminate\Support\Collection;
use Scrabble\Models\Contact;

/**
 * @property int $id
 * @property string $name
 * @property string $surname
 * @property Carbon $joined_in
 * @property string $full_name
 * @property string $games_won
 * @property string $games_lost
 * @property string $avg_score
 * @property Collection|Contact[] $contacts
 */
class MemberProfileModel
{
}
