<?php

namespace Scrabble\Http\Resources\Game;

use Illuminate\Http\Resources\Json\JsonResource;
use Scrabble\Models\Game;

/**
 * @property Game $resource
 */
class GameJsonResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'id' => $this->resource->id,
            'date' => $this->resource->date->toFormattedDateString(),
            'first_player' => $this->resource->firstPlayer,
            'second_player' => $this->resource->secondPlayer,
            'first_player_score' => $this->resource->first_player_score,
            'second_player_score' => $this->resource->second_player_score,
        ];
    }
}
