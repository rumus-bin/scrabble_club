<?php

namespace Scrabble\Models;

use App\Core\Database\Model\BaseModel;
use Scrabble\Models\Member\Member;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Carbon;

/**
 * @property Carbon $date
 * @property int $first_player_id
 * @property int $id
 * @property int $second_player_id
 * @property int $first_player_score
 * @property int $second_player_score
 * @property  Member firstPlayer
 * @property  Member secondPlayer
 */
class Game extends BaseModel
{
    public const TABLE_NAME = 'games';

    public const ID = 'id';
    public const DATE = 'date';
    public const FIRST_PLAYER_ID = 'first_player_id';
    public const SECOND_PLAYER_ID = 'second_player_id';
    public const FIRST_PLAYER_SCORE = 'first_player_score';
    public const SECOND_PLAYER_SCORE = 'second_player_score';

    protected $table = self::TABLE_NAME;

    public $timestamps = false;

    protected $fillable = [
        self::DATE,
        self::FIRST_PLAYER_ID,
        self::SECOND_PLAYER_ID,
        self::FIRST_PLAYER_SCORE,
        self::SECOND_PLAYER_SCORE
    ];

    protected $casts = [
        self::DATE => 'datetime',
    ];

    public function firstPlayer(): BelongsTo
    {
        return $this->belongsTo(Member::class, self::FIRST_PLAYER_ID, Member::ID);
    }

    public function secondPlayer(): BelongsTo
    {
        return $this->belongsTo(Member::class, self::SECOND_PLAYER_ID, Member::ID);
    }

    public function getTableName(): string
    {
        return self::TABLE_NAME;
    }
}
