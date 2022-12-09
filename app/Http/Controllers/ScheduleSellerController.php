<?php

namespace App\Http\Controllers;

use App\Models\ScheduleSeller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ScheduleSellerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sellers = [];
        if(Auth::guard('admin')->check() || Auth::guard('employee')->check()) {
            $schedules = ScheduleSeller::with('user')->latest();
            $sellers = User::all();
        } else if(Auth::guard('user')->check()) {
            $schedules = ScheduleSeller::with('user')->where('user_id', Auth::id())->latest();
        }
        if(request('schedule_id')) {
            $schedules = $schedules->where('id', request('schedule_id'));
        }
        if(request('seller_id')) {
            $schedules = $schedules->whereHas('user', function($user) {
                return $user->where('id', request('seller_id'));
            });
        }
        $schedules = $schedules->paginate(10);
        return view('Dashboard.admin.accountseller.accountfile', ['schedules' => $schedules, 'sellers' => $sellers]);
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
     * @param  \App\Models\ScheduleSeller  $scheduleSeller
     * @return \Illuminate\Http\Response
     */
    public function show(ScheduleSeller $scheduleSeller)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ScheduleSeller  $scheduleSeller
     * @return \Illuminate\Http\Response
     */
    public function edit(ScheduleSeller $scheduleSeller)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ScheduleSeller  $scheduleSeller
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ScheduleSeller $scheduleSeller)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ScheduleSeller  $scheduleSeller
     * @return \Illuminate\Http\Response
     */
    public function destroy(ScheduleSeller $scheduleSeller)
    {
        //
    }
}
