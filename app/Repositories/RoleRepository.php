<?php

namespace App\Repositories;

use App\Helpers\Helper;
use App\Http\Requests\RoleRequest;
use App\Interfaces\RoleInterface;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;

class RoleRepository implements RoleInterface
{
    function list() {
        return Role::select('id', 'name');
    }

    public function create()
    {
        $allPermissions = Permission::select("id", "name AS text")
            ->orderBy('id', 'asc')
            ->get();

        foreach ($allPermissions as &$v) {
            $arr = explode("-", $v['text']);

            if (count($arr) > 1) {
                $v["parent"] = $arr[0];
                $v["text"] = $arr[1];
            } else {
                $v["parent"] = null;
            }
        }

        return Helper::buildTreeView(json_decode(json_encode($allPermissions)));
    }

    public function store(RoleRequest $request)
    {
        // Reset cached roles and permissions
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        $role = Role::create(['name' => $request->name]);

        $roleHasPermissions = [];

        foreach (explode(",", $request->permission) as $v) {

            if ($v != "") {
                $roleHasPermissions[] = [
                    "permission_id" => $v,
                    "role_id" => $role->id,
                ];
            }

        }

        if (count($roleHasPermissions) > 0) {
            // Give role permissions
            DB::table('role_has_permissions')->insert($roleHasPermissions);
        }
    }

    public function edit($id)
    {
        $allPermissions = Permission::select("id", "name AS text")
            ->orderBy('id', 'asc')
            ->get();

        $role = Role::select('id', 'name')->find($id);
        $selectedPermissions = DB::table('role_has_permissions')
            ->join('permissions', 'role_has_permissions.permission_id', '=', 'permissions.id')
            ->select('permissions.id', 'permissions.name')
            ->where('role_id', $id)->get();

        foreach ($allPermissions as &$v) {
            $arr = explode("-", $v['text']);

            if (count($arr) > 1) {
                $v["parent"] = $arr[0];
                $v["text"] = $arr[1];
            } else {
                $v["parent"] = null;
            }
        }

        $permissions = Helper::buildTreeView(json_decode(json_encode($allPermissions)));

        return [$role, $permissions, $selectedPermissions];
    }

    public function update(RoleRequest $request, $id)
    {
        // Reset cached roles and permissions
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        $roleHasPermissions = [];
        foreach (explode(",", $request->permission) as $v) {

            if ($v != "") {
                $roleHasPermissions[] = [
                    "permission_id" => $v,
                    "role_id" => $id,
                ];
            }

        }

        Role::find($id)->update(['name' => $request->name]);

        if (count($roleHasPermissions) > 0) {
            // Give role permissions
            DB::table('role_has_permissions')->where("role_id", $id)->delete();
            DB::table('role_has_permissions')->insert($roleHasPermissions);
        }
    }

    public function destroy($id)
    {
        $role = Role::find($id);
        $role_permission = DB::table('role_has_permissions')->where("role_id", $id);

        if ($role_permission->count() > 0) {
            return response()->json([
                'status' => 500,
            ]);
        } else {
            $role->delete();
            $role_permission->delete();

            return response()->json([
                'status' => 200,
            ]);
        }
    }
}
