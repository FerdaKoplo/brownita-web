@extends('layout.admin.layout')
@section('title', 'Transaksi')
@section('content')

    <div class="p-5 flex flex-col gap-10">
        <h1 class="text-3xl font-bold text-brand-dark">Daftar Transaksi</h1>
        <div class="flex flex-col gap-3">
            <div class="flex w-full h-full justify-between items-center">
                <form action="{{ route('dashboard.admin.customer-transaction.view') }}" method="GET"
                    class="max-w-md w-full flex items-center gap-2">
                    <i class="fa-solid fa-magnifying-glass"></i>
                    <input type="text" name="search" value="{{ request('search') }}"
                        class="bg-brand-secondary appearance-none text-white w-full py-2 rounded-lg px-2"
                        placeholder="Cari Transaksi...">
                </form>
            </div>

            <table class="table-auto w-full border-collapse">
                <thead class="bg-brand-secondary text-white">
                    <tr>
                        <th class="text-left px-4 py-3">#</th>
                        <th class="text-left px-4 py-3">Tanggal</th>
                        <th class="text-left px-4 py-3">User</th>
                        <th class="text-left px-4 py-3">Total Harga</th>
                        <th class="text-left px-4 py-3">Status</th>
                        <th class="text-left px-4 py-3">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-brand-lightdark text-sm text-gray-700 ">
                    @foreach ($transaksis as $index => $transaksi)
                        <tr>
                            <td class="px-4 py-2">
                                {{ $loop->iteration + ($transaksis->currentPage() - 1) * $transaksis->perPage() }}
                            </td>
                            <td class="px-4 py-2">{{ $transaksi->created_at->format('d M Y') }}</td>
                            <td class="px-4 py-2">{{ $transaksi->user->name ?? '—' }}</td>
                            <td class="px-4 py-2">Rp {{ number_format($transaksi->total_harga, 0, ',', '.') }}</td>
                            <td class="px-4 py-2">
                                @if(request('edit') == $transaksi->id)
                                    <form action="{{ route('dashboard.admin.customer-transaction.update', $transaksi->id) }}"
                                        method="POST" class="inline">
                                        @csrf
                                        @method('PUT')
                                        <select name="status" onchange="this.form.submit()"
                                            class="text-sm rounded px-2 py-1 border bg-white">
                                            <option value="pending" {{ $transaksi->status === 'pending' ? 'selected' : '' }}>Pending
                                            </option>
                                            <option value="dibayar" {{ $transaksi->status === 'dibayar' ? 'selected' : '' }}>Dibayar
                                            </option>
                                            <option value="dikirim" {{ $transaksi->status === 'dikirim' ? 'selected' : '' }}>Dikirim
                                            </option>
                                            <option value="selesai" {{ $transaksi->status === 'selesai' ? 'selected' : '' }}>Selesai
                                            </option>
                                            <option value="batal" {{ $transaksi->status === 'batal' ? 'selected' : '' }}>Dibatalkan
                                            </option>
                                        </select>
                                    </form>
                                @else
                                    @php
                                        $colors = [
                                            'pending' => 'text-yellow-600',
                                            'dibayar' => 'text-green-600',
                                            'dikirim' => 'text-blue-600',
                                            'selesai' => 'text-gray-800',
                                            'batal' => 'text-red-600',
                                        ];
                                    @endphp
                                    <span class="font-semibold {{ $colors[$transaksi->status] ?? 'text-black' }}">
                                        {{ ucfirst($transaksi->status) }}
                                    </span>
                                @endif
                            </td>
                            <td class="px-4 py-2 space-x-2">
                                <a href="{{ route('dashboard.admin.customer-transaction.show', $transaksi->id) }}"
                                    class="text-brand-dark">
                                    <i class="fa-solid fa-eye"></i>
                                </a>

                                @if(request('edit') == $transaksi->id)
                                    <a href="{{ route('dashboard.admin.customer-transaction.view') }}">
                                        <i class="fa-solid fa-xmark"></i>
                                    </a>
                                @else
                                    <a href="{{ route('dashboard.admin.customer-transaction.view', ['edit' => $transaksi->id]) }}"
                                        class="text-brand-dark">
                                        <i class="fa-solid fa-pen-to-square"></i>
                                    </a>
                                @endif

                                <form action="{{ route('dashboard.admin.customer-transaction.delete', $transaksi->id) }}"
                                    method="POST" class="inline deleteForm">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-brand-dark hover:underline">
                                        <i class="fa-solid fa-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <div class="mt-6 flex justify-center">
                {{ $transaksis->links() }}
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('submit', function (e) {
            if (e.target.classList.contains('deleteForm')) {
                e.preventDefault();
                Swal.fire({
                    title: 'Yakin ingin menghapus?',
                    text: "Data tidak dapat dikembalikan!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Ya, hapus!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        e.target.submit();
                    }
                })
            }
        })
    </script>
@endsection
