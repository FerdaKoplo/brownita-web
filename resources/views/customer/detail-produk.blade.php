<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BROWNITA - Detail Produk</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="min-h-screen bg-[#E4D2A3] font-['Segoe_UI','Tahoma','Geneva','Verdana','sans-serif']">
    @extends('layout.customer.app')

    @section('content')

        <div class="max-w-[1233px] mx-auto px-6 pt-6 pb-10">
            <div class="flex items-center justify-between relative">
                <!-- Tombol Kembali di Kiri -->
                <a href="{{ route('produk-kami') }}"
                    class="bg-[#6C4E31] text-[#E4D2A3] px-4 py-2 rounded-full text-sm font-bold flex items-center gap-2 border border-transparent hover:bg-transparent hover:text-[#6C4E31] hover:border-[#6C4E31] transition w-fit">
                    <i class="fas fa-arrow-left"></i> Kembali
                </a>

                <!-- Judul Tengah -->
                <h1 class="absolute left-1/2 -translate-x-1/2 text-4xl font-bold text-[#6C4E31] text-center">
                    Detail Produk
                </h1>

                <!-- Spacer kanan untuk menjaga keseimbangan -->
                <div class="w-[96px]"></div>
            </div>
        </div>


        <!-- 🟤 KONTEN PRODUK -->
        <div class="max-w-[1233px] mx-auto px-5 pb-10">
            <div
                class="flex flex-col lg:flex-row justify-center items-center gap-16 border-4 border-[#6C4E31] p-10 rounded-lg">

                <!-- KIRI: Gambar Produk -->
                <div class="flex flex-col items-center gap-4 w-full max-w-sm">
                    <div class="w-full aspect-square relative">
                        <img id="mainImage" src="{{ asset('storage/' . $gambarArray[0]) }}" alt="{{ $produk->nama_produk }}"
                            class="w-full h-full object-cover rounded-xl">
                    </div>
                    <div class="flex flex-wrap justify-center gap-2">
                        @foreach($gambarArray as $index => $img)
                            <img class="thumbnail w-16 h-16 object-cover rounded-md border-2 {{ $index === 0 ? 'border-[#6C4E31] opacity-100' : 'border-gray-300 opacity-70' }} hover:opacity-100 hover:border-[#6C4E31] cursor-pointer"
                                src="{{ asset('storage/' . $img) }}" onclick="setMainImage(this)">
                        @endforeach
                    </div>
                </div>

                <!-- TENGAH: Tombol Navigasi -->
                <div class="hidden lg:flex flex-col gap-4 items-center">
                    <button
                        class="w-10 h-10 bg-[#6C4E31] text-white rounded-lg flex justify-center items-center hover:bg-[#4E3B24]">
                        <i class="fas fa-chevron-left"></i>
                    </button>
                    <button
                        class="w-10 h-10 bg-[#6C4E31] text-white rounded-lg flex justify-center items-center hover:bg-[#4E3B24]">
                        <i class="fas fa-chevron-right"></i>
                    </button>
                </div>

                <!-- KANAN: Info Produk -->
                <div class="flex-1 max-w-lg flex flex-col gap-6">
                    <div>
                        <h3 class="text-lg text-[#6C4E31]">{{ $produk->category->nama_kategori ?? '-' }}</h3>
                        <h2 class="text-3xl font-bold text-[#6C4E31]">{{ $produk->nama_produk }}</h2>
                    </div>
                    <div class="flex justify-between">
                        <p class="text-xl font-bold text-[#6C4E31]">Rp {{ number_format($produk->harga, 0, ',', '.') }}</p>
                        <p class="text-gray-600">{{ $produk->stok ?? 0 }} Terjual</p>
                    </div>
                    <hr class="border-t-2 border-[#6C4E31]">
                    <div>
                        <h3 class="text-2xl font-bold text-[#6C4E31]">Deskripsi</h3>
                        <p class="italic text-[#6C4E31] text-base mt-2">{{ $produk->deskripsi ?? '-' }}</p>
                    </div>
                    <a href="#"
                        class="inline-block text-center bg-[#6C4E31] text-[#E4D2A3] font-bold text-base py-3 px-8 rounded-full hover:bg-transparent hover:text-[#6C4E31] border-2 border-[#6C4E31] transition">
                        Order
                    </a>
                    <a href="#"
                        class="inline-block text-center bg-transparent text-[#6C4E31] font-bold text-base py-3 px-8 rounded-full hover:bg-[#6C4E31] hover:text-[#E4D2A3] border-2 border-[#6C4E31]  transition">
                        Masukkan Ke Keranjang
                    </a>
                </div>
            </div>
        </div>

    @endsection

    <script>
        function setMainImage(el) {
            const mainImage = document.getElementById('mainImage');
            mainImage.src = el.src;

            document.querySelectorAll('.thumbnail').forEach(thumb => {
                thumb.classList.remove('border-[#6C4E31]', 'opacity-100');
                thumb.classList.add('border-gray-300', 'opacity-70');
            });

            el.classList.remove('border-gray-300', 'opacity-70');
            el.classList.add('border-[#6C4E31]', 'opacity-100');
        }
    </script>
</body>

</html>