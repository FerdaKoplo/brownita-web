@extends('layout.customer.app')
@section('title', 'Pembayaran')

@section('content')
    <div class="flex flex-col items-center justify-center gap-10 p-6 md:p-10 max-w-xl mx-auto">
        <a href="{{ route('produk-kami') }}">
            <button
                class="bg-amber-700 hover:bg-black  transition-colors duration-300 py-2 px-6 rounded-full text-white font-semibold flex gap-2 items-center text-lg">
                <i class="fa-solid fa-chevron-left"></i>
                Kembali
            </button>
        </a>

        <h1 class="text-3xl font-bold text-black text-center">
            Silakan Scan QR Gopay untuk Membayar
        </h1>

        <img src="{{ asset('images/qr.jpeg') }}" alt="QR Gopay"
            class="w-60 h-auto rounded-lg shadow-xl hover:scale-105 transition-transform duration-300">

        <div class="text-lg text-black text-center bg-amber-700/20 p-4 rounded-lg  w-full">
            <p>Total yang harus dibayar:</p>
            <p class="text-2xl font-bold mt-2">Rp {{ number_format($transaksi->total_harga, 0, ',', '.') }}</p>
        </div>

        <div class="flex items-center gap-3 bg-amber-100 text-black px-4 py-3 rounded-lg  text-sm">
            <i class="fa-solid fa-circle-exclamation text-xl"></i>
            <p>Setelah pembayaran, admin akan memverifikasi secara manual.</p>
        </div>

        <a href="{{ route('customer.transaksi.index') }}">
            <button
                class="bg-amber-700 hover:bg-black transition-colors duration-300 py-2 px-6 rounded-full text-white font-medium text-sm">
                Lihat Riwayat Transaksi
            </button>
        </a>
    </div>
@endsection
