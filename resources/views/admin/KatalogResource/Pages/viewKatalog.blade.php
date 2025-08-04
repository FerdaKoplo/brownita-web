@extends('layout.admin.layout')
@section('title', 'Katalog')
@section('content')

<div class="p-6 bg-gray-50 min-h-screen">
    <div class="flex flex-col gap-6">
        <div class="flex justify-between items-center">
            <h1 class="text-4xl font-bold text-gray-800">Katalog</h1>
            <a href="{{ route('dashboard.admin.katalog.create') }}" class="bg-amber-700 hover:bg-orange-700 transition text-white px-4 py-2 rounded-lg font-medium">
                + Buat Katalog
            </a>
        </div>

        <form action="{{ route('dashboard.admin.katalog.view') }}" method="GET" class="max-w-md w-full flex items-center gap-3 bg-white p-3 rounded-lg shadow-md">
            <i class="fa-solid fa-magnifying-glass text-gray-500"></i>
            <input type="text" name="search" value="{{ request('search') }}"
                class="w-full bg-transparent outline-none text-gray-700 placeholder-gray-400"
                placeholder="Cari Nama Katalog...">
        </form>

        <div class="overflow-auto rounded-lg shadow-md">
            <table class="w-full text-left min-w-[800px]">
                <thead class="bg-black text-white">
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
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse ($catalogues as $catalogue)
                        <tr class="hover:bg-gray-50 transition">
                            <td class="px-4 py-3">{{ $catalogue->id }}</td>
                            <td class="px-4 py-3">{{ $catalogue->category->nama_kategori }}</td>
                            <td class="px-4 py-3 font-medium text-gray-900">{{ $catalogue->nama_produk }}</td>
                            <td class="px-4 py-3 max-w-xs " title="{{ $catalogue->deskripsi }}">{{ $catalogue->deskripsi }}</td>
                            <td class="px-4 py-3">
                                <div class="flex flex-wrap gap-2">
                                    @forelse($catalogue->images as $image)
                                        <img src="{{ asset('storage/' . $image->gambar_produk) }}"
                                            alt="{{ $catalogue->nama_produk }}"
                                            class="w-14 h-14 object-cover rounded-md border">
                                    @empty
                                        <span class="text-sm text-gray-400 italic">Tidak ada gambar</span>
                                    @endforelse
                                </div>
                            </td>
                            <td class="px-4 py-3 text-green-600 font-semibold">{{ $catalogue->harga_rupiah }}</td>
                            <td class="px-4 py-3">
                                <span class="inline-block px-2 py-1 text-xs rounded-full
                                    {{ $catalogue->status == 'aktif' ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-600' }}">
                                    {{ ucfirst($catalogue->status) }}
                                </span>
                            </td>
                            <td class="px-4 py-3 space-x-2">
                                <a href="{{ route('dashboard.admin.katalog.edit', $catalogue->id) }}"
                                    class="text-blue-600 hover:text-blue-800 transition">
                                    <i class="fa-solid fa-pen-to-square"></i>
                                </a>
                                <form class="inline deleteForm" action="{{ route('dashboard.admin.katalog.delete', $catalogue->id) }}" method="POST">
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

        {{-- Optional Pagination --}}
        @if(method_exists($catalogues, 'links'))
            <div class="mt-4">
                {{ $catalogues->links() }}
            </div>
        @endif
    </div>
</div>

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
