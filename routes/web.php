<?php

use App\Http\Controllers\AddressController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AreaController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CityController;
use App\Http\Controllers\Controller;
use App\Http\Controllers\DriverController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\PickupController;
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

Route::middleware('guest:web,admin,employee,driver')->group(function () {
    Route::get('{guard}/login', [AuthController::class, 'showLogin'])->name('dashboard.login');
    Route::post('login', [AuthController::class, 'login'])->name('login');
});

/* ############################### end login ############################### */

Route::group(
    [
        'prefix' => LaravelLocalization::setLocale(),
        'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath', 'auth:web,admin,employee,driver']
    ],
    function () {

        Route::prefix('dashboard')->group(function () {
            Route::view('/', 'Dashboard.app')->name('app');
            /* ############################### admin ############################### */
            Route::get('/admin', [AdminController::class, 'show'])->name('dashboard.sitting');
            Route::resource('city', CityController::class);
            Route::resource('area', AreaController::class);
            /* ############################### end admin ############################### */
            Route::resource('driver', DriverController::class);
            Route::resource('employee', EmployeeController::class);

            Route::view('/scan', 'dashboard.admin.scanner')->name('open.scan');
            Route::get('/scan/shippments', [Controller::class, 'getdrivers'])->name('employee.scan');
            /* ############################### user ############################### */
            Route::resource('user', UserController::class);

            Route::resource('address', AddressController::class);
            Route::resource('shipment', ShippmentController::class);
            Route::resource('pickup', PickupController::class);
            //print shipment pdf
            Route::get('/downloadPDF/{id}', [Controller::class, 'download'])->name('print');
            Route::post('ViewPages', [Controller::class, 'index1'])->name('pdf');
            Route::get('users', [Controller::class, 'index'])->name('account.user');
            Route::post('/user/sitting/fetch/', [Controller::class, 'fetch'])->name('dynamicdependent.fetch');
            Route::post('/user/sitting/fetch2/', [Controller::class, 'fetch2'])->name('dynamicdependent.fetch2');
            Route::get('/admin/all-shipment', [Controller::class, 'getshipment'])->name('getshipment');
            Route::post('/shipment/scan', [Controller::class, 'getshipmentscan'])->name('scan');
            Route::get('/driver/shipment/delivery', [Controller::class, 'drivershipment'])->name('driver.shipment');
            // change the status from driver
            Route::post('/driver/shipment/status', [Controller::class, 'changestatue'])->name('driver.status');
            Route::post('/driver/shipment/status/onhold', [Controller::class, 'changestatue_onhold'])->name('changestatue_onhold');
            Route::post('/employee/scan', [Controller::class, 'getshipmentscan2'])->name('scan2');
            // Route::view('/employee/scan/shipmeht', 'Dashboard.admin.employee.show')->name('scan.shippments');



            /* ############################### end user ############################### */
        });
    }
);

/* ############################### logout ############################### */
Route::middleware('auth:web,admin,employee,driver')->group(function () {
    Route::post('logout', [AuthController::class, 'logout'])->name('dashboard.logout');
});
/* ############################### end logout ############################### */
