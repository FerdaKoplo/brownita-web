@extends('layout.customer.app')
@section('title', 'BROWNITA - Detail Produk')
@section('content')
    <div class="px-4 md:px-12 lg:px-32">
    <div class="flex flex-col gap-12">
        <div class="flex flex-col gap-7 items-start">
            <button class="bg-amber-700 py-2 px-6 rounded-full hover:bg-black transition text-white font-semibold">
                <a href="{{ route('produk-kami') }}" class="text-lg flex gap-2 items-center">
                    <i class="fa-solid fa-chevron-left"></i>
                    Kembali
                </a>
            </button>
            <h1 class="font-bold text-3xl text-gray-800">Detail Produk</h1>
        </div>
        <div class="border-2 border-black p-6 md:p-12 rounded-xl flex flex-col md:flex-row items-center md:items-start justify-center gap-8 md:gap-20">
            @php
                $firstImage = $produk->images->first();
            @endphp
            <div>
                <div class="flex flex-col items-center gap-4">
                    <div class="flex items-end gap-5">
                        <img id="mainPreview"
                            src="{{ $firstImage ? asset('storage/' . $firstImage->gambar_produk) : asset('images/default-product.jpg') }}"
                            alt="Preview Utama"
                            class="w-full max-w-xs sm:max-w-sm md:w-96 md:h-96 object-cover rounded-lg border" />
                        <div class="flex flex-col gap-5">
                            <button class="text-2xl sm:text-3xl rounded-xl hover:bg-black transition bg-amber-700 text-white px-3 py-1 sm:px-4 sm:py-2"
                                id="button-left">
                                <i class="fa-solid fa-angle-left"></i>
                            </button>
                            <button class="text-2xl sm:text-3xl rounded-xl hover:bg-black transition bg-amber-700 text-white px-3 py-1 sm:px-4 sm:py-2"
                                id="button-right">
                                <i class="fa-solid fa-angle-right"></i>
                            </button>
                        </div>
                    </div>

                    <div class="flex gap-2 overflow-x-auto max-w-full">
                        @foreach($produk->images as $img)
                            <img src="{{ asset('storage/' . $img->gambar_produk) }}" alt="Thumbnail"
                                class="w-16 h-16 sm:w-20 sm:h-20 object-cover rounded-lg border cursor-pointer thumbnail grayscale"
                                data-img="{{ asset('storage/' . $img->gambar_produk) }}" />
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="flex flex-col gap-7 w-full md:w-auto">
                <h1 class="text-2xl text-gray-800">
                    {{ $produk->category->nama_kategori ?? 'Kategori Tidak Diketahui' }}
                </h1>
                <h1 class="text-gray-800 font-bold text-3xl md:text-6xl">
                    {{ $produk->nama_produk ?? 'Produk Tidak Diketahui' }}
                </h1>
                <p class="font-bold text-gray-800 text-xl">
                    {{ $produk->harga_rupiah ?? 'Harga Produk Tidak Diketahui' }}
                </p>
                <div class="w-full border border-gray-800"></div>

                <div class="flex flex-col gap-2">
                    <h1 class="text-gray-800 font-bold text-2xl md:text-3xl">
                        Deskripsi
                    </h1>

                    <p id="deskripsi-{{ $produk->id }}" class="text-base sm:text-lg md:text-xl italic text-black">
                        {{ Str::limit($produk->deskripsi, 60, '...') }}
                    </p>
                    <button onclick="toggleDeskripsi({{ $produk->id }})"
                        class="italic flex items-end justify-end text-base sm:text-lg md:text-xl text-black font-bold mt-1">
                        Lihat Lebih
                    </button>
                    <p id="deskripsi-lengkap-{{ $produk->id }}" class="hidden text-base sm:text-lg md:text-xl italic text-black max-w-lg">
                        {{ $produk->deskripsi }}
                    </p>
                </div>

                @if (Auth::check())
                    <div class="flex flex-col gap-5">
                        @php
                            $waNumber = '6281217018289';
                            $waMessage = 'Halo kak, saya tertarik dengan produk ' . $produk->nama_produk;
                            $waUrl = 'https://wa.me/' . $waNumber . '?text=' . urlencode($waMessage);
                        @endphp

                        <a href="{{ $waUrl }}" target="_blank"
                            class="bg-amber-700 w-full py-2 text-center text-white rounded-full">
                            Order
                        </a>

                        <form action="{{ route('keranjang.store') }}" method="POST" enctype="multipart/form-data" class="w-full">
                            @csrf
                            <input type="hidden" name="katalog_id" value="{{ $produk->id }}">
                            <button type="submit"
                                class="border-2 hover:text-white hover:bg-gray-800 border-gray-800 w-full py-2 text-gray-800 transition rounded-full">
                                Masukkan Ke Keranjang
                            </button>
                        </form>
                    </div>
                @else
                    @php
                        $waNumber = '6281217018289';
                        $waMessage = 'Halo kak, saya tertarik dengan produk ' . $produk->nama_produk;
                        $waUrl = 'https://wa.me/' . $waNumber . '?text=' . urlencode($waMessage);
                    @endphp

                    <a href="{{ $waUrl }}" target="_blank"
                        class="bg-amber-700 w-full py-2 text-center text-white rounded-full">
                        Order
                    </a>
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
@endsection
