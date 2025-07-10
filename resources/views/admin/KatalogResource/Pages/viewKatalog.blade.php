@extends('layout.admin.layout')
@section('title', 'Katalog')
@section('content')
<body>
    <div class="p-5 flex flex-col gap-10">
        <h1 class="text-3xl font-bold text-brand-dark">Katalog</h1>
        <div class="flex flex-col gap-3">
            <div class="flex w-full h-full justify-between items-center">
                <form action="{{ route('dashboard.admin.katalog.view') }}" method="GET"
                    class="max-w-md w-full flex  items-center gap-2 ">
                    <i class="fa-solid fa-magnifying-glass"></i>
                    <input type="text" name="search" value="{{ request('search') }}" class="bg-brand-secondary appearance-none text-white w-full py-2 rounded-lg px-2"
                        placeholder="Cari Nama Katalog...">
                </form>
                <div class="flex flex-row  ">
                    <a class=" bg-brand-dark text-brand-light p-2  rounded-lg font-semibold"
                        href="{{ route('dashboard.admin.katalog.create') }}">
                        Buat Katalog
                    </a>
                </div>
            </div>
            <table class="table-auto w-full border-collapse">
                <thead class="bg-brand-secondary text-white">
                    <tr>
                        <th class="text-left px-4 py-3">Nomor</th>
                        <th class="text-left px-4 py-3">Kategori</th>
                        <th class="text-left px-4 py-3">Nama Produk</th>
                        <th class="text-left px-4 py-3">Deskripsi Produk</th>
                        <th class="text-left px-4 py-3">Gambar Produk</th>
                        <th class="text-left px-4 py-3">Harga</th>
                        <th class="text-left px-4 py-3">Status</th>
                        <th class="text-left px-4 py-3">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-brand-lightdark">
                    @foreach ($catalogues as $catalogue)
                        <tr>
                            <td class="px-4 py-2">{{ $catalogue->id }}</td>
                            <td class="px-4 py-2">{{ $catalogue->category->nama_kategori }}</td>
                            <td class="px-4 py-2">{{ $catalogue->nama_produk }}</td>
                            <td class="px-4 py-2 max-w-xs">{{ $catalogue->deskripsi }}</td>
                            <td class="px-4 py-2">
                                <div class="flex flex-wrap gap-2">
                                    @forelse($catalogue->images as $image)
                                        <img src="{{ asset('storage/' . $image->gambar_produk) }}"
                                            alt="{{ $catalogue->nama_produk }}"
                                            class="w-16 h-16 object-cover rounded">
                                    @empty
                                        <p>belum ada gambar</p>
                                    @endforelse
                                </div>
                            </td>

                         <td class="px-4 py-2">{{ $catalogue->harga_rupiah }}</td>
                            <td class="px-4 py-2">{{ $catalogue->status }}</td>
                            <td class="px-4 py-2">
                                <button class="text-brand-dark">
                                    <a href="{{ route('dashboard.admin.katalog.edit', $catalogue->id) }}" class="fa-solid fa-pen-to-square"></a>
                                </button>
                                <button class="text-brand-dark">
                                    <form class="deleteForm" action="{{  route('dashboard.admin.katalog.delete', $catalogue->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="fa-solid fa-trash"></button>
                                    </form>
                                </button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <script>
        document.addEventListener('submit', function (e) {
            if (e.target.classList.contains('deleteForm')) {
                e.preventDefault();
                Swal.fire({
                    title: 'Yakin ingin menghapus?',
                    text: "Pastikan pilihan anda sudah benar.",
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
</body>
