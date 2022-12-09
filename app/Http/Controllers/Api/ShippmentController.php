<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Shippment;
use App\Models\ShippmentHistory;
use App\Models\Tracking;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use App\Traits\Res;

class ShippmentController extends Controller
{
    use Res;
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
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $validator = Validator($request->all(), [
            'shipment_type' => 'required',
            'shipper' => 'required',
            'city_id' => 'required|exists:cities,id',
            'area_id' => 'required|exists:areas,id',
            'business' => 'required',
            'receiver_name' => 'required',
            'receiver_phone' => 'required|numeric|digits:11',
            'address' => 'required',
            'package' => 'max:150',
            'price' => 'required|numeric',
            'note' => 'max:150',
            'allow_open' => 'required|in:true,false',
        ]);
        if (!$validator->fails()) {
            $shipment = new Shippment();
            $shipment->allow_open = $request->input('allow_open');
            $shipment->shippment_type = $request->input('shipment_type');
            $shipment->shipper = $request->input('shipper');
            $shipment->city_id = $request->input('city_id');
            $shipment->area_id = $request->input('area_id');
            $shipment->business_referance = $request->input('business');
            $shipment->receiver_name = $request->input('receiver_name');
            $shipment->receiver_phone = $request->input('receiver_phone');

            $shipment->price = $request->input('price');
            $shipment->package_details = $request->input('package_details');
            $shipment->address = $request->input('address');
            $shipment->note = $request->input('note');
            $shipment->status = 'created';
            $shipment->barcode = random_int(100000, 999999);
            $shipment->user_id =  Auth::id();
            $shipment->package_details = $request->input('package_details');
            $isSaved = $shipment->save();


            $tracking = new Tracking();
            $tracking->shippment_id = $shipment->id;
            $tracking->user_id = Auth::id();;
            $tracking->user_type = 'user';
            $tracking->status = $shipment->status;
            $Saved = $tracking->save();
            return $this->sendRes('done',true, $shipment);

        } else {
            return $this->sendRes('error',false, $validator->errors());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
