<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::get('places/index', [\App\Http\Controllers\Api\PlaceController::class, 'index'])->name('api_place.index');
// Route::get('places/show/{id}', [\App\Http\Controllers\Api\PlaceController::class, 'show'])->name('api_place.show');


// Api version 1 routes
Route::middleware(['auth:sanctum', 'ApiIsAdmin'])->prefix('v1')->group( function() {

    Route::apiResource('places', \App\Http\Controllers\Api\PlaceController::class);
});


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
