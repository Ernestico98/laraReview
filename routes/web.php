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
Route::get('/', [\App\Http\Controllers\HomeController::class, 'index'])->name('home');

require __DIR__.'/auth.php';

// LOGGED IN ROUTES ======================================================
Route::middleware(['auth', 'verified'])->group(function () {
    Route::resource('places', \App\Http\Controllers\PlaceController::class);
    Route::get('tags', [\App\Http\Controllers\TagController::class, 'index'])->name('tags.index');
    Route::get('tags/{id}', [\App\Http\Controllers\TagController::class, 'show'])->name('tags.show');
});

// ADMIN ROUTES ===========================================================
Route::middleware(['auth', 'isAdmin'])->group(function () {
    // admin routes come here
});
