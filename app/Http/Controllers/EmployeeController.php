<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use Symfony\Component\HttpFoundation\Response;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->authorize('employees.index');
        if(Auth::guard('admin')->check()) {
            $employee = Employee::all();
        } elseif(Auth::guard('employee')->check()) {
            $employee = Employee::where('id', '!=', Auth::id())->get();
        }

        return view('Dashboard.admin.employee.index', ['employee' => $employee]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->authorize('employees.create');
        $roles = Role::all();
        return view('Dashboard.admin.employee.create', ['roles' => $roles]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->authorize('employees.create');
        $validator = Validator($request->all(), [
            'name' => 'required|max:50',
            'email' => 'required|string | min:2 |max:20',
            'phone' => 'required|numeric',
            'password' => 'required|min:8|confirmed',
            'role_id' => 'required|numeric|exists:roles,id',
        ]);
        if (!$validator->fails()) {
            $employee = new Employee();
            $employee->name = $request->input('name');
            $employee->email = $request->input('email') . '@shipexeg.com';
            $employee->phone = $request->input('phone');
            $employee->password = Hash::make($request->input('password'));
            $isSaved = $employee->save();
            if ($isSaved) {
                $employee->roles()->attach($request->role_id);

            }
            return response()->json(
                [
                    'message' => $isSaved ? 'employee created successfully' : 'Create failed!'
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
     * @param  \App\Models\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function show(Employee $employee)
    {
        $user = User::all();
        return view('Dashboard.admin.search', ['user' => $user]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function edit(Employee $employee)
    {
        $this->authorize('employees.edit');
        $roles = Role::all();
        return view('Dashboard.admin.employee.edit', ['employee' => $employee, 'roles' => $roles]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Employee $employee)
    {
        $this->authorize('employees.edit');
        $rules = [
            'name' => ' max:50',
            'email' => 'string',
            'phone' => 'numeric',
            'role_id' => 'required|numeric|exists:roles,id',
        ];
        if($request->password) {
            $rules['password'] = ['min:8', 'confirmed'];
        }
        $validator = Validator($request->all(), $rules);

        if (!$validator->fails()) {


            $employee->name = $request->input('name');
            $employee->email = $request->input('email') . '@shipexeg.com';
            $employee->phone = $request->input('phone');
            $employee->password = Hash::make($request->input('password'));
            $isSaved = $employee->save();
            if ($isSaved) {
                $employee->roles()->detach();
                $employee->roles()->attach($request->role_id);
            }

            return response()->json(
                [
                    'message' => $isSaved ? 'employee updated successfully' : 'Create failed!'
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
     * @param  \App\Models\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function destroy(Employee $employee)
    {
        $this->authorize('employees.destroy');
        $isDeleted = $employee->delete();
        return response()->json(
            ['message' => $isDeleted ? 'Deleted successfully' : 'Delete failed!'],
            $isDeleted ? Response::HTTP_OK : Response::HTTP_BAD_REQUEST
        );
    }
}
