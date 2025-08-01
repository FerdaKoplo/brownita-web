@extends('layout.customer.app')

@section('title', 'Riwayat Transaksi')

@section('content')
<div class="p-5 flex flex-col gap-10 px-32">
    <h1 class="text-3xl font-bold text-brand-dark">Riwayat Transaksi</h1>

    @if($transaksis->isEmpty())
        <div class="text-center text-gray-500">
            Belum ada transaksi yang tercatat.
        </div>
    @else
        <div class="flex flex-col gap-3">
            <table class="table-auto w-full border-collapse">
                <thead class="bg-brand-secondary text-white">
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
                                    <span class="text-yellow-600 font-semibold">Pending</span>
                                @elseif($transaksi->status == 'dibayar')
                                    <span class="text-green-600 font-semibold">Dibayar</span>
                                @else
                                    <span class="text-red-600 font-semibold">Dibatalkan</span>
                                @endif
                            </td>
                            <td class="px-4 py-2 text-center">
                                <a href="{{ route('customer.transaksi.show', $transaksi->id) }}"
                                   class=" text-brand-dark">
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
