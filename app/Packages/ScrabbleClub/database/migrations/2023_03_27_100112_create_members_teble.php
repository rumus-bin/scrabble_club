<?php

use Scrabble\Models\Member\Member;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::create(Member::TABLE_NAME, static function (Blueprint $table) {
            $table->id();
            $table->text(Member::NAME)->nullable();
            $table->text(Member::SURNAME);
            $table->dateTime(Member::JOINED_IN);
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

