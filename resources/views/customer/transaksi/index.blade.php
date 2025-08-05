@extends('layout.customer.app')

@section('title', 'Riwayat Transaksi')

@section('content')
<div class="p-5 flex flex-col gap-10 px-32">
    <h1 class="text-3xl font-bold text-black">Riwayat Transaksi</h1>

    @if($transaksis->isEmpty())
        <div class="text-center text-gray-500">
            Belum ada transaksi yang tercatat.
        </div>
    @else
        <div class=" rounded-lg overflow-auto shadow-md ">
            <table class="table-auto  w-full border-collapse">
                <thead class="bg-black text-white">
                    <tr>
                        <th class="text-left px-4 py-3">#</th>
                        <th class="text-left px-4 py-3">Tanggal</th>
                        <th class="text-left px-4 py-3">Total</th>
                        <th class="text-left px-4 py-3">Status</th>
                        <th class=" px-4 py-3 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-brand-lightdark">
                    @foreach($transaksis as $index => $transaksi)
                        <tr>
                            <td class="px-4 py-2">{{ ($transaksis->currentPage() - 1) * $transaksis->perPage() + $index + 1 }}</td>
                            <td class="px-4 py-2">{{ $transaksi->created_at->format('d M Y') }}</td>
                            <td class="px-4 py-2">Rp {{ number_format($transaksi->total_harga, 0, ',', '.') }}</td>
                            <td class="px-4 py-2">
                                @if($transaksi->status == 'pending')
                                    <span class="bg-yellow-100 text-yellow-700 inline-block px-2 py-1 rounded-full font-medium ">Pending</span>
                                @elseif($transaksi->status == 'dibayar')
                                    <span class="bg-green-100 text-green-700 inline-block px-2 py-1 rounded-full font-medium ">Dibayar</span>
                                @else
                                    <span class="bg-red-100 text-red-600 inline-block px-2 py-1 rounded-full font-medium ">Dibatalkan</span>
                                @endif
                            </td>
                            <td class="px-4 py-2 text-center">
                                <a href="{{ route('customer.transaksi.show', $transaksi->id) }}"
                                   class=" text-gray-300 hover:text-gray-800 transition">
                                   <i class="fa-solid fa-eye"></i>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            {{-- Pagination --}}
            <div class="mt-6 flex justify-center">
                {{ $transaksis->links() }}
            </div>
        </div>
    @endif
</div>
@endsection
