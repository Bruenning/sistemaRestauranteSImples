<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\reservationsController;


Route::post('/oauth/token', '\Laravel\Passport\Http\Controllers\AccessTokenController@issueToken');


Route::name('api.')->group(function () {
    Route::prefix('user')->name('user.')->group(function () {
        Route::apiResource('user', UserController::class);
        Route::post('login', [UserController::class, 'login'])->name('login');
        
    });
    Route::prefix('reservations')->name('reservations.')->group(function () {
        Route::apiResource('reservations', reservationsController::class);
    });
});
