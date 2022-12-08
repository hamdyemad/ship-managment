<?php

namespace App\Http\Controllers;

use App\Models\Delivery;
use App\Models\Driver;
use App\Models\Shippment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use Symfony\Component\HttpFoundation\Response;

class DriverController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->authorize('drivers.index');
        $driver = Driver::all();
        return view('Dashboard.admin.driver.index', ['driver' => $driver]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->authorize('drivers.create');
        $roles = Role::all();
        return view('Dashboard.admin.driver.create', ['roles' => $roles]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->authorize('drivers.create');
        $validator = Validator($request->all(), [
            'name' => 'required | max:50',
            'email' => 'required|string | min:2 |max:20',
            'phone' => 'required |numeric|digits:11',
            'password' => 'required',
            'password_confirmation' => 'required',
            'role_id' => 'required|numeric|exists:roles,id',

        ]);
        if (!$validator->fails()) {
            $driver = new Driver();
            $driver->name = $request->input('name');
            $driver->email = $request->input('email') . '@shipexeg.com';
            $driver->phone = $request->input('phone');
            $driver->balance = $request->input('balance');
            if (!$request->input('special_pickup')) {
                $driver->special_pickup = 0;
            } else {
                $driver->special_pickup = $request->input('special_pickup');
            }

            $driver->password = Hash::make($request->input('password'));
            $isSaved = $driver->save();
            if ($isSaved) {
                $driver->roles()->attach($request->role_id);
            }
            return response()->json(
                [
                    'message' => $isSaved ? 'driver created successfully' : 'Create failed!'
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
     * @param  \App\Models\Driver  $driver
     * @return \Illuminate\Http\Response
     */
    public function show(Driver $driver)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Driver  $driver
     * @return \Illuminate\Http\Response
     */
    public function edit(Driver $driver)
    {
        $this->authorize('drivers.edit');
        // $driver = Driver::findOrFail($id);
        $roles = Role::all();
        return view('Dashboard.admin.driver.edit', ['driver' => $driver, 'roles' => $roles]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Driver  $driver
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Driver $driver)
    {
        $this->authorize('drivers.edit');
        $rules = [
            'name' => ' max:50',
            'email' => 'string',
            'phone' => 'numeric|digits:11',
            'special_pickup' => 'numeric',
            'role_id' => 'required|numeric|exists:roles,id',
        ];
        if($request->password) {
            $rules['password'] = ['min:8', 'confirmed'];
        }
        $validator = Validator($request->all(), $rules);


        if (!$validator->fails()) {
            $driver->name = $request->input('name');
            $driver->email = $request->input('email') . '@shipexeg.com';
            $driver->phone = $request->input('phone');
            $driver->password = Hash::make($request->input('password'));
            $driver->special_pickup = $request->input('special_pickup');
            $isSaved = $driver->save();
            if ($isSaved) {
                $driver->roles()->detach();
                $driver->roles()->attach($request->role_id);
            }

            return response()->json(
                [
                    'message' => $isSaved ? 'driver updated successfully' : 'Create failed!'
                ],
                $isSaved ? Response::HTTP_CREATED : Response::HTTP_BAD_REQUEST,
            );
        } else {
            return response()->json(['message' => $validator->getMessageBag()->first()], Response::HTTP_BAD_REQUEST);
        }
    }


    public function AssignShippments(Request $request) {
        if($request->shippment) {
            foreach($request->shippment as $shippment) {
                $shipModel = Shippment::find($shippment);
                $shipModel->driver_changed = 0;
                $shipModel->save();
                $delivery = Delivery::where([
                    'shippment_id' => $shippment
                ])->first();
                if($delivery) {
                    $delivery->update([
                        'driver_id' => $request->driver
                    ]);
                } else {
                    Delivery::create([
                        'shippment_id' => $shippment,
                        'driver_id' => $request->driver
                    ]);
                }
            }
            return redirect()->back()->with('success', 'success');
        } else {
            return redirect()->back()->with('success', 'choose shippments');
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Driver  $driver
     * @return \Illuminate\Http\Response
     */
    public function destroy(Driver $driver)
    {
        $this->authorize('drivers.destroy');
        $isDeleted = $driver->delete();
        return response()->json(
            ['message' => $isDeleted ? 'Deleted successfully' : 'Delete failed!'],
            $isDeleted ? Response::HTTP_OK : Response::HTTP_BAD_REQUEST
        );
    }
}
