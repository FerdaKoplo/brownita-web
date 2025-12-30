@extends('layout.admin.layout')
@section('title', 'Buat Akun Admin')

@section('content')
    <div class="p-6 bg-gray-50 min-h-screen flex justify-center">
        <div class="w-full max-w-5xl">

            <div class="mb-6">
                <h1 class="text-3xl font-bold text-gray-900 tracking-tight">Buat Akun Admin</h1>
                <p class="text-gray-500 text-sm mt-1">Tambahkan administrator baru untuk mengelola sistem.</p>
            </div>

            <form method="POST" action="{{ route('dashboard.admin.akun.store') }}" id="akunAdminForm">
                @csrf

                <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

                    <div class="lg:col-span-2 space-y-6">
                        <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-200">
                            <h2 class="text-lg font-bold text-gray-800 mb-4 border-b border-gray-100 pb-2">Profil & Keamanan
                            </h2>

                            <div class="space-y-4">
                                <div>
                                    <label for="name" class="block text-xs font-semibold text-gray-500 uppercase mb-1">Nama
                                        Lengkap</label>
                                    <input type="text" id="name" name="name" value="{{ old('name') }}"
                                        placeholder="Contoh: Budi Santoso"
                                        class="w-full px-4 py-2.5 rounded-lg border border-gray-300 focus:ring-2 focus:ring-amber-500 focus:border-amber-500 transition-all text-sm @error('name') border-red-500 bg-red-50 @enderror">
                                    @error('name') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                                </div>

                                <div>
                                    <label for="email"
                                        class="block text-xs font-semibold text-gray-500 uppercase mb-1">Email
                                        Address</label>
                                    <input type="email" id="email" name="email" value="{{ old('email') }}"
                                        placeholder="admin@brownita.com"
                                        class="w-full px-4 py-2.5 rounded-lg border border-gray-300 focus:ring-2 focus:ring-amber-500 focus:border-amber-500 transition-all text-sm @error('email') border-red-500 bg-red-50 @enderror">
                                    @error('email') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                                </div>

                                <div>
                                    <label for="no_handphone"
                                        class="block text-xs font-semibold text-gray-500 uppercase mb-1">No.
                                        WhatsApp</label>
                                    <input type="tel" id="no_handphone" name="no_handphone"
                                        value="{{ old('no_handphone') }}" placeholder="0812..."
                                        class="w-full px-4 py-2.5 rounded-lg border border-gray-300 focus:ring-2 focus:ring-amber-500 focus:border-amber-500 transition-all text-sm @error('no_handphone') border-red-500 bg-red-50 @enderror">
                                    @error('no_handphone') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                                </div>

                                <div class="border-t border-gray-100 my-4"></div>

                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                    <div>
                                        <label for="password"
                                            class="block text-xs font-semibold text-gray-500 uppercase mb-1">Password</label>
                                        <div class="relative">
                                            <input type="password" id="password" name="password" placeholder="••••••••"
                                                class="w-full px-4 py-2.5 rounded-lg border border-gray-300 focus:ring-2 focus:ring-amber-500 focus:border-amber-500 transition-all text-sm">
                                            <button type="button" onclick="togglePassword('password')"
                                                class="absolute right-3 top-1/2 -translate-y-1/2 text-gray-400 hover:text-amber-600 transition">
                                                <i class="fa-solid fa-eye"></i>
                                            </button>
                                        </div>
                                        @error('password') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                                    </div>

                                    <div>
                                        <label for="password_confirmation"
                                            class="block text-xs font-semibold text-gray-500 uppercase mb-1">Konfirmasi
                                            Password</label>
                                        <div class="relative">
                                            <input type="password" id="password_confirmation" name="password_confirmation"
                                                placeholder="••••••••"
                                                class="w-full px-4 py-2.5 rounded-lg border border-gray-300 focus:ring-2 focus:ring-amber-500 focus:border-amber-500 transition-all text-sm">
                                            <button type="button" onclick="togglePassword('password_confirmation')"
                                                class="absolute right-3 top-1/2 -translate-y-1/2 text-gray-400 hover:text-amber-600 transition">
                                                <i class="fa-solid fa-eye"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="space-y-6">
                        <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-200">
                            <h2 class="text-lg font-bold text-gray-800 mb-4 border-b border-gray-100 pb-2">Aksi</h2>

                            <div class="flex flex-col gap-3">
                                <button type="submit"
                                    class="w-full bg-amber-700 hover:bg-amber-800 text-white font-bold py-3 rounded-xl shadow-lg shadow-amber-900/10 transition-all hover:-translate-y-0.5 flex items-center justify-center gap-2">
                                    <i class="fa-solid fa-user-plus"></i> Buat Akun
                                </button>
                                <a href="{{ route('dashboard.admin.akun.view') }}"
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
        function togglePassword(id) {
            const input = document.getElementById(id);
            const icon = event.currentTarget.querySelector('i');
            if (input.type === "password") {
                input.type = "text";
                icon.classList.replace("fa-eye", "fa-eye-slash");
            } else {
                input.type = "password";
                icon.classList.replace("fa-eye-slash", "fa-eye");
            }
        }

        document.getElementById('akunAdminForm').addEventListener('submit', function (e) {
            e.preventDefault();
            Swal.fire({
                title: 'Buat Akun?',
                text: "Pastikan data admin sudah benar.",
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#b45309',
                cancelButtonColor: '#6b7280',
                confirmButtonText: 'Ya, Buat',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) this.submit();
            });
        });
    </script>
@endsection