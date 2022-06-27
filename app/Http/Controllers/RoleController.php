<?php

namespace App\Http\Controllers;

// use App\Models\Role;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
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
        $roles = Role::withCount('permissions')->get();
        return response()->view('Dashboard.roles.index', ['roles' => $roles]);
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
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function show(Role $role)
    {
        //
        $permissions = Permission::where('guard_name', '=', $role->guard_name)->get();
        $rolePermissions = $role->permissions;
        if (count($rolePermissions) > 0) {
            foreach ($permissions as $permission) {
                foreach ($rolePermissions as $rolePermission) {
                    if ($rolePermission->id == $permission->id) {
                        $permission->setAttribute('assigned', true);
                    }
                }
            }
        }
        // dd($permissions);
        return response()->view('Dashboard.roles.role-permissions', [
            'role' => $role,
            'permissions' => $permissions
        ]);
    }
    public function updateRolePermission(Request $request)
    {
        $validator = Validator($request->all(), [
            'role_id' => 'required|numeric|exists:roles,id',
            'permission_id' => 'required|numeric|exists:permissions,id',
        ]);
        if (!$validator->fails()) {
            $role = Role::findOrFail($request->input('role_id'));
            $permission = Permission::findOrFail($request->input('permission_id'));
            if ($role->hasPermissionTo($permission)) {
                $role->revokePermissionTo($permission);
            } else {
                $role->givePermissionTo($permission);
            }
            return response()->json(['message' => 'Updated successfully'], Response::HTTP_OK);
        } else {
            return response()->json(['message' => $validator->getMessageBag()->first()], Response::HTTP_BAD_REQUEST);
        }
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function destroy(Role $role)
    {
        //
    }
}
