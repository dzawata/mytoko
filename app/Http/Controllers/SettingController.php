<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
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
