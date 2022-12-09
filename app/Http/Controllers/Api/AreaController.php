<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Area;
use App\Models\City;
use Illuminate\Http\Request;
use App\Traits\Res;

class AreaController extends Controller
{
    use Res;

    public function areas($id) {
        $areas = Area::where('city_id', $id)->latest()->get();
        return $this->sendRes('', true, $areas);
    }
}
