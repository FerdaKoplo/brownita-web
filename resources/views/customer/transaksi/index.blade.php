@extends('layout.customer.app')

@section('title', 'Riwayat Transaksi')

@section('content')
<div class="p-4 sm:p-5 md:px-32 flex flex-col gap-6 sm:gap-10">
    <h1 class="text-xl sm:text-2xl md:text-3xl font-bold text-black">Riwayat Transaksi</h1>

    {{-- Filter Form --}}
    <form action="{{ route('customer.transaksi.index') }}" method="GET"
        class="flex flex-wrap gap-3 p-3 bg-white rounded shadow-md">
        {{-- Search --}}
        <div class="flex flex-col flex-1 min-w-[200px]">
            <div class="flex items-center gap-2">
                <i class="fa-solid fa-magnifying-glass text-gray-500"></i>
                <input type="text" name="search" value="{{ request('search') }}"
                    class="w-full bg-transparent outline-none text-gray-700 placeholder-gray-400 text-sm sm:text-base"
                    placeholder="Cari Transaksi...">
            </div>
            <span class="text-xs text-gray-400 mt-1">Cari berdasarkan nama user</span>
        </div>

        {{-- Status --}}
        <div class="flex flex-col">
            <div class="flex items-center gap-2">
                <i class="fa-solid fa-filter text-gray-400"></i>
                <select name="status" class="rounded px-2 py-1 border text-sm sm:text-base">
                    <option value="">Semua Status</option>
                    <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                    <option value="dibayar" {{ request('status') == 'dibayar' ? 'selected' : '' }}>Dibayar</option>
                    <option value="dikirim" {{ request('status') == 'dikirim' ? 'selected' : '' }}>Dikirim</option>
                    <option value="selesai" {{ request('status') == 'selesai' ? 'selected' : '' }}>Selesai</option>
                    <option value="batal" {{ request('status') == 'batal' ? 'selected' : '' }}>Dibatalkan</option>
                </select>
            </div>
            <span class="text-xs text-gray-400 mt-1">Filter berdasarkan status transaksi</span>
        </div>

        {{-- Date Range --}}
        <div class="flex flex-col">
            <input type="date" name="from" value="{{ request('from') }}" class="border rounded px-2 py-1 text-sm">
            <span class="text-xs text-gray-400 mt-1">Tanggal mulai</span>
        </div>
        <div class="flex flex-col">
            <input type="date" name="to" value="{{ request('to') }}" class="border rounded px-2 py-1 text-sm">
            <span class="text-xs text-gray-400 mt-1">Tanggal selesai</span>
        </div>

        {{-- Buttons --}}
        <div class="flex items-center gap-5">
            <button type="submit"
                class="bg-amber-600 text-white px-4 py-1 rounded text-sm hover:bg-black transition">
                Filter
            </button>
            <a href="{{ route('customer.transaksi.index') }}"
                class="text-gray-500 text-sm hover:underline ml-2">Reset</a>
        </div>
    </form>

    {{-- Transactions Table --}}
    @if($transaksis->isEmpty())
        <div class="text-center text-gray-500 text-sm sm:text-base mt-4">
            Tidak ada transaksi yang sesuai filter.
        </div>
    @else
        <div class="rounded-lg overflow-x-auto shadow-md mt-4">
            <table class="table-auto w-full min-w-[500px] border-collapse">
                <thead class="bg-black text-white text-xs sm:text-sm md:text-base">
                    <tr>
                        <th class="text-left px-2 sm:px-4 py-2 sm:py-3">#</th>
                        <th class="text-left px-2 sm:px-4 py-2 sm:py-3">Tanggal</th>
                        <th class="text-left px-2 sm:px-4 py-2 sm:py-3">Total</th>
                        <th class="text-left px-2 sm:px-4 py-2 sm:py-3">Alamat</th>
                        <th class="text-left px-2 sm:px-4 py-2 sm:py-3">Status</th>
                        <th class="px-3 sm:px-4 py-2 sm:py-3 text-center">Bukti Pembayaran</th>
                        <th class="px-2 sm:px-4 py-2 sm:py-3 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-brand-lightdark text-xs sm:text-sm md:text-base">
                    @foreach($transaksis as $index => $transaksi)
                        <tr class="hover:bg-gray-50 transition">
                            <td class="px-2 sm:px-4 py-2">
                                {{ ($transaksis->currentPage() - 1) * $transaksis->perPage() + $index + 1 }}
                            </td>
                            <td class="px-2 sm:px-4 py-2">
                                {{ $transaksi->created_at->format('d M Y') }}
                            </td>
                            <td class="px-2 sm:px-4 py-2">
                                Rp {{ number_format($transaksi->total_harga, 0, ',', '.') }}
                            </td>
                            <td class="px-2 sm:px-4 py-2">
                                <p class="text-black">{{ $transaksi->alamat }}</p>
                            </td>
                            <td class="px-2 sm:px-4 py-2">
                                @php
                                    $colorMap = [
                                        'pending' => 'bg-yellow-100 text-yellow-700',
                                        'dibayar' => 'bg-green-100 text-green-700',
                                        'dikirim' => 'bg-blue-100 text-blue-700',
                                        'selesai' => 'bg-gray-200 text-gray-800',
                                        'batal' => 'bg-red-100 text-red-600',
                                    ];
                                @endphp
                                <span class="inline-block px-2 py-1 text-[10px] sm:text-xs rounded-full font-medium {{ $colorMap[$transaksi->status] ?? 'bg-gray-100 text-gray-700' }}">
                                    {{ ucfirst($transaksi->status) }}
                                </span>
                            </td>
                            <td class="px-2 sm:px-4 py-2 text-center">
                                @if($transaksi->bukti_pembayaran)
                                    <div class="flex flex-col justify-center items-center gap-2">
                                        <a href="{{ asset('storage/' . $transaksi->bukti_pembayaran) }}" target="_blank">
                                            <img src="{{ asset('storage/' . $transaksi->bukti_pembayaran) }}" alt="Bukti Pembayaran"
                                                class="w-16 h-16 object-cover rounded shadow hover:scale-105 transition">
                                        </a>
                                        <a href="{{ asset('storage/' . $transaksi->bukti_pembayaran) }}"
                                            download="bukti_pembayaran_{{ $transaksi->id }}.jpg"
                                            class="bg-sky-500 text-white px-2 py-1 rounded text-xs hover:bg-blue-600 transition">
                                            Download
                                        </a>
                                    </div>
                                @else
                                    <span class="text-gray-400 text-xs">Belum diupload</span>
                                @endif
                            </td>
                            <td class="px-2 sm:px-4 py-2 text-center">
                                <a href="{{ route('customer.transaksi.show', $transaksi->id) }}"
                                    class="text-gray-400 hover:text-gray-800 transition text-sm sm:text-base">
                                    <i class="fa-solid fa-eye"></i>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <div class="mt-4 sm:mt-6 flex justify-center">
                {{ $transaksis->links() }}
            </div>
        </div>
    @endif
</div>
@endsection
