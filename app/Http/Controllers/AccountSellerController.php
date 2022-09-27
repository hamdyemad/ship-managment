<?php

namespace App\Http\Controllers;

use App\Models\AccountSeller;
use App\Models\Shippment;
use App\Models\Specialprice;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AccountSellerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        if(Auth::guard('admin')->check() || Auth::guard('employee')->check() ) {
            $accounts = AccountSeller::with('shippment', 'pickup')->latest()->get();
            $sellers = User::all();
        } else if(Auth::guard('user')->check()) {
            $accounts = AccountSeller::with('shippment', 'pickup')->where('user_id', Auth::id())->latest()->get();
            $sellers = [];
        }
        return view('Dashboard.admin.accountseller.accountsellers', ['accounts' => $accounts, 'sellers' => $sellers]);
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
