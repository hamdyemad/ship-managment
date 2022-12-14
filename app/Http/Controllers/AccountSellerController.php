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
        $this->authorize('accounts_seller.index');
        if(Auth::guard('admin')->check() || Auth::guard('employee')->check() ) {
            $accounts = AccountSeller::with('shippment', 'pickup')->latest();
            $sellers = User::all();
        } else if(Auth::guard('user')->check()) {
            $accounts = AccountSeller::with('shippment', 'pickup')->where('user_id', Auth::id())->latest();
            $sellers = [];
        }
        if(request('settled_id')) {
            $accounts = $accounts->where('id', request('settled_id'));
        }
        if(request('shippment_code')) {
            $accounts =  $accounts->whereHas('shippment', function($shipment) {
                return $shipment->where('barcode', request('shippment_code'));
            });
        }

        if(request('shippment_type')) {
            $accounts =  $accounts->whereHas('shippment', function($shipment) {
                return $shipment->where('shippment_type', request('shippment_type'));
            });
        }

        if(request('seller_settled')) {
            $settled = 0;
            if(request('seller_settled') == '2') {
                $settled = 1;
            }
            $accounts =  $accounts->whereHas('shippment', function($shipment) use($settled) {
                return $shipment->where('seller_settled', $settled);
            });
        }
        if(request('shippment_status')) {
            $accounts =  $accounts->whereHas('shippment', function($shipment) {
                return $shipment->where('status', request('shippment_status'));
            });
        }
        $accounts = $accounts->paginate(10);
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
