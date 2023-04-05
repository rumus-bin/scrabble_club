<?php

namespace Scrabble\Http\Resources\Member;

use Scrabble\Models\Member\Member;
use Illuminate\Http\Resources\Json\JsonResource;
use Scrabble\Http\Resources\Contact\ContactJsonResource;

/**
 * @property Member $resource
 */
class MemberJsonResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'id' => $this->resource->id,
            'name' => $this->resource->name,
            'surname' => $this->resource->surname,
            'full_name' => $this->resource->full_name,
            'joined_in' => $this->resource->joined_in,
            'contacts' => ContactJsonResource::collection($this->resource->contacts),
        ];
    }

}
