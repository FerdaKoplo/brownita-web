<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BROWNITA - Katalog</title>
    <!-- Link ke CSS eksternal -->
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <style>
        .status-badge {
        padding: 4px 8px;
        border-radius: 12px;
        font-size: 12px;
        font-weight: bold;
        text-transform: uppercase;
    }

    .badge-success {
        background-color: #28a745;
        color: white;
    }

    .badge-danger {
        background-color: #dc3545;
        color: white;
    }

    .product-card.out-of-stock {
        opacity: 0.7;
    }

    .search-form {
        margin-bottom: 20px;
    }

    .status-filter {
        margin-bottom: 15px;
    }

    .status-filter select {
        padding: 8px;
        border: 1px solid #ddd;
        border-radius: 4px;
        width: 100%;
    }

    .stats-info {
        margin-bottom: 20px;
        padding: 15px;
        background-color: #f8f9fa;
        border-radius: 8px;
    }

    .stats-item {
        display: inline-block;
        margin-right: 15px;
        font-size: 14px;
    }
        </style>
</head>

<body>
    <!-- Header -->
    <header class="header">
        <div class="header-content">
            <div class="logo">BROWNITA</div>
            <nav>
                <ul class="nav-links">
                    <li><a href="{{ route('home') }}">Home</a></li>
                    <li><a href="{{ route('tentang-kami') }}">Tentang Kami</a></li>
                    <li><a href="{{ route('founder') }}">Founder</a></li>
                    <li><a href="{{ route('produk-kami') }}">Produk Kami</a></li>
                    <li><a href="{{ route('lokasi') }}">Lokasi</a></li>
                </ul>
            </nav>
        </div>
    </header>

    <!-- Main Container -->
    <div class="main-container">
        <!-- Sidebar -->
        <aside class="sidebar">
            <h3>Filter Produk</h3>
            
            <!-- Search Form -->
            <form method="GET" action="{{ route('katalog') }}" class="search-form">
                <input type="text" 
                       name="search" 
                       class="search-box" 
                       placeholder="Cari Menu..." 
                       value="{{ $searchQuery ?? '' }}">
                
                <div class="status-filter">
                    <label><strong>Status Ketersediaan:</strong></label><br>
                    <label>
                        <input type="checkbox" name="status[]" value="tersedia" class="category-checkbox"
                            {{ in_array('tersedia', (array) ($statusFilter ?? [])) ? 'checked' : '' }}
                            onchange="this.form.submit()"> Tersedia
                    </label><br>
                    <label>
                        <input type="checkbox" name="status[]" value="habis"class="category-checkbox"
                            {{ in_array('habis', (array) ($statusFilter ?? [])) ? 'checked' : '' }}
                            onchange="this.form.submit()"> Habis
                    </label>
                </div>

                <!-- Hidden inputs to maintain other filters -->
                @if(isset($selectedCategoryId))
                    <input type="hidden" name="category_id" value="{{ $selectedCategoryId }}">
                @endif
                
                <button type="submit" style="display: none;">Search</button>
            </form>
            
            <div style="border-bottom: 2px solid #8b745b; margin-bottom: 15px; padding-bottom: 5px;">
                <strong style="color: #5a4a3a;">Kategori</strong>
            </div>
            
            <ul class="category-list">
                <li class="category-item {{ (!isset($selectedCategoryId) || is_null($selectedCategoryId)) ? 'active' : '' }}">
                    <a href="{{ route('katalog', array_filter(['search' => $searchQuery ?? null, 'status' => $statusFilter ?? null])) }}">
                        <input type="checkbox" class="category-checkbox" {{ (!isset($selectedCategoryId) || is_null($selectedCategoryId)) ? 'checked' : '' }}> 
                        Semua Kategori
                    </a>
                </li>
                @if(isset($categories))
                    @foreach($categories as $category)
                    <li class="category-item {{ (isset($selectedCategoryId) && $selectedCategoryId == $category->id) ? 'active' : '' }}">
                        <a href="{{ route('katalog', array_filter(['category_id' => $category->id, 'search' => $searchQuery ?? null, 'status' => $statusFilter ?? null])) }}">
                            <input type="checkbox" class="category-checkbox" {{ (isset($selectedCategoryId) && $selectedCategoryId == $category->id) ? 'checked' : '' }}> 
                            {{ $category->nama_kategori }}
                        </a>
                    </li>
                    @endforeach
                @endif
            </ul>
        </aside>

        <!-- Content Area -->
        <main class="content-area">
             <div class="content-header">
                <h1 class="content-title">
                    @if(isset($selectedCategoryId) && isset($categories))
                        {{ $categories->find($selectedCategoryId)->nama_kategori ?? 'Katalog' }}
                    @else
                        Semua Katalog
                    @endif
                </h1>
                
                <!-- Stats Info -->
                @if(isset($stats))
                <div class="stats-info">
                    <div class="stats-item">Total Produk: <strong>{{ $stats['total'] }}</strong></div>
                    <div class="stats-item">Tersedia: <strong style="color: #28a745;">{{ $stats['tersedia'] }}</strong></div>
                    <div class="stats-item">Habis: <strong style="color: #dc3545;">{{ $stats['habis'] }}</strong></div>
                </div>
                @endif
            </div>

            <!-- Product Grid -->
            <div class="product-grid">
                @if(isset($catalogues))
                    @forelse($catalogues as $catalogue)
                        <div class="product-card {{ $catalogue->status == 'habis' ? 'out-of-stock' : '' }}">
                            @if($catalogue->gambar_produk)
                                <img src="{{ asset('storage/' . $catalogue->gambar_produk) }}" alt="{{ $catalogue->nama_produk }}"
                                    class="product-image">
                            @else
                                <img src="{{ asset('images/default-product.jpg') }}" alt="{{ $catalogue->nama_produk }}"
                                    class="product-image">
                            @endif

                            <div class="product-name">{{ $catalogue->nama_produk }}</div>

                            @if($catalogue->deskripsi)
                                <div class="product-description">{{ Str::limit($catalogue->deskripsi, 60) }}</div>
                            @endif

                            <div class="product-price">Rp {{ number_format($catalogue->harga, 0, ',', '.') }}</div>

                            <a href="#" class="product-button">Lihat</a>
                        </div>
                    @empty
                        <div style="grid-column: 1 / -1; text-align: center; color: #8b745b; font-size: 18px; padding: 40px;">
                            Tidak ada produk yang ditemukan.
                        </div>
                    @endforelse
                @else
                    <div style="grid-column: 1 / -1; text-align: center; color: #8b745b; font-size: 18px; padding: 40px;">
                        Data katalog tidak tersedia.
                    </div>
                @endif
            </div>

            <!-- Pagination -->
            @if(isset($catalogues) && $catalogues->hasPages())
                <div class="pagination-container">
                    @if($catalogues->onFirstPage())
                        <span class="pagination-btn" style="opacity: 0.5; cursor: not-allowed;">← Sebelumnya</span>
                    @else
                        <a href="{{ $catalogues->appends(request()->query())->previousPageUrl() }}" class="pagination-btn">←
                            Sebelumnya</a>
                    @endif

                    <div class="pagination-info">{{ $catalogues->currentPage() }}</div>
                    <span>...</span>

                    @if($catalogues->hasMorePages())
                        <a href="{{ $catalogues->appends(request()->query())->nextPageUrl() }}"
                            class="pagination-btn">Selanjutnya →</a>
                    @else
                        <span class="pagination-btn" style="opacity: 0.5; cursor: not-allowed;">Selanjutnya →</span>
                    @endif
                </div>
            @endif

        </main>
    </div>
</body>

</html>