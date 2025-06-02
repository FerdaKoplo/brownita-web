@extends('layout.admin.layout')
@section('title', 'Kategori')
@section('content')

<body>
    <div class="p-5 flex flex-col gap-10">
        <h1 class="text-3xl font-bold text-brand-dark">Kategori</h1>
        <div class="flex flex-col gap-3">
            <div class="flex justify-end">
                <a class=" bg-brand-dark text-brand-light p-2 rounded-lg font-semibold"
                    href="{{ route('dashboard.admin.kategori.create') }}">
                    Buat Kategori
                </a>
            </div>
            <table class="table-auto w-full border-collapse">
                <thead class="bg-brand-secondary text-white">
                    <tr>
                        <th class="text-left px-4 py-3">Nomor</th>
                        <th class="text-left px-4 py-3">Nama Kategori</th>
                        <th class="text-left px-4 py-3">Deskripsi Kategori</th>
                        <th class="text-left px-4 py-3">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-brand-lightdark">
                    @foreach ($categories as $category)
                        <tr>
                            <td class="px-4 py-2">{{ $category->id }}</td>
                            <td class="px-4 py-2">{{ $category->nama_kategori }}</td>
                            <td class="px-4 py-2">{{ $category->deskripsi_kategori }}</td>
                            <td class="px-4 py-2">
                                <button class="text-brand-dark">
                                    <a href="" class="fa-solid fa-pen-to-square"></a>
                                </button> |
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
