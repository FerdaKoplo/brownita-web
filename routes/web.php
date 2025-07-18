<?php

use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\KatalogController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\AuthController;
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

Route::get('/register', [AuthController::class, 'viewRegister'])->name('register');
Route::post('/register', [AuthController::class, 'registerPost'])->name('register.post');


Route::post('/login', [AuthController::class, 'loginPost'])->name('login.post');
Route::get('/login', [AuthController::class, 'viewLogin'])->name('login');
Route::post('/logout', [AuthController::class, 'logoutPost'])->name('logout.post');

Route::middleware(['auth', 'isAdmin'])->group(function () {
    Route::get('/dashboard/admin', [DashboardController::class, 'homeIndex'])->name('dashboard.admin');

    // Kategori
    Route::get('/dashboard/admin/kategori', [CategoryController::class, 'kategoriIndex'])->name('dashboard.admin.kategori.view');

    // Create Kategori
    Route::get('/dashboard/admin/kategori/create', [CategoryController::class, 'kategoriCreate'])->name('dashboard.admin.kategori.create');
    Route::post('/dashboard/admin/kategori/store', [CategoryController::class, 'kategoriStore'])->name('dashboard.admin.kategori.store');

    // Edit Kategori
    Route::get('/dashboard/admin/kategori/edit/{id}', [CategoryController::class, 'kategoriEdit'])->name('dashboard.admin.kategori.edit');
    Route::put('/dashboard/admin/kategori/update/{id}', [CategoryController::class, 'kategoriUpdate'])->name('dashboard.admin.kategori.update');

    // Delete Kategori
    Route::delete('/dashboard/admin/kategori/{id}', [CategoryController::class, 'kategoriDelete'])->name('dashboard.admin.kategori.delete');

    // Katalog
    Route::get('/dashboard/admin/katalog', [KatalogController::class, 'katalogIndex'])->name('dashboard.admin.katalog.view');
    // Create Katalog
    Route::get('/dashboard/admin/katalog/create', [KatalogController::class, 'katalogCreate'])->name('dashboard.admin.katalog.create');
    Route::post('/dashboard/admin/katalog/store', [KatalogController::class, 'katalogStore'])->name('dashboard.admin.katalog.store');
    // Edit Katalog
    Route::get('/dashboard/admin/katalog/edit/{id}', [KatalogController::class, 'katalogEdit'])->name('dashboard.admin.katalog.edit');
    Route::put('/dashboard/admin/katalog/update/{id}', [KatalogController::class, 'katalogUpdate'])->name('dashboard.admin.katalog.update');
    // Delete Katalog
    Route::delete('/dashboard/admin/katalog/{id}', [KatalogController::class, 'katalogDelete'])->name('dashboard.admin.katalog.delete');

    // Katalog
    Route::get('/dashboard/admin/akun', [UserController::class, 'accountAdminIndex'])->name('dashboard.admin.akun.view');
    // Create Katalog
    // Route::get('/dashboard/admin/katalog/create', [UserController::class, 'katalogCreate'])->name('dashboard.admin.katalog.create');
    // Route::post('/dashboard/admin/katalog/store', [UserController::class, 'katalogStore'])->name('dashboard.admin.katalog.store');
    // // Edit Katalog
    // Route::get('/dashboard/admin/katalog/edit/{id}', [UserController::class, 'katalogEdit'])->name('dashboard.admin.katalog.edit');
    // Route::put('/dashboard/admin/katalog/update/{id}', [UserController::class, 'katalogUpdate'])->name('dashboard.admin.katalog.update');
    // // Delete Katalog
    // Route::delete('/dashboard/admin/katalog/{id}', [UserController::class, 'katalogDelete'])->name('dashboard.admin.katalog.delete');
});

Route::middleware(['auth', 'isCustomer'])->group(function () {

    // Keranjang
    Route::get('/keranjang', [\App\Http\Controllers\Customer\KeranjangController::class, 'keranjangIndex'])->name('keranjang');
    Route::post('/keranjang', [\App\Http\Controllers\Customer\KeranjangController::class, 'keranjangStore'])->name('keranjang.store');
    Route::patch('/keranjang/{id}/update', [\App\Http\Controllers\Customer\KeranjangController::class, 'keranjangUpdate'])->name('customer.keranjang.update');
});


// Customer Logged Out Route

Route::get('/', function () {
    return view('welcome');
})->name('landing.page');

Route::get('/produk-kami', [\App\Http\Controllers\Customer\KatalogController::class, 'showKatalog'])->name('produk-kami');

Route::get('/produk/{id}', [\App\Http\Controllers\Customer\KatalogController::class, 'showDetail'])
    ->name('produk.detail');

