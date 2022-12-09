<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Traits\Res;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    use Res;
    public function login(Request $request) {
        $rules = [
            'email' => 'required|string|exists:users,email',
            'password' => "required"
        ];
        $messages = [
            'email.required' => 'البريد  مطلوب',
            'email.exists' => 'البريد غير موجود',
            'password.required' => 'الرقم السرى مطلوب',
        ];
        $validator = Validator::make($request->all(), $rules, $messages);
        if($validator->fails()) {
            return $this->sendRes('يوجد خطأ ما', false, $validator->errors());
        }
        $user = User::where('email', $request->email)->first();
        $hashed = Hash::check($request->password, $user->password);
        if(!$hashed) {
            return $this->sendRes('يوجد خطأ ما', false, [
                'password' => 'الرقم السرى خطأ'
            ]);
        } else {
            $token = auth()->guard('api')->login($user);
            return $this->respondWithToken($token, true, 'تم تسجيل الدخول بنجاح', $user);
        }
    }

}
