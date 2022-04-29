<?php

namespace App\Http\Controllers;

use App\Models\Area;
use App\Models\City;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;


class AreaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    //add area belong to city
    public function store(Request $request)
    {
        $validator = Validator($request->all(), [
            'area' => 'required|string',
            'rate' => 'max:7',
        ]);

        if (!$validator->fails()) {
            if ($request->rate == null) {
                $ratee = City::where('id', $request->city_id)->pluck('rate');
                $isSaved = Area::create([
                    'area' => $request->input('area'),
                    'rate' => $ratee[0],
                    'city_id' => $request->city_id,
                ]);
            } else {
                $isSaved = Area::create([
                    'area' => $request->input('area'),
                    'rate' => $request->input('rate'),
                    'city_id' => $request->city_id,
                ]);
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
     * Display the specified resource.
     *
     * @param  \App\Models\Area  $area
     * @return \Illuminate\Http\Response
     */
    // get area belong to city
    public function show(Request $request)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Area  $area
     * @return \Illuminate\Http\Response
     */
    public function edit(Area $area)
    {
        return response()->view('Dashboard.admin.area.edit', ['area' => $area]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Area  $area
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Area $area)
    {
        $validator = Validator($request->all(), [
            'area' => 'string',
            'rate' => 'max:7',
        ]);

        if (!$validator->fails()) {
            $isSaved = $area->update([
                'area' => $request->input('area'),
                'rate' => $request->input('rate'),

            ]);

            return response()->json(
                [
                    'message' => $isSaved ? 'Area updated successfully' : 'update failed!'
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
     * @param  \App\Models\Area  $area
     * @return \Illuminate\Http\Response
     */
    public function destroy(Area $area)
    {
        //
    }
}
