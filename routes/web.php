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
use Spatie\Permission\Contracts\Permission;

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
Route::get('/product/{slug}', [ProductItemController::class, 'index'])->name('product-item');

Route::get('login', [LoginController::class, 'index']);
Route::post('login/auth', [LoginController::class, 'authenticate'])->name('auth');

Route::prefix('admin')
    ->middleware(['auth.basic'])
    ->group(function ($router) {

        Route::get('/', [DashboardController::class, 'index']);
        Route::get('dashboard', [DashboardController::class, 'index']);

        Route::controller(UsersController::class)->group(function () {
            Route::get('users', 'index')->name('users');
            Route::get('users/create', 'create')->name('create-user');
            Route::post('users/store', 'store')->name('store-user');
            Route::get('users/{id}/edit', 'edit')->name('edit-user');
            Route::put('users/update/{id}', 'update')->name('update-user');
            Route::delete('users/delete/{id}', 'delete')->name('delete-user');
        });

        Route::controller(RoleController::class)->group(function () {
            Route::get('roles', 'index')->name('roles');
            Route::get('roles/create', 'create')->name('create-role');
            Route::post('roles/store', 'store')->name('store-role');
            Route::get('roles/{id}/edit', 'edit')->name('edit-role');
            Route::put('roles/update/{id}', 'update')->name('update-role');
            Route::delete('roles/delete/{id}', 'delete')->name('delete-role');
        });

        Route::controller(Permission::class)->group(function () {
            Route::get('permissions', 'index')->name('permissions');
            Route::get('permissions/create', 'create')->name('create-permission');
            Route::post('permissions/store', 'store')->name('store-permission');
            Route::delete('permissions/delete/{id}', 'delete')->name('delete-permission');
        });

        Route::controller(ProductsController::class)->group(function () {
            Route::get('products', 'index')->name('products');
            Route::get('product/create', 'create')->name('create-product');
            Route::post('product/store', 'store')->name('store-product');
            Route::get('product/{id}/edit', 'edit')->name('edit-product');
            Route::put('product/update/{id}', 'update')->name('update-product');
            Route::delete('product/delete/{id}', 'delete')->name('delete-product');
        });

        Route::controller(ProductGalleriesController::class)->group(function () {
            Route::get('product-galleries/{id}', 'show')->name('product-galleries');
            Route::get('product-galleries/create/{id}', 'create')->name('create-product-gallery');
            Route::post('product-galleries/store/{id}', 'store')->name('store-product-gallery');
            Route::delete('product-galleries/delete/{id}', 'delete')->name('delete-product-gallery');
        });

        Route::controller(OrdersController::class)->group(function () {
            Route::get('order', 'index')->name('orders');
            Route::get('order/create', 'create')->name('create-order');
            Route::post('order/store', 'store')->name('store-order');
            Route::get('order/{id}/edit', 'edit')->name('edit-order');
            Route::put('order/update/{id}', 'update')->name('update-order');
            Route::delete('order/delete/{id}', 'delete')->name('delete-order');
        });

        Route::controller(OrderItemController::class)->group(function () {
            Route::get('order/{id}/items', 'list')->name('order-items');
            Route::get('order/{id}/item/create', 'create')->name('create-order-item');
            Route::post('order/{id}/item/store', 'store')->name('store-order-item');
            Route::get('order/{orderId}/item/{itemId}/edit', 'edit')->name('edit-order-item');
            Route::put('order/{orderId}/item/update/{itemId}', 'update')->name('update-order-item');
            Route::delete('order/{orderId}/item/delete/{itemId}', 'delete')->name('delete-order-item');
        });

        Route::controller(CategoryController::class)->group(function () {
            Route::get('categories', 'index')->name('categories');
            Route::get('categories/create', 'create')->name('create-category');
            Route::post('categories/store', 'store')->name('store-category');
            Route::get('categories/{id}/edit', 'edit')->name('edit-category');
            Route::put('categories/update/{id}', 'update')->name('update-category');
            Route::delete('categories/delete/{id}', 'delete')->name('delete-category');
        });

        Route::controller(MitraController::class)->group(function () {
            Route::get('mitra', 'index')->name('mitra');
            Route::get('mitra/create', 'create')->name('create-mitra');
            Route::post('mitra/store', 'store')->name('store-mitra');
            Route::get('mitra/{id}/edit', 'edit')->name('edit-mitra');
            Route::put('mitra/update/{id}', 'update')->name('update-mitra');
            Route::delete('mitra/delete/{id}', 'delete')->name('delete-mitra');
        });

        Route::get('remove-cache', [SettingController::class, 'removeCacheRoleAndPermission'])->name('remove-cache');
        Route::post('logout', [LoginController::class, 'logout'])->name('logout');
    });
