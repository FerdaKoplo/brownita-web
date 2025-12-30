@extends('layout.customer.app')
@section('title', 'Riwayat Transaksi')

@section('content')
    <div class="min-h-screen bg-gray-50 px-4 lg:px-32 py-12">

        <div class="flex flex-col md:flex-row justify-between items-end mb-8 gap-4">
            <div>
                <h1 class="text-3xl font-bold text-gray-900">Riwayat Pesanan</h1>
                <p class="text-gray-500 mt-1">Pantau status pesanan dan pembayaran Anda.</p>
            </div>

            <button onclick="document.getElementById('filterPanel').classList.toggle('hidden')"
                class="md:hidden w-full bg-white border border-gray-200 px-4 py-2 rounded-lg text-gray-700 font-medium shadow-sm">
                <i class="fa-solid fa-filter mr-2"></i> Filter & Pencarian
            </button>
        </div>

        <div id="filterPanel" class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 mb-8 hidden md:block">
            <form action="{{ route('customer.transaksi.index') }}" method="GET"
                class="grid grid-cols-1 md:grid-cols-4 gap-4 items-end">

                <div class="col-span-1 md:col-span-4 lg:col-span-1">
                    <label class="text-xs font-bold text-gray-500 uppercase mb-1 block">Cari Transaksi</label>
                    <div class="relative">
                        <i class="fa-solid fa-magnifying-glass absolute left-3 top-1/2 -translate-y-1/2 text-gray-400"></i>
                        <input type="text" name="search" value="{{ request('search') }}"
                            class="w-full pl-10 pr-4 py-2.5 rounded-xl border border-gray-200 focus:ring-2 focus:ring-amber-500 focus:border-amber-500 outline-none transition"
                            placeholder="ID atau Nama Produk...">
                    </div>
                </div>

                <div class="col-span-1 md:col-span-2 lg:col-span-1">
                    <label class="text-xs font-bold text-gray-500 uppercase mb-1 block">Status</label>
                    <select name="status"
                        class="w-full px-4 py-2.5 rounded-xl border border-gray-200 bg-white focus:ring-2 focus:ring-amber-500 outline-none cursor-pointer">
                        <option value="">Semua Status</option>
                        <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Menunggu Bayar</option>
                        <option value="dibayar" {{ request('status') == 'dibayar' ? 'selected' : '' }}>Sudah Dibayar</option>
                        <option value="dikirim" {{ request('status') == 'dikirim' ? 'selected' : '' }}>Sedang Dikirim</option>
                        <option value="selesai" {{ request('status') == 'selesai' ? 'selected' : '' }}>Selesai</option>
                        <option value="batal" {{ request('status') == 'batal' ? 'selected' : '' }}>Dibatalkan</option>
                    </select>
                </div>

                <div class="grid grid-cols-2 gap-2">
                    <div>
                        <label class="text-xs font-bold text-gray-500 uppercase mb-1 block">Dari Tanggal</label>
                        <input type="date" name="from" value="{{ request('from') }}"
                            class="w-full px-3 py-2.5 rounded-xl border border-gray-200 text-sm focus:ring-2 focus:ring-amber-500 outline-none">
                    </div>
                    <div>
                        <label class="text-xs font-bold text-gray-500 uppercase mb-1 block">Sampai</label>
                        <input type="date" name="to" value="{{ request('to') }}"
                            class="w-full px-3 py-2.5 rounded-xl border border-gray-200 text-sm focus:ring-2 focus:ring-amber-500 outline-none">
                    </div>
                </div>

                <div class="flex gap-2">
                    <button type="submit"
                        class="flex-1 bg-amber-700 hover:bg-amber-800 text-white font-semibold py-2.5 rounded-xl transition shadow-md">
                        Terapkan
                    </button>
                    <a href="{{ route('customer.transaksi.index') }}"
                        class="px-4 py-2.5 border border-gray-200 text-gray-600 rounded-xl hover:bg-gray-50 transition"
                        title="Reset">
                        <i class="fa-solid fa-rotate-right"></i>
                    </a>
                </div>
            </form>
        </div>

        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
            @if($transaksis->isEmpty())
                <div class="flex flex-col items-center justify-center py-16 text-center">
                    <div class="bg-gray-50 w-20 h-20 rounded-full flex items-center justify-center mb-4">
                        <i class="fa-solid fa-receipt text-3xl text-gray-300"></i>
                    </div>
                    <h3 class="text-lg font-bold text-gray-800">Belum Ada Transaksi</h3>
                    <p class="text-gray-500 text-sm">Pesanan Anda akan muncul di sini setelah Anda belanja.</p>
                    <a href="{{ route('produk-kami') }}" class="mt-4 text-amber-700 font-semibold hover:underline">Mulai
                        Belanja</a>
                </div>
            @else
                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead
                            class="bg-gray-50 border-b border-gray-100 text-xs uppercase text-gray-500 font-bold tracking-wider">
                            <tr>
                                <th class="px-6 py-4">#ID</th>
                                <th class="px-6 py-4">Tanggal</th>
                                <th class="px-6 py-4">Total Belanja</th>
                                <th class="px-6 py-4">Status</th>
                                <th class="px-6 py-4">Bukti Bayar</th>
                                <th class="px-6 py-4 text-right">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-50">
                            @foreach($transaksis as $transaksi)
                                                <tr class="hover:bg-amber-50/30 transition-colors group">
                                                    <td class="px-6 py-4 font-mono text-sm text-gray-500">#{{ $transaksi->id }}</td>
                                                    <td class="px-6 py-4 text-sm text-gray-700">
                                                        {{ $transaksi->created_at->format('d M Y') }}
                                                        <span class="block text-xs text-gray-400">{{ $transaksi->created_at->format('H:i') }}</span>
                                                    </td>
                                                    <td class="px-6 py-4 font-bold text-gray-900">
                                                        Rp {{ number_format($transaksi->total_harga, 0, ',', '.') }}
                                                    </td>
                                                    <td class="px-6 py-4">
                                                        @php
                                                            $statusStyles = [
                                                                'pending' => 'bg-yellow-100 text-yellow-700 border-yellow-200',
                                                                'dibayar' => 'bg-green-100 text-green-700 border-green-200',
                                                                'dikirim' => 'bg-blue-100 text-blue-700 border-blue-200',
                                                                'selesai' => 'bg-gray-100 text-gray-700 border-gray-200',
                                                                'batal' => 'bg-red-100 text-red-700 border-red-200',
                                                            ];
                                                            $style = $statusStyles[$transaksi->status] ?? 'bg-gray-100 text-gray-600';
                                                        @endphp
                                 <span
                                                            class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium border {{ $style }}">
                                                            {{ ucfirst($transaksi->status) }}
                                                        </span>
                                                    </td>
                                                    <td class="px-6 py-4">
                                                        @if($transaksi->bukti_pembayaran)
                                                            <a href="{{ asset('storage/' . $transaksi->bukti_pembayaran) }}" target="_blank"
                                                                class="flex items-center gap-2 text-amber-700 hover:underline text-sm font-medium">
                                                                <i class="fa-solid fa-paperclip"></i> Lihat File
                                                            </a>
                                                        @else
                                                            <span class="text-xs text-gray-400 italic">Belum upload</span>
                                                        @endif
                                                    </td>
                                                    <td class="px-6 py-4 text-right">
                                                        <a href="{{ route('customer.transaksi.show', $transaksi->id) }}"
                                                            class="inline-flex items-center justify-center w-8 h-8 rounded-full bg-white border border-gray-200 text-gray-500 hover:text-amber-700 hover:border-amber-300 shadow-sm transition">
                                                            <i class="fa-solid fa-chevron-right text-xs"></i>
                                                        </a>
                                                    </td>
                                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                @if($transaksis->hasPages())
                    <div class="p-4 border-t border-gray-100 bg-gray-50">
                        {{ $transaksis->appends(request()->query())->links('pagination::tailwind') }}
                    </div>
                @endif
            @endif
        </div>
    </div>
@endsection