<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Keranjang;
use Illuminate\Http\Request;

class KeranjangController extends Controller
{
    public function keranjangIndex()
    {
        $cartItems = auth()->user()->keranjang()->with('produk')->get()
            ->filter(function ($itemProduk) {
                return $itemProduk->produk !== null;
            });
        $totalHarga = $cartItems->sum(function ($item) {
            return $item->quantity * $item->produk->harga;
        });
        return view('customer.keranjang', compact('cartItems', 'totalHarga'));
    }

    public function keranjangStore(Request $request)
    {
        $request->validate([
            'katalog_id' => 'required|exists:katalogs,id',
            'quantity' => 'nullable|integer|min:1'
        ]);

        $existingCart = Keranjang::where('user_id', auth()->id())
            ->where('katalog_id', $request->katalog_id)
            ->first();

        if ($existingCart) {
            $existingCart->increment('quantity', $request->quantity ?? 1);
        } else {
            Keranjang::create([
                'user_id' => auth()->id(),
                'katalog_id' => $request->katalog_id,
                'quantity' => $request->quantity ?? 1
            ]);
        }

        return redirect()->back()->with('success', 'Produk ditambahkan ke keranjang!');
    }

    public function keranjangUpdate(Request $request, $id)
    {
        $cartItem = Keranjang::where('user_id', auth()->id())->findOrFail($id);

        if ($request->action === 'increase') {
            $cartItem->increment('quantity');
        } elseif ($request->action === 'decrease') {
            if ($cartItem->quantity > 1) {
                $cartItem->decrement('quantity');
            } else {
                $cartItem->delete();
            }
        }

        return redirect()->back()->with('success', 'Jumlah produk diperbarui.');
    }


    public function keranjangRemove()
    {

    }
}
