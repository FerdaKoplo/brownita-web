@extends('layout.admin.layout')
@section('title', 'Kategori Management')

@section('content')

    <div class="p-6 bg-gray-50 min-h-screen space-y-8">

        {{-- Header Section --}}
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
            <div>
                <h1 class="text-3xl font-bold text-gray-900 tracking-tight">Kategori</h1>
                <p class="text-gray-500 text-sm mt-1">Kelola kategori produk dan inventaris Anda.</p>
            </div>
            <a href="{{ route('dashboard.admin.kategori.create') }}"
               class="group flex items-center gap-2 bg-amber-700 hover:bg-amber-800 text-white px-5 py-2.5 rounded-xl font-semibold shadow-lg shadow-amber-900/20 transition-all hover:-translate-y-0.5">
                <i class="fa-solid fa-plus transition-transform group-hover:rotate-90"></i>
                <span>Buat Kategori</span>
            </a>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-3 gap-6">
            <div class="bg-white p-6 rounded-2xl border border-gray-100 shadow-sm flex items-center gap-4">
                <div class="w-12 h-12 rounded-full bg-amber-50 text-amber-600 flex items-center justify-center text-xl">
                    <i class="fa-solid fa-layer-group"></i>
                </div>
                <div>
                    <div class="text-gray-500 text-sm font-medium">Total Kategori</div>
                    <div class="text-2xl font-bold text-gray-900">{{ $categories->total() ?? 0 }}</div>
                </div>
            </div>
        </div>

        {{-- Main Content Card --}}
        <div class="bg-white border border-gray-200 rounded-2xl shadow-sm overflow-hidden">
            
            {{-- Toolbar: Search & Filter --}}
            <div class="p-5 border-b border-gray-100 bg-gray-50/50 flex flex-col sm:flex-row justify-between gap-4">
                <form action="{{ route('dashboard.admin.kategori.view') }}" method="GET" class="relative w-full sm:w-96">
                    <i class="fa-solid fa-magnifying-glass absolute left-4 top-1/2 -translate-y-1/2 text-gray-400"></i>
                    <input type="text" 
                           name="search" 
                           value="{{ request('search') }}"
                           class="w-full pl-11 pr-4 py-2.5 bg-white border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-amber-500/20 focus:border-amber-500 transition-all"
                           placeholder="Cari nama kategori..."
                    >
                </form>

                @if(request('search'))
                    <div class="flex items-center gap-2">
                        <span class="text-sm text-gray-500">Menampilkan hasil untuk: <strong>"{{ request('search') }}"</strong></span>
                        <a href="{{ route('dashboard.admin.kategori.view') }}" class="text-red-500 hover:text-red-700 text-sm font-medium hover:underline">
                            Reset Filter
                        </a>
                    </div>
                @endif
            </div>

            {{-- Table --}}
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-gray-50/50 border-b border-gray-200 text-xs uppercase tracking-wider text-gray-500 font-semibold">
                            <th class="px-6 py-4 w-16 text-center">#</th>
                            <th class="px-6 py-4">Nama Kategori</th>
                            <th class="px-6 py-4">Deskripsi</th>
                            <th class="px-6 py-4 text-right">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @forelse ($categories as $index => $category)
                            <tr class="group hover:bg-amber-50/30 transition-colors duration-150">
                                <td class="px-6 py-4 text-center text-gray-400 font-medium">
                                    {{ $categories->firstItem() + $index }}
                                </td>
                                <td class="px-6 py-4">
                                    <div class="flex items-center gap-3">
                                        {{-- Optional: Initial Avatar if no image exists --}}
                                        {{-- <div class="w-10 h-10 rounded-lg bg-amber-100 text-amber-700 flex items-center justify-center font-bold text-sm">
                                            {{ substr($category->nama_kategori, 0, 1) }}
                                        </div> --}}
                                        <div>
                                            <span class="block text-gray-900 font-semibold group-hover:text-amber-700 transition-colors">
                                                {{ $category->nama_kategori }}
                                            </span>
                                            {{-- <span class="text-xs text-gray-400">ID: {{ $category->id }}</span> --}}
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4">
                                    <p class="text-sm text-gray-600 max-w-xs truncate" title="{{ $category->deskripsi_kategori }}">
                                        {{ $category->deskripsi_kategori ?: '-' }}
                                    </p>
                                </td>
                                <td class="px-6 py-4">
                                    <div class="flex items-center justify-end gap-2 opacity-0 group-hover:opacity-100 transition-opacity duration-200">
                                        <a href="{{ route('dashboard.admin.kategori.edit', $category->id) }}"
                                           class="p-2 bg-white border border-gray-200 rounded-lg text-gray-500 hover:text-blue-600 hover:border-blue-200 shadow-sm transition-all"
                                           title="Edit">
                                            <i class="fa-solid fa-pen-to-square"></i>
                                        </a>
                                        
                                        <form class="deleteForm inline" action="{{ route('dashboard.admin.kategori.delete', $category->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" 
                                                    class="p-2 bg-white border border-gray-200 rounded-lg text-gray-500 hover:text-red-600 hover:border-red-200 shadow-sm transition-all"
                                                    title="Hapus">
                                                <i class="fa-solid fa-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                    {{-- Visible on mobile where hover doesn't exist --}}
                                    <div class="flex sm:hidden items-center justify-end gap-2">
                                        {{-- (Mobile version buttons if needed) --}}
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="px-6 py-12 text-center">
                                    <div class="flex flex-col items-center justify-center gap-3">
                                        <div class="w-16 h-16 bg-gray-100 rounded-full flex items-center justify-center text-gray-400 text-2xl">
                                            <i class="fa-solid fa-box-open"></i>
                                        </div>
                                        <h3 class="text-gray-900 font-semibold">Tidak ada kategori ditemukan</h3>
                                        <p class="text-gray-500 text-sm max-w-sm mx-auto">
                                            Coba sesuaikan kata kunci pencarian Anda atau buat kategori baru.
                                        </p>
                                        @if(request('search'))
                                            <a href="{{ route('dashboard.admin.kategori.view') }}" class="mt-2 text-amber-600 hover:underline text-sm font-medium">Hapus Filter</a>
                                        @else
                                            <a href="{{ route('dashboard.admin.kategori.create') }}" class="mt-2 text-amber-600 hover:underline text-sm font-medium">Buat Kategori Baru</a>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            {{-- Footer / Pagination --}}
            @if($categories->hasPages())
                <div class="px-6 py-4 border-t border-gray-100 bg-gray-50 flex flex-col sm:flex-row justify-between items-center gap-4">
                    <div class="text-sm text-gray-500">
                        Menampilkan <span class="font-medium">{{ $categories->firstItem() }}</span> - <span class="font-medium">{{ $categories->lastItem() }}</span> dari <span class="font-medium">{{ $categories->total() }}</span> hasil
                    </div>
                    <div>
                        {{ $categories->appends(request()->query())->links('pagination::tailwind') }}
                    </div>
                </div>
            @endif
        </div>
    </div>

    {{-- SweetAlert Script (Kept as is, functional) --}}
    <script>
        document.addEventListener('submit', function (e) {
            if (e.target.classList.contains('deleteForm')) {
                e.preventDefault();
                Swal.fire({
                    title: 'Hapus Kategori?',
                    text: "Data ini akan dihapus permanen.",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#3085d6',
                    confirmButtonText: 'Ya, Hapus',
                    cancelButtonText: 'Batal',
                    reverseButtons: true,
                    customClass: {
                        popup: 'rounded-2xl',
                        confirmButton: 'rounded-lg px-4 py-2',
                        cancelButton: 'rounded-lg px-4 py-2'
                    }
                }).then((result) => {
                    if (result.isConfirmed) {
                        e.target.submit();
                    }
                });
            }
        });
    </script>

@endsection