@extends('layout.admin.layout')
@section('title', 'Edit Produk')

@section('content')
    <div class="p-6 bg-gray-50 min-h-screen flex justify-center">
        <div class="w-full max-w-5xl">

            <div class="mb-6 flex justify-between items-center">
                <div>
                    <h1 class="text-3xl font-bold text-gray-900 tracking-tight">Edit Produk</h1>
                    <p class="text-gray-500 text-sm mt-1">Perbarui informasi produk: <span
                            class="font-bold text-amber-700">{{ $catalogues->nama_produk }}</span></p>
                </div>
                <div class="text-sm px-3 py-1 bg-amber-50 text-amber-800 rounded-lg border border-amber-200 font-mono">
                    ID: {{ $catalogues->id }}
                </div>
            </div>

            <form method="POST" action="{{ route('dashboard.admin.katalog.update', $catalogues->id) }}"
                enctype="multipart/form-data" id="editForm">
                @csrf
                @method('PUT')

                <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

                    <div class="lg:col-span-2 space-y-6">
                        <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-200">
                            <h2 class="text-lg font-bold text-gray-800 mb-4 border-b border-gray-100 pb-2">Detail Produk
                            </h2>

                            <div class="space-y-4">
                                <div>
                                    <label class="block text-xs font-semibold text-gray-500 uppercase mb-1">Nama
                                        Produk</label>
                                    <input type="text" name="nama_produk"
                                        value="{{ old('nama_produk', $catalogues->nama_produk) }}"
                                        class="w-full px-4 py-2.5 rounded-lg border border-gray-300 focus:ring-2 focus:ring-amber-500 focus:border-amber-500 transition-all text-sm">
                                </div>

                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                    <div>
                                        <label
                                            class="block text-xs font-semibold text-gray-500 uppercase mb-1">Kategori</label>
                                        <select name="category_id"
                                            class="w-full px-4 py-2.5 rounded-lg border border-gray-300 focus:ring-2 focus:ring-amber-500 text-sm bg-white">
                                            @foreach ($categories as $category)
                                                <option value="{{ $category->id }}" {{ $catalogues->category_id == $category->id ? 'selected' : '' }}>
                                                    {{ $category->nama_kategori }}
                                                </option>
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
                                                value="{{ number_format($catalogues->harga, 0, ',', '.') }}"
                                                class="w-full pl-10 pr-4 py-2.5 rounded-lg border border-gray-300 focus:ring-2 focus:ring-amber-500 focus:border-amber-500 transition-all text-sm">
                                            <input type="hidden" name="harga" id="harga_actual"
                                                value="{{ $catalogues->harga }}">
                                        </div>
                                    </div>
                                </div>

                                <div>
                                    <label
                                        class="block text-xs font-semibold text-gray-500 uppercase mb-1">Deskripsi</label>
                                    <textarea name="deskripsi" rows="5"
                                        class="w-full px-4 py-2.5 rounded-lg border border-gray-300 focus:ring-2 focus:ring-amber-500 focus:border-amber-500 transition-all text-sm resize-none">{{ old('deskripsi', $catalogues->deskripsi) }}</textarea>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="space-y-6">

                        <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-200">
                            <h2 class="text-lg font-bold text-gray-800 mb-4 border-b border-gray-100 pb-2">Status & Media
                            </h2>

                            <div class="mb-6">
                                <label class="block text-xs font-semibold text-gray-500 uppercase mb-2">Ketersediaan
                                    Stok</label>
                                <select name="status"
                                    class="w-full px-4 py-2.5 rounded-lg border border-gray-300 focus:ring-2 focus:ring-amber-500 text-sm">
                                    <option value="tersedia" {{ $catalogues->status == 'tersedia' ? 'selected' : '' }}>
                                        Tersedia</option>
                                    <option value="habis" {{ $catalogues->status == 'habis' ? 'selected' : '' }}>Stok Habis
                                    </option>
                                </select>
                            </div>

                            <div class="mb-4">
                                <label class="block text-xs font-semibold text-gray-500 uppercase mb-2">Update
                                    Gambar</label>
                                <label for="gambar_produk"
                                    class="flex flex-col items-center justify-center w-full h-24 border-2 border-dashed border-gray-300 rounded-xl cursor-pointer hover:bg-amber-50 hover:border-amber-400 transition-all">
                                    <span class="text-xs text-gray-500">Klik untuk ganti gambar</span>
                                    <input id="gambar_produk" name="gambar_produk[]" type="file" multiple accept="image/*"
                                        class="hidden" />
                                </label>

                                <p class="text-[10px] text-amber-600 mt-2">
                                    <i class="fa-solid fa-circle-exclamation mr-1"></i> Upload baru akan menggantikan gambar
                                    lama. Maksimal 5 gambar.
                                </p>
                                @error('gambar_produk')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <div id="preview_container" class="grid grid-cols-3 gap-2">
                                @if ($catalogues->images->count() > 0)
                                    @foreach($catalogues->images as $image)
                                        <div class="relative aspect-square rounded-lg overflow-hidden border border-gray-200">
                                            <img src="{{ asset('storage/' . $image->gambar_produk) }}"
                                                class="w-full h-full object-cover">
                                        </div>
                                    @endforeach
                                @else
                                    <div class="col-span-3 text-center text-xs text-gray-400 py-4 italic">Belum ada gambar</div>
                                @endif
                            </div>
                        </div>

                        <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-200">
                            <div class="flex flex-col gap-3">
                                <h2 class="text-lg font-bold text-gray-800 mb-4 border-b border-gray-100 pb-2">Aksi</h2>
                                <button type="submit"
                                    class="w-full bg-amber-700 hover:bg-amber-800 text-white font-bold py-3 rounded-xl shadow-lg shadow-amber-900/10 transition-all hover:-translate-y-0.5">
                                    <i class="fa-solid fa-floppy-disk mr-2"></i> Update Produk
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
            this.value = value ? new Intl.NumberFormat('id-ID').format(value) : '';
        });

        document.getElementById('gambar_produk').addEventListener('change', function (e) {
            const container = document.getElementById('preview_container');
            const files = e.target.files;

            if (files.length > 5) {
                Swal.fire({
                    icon: 'warning',
                    title: 'Terlalu Banyak Gambar',
                    text: 'Maksimal hanya boleh mengupload 5 gambar.',
                    confirmButtonColor: '#b45309'
                });
                this.value = ''; 

                container.innerHTML = '<div class="col-span-3 text-center text-xs text-red-500 py-4">Pilihan dibatalkan (Melebihi batas)</div>';
                return;
            }

            container.innerHTML = ''; 

            Array.from(files).forEach(file => {
                const reader = new FileReader();
                reader.onload = function (e) {
                    const div = document.createElement('div');
                    div.className = "relative aspect-square rounded-lg overflow-hidden border border-gray-200";
                    div.innerHTML = `<img src="${e.target.result}" class="w-full h-full object-cover">`;
                    container.appendChild(div);
                }
                reader.readAsDataURL(file);
            });
        });
        document.getElementById('editForm').addEventListener('submit', function (e) {
            e.preventDefault();
            Swal.fire({
                title: 'Simpan Perubahan?',
                text: "Data produk akan diperbarui.",
                icon: 'info',
                showCancelButton: true,
                confirmButtonColor: '#b45309',
                cancelButtonColor: '#6b7280',
                confirmButtonText: 'Ya, Update'
            }).then((result) => {
                if (result.isConfirmed) this.submit();
            });
        });
    </script>
@endsection