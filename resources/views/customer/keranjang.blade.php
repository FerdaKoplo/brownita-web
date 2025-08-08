@extends('layout.customer.app')
@section('title', 'Keranjang')
@section('content')
<div class="flex flex-col lg:flex-row px-4 md:px-16 lg:px-32 gap-10">
    <div class="flex flex-col items-center w-full lg:w-3/5 space-y-8">
        @foreach ($cartItems as $cartitem)
        <div class="flex flex-col sm:flex-row items-center gap-6 sm:gap-16 w-full bg-white rounded-2xl shadow-md p-5">
            <div class="aspect-square w-40 sm:w-48 p-2 bg-gray-300 rounded-2xl flex items-center justify-center">
                @php
                    $imagePath = $cartitem->produk->images->first()->gambar_produk ?? null;
                @endphp
                <img src="{{ $imagePath ? asset('storage/' . $imagePath) : asset('images/default-product.jpg') }}"
                    alt="" class="rounded-xl w-full h-full object-cover">
            </div>

            <div class="flex flex-col flex-1 gap-4">
                <div>
                    <h1 class="font-bold text-lg sm:text-xl">{{ $cartitem->produk->nama_produk }}</h1>
                    <h2 class="text-xs sm:text-sm text-gray-600">#{{ $cartitem->produk->category->nama_kategori }}</h2>
                </div>
                <h1 class="font-bold text-lg sm:text-xl">{{ $cartitem->produk->harga_rupiah }}</h1>
            </div>

            <div class="flex flex-col sm:flex-row items-center gap-6">
                <div class="flex flex-col gap-2 items-center sm:items-start">
                    <h1 class="font-bold text-gray-800 text-base">Jumlah Barang</h1>
                    <div class="flex bg-amber-700 rounded-xl gap-8 sm:gap-12 py-1  items-center justify-between text-white ">
                        <form method="POST" action="{{ route('customer.keranjang.update', $cartitem->id) }}">
                            @csrf
                            @method('PATCH')
                            <input type="hidden" name="action" value="decrease">
                            <button type="submit" class="w-8 h-8 rounded-full flex items-center justify-center hover:bg-black transition">-</button>
                        </form>
                        <p class="text-white">{{ $cartitem->quantity }}</p>
                        <form method="POST" action="{{ route('customer.keranjang.update', $cartitem->id) }}">
                            @csrf
                            @method('PATCH')
                            <input type="hidden" name="action" value="increase">
                            <button type="submit" class="w-8 h-8 rounded-full flex items-center justify-center hover:bg-black transition">+</button>
                        </form>
                    </div>
                </div>

                <div>
                    <div class="flex items-center gap-3 text-gray-800 font-semibold">
                        <p>{{ $cartitem->quantity }}x</p>
                        <p>{{ $cartitem->produk->harga_rupiah }}</p>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>

    <div class="flex flex-col gap-8 w-full lg:w-2/5">
        <div class="flex flex-col gap-4">
            <h1 class="text-gray-800 font-bold text-xl md:text-2xl">Catatan Tambahan</h1>
            <textarea name="catatan" cols="30" rows="5" placeholder="Ketik sesuatu..."
                class="p-4 resize-none border border-black rounded-xl w-full"></textarea>
        </div>

        <div class="space-y-4">
            <div class="flex items-center justify-between text-gray-800">
                <p>Produk</p>
                <p>{{ $cartItems->sum('quantity') }}</p>
            </div>

            <div class="flex items-center justify-between font-bold text-2xl text-gray-800">
                <p>Total</p>
                <p>{{ 'Rp ' . number_format($totalHarga, 0, ',', '.') }}</p>
            </div>
        </div>

        <form method="POST" action="{{ route('customer.transaksi.store') }}">
            @csrf
            <input type="hidden" name="catatan" value="">
            <button type="submit" class="bg-amber-700 text-white w-full p-3 rounded-full hover:bg-black transition">
                Bayar Sekarang
            </button>
        </form>
    </div>
</div>
@endsection
