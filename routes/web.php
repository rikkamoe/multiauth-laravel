<?php

use App\Http\Controllers\CashierController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\FounderController;
use App\Http\Controllers\SuperadminController;

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

Route::group(['middleware' => ['auth']], function() {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
});

Route::group(['middleware' => ['auth', 'role:user']], function() {
    Route::get('/dashboard/customer', [CustomerController::class, 'index'])->name('dashboard.customer');
});

Route::group(['middleware' => ['auth', 'role:superadmin']], function() {
    Route::get('/dashboard/superadmin', [SuperadminController::class, 'index'])->name('dashboard.superadmin');
});

Route::group(['middleware' => ['auth', 'role:founder']], function() {
    Route::get('/dashboard/founder', [FounderController::class, 'index'])->name('dashboard.founder');
});

Route::group(['middleware' => ['auth', 'role:cashier']], function() {
    Route::get('/dashboard/cashier', [CashierController::class, 'index'])->name('dashboard.cashier');
});

require __DIR__.'/auth.php';
