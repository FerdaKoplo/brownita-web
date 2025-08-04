@extends('layout.admin.layout')
@section('title', 'Kategori')
@section('content')

<div class="flex justify-center items-center min-h-screen bg-gray-50 px-4">
    <div class="bg-white shadow-xl rounded-2xl p-8 w-full max-w-2xl">
        <h1 class="text-2xl font-semibold text-gray-800 mb-6 text-center">Buat Kategori</h1>
        <form method="POST" id="kategoriForm" class="space-y-6" action="{{ route('dashboard.admin.kategori.store') }}">
            @csrf

            <!-- Nama Kategori -->
            <div>
                <label for="nama_kategori" class="block text-sm font-medium text-gray-700">Nama Kategori</label>
                <input type="text" id="nama_kategori" name="nama_kategori"
                    class="mt-1 block w-full bg-gray-100 border border-gray-300 rounded-lg py-2 px-3 text-gray-800 focus:ring-2 focus:ring-amber-700 focus:outline-none">
            </div>

            <!-- Deskripsi Kategori -->
            <div>
                <label for="deskripsi_kategori" class="block text-sm font-medium text-gray-700">Deskripsi Kategori</label>
                <textarea name="deskripsi_kategori" id="deskripsi_kategori" rows="4"
                    class="mt-1 block w-full bg-gray-100 border border-gray-300 rounded-lg py-2 px-3 text-gray-800 focus:ring-2 focus:ring-amber-700 focus:outline-none"></textarea>
            </div>

            <!-- Aksi -->
            <div class="flex justify-between">
                <a href="{{ route('dashboard.admin.kategori.view') }}"
                    class="inline-block px-6 py-2 border border-gray-400 rounded-lg text-gray-700 duration-300 hover:bg-gray-100">
                    Kembali
                </a>
                <button type="submit"
                    class="px-6 py-2 bg-amber-700 text-white font-semibold rounded-lg hover:bg-amber-700/80 duration-300">
                    Buat
                </button>
            </div>
        </form>
    </div>
</div>

{{-- SweetAlert --}}
<script>
    document.getElementById('kategoriForm').addEventListener('submit', function (e) {
        e.preventDefault();

        Swal.fire({
            title: 'Yakin ingin menyimpan?',
            text: "Pastikan data sudah benar.",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, simpan!'
        }).then((result) => {
            if (result.isConfirmed) {
                e.target.submit();
            }
        });
    });
</script>

@endsection
