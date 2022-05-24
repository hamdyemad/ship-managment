<?php

namespace App\Http\Controllers;

use App\Models\ScheduleSeller;
use Illuminate\Http\Request;

class ScheduleSellerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $accountsfile = ScheduleSeller::with('user')->get();
        // dd($accountsfile);
        return view('Dashboard.admin.accountfile', ['accounts' => $accountsfile]);
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
