<?php

namespace App\Http\Controllers;

use App\Models\AccountSeller;
use App\Models\Assignedpickup;
use App\Models\Delivery;
use App\Models\Driver;
use App\Models\Pickup;
use App\Models\PickupHistory;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class AssignedpickupController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->authorize('assigned_pickups.index');
        $pickups = Pickup::latest();

        $drivers = Driver::all();
        $sellers = User::all();

        if(request('status')) {
            $pickups = $pickups->where('status', request('status'));

        }
        if(request('driver_id')) {
            $picks = Delivery::with('driver', 'pickup')->where('driver_id', request('driver_id'))->pluck('pickup_id');
            $pickups = $pickups->whereIn('id', $picks);
        }
        if(request('seller_id')) {
            $pickups = $pickups->where('user_id', request('seller_id'));
        }
        if(request('seller_settled')) {
            if(request('seller_settled') == 2) {
                $seller_settled = 1;
            } else {
                $seller_settled = 0;
            }
            $pickups = $pickups->where('seller_settled', $seller_settled);
        }
        if(request('driver_settled')) {
            if(request('driver_settled') == 2) {
                $driver_settled = 1;
            } else {
                $driver_settled = 0;
            }
            $pickups = $pickups->where('driver_settled', $driver_settled);
        }

        $pickups = $pickups->paginate(10);
        return view('Dashboard.admin.pickup.index', ['pickups' => $pickups, 'drivers' => $drivers, 'sellers' => $sellers]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->authorize('assigned_pickups.assign');
        $pickups = Pickup::where('status', 'requested')->get();
        $driver = Driver::all();
        return view('Dashboard.admin.pickup.assigned', ['pickups' => $pickups, 'driver' => $driver]);
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
            'driver_id' => 'required',
            'arr' => 'required',

        ]);

        $driver = Driver::where('id', $request->input('driver_id'))->get();
        if (!$validator->fails()) {

            Pickup::whereIn('id', $request->arr)->update([
                'status' => 'proccessing'
            ]);

            foreach ($request->arr as $value) {
                $pickup = Pickup::find($value);

                $pickup_history = new PickupHistory();
                $pickup_history->user_id = Auth::id();
                $pickup_history->pickup_id = $pickup->id;
                $pickup_history->status = 'requested';
                $pickup_history->save();

                $assigned = new Delivery();
                $assigned->driver_id = $request->input('driver_id');
                $assigned->pickup_id = $value;

                $accounts = new AccountSeller();
                $accounts->pickup_id = $value;
                $accounts->user_id = $pickup->user_id;
                $accounts->cash = 0;
                $accounts->cost = 0;
                $accounts->seller_commission = $pickup->user->special_pickup;
                $accounts->delivery_commission = $driver[0]->special_pickup;
                $Saved = $accounts->save();
                $isSaved = $assigned->save();
            }


            return response()->json(
                [
                    'message' => $isSaved ? 'Pick up assigned successfully' : 'assigned failed!'
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
     * @param  \App\Models\Assignedpickup  $assignedpickup
     * @return \Illuminate\Http\Response
     */
    public function show(Assignedpickup $assignedpickup)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Assignedpickup  $assignedpickup
     * @return \Illuminate\Http\Response
     */
    public function edit(Assignedpickup $assignedpickup)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Assignedpickup  $assignedpickup
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Assignedpickup $assignedpickup)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Assignedpickup  $assignedpickup
     * @return \Illuminate\Http\Response
     */
    public function destroy(Assignedpickup $assignedpickup)
    {
        //
    }
}
