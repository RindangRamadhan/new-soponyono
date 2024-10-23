<?php

use Illuminate\Support\Facades\Route;

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
    return view('website.home');
});

Route::middleware('auth', 'verified')->group(function () {
    Route::prefix('/admin')->group(function () {
        // Dashboard
        Route::get('/dashboard', function () {
            return view('admin.home');
        });

        // ...
    });
});

// Route::get('/assign-role', function () {
//     $users = User::all();

//     foreach ($users as $user) {
//         $role = Role::find(1);
//         $user->assignRole($role);
//     }

//     return 'Ok';
// });

// Route::middleware('auth', 'verified')->group(function () {
// // Profile
// Route::prefix('/users')->group(function () {
//     Route::get('/{id}/profile', [UserController::class, 'show']);
//     Route::get('/{id}/change-password', [UserController::class, 'editPass']);
//     Route::patch('/{id}/profile', [UserController::class, 'updateProfile']);
//     Route::patch('/{id}/change-password', [UserController::class, 'updatePass']);
// });
// });

require __DIR__ . '/auth.php';
