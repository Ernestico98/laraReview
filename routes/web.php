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
// Route::resource('users', \App\Http\Controllers\UserController::class);

require __DIR__.'/auth.php';

// LOGGED IN ROUTES ======================================================
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});

// ADMIN ROUTES ===========================================================
Route::middleware(['auth', 'isAdmin'])->group(function () {
    // admin routes come here
});
