<?php

use Illuminate\Support\Facades\Route;
use Scrabble\Http\Controllers\Api\ApiDashboardController;
use Scrabble\Http\Controllers\Api\ApiGamesController;
use Scrabble\Http\Controllers\Api\ApiMemberController;

Route::prefix('scrabble/api')->group(static function () {
    Route::prefix('dashboard')->group(static function () {
        Route::get('/leaders-table', [ApiDashboardController::class, 'leadersTable']);
        Route::get('/games-statistic', [ApiDashboardController::class, 'gamesStatistic']);
    });

    Route::prefix('games')->group(static function () {
        Route::post('/', [ApiGamesController::class, 'store']);
        Route::get('/{id}', [ApiGamesController::class, 'show']);
        Route::get('/', [ApiGamesController::class, 'index']);
        Route::put('/{id}', [ApiGamesController::class, 'update']);
        Route::delete('/{id}', [ApiGamesController::class, 'delete']);
    });

    Route::prefix('members')->group(static function () {
        Route::post('/', [ApiMemberController::class, 'store']);
        Route::get('/{id}', [ApiMemberController::class, 'show']);
        Route::get('/edit/{id}', [ApiMemberController::class, 'edit']);
        Route::get('/', [ApiMemberController::class, 'index']);
        Route::put('/{id}', [ApiMemberController::class, 'update']);
        Route::delete('/{id}', [ApiMemberController::class, 'delete']);
    });
});
