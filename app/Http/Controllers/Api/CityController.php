<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\City;
use Illuminate\Http\Request;
use App\Traits\Res;

class CityController extends Controller
{
    use Res;

    public function index() {
        $cities = City::latest()->get();
        return $this->sendRes('', true, $cities);
    }
}
