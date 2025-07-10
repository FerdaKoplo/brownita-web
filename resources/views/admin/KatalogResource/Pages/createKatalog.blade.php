@extends('layout.admin.layout')
@section('title', 'Katalog')
@section('content')
    <div class=" flex gap-10  flex-col justify-center items-center min-h-screen ">
        <h1 class="text-3xl font-bold text-brand-dark">Buat Katalog</h1>
        <div class="flex flex-col items-center max-w-md w-full">
            <div class="bg-brand-dark w-10/12 h-7 rounded-t-xl"></div>
            <form method="POST" id="kategoriForm" class="flex flex-col gap-5 w-full rounded-xl  bg-brand-lightdark p-5"
                action="{{ route('dashboard.admin.katalog.store') }}" enctype="multipart/form-data">
                @csrf

                <div class="flex flex-col gap-2 font-semibold">
                    <h1 class="">Kategori</h1>
                    <select name="category_id" id="category_id" class=" px-4 bg-brand-secondary text-white py-2 rounded-lg">
                        @foreach ($categories as $category)
                            <option class="bg-brand-dark rounded-lg" value="{{ $category->id }}">{{ $category->nama_kategori }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="flex flex-col gap-2 font-semibold">
                    <h1 class="">Nama Produk</h1>
                    <input type="text" id="nama_produk"
                        class="bg-brand-secondary text-white py-2 px-4 resize-none w-full rounded-lg" name="nama_produk">
                </div>

                <div class="flex flex-col gap-2 font-semibold">
                    <h1 class="">Gambar Produk</h1>
                    <input type="file" id="gambar_produk" accept="image/*" multiple name="gambar_produk[]"
                        class="bg-brand-secondary text-white py-2 px-4 resize-none w-full rounded-lg">

                    <div id="preview_gambar" class="flex flex-wrap gap-2 mt-2"></div>
                </div>

                <div class="flex flex-col gap-2 font-semibold">
                    <h1>Deskripsi Produk</h1>
                    <textarea name="deskripsi"
                        class="resize-none w-full px-4 py-2 bg-brand-secondary text-white text-lg rounded-lg"
                        id="deskripsi"></textarea>
                </div>

                <div class="flex flex-col gap-2 font-semibold">
                    <h1 class="">Harga Produk</h1>
                    <input type="text" id="harga_produk" name="harga_tampil"
                        class="bg-brand-secondary text-white py-2 px-4 w-full rounded-lg" placeholder="Rp 100.000">
                    <input type="number" id="harga_hidden" readonly
                        class="bg-brand-secondary hidden text-gray-200 [appearance:textfield] [&::-webkit-outer-spin-button]:appearance-none [&::-webkit-inner-spin-button]:appearance-none py-2 px-4 resize-none w-full rounded-lg"
                        name="harga">
                </div>

                <div class="flex justify-center items-center gap-5">
                    <button type="submit"
                        class="bg-brand-dark font-semibold px-5 py-1 text-brand-light rounded-xl">Buat</button>
                    <a class="  px-5 py-1 bg-black text-brand-light rounded-xl font-semibold"
                        href="{{ route('dashboard.admin.kategori.view') }}">
                        Kembali
                    </a>
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
            const previewContainer = document.getElementById('preview_gambar');
            previewContainer.innerHTML = '';

            const files = e.target.files;

            for (let i = 0; i < files.length; i++) {
                const img = document.createElement('img');
                img.src = URL.createObjectURL(files[i]);
                img.classList.add('h-24', 'w-24', 'object-cover', 'rounded-md', 'bg-white');
                previewContainer.appendChild(img);
            }
        })
    </script>

    {{-- sweetAlert --}}
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
            })
        })
    </script>

@endsection
