<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\reservationsController;


Route::post('/oauth/token', '\Laravel\Passport\Http\Controllers\AccessTokenController@issueToken');


Route::name('api.')->group(function () {
    Route::prefix('user')->name('user.')->group(function () {
        Route::apiResource('user', UserController::class)->except(['index', 'show', 'login']);
        Route::get('index', [UserController::class, 'index'])->name('index');
        Route::get('show/{user}', [UserController::class, 'show'])->name('show');
        Route::post('login', [UserController::class, 'login'])->name('login');
        
    });
    Route::prefix('reservations')->name('reservations.')->group(function () {
        Route::apiResource('reservations', reservationsController::class)->except(['index', 'show', 'store']);
        Route::post('store', [reservationsController::class, 'store'])->name('store');
        Route::get('index', [reservationsController::class, 'index'])->name('index');
        Route::get('show/{reservations}', [reservationsController::class, 'show'])->name('show');
        Route::get('user/{user}', [reservationsController::class, 'userId'])->name('user');
    });
});
