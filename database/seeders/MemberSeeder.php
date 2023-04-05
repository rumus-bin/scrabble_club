<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Scrabble\Database\Factories\MemberFactory;

class MemberSeeder extends Seeder
{

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        $factory = new MemberFactory();
        $factory->count(10)->create();
    }


}
