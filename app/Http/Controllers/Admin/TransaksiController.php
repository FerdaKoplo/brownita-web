<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Transaksi;
use Illuminate\Http\Request;

class TransaksiController extends Controller
{
    public function transaksiIndex(Request $request)
    {

        $search = $request->input('search');
        $status = $request->input('status');
        $from = $request->input('from');
        $to = $request->input('to');

        $transaksis = Transaksi::with('user')
            ->when($search, function ($query) use ($search) {
                $query->whereHas('user', function ($q) use ($search) {
                    $q->where('name', 'like', "%{$search}%");
                });
            })
            ->when($status, function ($query) use ($status) {
                $query->where('status', $status);
            })
            ->when($from, function ($query) use ($from) {
                $query->whereDate('created_at', '>=', $from);
            })
            ->when($to, function ($query) use ($to) {
                $query->whereDate('created_at', '<=', $to);
            })
            ->latest()
            ->paginate(10);

        return view('admin.TransactionResource.Pages.viewTransactions', compact('transaksis'));
    }

    public function transaksiShow($id)
    {
        $transaksi = Transaksi::with(['user', 'details'])->findOrFail($id);
        return view('admin.TransactionResource.Pages.showTransaction', compact('transaksi'));
    }

    public function transaksiUpdate(Request $request, $id)
    {
        $validated = $request->validate([
            'status' => 'required|in:pending,dibayar,dikirim,selesai,batal',
        ]);

        $transaksi = Transaksi::findOrFail($id);
        $transaksi->status = $validated['status'];
        $transaksi->save();

        return redirect()->route('dashboard.admin.customer-transaction.view')
            ->with('success', 'Status transaksi berhasil diperbarui.');
    }

    // public function transaksiDestroy($id)
    // {
    //     $transaksi = Transaksi::findOrFail($id);
    //     $transaksi->delete();

    //     return redirect()->route('admin.transaksi.index')
    //         ->with('success', 'Transaksi berhasil dihapus.');
    // }
}
