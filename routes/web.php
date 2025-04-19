<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\OrganizerController;
use App\Http\Controllers\HotelController;
use App\Http\Controllers\ActivityController;
use App\Http\Controllers\TronsportController;
use App\Http\Controllers\TripController;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('welcome');
})->name('home');
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
    Route::get('/register', [AuthController::class, 'showClientRegistrationForm'])->name('register');
    Route::post('/register/client', [AuthController::class, 'registerClient'])->name('register.client');
    Route::get('/register/organizer', [AuthController::class, 'showOrganizerRegistrationForm'])->name('register.organizer');
    Route::post('/register/organizer', [AuthController::class, 'registerOrganizer']);
});
