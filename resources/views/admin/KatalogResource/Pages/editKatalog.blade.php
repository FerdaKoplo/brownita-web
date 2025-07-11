@extends('layout.admin.layout')
@section('title', 'Edit Katalog')
@section('content')
<style>
    .scrollbar-thin::-webkit-scrollbar {
    height: 6px;
}
.scrollbar-thin::-webkit-scrollbar-thumb {
    background-color: #aaa;
    border-radius: 3px;
}
</style>

    <body>
        <div class="flex gap-10 flex-col justify-center items-center min-h-screen">
            <h1 class="text-3xl font-bold text-brand-dark">Edit Katalog</h1>
            <div class="flex flex-col items-center max-w-md w-full">
                <div class="bg-brand-dark w-10/12 h-7 rounded-t-xl"></div>

                <form method="POST" id="katalogForm" class="flex flex-col gap-5 w-full rounded-xl bg-brand-lightdark p-5"
                    action="{{ route('dashboard.admin.katalog.update', $catalogues->id) }}" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    {{-- Kategori --}}
                    <div class="flex flex-col gap-2 font-semibold">
                        <label for="category_id">Kategori</label>
                        <select name="category_id" id="category_id"
                            class="px-4 bg-brand-secondary text-white py-2 rounded-lg">
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}" {{ $catalogues->category_id == $category->id ? 'selected' : '' }}>
                                    {{ $category->nama_kategori }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    {{-- Nama Produk --}}
                    <div class="flex flex-col gap-2 font-semibold">
                        <label for="nama_produk">Nama Produk</label>
                        <input type="text" id="nama_produk" name="nama_produk"
                            value="{{ old('nama_produk', $catalogues->nama_produk) }}"
                            class="bg-brand-secondary text-white py-2 px-4 rounded-lg">
                        @error('nama_produk')
                            <p class="text-red-500 text-sm">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Gambar Lama --}}
                    @if ($catalogues->images && $catalogues->images->count())
                        <div id="preview_gambar"
                            class="flex gap-2 mt-2 overflow-x-auto max-w-full px-1 scrollbar-thin scrollbar-thumb-gray-400 flex gap-2 overflow-x-auto snap-x snap-mandatory"
                            style="max-height: 120px;">
                            @foreach ($catalogues->images as $image)
                                <div class="relative min-w-[96px]">
                                    <img src="{{ asset('storage/' . $image->gambar_produk) }}"
                                        class="h-24 w-24 object-cover rounded-md bg-white shadow snap-start" />

                                    <button type="button"
                                        onclick="hapusGambar('{{ route('dashboard.admin.katalog.image.delete', $image->id) }}')"
                                        class="absolute top-0 right-0 bg-red-600 text-white text-xs rounded-full w-5 h-5 flex items-center justify-center m-1 z-10">
                                        ×
                                    </button>
                                </div>
                            @endforeach
                        </div>
                    @endif

                    {{-- Upload Gambar Baru --}}
                    <div class="flex flex-col gap-2 font-semibold">
                        <label for="gambar_produk">Gambar Produk (opsional)</label>
                        <input type="file" id="gambar_produk" accept="image/*" name="gambar_produk[]" multiple
                            class="bg-brand-secondary text-white py-2 px-4 rounded-lg">

                        <div id="preview_gambar_baru" class="flex gap-2 mt-2 overflow-x-auto max-w-full px-1"
                            style="max-height: 110px;">
                            <!-- Gambar preview akan muncul di sini -->
                        </div>
                    </div>

                    {{-- Deskripsi --}}
                    <div class="flex flex-col gap-2 font-semibold">
                        <label for="deskripsi">Deskripsi Produk</label>
                        <textarea name="deskripsi" id="deskripsi"
                            class="resize-none w-full px-4 py-2 bg-brand-secondary text-white text-lg rounded-lg">{{ old('deskripsi', $catalogues->deskripsi) }}</textarea>
                    </div>

                    {{-- Status --}}
                    <div class="flex flex-col gap-2 font-semibold">
                        <label for="status">Status Produk</label>
                        <select name="status" id="status"
                            class="w-full px-4 py-2 bg-brand-secondary text-white text-lg rounded-lg">
                            <option value="tersedia" {{ old('status', $catalogues->status) == 'tersedia' ? 'selected' : '' }}>
                                Tersedia</option>
                            <option value="habis" {{ old('status', $catalogues->status) == 'habis' ? 'selected' : '' }}>
                                Stok Habis</option>
                        </select>
                    </div>

                    {{-- Harga --}}
                    <div class="flex flex-col gap-2 font-semibold">
                        <label for="harga_produk">Harga Produk</label>
                        <input type="text" id="harga_produk" name="harga_tampil"
                            value="Rp {{ number_format($catalogues->harga, 0, ',', '.') }}"
                            class="bg-brand-secondary text-white py-2 px-4 w-full rounded-lg" placeholder="Rp 100.000">
                        <input type="number" id="harga_hidden" name="harga" value="{{ $catalogues->harga }}" readonly
                            class="hidden">
                        @error('harga')
                            <p class="text-red-500 text-sm">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Tombol --}}
                    <div class="flex justify-center items-center gap-5">
                        <button type="submit" class="bg-brand-dark font-semibold px-5 py-1 text-brand-light rounded-xl">
                            Simpan Perubahan
                        </button>
                        <a class="px-5 py-1 bg-black text-brand-light rounded-xl font-semibold"
                            href="{{ route('dashboard.admin.katalog.view') }}">
                            Kembali
                        </a>
                    </div>
                </form>
            </div>
        </div>

        {{-- Format Harga --}}
        <script>
            const formatRupiah = (angka) => {
                let number_string = angka.replace(/[^,\d]/g, '').toString(),
                    split = number_string.split(','),
                    sisa = split[0].length % 3,
                    rupiah = split[0].substr(0, sisa),
                    ribuan = split[0].substr(sisa).match(/\d{3}/gi);

                if (ribuan) {
                    const separator = sisa ? '.' : '';
                    rupiah += separator + ribuan.join('.');
                }

                return split[1] !== undefined ? rupiah + ',' + split[1] : rupiah;
            }

            const hargaInput = document.getElementById('harga_produk');
            const hargaHidden = document.getElementById('harga_hidden');

            hargaInput.addEventListener('keyup', function () {
                const angka = this.value.replace(/[^,\d]/g, '');
                this.value = 'Rp ' + formatRupiah(angka);
                hargaHidden.value = angka.replace(/\./g, '');
            });
        </script>

        {{-- Preview Gambar Baru --}}
        <script>
            document.getElementById('gambar_produk').addEventListener('change', function (e) {
                const preview = document.getElementById('preview_gambar_baru');
                preview.innerHTML = '';

                const files = e.target.files;

                for (let i = 0; i < files.length; i++) {
                    const wrapper = document.createElement('div');
                    wrapper.classList.add('relative');

                    const img = document.createElement('img');
                    img.src = URL.createObjectURL(files[i]);
                    img.classList.add('h-24', 'w-24', 'object-cover', 'rounded-md', 'bg-white', 'shadow');

                    const removeBtn = document.createElement('button');
                    removeBtn.type = 'button';
                    removeBtn.textContent = '×';
                    removeBtn.classList.add('absolute', 'top-0', 'right-0', 'bg-red-600', 'text-white', 'text-xs', 'rounded-full', 'w-5', 'h-5', 'flex', 'items-center', 'justify-center', 'm-1');
                    removeBtn.onclick = () => wrapper.remove();

                    wrapper.appendChild(img);
                    wrapper.appendChild(removeBtn);
                    preview.appendChild(wrapper);
                }
            });
        </script>

        {{-- SweetAlert --}}
        <script>
            document.getElementById('katalogForm').addEventListener('submit', function (e) {
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

        <script>
    function hapusGambar(url) {
        Swal.fire({
            title: 'Yakin ingin menghapus gambar ini?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#aaa',
            confirmButtonText: 'Ya, hapus!'
        }).then((result) => {
            if (result.isConfirmed) {
                // Buat form dummy
                const form = document.createElement('form');
                form.method = 'POST';
                form.action = url;

                const methodInput = document.createElement('input');
                methodInput.name = '_method';
                methodInput.value = 'DELETE';
                methodInput.type = 'hidden';

                const csrfInput = document.createElement('input');
                csrfInput.name = '_token';
                csrfInput.value = '{{ csrf_token() }}';
                csrfInput.type = 'hidden';

                form.appendChild(methodInput);
                form.appendChild(csrfInput);
                document.body.appendChild(form);
                form.submit();
            }
        });
    }
</script>

    </body>
@endsection