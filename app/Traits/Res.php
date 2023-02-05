<?php

namespace App\Traits;

use App\Models\AccountSeller;
use App\Models\Delivery;
use App\Models\Shippment;
use App\Models\ShippmentHistory;
use App\Models\Specialprice;
use App\Models\Tracking;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Tymon\JWTAuth\Facades\JWTAuth;

trait Res
{
  public function sendRes($message, $status = true,  $data = [])
  {
    return response()->json([
      'status' => $status,
      'message' => $message,
      'data' => $data
    ]);
  }

  protected function respondWithToken($token, $status = true, $message = '', $data = [])
  {
      return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => JWTAuth::factory()->getTTL() . ' minutes',
            'status' => $status,
            'message' => $message,
            'data' => $data
      ]);
  }


  function status_flow(Request $request)
    {
        $shippment = Shippment::with('city', 'area', 'user')->where('id', $request->shipment_id)->first();
        if(Auth::guard('driver')->user()) {
            if($shippment->driver_changed == 0) {
                $shippment->driver_changed = 1;
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
    }

}
