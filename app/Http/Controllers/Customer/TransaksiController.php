<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Keranjang;
use App\Models\Transaksi;
use App\Models\TransaksiDetail;
use Illuminate\Http\Request;

class TransaksiController extends Controller
{
    public function transaksiIndex(Request $request)
    {

        $search = $request->input('search');
        $status = $request->input('status');
        $from = $request->input('from');
        $to = $request->input('to');

        $transaksis = Transaksi::where('user_id', auth()->id())
            ->when($request->search, fn($q) => $q->whereHas('details.produk', fn($q2) => $q2->where('nama_produk', 'like', "%{$request->search}%")))
            ->when($request->status, fn($q) => $q->where('status', $request->status))
            ->when($request->from, fn($q) => $q->whereDate('created_at', '>=', $request->from))
            ->when($request->to, fn($q) => $q->whereDate('created_at', '<=', $request->to))
            ->latest()
            ->paginate(10)->appends($request->all());
        return view('customer.transaksi.index', compact('transaksis'));
    }

    public function transaksiShow($id)
    {
        $transaksi = Transaksi::where('user_id', auth()->id())->findOrFail($id);
        // if expired and still pending → mark as batal
        if ($transaksi->status === 'pending' && $transaksi->expires_at && $transaksi->expires_at->isPast()) {
            $transaksi->update(['status' => 'batal']);
        }
        return view('customer.transaksi.show', compact('transaksi'));
    }

    public function transaksiStore(Request $request)
    {
        $validated = $request->validate([
            'alamat' => 'required|string|max:1000',
        ]);
        $cartItems = auth()->user()->keranjang()->with('produk')->get();

        if ($cartItems->isEmpty()) {
            return redirect()->back()->with('error', 'Keranjang kosong.');
        }

        $totalHarga = $cartItems->sum(fn($item) => $item->quantity * $item->produk->harga);

        $transaksi = Transaksi::create([
            'user_id' => auth()->id(),
            'total_harga' => $totalHarga,
            'alamat' => $validated['alamat'],
            'expires_at' => now()->addHours(2),
        ]);

        foreach ($cartItems as $item) {
            TransaksiDetail::create([
                'transaksi_id' => $transaksi->id,
                'katalog_id' => $item->produk->id,
                'quantity' => $item->quantity,
                'harga_satuan' => $item->produk->harga,
            ]);
        }

        Keranjang::where('user_id', auth()->id())->delete();

        return redirect()->route('customer.transaksi.show', $transaksi->id)
            ->with('success', 'Transaksi dibuat. Silakan scan QR untuk membayar.');
    }

    public function uploadBukti(Request $request, $id)
    {
        $request->validate([
            'bukti_pembayaran' => 'required|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $transaksi = Transaksi::where('user_id', auth()->id())->findOrFail($id);

        $path = $request->file('bukti_pembayaran')->store('bukti_pembayaran', 'public');

        $transaksi->update([
            'bukti_pembayaran' => $path,
        ]);

        return redirect()->back()->with('success', 'Bukti pembayaran berhasil diupload. Tunggu verifikasi admin.');
    }
}
