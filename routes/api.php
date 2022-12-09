<?php

use App\Http\Controllers\Api\AreaController;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\CityController;
use App\Http\Controllers\Api\ShippmentController;
use Illuminate\Http\Request;
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

Route::group([
    'middleware' => 'api',
], function () {
    Route::group(['prefix' => 'auth'], function() {
        Route::post('login', [AuthController::class, 'login']);
    });

    Route::group(['prefix' => 'shippments', 'middleware' => 'jwt'], function() {
        Route::post('create', [ShippmentController::class, 'create']);
    });

    Route::group(['prefix' => 'cities'], function() {
        Route::get('/', [CityController::class, 'index']);

        // Areas
        Route::get('/{id}/areas', [AreaController::class, 'areas']);
    });
});
