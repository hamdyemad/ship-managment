<?php

namespace App\Http\Controllers;

use App\Models\AccountSeller;
use App\Models\Shippment;
use App\Models\User;
use Illuminate\Http\Request;

class AccountSellerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $status = ['delivered', 'rejected', 'rejected_fees_faid'];
        $shipments = Shippment::with('accountseller', 'city', 'area', 'user')->whereIn('status', $status)->get();
        $users = User::all();
        return view('Dashboard.admin.accountseller', ['shipment' => $shipments, 'users' => $users]);
        // dd($shipments[1]->user->id);
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
     * @param  \App\Models\AccountSeller  $accountSeller
     * @return \Illuminate\Http\Response
     */
    public function show(AccountSeller $accountSeller)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\AccountSeller  $accountSeller
     * @return \Illuminate\Http\Response
     */
    public function edit(AccountSeller $accountSeller)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\AccountSeller  $accountSeller
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, AccountSeller $accountSeller)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\AccountSeller  $accountSeller
     * @return \Illuminate\Http\Response
     */
    public function destroy(AccountSeller $accountSeller)
    {
        //
    }
}
