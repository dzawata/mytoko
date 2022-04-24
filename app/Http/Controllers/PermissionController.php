<?php

namespace App\Http\Controllers;

use Exception;
use App\Http\Requests\CreatePermissionRequest;
use App\Services\PermissionService;

class PermissionController extends Controller
{
    protected $permissionService;

    public function __construct(PermissionService $permissionService)
    {
        $this->permissionService = $permissionService;
    }

    public function index()
    {
        $permissions = $this->permissionService->list();

        return view('admin.pages.permission.index', [
            'title' => 'Permissions',
            'permissions' => $permissions
        ]);
    }

    public function create()
    {
        return view('admin.pages.permission.create', [
            'title' => 'Tambah Permission'
        ]);
    }

    public function store(CreatePermissionRequest $request)
    {
        try {

            $permission = $this->permissionService->store($request);

            return response()->json([
                'status' => true,
                'data' => $permission
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
        try {

            $this->permissionService->delete($id);

            return response()->json([
                'status' => true,
                'message' => 'Sukses hapus permission'
            ]);
        } catch (Exception $e) {
            return response()->json([
                'status' => false,
                'message' => $e->getMessage()
            ]);
        }
    }
}
