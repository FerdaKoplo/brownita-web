@extends('layout.customer.app')
@section('title', 'BROWNITA - Detail Produk')
@section('content')
    <div class="px-32">
        <div class="flex flex-col gap-12">
            <div class="flex flex-col gap-7 items-start">
                <button class="bg-brand-dark py-2 px-6 rounded-full text-brand-light font-semibold">
                    <a href="{{ route('produk-kami') }}" class="text-lg flex gap-2 items-center">
                        <i class="fa-solid fa-chevron-left"></i>
                        Kembali
                    </a>
                </button>
                <h1 class="font-bold text-3xl text-brand-dark">Detail Produk</h1>
            </div>
            <div class="border-2 border-brand-dark p-12 rounded-xl flex items-center justify-center gap-20">
                @php
                    $firstImage = $produk->images->first();
                @endphp
                <div class="">
                    <div class="flex flex-col items-center gap-4">

                        <div class="flex items-end gap-5">
                            <img id="mainPreview"
                                src="{{ $firstImage ? asset('storage/' . $firstImage->gambar_produk) : asset('images/default-product.jpg') }}"
                                alt="Preview Utama" class="w-96 h-96 object-cover rounded-lg border " />
                            <div class="flex flex-col gap-5 ">
                                <button class="text-3xl rounded-xl bg-brand-dark text-brand-light px-4 py-2 "
                                    id="button-left">
                                    <i class="fa-solid fa-angle-left"></i>
                                </button>
                                <button class="text-3xl rounded-xl bg-brand-dark text-brand-light px-4 py-2 "
                                    id="button-right">
                                    <i class="fa-solid fa-angle-right"></i>
                                </button>
                            </div>
                        </div>

                        <div class="flex gap-2 overflow-x-auto max-w-full">
                            @foreach($produk->images as $img)
                                <img src="{{ asset('storage/' . $img->gambar_produk) }}" alt="Thumbnail"
                                    class="w-24 h-24 object-cover rounded-lg border cursor-pointer thumbnail grayscale"
                                    data-img="{{ asset('storage/' . $img->gambar_produk) }}" />
                            @endforeach
                        </div>
                    </div>
                </div>
                <div class="flex flex-col gap-7">
                    <h1 class="text-2xl text-brand-dark">
                        {{ $produk->category->nama_kategori ?? 'Kategori Tidak Diketahui' }}
                    </h1>
                    <h1 class="text-brand-dark font-bold text-6xl">
                        {{ $produk->nama_produk ?? 'Produk Tidak Diketahui' }}
                    </h1>
                    <p class="font-bold text-brand-dark text-xl">
                        {{ $produk->harga_rupiah ?? 'Harga Produk Tidak Diketahui' }}
                    </p>
                    <div class="w-full border border-brand-dark"></div>

                    <div class="flex flex-col gap-2">

                        <h1 class="text-brand-dark font-bold text-3xl">
                            Deskripsi
                        </h1>

                        <p id="deskripsi-{{ $produk->id }}" class="text-xl italic text-brand-dark">
                            {{ Str::limit($produk->deskripsi, 60, '...') }}
                        </p>
                        <button onclick="toggleDeskripsi({{ $produk->id }})" class=" italic flex items-end justify-end text-xl text-brand-dark font-bold mt-1">
                            Lihat Lebih
                        </button>
                        <p id="deskripsi-lengkap-{{ $produk->id }}" class="hidden text-xl italic text-brand-dark max-w-lg">
                            {{ $produk->deskripsi }}
                        </p>
                    </div>

                    @if (Auth::check())
                        <div>

                        </div>
                    @else
                        <button class="bg-brand-dark w-full py-2 text-brand-light rounded-full">
                            <a href="http://">
                                Order
                            </a>
                        </button>
                    @endif
                </div>

            </div>
        </div>
    </div>
    {{-- Image selector function --}}
    <script>
        const thumbnails = document.querySelectorAll('.thumbnail');
        const mainPreview = document.getElementById('mainPreview');
        const buttonRight = document.getElementById('button-right');
        const buttonLeft = document.getElementById('button-left');

        const imageSources = Array.from(thumbnails).map(thumb => thumb.getAttribute('data-img'));
        let currentIndex = 0;

        function updateMainImage(index) {
            mainPreview.src = imageSources[index];

            thumbnails.forEach((thumb, i) => {
                if (i === index) {
                    thumb.classList.add('ring-4', 'grayscale-0');
                } else {
                    thumb.classList.remove('ring-4', 'grayscale-0');
                }
            });
        }

        thumbnails.forEach((thumb, index) => {
            thumb.addEventListener('click', () => {
                currentIndex = index;
                updateMainImage(currentIndex);
            });
        });

        buttonRight.addEventListener('click', () => {
            if (currentIndex < imageSources.length - 1) {
                currentIndex++;
            } else {
                currentIndex = 0;
            }
            updateMainImage(currentIndex);
        });

        buttonLeft.addEventListener('click', () => {
            if (currentIndex > 0) {
                currentIndex--;
            } else {
                currentIndex = imageSources.length - 1;
            }
            updateMainImage(currentIndex);
        });

        updateMainImage(currentIndex);
    </script>


    {{-- Expand description --}}
    <script>
        function toggleDeskripsi(id) {
            const pendek = document.getElementById('deskripsi-' + id);
            const lengkap = document.getElementById('deskripsi-lengkap-' + id);
            const button = event.target;

            if (lengkap.classList.contains('hidden')) {
                pendek.classList.add('hidden');
                lengkap.classList.remove('hidden');
                button.textContent = 'Lihat Lebih Sedikit';
            } else {
                pendek.classList.remove('hidden');
                lengkap.classList.add('hidden');
                button.textContent = 'Lihat Lebih';
            }
        }
    </script>

    @include('components.customer.whatsapp')
@endsection
