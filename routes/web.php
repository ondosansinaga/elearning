<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin;
use App\Http\Controllers\HomeController;

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
Route::get('/', [HomeController::class, 'get'])->middleware('guest');

Route::get('/admin/dashboard', [Admin\DashboardController::class, 'get'])
    ->name('admin-dashboard')
    ->middleware('auth:admin');

Route::get('/admin/login', [Admin\AuthController::class, 'get'])->middleware('guest:admin');

Route::get('/admin/lecturers', [Admin\LecturerController::class, 'get'])->middleware('auth:admin');

Route::get('/admin/lecturers/add', [Admin\LecturerController::class, 'add'])->middleware('auth:admin');

Route::post('/admin/lecturers/add', [Admin\LecturerController::class, 'store'])->middleware('auth:admin');

Route::delete('/admin/lecturers/delete/{lecturerId}', [Admin\LecturerController::class, 'delete'])->middleware('auth:admin');

Route::get('/admin/lecturers/update/{lecturerId}', [Admin\LecturerController::class, 'edit'])->middleware('auth:admin');

Route::put('/admin/lecturers/update/{lecturerId}', [Admin\LecturerController::class, 'update'])->middleware('auth:admin');

Route::delete('/admin/logout', [Admin\AuthController::class, 'logout'])->middleware('auth:admin');

Route::post('/admin/login', [Admin\AuthController::class, 'attempt'])->middleware('guest:admin');
