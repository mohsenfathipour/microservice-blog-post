<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreRoleRequest;
use App\Http\Requests\UpdateRoleRequest;
use App\Models\Permission;
use App\Models\Role;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Response;


class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $roles = Role::all();

        return response()->json([
            'success' => true,
            'data' => $roles,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreRoleRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreRoleRequest $request)
    {
        $role = new Role();
        $role->name = $request->input('name');
        $role->creator_id = Auth::user()->id;
        $role->save();

        return response()->json([
            'success' => true,
            'data' => $role,
        ], Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function show(Role $role)
    {
        return response()->json([
            'success' => true,
            'data' => $role,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateRoleRequest  $request
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRoleRequest $request, Role $role)
    {
        $role->name = $request->input('name');
        $role->save();

        return response()->json([
            'success' => true,
            'data' => $role,
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function destroy(Role $role)
    {
        $role->delete();

        return response()->json([
            'success' => true,
            'message' => 'Role deleted successfully',
        ]);
    }

    public function permission(Role $role)
    {
        $role->load(['permissions']);

        return response()->json([
            'success' => true,
            'data' => $role->permissions()->get(),
        ]);
    }
    public function storePermissionToRole( Role $role, Permission $permission)
    {
        $role->permissions()->syncWithoutDetaching($permission);
        return response()->json(['message' => 'Permission added to role successfully.']);
    }
    public function destroyPermissionToRole( Role $role, Permission $permission)
    {
        $role->permissions()->syncWithoutDetaching($permission);
        return response()->json(['message' => 'Permission removed to role successfully.']);
    }
}
