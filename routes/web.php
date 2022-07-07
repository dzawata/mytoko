<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\LoginController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\MitraController;
use App\Http\Controllers\Admin\OrderItemController;
use App\Http\Controllers\Admin\OrdersController;
use App\Http\Controllers\Admin\PermissionController;
use App\Http\Controllers\Admin\ProductGalleriesController;
use App\Http\Controllers\Admin\ProductsController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\UsersController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Front\HomeController;
use App\Http\Controllers\Front\ProductItemController;

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

Route::get('/', [HomeController::class, 'home']);
Route::get('/home', [HomeController::class, 'home']);
Route::get('/product-item/{id}', [ProductItemController::class, 'index'])->name('product-item');

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
        Route::put('order/update/{id}', [OrdersController::class, 'update'])->name('update-order');
        Route::delete('order/delete/{id}', [OrdersController::class, 'delete'])->name('delete-order');

        Route::get('order/{id}/items', [OrderItemController::class, 'list'])->name('order-items');
        Route::get('order/{id}/item/create', [OrderItemController::class, 'create'])->name('create-order-item');
        Route::post('order/{id}/item/store', [OrderItemController::class, 'store'])->name('store-order-item');
        Route::get('order/{orderId}/item/{itemId}/edit', [OrderItemController::class, 'edit'])->name('edit-order-item');
        Route::put('order/{orderId}/item/update/{itemId}', [OrderItemController::class, 'update'])->name('update-order-item');
        Route::delete('order/{orderId}/item/delete/{itemId}', [OrderItemController::class, 'delete'])->name('delete-order-item');

        Route::get('categories', [CategoryController::class, 'index'])->name('categories');
        Route::get('categories/create', [CategoryController::class, 'create'])->name('create-category');
        Route::post('categories/store', [CategoryController::class, 'store'])->name('store-category');
        Route::get('categories/{id}/edit', [CategoryController::class, 'edit'])->name('edit-category');
        Route::put('categories/update/{id}', [CategoryController::class, 'update'])->name('update-category');
        Route::delete('categories/delete/{id}', [CategoryController::class, 'delete'])->name('delete-category');

        Route::get('mitra', [MitraController::class, 'index'])->name('mitra');
        Route::get('mitra/create', [MitraController::class, 'create'])->name('create-mitra');
        Route::post('mitra/store', [MitraController::class, 'store'])->name('store-mitra');
        Route::get('mitra/{id}/edit', [MitraController::class, 'edit'])->name('edit-mitra');
        Route::put('mitra/update/{id}', [MitraController::class, 'update'])->name('update-mitra');
        Route::delete('mitra/delete/{id}', [MitraController::class, 'delete'])->name('delete-mitra');

        Route::get('remove-cache', [SettingController::class, 'removeCacheRoleAndPermission'])->name('remove-cache');
        Route::post('logout', [LoginController::class, 'logout'])->name('logout');
    });
