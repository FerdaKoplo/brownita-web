@extends('layout.customer.app')
@section('title', 'Pembayaran')

@section('content')
    <div class="flex flex-col items-center justify-center gap-10 p-6 md:p-10 max-w-xl mx-auto">
        <a href="{{ route('produk-kami') }}">
            <button
                class="bg-brand-dark hover:bg-brand-orange transition-colors duration-300 py-2 px-6 rounded-full text-brand-light font-semibold flex gap-2 items-center text-lg">
                <i class="fa-solid fa-chevron-left"></i>
                Kembali
            </button>
        </a>

        <h1 class="text-3xl font-bold text-brand-dark text-center">
            Silakan Scan QR Gopay untuk Membayar
        </h1>

        <img src="{{ asset('images/qr.jpeg') }}" alt="QR Gopay"
            class="w-60 h-auto rounded-lg shadow-xl hover:scale-105 transition-transform duration-300">

        <div class="text-lg text-brand-dark text-center bg-brand-light/20 p-4 rounded-lg  w-full">
            <p>Total yang harus dibayar:</p>
            <p class="text-2xl font-bold mt-2">Rp {{ number_format($transaksi->total_harga, 0, ',', '.') }}</p>
        </div>

        <div class="flex items-center gap-3 bg-yellow-100 text-yellow-800 px-4 py-3 rounded-lg  text-sm">
            <i class="fa-solid fa-circle-exclamation text-xl"></i>
            <p>Setelah pembayaran, admin akan memverifikasi secara manual.</p>
        </div>

        <a href="{{ route('customer.transaksi.index') }}">
            <button
                class="bg-brand-dark hover:bg-brand-orange transition-colors duration-300 py-2 px-6 rounded-full text-brand-light font-semibold text-sm">
                Lihat Riwayat Transaksi
            </button>
        </a>
    </div>
@endsection
