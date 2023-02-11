<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\Delivery;
use App\Models\Driver;
use App\Models\Shippment;
use App\Models\ShippmentHistory;
use App\Models\ShippmentView;
use App\Models\Tracking;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
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
        $this->authorize('shippments.index');
        $drivers = Driver::all();
        if(Auth::guard('admin')->check() || Auth::guard('employee')->check()) {
            $shipments = Shippment::latest();
            $sellers = User::all();
            if(request('driver_id')) {
                $deliveries = Delivery::where('driver_id', request('driver_id'))->where('shippment_id', '!=',null)->pluck('shippment_id');
                $shipments = $shipments->whereIn('id', $deliveries);
            }
            if(request('seller_id')) {
                $shipments = $shipments->where('user_id', request('seller_id'));
            }
        } else {
            $shipments = Shippment::where('user_id', auth()->user()->id)->latest();
            $sellers = [];
        }

        if(request('barcode')) {
            $shipments = $shipments->where('barcode', 'like' , '%' . request('barcode')  . '%');
        }
        if(request('receiver_name')) {
            $shipments = $shipments->where('receiver_name', 'like' , '%' . request('receiver_name')  . '%');
        }
        if(request('receiver_phone')) {
            $shipments = $shipments->where('receiver_phone', 'like' , '%' . request('receiver_phone')  . '%');
        }

        if(request('shippment_type')) {
            $shipments = $shipments->where('shippment_type', request('shippment_type'));
        }
        if(request('status')) {
            $shipments = $shipments->where('status', request('status'));
        }
        if(request('seller_settled')) {
            if(request('seller_settled') == 2) {
                $seller_settled = 1;
            } else {
                $seller_settled = 0;
            }
            $shipments = $shipments->where('seller_settled', $seller_settled);
        }
        if(request('driver_settled')) {
            if(request('driver_settled') == 2) {
                $driver_settled = 1;
            } else {
                $driver_settled = 0;
            }
            $shipments = $shipments->where('driver_settled', $driver_settled);
        }
        $shipments = $shipments->paginate(20);
        return view('Dashboard.user.shipment.index1', ['shipments' => $shipments, 'sellers' => $sellers,'drivers' => $drivers]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->authorize('shippments.create');
        $sellers = User::all();
        $city = City::all();
        return view('Dashboard.user.shipment.create', ['city' => $city, 'sellers' => $sellers]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->authorize('shippments.create');
        $validator = Validator($request->all(), [
            'shipment_type' => 'required',
            'shipper' => 'required',
            'city' => 'required',
            'user_id' => 'required',
            'area' => 'required',
            'business' => 'required',
            'receiver_name' => 'required',
            'receiver_phone' => 'required|numeric|digits:11',
            'address' => 'required',
            'package' => 'max:150',
            'price' => 'required|numeric',
            'note' => 'max:150',
        ]);
//        $shap_count = Shippment::all()->count();
//        $code = random_int(100000, 999999);



        if (!$validator->fails()) {
            $ship = Shippment::latest()->first();
            if($ship) {
                $code = $ship->barcode +1;
            } else {
                $code = 5000;
            }
            $shipment = new Shippment();
            if ($request->active == 1) {
                $shipment->allow_open = 'true';
            } elseif ($request->active == 0) {
                $shipment->allow_open = 'false';
            }
            $shipment->shippment_type = $request->input('shipment_type');
            $shipment->shipper = $request->input('shipper');
            $shipment->city_id = $request->input('city');
            $shipment->area_id = $request->input('area');
            $shipment->business_referance = $request->input('business');
            $shipment->receiver_name = $request->input('receiver_name');
            $shipment->receiver_phone = $request->input('receiver_phone');
            if(Auth::guard('user')->check()) {
                $shipment->user_id = Auth::guard('user')->user()->id;

            } else {
                $shipment->user_id = $request->input('user_id');
            }
            $shipment->price = $request->input('price');
            $shipment->package_details = $request->input('package_details');
            $shipment->address = $request->input('address');
            $shipment->note = $request->input('note');
            $shipment->status = 'created';
            $shipment->barcode = $code;
            $isSaved = $shipment->save();

            if(Auth::guard('employee')->check()) {
                $shippment_history = new ShippmentHistory();
                $shippment_history->user_id = Auth::id();
                $shippment_history->shippment_id = $shipment->id;
                $shippment_history->status = 'created';
                $shippment_history->save();
            }

            $tracking = new Tracking();
            $tracking->shippment_id = $shipment->id;
            $tracking->user_id = Auth::id();;
            if(Auth::guard('admin')->check()) {
                $tracking->user_type = 'admin';
            } else if(Auth::guard('employee')->check()) {
                $tracking->user_type = 'employee';

            } elseif(Auth::guard('user')->check()) {
                $tracking->user_type = 'user';

            } elseif(Auth::guard('driver')->check()) {
                $tracking->user_type = 'driver';
            }
            $tracking->status = $shipment->status;
            $Saved = $tracking->save();
            return response()->json(
                [
                    'message' => $isSaved ? 'Shipment created successfully' : 'Create failed!'
                ],
                $isSaved ? Response::HTTP_CREATED : Response::HTTP_BAD_REQUEST,
            );
        } else {
            return response()->json(['message' => $validator->getMessageBag()->first(),'errors' => $validator->errors() ], Response::HTTP_BAD_REQUEST);
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
        $this->authorize('shippments.show');
        $shipment = Shippment::findOrFail($id);
        return  view('Dashboard.user.shipment.show', ['shippment' => $shipment]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Shippment  $shippment
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $this->authorize('shippments.edit');
        $shipment = Shippment::findOrFail($id);
        $sellers = User::all();
        $city = City::all();
        return view('Dashboard.user.shipment.edit', ['city' => $city, 'sellers' => $sellers, 'shipment' => $shipment]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Shippment  $shippment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->authorize('shippments.edit');
        $validator = Validator($request->all(), [
            'shipment_type' => 'required',
            'shipper' => 'required',
            'city' => 'required',
            'area' => 'required',
            'business' => 'required',
            'receiver_name' => 'required',
            'receiver_phone' => 'required|numeric|digits:11',
            'address' => 'required',
            'package' => 'max:150',
            'price' => 'required|numeric',
            'note' => 'max:150',
        ]);
        if (!$validator->fails()) {
            $shipment = Shippment::findOrFail($id);
            if ($request->active == 1) {
                $shipment->allow_open = 'true';
            } elseif ($request->active == 0) {
                $shipment->allow_open = 'false';
            }
            $shipment->shippment_type = $request->input('shipment_type');
            $shipment->shipper = $request->input('shipper');
            $shipment->city_id = $request->input('city');
            $shipment->area_id = $request->input('area');
            $shipment->business_referance = $request->input('business');
            $shipment->receiver_name = $request->input('receiver_name');
            $shipment->receiver_phone = $request->input('receiver_phone');
            $shipment->user_id = $request->input('user_id');
            $shipment->price = $request->input('price');
            $shipment->package_details = $request->input('package');
            $shipment->address = $request->input('address');
            $shipment->note = $request->input('note');
            $isSaved = $shipment->save();
            return response()->json(
                [
                    'message' => $isSaved ? 'Shipment updated successfully' : 'Create failed!'
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
     * @param  \App\Models\Shippment  $shippment
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->authorize('shippments.destroy');
        $shippment = Shippment::findOrFail($id);
        if ($shippment->status == "created") {
            $isDeleted = $shippment->delete();
            return redirect()->back()->with('success', __('site.delete'));
        } else {
            return redirect()->back()->with('error','Delete failed!');
        }
    }
}
