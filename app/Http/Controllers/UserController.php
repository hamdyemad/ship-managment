<?php

namespace App\Http\Controllers;

use App\Models\Area;
use App\Models\City;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use Symfony\Component\HttpFoundation\Response;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = User::all();
        return view('Dashboard.admin.seller.index', ['user' => $user]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $city = City::all();
        $roles = Role::where('guard_name', '=', 'web')->get();
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
            'phone' => 'required |numeric|digits:11',
            'password' => 'required',
            'role_id' => 'required|numeric|exists:roles,id',
        ]);
        if (!$validator->fails()) {
            $user = new User();
            $user->name = $request->input('name');
            $user->email = $request->input('email') . '@shipexeg.com';
            $user->phone = $request->input('phone');
            if (!$request->input('special_pickup')) {
                $user->special_pickup = 10;
            } else {
                $user->special_pickup = $request->input('special_pickup');
            }

            $user->password = Hash::make($request->input('password'));
            $isSaved = $user->save();
            if ($isSaved) {
                $user->syncRoles(Role::findById($request->input('role_id'), 'web'));
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
        $roles = Role::where('guard_name', '=', 'web')->get();
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

        $validator = Validator($request->all(), [
            'name' => ' max:50',
            'email' => 'string | min:2 |max:20',
            'phone' => 'numeric |digits:11',
            'special_pickup' => 'numeric',
            'role_id' => 'required|numeric|exists:roles,id',


        ]);

        if (!$validator->fails()) {

            $user->name = $request->input('name');
            $user->email = $request->input('email') . '@shipexeg.com';
            $user->phone = $request->input('phone');
            $user->password = Hash::make($request->input('password'));
            $user->special_pickup = $request->input('special_pickup');
            $isSaved = $user->save();
            if ($isSaved) {
                $user->syncRoles(Role::findById($request->input('role_id'), 'web'));
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
