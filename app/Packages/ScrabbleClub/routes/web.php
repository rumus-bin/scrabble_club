<?php

use Illuminate\Support\Facades\Route;
use Scrabble\Http\Controllers\ScrabbleClubController;

Route::get('/scrabble-club', [ScrabbleClubController::class, 'index']);

Route::get('/scrabble-club/{any}', static function () {
    return view('scrabble-club::layouts.scrabble-club-layout');
})->where('any', '.*');
