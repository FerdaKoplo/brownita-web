<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BROWNITA - Katalog</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/style-detail-produk.css') }}">
</head>

<body>

    @extends('layout.customer.app')

    @section('content')
        <div class="product-detail-container">
            <div class="product-header">
                <a href="{{ url()->previous() }}" class="back-button">
                    <i class="fas fa-arrow-left"></i> Kembali
                </a>
                <h1>Detail Produk</h1>
            </div>

            <div class="product-detail-card">
                <!-- Kiri: Gambar dan Thumbnail -->
                <div class="photo-product">
                    <div class="product-left">
                        <div class="product-detail-image">
                            <img id="mainImage" src="{{ asset('storage/' . $gambarArray[0]) }}"
                                alt="{{ $produk->nama_produk }}">
                        </div>

                        <!-- THUMBNAILS -->
                        <div class="thumbnail-list">
                            @foreach($gambarArray as $index => $img)
                                <img class="thumbnail {{ $index === 0 ? 'active' : '' }}" src="{{ asset('storage/' . $img) }}"
                                    onclick="setMainImage(this)">
                            @endforeach
                        </div>
                    </div>

                    <!-- Tengah: Panah Navigasi -->
                    <div class="image-nav-buttons">
                        <button class="nav-btn prev" onclick="changeImage(-1)">
                            <i class="fas fa-chevron-left"></i>
                        </button>
                        <button class="nav-btn next" onclick="changeImage(1)">
                            <i class="fas fa-chevron-right"></i>
                        </button>
                    </div>

                </div>

                <!-- Kanan: Informasi Produk -->
                <div class="product-info">
                    <h3 class="product-category">{{ $produk->category->nama_kategori ?? '-' }}</h3>
                    <h2>{{ $produk->nama_produk }}</h2>
                    <div class="price-sold">
                        <p class="product-price-detail">Rp. {{ number_format($produk->harga, 0, ',', '.') }}</p>
                    </div>
                    <hr class="divider">
                    <h3 class="desc-label">Deskripsi</h3>
                    <p class="product-detail-description">{{ $produk->deskripsi ?? '-' }}</p>

                    <a href="#" class="order-button">Order</a>
                </div>
            </div>
        </div>
    @endsection

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const mainImage = document.getElementById('mainImage');
            const thumbnails = document.querySelectorAll('.thumbnail');
            let currentImageIndex = 0;

            // Buat array semua gambar (utamanya + foto_lain)
            const imageArray = Array.from(thumbnails).map(t => t.getAttribute('src'));

            // Fungsi set gambar utama
            function setMainImage(index) {
                mainImage.src = imageArray[index];
                thumbnails.forEach((thumb, i) => {
                    thumb.classList.toggle('active', i === index);
                });
                currentImageIndex = index;
            }

            // Tombol panah kiri
            document.querySelector('.nav-btn.prev').addEventListener('click', () => {
                let newIndex = currentImageIndex - 1;
                if (newIndex < 0) newIndex = imageArray.length - 1;
                setMainImage(newIndex);
            });

            document.querySelector('.nav-btn.next').addEventListener('click', () => {
                let newIndex = (currentImageIndex + 1) % imageArray.length;
                setMainImage(newIndex);
            });


            // Klik thumbnail
            thumbnails.forEach((thumb, i) => {
                thumb.addEventListener('click', function () {
                    setMainImage(i);
                });
            });

            // Set gambar awal aktif
            setMainImage(0);
        });
    </script>
</body>

</html>