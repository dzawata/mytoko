<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\OrdersController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\ProductGalleriesController;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\SettingController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('login', [LoginController::class, 'index']);
Route::post('login/auth', [LoginController::class, 'authenticate'])->name('auth');

Route::prefix('admin')
    ->middleware(['auth.basic'])
    ->group(function ($router) {
        Route::get('/', [DashboardController::class, 'index']);
        Route::get('dashboard', [DashboardController::class, 'index']);

        Route::get('users', [UsersController::class, 'index'])->name('users');
        Route::get('users/create', [UsersController::class, 'create'])->name('create-user');
        Route::post('users/store', [UsersController::class, 'store'])->name('store-user');
        Route::get('users/{id}/edit', [UsersController::class, 'edit'])->name('edit-user');
        Route::put('users/update/{id}', [UsersController::class, 'update'])->name('update-user');
        Route::delete('users/delete/{id}', [UsersController::class, 'delete'])->name('delete-user');

        Route::get('roles', [RoleController::class, 'index'])->name('roles');
        Route::get('roles/create', [RoleController::class, 'create'])->name('create-role');
        Route::post('roles/store', [RoleController::class, 'store'])->name('store-role');
        Route::get('roles/{id}/edit', [RoleController::class, 'edit'])->name('edit-role');
        Route::put('roles/update/{id}', [RoleController::class, 'update'])->name('update-role');
        Route::delete('roles/delete/{id}', [RoleController::class, 'delete'])->name('delete-role');

        Route::get('permissions', [PermissionController::class, 'index'])->name('permissions');
        Route::get('permissions/create', [PermissionController::class, 'create'])->name('create-permission');
        Route::post('permissions/store', [PermissionController::class, 'store'])->name('store-permission');
        Route::delete('permissions/delete/{id}', [PermissionController::class, 'delete'])->name('delete-permission');

        Route::get('products', [ProductsController::class, 'index'])->name('products');
        Route::get('product/create', [ProductsController::class, 'create'])->name('create-product');
        Route::post('product/store', [ProductsController::class, 'store'])->name('store-product');
        Route::get('product/{id}/edit', [ProductsController::class, 'edit'])->name('edit-product');
        Route::put('product/update/{id}', [ProductsController::class, 'update'])->name('update-product');
        Route::delete('product/delete/{id}', [ProductsController::class, 'delete'])->name('delete-product');

        Route::get('product-galleries/{id}', [ProductGalleriesController::class, 'show'])->name('product-galleries');
        Route::get('product-galleries/create/{id}', [ProductGalleriesController::class, 'create'])->name('create-product-gallery');
        Route::post('product-galleries/store/{id}', [ProductGalleriesController::class, 'store'])->name('store-product-gallery');
        Route::delete('product-galleries/delete/{id}', [ProductGalleriesController::class, 'delete'])->name('delete-product-gallery');

        Route::get('order', [OrdersController::class, 'index'])->name('orders');
        Route::get('order/create', [OrdersController::class, 'create'])->name('create-order');
        Route::post('order/store', [OrdersController::class, 'store'])->name('store-order');
        Route::get('order/{id}/edit', [OrdersController::class, 'edit'])->name('edit-order');
        Route::delete('order/delete/{id}', [OrdersController::class, 'delete'])->name('delete-order');
        Route::get('order/{id}/rincian', [OrdersController::class, 'rincian'])->name('rincian-order');

        Route::get('remove-cache', [SettingController::class, 'removeCacheRoleAndPermission'])->name('remove-cache');

        Route::post('logout', [LoginController::class, 'logout'])->name('logout');
    });
