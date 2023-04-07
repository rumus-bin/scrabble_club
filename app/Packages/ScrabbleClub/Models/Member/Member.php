<?php

namespace Scrabble\Models\Member;

use App\Core\Database\Model\BaseModel;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Carbon;
use Illuminate\Support\Collection;
use Scrabble\Models\Contact;

/**
 * @property string $name
 * @property string $surname
 * @property Carbon $joined_in
 * @property string $full_name
 * @property Collection|Contact[] $contacts
 */
class Member extends BaseModel
{
    public $timestamps = false;

    public const TABLE_NAME = 'members';
    public const NAME = 'name';
    public const SURNAME = 'surname';
    public const JOINED_IN = 'joined_in';
    public const CONTACTS = 'contacts';

    protected $table = self::TABLE_NAME;

    protected $fillable = [
        self::NAME,
        self::SURNAME,
        self::JOINED_IN,
    ];

    protected $casts = [
        self::JOINED_IN => 'datetime',
    ];

    public function contacts(): HasMany
    {
        return $this->hasMany(Contact::class, Contact::MEMBER_ID, self::ID);
    }

    public function getFullNameAttribute(): string
    {
        return $this->name . ' ' . $this->surname;
    }

    public function getTableName(): string
    {
        return self::TABLE_NAME;
    }
}
