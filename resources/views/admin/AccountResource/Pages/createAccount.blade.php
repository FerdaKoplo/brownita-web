@extends('layout.admin.layout')
@section('title', 'Akun Admin')
@section('content')
    <div class="flex justify-center items-center min-h-screen bg-gray-50 px-4">
        <div class="bg-white shadow-xl rounded-2xl p-8 w-full max-w-2xl">
            <h1 class="text-2xl font-semibold text-gray-800 mb-6 text-center">Buat Akun Admin</h1>
            <form method="POST" action="{{ route('dashboard.admin.akun.store') }}" id="akunAdminForm" class="space-y-6">
                @csrf

                <!-- Nama Lengkap -->
                <div>
                    <label for="name" class="block text-sm font-medium text-gray-700">Nama Lengkap</label>
                    <input type="text" id="name" name="name" required
                        class="mt-1 block w-full bg-gray-100 border border-gray-300 rounded-lg py-2 px-3 text-gray-800 focus:ring-2 focus:ring-amber-700 focus:outline-none">
                </div>

                <!-- Email -->
                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                    <input type="email" id="email" name="email" required
                        class="mt-1 block w-full bg-gray-100 border border-gray-300 rounded-lg py-2 px-3 text-gray-800 focus:ring-2 focus:ring-amber-700 focus:outline-none">
                </div>

                {{-- no Handphone --}}

                <div>
                    <label for="no_handphone" class="block text-sm font-medium text-gray-700">No Handphone</label>
                    <input type="no_handphone" id="no_handphone" name="no_handphone" required
                        class="mt-1 block w-full bg-gray-100 border border-gray-300 rounded-lg py-2 px-3 text-gray-800 focus:ring-2 focus:ring-amber-700 focus:outline-none">
                </div>

                <!-- Password -->
                <div>
                    <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                    <input type="password" id="password" name="password" required
                        class="mt-1 block w-full bg-gray-100 border border-gray-300 rounded-lg py-2 px-3 text-gray-800 focus:ring-2 focus:ring-amber-700 focus:outline-none">
                </div>

                <!-- Konfirmasi Password -->
                <div>
                    <label for="password_confirmation" class="block text-sm font-medium text-gray-700">Konfirmasi
                        Password</label>
                    <input type="password" id="password_confirmation" name="password_confirmation" required
                        class="mt-1 block w-full bg-gray-100 border border-gray-300 rounded-lg py-2 px-3 text-gray-800 focus:ring-2 focus:ring-amber-700 focus:outline-none">
                </div>

                <!-- Aksi -->
                <div class="flex justify-between">
                    <a href="{{ route('dashboard.admin.akun.view') }}"
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
        document.getElementById('akunAdminForm').addEventListener('submit', function (e) {
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
