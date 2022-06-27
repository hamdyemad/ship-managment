<?php

namespace App\Http\Controllers;

use App\Models\Driver;
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
        $roles = Role::where('guard_name', '=', 'driver')->get();
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
            if (!$request->input('special_pickup')) {
                $driver->special_pickup = 10;
            } else {
                $driver->special_pickup = $request->input('special_pickup');
            }

            $driver->password = Hash::make($request->input('password'));
            $isSaved = $driver->save();
            if ($isSaved) {
                $driver->syncRoles(Role::findById($request->input('role_id'), 'driver'));
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
        // $driver = Driver::findOrFail($id);
        $roles = Role::where('guard_name', '=', 'driver')->get();
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
        $validator = Validator($request->all(), [
            'name' => ' max:50',
            'email' => 'string',
            'phone' => 'numeric|digits:11',
            'special_pickup' => 'numeric',
            'role_id' => 'required|numeric|exists:roles,id',

        ]);

        if (!$validator->fails()) {


            $driver->name = $request->input('name');
            $driver->email = $request->input('email') . '@shipexeg.com';
            $driver->phone = $request->input('phone');
            $driver->password = Hash::make($request->input('password'));
            $driver->special_pickup = $request->input('special_pickup');
            $isSaved = $driver->save();
            if ($isSaved) {
                $driver->syncRoles(Role::findById($request->input('role_id'), 'driver'));
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

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Driver  $driver
     * @return \Illuminate\Http\Response
     */
    public function destroy(Driver $driver)
    {
        $isDeleted = $driver->delete();
        return response()->json(
            ['message' => $isDeleted ? 'Deleted successfully' : 'Delete failed!'],
            $isDeleted ? Response::HTTP_OK : Response::HTTP_BAD_REQUEST
        );
    }
}
