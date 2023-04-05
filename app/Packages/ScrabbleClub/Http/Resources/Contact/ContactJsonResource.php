<?php

namespace Scrabble\Http\Resources\Contact;

use Illuminate\Http\Resources\Json\JsonResource;

class ContactJsonResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'id' => $this->resource->id,
            'type' => $this->resource->type,
            'value' => $this->resource->value,
        ];
    }
}
