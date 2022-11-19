<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// PUBLIC ROUTES =========================================================

// Welcome
Route::get('/', [\App\Http\Controllers\HomeController::class, 'index'])->name('home');

// Tags
Route::resource('places', \App\Http\Controllers\PlaceController::class)->only('index', 'show');

// Tags
Route::get('tags', [\App\Http\Controllers\TagController::class, 'index'])->name('tags.index');
Route::get('tags/{id}', [\App\Http\Controllers\TagController::class, 'show'])->name('tags.show');

require __DIR__.'/auth.php';

// LOGGED IN ROUTES ======================================================
Route::middleware(['auth', 'verified'])->group(function () {
    // Place
    Route::resource('places', \App\Http\Controllers\PlaceController::class)->except('index', 'show');

    // Users
    Route::resource('users', \App\Http\Controllers\UserController::class)->only('show', 'edit', 'update');

    // Reviews
    Route::get('/places/{place_id}/review', [\App\Http\Controllers\ReviewController::class, 'create'])->name('reviews.create');
    Route::post('/places/{place_id}/review', [\App\Http\Controllers\ReviewController::class, 'store'])->name('reviews.store');
});

// ADMIN ROUTES ===========================================================
Route::middleware(['auth', 'isAdmin'])->group(function () {
    // Users
    Route::resource('users', \App\Http\Controllers\UserController::class)->only('index');
});
