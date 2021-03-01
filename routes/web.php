<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\PermissionController;
use App\Http\Controllers\Admin\MenuController;
use App\Http\Controllers\Admin\SubmenuController;
use App\Http\Controllers\Admin\MenuGroupController;
use App\Http\Controllers\Admin\Auth\AuthController;

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
Route::prefix('administrator')->middleware(['auth.login_only', 'append.menu'])->group(function(){
    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->middleware('can:read-dashboard');

    // User
    Route::get('/users', [UserController::class, 'index'])->middleware('can:read-users');
    Route::get('/users/create', [UserController::class, 'create'])->middleware('can:create-users');
    Route::post('/users/store', [UserController::class, 'store'])->middleware('can:create-users');
    Route::get('/users/{id}/edit', [UserController::class, 'edit'])->middleware('can:update-users');
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

    // Permissions
    Route::get('/permissions', [PermissionController::class, 'index'])->middleware('can:read-permissions');
    Route::get('/permissions/loadDatatable', [PermissionController::class, 'loadDatatable']);
    Route::post('/permissions/store', [PermissionController::class, 'store'])->middleware('can:create-permissions');

    // Menu
    Route::get('/menus', [MenuController::class, 'index'])->middleware('can:read-menus');
    Route::get('/menus/create', [MenuController::class, 'create'])->middleware('can:create-menus');
    Route::get('/menus/{id}/edit', [MenuController::class, 'edit'])->middleware('can:update-menus');
    Route::post('/menus/{id}/update', [MenuController::class, 'update'])->middleware('can:update-menus');
    Route::post('/menus/store', [MenuController::class, 'store'])->middleware('can:create-menus');

    // Sub menu
    Route::get('/sub-menus', [SubmenuController::class, 'index'])->middleware('can:read-sub-menus');
    Route::get('/sub-menus/create', [SubmenuController::class, 'create'])->middleware('can:create-sub-menus');
    Route::get('/sub-menus/{id}/edit', [SubmenuController::class, 'edit'])->middleware('can:update-sub-menus');
    Route::post('/sub-menus/{id}/update', [SubmenuController::class, 'update'])->middleware('can:update-sub-menus');
    Route::post('/sub-menus/{id}/destroy', [SubmenuController::class, 'destroy'])->middleware('can:delete-sub-menus');
    Route::post('/sub-menus/store', [SubmenuController::class, 'store'])->middleware('can:create-sub-menus');

    // Menu Group
    Route::get('/menu-groups', [MenuGroupController::class, 'index'])->middleware('can:read-menu-groups');
    Route::post('/menu-groups/store', [MenuGroupController::class, 'store'])->middleware('can:create-menu-groups');
});

