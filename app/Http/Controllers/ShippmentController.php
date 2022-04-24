<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\Shippment;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Milon\Barcode\DNS1D;


class ShippmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $shipment = Shippment::all();
        return view('Dashboard.user.shipment.index1', ['shipment' => $shipment]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $city = City::all();
        return view('Dashboard.user.shipment.create', ['city' => $city]);
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
            'shipment_type' => 'required',
            'city' => 'required',
            'area' => 'required',
            'business' => 'required',
            'receiver_name' => 'required',
            'receiver_phone' => 'required|numeric',
            'address' => 'required',
            'package' => 'max:150',
            'price' => 'required|numeric',
            'note' => 'max:150',
        ]);
        $code = random_int(100000, 999999);
        if (!$validator->fails()) {
            $shipment = new Shippment();
            $shipment->shippment_type = $request->input('shipment_type');
            $shipment->city_id = $request->input('city');
            $shipment->area_id = $request->input('area');
            $shipment->business_referance = $request->input('business');
            $shipment->receiver_name = $request->input('receiver_name');
            $shipment->receiver_phone = $request->input('receiver_phone');
            $shipment->user_id = $request->input('user_id');
            $shipment->price = $request->input('price');
            $shipment->package_details = $request->input('package_details');
            $shipment->address = $request->input('address');
            $shipment->note = $request->input('note');
            $shipment->status = 'created';
            $shipment->barcode = random_int(100000, 999999);
            $shipment->sku = '33';
            $isSaved = $shipment->save();
            return response()->json(
                [
                    'message' => $isSaved ? 'Shipment created successfully' : 'Create failed!'
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
     * @param  \App\Models\Shippment  $shippment
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

        $shipment = Shippment::findOrFail($id);

        return  view('Dashboard.user.shipment.show', ['shippment' => $shipment]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Shippment  $shippment
     * @return \Illuminate\Http\Response
     */
    public function edit(Shippment $shippment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Shippment  $shippment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Shippment $shippment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Shippment  $shippment
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $shippment = Shippment::findOrFail($id);
        $isDeleted = $shippment->delete();
        return response()->json(
            ['message' => $isDeleted ? 'Deleted successfully' : 'Delete failed!'],
            $isDeleted ? Response::HTTP_OK : Response::HTTP_BAD_REQUEST
        );
    }
}
