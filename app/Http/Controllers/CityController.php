<?php

namespace App\Http\Controllers;

use App\Models\Area;
use App\Models\City;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Response;

class CityController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $city = City::all();

        return response()->view('Dashboard.admin.city.index', ['city' => $city]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    }

    /**
     * Store a city created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    //store city
    public function store(Request $request)
    {
        $validator = Validator($request->all(), [
            'city' => 'required|string',
            'rate' => 'required|string|min:1|max:7',

        ]);

        if (!$validator->fails()) {
            $isSaved = City::create([
                'city' => $request->input('city'),
                'rate' => $request->input('rate'),
            ]);
            return response()->json(
                [
                    'message' => $isSaved ? 'City created successfully' : 'Create failed!'
                ],
                $isSaved ? Response::HTTP_CREATED : Response::HTTP_BAD_REQUEST,
            );
        } else {
            return response()->json(['message' => $validator->getMessageBag()->first()], Response::HTTP_BAD_REQUEST);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\City  $city
     * @return \Illuminate\Http\Response
     */
    public function show(City $city)
    {

        return view('Dashboard.admin.area.index', ['city' => $city->id, 'area' => $city->areas]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\City  $city
     * @return \Illuminate\Http\Response
     */
    public function edit(City $city)
    {
        return response()->view('Dashboard.admin.city.edit', ['city' => $city]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\City  $city
     * @return \Illuminate\Http\Response
     */
    /* update the city and if the city rate change the
    area rate like city rate will change */
    public function update(Request $request, City $city)
    {

        $area = $city->areas()->where('city_id', $request->id)
            ->where('rate', $request->old_value)->get();
        $validator = Validator($request->all(), [
            'city' => 'required|string',
            'rate' => 'required|string|min:1|max:7',

        ]);

        if (!$validator->fails()) {

            if ($request->old_value == $request->rate) {
                $isSaved = $city->update([
                    'city' => $request->input('city'),
                    'rate' => $request->input('rate'),
                ]);
            } else {
                $isSaved = $city->update([
                    'city' => $request->input('city'),
                    'rate' => $request->input('rate'),
                ]);
                Area::where('city_id', $request->id)
                    ->where('rate', $request->old_value)->update(['rate' => $request->rate]);
            }

            return response()->json(
                [
                    'message' => $isSaved ? 'City created successfully' : 'Create failed!'
                ],
                $isSaved ? Response::HTTP_CREATED : Response::HTTP_BAD_REQUEST,
            );
        } else {
            return response()->json(['message' => $validator->getMessageBag()->first()], Response::HTTP_BAD_REQUEST);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\City  $city
     * @return \Illuminate\Http\Response
     */
    public function destroy(City $city)
    {
        $area = $city->areas()->where('city_id', $city->id)->delete();
        $isDeleted = $city->delete();
        return response()->json(
            ['message' => $isDeleted ? 'Deleted successfully' : 'Delete failed!'],
            $isDeleted ? Response::HTTP_OK : Response::HTTP_BAD_REQUEST
        );
    }
}
