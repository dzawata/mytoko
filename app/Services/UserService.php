<?php

namespace App\Services;

use Exception;
use App\Models\User;
use App\Services\RoleService;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;

class UserService
{
    protected $roleService;

    public function __construct(RoleService $roleService)
    {
        $this->roleService = $roleService;
    }

    public function list()
    {
        $users = User::orderBy('id')->get();

        $data = [];
        foreach ($users as $user) {

            $data[] = (object)[
                'id' => $user->id,
                'name' => $user->name,
                'email' => $user->email,
                'role' => $user->getRoleNames()[0]
            ];
        }

        return $data;
    }

    public function store($request)
    {
        try {

            DB::beginTransaction();

            $user = User::create([
                'name' => $request->nama,
                'email' => $request->email,
                'password' => password_hash($request->password, PASSWORD_BCRYPT)
            ]);

            $user->assignRole($request->role);

            DB::commit();

            return $user;
        } catch (Exception $e) {

            DB::rollBack();

            throw $e;
        }
    }

    public function edit(int $id)
    {
        $user = User::findOrFail($id);

        $roles = [];
        $roleAll = Role::all();
        foreach ($roleAll as $role) {
            if ($user->hasRole($role->id)) {
                $roles[] = $role->id;
            }
        }

        $user->role = json_encode($roles);
        return $user;
    }

    public function update($request, $id)
    {
        try {
            DB::beginTransaction();

            $data = [
                'name' => $request->nama,
                'email' => $request->email
            ];

            if (!empty($request->password)) {
                $data['password'] = password_hash($request->password, PASSWORD_BCRYPT);
            }

            $user = User::findOrFail($id);

            $user->update($data);

            $user->syncRoles($request->role);

            DB::commit();

            return $user;
        } catch (Exception $e) {

            DB::rollBack();

            throw $e;
        }
    }

    public function delete($id)
    {
        try {
            $user = User::findOrFail($id);
            $user->roles()->detach();
            $user->delete();
        } catch (Exception $e) {
            throw $e;
        }
    }
}
