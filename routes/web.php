<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/login', [AuthController::class, 'index'])->name('login');
Route::post('/login', [AuthController::class, 'loginPost'])->name('login.post');

Route::middleware(['auth', 'role'])->group(function () {
    Route::get('/dashboard/admin', [DashboardController::class, 'homeIndex'])->name('dashboard.admin');

    // Kategori
    Route::get('/dashboard/admin/kategori', [CategoryController::class, 'kategoriIndex'])->name('dashboard.admin.kategori.view');
    Route::get('/dashboard/admin/kategori/create', [CategoryController::class, 'createKategori'])->name('dashboard.admin.kategori.create');
    Route::post('/dashboard/admin/kategori/store', [CategoryController::class, 'storeKategori'])->name('dashboard.admin.kategori.store');
});


Route::get('/', function () {
    return view('welcome');
});
