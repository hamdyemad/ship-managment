<?php

namespace App\Http\Controllers;

use App\Models\Address;
use App\Models\City;
use App\Models\User;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;


class AddressController extends Controller
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
    public function store(Request $request)
    {
        $validator = Validator($request->all(), [
            'address_line' => 'required|min:3|max:150',
            'city' => 'required',
            'area' => 'required',
            'building' => 'required',
            'floor' => 'required',
            'apartment' => 'required',
            'contact_name' => 'required',
            'contact_mobile' => 'required',
        ]);

        if (!$validator->fails()) {
            $address = new Address();
            $address->address_line = $request->input('address_line');
            $address->city_id = $request->input('city');
            $address->area_id = $request->input('area');
            $address->user_id = $request->input('user_id');
            $address->building = $request->input('building');
            $address->floor = $request->input('floor');
            $address->apartment = $request->input('apartment');
            $address->contact_name = $request->input('contact_name');
            $address->contact_phone = $request->input('contact_mobile');
            $address->contact_email = $request->input('contact_email');
            $isSaved = $address->save();
            return response()->json(
                [
                    'message' => $isSaved ? 'address created successfully' : 'Create failed!'
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
     * @param  \App\Models\Address  $address
     * @return \Illuminate\Http\Response
     */
    public function show(Address $address)
    {
        // $city = City::all();
        // return view('Dashboard.user.settings');
    }


    public function addresses(Request $request) {
        $addresses = Address::where('user_id', $request->user_id)->get();
        if(count($addresses) > 0) {
            return response()->json(['success' => 1,'data' => $addresses]);
        } else {
            return response()->json(['message' => 'seller has no addresses']);

        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Address  $address
     * @return \Illuminate\Http\Response
     */
    public function edit(Address $address)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Address  $address
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Address $address)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Address  $address
     * @return \Illuminate\Http\Response
     */
    public function destroy(Address $address)
    {
        //
    }
}
