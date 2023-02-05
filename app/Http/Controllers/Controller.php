<?php

namespace App\Http\Controllers;

use App\Exports\ShippmentsExport;
use App\Imports\ShippmentImport;
use App\Models\AccountSeller;
use App\Models\Address;
use App\Models\Area;
use App\Models\City;
use App\Models\Delivery;
use App\Models\Driver;
use App\Models\Employee;
use App\Models\Permission;
use App\Models\Pickup;
use App\Models\Scheduledriver;
use App\Models\ScheduleSeller;
use App\Models\Shippment;
use App\Models\ShippmentHistory;
use App\Models\Specialprice;
use App\Models\ShippmentView;

use App\Models\Tracking;
use App\Models\User;
use App\Traits\Res;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Facades\Excel;
use Milon\Barcode\PDF417;
use Mpdf\Mpdf;
use PDF;


class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests, Res;

    function index()
    {
        if(Auth::guard('user')->user()) {
            $city = City::all();
            return view('Dashboard.user.settings', ['city' => $city]);
        } else {
            return redirect()->back()->with('error', __('site.error'));
        }
    }

    function fetch(Request $request)
    {

        $select = $request->get('select');
        $value = $request->get('value');
        $dependent = $request->get('dependent');
        $data = Area::where('city_id', $value)->get();

        $output = '<option value="">Select ' . ucfirst($dependent) . '</option>';
        foreach ($data as $row) {
            $output .= '<option value="' . $row->id . '">' . $row->area . '</option>';
        }
        echo $output;
    }

    function fetch2(Request $request)
    {

        $select = $request->get('select');
        $value = $request->get('value');
        $dependent = $request->get('dependent');
        $data = Address::where('id', $value)->get();

        $output = "";

        foreach ($data as $row) {
            $output .= '<input name="name" class="form-control form-control-lg form-control-solid" id="contact_name" value="' . $row->contact_name . '">';
            $output .= '<div class="row mb-6">';
            $output .= '<div class="col-lg-12">';
            $output .= '<div class="row">';
            $output .= ' <div class="col-lg-6 fv-row">
                                <label class="col-lg-4 col-form-label fw-bold fs-6">email</label>
                                <input type="text" id="email" name="email" value="' . $row->contact_email . '" class="form-control form-control-lg form-control-solid dynamic">
                            </div>';
            $output .= '<div class="col-lg-6 fv-row">
                                <label for="phone" class="col-lg-4 col-form-label fw-bold fs-6">phone</label>
                                <input type="text" id="phone" name="phone" value="' . $row->contact_phone . '"
                                    class="form-control form-control-lg form-control-solid dynamic">

                            </div>';
            // $output .= '<input name="name" class="form-control form-control-lg form-control-solid" id="name" value="' . $row->contact_name . '">';
            // $output .= '<input name="name" class="form-control form-control-lg form-control-solid" id="name" value="' . $row->contact_name . '">';
            $output .= '</div>';
            $output .= '</div>';
            $output .= '</div>';
        }
        echo $output;
    }

    //download special shipment
    function download($id)
    {

        $show = Shippment::findOrFail($id);
        $mpdf = new Mpdf();
        $mpdf->autoScriptToLang = true;
        $mpdf->autoLangToFont = true;
        $mpdf->WriteHTML(view('Dashboard.user.shipment.pdf', compact('show'))->render());
        return $mpdf->Output();
    }

    //download pdf for all shippments and pick up
    function index1(Request $req)
    {
        if($req->export_by_date) {
            $from = $req->input('from');
            $to   = $req->input('to');
            $pickup = [];
            $shippment = [];
            $validator = Validator($req->all(), [
                'from' => 'required',
                'to' => 'required ',
            ]);
            if (!$validator->fails()) {
                if(Auth::guard('admin')->check() || Auth::guard('employee')->check()) {
                    $show = Shippment::whereDate('created_at', '>=', $from)
                        ->whereDate('created_at', '<=', $to)->latest()->get();
                } else if(Auth::guard('driver')->check()) {
                    $assignedShippments = Delivery::where('shippment_id', '!=', null)->where('driver_id', Auth::id())->pluck('shippment_id');
                    $show = Shippment::whereIn('id', $assignedShippments)
                    ->whereDate('created_at', '>=', $from)
                    ->whereDate('created_at', '<=', $to)->latest()->get();
                } else if(Auth::guard('user')->check()) {
                    $show = Shippment::whereDate('created_at', '>=', $from)
                        ->whereDate('created_at', '<=', $to)->where('user_id', Auth::guard('user')->user()->id)->latest()->get();
                }
                return view('Dashboard.user.shipment.execlshippment', ['show' => $show]);
            } else {
                return redirect()->back()->withErrors(
                    ['withErrors' => 'error in form'],
                    Response::HTTP_BAD_REQUEST
                );
            }
        } else if($req->print) {
            $validator = Validator($req->all(), [
                'shippment' => 'required'
            ]);
            if (!$validator->fails()) {
                if(Auth::guard('admin')->check() || Auth::guard('employee')->check()) {
                    $shippments = Shippment::whereIn('id',$req->shippment)->latest()->get();
                } else if(Auth::guard('driver')->check()) {
                    $assignedShippments = Delivery::where('shippment_id', '!=', null)->where('driver_id', Auth::id())->pluck('shippment_id');
                    $sshippmentshow = Shippment::whereIn('id', $assignedShippments)->whereIn('id', $req->shippment)->latest()->get();
                } else if(Auth::guard('user')->check()) {
                    $shippments = Shippment::whereIn('id', $req->shippment)
                    ->where('user_id', Auth::guard('user')->user()->id)
                    ->latest()->get();

                }
                $mpdf = new Mpdf();
                $mpdf->autoScriptToLang = true;
                $mpdf->autoLangToFont = true;
                foreach($shippments as $show) {
                    $mpdf->AddPage();
                    $mpdf->WriteHTML(view('Dashboard.user.shipment.pdf', compact('show'))->render());
                }
                return $mpdf->Output();
            } else {
                return redirect()->back()->with('error', 'you should choose shippments');
            }
        } else if($req->status) {
            $validator = Validator($req->all(), [
                'shippment' => 'required'
            ]);
            if (!$validator->fails()) {
                if(Auth::guard('admin')->check() || Auth::guard('employee')->check()) {
                    $shippments = Shippment::whereIn('id',$req->shippment)->latest()->get();
                } else if(Auth::guard('driver')->check()) {
                    $assignedShippments = Delivery::where('shippment_id', '!=', null)->where('driver_id', Auth::id())->pluck('shippment_id');
                    $sshippmentshow = Shippment::whereIn('id', $assignedShippments)->whereIn('id', $req->shippment)->latest()->get();
                } else if(Auth::guard('user')->check()) {
                    $shippments = Shippment::whereIn('id', $req->shippment)
                    ->where('user_id', Auth::guard('user')->user()->id)
                    ->latest()->get();

                }
                // return $shippments;
                foreach($shippments as $shippment) {
                    $req['shipment_id'] = $shippment->id;
                    $this->status_flow($req);
                }
                return redirect()->back()->with('success', 'done !');

            } else {
                return redirect()->back()->with('error', 'you should choose shippments');
            }
        } else {
            $validator = Validator($req->all(), [
                'shippment' => 'required'
            ]);
            if (!$validator->fails()) {
                if(Auth::guard('admin')->check() || Auth::guard('employee')->check()) {
                    $show = Shippment::whereIn('id', $req->shippment)->latest()->get();
                } else if(Auth::guard('driver')->check()) {
                    $assignedShippments = Delivery::where('shippment_id', '!=', null)->where('driver_id', Auth::id())->pluck('shippment_id');
                    $show = Shippment::whereIn('id', $assignedShippments)->whereIn('id', $req->shippment)->latest()->get();
                } else if(Auth::guard('user')->check()) {
                    $show = Shippment::whereIn('id', $req->shippment)
                    ->where('user_id', Auth::guard('user')->user()->id)
                    ->latest()->get();

                }
                return view('Dashboard.user.shipment.execlshippment', ['show' => $show]);
            } else {
                return redirect()->back()->with('error', 'you should choose shippments');
            }
        }

    }

    public function settlement_sellers(Request $request) {
        $validator = Validator($request->all(), [
            'seller_id' => 'required ',
            'from' => 'required',
            'to' => 'required ',
        ]);

        if (!$validator->fails()) {
            $fromdate =  Carbon::parse($request->input('from'));
            $todate  = Carbon::parse($request->input('to'));
            $user_id_req = $request->input('seller_id');
            $shippments = AccountSeller::with('shippment')
                ->whereDate('created_at', '>=', $fromdate)
                ->whereDate('created_at', '<=', $todate)
                ->whereNotNull('shippment_id')
                ->where('user_id', $user_id_req)
                ->whereHas('shippment', function($query) {
                    $query->where('seller_settled', 0);
                })
                ->get();
            $pickups = AccountSeller::with('pickup')
                ->whereDate('created_at', '>=', $fromdate)
                ->whereDate('created_at', '<=', $todate)
                ->whereNotNull('pickup_id')
                ->where('user_id', $user_id_req)
                ->whereHas('pickup', function($query) {
                    $query->where('seller_settled', 0);
                })
                ->get();
            $show = $shippments->merge($pickups);

            $totalcost = [];
            $seller_commission = [];
            if(count($show) > 0) {
                foreach ($show as $value) {
                    if($value->shippment) {
                        $value->shippment->seller_settled = 1;
                        $value->shippment->save();

                    } else if($value->pickup) {
                        $value->pickup->seller_settled = 1;
                        $value->pickup->save();
                    }
                    array_push($totalcost, $value->cost);
                    array_push($seller_commission, $value->seller_commission);
                }
                $total = (array_sum($totalcost) + intval($request->additional)) - array_sum($seller_commission);
                ScheduleSeller::firstOrCreate([
                    'user_id' => $user_id_req,
                    'from' => $request->from,
                    'to' => $request->to,
                    'price' => (array_sum($totalcost) - array_sum($seller_commission)),
                    'additional_price' => $request->additional,
                    'description' => $request ->description,
                    'costs' => $total
                ]);
                $seller = User::find($user_id_req);
                $seller->balance += $total;
                $seller->save();
                return redirect()->to(route('ScheduleSeller.index'))->with('success', __('site.save_changes'));
            } else {
                return redirect()->back()->with('error', 'there is no data');
            }

        } else {
            return redirect()->back()->withErrors(
                ['withErrors' => 'error in form'],
                Response::HTTP_BAD_REQUEST
            );
        }
    }
    // print pdf the shippment from to for special user
    function accountsellerpdf(Request $req)
    {
        $validator = Validator($req->all(), [
            'seller_id' => 'required',
            'from' => 'required',
            'to' => 'required',
        ]);

        if (!$validator->fails()) {
            $fromdate =  Carbon::parse($req->input('from'));
            $todate  = Carbon::parse($req->input('to'));
            $user_id_req = $req->input('seller_id');
            $shippments = AccountSeller::with('shippment')
                ->whereDate('created_at', '>=', $fromdate)
                ->whereDate('created_at', '<=', $todate)
                ->whereNotNull('shippment_id')
                ->where('user_id', $user_id_req)
                ->whereHas('shippment', function($query) {
                    $query->where('seller_settled', 0);
                })
                ->get();
            $pickups = AccountSeller::with('pickup')
                ->whereDate('created_at', '>=', $fromdate)
                ->whereDate('created_at', '<=', $todate)
                ->whereNotNull('pickup_id')
                ->where('user_id', $user_id_req)
                ->whereHas('pickup', function($query) {
                    $query->where('seller_settled', 0);
                })
                ->get();
            $show = $shippments->merge($pickups);
            $totalcost = [];
            $seller_commission = [];
            foreach ($show as $value) {
                array_push($totalcost, $value->cost);
                array_push($seller_commission, $value->seller_commission);
            }
            $total = array_sum($totalcost) - array_sum($seller_commission);
            return view('Dashboard.admin.accountseller.printtable', ['show' => $show, 'total' => $total]);

        } else {
            return redirect()->back()->withErrors(
                ['withErrors' => 'error in form'],
                Response::HTTP_BAD_REQUEST
            );
        }

    }
    // print pdf the shippment from to
    function accountseller2(Request $req)
    {
        $schedule = ScheduleSeller::find($req->schedule_id);
        $from =  Carbon::parse($schedule->from);
        $to   = Carbon::parse($schedule->to);
        $user_id = $schedule->user_id;
        $seller = User::find($user_id);
        $shippments = AccountSeller::with('shippment')
        ->whereDate('created_at', '>=', $from)
        ->whereDate('created_at', '<=', $to)
        ->whereNotNull('shippment_id')
        ->where('user_id', $user_id)
        ->get();
        $pickups = AccountSeller::with('pickup')
            ->whereDate('created_at', '>=', $from)
            ->whereDate('created_at', '<=', $to)
            ->whereNotNull('pickup_id')
            ->where('user_id', $user_id)
            ->get();
        $show = $shippments->merge($pickups);
        $pdf = PDF::loadView('Dashboard.admin.accountseller.printtablesed', [], [
            'show' => $show,
            'schedule' => $schedule,
            'seller' => $seller
        ], [
            'orientation' => 'L'
        ]);
        return $pdf->stream('/pdfs/document.pdf');
    }
    // get all shipment with driver to admin with advanced search
    function getshipment()
    {
        $delivery = Delivery::with('driver', 'shippment')->get();
        // dd($delivery[1]->shippment->user->name);
        $drivers = Driver::all();
        return view('Dashboard.admin.search', ['delivery' => $delivery, 'driver' => $drivers]);
    }

    // get one shipment after do scan using driver or emplyee
    function getshipmentscan(Request $request)
    {
        $barcode = $request->sometext;
        if(Auth::guard('admin')->check() || Auth::guard('employee')->check() || Auth::guard('user')->check()) {
            $shippment = Shippment::where('barcode', $barcode)->first();
        } elseif(Auth::guard('driver')->check()) {
            $shippment = Shippment::where('barcode', $barcode)->first();
            $delivery = Delivery::where('driver_id', Auth::id())->where('shippment_id', $shippment->id)->first();
            if(!$delivery) {
                $shippment = null;
            }
        } else {
            $shippment = null;
        }

        $user_type = '';
        if(Auth::guard('admin')->check())
            $user_type = 'admin';
        elseif(Auth::guard('employee')->check())
            $user_type = 'employee';
        elseif(Auth::guard('driver')->check())
            $user_type = 'driver';
        elseif(Auth::guard('user')->check())
            $user_type = 'user';
        $shippment_view = ShippmentView::where([
            'shippment_id' => $shippment->id,
            'user_id' => Auth::id(),
            'user_type' => $user_type,
        ])->first();
        if(!$shippment_view) {
            ShippmentView::create([
                'shippment_id' => $shippment->id,
                'user_id' => Auth::id(),
                'user_type' => $user_type,
            ]);
        }
        if ($shippment != null) {
            return view('Dashboard.admin.driver.show', ['shippment' => $shippment]);
        } else {

            return redirect()->back()->withErrors(
                [
                    'withErrors' =>  'shippment does not exist'
                ],
            );
        }
    }

    function getshipmentstatus($id)
    {

        $barcode = $id;
        $shippment = Shippment::where('barcode', $id)->first();

        if ($shippment != null) {
            return view('Dashboard.admin.driver.show', ['shippment' => $shippment]);
        } else {

            return redirect()->back()->withErrors(
                [
                    'withErrors' =>  'shippment does not exist'
                ],
            );
        }
    }

    function getshipmentstatusid($id)
    {

        $barcode = $id;
        $shippment = Shippment::where('id', $id)->first();

        if ($shippment != null) {
            return view('Dashboard.admin.driver.show', ['shippment' => $shippment]);
        } else {

            return redirect()->back()->withErrors(
                [
                    'withErrors' =>  'shippment does not exist'
                ],
            );
        }
    }

    // get all drivers and view scan2
    function getdrivers()
    {
        $drivers = Driver::all();
        return view('Dashboard.employee.scan', ['drivers' => $drivers]);
    }

    // show page to scan shippment and change status
    function changeShippmentStatus()
    {
        return view('Dashboard.employee.changeshippment');
    }

    // get shipment after do scan using employee and add driver
    function getshipmentscan2(Request $request)
    {

        $barcodes = array();

        foreach ($request->arr as $key => $value) {

            $barcodes[$key] = $value;
        }

        $shippment = Shippment::whereIn('barcode', $barcodes)->get();


        foreach ($shippment as  $value) {
            $findedDelivery = Delivery::where('shippment_id', $value->id)->first();
            if($findedDelivery) {
                $findedDelivery->delete();
                $isSaved = 1;
            } else {
                $delivery = new Delivery();
                $delivery->driver_id = $request->driver_id;
                $delivery->shippment_id = $value->id;
                $value->status = 'out_for_delivery';
                ShippmentHistory::create([
                    'user_id' => Auth::id(),
                    'status' => 'out_for_delivery',
                    'shippment_id' => $value->id
                ]);
                $update = $value->save();
                $isSaved = $delivery->save();
            }

        }


        return response()->json(
            [
                'message' => $isSaved ? 'Shippment assigned successfully' : 'assigned failed!'
            ],
            $isSaved ? Response::HTTP_CREATED : Response::HTTP_BAD_REQUEST,
        );
    }

    // get shipment after do scan using employee and change status
    function getshipmentscan3(Request $request)
    {
        $barcodes = array();

        foreach ($request->arr as $key => $value) {

            $barcodes[$key] = $value;
        }

        $shippment = Shippment::whereIn('barcode', $barcodes)->get();

        foreach ($shippment as  $value) {
            $value->status = $request->status;
            ShippmentHistory::create([
                'user_id' => Auth::id(),
                'status' => $request->status,
                'shippment_id'=> $value->id
            ]);
            $update = $value->save();
        }

        return response()->json(
            [
                'message' => $update ? 'Shippment changes successfully' : 'change failed!'
            ],
            $update ? Response::HTTP_CREATED : Response::HTTP_BAD_REQUEST,
        );
    }

    // change status using driver
    function changestatue(Request $request)
    {
        $shippment = Shippment::with('city', 'area', 'user')->where('id', $request->shipment_id)->first();
        if(Auth::guard('driver')->user()) {

            if($shippment->driver_changed == 0) {
                $shippment->driver_changed = 1;
            } else {
                return response()->json(
                    [
                        'message' => __('site.can_not_change_staus_again')
                    ],
                    Response::HTTP_BAD_REQUEST
                );
            }

        }
        $delivery = Delivery::with('driver', 'shippment')->where('shippment_id', $request->shipment_id)->first();
        if($shippment->user) {
            $price = Specialprice::where('user_id', $shippment->user->id)->get();
        } else {
            $price = [];
        }
        $shippment->status = $request->status;
        if($request->status == 'onhold') {
            $shippment->on_hold =  $request->date;
            $shippment->note =  $request->note;
        }

        $tracking = new Tracking();
        $tracking->shippment_id = $shippment->id;
        $tracking->user_id = Auth::id();
        if(Auth::guard('admin')->check()) {
            $tracking->user_type = 'admin';
        } else if(Auth::guard('employee')->check()) {
            $tracking->user_type = 'employee';

        } elseif(Auth::guard('user')->check()) {
            $tracking->user_type = 'user';

        } elseif(Auth::guard('driver')->check()) {
            $tracking->user_type = 'driver';
        }
        $tracking->status = $shippment->status;

        ShippmentHistory::create([
            'user_id' => Auth::id(),
            'shippment_id' => $shippment->id,
            'status' => $request->status
        ]);

        if ($request->status == 'delivered') {
            if($shippment->user && $delivery) {
                $accounts = new AccountSeller();
                $accounts->shippment_id = $delivery->shippment->id;
                $accounts->user_id = $shippment->user->id;
                $accounts->cash = $delivery->shippment->price;
                $accounts->delivery_commission = $delivery->driver->special_pickup;
                //cost
                if ($price->isEmpty()) {
                    $accounts->cost = $delivery->shippment->price - $delivery->shippment->area->rate;
                    $accounts->rate = $delivery->shippment->area->rate;
                } else {
                    foreach ($price as $val) {
                        if ($delivery->shippment->city->id == $val->city_id && $delivery->shippment->area->id == $val->area_id) {
                            $accounts->cost = $delivery->shippment->price - $val->special_price;
                            $accounts->rate = $val->special_price;

                        } else {
                            $accounts->cost = $delivery->shippment->price - $delivery->shippment->area->rate;
                            $accounts->rate = $delivery->shippment->area->rate;
                        }
                    }
                }
                //end cost
                $accounts->save();
            }

        } elseif ($request->status == 'delivered' && $delivery->shippment->shippment_type == 'exchange') {
            if($shippment->user && $delivery) {
                $accounts = new AccountSeller();
                $accounts->shippment_id = $shippment->id;
                $accounts->user_id = $shippment->user->id;
                $accounts->cash = 0;
                $accounts->delivery_commission = $delivery->driver->special_pickup;

                if ($price->isEmpty()) {
                    $accounts->cost = 0 - $shippment->area->rate;
                    $accounts->rate = $shippment->area->rate;
                } else {
                    foreach ($price as $val) {
                        if ($shippment->city->id == $val->city_id && $shippment->area->id == $val->area_id) {
                            $accounts->cost = 0 - $val->special_price;
                            $accounts->rate = $val->special_price;
                        } else {
                            $accounts->cost = 0 - $shippment->area->rate;
                            $accounts->rate = $shippment->area->rate;

                        }
                    }
                }
                $accounts->save();
            }
        } elseif ($request->status == 'rejected') {
            if($shippment->user) {
                $accounts = new AccountSeller();
                $accounts->shippment_id = $shippment->id;
                $accounts->user_id = $shippment->user->id;
                $accounts->cash = 0;

                if ($price->isEmpty()) {
                    $accounts->cost = 0 - $shippment->area->rate;
                    $accounts->rate = $shippment->area->rate;
                } else {
                    foreach ($price as $val) {
                        if ($shippment->city->id == $val->city_id && $shippment->area->id == $val->area_id) {
                            $accounts->cost = 0 - $val->special_price;
                            $accounts->rate = $val->special_price;
                        } else {
                            $accounts->cost = 0 - $shippment->area->rate;
                            $accounts->rate = $shippment->area->rate;
                        }
                    }
                }
                $accounts->save();
            }

        } elseif ($request->status == 'rejected_fees_paid') {
            $shippment->rejected_fees_paid =  $request->rejected_fees_paid;
            if($shippment->user && $delivery) {
                $accounts = new AccountSeller();
                $accounts->shippment_id = $shippment->id;
                $accounts->user_id = $shippment->user->id;
                if($delivery->driver) {
                    $accounts->delivery_commission = $delivery->driver->special_pickup;
                }

                if (count($price) == 0) {
                    $accounts->cash = $shippment->area->rate;
                    $accounts->cost = $accounts->cash - $shippment->area->rate;
                    $accounts->rate = $shippment->area->rate;

                } else {
                    foreach ($price as $val) {
                        if ($shippment->city->id == $val->city_id && $shippment->area->id == $val->area_id) {
                            $accounts->cash = $val->special_price;
                            $accounts->cost = $accounts->cash - $val->special_price;
                            $accounts->rate = $val->special_price;

                        } else {
                            $accounts->cash = $shippment->area->rate;
                            $accounts->cost = $accounts->cash - $shippment->area->rate;
                            $accounts->rate = $shippment->area->rate;
                        }
                    }
                }
                $accounts->save();
            }

        }

        elseif ($shippment->shippment_type == 'return_pickup') {
            if($shippment->user && $delivery) {
                $accounts = new AccountSeller();
                $accounts->shippment_id = $shippment->id;
                $accounts->cash = -$shippment->price;
                $accounts->user_id = $shippment->user->id;
                $accounts->delivery_commission = $delivery->driver->special_pickup;


                if ($price->isEmpty()) {
                    $accounts->cost = -$shippment->price - $shippment->area->rate;
                    $accounts->rate = $delivery->shippment->area->rate;
                } else {
                    foreach ($price as $val) {
                        if ($shippment->city->id == $val->city_id && $shippment->area->id == $val->area_id) {
                            $accounts->cost = -$shippment->price - $val->special_price;
                            $accounts->rate = $val->special_price;
                        } else {
                            $accounts->cost = -$shippment->price - $shippment->area->rate;
                            $accounts->rate = $delivery->shippment->area->rate;
                        }
                    }
                }
                $accounts->save();
            }
        }
        $Saved = $tracking->save();
        $isSaved = $shippment->save();
        return response()->json(
            [
                'message' => $isSaved ? 'Status was successfully' : 'change status failed!'
            ],
            $isSaved ? Response::HTTP_CREATED : Response::HTTP_BAD_REQUEST,
        );
    }

    function changestatuemany(Request $request)
    {
        $shippment = Shippment::with('city', 'area', 'user')->where('id', $request->shipment_id)->first();
        if(Auth::guard('driver')->user()) {

            if($shippment->driver_changed == 0) {
                $shippment->driver_changed = 1;
            } else {
                return response()->json(
                    [
                        'message' => __('site.can_not_change_staus_again')
                    ],
                    Response::HTTP_BAD_REQUEST
                );
            }

        }
        $delivery = Delivery::with('driver', 'shippment')->where('shippment_id', $request->shipment_id)->first();
        if($shippment->user) {
            $price = Specialprice::where('user_id', $shippment->user->id)->get();
        } else {
            $price = [];
        }
        $shippment->status = $request->status;
        if($request->status == 'onhold') {
            $shippment->on_hold =  $request->date;
            $shippment->note =  $request->note;
        }

        $tracking = new Tracking();
        $tracking->shippment_id = $shippment->id;
        $tracking->user_id = Auth::id();
        if(Auth::guard('admin')->check()) {
            $tracking->user_type = 'admin';
        } else if(Auth::guard('employee')->check()) {
            $tracking->user_type = 'employee';

        } elseif(Auth::guard('user')->check()) {
            $tracking->user_type = 'user';

        } elseif(Auth::guard('driver')->check()) {
            $tracking->user_type = 'driver';
        }
        $tracking->status = $shippment->status;

        ShippmentHistory::create([
            'user_id' => Auth::id(),
            'shippment_id' => $shippment->id,
            'status' => $request->status
        ]);

        if ($request->status == 'delivered') {
            if($shippment->user && $delivery) {
                $accounts = new AccountSeller();
                $accounts->shippment_id = $delivery->shippment->id;
                $accounts->user_id = $shippment->user->id;
                $accounts->cash = $delivery->shippment->price;
                $accounts->delivery_commission = $delivery->driver->special_pickup;
                //cost
                if ($price->isEmpty()) {
                    $accounts->cost = $delivery->shippment->price - $delivery->shippment->area->rate;
                    $accounts->rate = $delivery->shippment->area->rate;
                } else {
                    foreach ($price as $val) {
                        if ($delivery->shippment->city->id == $val->city_id && $delivery->shippment->area->id == $val->area_id) {
                            $accounts->cost = $delivery->shippment->price - $val->special_price;
                            $accounts->rate = $val->special_price;

                        } else {
                            $accounts->cost = $delivery->shippment->price - $delivery->shippment->area->rate;
                            $accounts->rate = $delivery->shippment->area->rate;
                        }
                    }
                }
                //end cost
                $accounts->save();
            }

        } elseif ($request->status == 'delivered' && $delivery->shippment->shippment_type == 'exchange') {
            if($shippment->user && $delivery) {
                $accounts = new AccountSeller();
                $accounts->shippment_id = $shippment->id;
                $accounts->user_id = $shippment->user->id;
                $accounts->cash = 0;
                $accounts->delivery_commission = $delivery->driver->special_pickup;

                if ($price->isEmpty()) {
                    $accounts->cost = 0 - $shippment->area->rate;
                    $accounts->rate = $shippment->area->rate;
                } else {
                    foreach ($price as $val) {
                        if ($shippment->city->id == $val->city_id && $shippment->area->id == $val->area_id) {
                            $accounts->cost = 0 - $val->special_price;
                            $accounts->rate = $val->special_price;
                        } else {
                            $accounts->cost = 0 - $shippment->area->rate;
                            $accounts->rate = $shippment->area->rate;

                        }
                    }
                }
                $accounts->save();
            }
        } elseif ($request->status == 'rejected') {
            if($shippment->user) {
                $accounts = new AccountSeller();
                $accounts->shippment_id = $shippment->id;
                $accounts->user_id = $shippment->user->id;
                $accounts->cash = 0;

                if ($price->isEmpty()) {
                    $accounts->cost = 0 - $shippment->area->rate;
                    $accounts->rate = $shippment->area->rate;
                } else {
                    foreach ($price as $val) {
                        if ($shippment->city->id == $val->city_id && $shippment->area->id == $val->area_id) {
                            $accounts->cost = 0 - $val->special_price;
                            $accounts->rate = $val->special_price;
                        } else {
                            $accounts->cost = 0 - $shippment->area->rate;
                            $accounts->rate = $shippment->area->rate;
                        }
                    }
                }
                $accounts->save();
            }

        } elseif ($request->status == 'rejected_fees_paid') {
            $shippment->rejected_fees_paid =  $request->rejected_fees_paid;
            if($shippment->user && $delivery) {
                $accounts = new AccountSeller();
                $accounts->shippment_id = $shippment->id;
                $accounts->user_id = $shippment->user->id;
                if($delivery->driver) {
                    $accounts->delivery_commission = $delivery->driver->special_pickup;
                }

                if (count($price) == 0) {
                    $accounts->cash = $shippment->area->rate;
                    $accounts->cost = $accounts->cash - $shippment->area->rate;
                    $accounts->rate = $shippment->area->rate;

                } else {
                    foreach ($price as $val) {
                        if ($shippment->city->id == $val->city_id && $shippment->area->id == $val->area_id) {
                            $accounts->cash = $val->special_price;
                            $accounts->cost = $accounts->cash - $val->special_price;
                            $accounts->rate = $val->special_price;

                        } else {
                            $accounts->cash = $shippment->area->rate;
                            $accounts->cost = $accounts->cash - $shippment->area->rate;
                            $accounts->rate = $shippment->area->rate;
                        }
                    }
                }
                $accounts->save();
            }

        }

        /*        elseif ($request->status == 'no_answer') {
                    if($delivery) {
                        $delivery->delete();
                    }
                }*/
        elseif ($shippment->shippment_type == 'return_pickup') {
            if($shippment->user && $delivery) {
                $accounts = new AccountSeller();
                $accounts->shippment_id = $shippment->id;
                $accounts->cash = -$shippment->price;
                $accounts->user_id = $shippment->user->id;
                $accounts->delivery_commission = $delivery->driver->special_pickup;


                if ($price->isEmpty()) {
                    $accounts->cost = -$shippment->price - $shippment->area->rate;
                    $accounts->rate = $delivery->shippment->area->rate;
                } else {
                    foreach ($price as $val) {
                        if ($shippment->city->id == $val->city_id && $shippment->area->id == $val->area_id) {
                            $accounts->cost = -$shippment->price - $val->special_price;
                            $accounts->rate = $val->special_price;
                        } else {
                            $accounts->cost = -$shippment->price - $shippment->area->rate;
                            $accounts->rate = $delivery->shippment->area->rate;
                        }
                    }
                }
                $accounts->save();
            }
        }
        $Saved = $tracking->save();
        $isSaved = $shippment->save();
        return response()->json(
            [
                'message' => $isSaved ? 'Status was successfully' : 'change status failed!'
            ],
            $isSaved ? Response::HTTP_CREATED : Response::HTTP_BAD_REQUEST,
        );
    }

    //show shippments without created and requested status in driver
    function driverpickups()
    {
        $assigned = Delivery::with('pickup')->where('pickup_id', '!=', null)->where('driver_id', auth()->user()->id);

        if(request('status')) {
            $pickups = Pickup::where('status', request('status'))->pluck('id');
            $assigned = $assigned->whereIn('pickup_id', $pickups);

        }
        if(request('driver_settled')) {
            if(request('driver_settled') == 2) {
                $driver_settled = 1;
            } else {
                $driver_settled = 0;
            }
            $pickups = Pickup::where('driver_settled', $driver_settled)->pluck('id');
            $assigned = $assigned->whereIn('pickup_id', $pickups);
        }

        $assigned = $assigned->paginate(10);
        return view('Dashboard.driver.pickups', ['assignedPickups' => $assigned]);
    }

    function drivershippments() {
        $this->authorize('shippments.index');
        $assignedShippments = Delivery::with('shippment')
            ->where('shippment_id', '!=', null)
            ->where('driver_id', auth()->user()->id)
            ->pluck('shippment_id');
        $shipments = Shippment::whereIn('id', $assignedShippments)->where('driver_settled' , 0 )->latest();
        $drivers = [];

        if(request('barcode')) {
            $shipments = $shipments->where('barcode', 'like' , '%' . request('barcode')  . '%');
        }
        if(request('receiver_name')) {
            $shipments = $shipments->where('receiver_name', 'like' , '%' . request('receiver_name')  . '%');
        }
        if(request('receiver_phone')) {
            $shipments = $shipments->where('receiver_phone', 'like' , '%' . request('receiver_phone')  . '%');
        }

        if(request('shippment_type')) {
            $shipments = $shipments->where('shippment_type', request('shippment_type'));
        }
        if(request('status')) {
            $shipments = $shipments->where('status', request('status'));
        }
        if(request('driver_settled')) {
            $shipments = $shipments->where('driver_settled', request('driver_settled'));
        }

        if(request('driver_settled')) {
            if(request('driver_settled') == 2) {
                $driver_settled = 1;
            } else {
                $driver_settled = 0;
            }
            $shipments = $shipments->where('driver_settled', $driver_settled);
        }

        $shipments = $shipments->paginate(20);
        return view('Dashboard.driver.shippments', ['shipments' => $shipments, 'drivers' => $drivers]);
    }

    //show delivery shippments and pickup in accountdriver
    function getaccounts()
    {
        if(Auth::guard('admin')->check() || Auth::guard('employee')->check()) {
            $accounts = AccountSeller::latest();

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

            $accounts = $accounts->get();
            $drivers = Driver::latest()->get();
        } else if(Auth::guard('driver')->check()) {
            $shippments = Delivery::with('shippment')
            ->where('driver_id', Auth::id())
            ->whereNull('pickup_id')
            ->pluck('shippment_id');
            $pickups = Delivery::with('pickup')
            ->where('driver_id', Auth::id())
            ->whereNull('shippment_id')
            ->pluck('pickup_id');
            $accountsOfShippments = AccountSeller::with('shippment')->latest()
            ->whereIn('shippment_id', $shippments);
            $accountsOfPickups = AccountSeller::with('pickup')->latest()
            ->whereIn('pickup_id', $pickups);


            if(request('settled_id')) {
                $accountsOfShippments = $accountsOfShippments->where('id', request('settled_id'));
            }
            if(request('shippment_code')) {
                $accountsOfShippments =  $accountsOfShippments->whereHas('shippment', function($shipment) {
                    return $shipment->where('barcode', request('shippment_code'));
                });
            }

            if(request('shippment_type')) {
                $accountsOfShippments =  $accountsOfShippments->whereHas('shippment', function($shipment) {
                    return $shipment->where('shippment_type', request('shippment_type'));
                });
            }

            if(request('driver_settled')) {
                $settled = 0;
                if(request('driver_settled') == '2') {
                    $settled = 1;
                }
                $accountsOfShippments =  $accountsOfShippments->whereHas('shippment', function($shipment) use($settled) {
                    return $shipment->where('driver_settled', $settled);
                });
            }
            if(request('shippment_status')) {
                $accountsOfShippments =  $accountsOfShippments->whereHas('shippment', function($shipment) {
                    return $shipment->where('status', request('shippment_status'));
                });
            }


            $accountsOfShippments = $accountsOfShippments->get();
            $accountsOfPickups = $accountsOfPickups->get();

            $accounts =  $accountsOfShippments->merge($accountsOfPickups);
            $drivers = [];
        }
        // return $accounts;


        return view('Dashboard.admin.accountdriver.accountdrivers', ['accounts' => $accounts, 'drivers' => $drivers]);
    }

    function paginateCollection($collection, $perPage, $pageName = 'page', $fragment = null)
{
    $currentPage = \Illuminate\Pagination\LengthAwarePaginator::resolveCurrentPage($pageName);
    $currentPageItems = $collection->slice(($currentPage - 1) * $perPage, $perPage);
    parse_str(request()->getQueryString(), $query);
    unset($query[$pageName]);
    $paginator = new \Illuminate\Pagination\LengthAwarePaginator(
        $currentPageItems,
        $collection->count(),
        $perPage,
        $currentPage,
        [
            'pageName' => $pageName,
            'path' => \Illuminate\Pagination\LengthAwarePaginator::resolveCurrentPath(),
            'query' => $query,
            'fragment' => $fragment
        ]
    );

    return $paginator;
}
    // print pdf the accountshippment for drivers with give date from to
    function accountdriver(Request $req)
    {
        $validator = Validator($req->all(), [
            'from' => 'required',
            'to' => 'required',
            'driver_id' => 'required',
        ]);
        if (!$validator->fails()) {
            $driver_id = $req->input('driver_id');
            $driver = driver::where('id', $driver_id)->first();
            $scheduledriver = Scheduledriver::where([
                'driver_id' => $req->driver_id,
                'from' => $req->from,
                'to' => $req->to,
            ])->first();

            if(!$scheduledriver) {
                $totalcost = [];
                $totalcommisson = [];
                $pickup = [];
                $shippment = [];
                $scheduledriverId =0;
                $from =  Carbon::parse($req->input('from'));
                $to   = Carbon::parse($req->input('to'));
                //get data
                $delivery = Delivery::where('driver_id', $driver_id)->get();

                foreach ($delivery as $val) {
                    if ($val->shippment_id == null && $val->pickup_id != null) {

                        array_push($pickup, $val->pickup_id);

                    } elseif ($val->pickup_id == null && $val->shippment_id != null) {
                        array_push($shippment, $val->shippment_id);
                    }
                }

                $shippments = AccountSeller::with('shippment')
                ->whereHas('shippment', function($query) {
                    $query->where('driver_settled', 0);
                })
                ->whereIn('shippment_id', $shippment)->get();
                $pickups = AccountSeller::with('pickup')
                ->whereHas('pickup', function($query) {
                    $query->where('driver_settled', 0);
                })
                ->whereIn('pickup_id', $pickup)->get();
                $show = $shippments->merge($pickups);
                if(count($show) > 0) {
                    foreach ($show as $value) {
                        if($value->shippment) {
                            $value->shippment->driver_settled = 1;
                            $value->shippment->save();

                        } else if($value->pickup) {
                            $value->pickup->driver_settled = 1;
                            $value->pickup->save();
                        }
                        array_push($totalcost, $value->cost);
                        array_push($totalcommisson, $value->delivery_commission);
                    }
                    $total = array_sum($totalcost);
                    $totaldrivercommission = array_sum($totalcommisson);
                    $driver->balance += $totaldrivercommission;
                    $driver->save();
                    $scheduledriver = Scheduledriver::firstOrCreate([
                        'driver_id' => $req->driver_id,
                        'from' => $req->from,
                        'to' => $req->to,
                        'total_cost' => $total,
                        'total_delivery_commission' => $totaldrivercommission,
                    ]);
                    $scheduledriverId = $scheduledriver->id;
                } else {
                    $show = [];
                    $total = 0;
                    $totaldrivercommission = 0;
                }
                $scheduledriverUp = Scheduledriver::find( $scheduledriverId);
                foreach ($show as $value) {
                    if($value->shippment) {

                        Delivery::where("shippment_id", $value->shippment->id)
                            ->update(["scheduledrivers_id" => $scheduledriverUp->id]);
                    } else if($value->pickup) {

                        Delivery::where("pickup_id", $value->pickup->id)
                            ->update(["scheduledrivers_id" => $scheduledriverUp->id]);
                    }

                }

//                $deliveryUp = Delivery::where('driver_id', $driver_id);
/*                   Delivery::where("shippment_id", $shippment->id)
                    ->update(["scheduledrivers_id" => $scheduledriverUp->id]);*/


            } else {
                $show = [];
                $total = 0;
                $totaldrivercommission = 0;
            }
            return view('Dashboard.admin.accountdriver.data', ['show' => $show, 'total' => $total, 'totaldrivercommission' => $totaldrivercommission, 'driver' => $driver]);
        } else {
            return redirect()->back()->withErrors(
                ['withErrors' => 'error in form'],
                Response::HTTP_BAD_REQUEST
            );
        }
    }

    // print pdf the accountshippment for drivers from to with special date
    function accountdriver2(Request $req)
    {
        $schedule = Scheduledriver::find($req->schedule_id);
        if($schedule) {
            //get data
            $delivery = Delivery::where('driver_id', $schedule->driver_id)->where('scheduledrivers_id', $schedule->id)->get();
            $pickup = [];
            $shippment = [];
            foreach ($delivery as $val) {
                if ($val->shippment_id == null && $val->pickup_id != null) {
                    array_push($pickup, $val->pickup_id);
                } elseif ($val->pickup_id == null && $val->shippment_id != null) {
                    array_push($shippment, $val->shippment_id);
                }
            }
            $shippments = AccountSeller::with('shippment')->whereIn('shippment_id', $shippment)->get();
            $pickups = AccountSeller::with('pickup')->whereIn('pickup_id', $pickup)->get();
            $show = $shippments->merge($pickups);
            $pdf = PDF::loadView('Dashboard.admin.accountdriver.printdriver', [], [
                'show' => $show,
                'schedule' => $schedule,
                'driver' => $schedule->driver
            ], [
                'orientation' => 'L'
            ]);
            return $pdf->stream('/pdfs/document1.pdf');
        } else {
            return redirect()->back();
        }
    }

    // print all delivery shippments expect create and requested status from admin
    function pdf_shippments(Request $req)
    {
        $validator = Validator($req->all(), [
            'from' => 'required',
            'to' => 'required',
        ]);
        if (!$validator->fails()) {

            $from =  Carbon::parse($req->input('from'));
            $to   = Carbon::parse($req->input('to'));

            $show = Shippment::with('city', 'area', 'user')
                ->where('created_at', '>=', $from)
                ->where('created_at', '<=', $to)->get();
            return view('Dashboard.user.shipment.execlshippment', ['show' => $show]);
        } else {
            return redirect()->back()->withErrors(
                ['withErrors' => 'error in form'],
                Response::HTTP_BAD_REQUEST
            );
        }
    }

    function print_driver_shipments(Request $req)
    {

        $validator = Validator($req->all(), [
            'driver_id' => 'required',
        ]);
        if (!$validator->fails()) {
            $driver_id =  $req->input('driver_id');
            $show = Delivery::with('driver', 'shippment', 'pickup')
                ->whereRelation('driver', 'id', $driver_id)->get();
            $driver = Driver::findOrFail($driver_id);
            return view('Dashboard.admin.printshippment_driver', compact('show', 'driver'));
        } else {
            return redirect()->back()->withErrors(
                ['withErrors' => 'error in form'],
                Response::HTTP_BAD_REQUEST
            );
        }
    }

    function specialprice_city($id)
    {
        $prices = Specialprice::with('user', 'city', 'area')->where('user_id', $id)->get();
        // dd($prices);
        $user_id = $id;
        $city = City::all();

        return view('Dashboard.admin.seller.city_area', ['prices' => $prices, 'city' => $city, 'user_id' => $user_id]);
    }

    function home_page(Request $req)
    {

        $drivers = Driver::count();
        $employees = Employee::count();
        $sellers = User::count();
        $settled_sellers_prices = 0;
        $sellers_should_to_pays = 0;
        if(Auth::guard('admin')->check() || Auth::guard('employee')->check()) {
            $settled_sellers_prices = ScheduleSeller::sum('costs');
            $sellers_should_to_pays = Shippment::with('city', 'area')->where('seller_settled', 0)->get();
            $areasCosts = [];
            $citiesCosts = [];
            $costs = [];
            foreach ($sellers_should_to_pays as $sellers_should_to_pay) {
                array_push($costs, $sellers_should_to_pay->price);
                if($sellers_should_to_pay->area) {
                    array_push($areasCosts, $sellers_should_to_pay->area->rate);
                } else {
                    array_push($citiesCosts, $sellers_should_to_pay->city->rate);

                }
            }
            $areasCosts = array_sum($areasCosts);
            $citiesCosts = array_sum($citiesCosts);
            $costs = array_sum($costs);
            $sellers_should_to_pays = $costs - $areasCosts -  $citiesCosts;

            $delivered =  Shippment::where('status', 'delivered')->count();
            $rejected =  Shippment::where('status', 'rejected')->count();
            $rejected_fees_paid =  Shippment::where('status', 'rejected_fees_paid')->count();
            $receiver_at_hub =  Shippment::where('status', 'receiver_at_hub')->count();
            $out_for_delivery =  Shippment::where('status', 'out_for_delivery')->count();
            $created =  Shippment::where('status', 'created')->count();

        } else if( Auth::guard('user')->check()) {
            $delivered =  Shippment::where(['status' => 'delivered', 'user_id' => Auth::id()])->count();
            $rejected =  Shippment::where(['status' => 'rejected', 'user_id' => Auth::id()])->count();
            $rejected_fees_paid =  Shippment::where(['status' => 'rejected_fees_paid', 'user_id' => Auth::id()])->count();
            $receiver_at_hub =  Shippment::where(['status' => 'receiver_at_hub', 'user_id' => Auth::id()])->count();
            $out_for_delivery =  Shippment::where(['status' => 'out_for_delivery', 'user_id' => Auth::id()])->count();
            $created =  Shippment::where(['status' => 'created', 'user_id' => Auth::id()])->count();
        } else if( Auth::guard('driver')->check()) {
            $shippments = Delivery::where('driver_id', Auth::id())->whereNull('pickup_id')->pluck('shippment_id');
            $delivered =  Shippment::where(['status' => 'delivered'])->whereIn('id', $shippments)->count();
            $rejected =  Shippment::where(['status' => 'rejected'])->whereIn('id', $shippments)->count();
            $rejected_fees_paid =  Shippment::where(['status' => 'rejected_fees_paid'])->whereIn('id', $shippments)->count();
            $receiver_at_hub =  Shippment::where(['status' => 'receiver_at_hub'])->whereIn('id', $shippments)->count();
            $out_for_delivery =  Shippment::where(['status' => 'out_for_delivery'])->whereIn('id', $shippments)->count();
            $created =  Shippment::where(['status' => 'created'])->whereIn('id', $shippments)->count();
        }
        $views = [
            'drivers' => $drivers,
            'employees' => $employees,
            'sellers' => $sellers,
            'delivered' => $delivered,
            'out_for_delivery' => $out_for_delivery,
            'rejected' => $rejected,
            'rejected_fees_paid' => $rejected_fees_paid,
            'receiver_at_hub' => $receiver_at_hub,
            'created' => $created,
            'settled_sellers_prices' => $settled_sellers_prices,
            'sellers_should_to_pays' => $sellers_should_to_pays
        ];

        return view('Dashboard.admin.homepage', $views);
    }

    function getpickup()
    {
        $pickup = Pickup::all();
        return view('Dashboard.admin.pickup.index', ['pickup' => $pickup]);
    }

    function gettracking()
    {
        return view('Dashboard.user.shipment.tracking');
    }

    function gettrackingnumber(Request $request)
    {
        $data = Tracking::with('shippment')->whereRelation('shippment', 'barcode', $request->tracking_number)->get();
        if(count($data) > 0) {
            return view('Dashboard.tracking', ['data' => $data]);
        } else {
            return redirect()->back()->with('error', 'رقم الشحنة خطأ');
        }
    }

    function getCity()
    {
        $city = City::all();
        $sellers = User::all();
        return view('Dashboard.user.address', ['city' => $city, 'sellers' => $sellers]);
    }

    function exportShippment(Request $request)
    {

        $startDate = $request->from;
        $endDate = $request->to;

        $date = date('Y-m-d H:i:s');
        return Excel::download(new ShippmentsExport($startDate, $endDate), 'shippment_' . $date . '.xlsx');
    }

    //import data
    function viewimport()
    {

        return view('Dashboard.admin.importpage');
    }
    function importShippment(Request $request)
    {

        $validator = Validator::make($request->all(),[
            'file' => 'required|mimes:xlsx,xls',
        ]);
        if($validator->fails()) {
            return redirect()->back()->withErrors(
                [
                    'withErrors' =>  'Error ! Check The File'
                ],
            );
        } else {
            $path1 = $request->file('file')->store('temp');
            $path2=storage_path('app').'/'.$path1;
            $import = new ShippmentImport;
            $import->import($path2);

            return redirect()->back()->with('success', __('site.create'));

        }



    }
}
