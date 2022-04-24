<?php

namespace App\Services;

use Exception;
use Spatie\Permission\Models\Role;
use App\Models\UserHasRole;
use Illuminate\Support\Facades\DB;

class RoleService
{
    protected $permissionService;

    public function __construct(PermissionService $permissionService)
    {
        $this->permissionService = $permissionService;
    }

    public function list()
    {
        return Role::all();
    }

    public function store($request)
    {
        try {

            DB::beginTransaction();

            $role = Role::create([
                'name' => $request->role,
                'guard_name' => 'web'
            ]);

            $role->givePermissionTo($request->permissions);

            DB::commit();
        } catch (Exception $e) {

            DB::rollBack();

            throw $e;
        }
    }

    public function edit(int $id)
    {
        $role = Role::findOrFail($id);

        $permissions = [];
        foreach ($role->permissions as $permission) {
            $permissions[] = $permission->id;
        }
        $role->hasPermissions = json_encode($permissions);

        return $role;
    }

    public function update($request, $id)
    {
        try {
            DB::beginTransaction();

            $role = Role::findOrFail($id);

            $role->update([
                'name' => $request->role
            ]);

            $role->syncPermissions($request->permissions);

            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }

    public function delete($id)
    {
        try {

            $role = Role::findOrFail($id);
            $role->delete();
        } catch (Exception $e) {
            return $e;
        }
    }
}
