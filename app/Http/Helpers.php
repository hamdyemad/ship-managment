<?php

use App\Models\Administration;
use App\Models\Company;
use App\Models\Employee;
use App\Models\EmployeeMeasure;
use App\Models\EmployeeMeasureStatus;
use App\Models\Log;
use App\Models\Occupation;
use App\Models\PayroleAccount;
use App\Models\Permession;
use App\Models\Section;
use App\Models\Payslip;
use App\Models\PayslipItem;
use App\Models\Permission;
use App\Models\Setting;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use Illuminate\Support\Facades\Route;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Http;


function activeRoute($routeNames) {
    if(is_array($routeNames)) {
        foreach ($routeNames as $routeName) {
            if(Route::currentRouteName() == $routeName) {
                return true;
            }
        }
    } else {
        if(Route::currentRouteName() == $routeNames) {
            return true;
        }
    }
}

function permession_maker($name, $key, $groupBy) {
    $permession = Permission::where('value', $key)
    ->where('name', $name)
    ->first();
    if($permession) {
        return null;
    } else {
        Permission::create([
            'name' => $name,
            'value' => $key,
            'group_by' => $groupBy
        ]);
    }
}

function paginate($items, $perPage=5, $page=null, $options = []) {
    $page = $page ? : (Paginator::resolveCurrentPage()) ? : 1;
    $items = $items instanceof Collection ? $items : Collection::make($items);
    return new LengthAwarePaginator($items->forPage($page, $perPage), $items->count(), $perPage, $page, $options);
}


function diffHijri($hijri) {
    $hijriDate = Carbon::createFromDate($hijri);
    $yearsBetweened = Carbon::now()->diffInYears($hijriDate);
    return $yearsBetweened;
}



