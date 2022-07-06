<?php

namespace App\Http\Controllers\Admin;

use Exception;
use App\Http\Controllers\Controller;
use App\Http\Requests\CreateUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Services\RoleService;
use App\Services\UserService;

class UsersController extends Controller
{
    protected $userService;
    protected $roleService;

    public function __construct(
        UserService $userService,
        RoleService $roleService
    ) {
        $this->userService = $userService;
        $this->roleService = $roleService;
    }

    public function index()
    {
        $this->authorize('list_users');

        $users = $this->userService->list();

        return view('admin.pages.user.index', ['users' => $users]);
    }

    public function create()
    {
        $this->authorize('create_user');

        $roles = $this->roleService->list();

        return view('admin.pages.user.create', [
            'title' => 'Tambah User',
            'roles' => $roles
        ]);
    }

    public function store(CreateUserRequest $request)
    {
        $this->authorize('create_user');

        try {

            $user = $this->userService->store($request);

            return response()->json([
                'status' => true,
                'data' => $user
            ]);
        } catch (Exception $e) {
            return response()->json([
                'status' => false,
                'message' => $e->getMessage()
            ]);
        }
    }

    public function edit(int $id)
    {
        $this->authorize('edit_user');

        $user = $this->userService->edit($id);

        $roles = $this->roleService->list();

        return view('admin.pages.user.edit', [
            'title' => 'Edit User',
            'user' => $user,
            'roles' => $roles
        ]);
    }

    public function update(UpdateUserRequest $request, int $id)
    {
        $this->authorize('edit_user');

        try {

            $user = $this->userService->update($request, $id);

            return response()->json([
                'status' => true,
                'data' => $user
            ]);
        } catch (Exception $e) {
            return response()->json([
                'status' => false,
                'message' => $e->getMessage()
            ]);
        }
    }

    public function delete(int $id)
    {
        $this->authorize('delete_user');

        try {

            $this->userService->delete($id);

            return response()->json([
                'status' => true,
                'message' => 'Sukses hapus data'
            ]);
        } catch (Exception $e) {
            return response()->json([
                'status' => false,
                'message' => $e->getMessage()
            ]);
        }
    }
}
