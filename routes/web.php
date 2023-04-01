<?php

use App\Http\Controllers\CustomerController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ManagerUlpController;
use App\Http\Controllers\MonitoringHarianController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ReportDailyController;
use App\Http\Controllers\ReportDetailController;
use App\Http\Controllers\ReportMonthlyController;
use App\Http\Controllers\ReportPrintController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UidController;
use App\Http\Controllers\UlpController;
use App\Http\Controllers\Up3Controller;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PetugasController;
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
            Route::get('/{id}/reset-password', [UserController::class, 'reset_password']);
        });
        Route::prefix('/petugass')->group(function () {
            Route::get('/download-template', [PetugasController::class, 'download'])->name('petugass.download');
            Route::post('/upload-template', [PetugasController::class, 'upload'])->name('petugass.upload');
            Route::get('/export', [PetugasController::class, 'export'])->name('petugass.export');
            Route::get('/{id}/reset-password', [PetugasController::class, 'petugass.reset_password']);
        });

        Route::resource('/users', UserController::class);
        Route::resource('/petugass', PetugasController::class);
        Route::resource('/roles', RoleController::class);
        Route::resource('/uids', UidController::class);
        Route::resource('/up3s', Up3Controller::class);
        Route::resource('/ulps', UlpController::class);
        Route::resource('/manager-ulps', ManagerUlpController::class);
        Route::resource('/customers', CustomerController::class);

        Route::get('/customers/{id}/detail', [CustomerController::class, 'show']);

        // List Server Side
        Route::post('/users/list', [UserController::class, 'list']);
        Route::post('/petugass/list', [PetugasController::class, 'list']);
        Route::post('/roles/list', [RoleController::class, 'list']);
        Route::post('/uids/list', [UidController::class, 'list']);
        Route::post('/up3s/list', [Up3Controller::class, 'list']);
        Route::post('/ulps/list', [UlpController::class, 'list']);
        Route::post('/manager-ulps/list', [ManagerUlpController::class, 'list']);
        Route::post('/customers/list', [CustomerController::class, 'list']);

        // List Select2
        Route::post('/up3/list-select', [Up3Controller::class, 'listSelect']);
        Route::post('/ulp/list-select', [UlpController::class, 'listSelect']);
        Route::post('/user/list-select', [UserController::class, 'listSelect']);
    });

    Route::prefix('/orders')->group(function () {
        Route::get('/download-template', [OrderController::class, 'download'])->name('orders.download');
        Route::post('/upload-template', [OrderController::class, 'upload'])->name('orders.upload');
        Route::get('/export', [OrderController::class, 'export'])->name('orders.export');
    });

    Route::resource('/orders', OrderController::class);
    Route::post('/orders/list', [OrderController::class, 'list']);
    Route::get('/orders/{id}/detail', [OrderController::class, 'show']);
    Route::delete('/orders/delete-logs/{uuid}', [OrderController::class, 'delete_logs']);

    // Monitoring
    Route::prefix('/monitoring')->group(function () {
        Route::resource('', MonitoringHarianController::class);
        Route::post('/list', [MonitoringHarianController::class, 'list']);
        Route::get('/{id}/detail', [MonitoringHarianController::class, 'show']);
        Route::get('/{id}/location', [MonitoringHarianController::class, 'location']);
    });

    Route::get('/report/detail/export/{up3_id}/{ulp_id}/{start_date}/{end_date}', [ReportDetailController::class, 'export'])->name('report.detail.export');
    Route::get('/report/print/print-all/{ulp_id}/{month}/{year}', [ReportPrintController::class, 'print_all']);
    Route::get('/report/monthly/share-all/{up3_id}/{ulp_id}/{month}/{year}', [ReportMonthlyController::class, 'share_all']);

    // Report
    Route::prefix('/report')->group(function () {
        // Detail
        Route::resource('/detail', ReportDetailController::class);
        Route::prefix('/detail')->group(function () {
            Route::post('/list', [ReportDetailController::class, 'list']);

            Route::get('/{id}/detail', [ReportDetailController::class, 'show']);
        });

        // Print
        Route::resource('/print', ReportPrintController::class);
        Route::prefix('/print')->group(function () {
            Route::post('/list', [ReportPrintController::class, 'list']);
            Route::get('/detail/{id}/{month}/{year}', [ReportPrintController::class, 'show']);
            Route::get('/cetak/{id}/{month}/{year}', [ReportPrintController::class, 'print']);
            Route::get('/cetak-order/{id}', [ReportPrintController::class, 'print_order']);

        });

        // Monthly
        Route::resource('/monthly', ReportMonthlyController::class);
        Route::prefix('/monthly')->group(function () {
            Route::post('/list', [ReportMonthlyController::class, 'list']);
        });

        // Daily
        Route::prefix('/daily')->group(function () {
            Route::get('/', [ReportDailyController::class, 'index']);
            Route::post('/list', [ReportDailyController::class, 'list']);
            Route::get('/export', [ReportDailyController::class, 'export']);
        });
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
