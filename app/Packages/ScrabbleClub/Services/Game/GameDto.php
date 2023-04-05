<?php

namespace Scrabble\Services\Game;

use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Support\Carbon;
use Scrabble\Models\Game;

/**
 * @property int $firstPlayerId
 * @property int $secondPlayerId
 * @property int $firstPlayerScore
 * @property int $secondPlayerScore
 * @property Carbon $gameDate
 */
class GameDto implements Arrayable
{
    public function __construct(
        private int $firstPlayerId,
        private int $secondPlayerId,
        private int $firstPlayerScore,
        private int $secondPlayerScore,
        private Carbon $gameDate,
    ) {
    }

    public function toArray(): array
    {
        return [
            Game::FIRST_PLAYER_ID => $this->firstPlayerId,
            Game::SECOND_PLAYER_ID => $this->secondPlayerId,
            Game::FIRST_PLAYER_SCORE => $this->firstPlayerScore,
            Game::SECOND_PLAYER_SCORE => $this->secondPlayerScore,
            Game::DATE => $this->gameDate,
        ];
    }

}
