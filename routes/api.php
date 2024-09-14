<?php
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;

Route::post('/v1/users/login', [AuthController::class, 'login']);
Route::post('/v1/users/register', [AuthController::class, 'register']);

Route::middleware(['jwt.auth'])->group(function () {
    Route::get('/v1/users', [UserController::class, 'index']);
    Route::get('/v1/users/{id}', [UserController::class, 'show']);
    Route::put('/v1/users/{id}', [UserController::class, 'update']);
    Route::delete('/v1/users/{id}', [UserController::class, 'destroy']);
});
