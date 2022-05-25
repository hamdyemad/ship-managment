<?php

namespace App\Http\Controllers;

use App\Models\AccountSeller;
use App\Models\Address;
use App\Models\Area;
use App\Models\City;
use App\Models\Delivery;
use App\Models\Driver;
use App\Models\Scheduledriver;
use App\Models\ScheduleSeller;
use App\Models\Shippment;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Milon\Barcode\PDF417;
use PDF;


class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    function index()
    {

        $city = City::all();
        return view('Dashboard.user.settings', ['city' => $city]);
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
        $pdf = PDF::loadView('dashboard.user.shipment.pdf', compact('show'));

        return $pdf->download('disney.pdf');
    }

    function index1(Request $req)
    {
        $method = $req->method();

        if ($req->isMethod('post')) {
            $from = $req->input('from');
            $to   = $req->input('to');
            if ($req->has('search')) {
                // select search
                $search = DB::select("SELECT * FROM shippments WHERE created_at BETWEEN '$from' AND '$to'");
                return view('import', ['ViewsPage' => $search]);
            } elseif ($req->has('exportPDF')) {
                // select PDF
                $PDFReport = DB::select("SELECT * FROM shippments WHERE created_at BETWEEN '$from' AND '$to'");
                $pdf = PDF::loadView('dashboard.user.shipment.printtable', ['PDFReport' => $PDFReport])->setPaper('a4', 'landscape');
                return $pdf->download('PDF-report.pdf');
            }
        } else {
            //select all
            $ViewsPage = DB::select('SELECT * FROM users');
            return view('import', ['ViewsPage' => $ViewsPage]);
        }
    }
    // print pdf the shippment from to
    function accountsellerpdf(Request $req)
    {
        $validator = Validator($req->all(), [
            'user_id' => 'required ',
            'from' => 'required',
            'to' => 'required ',

        ]);

        $fromdate =  Carbon::parse($req->input('from'));
        $todate  = Carbon::parse($req->input('to'));
        $user_id_req = $req->input('user_id');

        $show = AccountSeller::with('shippment')->where('created_at', '>=', $fromdate)
            ->where('created_at', '<=', $todate)->whereRelation('shippment',  'user_id', $user_id_req)->get();

        $totalcost = [];
        foreach ($show as $value) {
            array_push($totalcost, $value->cost);
        }
        $total = array_sum($totalcost);
        $schedule = ScheduleSeller::firstOrCreate([
            'user_id' => $req->user_id,
            'from' => $req->from,
            'to' => $req->to,
            'image' => $total,
        ]);

        // $schedule = new ScheduleSeller();
        // $schedule->user_id = $req->user_id;
        // $schedule->from = $req->from;
        // $schedule->to = $req->to;
        // $schedule->image = $total;
        // $isSaved = $schedule->save();

        $pdf = PDF::loadView('dashboard.admin.accountseller.printtable', ['show' => $show, 'total' => $total]);
        $pdf->setPaper('A4', 'landscape');
        return $pdf->download('printtable.pdf');
    }
    // print pdf the shippment from to
    function accountseller2(Request $req)
    {
        $totalcost = [];
        $from =  Carbon::parse($req->input('from'));
        $to   = Carbon::parse($req->input('to'));
        $user_id = $req->input('user_id');
        $show = AccountSeller::with('shippment')->where('created_at', '>=', $from)->where('created_at', '<=', $to)->whereRelation('shippment',  'user_id', $user_id)->get();
        foreach ($show as $value) {
            array_push($totalcost, $value->cost);
        }
        $total = array_sum($totalcost);
        $pdf = PDF::loadView('dashboard.admin.accountseller.printtablesed', compact('show', 'total'));
        $pdf->setPaper('A4', 'landscape');
        $image = $pdf->download('printtable.pdf');

        return $image;
    }
    // get all shipment with driver to admin with advanced search
    function getshipment()
    {
        $delivery = Delivery::with('driver', 'shippment')->get();
        $drivers = Driver::all();
        return view('Dashboard.admin.search', ['shipment' => $delivery, 'driver' => $drivers]);
    }

    // get one shipment after do scan using driver or emplyee
    function getshipmentscan(Request $request)
    {

        $barcode = $request->sometext;
        $shippment = Shippment::where('barcode', $barcode)->first();

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

    // get shipment after do scan using employee and add driver
    function getshipmentscan2(Request $request)
    {

        $barcodes = array();

        foreach ($request->arr as $key => $value) {

            $barcodes[$key] = $value;
        }

        // $shippment = DB::table('shippments')->select('id', 'address', 'receiver_name')->whereIn('barcode', $barcodes)->get();
        $shippment = Shippment::whereIn('barcode', $barcodes)->get();


        foreach ($shippment as  $value) {
            if ($value->status == 'requested') {
                $delivery = new Delivery();
                $delivery->driver_id = $request->driver_id;
                $delivery->shippment_id = $value->id;
                $value->status = 'picked up';
                $update = $value->save();
                $isSaved = $delivery->save();
            } else if ($value->status == 'received at hub') {
                $delivery = new Delivery();
                $delivery->driver_id = $request->driver_id;
                $delivery->shippment_id = $value->id;
                $value->status = 'shipped';
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

    // change status using driver
    function changestatue(Request $request)
    {

        $shipment = Shippment::with('city', 'area', 'user')->where('id', $request->shipment_id)->first();
        $delivery = Delivery::with('driver')->where('shippment_id', $request->shipment_id)->first();
        // dd($delivery);
        $shipment->status = $request->status;

        if ($request->status == 'delivered') {

            $accounts = new AccountSeller();
            $accounts->shippment_id = $shipment->id;
            $accounts->cash = $shipment->price;
            if ($shipment->user->special_price == 0) {
                $accounts->cost = $shipment->price - $shipment->area->rate;
            } elseif ($shipment->user->special_price != 0 && $shipment->city->id == $shipment->user->city_id && $shipment->area->id == $shipment->user->area_id) {
                $accounts->cost = $shipment->price - $shipment->user->special_price;
            } else {
                $accounts->cost = $shipment->price - $shipment->area->rate;
            }
            //drivver
            if ($delivery->driver->special_pickup == 10) {
                if ($shipment->user->special_price == null) {
                    $accounts->delivery_commission = $shipment->area->rate - 10;
                } else {
                    $accounts->delivery_commission = $shipment->user->special_price - 10;
                }
            } else {
                if ($shipment->user->special_price == null) {
                    $accounts->delivery_commission = $shipment->area->rate - $delivery->driver->special_pickup;
                } else {
                    $accounts->delivery_commission = $shipment->user->special_price - $delivery->driver->special_pickup;
                }
            }
            // enddrivver

            $accounts->save();
        } elseif ($request->status == 'delivered' && $shipment->shippment_type == 'exchange') {

            $accounts = new AccountSeller();
            $accounts->shippment_id = $shipment->id;
            $accounts->cash = 0;
            if ($shipment->user->special_price == 0) {
                $accounts->cost = 0 - $shipment->area->rate;
            } elseif ($shipment->user->special_price != 0 && $shipment->city->id == $shipment->user->city_id && $shipment->area->id == $shipment->user->area_id) {
                $accounts->cost = 0 - $shipment->user->special_price;
            } else {
                $accounts->cost = 0 - $shipment->area->rate;
            }
            if ($delivery->driver->special_pickup == 10) {
                if ($shipment->user->special_price == null) {
                    $accounts->delivery_commission = $shipment->area->rate - 10;
                } else {
                    $accounts->delivery_commission = $shipment->user->special_price - 10;
                }
            } else {
                if ($shipment->user->special_price == null) {
                    $accounts->delivery_commission = $shipment->area->rate - $delivery->driver->special_pickup;
                } else {
                    $accounts->delivery_commission = $shipment->user->special_price - $delivery->driver->special_pickup;
                }
            }

            $accounts->save();
        } elseif ($request->status == 'rejected') {

            $accounts = new AccountSeller();
            $accounts->shippment_id = $shipment->id;
            $accounts->cash = 0;
            if ($shipment->user->special_price == 0) {
                $accounts->cost = 0 - $shipment->area->rate;
            } elseif ($shipment->user->special_price != 0 && $shipment->city->id == $shipment->user->city_id && $shipment->area->id == $shipment->user->area_id) {
                $accounts->cost = 0 - $shipment->user->special_price;
            } else {
                $accounts->cost = 0 - $shipment->area->rate;
            }
            if ($delivery->driver->special_pickup == 10) {
                if ($shipment->user->special_price == null) {
                    $accounts->delivery_commission = $shipment->area->rate - 10;
                } else {
                    $accounts->delivery_commission = $shipment->user->special_price - 10;
                }
            } else {
                if ($shipment->user->special_price == null) {
                    $accounts->delivery_commission = $shipment->area->rate - $delivery->driver->special_pickup;
                } else {
                    $accounts->delivery_commission = $shipment->user->special_price - $delivery->driver->special_pickup;
                }
            }

            $accounts->save();
        } elseif ($request->status == 'rejected_fees_faid') {

            $accounts = new AccountSeller();
            $accounts->shippment_id = $shipment->id;

            if ($shipment->user->special_price == 0) {
                $accounts->cash = $shipment->area->rate;
                $accounts->cost = $accounts->cash - $shipment->area->rate;
            } elseif ($shipment->user->special_price != 0 && $shipment->city->id == $shipment->user->city_id && $shipment->area->id == $shipment->user->area_id) {
                $accounts->cash = $shipment->user->special_price;
                $accounts->cost = $accounts->cash - $shipment->user->special_price;
            } else {
                $accounts->cash = $shipment->area->rate;
                $accounts->cost = $accounts->cash - $shipment->area->rate;
            }
            if ($delivery->driver->special_pickup == 10) {
                if ($shipment->user->special_price == null) {
                    $accounts->delivery_commission = $shipment->area->rate - 10;
                } else {
                    $accounts->delivery_commission = $shipment->user->special_price - 10;
                }
            } else {
                if ($shipment->user->special_price == null) {
                    $accounts->delivery_commission = $shipment->area->rate - $delivery->driver->special_pickup;
                } else {
                    $accounts->delivery_commission = $shipment->user->special_price - $delivery->driver->special_pickup;
                }
            }
            $accounts->save();
        }



        $isSaved = $shipment->save();
        return response()->json(
            [
                'message' => $isSaved ? 'Status was successfully' : 'change status failed!'
            ],
            $isSaved ? Response::HTTP_CREATED : Response::HTTP_BAD_REQUEST,
        );
    }

    // change the status to onhold and give date
    function changestatue_onhold(Request $request)
    {

        $shipment = Shippment::where('id', $request->shipment_id)->first();
        $shipment->status = $request->status;
        $shipment->updated_at =  $request->date;
        $shipment->note =  $request->note;
        $isSaved = $shipment->save();
        return response()->json(
            [
                'message' => $isSaved ? 'Status was successfully' : 'Create failed!'
            ],
            $isSaved ? Response::HTTP_CREATED : Response::HTTP_BAD_REQUEST,
        );
    }

    function drivershipment()
    {
        $shipment = Shippment::where('status', ['picked up', 'received at hub', 'shipped', 'onhold', 'delivered', 'no_answer', 'rejected', 'rejected_fees_faid'])->get();
        // dd($shipment);
        return view('Dashboard.driver.shipment', ['shipment' => $shipment]);
    }

    function getaccounts()
    {
        $shipments = Delivery::with('shippment', 'driver')->get();
        $drivers = Driver::all();
        return view('Dashboard.admin.accountdrivers', ['shipment' => $shipments, 'drivers' => $drivers]);
    }

    // print pdf the shippment from to
    function accountdriver(Request $req)
    {
        $totalcost = [];
        $totalcommisson = [];
        $from =  Carbon::parse($req->input('from'));
        $to   = Carbon::parse($req->input('to'));
        $driver_id = $req->input('driver_id');
        $show = Shippment::with('accountseller', 'city', 'area', 'user', 'deliveries')
            ->whereRelation('deliveries', 'driver_id', $driver_id)
            ->whereRelation('accountseller', 'created_at', '>=', $from)
            ->whereRelation('accountseller', 'created_at', '<=', $to)->get();

        foreach ($show as $value) {
            array_push($totalcost, $value->accountseller->cost);
            array_push($totalcommisson, $value->accountseller->delivery_commission);
        }
        $total = array_sum($totalcost);
        $totaldrivercommission = array_sum($totalcommisson);

        $pdf = PDF::loadView('dashboard.admin.printdriver', compact('show', 'total', 'totaldrivercommission'));
        $pdf->setPaper('A4', 'landscape');
        $image = $pdf->download('printtable.pdf');

        $scheduledriver = new Scheduledriver();
        $scheduledriver->driver_id = $driver_id;
        $scheduledriver->from = $from;
        $scheduledriver->to = $to;
        $scheduledriver->total_cost = $total;
        $scheduledriver->total_delivery_commission = $totaldrivercommission;
        $saved = $scheduledriver->save();

        return $image;
    }
    // print pdf the shippment from to
    function accountdriver2(Request $req)
    {
        $totalcost = [];
        $totalcommisson = [];
        $from =  Carbon::parse($req->input('from'));
        $to   = Carbon::parse($req->input('to'));
        $driver_id = $req->input('driver_id');

        $show = Shippment::with('accountseller', 'city', 'area', 'user', 'deliveries')
            ->whereRelation('deliveries', 'driver_id', $driver_id)
            ->whereRelation('accountseller', 'created_at', '>=', $from)
            ->whereRelation('accountseller', 'created_at', '<=', $to)->get();

        foreach ($show as $value) {
            array_push($totalcost, $value->cost);
            array_push($totalcommisson, $value->accountseller->delivery_commission);
        }
        $total = array_sum($totalcost);
        $totaldrivercommission = array_sum($totalcommisson);
        // dd($total);
        $pdf = PDF::loadView('dashboard.admin.printdriver', compact('show', 'total', 'totaldrivercommission'));
        $pdf->setPaper('A4', 'landscape');
        $image = $pdf->download('printtable.pdf');

        return $image;
    }
}
