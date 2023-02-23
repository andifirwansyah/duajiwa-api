<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\Auth\LoginController;
use App\Http\Controllers\API\Auth\RegisterController;
use App\Http\Controllers\API\Profile\ProfileController;
use App\Http\Controllers\API\Event\EventController;
use App\Http\Controllers\API\Wedding\WeddingController;
use App\Http\Controllers\API\Theme\ThemeController;
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

Route::group([
    'prefix' => 'v1'
], function() {
    Route::post('/login', [LoginController::class, 'login']);
    Route::post('/register', [RegisterController::class, 'register']);

    Route::group([
        'middleware' => 'auth:sanctum'
    ], function() {
        // profile routes
        Route::get('/me', [ProfileController::class, 'show_profile']);
        Route::post('/me/update', [ProfileController::class, 'update_profile']);
        Route::post('/me/update/password', [ProfileController::class, 'update_password']);

        // event routes
        Route::get('/events', [EventController::class, 'list_events']);
        Route::post('/event/create', [EventController::class, 'add_new_event']);
        Route::post('/event/detail-event', [EventController::class, 'detail_event']);
        Route::post('/event/update-step', [EventController::class, 'update_step_event']);

        Route::post('/event/wedding/couple', [WeddingController::class, 'add_couple']);


        // theme routes
        Route::get('/themes', [ThemeController::class, 'list_themes']);

    });

});

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });
