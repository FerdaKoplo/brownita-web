@extends('layout.customer.app')
@section('title', 'Syarat & Ketentuan')

@section('content')
<div class="min-h-screen bg-gray-50 px-6 lg:px-32 py-16">
    
    <div class="text-center mb-16 space-y-4">
        <span class="text-amber-600 font-bold tracking-widest uppercase text-sm">Informasi Penting</span>
        <h2 class="text-4xl lg:text-5xl font-bold text-gray-800">
            Syarat & Ketentuan
        </h2>
        <p class="text-gray-600 text-lg max-w-2xl mx-auto leading-relaxed">
            Selamat datang di Brownita. Demi kenyamanan bersama, mohon luangkan waktu sejenak untuk memahami ketentuan layanan kami sebelum memesan.
        </p>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 max-w-7xl mx-auto">
        
        <a href="{{ route('syarat-ketentuan.order') }}" class="group relative bg-white rounded-2xl shadow-sm hover:shadow-xl border border-gray-100 p-8 transition-all duration-300 transform hover:-translate-y-2 flex flex-col items-center text-center">
            <div class="absolute top-0 left-0 w-full h-1 bg-gradient-to-r from-amber-500 to-amber-700 rounded-t-2xl"></div>
            <div class="w-16 h-16 bg-amber-50 rounded-full flex items-center justify-center mb-6 group-hover:bg-amber-600 transition-colors duration-300">
                <i class="fa-solid fa-cart-shopping text-2xl text-amber-700 group-hover:text-white transition-colors"></i>
            </div>
            <h3 class="text-xl font-bold text-gray-800 mb-2">Pemesanan</h3>
            <p class="text-sm text-gray-500">Prosedur dan aturan melakukan order.</p>
        </a>

        <a href="{{ route('syarat-ketentuan.payment') }}" class="group relative bg-white rounded-2xl shadow-sm hover:shadow-xl border border-gray-100 p-8 transition-all duration-300 transform hover:-translate-y-2 flex flex-col items-center text-center">
            <div class="absolute top-0 left-0 w-full h-1 bg-gradient-to-r from-amber-500 to-amber-700 rounded-t-2xl"></div>
            <div class="w-16 h-16 bg-amber-50 rounded-full flex items-center justify-center mb-6 group-hover:bg-amber-600 transition-colors duration-300">
                <i class="fa-solid fa-credit-card text-2xl text-amber-700 group-hover:text-white transition-colors"></i>
            </div>
            <h3 class="text-xl font-bold text-gray-800 mb-2">Pembayaran</h3>
            <p class="text-sm text-gray-500">Metode dan konfirmasi pembayaran.</p>
        </a>

        <a href="{{ route('syarat-ketentuan.delivery') }}" class="group relative bg-white rounded-2xl shadow-sm hover:shadow-xl border border-gray-100 p-8 transition-all duration-300 transform hover:-translate-y-2 flex flex-col items-center text-center">
            <div class="absolute top-0 left-0 w-full h-1 bg-gradient-to-r from-amber-500 to-amber-700 rounded-t-2xl"></div>
            <div class="w-16 h-16 bg-amber-50 rounded-full flex items-center justify-center mb-6 group-hover:bg-amber-600 transition-colors duration-300">
                <i class="fa-solid fa-truck-fast text-2xl text-amber-700 group-hover:text-white transition-colors"></i>
            </div>
            <h3 class="text-xl font-bold text-gray-800 mb-2">Pengiriman</h3>
            <p class="text-sm text-gray-500">Aturan kurir dan jadwal pengiriman.</p>
        </a>

        <a href="{{ route('syarat-ketentuan.pickup') }}" class="group relative bg-white rounded-2xl shadow-sm hover:shadow-xl border border-gray-100 p-8 transition-all duration-300 transform hover:-translate-y-2 flex flex-col items-center text-center">
            <div class="absolute top-0 left-0 w-full h-1 bg-gradient-to-r from-amber-500 to-amber-700 rounded-t-2xl"></div>
            <div class="w-16 h-16 bg-amber-50 rounded-full flex items-center justify-center mb-6 group-hover:bg-amber-600 transition-colors duration-300">
                <i class="fa-solid fa-shop text-2xl text-amber-700 group-hover:text-white transition-colors"></i>
            </div>
            <h3 class="text-xl font-bold text-gray-800 mb-2">Ambil Sendiri</h3>
            <p class="text-sm text-gray-500">Lokasi dan waktu pengambilan kue.</p>
        </a>

    </div>
</div>
@endsection