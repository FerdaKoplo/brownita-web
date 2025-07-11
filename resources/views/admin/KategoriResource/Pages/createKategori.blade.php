@extends('layout.admin.layout')
@section('title', 'Kategori')
@section('content')

<body>
    <div class=" flex gap-10  flex-col justify-center items-center min-h-screen ">
        <h1 class="text-3xl font-bold text-brand-dark">Buat Kategori</h1>
        <div class="flex flex-col items-center max-w-md w-full">
            <div class="bg-brand-dark w-10/12 h-7 rounded-t-xl"></div>
            <form method="POST" id="kategoriForm" class="flex flex-col gap-5 w-full rounded-xl  bg-brand-lightdark p-5"
                action="{{ route('dashboard.admin.kategori.store') }}">
                @csrf
                <div class="flex flex-col gap-2 font-semibold">
                    <h1 class="">Nama Kategori</h1>
                    <input type="text" id="nama_kategori"
                        class="bg-brand-secondary text-white py-2 px-4 resize-none w-full rounded-lg"
                        name="nama_kategori">
                    @error('nama_kategori')
                        <p class="text-red-500 text-sm">{{ $message }}</p>
                    @enderror
                </div>

                <div class="flex flex-col gap-2 font-semibold">
                    <h1>Deskripsi Kategori</h1>
                    <textarea name="deskripsi_kategori"
                        class="resize-none w-full px-4 py-2 bg-brand-secondary text-white text-lg rounded-lg"
                        id="deskripsi_kategori"></textarea>
                    @error('deskripsi_kategori')
                        <p class="text-red-500 text-sm">{{ $message }}</p>
                    @enderror

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

</body>