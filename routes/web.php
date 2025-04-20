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

// Authenticated routes
Route::middleware('auth')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    
    // Client routes
    Route::middleware(['client'])->group(function () {
        Route::get('/client/dashboard', [ClientController::class, 'dashboard'])->name('client.dashboard');
    });
    
    // Organizer routes
    Route::middleware(['organizer'])->group(function () {
        Route::get('/organizer/pending', [OrganizerController::class, 'pending'])->name('organizer.pending');
        
        Route::middleware(['organizer.approval'])->group(function () {
            Route::get('/organizer/dashboard', [OrganizerController::class, 'dashboard'])->name('organizer.dashboard');
        });
    });
});
Route::prefix('organizer')->name('profile.')->group(function () {
    Route::get('/profile', [OrganizerController::class, 'profile'])->name('profile');
    Route::put('/profile', [AuthController::class, 'updateProfile'])->name('update');
    Route::put('/changePassword', [AuthController::class, 'updatePassword'])->name('password');


})->middleware('auth');
Route::prefix('organizer')->name('organizer.')->group(function () {
    Route::get('/dashboard', [OrganizerController::class, 'dashboard'])->name('dashboard');
    Route::get('/pending', [OrganizerController::class, 'pending'])->name('pending');
    Route::get('/trips', [OrganizerController::class, 'organizerTrips'])->name('OrganizerTrips');
    Route::get('/bookings', [OrganizerController::class, 'bookings'])->name('bookings');
    Route::get('/messages', [OrganizerController::class, 'messages'])->name('messages');
    Route::get('/notifications', [OrganizerController::class, 'notifications'])->name('notifications');
    Route::get('/settings', [OrganizerController::class, 'settings'])->name('settings');
   

})->middleware('auth');
 // Hotel routes
 Route::prefix('organizer')->name('hotels.')->group(function () {
    Route::get('/hotels', [HotelController::class, 'index'])->name('index');
    Route::post('/hotels', [HotelController::class, 'store'])->name('store');
    Route::get('/hotels/create', [HotelController::class, 'create'])->name('create'); 
    Route::get('/hotels/{hotel}', [HotelController::class, 'showDetail'])->name('show'); 
    Route::get('/hotels/{hotel}/edit', [HotelController::class, 'edit'])->name('edit'); 
    Route::put('/hotels/{hotel}', [HotelController::class, 'update'])->name('update');
    Route::delete('/hotels/{hotel}', [HotelController::class, 'destroy'])->name('destroy'); 
})->middleware('auth');
Route::prefix('organizer')->name('activity.')->group(function () {
    Route::get('/activities', [ActivityController::class, 'index'])->name('index');
    Route::post('/activities', [ActivityController::class, 'store'])->name('store');
    Route::get('/activities/create', [ActivityController::class, 'create'])->name('create'); 
    Route::get('/activities/{activity}', [ActivityController::class, 'show'])->name('show'); 
    Route::get('/activities/{activity}/edit', [ActivityController::class, 'edit'])->name('edit'); 
    Route::put('/activities/{activity}', [ActivityController::class, 'update'])->name('update');
    Route::delete('/activities/{activity}', [ActivityController::class, 'destroy'])->name('destroy'); 
})->middleware('auth');
Route::prefix('organizer')->name('transport.')->group(function () {
    Route::get('/tronsports', [TronsportController::class, 'index'])->name('index');
    Route::post('/tronsports', [TronsportController::class, 'store'])->name('store');
    Route::get('/tronsports/create', [TronsportController::class, 'create'])->name('create'); 
    Route::get('/tronsports/{transport}', [TronsportController::class, 'show'])->name('show'); 
    Route::get('/tronsports/{transport}/edit', [TronsportController::class, 'edit'])->name('edit'); 
    Route::put('/tronsports/{transport}', [TronsportController::class, 'update'])->name('update');
    Route::delete('/tronsports/{transport}', [TronsportController::class, 'destroy'])->name('destroy'); 
})->middleware('auth');
// Trip routes
Route::prefix('organizer')->name('trips.')->group(function () {
    Route::get('/trips', [TripController::class, 'index'])->name('index');
    Route::get('/trips/fetch', [TripController::class, 'fetchTrips'])->name('fetch');
    Route::post('/trips', [TripController::class, 'store'])->name('store');
    Route::get('/trips/create', [TripController::class, 'create'])->name('create'); 
    Route::get('/trips/{trip}', [TripController::class, 'show'])->name('show'); 
    Route::get('/trips/{trip}/edit', [TripController::class, 'edit'])->name('edit'); 
    Route::put('/trips/{trip}', [TripController::class, 'update'])->name('update');
    Route::delete('/trips/{trip}', [TripController::class, 'destroy'])->name('destroy'); 
})->middleware('auth');
Route::prefix('client')->name('profile.')->group(function () {
    Route::get('/profile', [ClientController::class, 'profile'])->name('profile');
    Route::put('/profile', [AuthController::class, 'updateProfile'])->name('edit');
    Route::put('/changePassword', [AuthController::class, 'updatePassword'])->name('password');
})->middleware('auth');

// Add client trips routes
Route::prefix('client')->name('client.')->group(function () {
    Route::get('/trips/fetch', [TripController::class, 'fetchClientTrips'])->name('trips.fetch');
})->middleware('auth');

// Client routes
Route::middleware(['auth', 'client'])->prefix('client')->name('client.')->group(function () {
    // Trip routes
    Route::get('/trips', [TripController::class, 'index'])->name('trips.index');
    Route::get('/trips/{trip}', [TripController::class, 'show'])->name('trips.show');
    Route::post('/trips/{trip}/comment', [TripController::class, 'comment'])->name('trip.comment');
    Route::delete('/trips/reviews/{review}', [TripController::class, 'deleteReview'])->name('trip.review.delete');
    Route::get('/trips/{trip}/payment', [TripController::class, 'payment'])->name('trip.payment');
    Route::post('/trips/{trip}/book', [TripController::class, 'book'])->name('trip.book');
});