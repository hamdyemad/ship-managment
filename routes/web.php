<?php

use App\Http\Controllers\AddressController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AreaController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CityController;
use App\Http\Controllers\Controller;
use App\Http\Controllers\ShippmentController;
use App\Http\Controllers\UserController;
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
            /* ############################### admin ############################### */
            Route::get('/sitting', [AdminController::class, 'show'])->name('dashboard.sitting');
            Route::resource('city', CityController::class);
            Route::resource('area', AreaController::class);
            /* ############################### end admin ############################### */

            /* ############################### user ############################### */
            Route::resource('user', UserController::class);
            Route::resource('address', AddressController::class);
            Route::resource('shipment', ShippmentController::class);
            Route::get('/downloadPDF/{id}', [Controller::class, 'download'])->name('print');
            // Route::get('/select', [Controller::class, 'select'])->name('shipment.print');
            Route::post('ViewPages', [Controller::class, 'index1'])->name('pdf');
            Route::get('users', [Controller::class, 'index'])->name('account.user');
            Route::post('/user/sitting/fetch/', [Controller::class, 'fetch'])->name('dynamicdependent.fetch');

            /* ############################### end user ############################### */
        });
    }
);

/* ############################### logout ############################### */
Route::middleware('auth:web,admin')->group(function () {
    Route::post('logout', [AuthController::class, 'logout'])->name('dashboard.logout');
});
/* ############################### end logout ############################### */
