<?php

namespace Scrabble\Services\Contact;

use Illuminate\Contracts\Support\Arrayable;

class ContactDto implements \JsonSerializable, Arrayable
{
    public function __construct(
        public string $type,
        public string $value,
    ) {
    }

    public function jsonSerialize(): array
    {
        return $this->toArray();
    }

    public function toArray(): array
    {
        return [
            'type' => $this->type,
            'value' => $this->value,
        ];
    }
}
