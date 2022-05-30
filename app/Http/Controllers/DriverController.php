<?php

namespace App\Http\Controllers;

use App\Models\Driver;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
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
        return view('Dashboard.admin.driver.create');
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
            'name' => 'required | max:100',
            'email' => 'required|email',
            'phone' => 'required |numeric',
            'password' => 'required',
            'password_confirmation' => 'required',
            // 'special_pickup' => 'numeric',



        ]);
        if (!$validator->fails()) {
            $driver = new Driver();
            $driver->name = $request->input('name');
            $driver->email = $request->input('email');
            $driver->phone = $request->input('phone');
            if (!$request->input('special_pickup')) {
                $driver->special_pickup = 10;
            } else {
                $driver->special_pickup = $request->input('special_pickup');
            }

            $driver->password = Hash::make($request->input('password'));
            $isSaved = $driver->save();
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
        return view('Dashboard.admin.driver.edit', ['driver' => $driver]);
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
            'name' => ' max:100',
            'email' => 'email',
            'phone' => 'numeric',
            'special_pickup' => 'numeric',


        ]);

        if (!$validator->fails()) {


            $driver->name = $request->input('name');
            $driver->email = $request->input('email');
            $driver->phone = $request->input('phone');
            $driver->password = Hash::make($request->input('password'));
            $driver->special_pickup = $request->input('special_pickup');
            $isSaved = $driver->save();


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
