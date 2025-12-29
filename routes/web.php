<?php

use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\KatalogController;
use App\Http\Controllers\Admin\ManualTransactionController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Customer\TransaksiController;
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
Route::middleware('guest')->group(function () {
    Route::get('/register', [AuthController::class, 'viewRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'registerPost'])->name('register.post');

    Route::get('/login', [AuthController::class, 'viewLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'loginPost'])->name('login.post');
});

Route::post('/logout', [AuthController::class, 'logoutPost'])->name('logout.post');

Route::middleware(['auth', 'isAdmin'])->group(function () {
    Route::get('/dashboard/admin', [\App\Http\Controllers\Admin\DashboardController::class, 'homeIndex'])->name('dashboard.admin');

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

    // Akun
    Route::get('/dashboard/admin/akun', [UserController::class, 'accountAdminIndex'])->name('dashboard.admin.akun.view');
    Route::get('/dashboard/admin/akun/create', [UserController::class, 'accountAdminCreate'])->name('dashboard.admin.akun.create');
    Route::post('/dashboard/admin/akun/store', [UserController::class, 'accountAdminStore'])->name('dashboard.admin.akun.store');
    Route::get('/dashboard/admin/akun/edit/{id}', [UserController::class, 'accountAdminEdit'])->name('dashboard.admin.akun.edit');
    Route::put('/dashboard/admin/akun/update/{id}', [UserController::class, 'accountAdminUpdate'])->name('dashboard.admin.akun.update');
    Route::delete('/dashboard/admin/akun/delete/{id}', [UserController::class, 'accountAdminDelete'])->name('dashboard.admin.akun.delete');

    // Transaksi
    Route::get('/dashboard/admin/customer-transaction', [\App\Http\Controllers\Admin\TransaksiController::class, 'transaksiIndex'])->name('dashboard.admin.customer-transaction.view');
    Route::get('/dashboard/admin/customer-transaction/{id}', [\App\Http\Controllers\Admin\TransaksiController::class, 'transaksiShow'])->name('dashboard.admin.customer-transaction.show');
    Route::put('/dashboard/admin/customer-transaction/update/{id}', [\App\Http\Controllers\Admin\TransaksiController::class, 'transaksiUpdate'])->name('dashboard.admin.customer-transaction.update');
    Route::delete('/dashboard/admin/customer-transaction/{id}', [\App\Http\Controllers\Admin\TransaksiController::class, 'transaksiDelete'])->name('dashboard.admin.customer-transaction.delete');

    // Pencacatan Manual Transaksi
    Route::get('/dashboard/admin/pencacatan-transaksi-customer', [ManualTransactionController::class, 'manualTransaksiIndex'])->name('dashboard.admin.manual-transaksi.index');
    Route::get('/dashboard/admin/pencacatan-transaksi-customer/create', [ManualTransactionController::class, 'createManualTransaksi'])->name('dashboard.admin.manual-transaksi.create');
    Route::post('/dashboard/admin/pencacatan-transaksi-customer/store', [ManualTransactionController::class, 'storeManualTransaksi'])->name('dashboard.admin.manual-transaksi.store');
    Route::get('/dashboard/admin/pencacatan-transaksi-customer/edit/{id}', [ManualTransactionController::class, 'editManualTransaksi'])->name('dashboard.admin.manual-transaksi.edit');
    Route::put('/dashboard/admin/pencacatan-transaksi-customer/update/{id}', [ManualTransactionController::class, 'updateManualTransaksi'])->name('dashboard.admin.manual-transaksi.update');
    Route::delete('/dashboard/admin/pencacatan-transaksi-customer/delete/{id}', [ManualTransactionController::class, 'destroyManualTransaksi'])->name('dashboard.admin.manual-transaksi.destroy');

    // Landing Page
    Route::post('/dashboard/admin/landing-page/update/{section}',[\App\Http\Controllers\Admin\LandingPageController::class, 'landingPageUpdate'])->name('dashboard.admin.landing-page.update');
        Route::get('/dashboard/admin/landing-page', [\App\Http\Controllers\Admin\LandingPageController::class, 'landingPageIndex'])->name('dashboard.admin.landing-page.view');
    Route::get('/dashboard/admin/landing-page/preview', [\App\Http\Controllers\Admin\LandingPageController::class, 'previewLandingPage'])->name('dashboard.admin.landing-page.preview');


});

Route::middleware(['auth', 'isCustomer'])->group(function () {

    // Keranjang
    Route::get('/keranjang', [\App\Http\Controllers\Customer\KeranjangController::class, 'keranjangIndex'])->name('keranjang');
    Route::post('/keranjang', [\App\Http\Controllers\Customer\KeranjangController::class, 'keranjangStore'])->name('keranjang.store');
    Route::patch('/keranjang/{id}/update', [\App\Http\Controllers\Customer\KeranjangController::class, 'keranjangUpdate'])->name('customer.keranjang.update');

    // Transaksi
    Route::get('/transaksi', [TransaksiController::class, 'transaksiIndex'])->name('customer.transaksi.index');
    Route::get('/transaksi/{id}', [TransaksiController::class, 'transaksiShow'])->name('customer.transaksi.show');
    Route::post('/transaksi', [TransaksiController::class, 'transaksiStore'])->name('customer.transaksi.store');
    Route::post('/transaksi/{id}/upload-bukti', [App\Http\Controllers\Customer\TransaksiController::class, 'uploadBukti'])
        ->name('customer.transaksi.uploadBukti');
});


Route::middleware('redirectIfAdmin')->group(function () {
    Route::get('/', function () {
        return view('welcome');
    })->name('landing.page');

    Route::get('/produk-kami', [\App\Http\Controllers\Customer\KatalogController::class, 'showKatalog'])->name('produk-kami');
    Route::get('/produk/{id}', [\App\Http\Controllers\Customer\KatalogController::class, 'showDetail'])->name('produk.detail');
    Route::get('/produk/{id}/show', [\App\Http\Controllers\Customer\KatalogController::class, 'show'])->name('produk.show');

    Route::get('/syarat-ketentuan', function () {
        return view('customer.term-of-service.main-tos');
    })->name('syarat-ketentuan');

    Route::get('/syarat-ketentuan/order', function () {
        return view('customer.term-of-service.order');
    })->name('syarat-ketentuan.order');

    Route::get('/syarat-ketentuan/payment', function () {
        return view('customer.term-of-service.payment');
    })->name('syarat-ketentuan.payment');

    Route::get('/syarat-ketentuan/delivery', function () {
        return view('customer.term-of-service.delivery');
    })->name('syarat-ketentuan.delivery');

    Route::get('/syarat-ketentuan/pickup', function () {
        return view('customer.term-of-service.pickup');
    })->name('syarat-ketentuan.pickup');
});

