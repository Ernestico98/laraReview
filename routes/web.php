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

// PUBLIC ROUTES ========================================================================================

// Welcome
Route::get('/', [\App\Http\Controllers\HomeController::class, 'index'])->name('home');

require __DIR__.'/auth.php';

// LOGGED IN ROUTES =====================================================================================
Route::middleware(['auth', 'verified'])->group(function () {
    // Places
    Route::resource('places', \App\Http\Controllers\PlaceController::class);

    // Users
    Route::resource('users', \App\Http\Controllers\UserController::class)->only('show', 'edit', 'update');

    // Reviews
    Route::get('/places/{place_id}/review', [\App\Http\Controllers\ReviewController::class, 'create'])->name('reviews.create');
    Route::post('/places/{place_id}/review', [\App\Http\Controllers\ReviewController::class, 'store'])->name('reviews.store');

    // Complaint
    Route::post('/report/{review_id}/{user_id}', [\App\Http\Controllers\ComplaintController::class, 'report'])->name('complaints.report');

    // Tags
    Route::get('tags', [\App\Http\Controllers\TagController::class, 'index'])->name('tags.index');
    Route::get('tags/{id}', [\App\Http\Controllers\TagController::class, 'show'])->name('tags.show');
});

// ADMIN ROUTES =========================================================================================
Route::middleware(['auth', 'isAdmin'])->group(function () {
    // Users
    Route::resource('users', \App\Http\Controllers\UserController::class)->only('index');

    // Complaints
    Route::get('/complaints', [\App\Http\Controllers\ComplaintController::class, 'index'])->name('complaints.index');
    Route::post('/complaints/hide/{review_id}', [\App\Http\Controllers\ComplaintController::class, 'hide_review'])->name('complaints.hide');
});
