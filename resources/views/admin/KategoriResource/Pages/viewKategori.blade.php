@extends('layout.admin.layout')
@section('title', 'Kategori')
@section('content')

<body>
    <div class="p-5 flex flex-col gap-10">
        <h1 class="text-3xl font-bold text-brand-dark">Kategori</h1>
        <div class="flex flex-col gap-3">
            <div class="flex w-full h-full justify-between">
                <div class=" justify-start max-w-md w-full  flex items-center gap-2">
                    <i class=" fa-solid fa-magnifying-glass"></i>
                    <input type="text" class="w-full  py-2 rounded-lg px-2" placeholder="Cari Nama Kategori...">
                </div>
                <div class="flex flex-row justify-end ">
                    <a class=" bg-brand-dark text-brand-light p-2   rounded-lg font-semibold"
                        href="{{ route('dashboard.admin.kategori.create') }}">
                        Buat Kategori
                    </a>
                </div>
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
                    @foreach ($categories as $index => $category)
                        <tr>
                            <td class="px-4 py-2">{{ $index + 1 }}</td>
                            <td class="px-4 py-2">{{ $category->nama_kategori }}</td>
                            <td class="px-4 py-2">{{ $category->deskripsi_kategori }}</td>
                            <td class="px-4 py-2">
                                <button class="text-brand-dark">
                                    <a href="{{ route('dashboard.admin.kategori.edit', $category->id) }}"
                                        class="fa-solid fa-pen-to-square"></a>
                                </button> |
                                <button class="text-brand-dark">
                                    <form class="deleteForm"
                                        action="{{  route('dashboard.admin.kategori.delete', $category->id) }}"
                                        method="POST">
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
