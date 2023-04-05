<?php

namespace Scrabble\Http\Requests\Game;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Carbon;
use Scrabble\Services\Game\GameDto;
use Scrabble\Models\Game;

class GameStoreRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            Game::FIRST_PLAYER_ID => ['integer', 'required', 'exists:members,id'],
            Game::SECOND_PLAYER_ID => ['integer', 'required', 'exists:members,id'],
            Game::SECOND_PLAYER_SCORE => ['integer'],
            Game::FIRST_PLAYER_SCORE => ['integer'],
            Game::DATE => ['date', 'required'],
        ];
    }

    public function getDto(): GameDto
    {
        return new GameDto(
            $this->get(Game::FIRST_PLAYER_ID),
            $this->get(Game::SECOND_PLAYER_ID),
            $this->get(Game::FIRST_PLAYER_SCORE),
            $this->get(Game::SECOND_PLAYER_SCORE),
            Carbon::parse($this->get(Game::DATE)),
        );
    }
}
