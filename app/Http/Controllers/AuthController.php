<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class AuthController extends Controller
{


    public function showLogin(Request $request)
    {

        $request->merge(["guard" => $request->guard]);
        $validator = Validator($request->all(), [
            'guard' => 'required|string|in:admin,user,employee,driver'
        ]);
        if (!$validator->fails()) {
            return response()->view('Dashboard.auth.login', ['guard' => $request->input('guard')]);
        } else {
            abort(Response::HTTP_NOT_FOUND);
        }
    }

    //login
    public function login(Request $request)
    {

        $validator = Validator($request->all(), [
            'email' => "required|email",
            'password' => 'required',
            'guard' => 'required|string|in:admin,user,employee,driver',
        ]);

        if (!$validator->fails()) {
            $crendentials = ['email' => $request->input('email'), 'password' => $request->input('password')];
            if (Auth::guard($request->input('guard'))->attempt($crendentials)) {
                return response()->json(['message' => 'Logged in successfully'], Response::HTTP_OK);
            } else {
                return response()->json(
                    ['message' => 'Login failed, check your credentials'],
                    Response::HTTP_BAD_REQUEST
                );
            }
        } else {
            return response()->json(
                ['message' => $validator->getMessageBag()->first()],
                Response::HTTP_BAD_REQUEST,
            );
        }
    }

    // logout
    public function logout(Request $request)
    {
        if(auth('admin')->check()) {
            $guard = 'admin';
        } elseif(auth('user')->check())
        {
            $guard = 'user';
        }
        elseif(auth('driver')->check())
        {
            $guard = 'driver';
        }
        elseif(auth('employee')->check())
        {
            $guard = 'employee';
        }
        Auth::guard($guard)->logout();
        $request->session()->invalidate();
        return redirect()->route('dashboard.login', $guard);
    }
}
