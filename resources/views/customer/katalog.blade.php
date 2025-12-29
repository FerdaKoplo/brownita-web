@extends('layout.customer.app')
@section('title', 'BROWNITA - Katalog Menu')

@section('content')

<div class="min-h-screen bg-gray-50 font-sans" x-data="{ showMobileFilters: false }">
    
    <div class="bg-amber-800 text-white py-8 px-6 md:px-12 mb-8">
        <h1 class="text-3xl md:text-4xl font-bold mb-2">Jelajahi Menu Kami</h1>
        <p class="text-amber-100 opacity-90">Temukan kelezatan di setiap gigitan.</p>
    </div>

    <div class="px-4 md:px-12 pb-12">
        
        <div class="flex flex-wrap items-center justify-between gap-4 mb-6 md:hidden">
            <button @click="showMobileFilters = true" 
                class="flex items-center gap-2 bg-white border border-gray-200 px-4 py-2 rounded-lg shadow-sm text-gray-700 font-medium">
                <i class="fa-solid fa-filter text-amber-600"></i> Filter
            </button>
            
            <select form="mainFilterForm" name="sort" onchange="document.getElementById('mainFilterForm').submit()" 
                class="bg-white border border-gray-200 px-4 py-2 rounded-lg text-sm text-gray-700 shadow-sm focus:ring-amber-500 focus:border-amber-500">
                <option value="asc" {{ request('sort') == 'asc' ? 'selected' : '' }}>Harga Terendah</option>
                <option value="desc" {{ request('sort') == 'desc' ? 'selected' : '' }}>Harga Tertinggi</option>
            </select>
        </div>

        <div class="flex flex-col lg:flex-row gap-8 items-start">
            
      
            <div x-show="showMobileFilters" 
                 class="fixed inset-0 z-40 bg-black/50 lg:hidden"
                 x-transition.opacity
                 @click="showMobileFilters = false"></div>

            <aside class="fixed inset-y-0 left-0 z-50 w-72 bg-white shadow-2xl transform transition-transform duration-300 lg:translate-x-0 lg:static lg:z-0 lg:shadow-none lg:bg-transparent lg:w-72 lg:block"
                   :class="showMobileFilters ? 'translate-x-0' : '-translate-x-full'">
                
                <form id="mainFilterForm" method="GET" action="{{ route('produk-kami') }}" class="bg-white lg:rounded-2xl lg:shadow-sm lg:border border-gray-100 p-6 h-full lg:h-auto overflow-y-auto lg:sticky lg:top-4">
                    
                    <div class="flex justify-between items-center mb-6 lg:hidden">
                        <h2 class="text-xl font-bold text-gray-800">Filter</h2>
                        <button type="button" @click="showMobileFilters = false" class="text-gray-500">
                            <i class="fa-solid fa-xmark text-2xl"></i>
                        </button>
                    </div>

                    <div class="mb-6">
                        <label class="text-xs font-bold text-gray-400 uppercase tracking-wider mb-2 block">Pencarian</label>
                        <div class="relative">
                            <i class="fa fa-search absolute left-3 top-1/2 -translate-y-1/2 text-gray-400"></i>
                            <input type="text" name="search" value="{{ request('search') }}"
                                class="w-full pl-10 pr-4 py-2.5 bg-gray-50 border border-gray-200 rounded-xl text-sm focus:ring-2 focus:ring-amber-500/20 focus:border-amber-500 outline-none transition"
                                placeholder="Cari Brownies, Roti...">
                        </div>
                    </div>

                    <div class="mb-6 hidden lg:block">
                        <label class="text-xs font-bold text-gray-400 uppercase tracking-wider mb-2 block">Urutkan</label>
                        <select name="sort" onchange="this.form.submit()" class="w-full bg-gray-50 border border-gray-200 text-gray-700 text-sm rounded-xl focus:ring-amber-500 focus:border-amber-500 p-2.5">
                            <option value="asc" {{ request('sort') == 'asc' ? 'selected' : '' }}>Harga Terendah</option>
                            <option value="desc" {{ request('sort') == 'desc' ? 'selected' : '' }}>Harga Tertinggi</option>
                        </select>
                    </div>

                    <div class="mb-6">
                        <label class="text-xs font-bold text-gray-400 uppercase tracking-wider mb-3 block">Kategori</label>
                        <div class="space-y-2 max-h-48 overflow-y-auto custom-scrollbar">
                            @foreach($categories as $category)
                                <label class="flex items-center gap-3 cursor-pointer group hover:bg-gray-50 p-2 rounded-lg transition -mx-2">
                                    <div class="relative flex items-center">
                                        <input type="checkbox" name="category_id[]" value="{{ $category->id }}"
                                            class="peer h-5 w-5 rounded border-gray-300 text-amber-600 focus:ring-amber-600 cursor-pointer"
                                            onchange="this.form.submit()"
                                            {{ in_array($category->id, (array) request('category_id')) ? 'checked' : '' }}>
                                    </div>
                                    <span class="text-sm text-gray-600 group-hover:text-amber-700 font-medium">{{ $category->nama_kategori }}</span>
                                </label>
                            @endforeach
                        </div>
                    </div>

                    <div class="mb-6">
                        <label class="text-xs font-bold text-gray-400 uppercase tracking-wider mb-3 block">Status</label>
                        <select name="status" onchange="this.form.submit()" class="w-full bg-gray-50 border border-gray-200 text-gray-700 text-sm rounded-xl focus:ring-amber-500 focus:border-amber-500 p-2.5">
                            <option value="">Semua Status</option>
                            <option value="tersedia" {{ request('status') == 'tersedia' ? 'selected' : '' }}>Tersedia</option>
                            <option value="habis" {{ request('status') == 'habis' ? 'selected' : '' }}>Habis</option>
                        </select>
                    </div>

                    <div class="mb-4-
                        <label class="text-xs font-bold text-gray-400 uppercase tracking-wider mb-3 block">Rentang Harga</label>
                        <div class="grid grid-cols-2 gap-2 mb-3">
                            <div>
                                <input type="text" name="min_price" placeholder="Min"
                                    value="{{ request('min_price') ? number_format((int) preg_replace('/[^\d]/', '', request('min_price')), 0, ',', '.') : '' }}"
                                    class="w-full px-3 py-2 bg-gray-50 border border-gray-200 rounded-lg text-sm rupiah-input focus:border-amber-500 outline-none">
                            </div>
                            <div>
                                <input type="text" name="max_price" placeholder="Max"
                                    value="{{ request('max_price') ? number_format((int) preg_replace('/[^\d]/', '', request('max_price')), 0, ',', '.') : '' }}"
                                    class="w-full px-3 py-2 bg-gray-50 border border-gray-200 rounded-lg text-sm rupiah-input focus:border-amber-500 outline-none">
                            </div>
                        </div>
                        <button type="submit" class="w-full bg-amber-700 hover:bg-amber-800 text-white font-semibold py-2 rounded-lg text-sm transition shadow-md shadow-amber-900/10">
                            Terapkan Harga
                        </button>
                    </div>

                    <div class="text-center pt-2 border-t border-gray-100">
                        <a href="{{ route('produk-kami') }}" class="text-xs text-red-500 font-semibold hover:text-red-800 duration-500">
                            Reset Semua Filter
                        </a>
                    </div>
                </form>
            </aside>

            <main class="flex-1 w-full">
                
                @if(request('category_id') || request('search'))
                <div class="mb-6 flex flex-wrap items-center gap-2">
                    <span class="text-sm text-gray-500">Menampilkan hasil untuk:</span>
                    @if(request('search'))
                        <span class="bg-amber-100 text-amber-800 px-3 py-1 rounded-full text-xs font-bold">
                            "{{ request('search') }}"
                        </span>
                    @endif
                    @if(request('category_id') && $categories)
                        @foreach($categories->whereIn('id', (array) request('category_id')) as $cat)
                            <span class="bg-amber-50 text-amber-700 border border-amber-200 px-3 py-1 rounded-full text-xs font-bold">
                                {{ $cat->nama_kategori }}
                            </span>
                        @endforeach
                    @endif
                </div>
                @endif

                <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-3 gap-6">
                    @forelse($catalogues as $catalogue)
                        <div class="group bg-white rounded-2xl shadow-sm hover:shadow-xl hover:-translate-y-1 transition-all duration-300 border border-gray-100 flex flex-col h-full overflow-hidden relative">
                            
                            <div class="relative aspect-[4/3] overflow-hidden bg-gray-100">
                                @if($catalogue->status == 'habis')
                                    <div class="absolute inset-0 bg-black/50 z-10 flex items-center justify-center">
                                        <span class="bg-red-600 text-white px-4 py-1 rounded-full text-sm font-bold shadow-lg transform -rotate-12 border-2 border-white">STOK HABIS</span>
                                    </div>
                                @endif

                                <img src="{{ $catalogue->images->first() ? asset('storage/' . $catalogue->images->first()->gambar_produk) : asset('images/default-product.jpg') }}" 
                                     alt="{{ $catalogue->nama_produk }}" 
                                     class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                                
                                <div class="absolute bottom-4 right-4 translate-y-20 opacity-0 group-hover:translate-y-0 group-hover:opacity-100 transition-all duration-300 flex flex-col gap-2 z-20">
                                    <a href="{{ route('produk.detail', $catalogue->id) }}" class="w-10 h-10 bg-white rounded-full shadow-lg flex items-center justify-center text-gray-700 hover:text-amber-600 hover:bg-amber-50 transition" title="Lihat Detail">
                                        <i class="fa-solid fa-eye"></i>
                                    </a>
                                </div>
                            </div>

                            <div class="p-5 flex-1 flex flex-col">
                                <div class="mb-1">
                                    <span class="text-xs font-bold text-amber-600 bg-amber-50 px-2 py-0.5 rounded uppercase tracking-wider">
                                        {{ $catalogue->category->nama_kategori ?? 'Menu' }}
                                    </span>
                                </div>
                                <h3 class="text-lg font-bold text-gray-800 mb-2 line-clamp-1 group-hover:text-amber-700 transition">
                                    {{ $catalogue->nama_produk }}
                                </h3>
                                <p class="text-sm text-gray-500 line-clamp-2 mb-4 flex-1">
                                    {{ $catalogue->deskripsi }}
                                </p>
                                
                                <div class="flex items-center justify-between pt-4 border-t border-gray-100 mt-auto">
                                    <div class="flex flex-col">
                                        <span class="text-xs text-gray-400">Harga</span>
                                        <span class="text-lg font-bold text-gray-900">{{ $catalogue->harga_rupiah }}</span>
                                    </div>

                                    @if($catalogue->status == 'tersedia')
                                        @if(Auth::check())
                                            <form action="{{ route('keranjang.store') }}" method="POST">
                                                @csrf
                                                <input type="hidden" name="katalog_id" value="{{ $catalogue->id }}">
                                                <button type="submit" class="w-10 h-10 rounded-full bg-amber-700 hover:bg-gray-900 text-white flex items-center justify-center shadow-lg shadow-amber-900/20 transition-all transform active:scale-95" title="Tambah ke Keranjang">
                                                    <i class="fa-solid fa-cart-plus"></i>
                                                </button>
                                            </form>
                                        @else
                                            <a href="{{ route('login') }}" class="w-10 h-10 rounded-full bg-gray-100 hover:bg-gray-200 text-gray-600 flex items-center justify-center transition" title="Login untuk belanja">
                                                <i class="fa-solid fa-lock"></i>
                                            </a>
                                        @endif
                                    @else
                                        <button disabled class="w-10 h-10 rounded-full bg-gray-100 text-gray-400 cursor-not-allowed flex items-center justify-center">
                                            <i class="fa-solid fa-ban"></i>
                                        </button>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="col-span-full py-16 text-center">
                            <div class="bg-amber-50 w-24 h-24 rounded-full flex items-center justify-center mx-auto mb-4">
                                <i class="fa-solid fa-cookie-bite text-4xl text-amber-300"></i>
                            </div>
                            <h3 class="text-xl font-bold text-gray-800">Menu Tidak Ditemukan</h3>
                            <p class="text-gray-500 mt-2">Coba ubah kata kunci atau reset filter Anda.</p>
                            <a href="{{ route('produk-kami') }}" class="inline-block mt-4 text-amber-700 font-semibold hover:underline">Lihat Semua Menu</a>
                        </div>
                    @endforelse
                </div>

                @if($catalogues->hasPages())
                    <div class="mt-12 bg-white rounded-xl shadow-sm border border-gray-100 p-4 flex justify-center">
                       {{ $catalogues->appends(request()->query())->links('pagination::tailwind') }}
                    </div>
                @endif

            </main>
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