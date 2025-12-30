<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Register - Brownita</title>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap"
        rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css" />
    @vite('resources/css/app.css')

    <style>
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
        }
    </style>
</head>

<body class="bg-gray-50 min-h-screen flex flex-col">

    <div class="fixed top-0 w-full z-50">
        @if (Auth::check())
            @include('components.customer.logged-in.nav')
        @else
            @include('components.customer.logged-out.nav')
        @endif
    </div>

    <div class="flex-1 flex items-center justify-center p-4 sm:p-8 mt-20 mb-10">
        <div
            class="bg-white rounded-3xl shadow-2xl overflow-hidden max-w-5xl w-full flex flex-col md:flex-row-reverse min-h-[650px]">

            <div
                class="relative w-full md:w-5/12 bg-amber-900 flex flex-col justify-center items-center text-center p-10 overflow-hidden group">
                <div
                    class="absolute inset-0 bg-cover bg-center opacity-40 group-hover:scale-105 transition-transform duration-1000">
                    <img src="images/cake-boxes.png" class="w-full h-full object-cover" alt="">
                </div>
                <div class="absolute inset-0 bg-gradient-to-b from-amber-950/80 to-amber-900/60"></div>

                <div class="relative z-10 flex flex-col items-center">
                    <div
                        class="bg-white p-2 rounded-2xl shadow-lg mb-6 rotate-3 hover:rotate-0 transition-transform duration-300">
                        <img src="images/brownitaLogo.png" alt="Brownita Logo" class="h-32 w-auto" />
                    </div>
                    <h2 class="text-3xl font-bold text-white mb-2">Join Our Family</h2>
                    <p class="text-amber-100 text-sm max-w-xs leading-relaxed mb-6">
                        Daftar sekarang untuk menikmati kemudahan pemesanan dan promo eksklusif dari Brownita.
                    </p>
                    <a href="{{ route('login') }}"
                        class="px-6 py-2 border-2 border-white/30 hover:bg-white hover:text-amber-900 text-white rounded-full text-sm font-semibold transition-all">
                        Sudah punya akun?
                    </a>
                </div>
            </div>

            <div class="w-full md:w-7/12 p-8 md:p-12 bg-white">
                <div class="mb-6">
                    <h1 class="text-3xl font-bold text-gray-900">Buat Akun Baru</h1>
                    <p class="text-gray-500 text-sm mt-1">Lengkapi data diri Anda di bawah ini.</p>
                </div>

                <form method="POST" action="{{ route('register.post') }}" autocomplete="off" class="space-y-5">
                    @csrf

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                        <div>
                            <label class="block text-xs font-bold text-gray-500 uppercase mb-2">Username</label>
                            <div class="relative">
                                <i class="fa-solid fa-user absolute left-4 top-1/2 -translate-y-1/2 text-gray-400"></i>
                                <input type="text" name="name" placeholder="John Doe"
                                    class="w-full pl-10 pr-4 py-2.5 rounded-xl border border-gray-200 bg-gray-50 text-sm focus:ring-2 focus:ring-amber-500 focus:border-transparent outline-none transition" />
                            </div>
                        </div>

                        <div>
                            <label class="block text-xs font-bold text-gray-500 uppercase mb-2">No. WhatsApp</label>
                            <div class="relative">
                                <i class="fa-solid fa-phone absolute left-4 top-1/2 -translate-y-1/2 text-gray-400"></i>
                                <input type="tel" name="no_handphone" placeholder="0812..."
                                    class="w-full pl-10 pr-4 py-2.5 rounded-xl border border-gray-200 bg-gray-50 text-sm focus:ring-2 focus:ring-amber-500 focus:border-transparent outline-none transition" />
                            </div>
                        </div>
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-gray-500 uppercase mb-2">Email Address</label>
                        <div class="relative">
                            <i class="fa-solid fa-envelope absolute left-4 top-1/2 -translate-y-1/2 text-gray-400"></i>
                            <input type="email" name="email" placeholder="nama@email.com"
                                class="w-full pl-10 pr-4 py-2.5 rounded-xl border border-gray-200 bg-gray-50 text-sm focus:ring-2 focus:ring-amber-500 focus:border-transparent outline-none transition" />
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                        <div>
                            <label class="block text-xs font-bold text-gray-500 uppercase mb-2">Password</label>
                            <div class="relative">
                                <i class="fa-solid fa-lock absolute left-4 top-1/2 -translate-y-1/2 text-gray-400"></i>
                                <input type="password" id="password" name="password" placeholder="••••••••"
                                    class="w-full pl-10 pr-10 py-2.5 rounded-xl border border-gray-200 bg-gray-50 text-sm focus:ring-2 focus:ring-amber-500 focus:border-transparent outline-none transition" />
                                <button type="button" onclick="toggleVisibility('password', this)"
                                    class="absolute right-3 top-1/2 -translate-y-1/2 text-gray-400 hover:text-amber-600">
                                    <i class="fa-solid fa-eye-slash"></i>
                                </button>
                            </div>
                        </div>
                        <div>
                            <label class="block text-xs font-bold text-gray-500 uppercase mb-2">Confirm Password</label>
                            <div class="relative">
                                <i
                                    class="fa-solid fa-check-circle absolute left-4 top-1/2 -translate-y-1/2 text-gray-400"></i>
                                <input type="password" id="password_confirmation" name="password_confirmation"
                                    placeholder="••••••••"
                                    class="w-full pl-10 pr-10 py-2.5 rounded-xl border border-gray-200 bg-gray-50 text-sm focus:ring-2 focus:ring-amber-500 focus:border-transparent outline-none transition" />
                                <button type="button" onclick="toggleVisibility('password_confirmation', this)"
                                    class="absolute right-3 top-1/2 -translate-y-1/2 text-gray-400 hover:text-amber-600">
                                    <i class="fa-solid fa-eye-slash"></i>
                                </button>
                            </div>
                        </div>
                    </div>

                    {{-- <div class="flex items-center gap-2">
                        <input type="checkbox" required
                            class="rounded border-gray-300 text-amber-600 focus:ring-amber-600 w-4 h-4">
                        <span class="text-xs text-gray-500">Saya menyetujui <a href="#"
                                class="text-amber-600 hover:underline">Syarat & Ketentuan</a> Brownita.</span>
                    </div> --}}

                    <button type="submit"
                        class="w-full bg-amber-700 hover:bg-amber-800 text-white font-bold py-3.5 rounded-xl shadow-lg shadow-amber-900/10 transform transition hover:-translate-y-0.5 focus:ring-4 focus:ring-amber-500/30">
                        Daftar Sekarang
                    </button>
                </form>

                <div class="mt-6 text-center md:hidden">
                    <p class="text-gray-500 text-sm">
                        Sudah punya akun?
                        <a href="{{ route('login') }}" class="font-bold text-amber-700 hover:underline">Login Disini</a>
                    </p>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        function toggleVisibility(inputId, btn) {
            const input = document.getElementById(inputId);
            const icon = btn.querySelector('i');
            if (input.type === 'password') {
                input.type = 'text';
                icon.classList.replace('fa-eye-slash', 'fa-eye');
            } else {
                input.type = 'password';
                icon.classList.replace('fa-eye', 'fa-eye-slash');
            }
        }

        @if(session('success'))
            Swal.fire({
                icon: 'success',
                title: 'Registrasi Berhasil!',
                text: '{{ session('success') }}',
                confirmButtonColor: '#b45309',
                timer: 3000
            });
        @elseif ($errors->any())
            Swal.fire({
                icon: 'error',
                title: 'Gagal Registrasi',
                html: `{!! implode('<br>', $errors->all()) !!}`,
                confirmButtonColor: '#b45309'
            });
        @endif
    </script>
</body>

</html>