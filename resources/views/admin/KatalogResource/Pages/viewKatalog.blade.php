@extends('layout.admin.layout')
@section('title', 'Katalog')
@section('content')
<body>
    <div class="p-5 flex flex-col gap-10">
        <h1 class="text-3xl font-bold text-brand-dark">Katalog</h1>
        <div class="flex flex-col gap-3">
            <div class="flex w-full h-full justify-between">
                <div class=" justify-start max-w-md w-full  flex items-center gap-2">
                    <i class=" fa-solid fa-magnifying-glass"></i>
                    <input type="text" class="w-full  py-2 rounded-lg px-2" placeholder="Cari Nama Katalog...">
                </div>
                <div class="flex flex-row justify-end ">
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
                            <td class="px-4 py-2">{{ $catalogue->deskripsi }}</td>
                            <td><img class="w-24 h-24 object-cover rounded" src="{{ asset('storage/' . $catalogue->gambar_produk) }}" alt="{{ $catalogue->gambar_produk }}"></td>
                            <td class="px-4 py-2">{{ $catalogue->harga_rupiah }}</td>
                            <td class="px-4 py-2">{{ $catalogue->status }}</td>
                            <td class="px-4 py-2">
                                <button class="text-brand-dark">
                                    <a href="" class="fa-solid fa-pen-to-square"></a>
                                </button>
                                <button class="text-brand-dark">
                                    <a href="" class="fa-solid fa-trash"></a>
                                </button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</body>
