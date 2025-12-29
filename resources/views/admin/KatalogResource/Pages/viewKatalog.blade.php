@extends('layout.admin.layout')
@section('title', 'Katalog Produk')

@section('content')

    <div class="p-6 bg-gray-50 min-h-screen space-y-6" x-data="{ showFilters: {{ request()->hasAny(['price_min', 'price_max', 'category_id', 'status', 'from', 'to']) ? 'true' : 'false' }} }">

        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
            <div>
                <h1 class="text-3xl font-bold text-gray-900 tracking-tight">Katalog Produk</h1>
                <p class="text-gray-500 text-sm mt-1">Kelola daftar produk, harga, dan stok.</p>
            </div>
            <a href="{{ route('dashboard.admin.katalog.create') }}"
               class="flex items-center gap-2 bg-amber-700 hover:bg-amber-800 text-white px-5 py-2.5 rounded-xl font-semibold shadow-lg shadow-amber-900/20 transition-all hover:-translate-y-0.5">
                <i class="fa-solid fa-plus"></i>
                <span>Tambah Produk</span>
            </a>
        </div>

        <div class="bg-white border border-gray-200 rounded-2xl shadow-sm overflow-hidden">

            <form action="{{ route('dashboard.admin.katalog.view') }}" method="GET" class="border-b border-gray-100">
                
                <div class="p-5 flex flex-col md:flex-row gap-4 items-center justify-between bg-gray-50/50">
                    <div class="relative w-full md:max-w-md">
                        <i class="fa-solid fa-magnifying-glass absolute left-4 top-1/2 -translate-y-1/2 text-gray-400"></i>
                        <input type="text" 
                               name="search" 
                               value="{{ request('search') }}"
                               class="w-full pl-11 pr-4 py-2.5 bg-white border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-amber-500/20 focus:border-amber-500 transition-all shadow-sm"
                               placeholder="Cari nama produk, SKU, atau deskripsi..."
                        >
                    </div>

                    <div class="flex items-center gap-3 w-full md:w-auto">
                        <button type="button" 
                                @click="showFilters = !showFilters"
                                class="flex-1 md:flex-none flex items-center justify-center gap-2 px-4 py-2.5 border border-gray-300 bg-white text-gray-700 rounded-lg hover:bg-gray-50 text-sm font-medium transition-colors"
                                :class="{ 'bg-amber-50 border-amber-200 text-amber-700': showFilters }">
                            <i class="fa-solid fa-filter"></i>
                            Filter
                            <i class="fa-solid fa-chevron-down text-xs transition-transform duration-200" :class="{ 'rotate-180': showFilters }"></i>
                        </button>
                        <button type="submit" class="flex-1 md:flex-none bg-amber-600 hover:bg-amber-700 text-white px-6 py-2.5 rounded-lg text-sm font-medium shadow-sm transition-colors">
                            Terapkan
                        </button>
                    </div>
                </div>

                <div x-show="showFilters" x-collapse class="bg-gray-50 p-5 border-t border-gray-200 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
                    
                    <div>
                        <label class="block text-xs font-semibold text-gray-500 uppercase mb-1">Kategori</label>
                        <select name="category_id" class="w-full border-gray-300 rounded-lg text-sm focus:ring-amber-500 focus:border-amber-500">
                            <option value="">Semua Kategori</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}" {{ request('category_id') == $category->id ? 'selected' : '' }}>
                                    {{ $category->nama_kategori }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    {{-- Status --}}
                    <div>
                        <label class="block text-xs font-semibold text-gray-500 uppercase mb-1">Status Stock</label>
                        <select name="status" class="w-full border-gray-300 rounded-lg text-sm focus:ring-amber-500 focus:border-amber-500">
                            <option value="">Semua Status</option>
                            <option value="tersedia" {{ request('status') == 'tersedia' ? 'selected' : '' }}>Tersedia</option>
                            <option value="habis" {{ request('status') == 'habis' ? 'selected' : '' }}>Habis</option>
                        </select>
                    </div>

                    {{-- Price Range --}}
                    <div class="col-span-1 md:col-span-2">
                        <label class="block text-xs font-semibold text-gray-500 uppercase mb-1">Rentang Harga</label>
                        <div class="flex items-center gap-2">
                            <input type="number" name="price_min" value="{{ request('price_min') }}" placeholder="Min" class="w-full border-gray-300 rounded-lg text-sm focus:ring-amber-500 focus:border-amber-500">
                            <span class="text-gray-400">-</span>
                            <input type="number" name="price_max" value="{{ request('price_max') }}" placeholder="Max" class="w-full border-gray-300 rounded-lg text-sm focus:ring-amber-500 focus:border-amber-500">
                        </div>
                    </div>

                    {{-- Date Range --}}
                    <div class="col-span-1 md:col-span-2 lg:col-span-4 flex items-center justify-between pt-2">
                        <div class="flex items-center gap-4 w-full max-w-lg">
                            <div class="flex-1">
                                <label class="text-xs text-gray-500">Dari Tanggal</label>
                                <input type="date" name="from" value="{{ request('from') }}" class="w-full border-gray-300 rounded-lg text-xs mt-1">
                            </div>
                            <div class="flex-1">
                                <label class="text-xs text-gray-500">Sampai Tanggal</label>
                                <input type="date" name="to" value="{{ request('to') }}" class="w-full border-gray-300 rounded-lg text-xs mt-1">
                            </div>
                        </div>
                        <a href="{{ route('dashboard.admin.katalog.view') }}" class="text-red-500 hover:underline text-sm font-medium mt-auto">
                            Reset Semua Filter
                        </a>
                    </div>
                </div>
            </form>

            {{-- Table --}}
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead class="bg-gray-50 border-b border-gray-200">
                        <tr>
                            <th class="px-6 py-4 text-xs font-semibold text-gray-500 uppercase tracking-wider w-12">#</th>
                            <th class="px-6 py-4 text-xs font-semibold text-gray-500 uppercase tracking-wider">Produk Info</th>
                            <th class="px-6 py-4 text-xs font-semibold text-gray-500 uppercase tracking-wider">Harga</th>
                            <th class="px-6 py-4 text-xs font-semibold text-gray-500 uppercase tracking-wider">Status</th>
                            <th class="px-6 py-4 text-xs font-semibold text-gray-500 uppercase tracking-wider text-right">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100 bg-white">
                        @forelse ($catalogues as $index => $catalogue)
                            <tr class="group hover:bg-amber-50/30 transition-colors duration-200">
                                <td class="px-6 py-4 text-gray-400 text-sm">
                                    {{ $catalogues->firstItem() + $index }}
                                </td>
                                
                                <td class="px-6 py-4">
                                    <div class="flex items-start gap-4">
                                        <div class="relative w-14 h-14 flex-shrink-0">
                                            @if($catalogue->images->isNotEmpty())
                                                <img src="{{ asset('storage/' . $catalogue->images->first()->gambar_produk) }}" 
                                                     alt="{{ $catalogue->nama_produk }}" 
                                                     class="w-full h-full object-cover rounded-lg border border-gray-200 shadow-sm">
                                                
                                                @if($catalogue->images->count() > 1)
                                                    <span class="absolute -bottom-1 -right-1 bg-gray-800 text-white text-[10px] px-1.5 py-0.5 rounded-full border border-white">
                                                        +{{ $catalogue->images->count() - 1 }}
                                                    </span>
                                                @endif
                                            @else
                                                <div class="w-full h-full bg-gray-100 rounded-lg flex items-center justify-center text-gray-400 border border-gray-200">
                                                    <i class="fa-solid fa-image"></i>
                                                </div>
                                            @endif
                                        </div>

                                        <div>
                                            <div class="font-bold text-gray-900 group-hover:text-amber-700 transition-colors">
                                                {{ $catalogue->nama_produk }}
                                            </div>
                                            <div class="text-xs text-amber-600 bg-amber-50 px-2 py-0.5 rounded inline-block mt-1 font-medium border border-amber-100">
                                                {{ $catalogue->category->nama_kategori ?? 'Uncategorized' }}
                                            </div>
                                            <p class="text-xs text-gray-400 mt-1 max-w-xs truncate">
                                                {{ $catalogue->deskripsi }}
                                            </p>
                                        </div>
                                    </div>
                                </td>

                                <td class="px-6 py-4">
                                    <span class="font-bold text-gray-800 tracking-wide">
                                        {{ $catalogue->harga_rupiah }}
                                    </span>
                                </td>

                                <td class="px-6 py-4">
                                    @if($catalogue->status == 'tersedia')
                                        <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-medium bg-green-50 text-green-700 border border-green-100">
                                            <span class="w-1.5 h-1.5 rounded-full bg-green-500"></span>
                                            Tersedia
                                        </span>
                                    @else
                                        <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-medium bg-red-50 text-red-700 border border-red-100">
                                            <span class="w-1.5 h-1.5 rounded-full bg-red-500"></span>
                                            Habis
                                        </span>
                                    @endif
                                </td>

                                <td class="px-6 py-4 text-right">
                                    <div class="flex items-center justify-end gap-2 opacity-0 group-hover:opacity-100 transition-opacity duration-200">
                                        <a href="{{ route('dashboard.admin.katalog.edit', $catalogue->id) }}"
                                           class="w-8 h-8 flex items-center justify-center rounded-lg bg-white border border-gray-200 text-gray-500 hover:text-blue-600 hover:border-blue-300 transition-colors shadow-sm"
                                           title="Edit">
                                            <i class="fa-solid fa-pen-to-square text-xs"></i>
                                        </a>
                                        
                                        <form class="deleteForm inline" action="{{ route('dashboard.admin.katalog.delete', $catalogue->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" 
                                                    class="w-8 h-8 flex items-center justify-center rounded-lg bg-white border border-gray-200 text-gray-500 hover:text-red-600 hover:border-red-300 transition-colors shadow-sm"
                                                    title="Hapus">
                                                <i class="fa-solid fa-trash text-xs"></i>
                                            </button>
                                        </form>
                                    </div>
                                    <div class="sm:hidden flex justify-end gap-2">
                                        {{-- Mobile buttons --}}
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="px-6 py-12 text-center">
                                    <div class="flex flex-col items-center justify-center">
                                        <div class="w-16 h-16 bg-gray-100 rounded-full flex items-center justify-center text-gray-400 mb-4">
                                            <i class="fa-solid fa-box-open text-2xl"></i>
                                        </div>
                                        <h3 class="text-lg font-semibold text-gray-900">Tidak ada produk ditemukan</h3>
                                        <p class="text-sm text-gray-500 mt-1 max-w-sm">
                                            Coba ubah filter pencarian Anda atau tambahkan produk baru ke katalog.
                                        </p>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            @if($catalogues->hasPages())
                <div class="px-6 py-4 border-t border-gray-100 bg-gray-50 flex flex-col sm:flex-row justify-between items-center gap-4">
                    <div class="text-sm text-gray-500">
                        Menampilkan <span class="font-medium">{{ $catalogues->firstItem() }}</span> - <span class="font-medium">{{ $catalogues->lastItem() }}</span> dari <span class="font-medium">{{ $catalogues->total() }}</span> produk
                    </div>
                    <div>
                        {{ $catalogues->appends(request()->query())->links('pagination::tailwind') }}
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
                    title: 'Hapus Produk?',
                    text: "Produk yang dihapus tidak dapat dikembalikan.",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#3085d6',
                    confirmButtonText: 'Ya, Hapus!',
                    cancelButtonText: 'Batal',
                    reverseButtons: true
                }).then((result) => {
                    if (result.isConfirmed) {
                        e.target.submit();
                    }
                });
            }
        });
    </script>

@endsection