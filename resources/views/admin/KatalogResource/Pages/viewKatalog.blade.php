@extends('layout.admin.layout')
@section('title', 'Katalog')
@section('content')

<div class="p-4 sm:p-6 bg-gray-50 min-h-screen">
    <div class="flex flex-col gap-4 sm:gap-6">

        {{-- Header --}}
        <div class="flex flex-wrap justify-between items-center gap-y-3">
            <h1 class="text-2xl sm:text-4xl font-bold text-gray-800">Katalog</h1>
            <a href="{{ route('dashboard.admin.katalog.create') }}"
               class="bg-amber-700 hover:bg-orange-700 transition text-white px-3 py-2 sm:px-4 sm:py-2 rounded-lg font-medium text-sm sm:text-base">
                + Buat Katalog
            </a>
        </div>

        {{-- Search Form --}}
        <form action="{{ route('dashboard.admin.katalog.view') }}" method="GET"
              class="w-full sm:max-w-md flex items-center gap-3 bg-white p-3 rounded-lg shadow-md">
            <i class="fa-solid fa-magnifying-glass text-gray-500"></i>
            <input type="text" name="search" value="{{ request('search') }}"
                class="w-full bg-transparent outline-none text-gray-700 placeholder-gray-400 text-sm sm:text-base"
                placeholder="Cari Nama Katalog...">
        </form>

        {{-- Table --}}
        <div class="md:overflow-x-visible overflow-x-auto w-full rounded-lg shadow-md" >
            <table class="w-full text-left min-w-[1200px]">
                <thead class="bg-black text-white text-sm sm:text-base">
                    <tr>
                        <th class="px-4 py-3">#</th>
                        <th class="px-4 py-3">Kategori</th>
                        <th class="px-4 py-3">Nama Produk</th>
                        <th class="px-4 py-3">Deskripsi</th>
                        <th class="px-4 py-3">Gambar</th>
                        <th class="px-4 py-3">Harga</th>
                        <th class="px-4 py-3">Status</th>
                        <th class="px-4 py-3">Aksi</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200 text-sm sm:text-base">
                    @forelse ($catalogues as $catalogue)
                        <tr class="hover:bg-gray-50 transition">
                            <td class="px-4 py-3">{{ $catalogue->id }}</td>
                            <td class="px-4 py-3">{{ $catalogue->category->nama_kategori }}</td>
                            <td class="px-4 py-3 font-medium text-gray-900">{{ $catalogue->nama_produk }}</td>
                            <td class="px-4 py-3 max-w-xs truncate" title="{{ $catalogue->deskripsi }}">
                                {{ $catalogue->deskripsi }}
                            </td>
                            <td class="px-4 py-3">
                                <div class="flex flex-wrap gap-2">
                                    @forelse($catalogue->images as $image)
                                        <img src="{{ asset('storage/' . $image->gambar_produk) }}"
                                            alt="{{ $catalogue->nama_produk }}"
                                            class="w-12 h-12 sm:w-14 sm:h-14 object-cover rounded-md border">
                                    @empty
                                        <span class="text-xs sm:text-sm text-gray-400 italic">Tidak ada gambar</span>
                                    @endforelse
                                </div>
                            </td>
                            <td class="px-4 py-3 text-green-600 font-semibold">{{ $catalogue->harga_rupiah }}</td>
                            <td class="px-4 py-3">
                                <span class="inline-block px-2 py-1 text-xs rounded-full
                                    {{ $catalogue->status == 'tersedia' ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-600' }}">
                                    {{ ucfirst($catalogue->status) }}
                                </span>
                            </td>
                            <td class="px-4 py-3 space-x-2">
                                <a href="{{ route('dashboard.admin.katalog.edit', $catalogue->id) }}"
                                    class="text-blue-600 hover:text-blue-800 transition">
                                    <i class="fa-solid fa-pen-to-square"></i>
                                </a>
                                <form class="inline deleteForm"
                                      action="{{ route('dashboard.admin.katalog.delete', $catalogue->id) }}"
                                      method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-400 hover:text-red-800 transition">
                                        <i class="fa-solid fa-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="text-center py-5 text-gray-500">Tidak ada data katalog.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{-- Pagination --}}
        @if(method_exists($catalogues, 'links'))
            <div class="mt-4">
                {{ $catalogues->links() }}
            </div>
        @endif
    </div>
</div>

{{-- SweetAlert --}}
<script>
    document.addEventListener('submit', function (e) {
        if (e.target.classList.contains('deleteForm')) {
            e.preventDefault();
            Swal.fire({
                title: 'Yakin ingin menghapus?',
                text: "Data yang dihapus tidak bisa dikembalikan.",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, hapus!'
            }).then((result) => {
                if (result.isConfirmed) {
                    e.target.submit();
                }
            });
        }
    });
</script>

@endsection
