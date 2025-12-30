@extends('layout.admin.layout')
@section('title', 'Tambah Produk Baru')

@section('content')
    <div class="p-6 bg-gray-50 min-h-screen flex justify-center">
        <div class="w-full max-w-5xl">

            <div class="mb-6">
                <h1 class="text-3xl font-bold text-gray-900 tracking-tight">Tambah Produk</h1>
                <p class="text-gray-500 text-sm mt-1">Isi informasi produk baru untuk katalog Anda.</p>
            </div>

            <form method="POST" action="{{ route('dashboard.admin.katalog.store') }}" enctype="multipart/form-data"
                id="productForm">
                @csrf

                <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

                    <div class="lg:col-span-2 space-y-6">
                        <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-200">
                            <h2 class="text-lg font-bold text-gray-800 mb-4 border-b border-gray-100 pb-2">Informasi Dasar
                            </h2>

                            <div class="space-y-4">
                                <div>
                                    <label class="block text-xs font-semibold text-gray-500 uppercase mb-1">Nama
                                        Produk</label>
                                    <input type="text" name="nama_produk"
                                        class="w-full px-4 py-2.5 rounded-lg border border-gray-300 focus:ring-2 focus:ring-amber-500 focus:border-amber-500 transition-all text-sm"
                                        placeholder="Contoh: Brownies Panggang Premium">
                                </div>

                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                    <div>
                                        <label
                                            class="block text-xs font-semibold text-gray-500 uppercase mb-1">Kategori</label>
                                        <select name="category_id"
                                            class="w-full px-4 py-2.5 rounded-lg border border-gray-300 focus:ring-2 focus:ring-amber-500 focus:border-amber-500 transition-all text-sm bg-white">
                                            <option disabled selected>Pilih Kategori</option>
                                            @foreach ($categories as $category)
                                                <option value="{{ $category->id }}">{{ $category->nama_kategori }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div>
                                        <label class="block text-xs font-semibold text-gray-500 uppercase mb-1">Harga
                                            (IDR)</label>
                                        <div class="relative">
                                            <span
                                                class="absolute left-4 top-1/2 -translate-y-1/2 text-gray-500 font-bold text-sm">Rp</span>
                                            <input type="text" id="harga_display"
                                                class="w-full pl-10 pr-4 py-2.5 rounded-lg border border-gray-300 focus:ring-2 focus:ring-amber-500 focus:border-amber-500 transition-all text-sm"
                                                placeholder="0">
                                            <input type="hidden" name="harga" id="harga_actual">
                                        </div>
                                    </div>
                                </div>

                                <div>
                                    <label
                                        class="block text-xs font-semibold text-gray-500 uppercase mb-1">Deskripsi</label>
                                    <textarea name="deskripsi" rows="5"
                                        class="w-full px-4 py-2.5 rounded-lg border border-gray-300 focus:ring-2 focus:ring-amber-500 focus:border-amber-500 transition-all text-sm resize-none"
                                        placeholder="Jelaskan rasa, tekstur, dan keunggulan produk..."></textarea>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="space-y-6">

                        <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-200">
                            <h2 class="text-lg font-bold text-gray-800 mb-4 border-b border-gray-100 pb-2">Galeri Produk
                            </h2>

                            <div class="mb-4">
                                <label for="gambar_produk"
                                    class="flex flex-col items-center justify-center w-full h-32 border-2 border-dashed border-gray-300 rounded-xl cursor-pointer bg-gray-50 hover:bg-amber-50 hover:border-amber-400 transition-all group">
                                    <div class="flex flex-col items-center justify-center pt-5 pb-6">
                                        <i
                                            class="fa-solid fa-cloud-arrow-up text-2xl text-gray-400 group-hover:text-amber-600 mb-2"></i>
                                        <p class="text-xs text-gray-500 group-hover:text-amber-700">Klik untuk upload gambar
                                        </p>
                                    </div>
                                    <input id="gambar_produk" name="gambar_produk[]" type="file" multiple accept="image/*"
                                        class="hidden" />
                                </label>

                                {{-- WARNING TEXT ADDED HERE --}}
                                <p class="text-xs text-amber-600 mt-2 text-center">
                                    <i class="fa-solid fa-circle-exclamation mr-1"></i> Maksimal 5 gambar (Max 2MB/file).
                                </p>
                                @error('gambar_produk')
                                    <p class="text-red-500 text-xs mt-1 text-center">{{ $message }}</p>
                                @enderror
                            </div>

                            {{-- Preview Grid --}}
                            <div id="preview_container" class="grid grid-cols-3 gap-2">
                            </div>
                        </div>

                        <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-200">
                            <h2 class="text-lg font-bold text-gray-800 mb-4 border-b border-gray-100 pb-2">Aksi</h2>

                            <div class="flex flex-col gap-3">
                                <button type="submit"
                                    class="w-full bg-amber-700 hover:bg-amber-800 text-white font-bold py-3 rounded-xl shadow-lg shadow-amber-900/10 transition-all hover:-translate-y-0.5">
                                    <i class="fa-solid fa-save mr-2"></i> Simpan Produk
                                </button>
                                <a href="{{ route('dashboard.admin.katalog.view') }}"
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
        const displayInput = document.getElementById('harga_display');
        const actualInput = document.getElementById('harga_actual');

        displayInput.addEventListener('input', function (e) {
            let value = this.value.replace(/[^0-9]/g, '');
            actualInput.value = value;

            if (value) {
                this.value = new Intl.NumberFormat('id-ID').format(value);
            } else {
                this.value = '';
            }
        });

        document.getElementById('gambar_produk').addEventListener('change', function (e) {
            const container = document.getElementById('preview_container');
            const files = e.target.files;

            if (files.length > 5) {
                Swal.fire({
                    icon: 'warning',
                    title: 'Terlalu Banyak Gambar',
                    text: 'Maksimal hanya boleh mengupload 5 gambar sekaligus.',
                    confirmButtonColor: '#b45309'
                });
                this.value = '';
                container.innerHTML = '';
                return;
            }

            container.innerHTML = '';

            Array.from(files).forEach(file => {
                const reader = new FileReader();
                reader.onload = function (e) {
                    const div = document.createElement('div');
                    div.className = "relative aspect-square rounded-lg overflow-hidden border border-gray-200 group";
                    div.innerHTML = `
                            <img src="${e.target.result}" class="w-full h-full object-cover">
                            <div class="absolute inset-0 bg-black/20 hidden group-hover:block"></div>
                        `;
                    container.appendChild(div);
                }
                reader.readAsDataURL(file);
            });
        });

        document.getElementById('productForm').addEventListener('submit', function (e) {
            e.preventDefault();
            Swal.fire({
                title: 'Simpan Produk?',
                text: "Pastikan data sudah benar.",
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