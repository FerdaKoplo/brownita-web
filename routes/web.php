<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\KatalogController;
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

    Route::get('/dashboard/admin/kategori/create', [CategoryController::class, 'kategoriCreate'])->name('dashboard.admin.kategori.create');
    Route::post('/dashboard/admin/kategori/store', [CategoryController::class, 'kategoriStore'])->name('dashboard.admin.kategori.store');

    Route::get('/dashboard/admin/kategori/edit/{id}', [CategoryController::class, 'kategoriEdit'])->name('dashboard.admin.kategori.edit');
    Route::put('/dashboard/admin/kategori/update/{id}', [CategoryController::class, 'kategoriUpdate'])->name('dashboard.admin.kategori.update');

    Route::delete('/dashboard/admin/kategori/{id}', [CategoryController::class, 'kategoriDelete'])->name('dashboard.admin.kategori.delete');

    // Katalog
    Route::get('/dashboard/admin/katalog', [KatalogController::class, 'katalogIndex'])->name('dashboard.admin.katalog.view');
    Route::get('/dashboard/admin/katalog/create', [KatalogController::class, 'katalogCreate'])->name('dashboard.admin.katalog.create');
    Route::post('/dashboard/admin/katalog/store', [KatalogController::class, 'katalogStore'])->name('dashboard.admin.katalog.store');

});

// Customer routes (no authentication required)
// ✅ Beranda (Home)
Route::get('/', function () {
    return view('customer.home');
})->name('home');

// ✅ Produk Kami → Katalog
Route::get('/produk-kami', [KatalogController::class, 'showKatalog'])->name('produk-kami');

// ✅ Halaman statis
Route::get('/tentang-kami', fn() => view('customer.tentang-kami'))->name('tentang-kami');
Route::get('/founder', fn() => view('customer.founder'))->name('founder');
Route::get('/lokasi', fn() => view('customer.lokasi'))->name('lokasi');