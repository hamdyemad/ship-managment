<?php

namespace App\Http\Controllers;

use App\Models\Driver;
use App\Models\Scheduledriver;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ScheduledriverController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(Auth::guard('admin')->check() || Auth::guard('employee')->check()) {
            $schedules = Scheduledriver::with('driver')->latest()->get();
            $drivers = Driver::all();
        } else if(Auth::guard('driver')->check()) {
            $schedules = Scheduledriver::with('driver')->where('driver_id', Auth::id())->latest()->get();
            $drivers = [];
        }
        return view('Dashboard.admin.accountfiledriver', ['schedules' => $schedules, 'drivers' => $drivers]);
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Scheduledriver  $scheduledriver
     * @return \Illuminate\Http\Response
     */
    public function show(Scheduledriver $scheduledriver)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Scheduledriver  $scheduledriver
     * @return \Illuminate\Http\Response
     */
    public function edit(Scheduledriver $scheduledriver)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Scheduledriver  $scheduledriver
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Scheduledriver $scheduledriver)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Scheduledriver  $scheduledriver
     * @return \Illuminate\Http\Response
     */
    public function destroy(Scheduledriver $scheduledriver)
    {
        //
    }
}
