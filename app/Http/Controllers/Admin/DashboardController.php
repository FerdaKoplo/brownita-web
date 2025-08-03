<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Katalog;
use App\Models\Transaksi;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function homeIndex()
    {
        $totalTransaksi = Transaksi::count();
        $totalProduk = Katalog::count();
        $statusTransaksi = Transaksi::selectRaw('status, COUNT(*) as jumlah')
            ->groupBy('status')
            ->pluck('jumlah', 'status');

        return view('admin.AdminDashboard', compact('totalTransaksi', 'totalProduk', 'statusTransaksi'));
    }

}
