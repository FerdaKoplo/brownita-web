<?php

use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\KatalogController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\BrownitaController; // Tambahkan import ini
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

// Authentication Routes
Route::get('/register', [AuthController::class, 'viewRegister'])->name('register');
Route::post('/register', [AuthController::class, 'registerPost'])->name('register.post');
Route::post('/login', [AuthController::class, 'loginPost'])->name('login.post');
Route::get('/login', [AuthController::class, 'viewLogin'])->name('login');
Route::post('/logout', [AuthController::class, 'logoutPost'])->name('logout.post');

// Admin Routes (Protected by auth and role middleware)
Route::middleware(['auth', 'role'])->group(function () {
    Route::get('/dashboard/admin', [DashboardController::class, 'homeIndex'])->name('dashboard.admin');

    // Kategori Routes
    Route::prefix('dashboard/admin/kategori')->group(function () {
        Route::get('/', [CategoryController::class, 'kategoriIndex'])->name('dashboard.admin.kategori.view');
        Route::get('/create', [CategoryController::class, 'kategoriCreate'])->name('dashboard.admin.kategori.create');
        Route::post('/store', [CategoryController::class, 'kategoriStore'])->name('dashboard.admin.kategori.store');
        Route::get('/edit/{id}', [CategoryController::class, 'kategoriEdit'])->name('dashboard.admin.kategori.edit');
        Route::put('/update/{id}', [CategoryController::class, 'kategoriUpdate'])->name('dashboard.admin.kategori.update');
        Route::delete('/{id}', [CategoryController::class, 'kategoriDelete'])->name('dashboard.admin.kategori.delete');
    });

    // Katalog Routes
    Route::prefix('dashboard/admin/katalog')->group(function () {
        Route::get('/', [KatalogController::class, 'katalogIndex'])->name('dashboard.admin.katalog.view');
        Route::get('/create', [KatalogController::class, 'katalogCreate'])->name('dashboard.admin.katalog.create');
        Route::post('/store', [KatalogController::class, 'katalogStore'])->name('dashboard.admin.katalog.store');
        Route::get('/edit/{id}', [KatalogController::class, 'katalogEdit'])->name('dashboard.admin.katalog.edit');
        Route::put('/update/{id}', [KatalogController::class, 'katalogUpdate'])->name('dashboard.admin.katalog.update');
        Route::delete('/{id}', [KatalogController::class, 'katalogDelete'])->name('dashboard.admin.katalog.delete');
    });

    // User Account Management Routes
    Route::prefix('dashboard/admin/akun')->group(function () {
        Route::get('/', [UserController::class, 'accountAdminIndex'])->name('dashboard.admin.akun.view');
        Route::get('/create', [UserController::class, 'accountCreate'])->name('dashboard.admin.akun.create');
        Route::post('/store', [UserController::class, 'accountStore'])->name('dashboard.admin.akun.store');
        Route::get('/edit/{id}', [UserController::class, 'accountEdit'])->name('dashboard.admin.akun.edit');
        Route::put('/update/{id}', [UserController::class, 'accountUpdate'])->name('dashboard.admin.akun.update');
        Route::delete('/{id}', [UserController::class, 'accountDelete'])->name('dashboard.admin.akun.delete');
    });
});

// Customer Public Routes
Route::get('/', function () {
    return view('welcome');
})->name('landing.page');

// Product Routes
Route::get('/produk-kami', [\App\Http\Controllers\Customer\KatalogController::class, 'showKatalog'])->name('produk-kami');
Route::get('/produk/{id}', [\App\Http\Controllers\Customer\KatalogController::class, 'showDetail'])->name('produk.detail');
Route::get('/produk/{id}/show', [\App\Http\Controllers\Customer\KatalogController::class, 'show'])->name('produk.show');

// Syarat & Ketentuan Routes
Route::get('/syarat-ketentuan', function () {
    return view('layout.customer.syarat-ketentuan');
})->name('syarat-ketentuan');

Route::get('/syarat-ketentuan/order', function () {
    return view('layout.customer.Syarat - Ketentuan.order');
})->name('syarat-ketentuan.order');



// Syarat & Ketentuan - Order
Route::get('/syarat-ketentuan/order', function () {
    return view('layout.customer.Syarat - Ketentuan.order');
})->name('syarat-ketentuan.order');

// Syarat & Ketentuan - Payment
Route::get('/syarat-ketentuan/payment', function () {
    return view('layout.customer.Syarat - Ketentuan.payment');
})->name('syarat-ketentuan.payment');

// Syarat & Ketentuan - Delivery
Route::get('/syarat-ketentuan/delivery', function () {
    return view('layout.customer.Syarat - Ketentuan.delivery');
})->name('syarat-ketentuan.delivery');

// Syarat & Ketentuan - Pickup

Route::get('/syarat-ketentuan/pickup', function () {
    return view('layout.customer.Syarat - Ketentuan.pickup');
})->name('syarat-ketentuan.pickup');