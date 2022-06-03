<?php

namespace App\Http\Controllers;

use App\Models\AccountSeller;
use App\Models\Assignedpickup;
use App\Models\Delivery;
use App\Models\Driver;
use App\Models\Pickup;
use Illuminate\Http\Request;
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
        $assigned = delivery::with('driver', 'pickup')->where('shippment_id', null)->get();
        return view('Dashboard.admin.pickup.index', ['assigned' => $assigned]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $pickup = Pickup::where('status', 'requested')->get();
        $driver = Driver::all();
        return view('Dashboard.admin.pickup.assigned', ['pickup' => $pickup, 'driver' => $driver]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request);

        $validator = Validator($request->all(), [
            'driver_id' => 'required',
            'arr' => 'required',

        ]);
        $driver = Driver::where('id', $request->input('driver_id'))->get();
        $pickup = Pickup::where('id', $request->arr)->get();
        if (!$validator->fails()) {

            foreach ($pickup as $pickup) {
                if ($pickup->status == 'requested') {
                    $pickup->status = 'proccessing';
                    $updated = $pickup->save();
                }
            }

            foreach ($request->arr as $value) {
                $assigned = new Delivery();
                $assigned->driver_id = $request->input('driver_id');
                $assigned->pickup_id = $value;

                $accounts = new AccountSeller();
                $accounts->pickup_id = $value;
                $accounts->cash = 0;
                $accounts->cost = 0;
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
