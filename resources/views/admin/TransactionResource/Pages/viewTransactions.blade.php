@extends('layout.admin.layout')
@section('title', 'Riwayat Transaksi')

@section('content')

    <div class="p-6 bg-gray-50 min-h-screen space-y-6" x-data="{ showFilters: {{ request()->hasAny(['status', 'from', 'to']) ? 'true' : 'false' }} }">
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
            <div>
                <h1 class="text-3xl font-bold text-gray-900 tracking-tight">Transaksi Pelanggan</h1>
                <p class="text-gray-500 text-sm mt-1">Pantau pesanan, pembayaran, dan pengiriman.</p>
            </div>
            {{-- <div class="flex gap-2">
                <button class="bg-white border border-gray-300 text-gray-700 hover:bg-gray-50 px-4 py-2 rounded-lg text-sm font-medium shadow-sm transition-all flex items-center gap-2">
                    <i class="fa-solid fa-download"></i> Export Data
                </button>
            </div> --}}
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            <div class="bg-white p-5 rounded-xl border border-gray-200 shadow-sm flex items-center gap-4">
                <div class="p-3 bg-blue-50 text-blue-600 rounded-lg">
                    <i class="fa-solid fa-receipt text-xl"></i>
                </div>
                <div>
                    <p class="text-xs text-gray-500 uppercase font-semibold">Total Pesanan</p>
                    <p class="text-xl font-bold text-gray-900">{{ $transaksis->total() }}</p>
                </div>
            </div>
            <div class="bg-white p-5 rounded-xl border border-gray-200 shadow-sm flex items-center gap-4">
                <div class="p-3 bg-yellow-50 text-yellow-600 rounded-lg">
                    <i class="fa-solid fa-clock text-xl"></i>
                </div>
                <div>
                    <p class="text-xs text-gray-500 uppercase font-semibold">Menunggu Konfirmasi</p>
                    <p class="text-xl font-bold text-gray-900">
                        {{ $transaksis->where('status', 'pending')->count() }}
                    </p>
                </div>
            </div>
            <div class="bg-white p-5 rounded-xl border border-gray-200 shadow-sm flex items-center gap-4">
                <div class="p-3 bg-green-50 text-green-600 rounded-lg">
                    <i class="fa-solid fa-money-bill-wave text-xl"></i>
                </div>
                <div>
                    <p class="text-xs text-gray-500 uppercase font-semibold">Total Pendapatan</p>
                    <p class="text-xl font-bold text-gray-900">Rp {{ number_format($transaksis->sum('total_harga'), 0, ',', '.') }}</p>
                </div>
            </div>
        </div>

        <div class="bg-white border border-gray-200 rounded-2xl shadow-sm overflow-hidden">
            
            <form action="{{ route('dashboard.admin.customer-transaction.view') }}" method="GET" class="border-b border-gray-100">
                <div class="p-5 flex flex-col md:flex-row gap-4 items-center justify-between bg-gray-50/50">
                    <div class="relative w-full md:max-w-md">
                        <i class="fa-solid fa-magnifying-glass absolute left-4 top-1/2 -translate-y-1/2 text-gray-400"></i>
                        <input type="text" 
                               name="search" 
                               value="{{ request('search') }}"
                               class="w-full pl-11 pr-4 py-2.5 bg-white border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-amber-500/20 focus:border-amber-500 transition-all shadow-sm"
                               placeholder="Cari ID Pesanan atau Nama Pelanggan..."
                        >
                    </div>

                    <div class="flex items-center gap-3 w-full md:w-auto">
                        <button type="button" 
                                @click="showFilters = !showFilters"
                                class="flex-1 md:flex-none flex items-center justify-center gap-2 px-4 py-2.5 border border-gray-300 bg-white text-gray-700 rounded-lg hover:bg-gray-50 text-sm font-medium transition-colors"
                                :class="{ 'bg-amber-50 border-amber-200 text-amber-700': showFilters }">
                            <i class="fa-solid fa-filter"></i>
                            Filter Lanjutan
                            <i class="fa-solid fa-chevron-down text-xs transition-transform duration-200" :class="{ 'rotate-180': showFilters }"></i>
                        </button>
                        <button type="submit" class="flex-1 md:flex-none bg-amber-600 hover:bg-amber-700 text-white px-6 py-2.5 rounded-lg text-sm font-medium shadow-sm transition-colors">
                            Cari
                        </button>
                    </div>
                </div>

                <div x-show="showFilters" x-collapse class="bg-gray-50 p-5 border-t border-gray-200 grid grid-cols-1 md:grid-cols-4 gap-4">
                    <div>
                        <label class="block text-xs font-semibold text-gray-500 uppercase mb-1">Status Pesanan</label>
                        <select name="status" class="w-full border-gray-300 rounded-lg text-sm focus:ring-amber-500 focus:border-amber-500">
                            <option value="">Semua Status</option>
                            <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                            <option value="dibayar" {{ request('status') == 'dibayar' ? 'selected' : '' }}>Dibayar</option>
                            <option value="dikirim" {{ request('status') == 'dikirim' ? 'selected' : '' }}>Dikirim</option>
                            <option value="selesai" {{ request('status') == 'selesai' ? 'selected' : '' }}>Selesai</option>
                            <option value="batal" {{ request('status') == 'batal' ? 'selected' : '' }}>Dibatalkan</option>
                        </select>
                    </div>

                    <div class="md:col-span-2">
                        <label class="block text-xs font-semibold text-gray-500 uppercase mb-1">Rentang Tanggal</label>
                        <div class="flex items-center gap-2">
                            <input type="date" name="from" value="{{ request('from') }}" class="w-full border-gray-300 rounded-lg text-sm focus:ring-amber-500 focus:border-amber-500">
                            <span class="text-gray-400">-</span>
                            <input type="date" name="to" value="{{ request('to') }}" class="w-full border-gray-300 rounded-lg text-sm focus:ring-amber-500 focus:border-amber-500">
                        </div>
                    </div>
                    
                    <div class="flex items-end">
                        <a href="{{ route('dashboard.admin.customer-transaction.view') }}" class="text-red-500 hover:text-red-700 text-sm font-medium hover:underline mb-2">
                            Reset Filter
                        </a>
                    </div>
                </div>
            </form>

            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead class="bg-gray-50 border-b border-gray-200">
                        <tr>
                            <th class="px-6 py-4 text-xs font-semibold text-gray-500 uppercase tracking-wider">Order ID & Tanggal</th>
                            <th class="px-6 py-4 text-xs font-semibold text-gray-500 uppercase tracking-wider">Pelanggan</th>
                            <th class="px-6 py-4 text-xs font-semibold text-gray-500 uppercase tracking-wider">Total</th>
                            <th class="px-6 py-4 text-xs font-semibold text-gray-500 uppercase tracking-wider">Bukti Bayar</th>
                            <th class="px-6 py-4 text-xs font-semibold text-gray-500 uppercase tracking-wider">Status</th>
                            <th class="px-6 py-4 text-xs font-semibold text-gray-500 uppercase tracking-wider text-right">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100 bg-white">
                        @forelse ($transaksis as $index => $transaksi)
                            <tr class="group hover:bg-amber-50/30 transition-colors duration-200">
                                
                                <td class="px-6 py-4">
                                    <div class="flex flex-col">
                                        <span class="font-mono text-gray-900 font-bold">#{{ $transaksi->id }}</span>
                                        <span class="text-xs text-gray-500">{{ $transaksi->created_at->format('d M Y, H:i') }}</span>
                                    </div>
                                </td>

                                <td class="px-6 py-4">
                                    <div class="flex items-center gap-3">
                                        <div class="w-8 h-8 rounded-full bg-gray-100 flex items-center justify-center text-gray-500 text-xs font-bold">
                                            {{ substr($transaksi->user->name ?? '?', 0, 1) }}
                                        </div>
                                        <span class="text-sm font-medium text-gray-700">{{ $transaksi->user->name ?? 'Deleted User' }}</span>
                                    </div>
                                </td>

                                <td class="px-6 py-4">
                                    <span class="text-green-600 font-bold">Rp {{ number_format($transaksi->total_harga, 0, ',', '.') }}</span>
                                </td>

                                <td class="px-6 py-4">
                                    @if($transaksi->bukti_pembayaran)
                                        <div class="group/img relative w-12 h-12">
                                            <a href="{{ asset('storage/' . $transaksi->bukti_pembayaran) }}" target="_blank" class="block w-full h-full">
                                                <img src="{{ asset('storage/' . $transaksi->bukti_pembayaran) }}" 
                                                     class="w-full h-full object-cover rounded-lg border border-gray-200 shadow-sm hover:scale-110 transition-transform duration-200">
                                            </a>
                                            <a href="{{ asset('storage/' . $transaksi->bukti_pembayaran) }}" download class="absolute -top-2 -right-2 bg-white rounded-full p-1 shadow-md border border-gray-200 opacity-0 group-hover/img:opacity-100 transition-opacity text-blue-500 hover:text-blue-700">
                                                <i class="fa-solid fa-download text-[10px]"></i>
                                            </a>
                                        </div>
                                    @else
                                        <span class="inline-flex items-center gap-1 px-2 py-1 rounded-md bg-gray-100 text-gray-400 text-xs border border-gray-200">
                                            <i class="fa-solid fa-ban text-[10px]"></i> No File
                                        </span>
                                    @endif
                                </td>

                                <td class="px-6 py-4">
                                    @if(request('edit') == $transaksi->id)
                                        <form action="{{ route('dashboard.admin.customer-transaction.update', $transaksi->id) }}" method="POST">
                                            @csrf
                                            @method('PUT')
                                            <select name="status" onchange="this.form.submit()"
                                                class="text-xs rounded-lg border-amber-300 focus:border-amber-500 focus:ring focus:ring-amber-200 bg-amber-50 py-1.5 pl-2 pr-8 shadow-sm cursor-pointer outline-none">
                                                <option value="pending" {{ $transaksi->status === 'pending' ? 'selected' : '' }}>Pending</option>
                                                <option value="dibayar" {{ $transaksi->status === 'dibayar' ? 'selected' : '' }}>Dibayar</option>
                                                <option value="dikirim" {{ $transaksi->status === 'dikirim' ? 'selected' : '' }}>Dikirim</option>
                                                <option value="selesai" {{ $transaksi->status === 'selesai' ? 'selected' : '' }}>Selesai</option>
                                                <option value="batal" {{ $transaksi->status === 'batal' ? 'selected' : '' }}>Batal</option>
                                            </select>
                                        </form>
                                    @else
                                        @php
                                            $statusClasses = [
                                                'pending' => 'bg-yellow-100 text-yellow-700 border-yellow-200',
                                                'dibayar' => 'bg-indigo-100 text-indigo-700 border-indigo-200',
                                                'dikirim' => 'bg-blue-100 text-blue-700 border-blue-200',
                                                'selesai' => 'bg-green-100 text-green-700 border-green-200',
                                                'batal'   => 'bg-red-100 text-red-700 border-red-200',
                                            ];
                                            $class = $statusClasses[$transaksi->status] ?? 'bg-gray-100 text-gray-700 border-gray-200';
                                        @endphp
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium border {{ $class }} capitalize">
                                            {{ $transaksi->status }}
                                        </span>
                                    @endif
                                </td>

                                <td class="px-6 py-4 text-right">
                                    <div class="flex items-center justify-end gap-2">
                                        <a href="{{ route('dashboard.admin.customer-transaction.show', $transaksi->id) }}"
                                           class="w-8 h-8 flex items-center justify-center rounded-lg bg-white border border-gray-200 text-gray-500 hover:text-amber-600 hover:border-amber-300 transition-all shadow-sm"
                                           title="Lihat Detail">
                                            <i class="fa-solid fa-eye text-xs"></i>
                                        </a>

                                        @if(request('edit') == $transaksi->id)
                                            <a href="{{ route('dashboard.admin.customer-transaction.view') }}"
                                               class="w-8 h-8 flex items-center justify-center rounded-lg bg-gray-100 border border-gray-300 text-gray-600 hover:bg-gray-200 transition-all shadow-sm"
                                               title="Batal Edit">
                                                <i class="fa-solid fa-xmark text-xs"></i>
                                            </a>
                                        @else
                                            <a href="{{ route('dashboard.admin.customer-transaction.view', array_merge(request()->query(), ['edit' => $transaksi->id])) }}"
                                               class="w-8 h-8 flex items-center justify-center rounded-lg bg-white border border-gray-200 text-gray-500 hover:text-blue-600 hover:border-blue-300 transition-all shadow-sm"
                                               title="Update Status">
                                                <i class="fa-solid fa-pen-to-square text-xs"></i>
                                            </a>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="px-6 py-12 text-center">
                                    <div class="flex flex-col items-center justify-center">
                                        <div class="w-16 h-16 bg-gray-100 rounded-full flex items-center justify-center text-gray-400 mb-4">
                                            <i class="fa-solid fa-clipboard-list text-2xl"></i>
                                        </div>
                                        <h3 class="text-lg font-semibold text-gray-900">Belum ada transaksi</h3>
                                        <p class="text-sm text-gray-500 mt-1">Data pesanan akan muncul di sini.</p>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            @if($transaksis->hasPages())
                <div class="px-6 py-4 border-t border-gray-100 bg-gray-50 flex flex-col sm:flex-row justify-between items-center gap-4">
                    <div class="text-sm text-gray-500">
                        Menampilkan <span class="font-medium">{{ $transaksis->firstItem() }}</span> - <span class="font-medium">{{ $transaksis->lastItem() }}</span> dari <span class="font-medium">{{ $transaksis->total() }}</span> transaksi
                    </div>
                    <div>
                        {{ $transaksis->appends(request()->query())->links('pagination::tailwind') }}
                    </div>
                </div>
            @endif
        </div>
    </div>

    <script>
        document.addEventListener('submit', function (e) {
            if (e.target.classList.contains('deleteForm')) {
                e.preventDefault();
                Swal.fire({
                    title: 'Hapus Data?',
                    text: "Data tidak dapat dikembalikan",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#3085d6',
                    confirmButtonText: 'Ya, Hapus'
                }).then((result) => {
                    if (result.isConfirmed) {
                        e.target.submit();
                    }
                });
            }
        });
    </script>

@endsection