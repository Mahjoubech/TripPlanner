<?php
use App\Http\Controllers\AuthController;

Route::post('/register-client', [AuthController::class, 'registerClient']);
Route::post('/register-organizer', [AuthController::class, 'registerOrganizer']);
Route::post('/login', [AuthController::class, 'login']);

Route::middleware('auth:api')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::post('/refresh', [AuthController::class, 'refresh']);
    Route::get('/me', [AuthController::class, 'me']);
    Route::post('/update-profile', [AuthController::class, 'updateProfile']);
});

// Profile API Routes
Route::middleware('auth:sanctum')->group(function () {
    Route::get('/profile/activities', [App\Http\Controllers\ProfileController::class, 'getActivities']);
    Route::get('/profile/trips', [App\Http\Controllers\ProfileController::class, 'getTrips']);
});
