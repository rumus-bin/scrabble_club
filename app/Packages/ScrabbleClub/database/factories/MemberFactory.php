<?php

namespace Scrabble\Database\Factories;

use Scrabble\Models\Member\Member;
use Illuminate\Database\Eloquent\Factories\Factory;

class MemberFactory extends Factory
{

    protected $model = Member::class;

    /**
     * @inheritDoc
     */
    public function definition(): array
    {
        return [
            Member::NAME => $this->faker->name(),
            Member::SURNAME => $this->faker->lastName(),
            Member::JOINED_IN => $this->faker->dateTime(),
        ];
    }
}
