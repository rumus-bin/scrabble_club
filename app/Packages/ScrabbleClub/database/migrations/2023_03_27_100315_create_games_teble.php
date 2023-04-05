<?php

use Scrabble\Models\Member\Member;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Scrabble\Models\Game;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::create(Game::TABLE_NAME, static function (Blueprint $table) {
            $table->id();
            $table->foreignId(Game::FIRST_PLAYER_ID)->constrained(Member::TABLE_NAME);
            $table->foreignId(Game::SECOND_PLAYER_ID)->constrained(Member::TABLE_NAME);
            $table->integer(Game::FIRST_PLAYER_SCORE);
            $table->integer(Game::SECOND_PLAYER_SCORE);
            $table->dateTime(Game::DATE);

            $table->index([Game::FIRST_PLAYER_ID, Game::SECOND_PLAYER_ID]);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
    }
};

