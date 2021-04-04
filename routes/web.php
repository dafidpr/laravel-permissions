<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\PermissionController;
use App\Http\Controllers\Admin\Auth\AuthController;
use App\Http\Controllers\Admin\SettingController;

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
// Route Auth
Route::group(['middleware' => ['auth.logout_only']], function () {

    Route::get('/', [AuthController::class, 'index'])->name('login');
    Route::post('/login', [AuthController::class, 'postLogin']);
});

Route::get('/logout', [AuthController::class, 'logout']);


// Route Administrator
Route::prefix('administrator')->middleware(['auth.login_only', 'maintenance_mode', 'user_block_status'])->group(function () {
    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->middleware('can:read-dashboard');

    // User
    Route::get('/users', [UserController::class, 'index'])->middleware('can:read-users');
    Route::get('/users/create', [UserController::class, 'create'])->middleware('can:create-users');
    Route::post('/users/store', [UserController::class, 'store'])->middleware('can:create-users');
    Route::get('/users/{id}/edit', [UserController::class, 'edit'])->middleware('can:update-users');
    Route::post('/users/{id}/block', [UserController::class, 'blockUser'])->middleware('can:update-users');
    Route::post('/users/{id}/update', [UserController::class, 'update'])->middleware('can:update-users');
    Route::get('/users/change_password', [UserController::class, 'changePassword']);
    Route::post('/users/change_password/update_password', [UserController::class, 'updatePassword']);

    // Role
    Route::get('/roles', [RoleController::class, 'index'])->middleware('can:read-roles');
    Route::get('/roles/{id}/changes', [RoleController::class, 'edit'])->middleware('can:update-roles');
    Route::post('/roles/store', [RoleController::class, 'store'])->middleware('can:create-roles');
    Route::post('/roles/{id}/update', [RoleController::class, 'update'])->middleware('can:update-roles');
    Route::get('/roles/{id}/show', [RoleController::class, 'show'])->middleware('can:update-roles');
    Route::post('/roles/{id}/update', [RoleController::class, 'update'])->middleware('can:update-roles');
    Route::post('/roles/{id}/change-permission', [RoleController::class, 'changePermission'])->middleware('can:update-roles');

    // Permissions
    Route::get('/permissions', [PermissionController::class, 'index'])->middleware('can:read-permissions');
    Route::post('/permissions/store', [PermissionController::class, 'store'])->middleware('can:create-permissions');

    // Settings
    Route::get('/settings', [SettingController::class, 'index'])->middleware('can:read-settings');
    Route::get('/settings/{id}/edit', [SettingController::class, 'edit'])->middleware('can:update-settings');
    Route::post('/settings/{id}/update', [SettingController::class, 'update'])->middleware('can:update-settings');
    Route::post('/settings/{id}/maintenance', [SettingController::class, 'maintenanceMode'])->middleware('can:update-settings');
});
