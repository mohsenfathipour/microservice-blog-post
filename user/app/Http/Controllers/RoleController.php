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
    public function index()
    {
        $roles = Role::all();

        return response()->json([
            'success' => true,
            'data' => $roles,
        ]);
    }

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

    public function show(Role $role)
    {
        return response()->json([
            'success' => true,
            'data' => $role,
        ]);
    }

    public function update(UpdateRoleRequest $request, Role $role)
    {
        $role->name = $request->input('name');
        $role->save();

        return response()->json([
            'success' => true,
            'data' => $role,
        ]);
    }

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
        return response()->json([
            'success' => true,
            'message' => 'Permission added to role successfully.'
        ]);
    }
    public function destroyPermissionToRole( Role $role, Permission $permission)
    {
        $role->permissions()->detach($permission);
        return response()->json([
            'success' => true,
            'message' => 'Permission removed to role successfully.'
        ]);
    }
}
