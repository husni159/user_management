<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

//protected routes
Route::group(['middleware' => []], function() {
    Route::get(
        '/list-users',
        [UserController::class, 'getAllUsers']
    )->name('getAllUsers');
});

Route::group(['middleware' => []], function() {
    Route::post(
        '/add-users',
        [UserController::class, 'addUser']
    )->name('addUser');
});