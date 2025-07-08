<<<<<<< HEAD
@extends('layout.customer.app')
@section('title', 'BROWNITA - Katalog')
@section('content')

<div class="flex pt-10 px-32 flex-col md:flex-row gap-8">
    {{-- Sidebar --}}
    <div class="px-4 max-w-lg flex flex-col justify-center items-center">
            {{-- Search --}}
            <form method="GET" action="{{ route('produk-kami') }}" class="bg-brand-dark text-brand-light w-10/12 rounded-t-2xl px-4 py-2 flex items-center gap-3">
                <i class="fa fa-search text-white"></i>
                <input type="text" name="search"
                    class="bg-brand-dark w-full text-sm text-white placeholder-white focus:outline-none"
                    placeholder="Cari Menu..." value="{{ request('search') }}">
                @foreach((array) request('category_id') as $id)
                    <input type="hidden" name="category_id[]" value="{{ $id }}">
                @endforeach
                @if(request('status'))
                    <input type="hidden" name="status" value="{{ request('status') }}">
                @endif
            </form>
        <div class="bg-brand-lightdark w-full px-7 py-5 rounded-2xl flex flex-col gap-5">

            {{-- Filter Status --}}
            <form method="GET" action="{{ route('produk-kami') }}" class="space-y-4">
                <label class="block  text-brand-dark font-bold text-2xl">Ketersediaan</label>
                <a href="{{ route('produk-kami') }}" class="text-sm text-brand-caramel font-bold">Reset Filter</a>
                <select name="status" onchange="this.form.submit()"
                    class="w-full py-2 px-3 rounded-md bg-brand-dark text-brand-light">
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


            {{-- Filter Kategori --}}
            <div>
                <h2 class="font-semibold text-brand-brown mb-2">Kategori</h2>
                <ul class="space-y-2">
                    @foreach($categories as $category)
                        <li>
                            <form method="GET" action="{{ route('produk-kami') }}">
                                <label class="flex items-center gap-2 cursor-pointer">
                                    <input type="checkbox" name="category_id[]" class="h-5 w-5 rounded-md border border-brand-brown checked:bg-brand-brown  checked:border-transparent focus:ring-2 focus:ring-offset-1 focus:ring-brand-brown transition duration-200"
                                        value="{{ $category->id }}"
                                        onchange="this.form.submit()"
                                        {{ in_array($category->id, (array) request('category_id')) ? 'checked' : '' }}>
                                    <span>{{ $category->nama_kategori }}</span>
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
    </div>

    {{-- Main Content --}}
    <section class="md:w-3/4 space-y-6 px-4">

        <div class="flex justify-between items-center">
            <h1 class="text-xl font-bold text-brand-brown">
                @if(request('category_id') && $categories)
                    {{ $categories->whereIn('id', (array) request('category_id'))->pluck('nama_kategori')->implode(', ') }}
                @else
                    Semua Katalog
                @endif
            </h1>

            @if(isset($stats))
            <div class="text-sm text-brand-brown space-x-4">
                <span>Total: <strong>{{ $stats['total'] }}</strong></span>
                <span class="text-green-600">Tersedia: <strong>{{ $stats['tersedia'] }}</strong></span>
                <span class="text-red-600">Habis: <strong>{{ $stats['habis'] }}</strong></span>
            </div>
            @endif
        </div>

        {{-- Produk Grid --}}
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6 max-w-3xl">
            @forelse($catalogues as $catalogue)
                <div class="rounded-lg shadow-md overflow-hidden relative bg-brand-lightdark">
                    <div class="absolute top-2 right-2 text-xs px-2 py-1 rounded-full {{ $catalogue->status == 'tersedia' ? 'bg-green-500 text-white' : 'bg-red-500 text-white' }}">
                        {{ ucfirst($catalogue->status) }}
                    </div>

                    <div class="aspect-w-1 aspect-h-1">
                        @php
                            $firstImage = explode(';', $catalogue->gambar_produk)[0] ?? null;
                        @endphp
                        <img src="{{ $firstImage ? asset('storage/' . $firstImage) : asset('images/default-product.jpg') }}"
                            alt="{{ $catalogue->nama_produk }}" class="w-full h-full  object-cover aspect-square">
                    </div>

                    @if (Auth::check())

                     <div class="p-4 space-y-5 flex flex-col justify-center items-center">
                        <h2 class="font-semibold text-brand-brown">{{ $catalogue->nama_produk }}</h2>
                        <p class="text-sm italic text-gray-600">
                            "{{ Str::limit($catalogue->deskripsi, 60, '...') }}"
                        </p>
                        <p class="text-brand-brown font-bold">Rp {{ number_format($catalogue->harga, 0, ',', '.') }}</p>
                        <a href="{{ route('produk.detail', $catalogue->id) }}"
                            class="inline-block   py-2 border-2 rounded-full text-brand-dark px-16 border-brand-dark font-bold text-sm"
                            >Lihat
                        </a>
                        <div class="flex gap-2 items-center">
                            <a href="{{ route('produk.detail', $catalogue->id) }}"
                                class="inline-block  px-10 py-2 rounded-full  bg-brand-dark text-brand-light  text-sm">
                                Order
                            </a>
                            <a href="{{ route('produk.detail', $catalogue->id) }}"
                                class="inline-block  px-3 py-2 rounded-full  bg-brand-dark text-brand-light  text-sm">
                                <i class="fa-solid fa-cart-shopping"></i>
                            </a>
                        </div>
                     </div>

                    @else

                    <div class="p-4 space-y-5 flex flex-col justify-center items-center">
                        <h2 class="font-semibold text-brand-brown">{{ $catalogue->nama_produk }}</h2>
                        <p class="text-sm italic text-gray-600">
                            "{{ Str::limit($catalogue->deskripsi, 60, '...') }}"
                        </p>
                        <p class="text-brand-brown font-bold">Rp {{ number_format($catalogue->harga, 0, ',', '.') }}</p>
                        <a href="{{ route('produk.detail', $catalogue->id) }}"
                            class="inline-block   py-2 border-2 rounded-full text-brand-dark px-16 border-brand-dark font-bold text-sm"
                            >Lihat
                        </a>
                        <a href="{{ route('produk.detail', $catalogue->id) }}"
                            class="inline-block  px-16 py-2 rounded-full  bg-brand-dark text-brand-light  text-sm">
                            Order
                        </a>
                    </div>

                    @endif
                </div>
            @empty
                <p class="col-span-full text-center text-gray-500 py-10">Tidak ada produk yang ditemukan.</p>
            @endforelse
        </div>

        {{-- Pagination --}}
        @if($catalogues->hasPages())
            <div class="flex justify-between items-center mt-6">
                {{-- Previous --}}
                @if($catalogues->onFirstPage())
                    <span class="text-gray-400">← Sebelumnya</span>
                @else
                    <a href="{{ $catalogues->appends(request()->query())->previousPageUrl() }}"
                        class="text-brand-brown hover:underline">← Sebelumnya</a>
                @endif

                <span class="text-sm text-gray-600">Halaman {{ $catalogues->currentPage() }}</span>

                {{-- Next --}}
                @if($catalogues->hasMorePages())
                    <a href="{{ $catalogues->appends(request()->query())->nextPageUrl() }}"
                        class="text-brand-brown hover:underline">Selanjutnya →</a>
                @else
                    <span class="text-gray-400">Selanjutnya →</span>
                @endif
            </div>
        @endif
    </section>
</div>

@endsection
=======
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BROWNITA - Katalog</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    @vite(['resources/css/app.css'])
</head>

<body class="min-h-screen bg-[#e4d2a3] font-['Segoe_UI','Tahoma','Geneva','Verdana','sans-serif']">
    @extends('layout.customer.app')
    @section('content')
        <div class="max-w-[1200px] mx-auto flex flex-col lg:flex-row gap-5 p-5">

            <div class="main-container flex gap-5 pt-20 ">
                <!-- Wrapper sidebar -->
                <div class="w-full lg:w-[300px] flex flex-col pt-5 pr-5 self-start">
                    <!-- Search bar -->
                    <form method="GET" action="{{ route('produk-kami') }}" class="relative flex items-center w-full px-4 ">
                        <i class="fa fa-search absolute left-6 top-1/2 -translate-y-1/2 text-[#CCB88C] pointer-events-none"></i>
                        <input type="text" name="search" placeholder="Cari Menu..." value="{{ request('search') }}"
                            class="w-full h-10 pl-10 pr-4 rounded-t-[15px] bg-[#6C4E31] text-[#CCB88C] font-bold placeholder:text-[#CCB88C] placeholder:font-bold focus:bg-white focus:text-[#6C4E31] focus:outline-none">
                        @foreach((array) request('category_id') as $id)
                            <input type="hidden" name="category_id[]" value="{{ $id }}">
                        @endforeach
                    </form>
                <!-- Sidebar dan Search -->
                <aside class="w-full lg:w-[280px] bg-[#CCB88C] rounded-[15px] shadow oDverflow-hidden self-start" >
                    

                    <div class="px-4 mt-3">
                        <div class="text-left mb-2">
                            <a href="{{ route('produk-kami') }}"
                                class="inline-block px- py-1 text-[#A25E00] font-bold text-lg hover:bg-[#6C4E31] hover:text-white transition">Reset
                                Filter</a>
                        </div>

                        <form method="GET" action="{{ route('produk-kami') }}" id="statusForm" class="mb-4">
                            <label for="status" class="block text-[#5a4a3a] font-bold mb-1">Ketersediaan</label>
                            <select name="status" id="statusFilter" onchange="this.form.submit()"
                                class="w-full p-2 border-2 border-[#e0e0e0] rounded-md focus:border-[#8b745b]">
                                <option value="">Semua Status</option>
                                <option value="tersedia" {{ request('status') == 'tersedia' ? 'selected' : '' }}>Tersedia
                                </option>
                                <option value="habis" {{ request('status') == 'habis' ? 'selected' : '' }}>Habis</option>
                            </select>
                            @if(request('search'))
                                <input type="hidden" name="search" value="{{ request('search') }}">
                            @endif
                            @foreach((array) request('category_id') as $id)
                                <input type="hidden" name="category_id[]" value="{{ $id }}">
                            @endforeach
                        </form>

                        <div class="border-b-2 border-[#8b745b] pb-2 mb-3 text-[#5a4a3a] font-bold text-lg">Kategori</div>
                        <ul class="space-y-2 pb-5">
                            @foreach($categories as $category)
                                <li>
                                    <form method="GET" action="{{ route('produk-kami') }}">
                                        <label class="flex items-center gap-2 cursor-pointer">
                                            <!-- Hidden Checkbox -->
                                            <input type="checkbox" name="category_id[]" value="{{ $category->id }}"
                                                class="peer hidden"
                                                {{ in_array($category->id, (array) request('category_id')) ? 'checked' : '' }}
                                                onchange="this.form.submit();">

                                            <!-- Custom Checkbox Box -->
                                            <div
                                                class="w-5 h-5 border-2 border-[#8b745b] rounded flex items-center justify-center 
                                                    peer-checked:bg-[#8b745b] peer-checked:text-white text-transparent transition">
                                                <i class="fas fa-check text-xs"></i>
                                            </div>

                                            <!-- Label Text -->
                                            <span class="text-sm text-[#5a4a3a]">{{ $category->nama_kategori }}</span>

                                            <!-- Hidden inputs lainnya -->
                                            @if(request('search'))
                                                <input type="hidden" name="search" value="{{ request('search') }}">
                                            @endif
                                            @if(request('status'))
                                                <input type="hidden" name="status" value="{{ request('status') }}">
                                            @endif
                                            @foreach((array) request('category_id') as $keepId)
                                                @if($keepId != $category->id)
                                                    <input type="hidden" name="category_id[]" value="{{ $keepId }}">
                                                @endif
                                            @endforeach
                                        </label>
                                    </form>
                                </li>
                            @endforeach
                        </ul>

                    </aside>
                </div>
            </div>

            <!-- Konten Produk -->
            <main class="flex-1">
                <div class="text-center mb-6 justify-end">
                    <h1 class="text-3xl font-bold text-[#8b745b]">
                        @if(request('category_id') && isset($categories))
                            {{ $categories->whereIn('id', (array) request('category_id'))->pluck('nama_kategori')->implode(', ') ?? 'Katalog' }}
                        @else
                            Semua Katalog
                        @endif
                    </h1>

                    @if(isset($stats))
                        <div class="inline-block bg-[#CCB88C] px-6 py-3 rounded-xl shadow mt-4">
                            <div class="text-sm text-[#5a4a3a] inline-block mr-4">Total Produk:
                                <strong>{{ $stats['total'] }}</strong></div>
                            <div class="text-sm text-[#5a4a3a] inline-block mr-4">Tersedia: <strong
                                    class="text-green-600">{{ $stats['tersedia'] }}</strong></div>
                            <div class="text-sm text-[#5a4a3a] inline-block">Habis: <strong
                                    class="text-red-600">{{ $stats['habis'] }}</strong></div>
                        </div>
                    @endif
                </div>

                <div id="product-grid" class="grid gap-10 grid-cols-1 sm:grid-cols-2 lg:grid-cols-3">
                    @forelse($catalogues as $catalogue)
                        <div class="flex flex-col items-center">
                        <div class="w-[200px] h-[30px] bg-[#6C4E31] rounded-t-[15px]"></div>
                        <div class="relative bg-[#CCB88C] border-2 border-[#6C4E31] rounded-[15px] p-4 w-[270px] pt-10 min-h-[480px] flex flex-col justify-between">
                            <span class="absolute top-2 right-2 text-xs font-bold uppercase px-2 py-1 rounded-full {{ $catalogue->status == 'tersedia' ? 'bg-green-600 text-white' : 'bg-red-600 text-white' }}">
                                {{ $catalogue->status == 'tersedia' ? 'Tersedia' : 'Habis' }}
                            </span>
                            
                            <div>
                                <div class="h-[196px] w-full overflow-hidden rounded">
                                    @php $firstImage = explode(';', $catalogue->gambar_produk)[0]; @endphp
                                    <img src="{{ asset('storage/' . $firstImage) }}" alt="{{ $catalogue->nama_produk }}"
                                        class="w-full h-full object-cover">
                                </div>
                                <h2 class="text-center mt-2 text-base font-bold text-[#5a4a3a]">{{ $catalogue->nama_produk }}</h2>
                                <p class="text-sm text-center text-[#6C4E31] mt-1 mb-1 leading-snug line-clamp-3">
                                    "{{ $catalogue->deskripsi }}"
                                </p>

                            </div>

                            <div>
                                <a href="{{ route('produk.detail', $catalogue->id) }}"
                                    class="block text-center font-bold border-2 border-[#6C4E31] text-[#6C4E31] rounded-full py-2 transition hover:bg-[#6C4E31] hover:text-white">Lihat</a>
                                
                                <div class="pt-3 flex justify-between items-center gap-3 mt-2">
                                    <a href="{{ route('produk.detail', $catalogue->id) }}"
                                        class="flex-1 text-center py-2 bg-[#6C4E31] text-[#CCB88C] font-bold border-2 border-[#6C4E31] rounded-full transition hover:bg-[#CCB88C] hover:text-[#6C4E31]">
                                        Order
                                    </a>
                                    <a href="{{ route('produk.detail', $catalogue->id) }}"
                                        class="w-10 h-10 flex items-center justify-center bg-[#6C4E31] text-[#CCB88C] border-2 border-[#6C4E31] rounded-full transition hover:bg-[#CCB88C] hover:text-[#6C4E31]">
                                        <i class="fas fa-shopping-cart"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>

                    @empty
                        <div class="text-center col-span-full text-[#8b745b] text-lg py-10">
                            Tidak ada produk yang ditemukan.
                        </div>
                    @endforelse
                </div>

                <!-- Pagination -->
                @if($catalogues->hasPages())
                    <div class="flex justify-center items-center gap-4 mt-10">
                        @if($catalogues->onFirstPage())
                            <span class="text-[#8A6F4E] opacity-50 cursor-not-allowed font-bold">← Sebelumnya</span>
                        @else
                            <a href="{{ $catalogues->appends(request()->query())->previousPageUrl() }}"
                                class="text-[#8A6F4E] hover:text-[#6C4E31] font-bold">← Sebelumnya</a>
                        @endif

                        <div
                            class="bg-[#8A6F4E] border-4 border-[#8b745b] text-[#EBD9B1] py-2 px-4 rounded-full font-bold text-lg">
                            {{ $catalogues->currentPage() }}</div>

                        @if($catalogues->hasMorePages())
                            <a href="{{ $catalogues->appends(request()->query())->nextPageUrl() }}"
                                class="text-[#8A6F4E] hover:text-[#6C4E31] font-bold">Selanjutnya →</a>
                        @else
                            <span class="text-[#8A6F4E] opacity-50 cursor-not-allowed font-bold">Selanjutnya →</span>
                        @endif
                    </div>
                @endif
            </main>
        </div>
    @endsection

    <script>
        // Auto submit form when status filter changes
        let lastSearchValue = '';
        const searchInput = document.querySelector('.search-box');
        const form = document.querySelector('.search-form');
        const productGrid = document.querySelector('#product-grid');
        const contentTitle = document.querySelector('#content-title');
        const statsInfo = document.querySelector('#stats-info');

        let searchTimeout;

        document.getElementById('statusFilter')?.addEventListener('change', function () {
            document.getElementById('statusForm')?.submit();
        });

        searchInput.addEventListener('input', function () {
            clearTimeout(searchTimeout);

            searchTimeout = setTimeout(() => {
                const currentValue = this.value.trim();

                if (currentValue === lastSearchValue) {
                    return;
                }

                lastSearchValue = currentValue;

                const formData = new FormData(form);
                const queryString = new URLSearchParams(formData).toString();

                fetch(`{{ route('produk-kami') }}?${queryString}`, {
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest'
                    }
                })
                    .then(response => response.text())
                    .then(html => {
                        const parser = new DOMParser();
                        const doc = parser.parseFromString(html, 'text/html');

                        const newGrid = doc.querySelector('#product-grid');
                        const newTitle = doc.querySelector('#content-title');
                        const newStats = doc.querySelector('#stats-info');

                        if (newGrid) productGrid.innerHTML = newGrid.innerHTML;
                        if (newTitle) contentTitle.innerHTML = newTitle.innerHTML;
                        if (newStats) statsInfo.innerHTML = newStats.innerHTML;
                    });
            }, 800); // debounce 800ms
        });
    </script>

</body>

</html>
>>>>>>> maulana-branch
