<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Scrabble\Models\Contact;
use Scrabble\Models\Member\Member;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::create(Contact::TABLE_NAME, static function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('member_id');
            $table->foreign('member_id')
                ->references(Member::ID)
                ->on(Member::TABLE_NAME)
                ->onDelete('cascade');
            $table->string(Contact::TYPE);
            $table->string(Contact::VALUE)
                ->unique();
            $table->timestamps();
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

