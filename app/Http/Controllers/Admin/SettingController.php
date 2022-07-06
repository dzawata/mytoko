<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Spatie\Permission\PermissionRegistrar;

class SettingController extends Controller
{
    public function removeCacheRoleAndPermission()
    {
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        return response()->json([
            'status' => true,
            'status_code' => 200,
            'message' => 'Cache Role dan Permission sudah dihapus!'
        ]);
    }
}
