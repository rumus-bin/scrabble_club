<?php

namespace Scrabble\Http\Resources\Game;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\ResourceCollection;
use Illuminate\Support\Collection;
use Scrabble\Models\Game;

/**
 * @property Collection|Game[] $collection
 */
class GameCollection extends ResourceCollection
{
    public function toArray($request): array
    {
        return [
            'data' => $this->getCollection(),
            'links' => [
//                'first' => $this->url(1),
//                'last' => $this->url($this->lastPage()),
//                'prev' => $this->previousPageUrl(),
//                'next' => $this->nextPageUrl(),
            ],
        ];
    }

    private function getCollection(): Collection
    {
        return $this->collection->map(function (Game $game) {
            return [
                'id' => $game->id,
                'date' => $game->date->format('LLLL'),
                'first_player' => $game->firstPlayer,
                'second_player' => $game->secondPlayer,
                'first_player_score' => $game->first_player_score,
                'second_player_score' => $game->second_player_score,
            ];
        });
    }
}
