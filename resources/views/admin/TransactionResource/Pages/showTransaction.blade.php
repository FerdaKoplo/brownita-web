@extends('layout.admin.layout')
@section('title', 'Detail Transaksi')

@section('content')
    <div class="p-5 flex flex-col gap-10">
        <h1 class="text-3xl font-bold text-brand-dark">Detail Transaksi</h1>

        {{-- Info Umum Transaksi --}}
        <div class="bg-brand-lightdark shadow-lg rounded-xl p-6 border-2 border-brand-dark">
            <div class="grid grid-cols-2 gap-4 text-brand-dark">
                <div>
                    <p class="font-semibold">ID Transaksi:</p>
                    <p class="text-black">{{ $transaksi->id }}</p>
                </div>
                <div>
                    <p class="font-semibold">Tanggal:</p>
                    <p class="text-black">{{ $transaksi->created_at->format('d M Y, H:i') }}</p>
                </div>
                <div>
                    <p class="font-semibold">Total Harga:</p>
                    <p class="text-black">Rp {{ number_format($transaksi->total_harga, 0, ',', '.') }}</p>
                </div>
                <div>
                    <p class="font-semibold">Status:</p>
                    @if($transaksi->status === 'pending')
                        <span class="text-yellow-600 font-semibold">Pending</span>
                    @elseif($transaksi->status === 'dibayar')
                        <span class="text-green-600 font-semibold">Dibayar</span>
                    @elseif($transaksi->status === 'dikirim')
                        <span class="text-blue-600 font-semibold">Dikirim</span>
                    @elseif($transaksi->status === 'selesai')
                        <span class="text-gray-800 font-semibold">Selesai</span>
                    @else
                        <span class="text-red-600 font-semibold">Dibatalkan</span>
                    @endif
                    </p>
                </div>
                @if($transaksi->catatan)
                    <div class="col-span-2">
                        <p class="font-semibold">Catatan:</p>
                        <p class="text-black">{{ $transaksi->catatan }}</p>
                    </div>
                @endif
            </div>
        </div>

        {{-- Daftar Produk --}}
        <div class="bg-brand-lightdark shadow-lg rounded-xl p-6 border-2 border-brand-dark">
            <h2 class="text-xl font-semibold text-brand-dark mb-4">Produk yang Dipesan</h2>
            @forelse ($transaksi->details as $detail)
                <div class="flex items-center justify-between border-b border-brand-dark py-3">
                    <div>
                        <p class="font-semibold text-brand-dark">{{ $detail->katalog->nama_produk ?? '-' }}</p>
                        <p class="text-sm text-black">Jumlah: {{ $detail->quantity }}</p>
                    </div>
                    <div>
                        <p class="text-right text-brand-dark">
                            Rp {{ number_format($detail->katalog->harga * $detail->quantity, 0, ',', '.') }}
                        </p>
                    </div>
                </div>
            @empty
                <p class="text-sm text-black">Tidak ada produk.</p>
            @endforelse
        </div>

        {{-- Tombol Kembali --}}
        <div>
            <a href="{{ route('dashboard.admin.customer-transaction.view') }}"
                class="inline-block bg-brand-dark  text-brand-light px-4 py-2 rounded-lg text-sm font-medium">
                ← Kembali ke Riwayat
            </a>
        </div>
    </div>
@endsection
