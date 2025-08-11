@extends('layout.customer.app')

@section('title', 'Riwayat Transaksi')

@section('content')
<div class="p-4 sm:p-5 md:px-32 flex flex-col gap-6 sm:gap-10">
    <h1 class="text-xl sm:text-2xl md:text-3xl font-bold text-black">Riwayat Transaksi</h1>

    @if($transaksis->isEmpty())
        <div class="text-center text-gray-500 text-sm sm:text-base">
            Belum ada transaksi yang tercatat.
        </div>
    @else
        <div class="rounded-lg overflow-x-auto shadow-md">
            <table class="table-auto w-full min-w-[500px] border-collapse">
                <thead class="bg-black text-white text-xs sm:text-sm md:text-base">
                    <tr>
                        <th class="text-left px-2 sm:px-4 py-2 sm:py-3">#</th>
                        <th class="text-left px-2 sm:px-4 py-2 sm:py-3">Tanggal</th>
                        <th class="text-left px-2 sm:px-4 py-2 sm:py-3">Total</th>
                        <th class="text-left px-2 sm:px-4 py-2 sm:py-3">Status</th>
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
                                @if($transaksi->status == 'pending')
                                    <span class="bg-yellow-100 text-yellow-700 inline-block px-2 py-1 rounded-full font-medium text-[10px] sm:text-xs">Pending</span>
                                @elseif($transaksi->status == 'dibayar')
                                    <span class="bg-green-100 text-green-700 inline-block px-2 py-1 rounded-full font-medium text-[10px] sm:text-xs">Dibayar</span>
                                @else
                                    <span class="bg-red-100 text-red-600 inline-block px-2 py-1 rounded-full font-medium text-[10px] sm:text-xs">Dibatalkan</span>
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
