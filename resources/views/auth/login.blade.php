<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Login - Brownita</title>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css" />
    @vite('resources/css/app.css')
    
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
    </style>
</head>

<body class="bg-gray-50 h-screen flex flex-col">
    
    {{-- Navigation --}}
    <div class="fixed top-0 w-full z-50">
        @if (Auth::check())
            @include('components.customer.logged-in.nav')
        @else
            @include('components.customer.logged-out.nav')
        @endif
    </div>

    <div class="flex-1 flex items-center justify-center p-4 sm:p-8 mt-16 md:mt-0">
        <div class="bg-white rounded-3xl shadow-2xl overflow-hidden max-w-5xl w-full flex flex-col md:flex-row min-h-[600px]">
            
            {{-- <div class="relative w-full md:w-1/2 bg-amber-900 flex flex-col justify-center items-center text-center p-10 overflow-hidden group">
                <div class="absolute inset-0 bg-[url('https://images.unsplash.com/photo-1606313564200-e75d5e30476d?q=80&w=1000&auto=format&fit=crop')] bg-cover bg-center opacity-40 group-hover:scale-105 transition-transform duration-1000"></div>
                <div class="absolute inset-0 bg-gradient-to-t from-amber-950/90 to-amber-900/60"></div>
                
                <div class="relative z-10 flex flex-col items-center">
                    <div class="bg-white p-2 rounded-2xl shadow-lg mb-6 rotate-3 hover:rotate-0 transition-transform duration-300">
                        <img src="images/brownitaLogo.png" alt="Brownita Logo" class="h-32 w-auto" />
                    </div>
                    <h2 class="text-3xl font-bold text-white mb-2">Selamat Datang!</h2>
                    <p class="text-amber-100 text-sm max-w-xs leading-relaxed">
                        Rasakan kelezatan brownies premium Brownita. Login untuk melanjutkan pesanan Anda.
                    </p>
                </div>
            </div> --}}

            <div
                class="relative w-full md:w-5/12 bg-amber-900 flex flex-col justify-center items-center text-center p-10 overflow-hidden group">
                <div
                    class="absolute inset-0 bg-cover bg-center opacity-40 group-hover:scale-105 transition-transform duration-1000">
                    <img src="images/bundt-cakes.png" class="w-full h-full object-cover" alt="">
                </div>
                <div class="absolute inset-0 bg-gradient-to-b from-amber-950/80 to-amber-900/60"></div>

                <div class="relative z-10 flex flex-col items-center">
                    <div
                        class="bg-white p-2 rounded-2xl shadow-lg mb-6 rotate-3 hover:rotate-0 transition-transform duration-300">
                        <img src="images/brownitaLogo.png" alt="Brownita Logo" class="h-32 w-auto" />
                    </div>
                    <h2 class="text-3xl font-bold text-white mb-2">Selamat Datang!</h2>
                    <p class="text-amber-100 text-sm max-w-xs leading-relaxed mb-6">
                        Rasakan kelezatan brownies premium Brownita. Login untuk melanjutkan pesanan Anda.
                    </p>
                    <a href="{{ route('register') }}"
                        class="px-6 py-2 border-2 border-white/30 hover:bg-white hover:text-amber-900 text-white rounded-full text-sm font-semibold transition-all">
                        Belum punya akun?
                    </a>
                </div>
            </div>

            <div class="w-full md:w-1/2 p-8 md:p-12 lg:p-16 flex flex-col justify-center bg-white">
                <div class="mb-8">
                    <h1 class="text-3xl font-bold text-gray-900">Sign In</h1>
                    <p class="text-gray-500 text-sm mt-1">Masukan email dan password Anda untuk masuk.</p>
                </div>

                <form method="POST" action="{{ route('login.post') }}" autocomplete="off" class="space-y-6">
                    @csrf

                    <div>
                        <label for="email" class="block text-sm font-semibold text-gray-700 mb-2">Email Address</label>
                        <div class="relative">
                            <i class="fa-solid fa-envelope absolute left-4 top-1/2 -translate-y-1/2 text-gray-400 text-lg"></i>
                            <input type="email" id="email" name="email" placeholder="nama@email.com"
                                class="w-full pl-12 pr-4 py-3 rounded-xl border border-gray-200 bg-gray-50 text-gray-800 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-amber-500 focus:border-transparent transition-all" />
                        </div>
                    </div>

                    <div>
                        <div class="flex justify-between items-center mb-2">
                            <label for="password" class="block text-sm font-semibold text-gray-700">Password</label>
                            {{-- <a href="#" class="text-xs text-amber-600 hover:text-amber-700 font-semibold">Lupa Password?</a> --}}
                        </div>
                        <div class="relative">
                            <i class="fa-solid fa-lock absolute left-4 top-1/2 -translate-y-1/2 text-gray-400 text-lg"></i>
                            <input type="password" id="password" name="password" placeholder="••••••••"
                                class="w-full pl-12 pr-12 py-3 rounded-xl border border-gray-200 bg-gray-50 text-gray-800 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-amber-500 focus:border-transparent transition-all" />
                            
                            <button type="button" id="toggle-password" 
                                class="absolute right-4 top-1/2 -translate-y-1/2 text-gray-400 hover:text-amber-600 transition focus:outline-none">
                                <i class="fa-solid fa-eye-slash text-lg"></i>
                            </button>
                        </div>
                    </div>

                    <button type="submit"
                        class="w-full bg-gradient-to-r from-amber-700 to-amber-600 hover:from-amber-800 hover:to-amber-700 text-white font-bold py-3.5 rounded-xl shadow-lg shadow-amber-900/20 transform transition hover:-translate-y-0.5 focus:ring-4 focus:ring-amber-500/30">
                        Masuk Sekarang
                    </button>
                </form>

                <div class="mt-8 pt-6 border-t border-gray-100 text-center">
                    <p class="text-gray-500 text-sm">
                        Belum punya akun? 
                        <a href="{{ route('register') }}" class="font-bold text-amber-700 hover:text-amber-800 hover:underline transition">
                            Daftar Disini
                        </a>
                    </p>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        const toggleBtn = document.getElementById('toggle-password');
        const passwordInput = document.getElementById('password');
        const icon = toggleBtn.querySelector('i');

        toggleBtn.addEventListener('click', () => {
            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                icon.classList.replace('fa-eye-slash', 'fa-eye');
            } else {
                passwordInput.type = 'password';
                icon.classList.replace('fa-eye', 'fa-eye-slash');
            }
        });

        @if(session('success'))
            Swal.fire({
                icon: 'success',
                title: 'Berhasil!',
                text: '{{ session('success') }}',
                confirmButtonColor: '#b45309',
                timer: 3000
            });
        @elseif(session('fail'))
            Swal.fire({
                icon: 'error',
                title: 'Gagal Masuk',
                text: '{{ session('fail') }}',
                confirmButtonColor: '#b45309'
            });
        @endif
    </script>
</body>
</html>