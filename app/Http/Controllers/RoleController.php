<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateRoleRequest;
use App\Http\Requests\UpdateRoleRequest;
use App\Services\PermissionService;
use App\Services\RoleService;
use Exception;
use Illuminate\Http\Request;

class RoleController extends Controller
{

    protected $roleService;

    public function __construct(RoleService $roleService)
    {
        $this->roleService = $roleService;
    }

    public function index()
    {
        $this->authorize('list_roles');

        $roles = $this->roleService->list();

        return view('admin.pages.role.index', [
            'title' => 'Roles',
            'roles' => $roles
        ]);
    }

    public function create(PermissionService $permissionService)
    {
        $this->authorize('create_role');

        $permissions = $permissionService->list();

        return view('admin.pages.role.create', [
            'title' => 'Tambah Role',
            'permissions' => $permissions
        ]);
    }

    public function store(CreateRoleRequest $request)
    {
        $this->authorize('create_role');

        try {
            $role = $this->roleService->store($request);

            return response()->json([
                'status' => true,
                'data' => $role
            ]);
        } catch (Exception $e) {
            return response()->json([
                'status' => false,
                'message' => $e->getMessage()
            ]);
        }
    }

    public function edit(PermissionService $permissionService, $id)
    {
        $this->authorize('edit_role');

        $role = $this->roleService->edit($id);

        return view('admin.pages.role.edit', [
            'title' => 'Edit Role',
            'role' => $role,
            'permissions' => $permissionService->list()
        ]);
    }

    public function update(UpdateRoleRequest $request, int $id)
    {

        $this->authorize('edit_role');

        try {
            $role = $this->roleService->update($request, $id);

            return response()->json([
                'status' => true,
                'data' => $role
            ]);
        } catch (Exception $e) {
            return response()->json([
                'status' => false,
                'message' => $e->getMessage()
            ]);
        }
    }

    public function delete($id)
    {

        $this->authorize('delete_role');

        try {

            $this->roleService->delete($id);

            return response()->json([
                'status' => true,
                'message' => 'Success hapus data'
            ]);
        } catch (Exception $e) {
            return response()->json([
                'status' => false,
                'message' => $e->getMessage()
            ]);
        }
    }
}
