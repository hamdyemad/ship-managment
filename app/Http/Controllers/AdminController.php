<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Employee;
use App\Traits\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response;


class AdminController extends Controller
{

    use File;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
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
     * @param  \App\Models\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function show(Admin $admin)
    {
        //
        return view('Dashboard.admin.settings');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function edit(Admin $admin)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     *   AnyUser
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        if(Auth::guard('admin')->check()) {
            $current_user =  Admin::where('email', Auth::user()->email)->first();
        } elseif(Auth::guard('employee')->check()) {
            $current_user =  Employee::where('email', Auth::user()->email)->first();

        }
        $updateArray = [
            'name' => $request->name,
            'phone' => $request->phone
        ];
        $rules = [
            'name' => ['required', 'string'],
            'phone' => ['required','numeric','digits:11'],
            'old_password' => 'required'
        ];
        $messages = [
            'name.required' => __('validation.required'),
            'name.string' => __('validation.string'),
            'phone.required' => __('validation.required'),
            'phone.numeric' => __('validation.numeric'),
            'phone.digits' => __('validation.digits',['digits' => 11]),
            'old_password.required' => __('validation.required'),
        ];
        $hashed = false;
        $hashed = Hash::check($request->old_password, $current_user->password);
        if($hashed) {
            if($request->password !== null) {
                $rules['password'] = 'required|min:8';
                $messages['password.min']  = __('validation.min.array', ['min' => 8]);
            }
            $validator = Validator::make($request->all(), $rules, $messages);
            if($validator->fails()) {
                return redirect()->back()->withErrors($validator->errors())->with('error', 'يوجد خطأ ما')->withInput($request->all());
            }
            if($request->password) {
                $updateArray['password'] = Hash::make($request->password);
            }
            if($request->has('avatar')) {
                $updateArray['avatar'] = $this->uploadFile($request, $this->usersPath, 'avatar');
                if(file_exists($current_user->avatar)) {
                    $img = last(explode('/', $current_user->avatar));
                    if(in_array($img, scandir(dirname($current_user->avatar)))) {
                        unlink($current_user->avatar);
                    }
                }
            }
            $current_user->update($updateArray);
            return redirect()->back()->with('success', __('site.update'));
        } else {
            return redirect()->back()->with('old_password.invalid', __('site.old_password.invalid'))->with('error', 'يوجد خطأ ما');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function destroy(Admin $admin)
    {
        //
    }
}
