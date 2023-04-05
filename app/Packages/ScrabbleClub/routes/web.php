<?php

use Illuminate\Support\Facades\Route;
use Scrabble\Http\Controllers\ScrabbleClubController;

Route::get('/scrabble-club', [ScrabbleClubController::class, 'index']);
