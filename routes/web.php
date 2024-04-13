<?php

use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\MenuController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Frontend\HomeController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('cashier.home');
Route::get('/transaksi-sukses/{id}', [HomeController::class, 'success'])->name('cashier.success');

Auth::routes([
    'register' => false,
]);

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('dashboard', [DashboardController::class, 'index'])->middleware('auth')->name('dashboard');
Route::group(['middleware' => ['auth'], 'prefix' => 'admin', 'as' => 'admin.'], function () {

    /** category route */
    Route::resource('category', CategoryController::class);

    /** menu route */
    Route::resource('menu', MenuController::class);

    /** user route */
    Route::resource('user', UserController::class);
});
