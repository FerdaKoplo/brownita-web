@extends('layout.admin.layout')
@section('title', 'Kategori')
@section('content')

    <div class="p-4 sm:p-6 bg-gray-50 min-h-screen">
        <div class="flex flex-col gap-4 sm:gap-6">

            {{-- Header --}}
            <div class="flex flex-wrap justify-between items-center gap-y-3">
                <h1 class="text-2xl sm:text-4xl font-bold text-gray-800">Kategori</h1>
                <a href="{{ route('dashboard.admin.kategori.create') }}"
                    class="bg-amber-700 hover:bg-orange-700 transition text-white px-3 py-2 sm:px-4 sm:py-2 rounded-lg font-medium text-sm sm:text-base">
                    + Buat Kategori
                </a>
            </div>

            {{-- Search Form --}}
            <form action="{{ route('dashboard.admin.kategori.view') }}" method="GET"
                class="w-full sm:max-w-md flex items-center gap-3 bg-white p-3 rounded-lg shadow-md">
                <i class="fa-solid fa-magnifying-glass text-gray-500"></i>
                <input type="text" name="search" value="{{ request('search') }}"
                    class="w-full bg-transparent outline-none text-gray-700 placeholder-gray-400 text-sm sm:text-base"
                    placeholder="Cari Nama Kategori...">

                {{-- Submit & Reset --}}
                <div class="flex items-center gap-3 ">
                    <button type="submit"
                        class="bg-amber-600 text-white px-4 py-1 rounded text-sm hover:bg-black transition">
                        Filter
                    </button>
                    <a href="{{ route('dashboard.admin.kategori.view') }}"
                        class="text-red-500 font-semibold text-sm hover:underline ml-2">Reset</a>
                </div>
            </form>

            {{-- Table --}}
            <div class="md:overflow-x-visible overflow-x-auto w-full rounded-lg shadow-md">
                <table class="w-full text-left min-w-[1200px]">
                    <thead class="bg-black text-white text-sm sm:text-base">
                        <tr>
                            <th class="px-4 py-3">#</th>
                            <th class="px-4 py-3">Nama Kategori</th>
                            <th class="px-4 py-3">Deskripsi</th>
                            <th class="px-4 py-3">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200 text-sm sm:text-base">
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
                                        action="{{ route('dashboard.admin.kategori.delete', $category->id) }}" method="POST">
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
            @if($categories->hasPages())
                <div class="flex justify-center gap-10 items-center mt-6">
                    @if($categories->onFirstPage())
                        <span class="text-gray-400 flex justify-center items-center gap-2">
                            <i class="fa-solid fa-angle-left"></i>
                            Prev
                        </span>
                    @else
                        <a href="{{ $categories->appends(request()->query())->previousPageUrl() }}"
                            class="text-amber-700 justify-center font-semibold flex items-center gap-2">
                            <i class="fa-solid fa-angle-left"></i>
                            Prev
                        </a>
                    @endif
                    @foreach ($categories->getUrlRange(1, $categories->lastPage()) as $page => $url)
                        <a href="{{ $url }}"
                            class="{{ $page == $categories->currentPage() ? 'bg-black text-white' : 'text-amber-700' }} px-2 py-1 rounded">
                            {{ $page }}
                        </a>
                    @endforeach

                    @if($categories->hasMorePages())
                        <a href="{{ $categories->appends(request()->query())->nextPageUrl() }}"
                            class="text-amber-700 font-semibold justify-center flex items-center gap-2">
                            Next
                            <i class="fa-solid fa-angle-right"></i>
                        </a>
                    @else
                        <span class="text-gray-400 flex items-center gap-2">
                            Next
                            <i class="fa-solid fa-angle-right"></i>
                        </span>
                    @endif
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
