<?php

namespace App\Http\Controllers;

use App\Models\Address;
use App\Models\City;
use App\Models\Pickup;
use App\Models\Shippment;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Response;


class PickupController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $pickup = Pickup::where('user_id', auth()->user()->id)->get();
        return view('Dashboard.user.pickup.index', ['pickup' => $pickup]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $address = Address::where('user_id', auth()->user()->id)->get();
        $shipment = Shippment::where('status', 'created')->count();
        $city = City::all();

        return view('Dashboard.user.pickup.create', ['address' => $address, 'shipment' => $shipment, 'city' => $city]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    //store data pick up and change the shipment status to picked up
    public function store(Request $request)
    {

        $validator = Validator($request->all(), [
            'name' => 'required',
            // 'email' => 'required',
            'phone' => 'required',
            'address' => 'required',
            'time' => 'required',
            'date' => 'required',
            'note' => 'max:150',
        ]);
        $shipment = Shippment::where('user_id', auth()->user()->id)->where('status', 'created')->get();
        if (!$validator->fails()) {
            foreach ($shipment as $shipment) {
                if ($shipment->status == 'created') {
                    $shipment->status = 'requested';
                    $updated = $shipment->save();
                }
            }
            $pickup = new Pickup();
            $pickup->name = $request->input('name');
            $pickup->status = 'requested';
            $pickup->email = $request->input('email');
            $pickup->phone = $request->input('phone');
            $pickup->address_id = $request->input('address');
            $pickup->time = Carbon::parse($request->input('time'));
            $pickup->date = Carbon::parse($request->input('date'));
            $pickup->user_id = $request->input('user_id');
            $pickup->note = $request->input('note');
            $pickup->package = $request->input('package');
            $isSaved = $pickup->save();

            return response()->json(
                [
                    'message' => $isSaved ? 'Pick up created successfully' : 'Create failed!'
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
     * @param  \App\Models\Pickup  $pickup
     * @return \Illuminate\Http\Response
     */
    public function show(Pickup $pickup)
    {

        $pickups = Pickup::findOrFail($pickup->id);
        return view('Dashboard.user.pickup.show', ['pickup' => $pickups]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Pickup  $pickup
     * @return \Illuminate\Http\Response
     */
    public function edit(Pickup $pickup)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Pickup  $pickup
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Pickup $pickup)
    {
        $pickup->status = 'pickedup';
        $isSaved = $pickup->save();

        return response()->json(
            [
                'message' => $isSaved ? 'Pick up delivered successfully' : 'delivered failed!'
            ],
            $isSaved ? Response::HTTP_CREATED : Response::HTTP_BAD_REQUEST,
        );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Pickup  $pickup
     * @return \Illuminate\Http\Response
     */
    public function destroy(Pickup $pickup)
    {
        //
    }
}
