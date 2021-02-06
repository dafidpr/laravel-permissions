<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\RoleController;
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
    Route::get('/logout', [AuthController::class, 'logout']);
});


// Route Administrator
Route::prefix('administrator')->middleware(['auth.login_only'])->group(function(){
    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index']);

    // User
    Route::get('/users', [UserController::class, 'index']);
    Route::get('/users/create', [UserController::class, 'create']);
    Route::post('/users/store', [UserController::class, 'store']);
    
    // Role
    Route::get('/roles', [RoleController::class, 'index']);
    Route::post('/role/store', [RoleController::class, 'store']);
});

