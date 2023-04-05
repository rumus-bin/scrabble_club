<?php

namespace Scrabble\Models;

use Scrabble\Models\Member\Member;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Contact extends Model
{
    public const TABLE_NAME = 'contacts';

    public const TYPE = 'type';

    public const VALUE = 'value';
    public const MEMBER_ID = 'member_id';

    protected $table = self::TABLE_NAME;

    protected $fillable = [
        self::TYPE,
        self::VALUE,
    ];

    public function member(): BelongsTo
    {
        return $this->belongsTo(Member::class, self::MEMBER_ID, Member::ID);
    }

}
