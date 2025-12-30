@extends('layout.admin.layout')
@section('title', 'Tambah Kategori')

@section('content')
    <div class="p-6 bg-gray-50 min-h-screen flex justify-center">
        <div class="w-full max-w-5xl">

            {{-- Header --}}
            <div class="mb-6">
                <h1 class="text-3xl font-bold text-gray-900 tracking-tight">Tambah Kategori</h1>
                <p class="text-gray-500 text-sm mt-1">Buat kategori baru untuk mengelompokkan produk.</p>
            </div>

            <form method="POST" id="kategoriForm" action="{{ route('dashboard.admin.kategori.store') }}">
                @csrf

                <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

                    {{-- Left Column: Main Details --}}
                    <div class="lg:col-span-2 space-y-6">
                        <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-200">
                            <h2 class="text-lg font-bold text-gray-800 mb-4 border-b border-gray-100 pb-2">Informasi
                                Kategori</h2>

                            <div class="space-y-4">
                                {{-- Nama Kategori --}}
                                <div>
                                    <label for="nama_kategori"
                                        class="block text-xs font-semibold text-gray-500 uppercase mb-1">
                                        Nama Kategori
                                    </label>
                                    <input type="text" id="nama_kategori" name="nama_kategori"
                                        value="{{ old('nama_kategori') }}" placeholder="Contoh: Kue Basah"
                                        class="w-full px-4 py-2.5 rounded-lg border border-gray-300 focus:ring-2 focus:ring-amber-500 focus:border-amber-500 transition-all text-sm @error('nama_kategori') border-red-500 bg-red-50 @enderror">

                                    @error('nama_kategori')
                                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                    @enderror
                                </div>

                                {{-- Deskripsi --}}
                                <div>
                                    <label for="deskripsi_kategori"
                                        class="block text-xs font-semibold text-gray-500 uppercase mb-1">
                                        Deskripsi
                                    </label>
                                    <textarea name="deskripsi_kategori" id="deskripsi_kategori" rows="5"
                                        placeholder="Deskripsi singkat kategori..."
                                        class="w-full px-4 py-2.5 rounded-lg border border-gray-300 focus:ring-2 focus:ring-amber-500 focus:border-amber-500 transition-all text-sm resize-none @error('deskripsi_kategori') border-red-500 bg-red-50 @enderror">{{ old('deskripsi_kategori') }}</textarea>

                                    @error('deskripsi_kategori')
                                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Right Column: Actions --}}
                    <div class="space-y-6">
                        <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-200">
                            <h2 class="text-lg font-bold text-gray-800 mb-4 border-b border-gray-100 pb-2">Aksi</h2>

                            <div class="flex flex-col gap-3">
                                <button type="submit"
                                    class="w-full bg-amber-700 hover:bg-amber-800 text-white font-bold py-3 rounded-xl shadow-lg shadow-amber-900/10 transition-all hover:-translate-y-0.5">
                                    <i class="fa-solid fa-plus mr-2"></i> Simpan Kategori
                                </button>
                                <a href="{{ route('dashboard.admin.kategori.view') }}"
                                    class="w-full bg-white border border-gray-300 text-gray-700 font-semibold py-3 rounded-xl hover:bg-gray-50 transition-all text-center">
                                    Batal
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <script>
        document.getElementById('kategoriForm').addEventListener('submit', function (e) {
            e.preventDefault();
            Swal.fire({
                title: 'Simpan Kategori?',
                text: "Pastikan data yang dimasukkan sudah benar.",
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#b45309',
                cancelButtonColor: '#6b7280',
                confirmButtonText: 'Ya, Simpan',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) this.submit();
            });
        });
    </script>
@endsection