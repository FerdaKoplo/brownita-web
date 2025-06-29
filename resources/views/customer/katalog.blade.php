<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BROWNITA - Katalog</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>

<body>

    @extends('layout.customer.app')

    @section('content')
    <div class="main-container">
        {{-- Sidebar & Search --}}
        <div style="padding-top: 8%; " >
            <div class="search-section">
                <form method="GET" action="{{ route('produk-kami') }}" class="search-form">
                    <div class="input-wrapper">
                        <i class="fa fa-search"></i>
                        <input type="text" name="search" class="search-box" placeholder="Cari Menu..."
                            style="color: #CCB88C; font-weight: bold;" value="{{ request('search') }}">
                        @foreach((array) request('category_id') as $id)
                            <input type="hidden" name="category_id[]" value="{{ $id }}">
                        @endforeach
                    </div>
                </form>
            </div>

            <div class="sidebar-container" style="padding-left: 4%;">
                <div style="text-align: left; margin-left: -9%;">
                    <a href="{{ route('produk-kami') }}" class="reset-filter" style="border: none;">
                        Reset Filter
                    </a>
                </div>

                <div class="status-filter">
                    <form method="GET" action="{{ route('produk-kami') }}" id="statusForm">
                    <label for="status">
                        <h2 style="text-size: 20px">Ketersediaan</h2>
                    </label>
                    <div class="filter-section">
                        <select name="status" id="statusFilter" 
                            style="margin-top: -15px; margin-left: -2%;"
                            onchange="document.getElementById('statusForm').submit()">
                            <option value="">Semua Status</option>
                            <option value="tersedia" {{ request('status') == 'tersedia' ? 'selected' : '' }}>Tersedia</option>
                            <option value="habis" {{ request('status') == 'habis' ? 'selected' : '' }}>Habis</option>
                        </select>

                        @if(request('search'))
                            <input type="hidden" name="search" value="{{ request('search') }}">
                        @endif

                        @foreach((array) request('category_id') as $id)
                            <input type="hidden" name="category_id[]" value="{{ $id }}">
                        @endforeach
                    </div>
                </form>

                </div>

                <div class="filter-title">Kategori</div>
                <ul class="category-list">
                    @foreach($categories as $category)
                        <li class="category-item">
                            <form method="GET" action="{{ route('produk-kami') }}" class="category-form">
                                <label style="display: flex; align-items: center; cursor: pointer;">
                                    <input type="checkbox" name="category_id[]"
                                        value="{{ $category->id }}"
                                        class="category-checkbox"
                                        {{ in_array($category->id, (array) request('category_id')) ? 'checked' : '' }}
                                        onchange="this.form.submit();">
                                    <span style="margin-left: 5px; font-size: 15px">{{ $category->nama_kategori }}</span>
                                </label>

                                @if(request('search'))
                                    <input type="hidden" name="search" value="{{ request('search') }}">
                                @endif
                                @if(request('status'))
                                    <input type="hidden" name="status" value="{{ request('status') }}">
                                @endif
                                @foreach((array)request('category_id') as $keepId)
                                    @if($keepId != $category->id)
                                        <input type="hidden" name="category_id[]" value="{{ $keepId }}">
                                    @endif
                                @endforeach
                            </form>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>

        {{-- Konten utama --}}
        <div class="content-area">
            <div class="content-header">
                <h1 class="content-title" id="content-title">
                    @if(request('category_id') && isset($categories))
                        {{ $categories->whereIn('id', (array) request('category_id'))->pluck('nama_kategori')->implode(', ') ?? 'Katalog' }}
                    @else
                        Semua Katalog
                    @endif
                </h1>

                @if(isset($stats))
                    <div class="stats-info" id="stats-info">
                        <div class="stats-item">Total Produk: <strong>{{ $stats['total'] }}</strong></div>
                        <div class="stats-item">Tersedia: <strong style="color: #28a745;">{{ $stats['tersedia'] }}</strong></div>
                        <div class="stats-item">Habis: <strong style="color: #dc3545;">{{ $stats['habis'] }}</strong></div>
                    </div>
                @endif
            </div>

            {{-- Produk Grid --}}
            <div class="product-grid" id="product-grid">
                @forelse($catalogues as $catalogue)
                    <div class="product-card-cover">
                    <div class="product-card-lid"></div>
                    <div class="product-card {{ $catalogue->status == 'habis' ? 'out-of-stock' : '' }}">
                        <div class="status-badge {{ $catalogue->status == 'tersedia' ? 'badge-success' : 'badge-danger' }}">
                            {{ $catalogue->status == 'tersedia' ? 'Tersedia' : 'Habis' }}
                        </div>

                        <div class="product-card-content">
                            <div class="product-image-wrapper">
                                @if($catalogue->gambar_produk)
                                @php
                                    $firstImage = explode(';', $catalogue->gambar_produk)[0];
                                @endphp
                                    <img src="{{ asset('storage/' . $firstImage) }}" alt="{{ $catalogue->nama_produk }}">
                                @else
                                    <img src="{{ asset('images/default-product.jpg') }}" alt="{{ $catalogue->nama_produk }}">
                                @endif
                            </div>

                            <div class="product-name">{{ $catalogue->nama_produk }}</div>

                            @php
                                $desc = Str::limit($catalogue->deskripsi, 60);
                                $endsWithDot = Str::endsWith($desc, ['.', '...', '"']);
                            @endphp
                            <div class="product-description">
                                "{{ $desc }}{{ $endsWithDot ? '' : '...' }}"
                            </div>
                            <div class="product-price">Rp {{ number_format($catalogue->harga, 0, ',', '.') }}</div>

                            <a href="{{ route('produk.detail', $catalogue->id) }}" class="product-button">Lihat</a>
                        </div>
                    </div>
                </div>

                @empty
                    <div style="grid-column: 1 / -1; text-align: center; color: #8b745b; font-size: 18px; padding: 40px;">
                        Tidak ada produk yang ditemukan.
                    </div>
                @endforelse
            </div>

            {{-- Pagination --}}
            @if($catalogues->hasPages())
                <div class="pagination-container">
                    @if($catalogues->onFirstPage())
                        <span class="pagination-btn" style="opacity: 0.5; cursor: not-allowed;">← Sebelumnya</span>
                    @else
                        <a href="{{ $catalogues->appends(request()->query())->previousPageUrl() }}" class="pagination-btn">← Sebelumnya</a>
                    @endif

                    <div class="pagination-info">{{ $catalogues->currentPage() }}</div>

                    @if($catalogues->hasMorePages())
                        <a href="{{ $catalogues->appends(request()->query())->nextPageUrl() }}" class="pagination-btn">Selanjutnya →</a>
                    @else
                        <span class="pagination-btn" style="opacity: 0.5; cursor: not-allowed;">Selanjutnya →</span>
                    @endif
                </div>
            @endif
        </div>
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


    </main>


</body>

</html>