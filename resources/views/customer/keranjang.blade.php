@extends('layout.customer.app')
@section('title', 'Keranjang')
@section('content')
    <div class="flex items-center px-32 justify-between">
        <div class="flex flex-col  items-center ">
            @foreach ($cartItems as $cartitem)
                <div class="flex  items-center gap-16 justify-start ">
                    <div class="aspect-square p-5    ">
                        <div class="flex items-center p-5 rounded-t-2xl bg-gray-300 justify-center">
                            @php
                                $imagePath = $cartitem->produk->images->first()->gambar_produk ?? null;
                            @endphp
                            <img src="{{ $imagePath ? asset('storage/' . $imagePath) : asset('images/default-product.jpg') }}"
                                alt="" class="w-40 h-40 rounded-xl aspect-square">
                        </div>
                        <div class="text-black bg-white shadow-md flex flex-col gap-5 p-5  rounded-b-2xl">
                            <div class="flex flex-col gap-2">
                                <h1 class="font-bold text-xl">{{ $cartitem->produk->nama_produk }}</h1>
                                <h1 class="text-xs">#{{ $cartitem->produk->category->nama_kategori }}</h1>
                            </div>
                            <h1 class="font-bold">{{ $cartitem->produk->harga_rupiah }}</h1>
                        </div>
                    </div>

                    <div class="flex items-center gap-10 ">
                        <div class="flex flex-col gap-5">
                            <h1 class="font-bold text-gray-800">Jumlah Barang</h1>
                            <div
                                class="flex  text-white gap-12  py-1 px-5 rounded-xl items-center justify-between">
                                <form method="POST" action="{{ route('customer.keranjang.update', $cartitem->id) }}">
                                    @csrf
                                    @method('PATCH')
                                    <input type="hidden" name="action" value="decrease">
                                    <button class="bg-amber-700 hover:bg-black transition w-10 h-10 rounded-full flex items-center justify-center" type="submit">-</button>

                                </form>

                                <p class="text-black">{{ $cartitem->quantity }}</p>

                                <form method="POST" action="{{ route('customer.keranjang.update', $cartitem->id) }}">
                                    @csrf
                                    @method('PATCH')
                                    <input type="hidden" name="action" value="increase">
                                    <button class="bg-amber-700 w-10 h-10 rounded-full hover:bg-black transition flex items-center justify-center" type="submit">+</button>

                                </form>
                            </div>
                        </div>

                        <div>
                            <div class="flex items-center gap-5">
                                <p>{{ $cartitem->quantity }}x</p>
                                <p>{{ $cartitem->produk->harga_rupiah }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        <div class="flex flex-col gap-10">
            <div class="flex flex-col gap-5">
                <h1 class="text-gray-800 font-bold text-2xl">Catatan Tambahan</h1>
                <textarea name="" id="" cols="90" rows="5" placeholder="Ketik sesuatu..."
                    class="p-5 resize-none  border-black border rounded-xl"></textarea>
            </div>

            <div>
                <div class="flex items-center text-gray-800 justify-between">
                    <p>Produk</p>
                    <p>{{ $cartItems->sum('quantity') }}</p>
                </div>

                <div class="flex font-bold text-2xl text-gray-800 items-center justify-between">
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
