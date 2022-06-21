<?php

namespace App\Http\Controllers;

use App\Exports\ShippmentsExport;
use App\Models\AccountSeller;
use App\Models\Address;
use App\Models\Area;
use App\Models\City;
use App\Models\Delivery;
use App\Models\Driver;
use App\Models\Pickup;
use App\Models\Scheduledriver;
use App\Models\ScheduleSeller;
use App\Models\Shippment;
use App\Models\Specialprice;
use App\Models\Tracking;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;
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
        return view('Dashboard.user.shipment.pdf', compact('show'));
        // $pdf = PDF::loadView('Dashboard.user.shipment.pdf', compact('show'));
        // $ldate = date('Y-m-d H:i:s');
        // $image = $pdf->download('shippment' . $ldate . '.pdf');
        // return $image;
    }

    //download pdf for all shippments and pick up
    function index1(Request $req)
    {
        $from = $req->input('from');
        $to   = $req->input('to');
        $pickup = [];
        // array_push($pickup, $from);
        // array_push($pickup, $to);
        $shippment = [];
        $validator = Validator($req->all(), [
            'from' => 'required',
            'to' => 'required ',
        ]);

        if (!$validator->fails()) {

            // $driver = driver::where('id', auth()->user()->id)->first();
            // $delivery = Delivery::where('driver_id', $driver->id)->get();
            // foreach ($delivery as $val) {
            //     if ($val->shippment_id == null && $val->pickup_id != null) {
            //         array_push($pickup, $val->pickup_id);
            //     } elseif ($val->pickup_id == null && $val->shippment_id != null) {
            //         array_push($shippment, $val->shippment_id);
            //     }
            // }
            // $show = AccountSeller::where(function ($query) use ($shippment) {
            //     $query->whereIn('shippment_id', $shippment)->orWhereNull('shippment_id');
            // })->where(function ($query) use ($pickup) {
            //     $query->whereIn('pickup_id', $pickup)->orWhereNull('pickup_id');
            // })->where('created_at', '>=', $from)
            //     ->where('created_at', '<=', $to)->get();
            $show = Shippment::where('id', auth()->user()->id)
                ->where('created_at', '>=', $from)
                ->where('created_at', '<=', $to)->get();


            return view('Dashboard.user.shipment.execlshippment', ['show' => $show, 'from' => $from, 'to' => $to]);
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
            'user_id' => 'required ',
            'from' => 'required',
            'to' => 'required ',
        ]);

        if (!$validator->fails()) {
            $fromdate =  Carbon::parse($req->input('from'));
            $todate  = Carbon::parse($req->input('to'));
            $user_id_req = $req->input('user_id');

            $shippment = Shippment::all();
            $pickup = Pickup::all();
            // $pickup = [];
            // $shippment = [];
            // foreach ($shippment as $val) {
            //     if ($val->user_id == $user_id_req) {
            //         array_push($shippment, $val->id);
            //     }
            // }

            // foreach ($pickup as $val) {
            //     if ($val->user_id == $user_id_req) {
            //         array_push($pickup, $val->id);
            //     }
            // }

            $show = AccountSeller::with('shippment', 'pickup')
                ->where('pickup_id', '==', null)->orWhereNull('pickup_id')
                ->where('shippment_id', '!=', null)
                ->where('created_at', '>=', $fromdate)
                ->where('created_at', '<=', $todate)
                ->whereRelation('shippment',  'user_id', $user_id_req)->get();
            // $show = AccountSeller::where(function ($query) use ($shippment) {
            //     $query->whereIn('shippment_id', $shippment)->orWhereNull('shippment_id');
            // })->where(function ($query) use ($pickup) {
            //     $query->whereIn('pickup_id', $pickup)->orWhereNull('pickup_id');
            // })->where('created_at', '>=', $fromdate)
            //     ->where('created_at', '<=', $todate)->get();
            $totalcost = [];
            foreach ($show as $value) {
                array_push($totalcost, $value->cost);
            }
            $total = array_sum($totalcost);
            $schedule = ScheduleSeller::firstOrCreate([
                'user_id' => $req->user_id,
                'from' => $req->from,
                'to' => $req->to,
                'costs' => $total,
            ]);
            // dd($show);
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
        $totalcost = [];
        $from =  Carbon::parse($req->input('from'));
        $to   = Carbon::parse($req->input('to'));
        $user_id = $req->input('user_id');
        $show = AccountSeller::with('shippment')->where('created_at', '>=', $from)->where('created_at', '<=', $to)->whereRelation('shippment',  'user_id', $user_id)->get();
        foreach ($show as $value) {
            array_push($totalcost, $value->cost);
        }
        $total = array_sum($totalcost);
        return view('Dashboard.admin.accountseller.printtablesed', compact('show', 'total'));
        // $pdf->setPaper('A4', 'landscape');
        // $image = $pdf->download('printtable.pdf');

        // return $image;
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
            // if ($value->status == 'requested') {
            $delivery = new Delivery();
            $delivery->driver_id = $request->driver_id;
            $delivery->shippment_id = $value->id;
            $value->status = 'shipped';
            $update = $value->save();
            $isSaved = $delivery->save();
            // add to accounts
            // $accounts = new AccountSeller();
            // $accounts->shippment_id = $value->id;
            // $accounts->cash = 0;
            // $accounts->cost = 0;

            //drivver
            // if ($delivery->driver->special_pickup == 10) {
            //     $accounts->delivery_commission =  10;
            // } else {
            //     $accounts->delivery_commission = $delivery->driver->special_pickup;
            // }
            //end
            // $saved = $accounts->save();
            // end add to accounts

            // } else if ($value->status == 'received at hub') {
            //     $delivery = new Delivery();
            //     $delivery->driver_id = $request->driver_id;
            //     $delivery->shippment_id = $value->id;
            //     $value->status = 'shipped';
            //     $update = $value->save();
            //     $isSaved = $delivery->save();
            // }
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
        $delivery = Delivery::with('driver', 'shippment')->where('shippment_id', $request->shipment_id)->first();
        $price = Specialprice::where('user_id', $shippment->user->id)->get();

        $shippment->status = $request->status;
        $tracking = new Tracking();
        $tracking->shippment_id = $shippment->id;
        $tracking->status = $shippment->status;


        if ($request->status == 'delivered') {

            $accounts = new AccountSeller();
            $accounts->shippment_id = $delivery->shippment->id;
            $accounts->cash = $delivery->shippment->price;
            // $accounts->cost = $delivery->shippment->price - $delivery->shippment->area->rate;
            //cost
            if ($price->isEmpty()) {
                $accounts->cost = $delivery->shippment->price - $delivery->shippment->area->rate;
            } else {
                foreach ($price as $val) {
                    if ($delivery->shippment->city->id == $val->city_id && $delivery->shippment->area->id == $val->area_id) {
                        $accounts->cost = $delivery->shippment->price - $val->special_price;
                    } else {
                        $accounts->cost = $delivery->shippment->price - $delivery->shippment->area->rate;
                    }
                }
            }
            //end cost
            $accounts->delivery_commission = $delivery->driver->special_pickup;
            $accounts->save();
            //drivver
            // if ($delivery->driver->special_pickup == 10) {

            //     if ($price->isEmpty()) {
            //         $accounts->delivery_commission = $shipment->area->rate - 10;
            //     } else {
            //         foreach ($price as $val) {
            //             if ($shipment->city->id == $val->city_id && $shipment->area->id == $val->area_id) {
            //                 $accounts->delivery_commission = $val->special_price - 10;
            //             } else {
            //                 $accounts->delivery_commission = $shipment->area->rate - 10;
            //             }
            //         }
            //     }
            // } else {

            //     if ($price->isEmpty()) {
            //         $accounts->delivery_commission = $shipment->area->rate - $delivery->driver->special_pickup;
            //     } else {
            //         foreach ($price as $val) {
            //             if ($shipment->city->id == $val->city_id && $shipment->area->id == $val->area_id) {
            //                 $accounts->delivery_commission = $val->special_price - $delivery->driver->special_pickup;
            //             } else {
            //                 $accounts->delivery_commission = $shipment->area->rate - 10;
            //             }
            //         }
            //     }
            // }
            // enddrivver


        } elseif ($request->status == 'delivered' && $delivery->shippment->shippment_type == 'exchange') {

            $accounts = new AccountSeller();
            $accounts->shippment_id = $shippment->id;
            $accounts->cash = 0;

            if ($price->isEmpty()) {
                $accounts->cost = 0 - $shippment->area->rate;
            } else {
                foreach ($price as $val) {
                    if ($shippment->city->id == $val->city_id && $shippment->area->id == $val->area_id) {

                        $accounts->cost = 0 - $val->special_price;
                    } else {

                        $accounts->cost = 0 - $shippment->area->rate;
                    }
                }
            }
            $accounts->delivery_commission = $delivery->driver->special_pickup;
            $accounts->save();
            //first
            // if ($delivery->driver->special_pickup == 10) {

            //     if ($price->isEmpty()) {

            //         $accounts->delivery_commission = $shipment->area->rate - 10;
            //     } else {
            //         foreach ($price as $val) {
            //             if ($shipment->city->id == $val->city_id && $shipment->area->id == $val->area_id) {

            //                 $accounts->delivery_commission = $val->special_price - 10;
            //             } else {

            //                 $accounts->delivery_commission = $shipment->area->rate - 10;
            //             }
            //         }
            //     }
            // } else {

            //     if ($price->isEmpty()) {

            //         $accounts->delivery_commission = $shipment->area->rate - $delivery->driver->special_pickup;
            //     } else {
            //         foreach ($price as $val) {
            //             if ($shipment->city->id == $val->city_id && $shipment->area->id == $val->area_id) {


            //                 $accounts->delivery_commission = $val->special_price - $delivery->driver->special_pickup;
            //             } else {

            //                 $accounts->delivery_commission = $shipment->area->rate - $delivery->driver->special_pickup;
            //             }
            //         }
            //     }
            // }
            //end


        } elseif ($request->status == 'rejected') {

            $accounts = new AccountSeller();
            $accounts->shippment_id = $shippment->id;
            $accounts->cash = 0;

            if ($price->isEmpty()) {
                $accounts->cost = 0 - $shippment->area->rate;
            } else {
                foreach ($price as $val) {
                    if ($shippment->city->id == $val->city_id && $shippment->area->id == $val->area_id) {

                        $accounts->cost = 0 - $val->special_price;
                    } else {

                        $accounts->cost = 0 - $shippment->area->rate;
                    }
                }
            }
            $accounts->delivery_commission = $delivery->driver->special_pickup;
            $accounts->save();
            // if ($delivery->driver->special_pickup == 10) {
            //     if ($price->isEmpty()) {
            //         $accounts->delivery_commission = $shipment->area->rate - 10;
            //     } else {
            //         foreach ($price as $val) {
            //             if ($shipment->city->id == $val->city_id && $shipment->area->id == $val->area_id) {
            //                 $accounts->delivery_commission = $$val->special_price - 10;
            //             } else {
            //                 $accounts->delivery_commission = $shipment->area->rate - 10;
            //             }
            //         }
            //     }
            // } else {
            //     if ($price->isEmpty()) {

            //         $accounts->delivery_commission = $shipment->area->rate - $delivery->driver->special_pickup;
            //     } else {
            //         foreach ($price as $val) {
            //             if ($shipment->city->id == $val->city_id && $shipment->area->id == $val->area_id) {

            //                 $accounts->delivery_commission = $val->special_price - $delivery->driver->special_pickup;
            //             } else {

            //                 $accounts->delivery_commission = $shipment->area->rate - $delivery->driver->special_pickup;
            //             }
            //         }
            //     }
            // }

        } elseif ($request->status == 'rejected_fees_faid') {

            $accounts = new AccountSeller();
            $accounts->shippment_id = $shipment->id;

            if ($price->isEmpty()) {

                $accounts->cash = $shipment->area->rate;
                $accounts->cost = $accounts->cash - $shipment->area->rate;
            } else {
                foreach ($price as $val) {
                    if ($shipment->city->id == $val->city_id && $shipment->area->id == $val->area_id) {
                        $accounts->cash = $val->special_price;
                        $accounts->cost = $accounts->cash - $val->special_price;
                    } else {
                        $accounts->cash = $shipment->area->rate;
                        $accounts->cost = $accounts->cash - $shipment->area->rate;
                    }
                }
            }
            $accounts->delivery_commission = $delivery->driver->special_pickup;
            $accounts->save();

            // if ($delivery->driver->special_pickup == 10) {
            //     if ($price->isEmpty()) {
            //         $accounts->delivery_commission = $shipment->area->rate - 10;
            //     } else {
            //         foreach ($price as $val) {
            //             if ($shipment->city->id == $val->city_id && $shipment->area->id == $val->area_id) {
            //                 $accounts->delivery_commission = $val->special_price - 10;
            //             } else {
            //                 $accounts->delivery_commission = $shipment->area->rate - 10;
            //             }
            //         }
            //     }
            // } else {
            //     if ($price->isEmpty()) {
            //         $accounts->delivery_commission = $shipment->area->rate - $delivery->driver->special_pickup;
            //     } else {
            //         foreach ($price as $val) {
            //             if ($shipment->city->id == $val->city_id && $shipment->area->id == $val->area_id) {
            //                 $accounts->delivery_commission = $val->special_price - $delivery->driver->special_pickup;
            //             } else {
            //                 $accounts->delivery_commission = $shipment->area->rate - $delivery->driver->special_pickup;
            //             }
            //         }
            //     }
            // }

        } elseif ($shippment->shippment_type == 'return_pickup') {

            $accounts = new AccountSeller();
            $accounts->shippment_id = $shippment->id;
            $accounts->cash = -$shippment->price;

            if ($price->isEmpty()) {
                $accounts->cost = -$shippment->price - $shippment->area->rate;
            } else {
                foreach ($price as $val) {
                    if ($shippment->city->id == $val->city_id && $shippment->area->id == $val->area_id) {
                        $accounts->cost = -$shippment->price - $val->special_price;
                    } else {
                        $accounts->cost = -$shippment->price - $shippment->area->rate;
                    }
                }
            }
            $accounts->delivery_commission = $delivery->driver->special_pickup;
            $accounts->save();

            //drivver
            // if ($delivery->driver->special_pickup == 10) {

            //     if ($price->isEmpty()) {
            //         $accounts->delivery_commission = $shipment->area->rate - 10;
            //     } else {
            //         foreach ($price as $val) {
            //             if ($shipment->city->id == $val->city_id && $shipment->area->id == $val->area_id) {

            //                 $accounts->delivery_commission = $val->special_price - 10;
            //             } else {
            //                 $accounts->delivery_commission = $shipment->area->rate - 10;
            //             }
            //         }
            //     }
            // } else {

            //     if ($price->isEmpty()) {
            //         $accounts->delivery_commission = $shipment->area->rate - $delivery->driver->special_pickup;
            //     } else {
            //         foreach ($price as $val) {
            //             if ($shipment->city->id == $val->city_id && $shipment->area->id == $val->area_id) {
            //                 $accounts->delivery_commission = $val->special_price - $delivery->driver->special_pickup;
            //             } else {
            //                 $accounts->delivery_commission = $shipment->area->rate - 10;
            //             }
            //         }
            //     }
            // }
            // enddrivver


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

    // change the status to onhold and give date onhold
    function changestatue_onhold(Request $request)
    {

        $shipment = Shippment::where('id', $request->shipment_id)->first();
        $shipment->status = $request->status;
        $shipment->on_hold =  $request->date;
        $shipment->note =  $request->note;
        $isSaved = $shipment->save();
        return response()->json(
            [
                'message' => $isSaved ? 'Status was successfully' : 'Create failed!'
            ],
            $isSaved ? Response::HTTP_CREATED : Response::HTTP_BAD_REQUEST,
        );
    }

    //show shippments without created and requested status in driver
    function drivershipment()
    {

        // $shipment = Shippment::where('status', ['picked up', 'received at hub', 'shipped', 'onhold', 'delivered', 'no_answer', 'rejected', 'rejected_fees_faid'])->get();
        $deliveries = Delivery::with('shippment', 'pickup')->where('driver_id', auth()->user()->id)->get();
        // dd($deliveries[0]->pickup);
        return view('Dashboard.driver.shipment', ['deliveries' => $deliveries]);
    }

    //show delivery shippments and pickup in accountdriver
    function getaccounts()
    {
        $accounts = AccountSeller::all();
        $shipments = Delivery::with('shippment', 'driver')->get();
        $drivers = Driver::all();
        return view('Dashboard.admin.accountdrivers', ['accounts' => $accounts, 'drivers' => $drivers]);
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
            $totalcost = [];
            $totalcommisson = [];
            $pickup = [];
            $shippment = [];
            $from =  Carbon::parse($req->input('from'));
            $to   = Carbon::parse($req->input('to'));
            $driver_id = $req->input('driver_id');
            //get data
            $delivery = Delivery::where('driver_id', $driver_id)->get();
            $driver = driver::where('id', $driver_id)->first();

            foreach ($delivery as $val) {
                if ($val->shippment_id == null && $val->pickup_id != null) {
                    array_push($pickup, $val->pickup_id);
                } elseif ($val->pickup_id == null && $val->shippment_id != null) {
                    array_push($shippment, $val->shippment_id);
                }
            }

            $show = AccountSeller::where(function ($query) use ($shippment) {
                $query->whereIn('shippment_id', $shippment)->orWhereNull('shippment_id');
            })->where(function ($query) use ($pickup) {
                $query->whereIn('pickup_id', $pickup)->orWhereNull('pickup_id');
            })->where('created_at', '>=', $from)
                ->where('created_at', '<=', $to)->get();

            // dd($show[0]->pickup->address->city->city);
            // $show = Shippment::with('accountseller', 'city', 'area', 'user', 'deliveries')
            //     ->whereRelation('deliveries', 'driver_id', $driver_id)
            //     ->whereRelation('accountseller', 'created_at', '>=', $from)
            //     ->whereRelation('accountseller', 'created_at', '<=', $to)->get();

            foreach ($show as $value) {
                array_push($totalcost, $value->cost);
                array_push($totalcommisson, $value->delivery_commission);
            }
            $total = array_sum($totalcost);
            $totaldrivercommission = array_sum($totalcommisson);

            // $pdf = PDF::loadView('Dashboard.admin.printdriver', compact('show', 'total', 'totaldrivercommission'));
            // $pdf->setPaper('A4', 'landscape');
            // $image = $pdf->download('printtable.pdf');

            // $pdf = PDF::loadView('Dashboard.admin.printdriver', ['show' => $show, 'total' => $total, 'totaldrivercommission' => $totaldrivercommission]);
            // // $pdf->setPaper('A4', 'landscape');
            // return $pdf->stream('document.pdf');

            // $data = [
            //     'show' => $show,
            //     'total' => $total,
            //     'totaldrivercommission' => $totaldrivercommission,

            // ];
            // require_once __DIR__ . '/vendor/autoload.php';

            // $mpdf = new \Mpdf\Mpdf();
            // $mpdf->WriteHTML('<h1>Hello world!</h1>');
            // $mpdf->Output();
            // $pdf = PDF::chunkLoadView('<html-separator/>', 'Dashboard.admin.printdriver', $data);
            // return $pdf->stream('document.pdf');
            // $ldate = date('Y-m-d H:i:s');


            // $html = $pdf->download($driver->name . $ldate . '.pdf');

            $scheduledriver = Scheduledriver::firstOrCreate([
                'driver_id' => $req->driver_id,
                'from' => $req->from,
                'to' => $req->to,
                'total_cost' => $total,
                'total_delivery_commission' => $totaldrivercommission,
            ]);
            return view('Dashboard.admin.printdriver', ['show' => $show, 'total' => $total, 'totaldrivercommission' => $totaldrivercommission, 'driver' => $driver]);
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
        $totalcost = [];
        $totalcommisson = [];
        $pickup = [];
        $shippment = [];
        $from =  Carbon::parse($req->input('from'));
        $to   = Carbon::parse($req->input('to'));
        $driver_id = $req->input('driver_id');
        $driver = driver::where('id', $driver_id)->first();
        $delivery = Delivery::where('driver_id', $driver_id)->get();
        foreach ($delivery as $val) {
            if ($val->shippment_id == null && $val->pickup_id != null) {
                array_push($pickup, $val->pickup_id);
            } elseif ($val->pickup_id == null && $val->shippment_id != null) {
                array_push($shippment, $val->shippment_id);
            }
        }

        // $show = Shippment::with('accountseller', 'city', 'area', 'user', 'deliveries')
        //     ->whereRelation('deliveries', 'driver_id', $driver_id)
        //     ->whereRelation('accountseller', 'created_at', '>=', $from)
        //     ->whereRelation('accountseller', 'created_at', '<=', $to)->get();
        $show = AccountSeller::where(function ($query) use ($shippment) {
            $query->whereIn('shippment_id', $shippment)->orWhereNull('shippment_id');
        })->where(function ($query) use ($pickup) {
            $query->whereIn('pickup_id', $pickup)->orWhereNull('pickup_id');
        })->where('created_at', '>=', $from)
            ->where('created_at', '<=', $to)->get();

        foreach ($show as $value) {
            array_push($totalcost, $value->cost);
            array_push($totalcommisson, $value->delivery_commission);
        }
        $total = array_sum($totalcost);
        $totaldrivercommission = array_sum($totalcommisson);
        return view('Dashboard.admin.printdriver', ['show' => $show, 'total' => $total, 'totaldrivercommission' => $totaldrivercommission, 'driver' => $driver]);
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

            // $delivery = Delivery::with('driver', 'shippment')
            //     ->whereRelation('shippment', 'created_at', '>=', $from)
            //     ->whereRelation('shippment', 'created_at', '<=', $to)->get();

            $show = AccountSeller::with('shippment', 'pickup')
                ->where('created_at', '>=', $from)
                ->where('created_at', '<=', $to)->get();
            // dd($show);
            // $show = AccountSeller::where(function ($query) use ($shippment) {
            //     $query->whereIn('shippment_id', $shippment)->orWhereNull('shippment_id');
            // })->where(function ($query) use ($pickup) {
            //     $query->whereIn('pickup_id', $pickup)->orWhereNull('pickup_id');
            // })->where('created_at', '>=', $from)
            //     ->where('created_at', '<=', $to)->get();

            return view('Dashboard.admin.printshippments', compact('show'));
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
        $prices = Specialprice::with('user', 'city', 'area')->get();
        // dd($prices);
        $user_id = $id;
        $city = City::all();

        return view('Dashboard.admin.seller.city_area', ['prices' => $prices, 'city' => $city, 'user_id' => $user_id]);
    }

    function home_page(Request $req)
    {
        $user = User::count();
        $shippments =  Shippment::where('status', 'delivered')->count();
        // $delivery = Delivery::with('driver', 'shippment')
        //     ->whereRelation('driver', 'id', $driver_id)->get();
        $driver = Driver::count();
        // dd($shippments);
        return view('Dashboard.admin.homepage', ['user' => $user, 'driver' => $driver]);
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
        // dd($request->tracking_number);
        return view('Dashboard.tracking', ['data' => $data]);
    }

    function getCity()
    {
        $city = City::all();
        return view('Dashboard.user.address', ['city' => $city]);
    }

    function exportShippment(Request $request)
    {

        $startDate = $request->from;
        $endDate = $request->to;
        // dd($request->to);
        // $show = Shippment::where('id', auth()->user()->id)
        //     ->where('created_at', '>=', $request->from)
        //     ->where('created_at', '<=', $request->to)->get();
        // dd($show);
        // $city = City::all();
        // return view('Dashboard.user.address', ['city' => $city]);
        // $export = new ShippmentsExport();
        // $export->setQuery($show);
        // $export = new ShippmentsExport();
        // $export->setQuery($show);
        $date = date('Y-m-d H:i:s');
        return Excel::download(new ShippmentsExport($startDate, $endDate), 'shippment_' . $date . '.xlsx');
    }

    function actions()
    {
        dd(auth()->user()->actions);
    }
}
