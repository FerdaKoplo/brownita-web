@extends('layout.admin.layout')
@section('title', 'Katalog')
@section('content')

    <div class="p-4 sm:p-6 bg-gray-50 min-h-screen">
        <div class="flex flex-col gap-4 sm:gap-6">

            {{-- Header --}}
            <div class="flex flex-wrap justify-between items-center gap-y-3">
                <h1 class="text-2xl sm:text-4xl font-bold text-gray-800">Katalog</h1>
                <a href="{{ route('dashboard.admin.katalog.create') }}"
                    class="bg-amber-700 hover:bg-orange-700 transition text-white px-3 py-2 sm:px-4 sm:py-2 rounded-lg font-medium text-sm sm:text-base">
                    + Buat Katalog
                </a>
            </div>

            {{-- Filter Form --}}
            <form action="{{ route('dashboard.admin.katalog.view') }}" method="GET"
                class="w-full sm:max-w-4xl flex flex-wrap items-center gap-10 bg-white p-3 rounded-lg shadow-md">

                {{-- Search --}}
                <div class="flex flex-col flex-1 gap-2 min-w-[200px]">
                    <div class="flex items-center gap-2 shadow-sm hover:shadow-md duration-300 rounded-lg bg-white p-3">
                        <i class="fa-solid fa-magnifying-glass text-gray-500"></i>
                        <input type="text" name="search" value="{{ request('search') }}"
                            class="w-full bg-transparent outline-none text-gray-700 placeholder-gray-400 text-sm sm:text-base"
                            placeholder="Cari Nama Produk atau Deskripsi...">
                        </div>
                    {{-- <span class="text-xs text-gray-400 mt-1">Cari berdasarkan nama produk atau deskripsi</span> --}}
                </div>

                {{-- Price Range --}}
                <div class="flex  flex-wrap gap-2">
                    <div class="flex flex-col-reverse gap-2">
                        <input type="number" name="price_min" value="{{ request('price_min') }}" placeholder="Harga Min"
                            class="border rounded px-2 py-1 text-sm">
                        <span class="text-xs text-gray-400 mt-1">Harga minimum</span>
                    </div>
                    <div class="flex flex-col-reverse gap-2">
                        <input type="number" name="price_max" value="{{ request('price_max') }}" placeholder="Harga Max"
                            class="border rounded px-2 py-1 text-sm">
                        <span class="text-xs text-gray-400 mt-1">Harga maksimum</span>
                    </div>
                </div>

                <div class="flex  flex-wrap gap-2">
                    {{-- Category --}}
                    <div class="flex flex-col-reverse gap-2">
                        <div class="flex items-center gap-2">
                            <i class="fa-solid fa-filter  text-gray-400"></i>
                                <select name="category_id" class="rounded px-2 py-1 border text-sm sm:text-base">
                                    <option value="">Semua Kategori</option>
                                    @foreach($categories as $category)
                                        <option value="{{ $category->id }}" {{ request('category_id') == $category->id ? 'selected' : '' }}>
                                            {{ $category->nama_kategori }}
                                        </option>
                                    @endforeach
                                </select>
                        </div>
                        <span class="text-xs text-gray-400 mt-1">Filter berdasarkan kategori</span>
                    </div>

                    {{-- Status --}}
                    <div class="flex flex-col-reverse gap-2">
                             <div class="flex items-center gap-2">
                                <i class="fa-solid fa-filter  text-gray-400"></i>
                                <select name="status" class="rounded px-2 py-1 border text-sm sm:text-base">
                                    <option value="">Semua Status</option>
                                    <option value="tersedia" {{ request('status') == 'tersedia' ? 'selected' : '' }}>Tersedia</option>
                                    <option value="habis" {{ request('status') == 'habis' ? 'selected' : '' }}>Habis</option>
                                </select>
                            </div>
                        <span class="text-xs text-gray-400 mt-1">Filter berdasarkan status</span>
                    </div>
                </div>


                {{-- Date Range --}}
                <div class="flex flex-col-reverse gap-2">
                    <input type="date" name="from" value="{{ request('from') }}" class="border rounded px-2 py-1 text-sm">
                    <span class="text-xs text-gray-400 mt-1">Tanggal mulai</span>
                </div>
                <div class="flex flex-col-reverse gap-2">
                    <input type="date" name="to" value="{{ request('to') }}" class="border rounded px-2 py-1 text-sm">
                    <span class="text-xs text-gray-400 mt-1">Tanggal selesai</span>
                </div>

                {{-- Submit & Reset --}}
                <div class="flex items-center gap-3 ">
                    <button type="submit"
                        class="bg-amber-600 text-white px-4 py-1 rounded text-sm hover:bg-black transition">
                        Filter
                    </button>
                    <a href="{{ route('dashboard.admin.katalog.view') }}"
                        class="text-red-500 font-semibold text-sm hover:underline ml-2">Reset</a>
                </div>
            </form>

            {{-- Table --}}
            <div class="overflow-x-auto rounded-lg shadow-md border overflow-hidden">
                <table class="w-full text-left min-w-[1200px] border-separate border-spacing-0">
                    <thead class="bg-white border-b border-gray-300 text-sm sm:text-base">
                        <tr clas>
                            <th class="border-b-2 px-4 py-3">#</th>
                            <th class="border-b-2 px-4 py-3">Kategori</th>
                            <th class="border-b-2 px-4 py-3">Nama Produk</th>
                            <th class="border-b-2 px-4 py-3">Deskripsi</th>
                            <th class="border-b-2 px-4 py-3">Gambar</th>
                            <th class="border-b-2 px-4 py-3">Harga</th>
                            <th class="border-b-2 px-4 py-3">Status</th>
                            <th class="border-b-2 px-4 py-3">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200 text-sm sm:text-base">
                        @forelse ($catalogues as $index => $catalogue)
                            <tr class="hover:bg-gray-50 transition">
                                <td class="px-4 py-3">{{ $index + 1 }}</td>
                                <td class="px-4 py-3">{{ $catalogue->category->nama_kategori }}</td>
                                <td class="px-4 py-3 font-medium text-gray-900">{{ $catalogue->nama_produk }}</td>
                                <td class="px-4 py-3 max-w-xs truncate" title="{{ $catalogue->deskripsi }}">
                                    {{ $catalogue->deskripsi }}
                                </td>
                                <td class="px-4 py-3">
                                    <div class="flex flex-wrap gap-2">
                                        @forelse($catalogue->images as $image)
                                            <img src="{{ asset('storage/' . $image->gambar_produk) }}"
                                                alt="{{ $catalogue->nama_produk }}"
                                                class="w-12 h-12 sm:w-14 sm:h-14 object-cover rounded-md border">
                                        @empty
                                            <span class="text-xs sm:text-sm text-gray-400 italic">Tidak ada gambar</span>
                                        @endforelse
                                    </div>
                                </td>
                                <td class="px-4 py-3 text-green-600 font-semibold">{{ $catalogue->harga_rupiah }}</td>
                                <td class="px-4 py-3">
                                    <span
                                        class="inline-block px-2 py-1 text-xs rounded-full
                                            {{ $catalogue->status == 'tersedia' ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-600' }}">
                                        {{ ucfirst($catalogue->status) }}
                                    </span>
                                </td>
                                <td class="px-4 py-3 space-x-2">
                                    <a href="{{ route('dashboard.admin.katalog.edit', $catalogue->id) }}"
                                        class="text-blue-600 hover:text-blue-800 transition">
                                        <i class="fa-solid fa-pen-to-square"></i>
                                    </a>
                                    <form class="inline deleteForm"
                                        action="{{ route('dashboard.admin.katalog.delete', $catalogue->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-400 hover:text-red-800 transition">
                                            <i class="fa-solid fa-trash"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="text-center py-5 text-gray-500">Tidak ada data katalog.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            {{-- Pagination --}}
            @if($catalogues->hasPages())
                <div class="flex justify-center gap-10 items-center mt-6">
                    @if($catalogues->onFirstPage())
                        <span class="text-gray-400 flex justify-center items-center gap-2">
                            <i class="fa-solid fa-angle-left"></i>
                            Prev
                        </span>
                    @else
                        <a href="{{ $catalogues->appends(request()->query())->previousPageUrl() }}"
                            class="text-amber-700 justify-center font-semibold flex items-center gap-2">
                            <i class="fa-solid fa-angle-left"></i>
                            Prev
                        </a>
                    @endif
                    @foreach ($catalogues->getUrlRange(1, $catalogues->lastPage()) as $page => $url)
                        <a href="{{ $url }}"
                            class="{{ $page == $catalogues->currentPage() ? 'bg-black text-white' : 'text-amber-700' }} px-2 py-1 rounded">
                            {{ $page }}
                        </a>
                    @endforeach

                    @if($catalogues->hasMorePages())
                        <a href="{{ $catalogues->appends(request()->query())->nextPageUrl() }}"
                            class="text-amber-700 font-semibold justify-center flex items-center gap-2">
                            Next
                            <i class="fa-solid fa-angle-right"></i>
                        </a>
                    @else
                        <span class="text-gray-400 flex items-center gap-2">
                            Next
                            <i class="fa-solid fa-angle-right"></i>
                        </span>
                    @endif
                </div>
            @endif
        </div>
    </div>

    {{-- SweetAlert --}}
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
