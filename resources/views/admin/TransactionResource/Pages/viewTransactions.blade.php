@extends('layout.admin.layout')
@section('title', 'Transaksi')
@section('content')

<div class="p-6 bg-gray-50 min-h-screen">
    <div class="flex flex-col gap-6">
        <div class="flex justify-between items-center">
            <h1 class="text-4xl font-bold text-gray-800">Daftar Transaksi</h1>
        </div>

        <form action="{{ route('dashboard.admin.customer-transaction.view') }}" method="GET"
            class="max-w-md w-full flex items-center gap-3 bg-white p-3 rounded-lg shadow-md">
            <i class="fa-solid fa-magnifying-glass text-gray-500"></i>
            <input type="text" name="search" value="{{ request('search') }}"
                class="w-full bg-transparent outline-none text-gray-700 placeholder-gray-400"
                placeholder="Cari Transaksi...">
        </form>

        <div class="overflow-auto rounded-lg shadow-md">
            <table class="w-full text-left min-w-[800px]">
                <thead class="bg-black text-white">
                    <tr>
                        <th class="px-4 py-3">#</th>
                        <th class="px-4 py-3">Tanggal</th>
                        <th class="px-4 py-3">User</th>
                        <th class="px-4 py-3">Total Harga</th>
                        <th class="px-4 py-3">Status</th>
                        <th class="px-4 py-3">Aksi</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200 text-sm text-gray-700">
                    @forelse ($transaksis as $index => $transaksi)
                        <tr class="hover:bg-gray-50 transition">
                            <td class="px-4 py-3">
                                {{ $loop->iteration + ($transaksis->currentPage() - 1) * $transaksis->perPage() }}
                            </td>
                            <td class="px-4 py-3">{{ $transaksi->created_at->format('d M Y') }}</td>
                            <td class="px-4 py-3">{{ $transaksi->user->name ?? '—' }}</td>
                            <td class="px-4 py-3 text-green-600 font-medium">Rp {{ number_format($transaksi->total_harga, 0, ',', '.') }}</td>
                            <td class="px-4 py-3">
                                @if(request('edit') == $transaksi->id)
                                    <form action="{{ route('dashboard.admin.customer-transaction.update', $transaksi->id) }}"
                                        method="POST">
                                        @csrf
                                        @method('PUT')
                                        <select name="status" onchange="this.form.submit()"
                                            class="text-sm rounded px-2 py-1 border bg-white shadow-sm">
                                            <option value="pending" {{ $transaksi->status === 'pending' ? 'selected' : '' }}>Pending</option>
                                            <option value="dibayar" {{ $transaksi->status === 'dibayar' ? 'selected' : '' }}>Dibayar</option>
                                            <option value="dikirim" {{ $transaksi->status === 'dikirim' ? 'selected' : '' }}>Dikirim</option>
                                            <option value="selesai" {{ $transaksi->status === 'selesai' ? 'selected' : '' }}>Selesai</option>
                                            <option value="batal" {{ $transaksi->status === 'batal' ? 'selected' : '' }}>Dibatalkan</option>
                                        </select>
                                    </form>
                                @else
                                    @php
                                        $colorMap = [
                                            'pending' => 'bg-yellow-100 text-yellow-700',
                                            'dibayar' => 'bg-green-100 text-green-700',
                                            'dikirim' => 'bg-blue-100 text-blue-700',
                                            'selesai' => 'bg-gray-200 text-gray-800',
                                            'batal' => 'bg-red-100 text-red-600',
                                        ];
                                    @endphp
                                    <span class="inline-block px-2 py-1 text-xs rounded-full font-medium {{ $colorMap[$transaksi->status] ?? 'bg-gray-100 text-gray-700' }}">
                                        {{ ucfirst($transaksi->status) }}
                                    </span>
                                @endif
                            </td>
                            <td class="px-4 py-3 space-x-2">
                                <a href="{{ route('dashboard.admin.customer-transaction.show', $transaksi->id) }}"
                                    class="text-gray-500 hover:text-black transition">
                                    <i class="fa-solid fa-eye"></i>
                                </a>

                                @if(request('edit') == $transaksi->id)
                                    <a href="{{ route('dashboard.admin.customer-transaction.view') }}"
                                        class="text-gray-600 hover:text-gray-800 transition">
                                        <i class="fa-solid fa-xmark"></i>
                                    </a>
                                @else
                                    <a href="{{ route('dashboard.admin.customer-transaction.view', ['edit' => $transaksi->id]) }}"
                                        class="text-blue-400 hover:text-blue-600 transition">
                                        <i class="fa-solid fa-pen-to-square"></i>
                                    </a>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center py-5 text-gray-500">Tidak ada data transaksi.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if(method_exists($transaksis, 'links'))
            <div class="mt-4">
                {{ $transaksis->links() }}
            </div>
        @endif
    </div>
</div>

<script>
    document.addEventListener('submit', function (e) {
        if (e.target.classList.contains('deleteForm')) {
            e.preventDefault();
            Swal.fire({
                title: 'Yakin ingin menghapus?',
                text: "Data yang dihapus tidak bisa dikembalikan.",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, hapus!'
            }).then((result) => {
                if (result.isConfirmed) {
                    e.target.submit();
                }
            });
        }
    });
</script>
@endsection
