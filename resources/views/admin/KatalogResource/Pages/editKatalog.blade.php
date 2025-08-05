@extends('layout.admin.layout')
@section('title', 'Katalog')
@section('content')
    <div class="flex justify-center items-center min-h-screen bg-gray-50 px-4">
        <div class="bg-white shadow-xl rounded-2xl p-8 w-full max-w-2xl">
            <h1 class="text-2xl font-semibold text-gray-800 mb-6 text-center">Edit Katalog</h1>
            <form method="POST" action="{{ route('dashboard.admin.katalog.update', $catalogues->id) }}"
                enctype="multipart/form-data" id="kategoriForm" class="space-y-6">
                @csrf
                @method('PUT')

                <!-- Kategori -->
                <div>
                    <label for="category_id" class="block text-sm font-medium text-gray-700">Kategori</label>
                    <select name="category_id" id="category_id"
                        class="mt-1 block w-full bg-gray-100 border border-gray-300 rounded-lg py-2 px-3 text-gray-800 focus:outline-none focus:ring-2 focus:ring-amber-700">
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}" {{ $catalogues->category_id == $category->id ? 'selected' : '' }}>
                                {{ $category->nama_kategori }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <!-- Nama Produk -->
                <div>
                    <label for="nama_produk" class="block text-sm font-medium text-gray-700">Nama Produk</label>
                    <input type="text" id="nama_produk" name="nama_produk"
                        value="{{ old('nama_produk', $catalogues->nama_produk) }}"
                        class="mt-1 block w-full bg-gray-100 border border-gray-300 rounded-lg py-2 px-3 text-gray-800 focus:ring-2 focus:ring-amber-700 focus:outline-none">
                </div>

                <!-- Gambar Produk -->
                <div>
                    <label for="gambar_produk" class="block text-sm font-medium text-gray-700">Gambar Produk</label>
                    <input type="file" id="gambar_produk" name="gambar_produk[]" multiple accept="image/*"
                        class="mt-1 block w-full bg-white border border-gray-300 rounded-lg py-2 px-3 text-gray-800 file:bg-amber-700 file:text-white file:rounded-md file:border-0 file:px-4 file:py-2">
                    <div id="preview_gambar" class="flex gap-2 mt-2 flex-wrap">
                        @if ($catalogues->gambar_produk && $catalogues->gambar_produk !== 'null')
                            <img src="{{ asset('storage/' . $catalogues->gambar_produk) }}" alt="Preview"
                                class="h-24 w-24 object-cover rounded-md bg-white">
                        @endif
                    </div>
                </div>

                <!-- Deskripsi -->
                <div>
                    <label for="deskripsi" class="block text-sm font-medium text-gray-700">Deskripsi Produk</label>
                    <textarea id="deskripsi" name="deskripsi" rows="4"
                        class="mt-1 block w-full bg-gray-100 border border-gray-300 rounded-lg py-2 px-3 text-gray-800 focus:ring-2 focus:ring-amber-700 focus:outline-none">{{ old('deskripsi', $catalogues->deskripsi) }}</textarea>
                </div>

                <!-- Status Produk -->
                <div>
                    <label for="status" class="block text-sm font-medium text-gray-700">Status Produk</label>
                    <select name="status" id="status"
                        class="mt-1 block w-full bg-gray-100 border border-gray-300 rounded-lg py-2 px-3 text-gray-800 focus:outline-none focus:ring-2 focus:ring-amber-700">
                        <option value="tersedia" {{ old('status', $catalogues->status) == 'tersedia' ? 'selected' : '' }}>
                            Tersedia</option>
                        <option value="habis" {{ old('status', $catalogues->status) == 'habis' ? 'selected' : '' }}>Stok Habis
                        </option>
                    </select>
                </div>

                <!-- Harga Produk -->
                <div>
                    <label for="harga_produk" class="block text-sm font-medium text-gray-700">Harga Produk</label>
                    <input type="text" id="harga_produk" name="harga_tampil"
                        value="Rp {{ number_format($catalogues->harga, 0, ',', '.') }}"
                        class="mt-1 block w-full bg-gray-100 border focus:ring-2 focus:ring-amber-700 border-gray-300 rounded-lg py-2 px-3 text-gray-800">
                    <input type="number" id="harga_hidden" readonly name="harga" value="{{ $catalogues->harga }}"
                        class="hidden">
                </div>

                <!-- Aksi -->
                <div class="flex justify-between">
                    <a href="{{ route('dashboard.admin.katalog.view') }}"
                        class="inline-block px-6 py-2 border border-gray-400 rounded-lg text-gray-700 duration-300 hover:bg-gray-100">
                        Kembali
                    </a>
                    <button type="submit"
                        class="px-6 py-2 bg-amber-700 text-white font-semibold rounded-lg hover:bg-amber-700/80 duration-300">
                        Simpan Perubahan
                    </button>
                </div>
            </form>
        </div>
    </div>

    {{-- helper convert rupiah --}}
    <script>
        const formatRupiah = (angka) => {
            let number_string = angka.replace(/[^,\d]/g, '').toString(),
                split = number_string.split(','),
                sisa = split[0].length % 3,
                rupiah = split[0].substr(0, sisa),
                ribuan = split[0].substr(sisa).match(/\d{3}/gi)

            if (ribuan) {
                const separator = sisa ? '.' : ''
                rupiah += separator + ribuan.join('.')
            }

            return split[1] !== undefined ? rupiah + ',' + split[1] : rupiah
        }

        const hargaInput = document.getElementById('harga_produk')
        const hargaHidden = document.getElementById('harga_hidden')

        hargaInput.addEventListener('keyup', function (e) {
            const angka = this.value.replace(/[^,\d]/g, '').toString()
            this.value = 'Rp ' + formatRupiah(angka)
            hargaHidden.value = angka.replace(/\./g, '')
        })
    </script>

    {{-- preview product picture before submit --}}
    <script>
        document.getElementById('gambar_produk').addEventListener('change', function (e) {
            const previewContainer = document.getElementById('preview_gambar')
            previewContainer.innerHTML = ''

            const files = e.target.files

            for (let i = 0; i < files.length; i++) {
                const img = document.createElement('img')
                img.src = URL.createObjectURL(files[i])
                img.classList.add('h-24', 'w-24', 'object-cover', 'rounded-md', 'bg-white')
                previewContainer.appendChild(img)
            }
        })
    </script>

    {{-- sweetAlert --}}
    <script>
        document.getElementById('kategoriForm').addEventListener('submit', function (e) {
            e.preventDefault()
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
                    e.target.submit()
                }
            })
        })
    </script>
@endsection
