<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Authentication\LoginController;
use App\Http\Controllers\Authentication\AuthController;
use App\Http\Controllers\Authentication\RegisterController;
use App\Http\Controllers\Authentication\LogoutController;


Route::post('login', [LoginController::class, 'login']);
Route::post('register', [RegisterController::class, 'register']);

Route::middleware('authed')->group(function () {
    Route::get('assigned-user', [AuthController::class, 'assignedUser']);
    Route::post('logout', [LogoutController::class, 'logout']);
});
