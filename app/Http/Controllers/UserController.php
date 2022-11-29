<?php

namespace App\Http\Controllers;

use App\Models\Area;
use App\Models\City;
use App\Models\User;
use App\Traits\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use Symfony\Component\HttpFoundation\Response;

class UserController extends Controller
{
    use File;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::latest()->get();
        return view('Dashboard.admin.seller.index', ['users' => $users]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $city = City::all();
        $roles = Role::all();
        return view('Dashboard.admin.seller.create', ['city' => $city, 'roles' => $roles]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator($request->all(), [

            'name' => 'required | max:50',
            'email' => 'string |required| min:2 |max:20',
            'phone' => 'required |numeric',
            'password' => 'required|min:8|confirmed',
            'role_id' => 'required|numeric|exists:roles,id',
        ]);
        if (!$validator->fails()) {
            $user = new User();
            $user->name = $request->input('name');
            $user->email = $request->input('email') . '@shipexeg.com';
            $user->phone = $request->input('phone');
            if (!$request->input('special_pickup')) {
                $user->special_pickup = 0;
            } else {
                $user->special_pickup = $request->input('special_pickup');
            }

            $user->password = Hash::make($request->input('password'));
            $isSaved = $user->save();
            if ($isSaved) {
                $user->roles()->attach($request->role_id);
            }
            return response()->json(
                [
                    'message' => $isSaved ? 'User created successfully' : 'Create failed!'
                ],
                $isSaved ? Response::HTTP_CREATED : Response::HTTP_BAD_REQUEST,
            );
        } else {
            return response()->json(['message' => $validator->getMessageBag()->first()], Response::HTTP_BAD_REQUEST);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::findOrFail($id);
        $roles = Role::all();
        return view('Dashboard.admin.seller.edit', ['user' => $user, 'roles' => $roles]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $rules = [
            'name' => ' max:50',
            'email' => 'string|min:2',
            'phone' => 'numeric',
            'special_pickup' => 'numeric',
            'password' => 'confirmed',
            'role_id' => 'required|numeric|exists:roles,id',
        ];
        if($request->password) {
            $rules['password'] = ['min:8', 'confirmed'];
        }
        $validator = Validator($request->all(), $rules);

        if (!$validator->fails()) {

            $user->name = $request->input('name');
            $user->email = $request->input('email') . '@shipexeg.com';
            $user->phone = $request->input('phone');
            if($request->input('password') !== null ) {
                $user->password = Hash::make($request->input('password'));
            }
            if($request->input('special_pickup')) {
                $user->special_pickup = $request->input('special_pickup');
            }
            if($request->has('avatar')) {
                // $this->uploadFile($request, $this->usersPath, 'avatar');
                // if(file_exists($user->avatar)) {
                //     $img = last(explode('/', $user->avatar));
                //     if(in_array($img, scandir(dirname($user->avatar)))) {
                //         unlink($user->avatar);
                //     }
                // }
            }
            $isSaved = $user->save();
            if ($isSaved) {
                $user->roles()->detach();
                $user->roles()->attach($request->role_id);
            }


            return response()->json(
                [
                    'message' => $isSaved ? 'user updated successfully' : 'updated failed!'
                ],
                $isSaved ? Response::HTTP_CREATED : Response::HTTP_BAD_REQUEST,
            );
        } else {
            return response()->json(['message' => $validator->getMessageBag()->first()], Response::HTTP_BAD_REQUEST);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $isDeleted = $user->delete();
        return response()->json(
            ['message' => $isDeleted ? 'Deleted successfully' : 'Delete failed!'],
            $isDeleted ? Response::HTTP_OK : Response::HTTP_BAD_REQUEST
        );
    }
}
