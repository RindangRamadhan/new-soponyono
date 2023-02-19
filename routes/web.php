<?php

use App\Http\Controllers\CustomerController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UidController;
use App\Http\Controllers\UlpController;
use App\Http\Controllers\Up3Controller;
use App\Http\Controllers\UserController;
use App\Models\User;
use Illuminate\Support\Facades\Route;
use Spatie\Permission\Models\Role;

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

Route::get('/assign-role', function () {
    $users = User::all();

    foreach ($users as $user) {
        $role = Role::find(1);
        $user->assignRole($role);
    }

    return 'Ok';
});

Route::middleware('auth', 'verified')->group(function () {
    // Dashboard
    Route::get('/', [DashboardController::class, 'index']);
    Route::post('/filter', [DashboardController::class, 'filter'])->name('dashboard.filter');

    // Master Data
    Route::prefix('/master-data')->group(function () {
        Route::prefix('/users')->group(function () {
            Route::get('/download-template', [UserController::class, 'download'])->name('users.download');
            Route::post('/upload-template', [UserController::class, 'upload'])->name('users.upload');
            Route::get('/export', [UserController::class, 'export'])->name('users.export');
        });

        Route::resource('/users', UserController::class);
        Route::resource('/roles', RoleController::class);
        Route::resource('/uids', UidController::class);
        Route::resource('/up3s', Up3Controller::class);
        Route::resource('/ulps', UlpController::class);
        Route::resource('/customers', CustomerController::class);

        Route::get('/customers/{id}/detail', [CustomerController::class, 'detail']);

        // List Server Side
        Route::post('/users/list', [UserController::class, 'list']);
        Route::post('/roles/list', [RoleController::class, 'list']);
        Route::post('/uids/list', [UidController::class, 'list']);
        Route::post('/up3s/list', [Up3Controller::class, 'list']);
        Route::post('/ulps/list', [UlpController::class, 'list']);
        Route::post('/customers/list', [CustomerController::class, 'list']);

        // List Select2
        Route::post('/up3/list-select', [Up3Controller::class, 'listSelect']);
        Route::post('/ulp/list-select', [UlpController::class, 'listSelect']);
    });

    // Profile
    Route::prefix('/users')->group(function () {
        Route::get('/{id}/profile', [UserController::class, 'show']);
        Route::get('/{id}/change-password', [UserController::class, 'editPass']);
        Route::patch('/{id}/profile', [UserController::class, 'updateProfile']);
        Route::patch('/{id}/change-password', [UserController::class, 'updatePass']);
    });
});

require __DIR__ . '/auth.php';
