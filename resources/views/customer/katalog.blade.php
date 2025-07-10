@extends('layout.customer.app')
@section('title', 'BROWNITA - Katalog')
@section('content')


<div class="flex px-32 flex-col md:flex-row gap-8">
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
                        $firstImagePath = $catalogue->images->first()->gambar_produk ?? null;
                        @endphp
                        <img src="{{ $firstImagePath ? asset('storage/' . $firstImagePath) : asset('images/default-product.jpg') }}"
                            alt="{{ $catalogue->nama_produk }}" class="w-full h-full object-cover aspect-square">
                    </div>

                    @if (Auth::check())

                    <div class="p-4 space-y-5 flex flex-col justify-center items-center">
                        <h2 class="font-semibold text-brand-brown">{{ $catalogue->nama_produk }}</h2>
                        <p class="text-sm italic text-gray-600">
                            "{{ Str::limit($catalogue->deskripsi, 60, '...') }}"
                        </p>
                        <p class="text-brand-brown font-bold">{{ $catalogue->harga_rupiah ?? 'Harga Produk Tidak Diketahui' }}</p>
                        <a href="{{ route('produk.detail', $catalogue->id) }}"
                            class="inline-block   py-2 border-2 rounded-full text-brand-dark px-16 border-brand-dark font-bold text-sm">Lihat
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
                            class="inline-block   py-2 border-2 rounded-full text-brand-dark px-16 border-brand-dark font-bold text-sm">Lihat
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
@include('components.customer.whatsapp.whatsapp')
@endsection
