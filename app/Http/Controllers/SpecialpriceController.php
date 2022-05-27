<?php

namespace App\Http\Controllers;

use App\Models\Specialprice;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SpecialpriceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
    public function store(Request $request)
    {
        $validator = Validator($request->all(), [

            'city_id' => 'required',
            'area_id' => 'required',
            'special_price' => 'required',
        ]);

        if (!$validator->fails()) {
            $specialprice = new Specialprice();
            $specialprice->user_id = $request->user_id;
            $specialprice->city_id = $request->input('city_id');
            $specialprice->area_id = $request->input('area_id');
            $specialprice->special_price = $request->input('special_price');
            $isSaved = $specialprice->save();
            return response()->json(
                [
                    'message' => $isSaved ? 'User created successfully' : 'Create failed!'
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
     * @param  \App\Models\Specialprice  $specialprice
     * @return \Illuminate\Http\Response
     */
    public function show(Specialprice $specialprice)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Specialprice  $specialprice
     * @return \Illuminate\Http\Response
     */
    public function edit(Specialprice $specialprice)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Specialprice  $specialprice
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Specialprice $specialprice)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Specialprice  $specialprice
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $specialprice = Specialprice::findOrFail($id);
        $isDeleted = $specialprice->delete();
        return response()->json(
            ['message' => $isDeleted ? 'Deleted successfully' : 'Delete failed!'],
            $isDeleted ? Response::HTTP_OK : Response::HTTP_BAD_REQUEST
        );
    }
}
