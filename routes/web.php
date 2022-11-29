<?php

use App\Http\Controllers\AccountSellerController;
use App\Http\Controllers\AddressController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AreaController;
use App\Http\Controllers\AssignedpickupController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CityController;
use App\Http\Controllers\Controller;
use App\Http\Controllers\DriverController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\PickupController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\ScheduledriverController;
use App\Http\Controllers\ScheduleSellerController;
use App\Http\Controllers\ShippmentController;
use App\Http\Controllers\SpecialpriceController;
use App\Http\Controllers\TrackingController;
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

Route::view('/', 'Dashboard.landing')->name('open.scan');
Route::post('/tracking', [Controller::class, 'gettrackingnumber'])->name('gettrackingnumber');

Route::redirect('/admin', '/admin/login');
Route::redirect('/user', '/user/login');
Route::redirect('/employee', '/employee/login');
Route::redirect('/driver', '/driver/login');

Route::middleware('guest:user,admin,employee,driver')->group(function () {
    Route::get('{guard}/login', [AuthController::class, 'showLogin'])->name('dashboard.login');
    Route::post('login', [AuthController::class, 'login'])->name('login');
});

/* ############################### end login ############################### */

Route::group(
    [
        'prefix' => LaravelLocalization::setLocale(),
        'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath', 'auth:user,admin,employee,driver']
    ],
    function () {

        Route::prefix('dashboard')->group(function () {

            Route::get('/', [Controller::class, 'home_page'])->name('app');
            /* ############################### admin ############################### */
            Route::group(['prefix' => 'admin'], function() {
                Route::get('/', [AdminController::class, 'show'])->name('dashboard.sitting');
                Route::post('/update', [AdminController::class, 'update'])->name('dashboard.sitting.update');

            });

            Route::resource('city', CityController::class);
            Route::resource('area', AreaController::class);
            /* ############################### end admin ############################### */
            Route::resource('driver', DriverController::class);
            Route::post('driver/assign-shippments', [DriverController::class, 'AssignShippments'])->name('driver.assign_shippments');

            Route::resource('employee', EmployeeController::class);

            Route::view('/scan', 'Dashboard.admin.scanner')->name('open.scan');
            Route::get('/scan/shippments', [Controller::class, 'getdrivers'])->name('employee.scan');
            Route::get('/scan/shippments/status', [Controller::class, 'changeShippmentStatus'])->name('employee.shippment');
            Route::get('/actions', [Controller::class, 'actions'])->name('actions');

            /* ############################### user ############################### */
            Route::resource('user', UserController::class);

            Route::post('/addresses', [AddressController::class, 'addresses'])->name('user.addresses');
            Route::resource('specialprice', SpecialpriceController::class);

            Route::resource('address', AddressController::class);
            Route::resource('shipment', ShippmentController::class);
            Route::resource('pickup', PickupController::class);
            Route::resource('account', AccountSellerController::class);
            Route::resource('ScheduleSeller', ScheduleSellerController::class);
            Route::resource('assignedpickup', AssignedpickupController::class);
            Route::resource('tracking', TrackingController::class);
            Route::resource('Scheduledriver', ScheduledriverController::class);

            Route::get('select/city/{id}', [Controller::class, 'specialprice_city'])->name('special.price');
            //print shipment pdf
            Route::get('/downloadPDF/{id}', [Controller::class, 'download'])->name('print');
            Route::post('/ViewPages', [Controller::class, 'index1'])->name('pdf');
            Route::get('users', [Controller::class, 'index'])->name('account.user');
            Route::post('/user/sitting/fetch/', [Controller::class, 'fetch'])->name('dynamicdependent.fetch');
            Route::post('/user/sitting/fetch2/', [Controller::class, 'fetch2'])->name('dynamicdependent.fetch2');
            Route::get('/admin/all-shipment', [ShippmentController::class, 'index'])->name('getshipment');
            Route::post('/shipment/scan', [Controller::class, 'getshipmentscan'])->name('scan');
            Route::post('/shipment/status/{id}', [Controller::class, 'getshipmentstatus'])->name('getshipmentstatus');
            Route::get('/shippment/{id}', [Controller::class, 'getshipmentstatusid'])->name('getshipmentstatusid');

            Route::get('/driver/pickups/delivery', [Controller::class, 'driverpickups'])->name('driver.pickups');
            Route::get('/driver/shippments/delivery', [Controller::class, 'drivershippments'])->name('driver.shippments');
            // change the status from driver
            Route::post('/driver/shipment/status', [Controller::class, 'changestatue'])->name('driver.status');
            Route::post('/driver/shipment/status/onhold', [Controller::class, 'changestatue_onhold'])->name('changestatue_onhold');
            Route::post('/employee/scan', [Controller::class, 'getshipmentscan2'])->name('scan2');
            Route::post('/employee/scan/shippments', [Controller::class, 'getshipmentscan3'])->name('scan3');


            Route::get('accountdriver', [Controller::class, 'getaccounts'])->name('shipments_drivers');

            Route::post('sellers/settlement', [Controller::class,'settlement_sellers'])->name('settlement_sellers');
            /* print accounts for  users */
            Route::get('acountseller', [Controller::class, 'accountsellerpdf'])->name('accountseller_pdf');
            Route::get('Schedulesellerpdf', [Controller::class, 'accountseller2'])->name('Scheduleseller_pdf');
            /* end print accounts for  users */

            /* print accounts for  driver */
            Route::get('acountdriver', [Controller::class, 'accountdriver'])->name('account_driver');
            Route::get('Scheduledriverpdf', [Controller::class, 'accountdriver2'])->name('accountdriver_pdf');
            /* end print accounts for  driver */

            /* print all the shipments using admin */
            Route::get('pdfallshippments', [Controller::class, 'pdf_shippments'])->name('pdfallshippments');

            /* print the shippments for driver using admin */
            Route::get('printdrivershipments', [Controller::class, 'print_driver_shipments'])->name('printdrivershipments');

            Route::get('address', [Controller::class, 'getCity'])->name('getCity');
            Route::get('export', [Controller::class, 'exportShippment'])->name('export_shippment');

            // import shippment
            Route::get('import', [Controller::class, 'viewimport'])->name('view.import');
            Route::post('import', [Controller::class, 'importShippment'])->name('import.Shippment');


            Route::resource('roles', RoleController::class);
            Route::resource('permissions', PermissionController::class);

            /* ############################### end user ############################### */
        });
    }
);

/* ############################### logout ############################### */
Route::middleware('auth:user,admin,employee,driver')->group(function () {
    Route::post('logout', [AuthController::class, 'logout'])->name('dashboard.logout');
});
/* ############################### end logout ############################### */
