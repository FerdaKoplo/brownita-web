@extends('layout.customer.app')
@section('title', 'BROWNITA - Katalog')
@section('content')

<div class="p-6  min-h-screen">
    <div class="flex flex-col md:flex-row gap-10">
        {{-- Sidebar --}}
        <div class="w-full md:max-w-xs space-y-6">
            {{-- Search --}}
            <form method="GET" action="{{ route('produk-kami') }}" class="bg-black text-white p-4 rounded-lg shadow-md flex items-center gap-3">
                <i class="fa fa-search text-white"></i>
                <input type="text" name="search" value="{{ request('search') }}"
                    class="w-full bg-transparent outline-none  placeholder-white"
                    placeholder="Cari Menu...">
                @foreach((array) request('category_id') as $id)
                    <input type="hidden" name="category_id[]" value="{{ $id }}">
                @endforeach
                @if(request('status'))
                    <input type="hidden" name="status" value="{{ request('status') }}">
                @endif
            </form>

            {{-- Filter Status --}}
            <form method="GET" action="{{ route('produk-kami') }}" class="bg-white p-4 rounded-lg shadow-md space-y-4">
                <label class="block text-gray-800 font-semibold text-lg">Ketersediaan</label>
                <a href="{{ route('produk-kami') }}" class="text-sm text-amber-700 font-semibold">Reset Filter</a>
                <select name="status" onchange="this.form.submit()"
                    class="w-full py-2 px-3 rounded-md border border-gray-300 text-gray-700">
                    <option value="">Semua Status</option>
                    <option value="tersedia" {{ request('status') == 'tersedia' ? 'selected' : '' }}>Tersedia</option>
                    <option value="habis" {{ request('status') == 'habis' ? 'selected' : '' }}>Habis</option>
                </select>
                @foreach((array) request('category_id') as $id)
                    <input type="hidden" name="category_id[]" value="{{ $id }}">
                @endforeach
                @if(request('search'))
                    <input type="hidden" name="search" value="{{ request('search') }}">
                @endif
            </form>

            {{-- Filter Harga --}}
            <form method="GET" action="{{ route('produk-kami') }}" class="mb-5 bg-white shadow-md rounded-lg">
                {{-- Sort Dropdown --}}
                <label for="sort" class="mr-2 font-semibold">Urutkan harga:</label>
                <select name="sort" id="sort" onchange="this.form.submit()" class="border border-gray-300 px-4 py-2 rounded">
                    <option value="asc" {{ request('sort') == 'asc' ? 'selected' : '' }}>Termurah</option>
                    <option value="desc" {{ request('sort') == 'desc' ? 'selected' : '' }}>Termahal</option>
                </select>

                <div class="mt-3 gap-3 flex flex-col">
                    @php
                        $min = preg_replace('/[^\d]/', '', request('min_price'));
                        $max = preg_replace('/[^\d]/', '', request('max_price'));
                    @endphp
                    <div class="flex ">
                        <input type="text" name="min_price" placeholder="Min Harga"
                            value="{{ $min ? number_format((int) $min, 0, ',', '.') : '' }}"
                            class="border border-gray-300 px-4 py-2 rounded w-32 rupiah-input" />

                        <input type="text" name="max_price" placeholder="Max Harga"
                            value="{{ $max ? number_format((int) $max, 0, ',', '.') : '' }}"
                            class="border border-gray-300 px-4 py-2 rounded w-32 rupiah-input" />
                    </div>
                    <button type="submit" class="bg-amber-700 text-white px-4 py-2 rounded">Terapkan</button>
                </div>
            </form>

            {{-- Filter Kategori --}}
            <div class="bg-white p-4 rounded-lg shadow-md">
                <h2 class="font-semibold text-gray-800 mb-2">Kategori</h2>
                <ul class="space-y-2">
                    @foreach($categories as $category)
                        <li>
                            <form method="GET" action="{{ route('produk-kami') }}">
                                <label class="flex items-center gap-2 cursor-pointer">
                                    <input type="checkbox" name="category_id[]" class="h-5 w-5 rounded-md border-gray-300 text-amber-700 focus:ring-amber-700"
                                        value="{{ $category->id }}"
                                        onchange="this.form.submit()"
                                        {{ in_array($category->id, (array) request('category_id')) ? 'checked' : '' }}>
                                    <span class="text-gray-700">{{ $category->nama_kategori }}</span>
                                </label>
                                @foreach((array) request('category_id') as $keepId)
                                    @if($keepId != $category->id)
                                        <input type="hidden" name="category_id[]" value="{{ $keepId }}">
                                    @endif
                                @endforeach
                                @if(request('search'))
                                    <input type="hidden" name="search" value="{{ request('search') }}">
                                @endif
                                @if(request('status'))
                                    <input type="hidden" name="status" value="{{ request('status') }}">
                                @endif
                             </form>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>

        {{-- Main Content --}}
        <div class="flex-1 space-y-6">
            <div class="flex justify-between items-center">
                <h1 class="text-2xl font-bold text-gray-800">
                    @if(request('category_id') && $categories)
                        {{ $categories->whereIn('id', (array) request('category_id'))->pluck('nama_kategori')->implode(', ') }}
                    @else
                        Semua Katalog
                    @endif
                </h1>
                {{-- @if(isset($stats))
                <div class="text-sm text-gray-700 space-x-4">
                    <span>Total: <strong>{{ $stats['total'] }}</strong></span>
                    <span class="text-green-600">Tersedia: <strong>{{ $stats['tersedia'] }}</strong></span>
                    <span class="text-red-600">Habis: <strong>{{ $stats['habis'] }}</strong></span>
                </div>
                @endif --}}
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                @forelse($catalogues as $catalogue)
                    <div class="rounded-lg shadow-md overflow-hidden bg-white">
                        <div class="relative">
                            <div class="absolute top-2 right-2 text-xs px-2 py-1 rounded-full {{ $catalogue->status == 'tersedia' ? 'bg-green-200 text-green-700' : 'bg-red-200 text-red-700' }} ">
                                {{ ucfirst($catalogue->status) }}
                            </div>
                            <img src="{{ $catalogue->images->first()? asset('storage/' . $catalogue->images->first()->gambar_produk) : asset('images/default-product.jpg') }}" alt="{{ $catalogue->nama_produk }}" class="w-full h-48 object-cover">
                        </div>
                        <div class="p-4 space-y-3 text-center">
                            <h2 class="font-semibold text-gray-800">{{ $catalogue->nama_produk }}</h2>
                            <p class="text-sm italic text-gray-500">"{{ Str::limit($catalogue->deskripsi, 60, '...') }}"</p>
                            <p class="text-lg font-bold text-amber-700">{{ $catalogue->harga_rupiah ?? 'Harga Tidak Diketahui' }}</p>
                            <div class="flex justify-center gap-2">
                                <a href="{{ route('produk.detail', $catalogue->id) }}"
                                    class="px-4 py-2 border border-gray-800 transition text-gray-800 rounded-full text-sm hover:bg-gray-100">
                                    Lihat
                                </a>
                                @if(Auth::check())
                                <form action="{{ route('keranjang.store') }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="katalog_id" value="{{ $catalogue->id }}">
                                    <button type="submit" class="px-4 py-2 bg-amber-700 transition text-white rounded-full text-sm hover:bg-gray-700">
                                        <i class="fa-solid fa-cart-shopping"></i>
                                    </button>
                                </form>
                                @endif
                            </div>
                        </div>
                    </div>
                @empty
                    <p class="col-span-full text-center text-gray-500 py-10">Tidak ada produk yang ditemukan.</p>
                @endforelse
            </div>

            {{-- Pagination --}}
            @if($catalogues->hasPages())
                <div class="flex justify-between items-center mt-6">
                    @if($catalogues->onFirstPage())
                        <span class="text-gray-400">← Sebelumnya</span>
                    @else
                        <a href="{{ $catalogues->appends(request()->query())->previousPageUrl() }}"
                            class="text-amber-700 hover:underline">← Sebelumnya</a>
                    @endif

                    <span class="text-sm text-gray-600">Halaman {{ $catalogues->currentPage() }}</span>

                    @if($catalogues->hasMorePages())
                        <a href="{{ $catalogues->appends(request()->query())->nextPageUrl() }}"
                            class="text-amber-700 hover:underline">Selanjutnya →</a>
                    @else
                        <span class="text-gray-400">Selanjutnya →</span>
                    @endif
                </div>
            @endif
        </div>
    </div>
</div>

<script>
    document.querySelectorAll('.rupiah-input').forEach(function(input) {
        input.addEventListener('input', function(e) {
            let value = e.target.value.replace(/[^\d]/g, '');
            if (value) {
                e.target.value = formatRupiah(value);
            } else {
                e.target.value = '';
            }
        });

        function formatRupiah(angka) {
            let number_string = angka.replace(/[^,\d]/g, '').toString(),
                split = number_string.split(','),
                sisa = split[0].length % 3,
                rupiah = split[0].substr(0, sisa),
                ribuan = split[0].substr(sisa).match(/\d{3}/gi);

            if (ribuan) {
                let separator = sisa ? '.' : '';
                rupiah += separator + ribuan.join('.');
            }

            rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
            return 'Rp ' + rupiah;
        }
    });
</script>

@endsection
