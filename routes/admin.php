<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\Auth\LoginController;
use App\Http\Controllers\Admin\Home\HomeController;
use App\Http\Controllers\Admin\Theme\ThemeController;
use App\Http\Controllers\Admin\Master\MasterController;
use App\Http\Controllers\Admin\Package\PackageController;
use App\Http\Controllers\Admin\Package\PackageFeatureController;
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

Route::domain('admin.'.env('APP_URL'))->name('admin.')->group(function () {
    Route::match(['GET', 'POST'], '/login', [LoginController::class, 'login']);

    Route::group([
        'middleware' => 'check:admin'
    ], function(){
        Route::get('/', [HomeController::class, 'show']);
        Route::get('/logout', [HomeController::class, 'logout']);

        Route::get('/theme', [ThemeController::class, 'list_themes']);
        Route::match(['GET', 'POST'], '/theme/create', [ThemeController::class, 'create_themes']);

        Route::get('/setting/creator', [MasterController::class, 'list_creators']);
        Route::match(['GET', 'POST'], '/setting/creator/add', [MasterController::class, 'add_new_creator']);

        Route::get('/setting/theme-category', [MasterController::class, 'list_categories']);
        Route::match(['GET', 'POST'], '/setting/theme-category/add', [MasterController::class, 'add_new_theme_category']);

        Route::resource('/package', PackageController::class)->names([
            'create' => 'package.create'
        ]);
        Route::resource('/package-feature', PackageFeatureController::class)->names([
            'create' => 'package-feature.create'
        ]);
    });
});
