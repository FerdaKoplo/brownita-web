@extends('layout.customer.app')
@section('title', 'Keranjang')
@section('content')
    <div class="flex items-center px-32 justify-between">
        <div class="flex flex-col  items-center ">
            @foreach ($cartItems as $cartitem)
                <div class="flex  items-center gap-16 justify-start ">
                    <div class="aspect-square p-5    ">
                        <div class="flex items-center p-5 rounded-t-2xl bg-brand-lightdark justify-center">
                            @php
                                $firstItem = $cartItems->first();
                                $firstImagePath = $firstItem && $firstItem->produk
                                    ? $firstItem->produk->images->first()->gambar_produk ?? null
                                    : null;
                            @endphp
                            <img src="{{ $firstImagePath ? asset('storage/' . $firstImagePath) : asset('images/default-product.jpg') }}"
                                alt="" class="w-40 h-40 rounded-xl aspect-square">
                        </div>
                        <div class="text-brand-light flex flex-col gap-5 p-5 bg-brand-dark rounded-b-2xl">
                            <div class="flex flex-col gap-2">
                                <h1 class="font-bold text-xl">{{ $cartitem->produk->nama_produk }}</h1>
                                <h1 class="text-xs">#{{ $cartitem->produk->category->nama_kategori }}</h1>
                            </div>
                            <h1 class="font-bold">{{ $cartitem->produk->harga_rupiah }}</h1>
                        </div>
                    </div>

                    <div class="flex items-center gap-10 ">
                        <div class="flex flex-col gap-5">
                            <h1 class="font-bold text-brand-dark">Jumlah Barang</h1>
                            <div
                                class="flex bg-brand-lightdark border border-black py-1 px-5 rounded-xl items-center justify-between">
                                <form method="POST" action="{{ route('customer.keranjang.update', $cartitem->id) }}">
                                    @csrf
                                    @method('PATCH')
                                    <input type="hidden" name="action" value="decrease">
                                    <button type="submit">-</button>
                                </form>

                                <p>{{ $cartitem->quantity }}</p>

                                <form method="POST" action="{{ route('customer.keranjang.update', $cartitem->id) }}">
                                    @csrf
                                    @method('PATCH')
                                    <input type="hidden" name="action" value="increase">
                                    <button type="submit">+</button>
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
                <h1 class="text-brand-dark font-bold text-2xl">Catatan Tambahan</h1>
                <form action="">
                    <textarea name="" id="" cols="90" rows="5"
                        class="p-5 resize-none bg-brand-light border-black border rounded-xl"></textarea>
                </form>
            </div>

            <div>
                <div class="flex items-center text-brand-dark justify-between">
                    <p>Produk</p>
                    <p>{{ $cartItems->sum('quantity') }}</p>
                </div>

                <div class="flex font-bold text-2xl text-brand-dark items-center justify-between">
                    <p>Total</p>
                    <p>{{ 'Rp ' . number_format($totalHarga, 0, ',', '.') }}</p>
                </div>
            </div>

            <div>
                <button class="bg-brand-dark text-brand-light w-full p-3 rounded-full font-bold">Bayar Sekarang</button>
            </div>
        </div>
    </div>
@endsection
