@extends('layout.customer.app')
@section('title', 'Keranjang Belanja')

@section('content')
<div class="min-h-screen bg-gray-50 py-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-7xl mx-auto">
        
        <h1 class="text-3xl font-bold text-gray-900 mb-8 flex items-center gap-3">
            <i class="fa-solid fa-cart-shopping text-amber-700"></i> Keranjang Belanja
        </h1>

        @if($cartItems->isEmpty())
            {{-- Empty State --}}
            <div class="flex flex-col items-center justify-center py-16 bg-white rounded-3xl shadow-sm border border-gray-100 text-center">
                <div class="bg-amber-50 w-24 h-24 rounded-full flex items-center justify-center mb-6">
                    <i class="fa-solid fa-basket-shopping text-4xl text-amber-300"></i>
                </div>
                <h2 class="text-2xl font-bold text-gray-800 mb-2">Keranjang Kosong</h2>
                <p class="text-gray-500 mb-8">Wah, sepertinya kamu belum memilih menu apapun.</p>
                <a href="{{ route('produk-kami') }}" class="px-8 py-3 bg-amber-700 hover:bg-amber-800 text-white font-semibold rounded-full transition shadow-lg shadow-amber-900/20">
                    Mulai Belanja
                </a>
            </div>
        @else
            <div class="flex flex-col lg:flex-row gap-8 lg:gap-12">
                
                <div class="flex-1 space-y-6">
                    @foreach ($cartItems as $cartitem)
                        <div class="group bg-white rounded-2xl p-4 sm:p-6 shadow-sm border border-gray-100 flex flex-col sm:flex-row items-start sm:items-center gap-6 transition hover:shadow-md">
                            
                            <div class="relative w-full sm:w-32 h-32 flex-shrink-0 bg-gray-100 rounded-xl overflow-hidden">
                                @php
                                    $imagePath = $cartitem->produk->images->first()->gambar_produk ?? null;
                                @endphp
                                <img src="{{ $imagePath ? asset('storage/' . $imagePath) : asset('images/default-product.jpg') }}" 
                                     alt="{{ $cartitem->produk->nama_produk }}" 
                                     class="w-full h-full object-cover transform group-hover:scale-105 transition duration-500">
                            </div>

                            <div class="flex-1 min-w-0">
                                <div class="flex justify-between items-start">
                                    <div>
                                        <span class="text-xs font-bold text-amber-600 bg-amber-50 px-2 py-1 rounded uppercase tracking-wide">
                                            {{ $cartitem->produk->category->nama_kategori }}
                                        </span>
                                        <h3 class="text-lg font-bold text-gray-900 mt-2 truncate">
                                            {{ $cartitem->produk->nama_produk }}
                                        </h3>
                                        <p class="text-amber-700 font-bold mt-1 text-lg">
                                            {{ $cartitem->produk->harga_rupiah }}
                                        </p>
                                    </div>
                                    
                                    {{-- 
                                    <form action="{{ route('customer.keranjang.delete', $cartitem->id) }}" method="POST">
                                        @csrf @method('DELETE')
                                        <button class="text-gray-400 hover:text-red-500 transition"><i class="fa-solid fa-trash"></i></button>
                                    </form> 
                                    --}}
                                </div>

                                <div class="flex items-center justify-between mt-6">
                                    <div class="flex items-center bg-gray-50 rounded-lg p-1 border border-gray-200">
                                        <form method="POST" action="{{ route('customer.keranjang.update', $cartitem->id) }}">
                                            @csrf @method('PATCH')
                                            <input type="hidden" name="action" value="decrease">
                                            <button type="submit" class="w-8 h-8 flex items-center justify-center bg-white rounded-md shadow-sm text-gray-600 hover:text-amber-700 hover:bg-amber-50 transition" {{ $cartitem->quantity <= 1 ? 'disabled class=opacity-50' : '' }}>
                                                <i class="fa-solid fa-minus text-xs"></i>
                                            </button>
                                        </form>
                                        
                                        <span class="w-12 text-center font-semibold text-gray-800">{{ $cartitem->quantity }}</span>
                                        
                                        <form method="POST" action="{{ route('customer.keranjang.update', $cartitem->id) }}">
                                            @csrf @method('PATCH')
                                            <input type="hidden" name="action" value="increase">
                                            <button type="submit" class="w-8 h-8 flex items-center justify-center bg-white rounded-md shadow-sm text-gray-600 hover:text-amber-700 hover:bg-amber-50 transition">
                                                <i class="fa-solid fa-plus text-xs"></i>
                                            </button>
                                        </form>
                                    </div>
                                    
                                    <p class="text-sm font-medium text-gray-500">
                                        Subtotal: <span class="text-gray-900 font-bold ml-1">Rp {{ number_format($cartitem->quantity * $cartitem->produk->harga, 0, ',', '.') }}</span>
                                    </p>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <div class="w-full lg:w-[400px] flex-shrink-0">
                    <div class="bg-white rounded-2xl shadow-lg border border-gray-100 p-6 lg:p-8 sticky top-8">
                        <h2 class="text-xl font-bold text-gray-900 mb-6 pb-4 border-b border-gray-100">
                            Rincian Pesanan
                        </h2>

                        <form method="POST" action="{{ route('customer.transaksi.store') }}">
                            @csrf
                            
                            <div class="mb-6">
                                <label class="block text-sm font-bold text-gray-700 mb-2">
                                    <i class="fa-solid fa-location-dot text-amber-600 mr-2"></i> Alamat Pengiriman
                                </label>
                                <textarea name="alamat" rows="4" required
                                    class="w-full px-4 py-3 rounded-xl bg-gray-50 border-gray-200 border focus:bg-white focus:ring-2 focus:ring-amber-500 focus:border-transparent transition text-sm resize-none"
                                    placeholder="Nama Jalan, No. Rumah, RT/RW, Kecamatan, Kota..."></textarea>
                            </div>

                            <div class="space-y-3 mb-8">
                                <div class="flex justify-between text-gray-600">
                                    <span>Total Item</span>
                                    <span class="font-medium">{{ $cartItems->sum('quantity') }} pcs</span>
                                </div>
                                <div class="flex justify-between text-gray-600">
                                    <span>Biaya Pengiriman</span>
                                    <span class="text-green-600 text-xs font-bold bg-green-50 px-2 py-1 rounded">Dihitung Nanti</span>
                                </div>
                                <div class="border-t border-gray-100 my-4 pt-4 flex justify-between items-center">
                                    <span class="text-lg font-bold text-gray-800">Total Belanja</span>
                                    <span class="text-2xl font-bold text-amber-700">
                                        {{ 'Rp ' . number_format($totalHarga, 0, ',', '.') }}
                                    </span>
                                </div>
                            </div>

                            <button type="submit" 
                                class="w-full py-4 bg-gray-900 hover:bg-black text-white font-bold rounded-xl shadow-lg shadow-gray-900/20 transition transform active:scale-95 flex items-center justify-center gap-3">
                                <i class="fa-solid fa-check-circle"></i> Bayar Sekarang
                            </button>
                            
                            <p class="text-center text-xs text-gray-400 mt-4">
                                <i class="fa-solid fa-shield-halved mr-1"></i> Transaksi Aman & Terpercaya
                            </p>
                        </form>
                    </div>
                </div>

            </div>
        @endif
    </div>
</div>
@endsection