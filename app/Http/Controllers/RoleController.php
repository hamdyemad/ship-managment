<?php

namespace App\Http\Controllers;

// use App\Models\Role;

use App\Models\Permission;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Symfony\Component\HttpFoundation\Response;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->authorize('roles.index');
        $roles = Role::withCount('permissions')->latest()->get();
        return response()->view('Dashboard.roles.index', ['roles' => $roles]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->authorize('roles.create');
        $permissions = Permission::all()->groupBy('group_by');
        return view('Dashboard.roles.create', ['permissions' => $permissions]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->authorize('roles.create');
        $rules = [
            'name' => 'required|string|unique:roles,name',
            'permissions' => 'required|exists:permissions,id'
        ];
        $messages = [
            'name.required' => __('validation.required'),
            'name.unique' => __('validation.unique'),
            'permissions.required' => __('validation.required'),
            'permissions.exists' => __('validation.exists'),
        ];
        $validator = Validator::make($request->all(), $rules, $messages);
        if($validator->fails()) {
            return redirect()->back()->withErrors($validator->errors())->with('error', 'يوجد خطأ ما')->withInput($request->all());
        }
        $role = Role::create([
            'name' => $request->name
        ]);
        foreach ($request->permissions as $permession) {
            $role->permissions()->attach($permession);
        }
        return redirect()->to(route('roles.index'))->with('success', __('site.save_changes'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function show(Role $role)
    {
        $this->authorize('roles.edit');
        $permessions = Permission::all()->groupBy('group_by');
        return response()->view('Dashboard.roles.edit', [
            'role' => $role,
            'permissions' => $permessions
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function edit(Role $role)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Role $role)
    {
        $this->authorize('roles.edit');
        $rules = [
            'name' => ['required', 'string', Rule::unique('roles', 'name')->ignore($role->id)],
            'permissions' => 'required|exists:permissions,id'
        ];
        $messages = [
            'name.required' => __('validation.required'),
            'name.unique' => __('validation.unique'),
            'permissions.required' => __('validation.required'),
            'permissions.exists' => __('validation.exists'),
        ];
        $validator = Validator::make($request->all(), $rules, $messages);
        if($validator->fails()) {
            return redirect()->back()->withErrors($validator->errors())->with('error', 'يوجد خطأ ما')->withInput($request->all());
        }
        $role->update([
            'name' => $request->name
        ]);
        // remove all previous permessions
        foreach ($role->permissions as $permission) {
            $role->permissions()->detach($permission);
        }
        // add new permessions
        foreach ($request->permissions as $permission) {
            $role->permissions()->attach($permission);

        }
        return redirect()->to(route('roles.index'))->with('success', __('site.save_changes'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function destroy(Role $role)
    {
        $this->authorize('roles.destroy');
        $role->delete();
        return response()->json(['message' => __('site.save_changes')], Response::HTTP_OK);
    }
}
