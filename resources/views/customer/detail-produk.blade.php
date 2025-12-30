@extends('layout.customer.app')
@section('title', 'BROWNITA - ' . ($produk->nama_produk ?? 'Detail Produk'))

@section('content')

<div class="min-h-screen bg-gray-50 py-8 sm:py-12">
    <div class="container mx-auto px-4 md:px-6 lg:px-8 max-w-7xl">

        <nav class="flex text-sm text-gray-500 mb-8" aria-label="Breadcrumb">
            <ol class="inline-flex items-center space-x-1 md:space-x-3">
                <li class="inline-flex items-center">
                    <a href="{{ route('produk-kami') }}" class="hover:text-amber-700 transition">
                        <i class="fa-solid fa-store mr-2"></i> Katalog
                    </a>
                </li>
                <li><i class="fa-solid fa-chevron-right text-xs"></i></li>
                <li class="inline-flex items-center">
                    <span class="text-gray-400">{{ $produk->category->nama_kategori ?? 'Menu' }}</span>
                </li>
                <li><i class="fa-solid fa-chevron-right text-xs"></i></li>
                <li aria-current="page">
                    <span class="font-medium text-amber-700">{{ Str::limit($produk->nama_produk, 20) }}</span>
                </li>
            </ol>
        </nav>

        <div class="bg-white rounded-3xl shadow-sm border border-gray-100 overflow-hidden">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-0 lg:gap-12">

                <div class="p-6 lg:p-10 bg-gray-50/50">
                    @php $firstImage = $produk->images->first(); @endphp
                    
                    {{-- Main Image Area --}}
                    <div class="relative group aspect-square rounded-2xl overflow-hidden bg-white shadow-sm border border-gray-200 mb-4">
                        {{-- Status Badge --}}
                        @if(isset($produk->status))
                            <span class="absolute top-4 left-4 z-10 px-3 py-1 rounded-full text-xs font-bold uppercase tracking-wide
                                {{ $produk->status == 'tersedia' ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-700' }}">
                                {{ $produk->status }}
                            </span>
                        @endif

                        <img id="mainPreview"
                             src="{{ $firstImage ? asset('storage/' . $firstImage->gambar_produk) : asset('images/default-product.jpg') }}"
                             alt="{{ $produk->nama_produk }}"
                             class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105" />
                        
                        {{-- Navigation Arrows (Overlay) --}}
                        <button id="button-left" class="absolute left-4 top-1/2 -translate-y-1/2 w-10 h-10 bg-white/80 hover:bg-white backdrop-blur text-gray-800 rounded-full shadow-md flex items-center justify-center transition opacity-0 group-hover:opacity-100">
                            <i class="fa-solid fa-chevron-left"></i>
                        </button>
                        <button id="button-right" class="absolute right-4 top-1/2 -translate-y-1/2 w-10 h-10 bg-white/80 hover:bg-white backdrop-blur text-gray-800 rounded-full shadow-md flex items-center justify-center transition opacity-0 group-hover:opacity-100">
                            <i class="fa-solid fa-chevron-right"></i>
                        </button>
                    </div>

                    {{-- Thumbnails --}}
                    @if($produk->images->count() > 1)
                        <div class="flex gap-3 overflow-x-auto pb-2 custom-scrollbar">
                            @foreach($produk->images as $index => $img)
                                <button class="thumbnail flex-shrink-0 relative w-20 h-20 rounded-xl overflow-hidden border-2 transition-all {{ $index === 0 ? 'border-amber-500 ring-2 ring-amber-500/20' : 'border-transparent opacity-70 hover:opacity-100' }}"
                                        onclick="setMainImage(this, '{{ asset('storage/' . $img->gambar_produk) }}')">
                                    <img src="{{ asset('storage/' . $img->gambar_produk) }}" class="w-full h-full object-cover">
                                </button>
                            @endforeach
                        </div>
                    @endif
                </div>

                {{-- RIGHT COLUMN: PRODUCT DETAILS --}}
                <div class="p-6 lg:p-10 flex flex-col h-full">
                    
                    {{-- Category & Title --}}
                    <div class="mb-6 border-b border-gray-100 pb-6">
                        <span class="text-amber-600 font-bold text-sm uppercase tracking-wider mb-2 block">
                            {{ $produk->category->nama_kategori ?? 'Kategori' }}
                        </span>
                        <h1 class="text-3xl md:text-4xl font-extrabold text-gray-900 mb-3 leading-tight">
                            {{ $produk->nama_produk }}
                        </h1>
                        <div class="flex items-end gap-3">
                            <p class="text-3xl font-bold text-amber-700">
                                {{ $produk->harga_rupiah }}
                            </p>
                            {{-- Optional: Fake original price for effect --}}
                            {{-- <span class="text-gray-400 line-through text-sm mb-1">Rp 75.000</span> --}}
                        </div>
                    </div>

                    {{-- Description --}}
                    <div class="prose prose-sm text-gray-600 mb-8 flex-1">
                        <h3 class="text-gray-900 font-semibold text-lg mb-2">Tentang Produk</h3>
                        <div id="short-desc" class="leading-relaxed">
                            {{ Str::limit($produk->deskripsi, 150, '...') }}
                        </div>
                        <div id="full-desc" class="leading-relaxed hidden">
                            {{ $produk->deskripsi }}
                        </div>
                        
                        @if(strlen($produk->deskripsi) > 150)
                            <button onclick="toggleDescription()" id="toggle-btn" 
                                class="mt-2 text-amber-600 font-medium hover:text-amber-800 text-sm flex items-center gap-1 transition">
                                <span>Baca Selengkapnya</span> <i class="fa-solid fa-chevron-down text-xs"></i>
                            </button>
                        @endif
                    </div>


                    {{-- Action Buttons --}}
                    <div class="mt-auto pt-6 border-t border-gray-100">
                        @if (Auth::check())
                            <div class="flex flex-col sm:flex-row gap-3">
                                {{-- Add to Cart --}}
                                <form action="{{ route('keranjang.store') }}" method="POST" class="flex-1">
                                    @csrf
                                    <input type="hidden" name="katalog_id" value="{{ $produk->id }}">
                                    <button type="submit" 
                                        class="w-full py-3.5 px-6 rounded-xl bg-gray-900 hover:bg-black text-white font-bold shadow-lg transition transform active:scale-95 flex items-center justify-center gap-2">
                                        <i class="fa-solid fa-cart-plus"></i> Tambah Keranjang
                                    </button>
                                </form>

                                {{-- WhatsApp --}}
                                @php
                                    $waNumber = '6281217018289';
                                    $waMessage = 'Halo Brownita, saya mau pesan ' . $produk->nama_produk;
                                    $waUrl = 'https://wa.me/' . $waNumber . '?text=' . urlencode($waMessage);
                                @endphp
                                <a href="{{ $waUrl }}" target="_blank"
                                   class="sm:w-auto py-3.5 px-6 rounded-xl border-2 border-green-600 text-green-700 font-bold hover:bg-green-50 transition flex items-center justify-center gap-2">
                                    <i class="fa-brands fa-whatsapp text-xl"></i> Chat Admin
                                </a>
                            </div>
                        @else
                             {{-- Guest View --}}
                            @php
                                $waUrl = 'https://wa.me/6281217018289?text=' . urlencode('Halo Brownita, info produk ' . $produk->nama_produk);
                            @endphp
                            <div class="space-y-3">
                                <a href="{{ $waUrl }}" target="_blank"
                                   class="w-full block py-3.5 rounded-xl bg-amber-600 hover:bg-amber-700 text-white font-bold text-center shadow-lg transition">
                                    <i class="fa-brands fa-whatsapp mr-2"></i> Pesan via WhatsApp
                                </a>
                                <p class="text-center text-xs text-gray-500">
                                    Atau <a href="{{ route('login') }}" class="text-amber-600 underline">Login</a> untuk menggunakan keranjang belanja.
                                </p>
                            </div>
                        @endif
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>

<script>
    const mainImage = document.getElementById('mainPreview');
    const thumbnails = document.querySelectorAll('.thumbnail');
    let currentIndex = 0;
    const images = [
        @foreach($produk->images as $img)
            "{{ asset('storage/' . $img->gambar_produk) }}",
        @endforeach
    ];

    window.setMainImage = function(element, src) {
        mainImage.src = src;
        
        currentIndex = images.indexOf(src);

        thumbnails.forEach(thumb => {
            thumb.classList.remove('border-amber-500', 'ring-2', 'ring-amber-500/20', 'opacity-100');
            thumb.classList.add('border-transparent', 'opacity-70');
        });
        element.classList.remove('border-transparent', 'opacity-70');
        element.classList.add('border-amber-500', 'ring-2', 'ring-amber-500/20', 'opacity-100');
    }

    document.getElementById('button-right').addEventListener('click', () => {
        currentIndex = (currentIndex + 1) % images.length;
        updateGalleryState();
    });

    document.getElementById('button-left').addEventListener('click', () => {
        currentIndex = (currentIndex - 1 + images.length) % images.length;
        updateGalleryState();
    });

    function updateGalleryState() {
        mainImage.src = images[currentIndex];
        if(thumbnails[currentIndex]) {
            setMainImage(thumbnails[currentIndex], images[currentIndex]);
            thumbnails[currentIndex].scrollIntoView({ behavior: 'smooth', block: 'nearest', inline: 'center' });
        }
    }

    window.toggleDescription = function() {
        const shortDesc = document.getElementById('short-desc');
        const fullDesc = document.getElementById('full-desc');
        const btn = document.getElementById('toggle-btn');
        const icon = btn.querySelector('i');
        const text = btn.querySelector('span');

        if (fullDesc.classList.contains('hidden')) {
            shortDesc.classList.add('hidden');
            fullDesc.classList.remove('hidden');
            text.innerText = "Sembunyikan";
            icon.classList.remove('fa-chevron-down');
            icon.classList.add('fa-chevron-up');
        } else {
            shortDesc.classList.remove('hidden');
            fullDesc.classList.add('hidden');
            text.innerText = "Baca Selengkapnya";
            icon.classList.remove('fa-chevron-up');
            icon.classList.add('fa-chevron-down');
        }
    }
</script>

<style>
    .custom-scrollbar::-webkit-scrollbar {
        height: 6px;
    }
    .custom-scrollbar::-webkit-scrollbar-track {
        background: #f1f1f1;
        border-radius: 10px;
    }
    .custom-scrollbar::-webkit-scrollbar-thumb {
        background: #d1d5db; 
        border-radius: 10px;
    }
    .custom-scrollbar::-webkit-scrollbar-thumb:hover {
        background: #9ca3af; 
    }
</style>
@endsection