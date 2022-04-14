<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AreaController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CityController;
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

/* ############################### login ############################### */

Route::middleware('guest:web,admin')->group(function () {
    Route::get('{guard}/login', [AuthController::class, 'showLogin'])->name('dashboard.login');
    Route::post('login', [AuthController::class, 'login'])->name('login');
});
/* ############################### end login ############################### */

Route::group(
    [
        'prefix' => LaravelLocalization::setLocale(),
        'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath', 'auth:web,admin']
    ],
    function () {

        Route::prefix('dashboard')->group(function () {
            Route::view('/', 'Dashboard.app')->name('app');
            Route::get('/sitting', [AdminController::class, 'show'])->name('dashboard.sitting');
            // Route::get('/edit/city', [CityController::class, 'edit'])->name('dashboard.ed');
            Route::resource('city', CityController::class);
            Route::resource('area', AreaController::class);
        });
    }
);

/* ############################### logout ############################### */
Route::middleware('auth:web,admin')->group(function () {
    Route::get('logout', [AuthController::class, 'logout'])->name('dashboard.logout');
});
/* ############################### end logout ############################### */
