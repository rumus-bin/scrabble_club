<?php

namespace Scrabble\Http\Resources\Member;

use Scrabble\Models\Member\MemberProfileModel;
use Illuminate\Http\Resources\Json\JsonResource;
use Scrabble\Http\Resources\Contact\ContactJsonResource;

/**
 * @property MemberProfileModel $resource
 */
class MemberProfileJsonResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'id' => $this->resource->id,
            'name' => $this->resource->name,
            'surname' => $this->resource->surname,
            'full_name' => $this->resource->full_name,
            'joined_in' => $this->resource->joined_in->toFormattedDateString(),
            'games_won' => $this->resource->games_won,
            'games_lost' => $this->resource->games_lost,
            'avg_score' => $this->resource->avg_score,
            'contacts' => ContactJsonResource::collection($this->resource->contacts),
        ];
    }

}
