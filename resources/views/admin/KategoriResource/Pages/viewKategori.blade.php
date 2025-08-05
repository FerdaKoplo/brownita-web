@extends('layout.admin.layout')
@section('title', 'Kategori')
@section('content')

<div class="p-6 bg-gray-50 min-h-screen">
    <div class="flex flex-col gap-6">
        {{-- Header --}}
        <div class="flex justify-between items-center">
            <h1 class="text-4xl font-bold text-gray-800">Kategori</h1>
            <a href="{{ route('dashboard.admin.kategori.create') }}" class="bg-amber-700 hover:bg-orange-700 transition text-white px-4 py-2 rounded-lg font-medium">
                + Buat Kategori
            </a>
        </div>

        {{-- Search Form --}}
        <form action="{{ route('dashboard.admin.kategori.view') }}" method="GET" class="max-w-md w-full flex items-center gap-3 bg-white p-3 rounded-lg shadow-md">
            <i class="fa-solid fa-magnifying-glass text-gray-500"></i>
            <input type="text" name="search" value="{{ request('search') }}"
                class="w-full bg-transparent outline-none text-gray-700 placeholder-gray-400"
                placeholder="Cari Nama Kategori...">
        </form>

        {{-- Table --}}
        <div class="overflow-auto rounded-lg shadow-md">
            <table class="w-full text-left min-w-[700px]">
                <thead class="bg-black text-white">
                    <tr>
                        <th class="px-4 py-3">#</th>
                        <th class="px-4 py-3">Nama Kategori</th>
                        <th class="px-4 py-3">Deskripsi</th>
                        <th class="px-4 py-3">Aksi</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse ($categories as $index => $category)
                        <tr class="hover:bg-gray-50 transition">
                            <td class="px-4 py-3">{{ $index + 1 }}</td>
                            <td class="px-4 py-3 font-medium text-gray-900">{{ $category->nama_kategori }}</td>
                            <td class="px-4 py-3 max-w-xs">{{ $category->deskripsi_kategori }}</td>
                            <td class="px-4 py-3 space-x-2">
                                <a href="{{ route('dashboard.admin.kategori.edit', $category->id) }}"
                                    class="text-blue-600 hover:text-blue-800 transition">
                                    <i class="fa-solid fa-pen-to-square"></i>
                                </a>
                                <form class="inline deleteForm"
                                    action="{{ route('dashboard.admin.kategori.delete', $category->id) }}"
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
                            <td colspan="4" class="text-center py-5 text-gray-500">Tidak ada data kategori.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{-- Pagination --}}
        @if(method_exists($categories, 'links'))
            <div class="mt-4">
                {{ $categories->links() }}
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
