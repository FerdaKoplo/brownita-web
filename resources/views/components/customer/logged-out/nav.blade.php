<nav class="fixed top-0 w-full z-50 bg-white/95 backdrop-blur-md shadow-sm border-b border-gray-100 transition-all duration-300"
    id="navbar">
    <div class="max-w-7xl mx-auto px-4 md:px-8 lg:px-12">
        <div class="flex justify-between items-center h-20">

            <a href="{{ route('landing.page') }}" class="flex-shrink-0 flex items-center gap-2">
                <img src="{{ asset('images/brownitaLogo.png') }}" class="h-10 w-auto rounded-lg" alt="Brownita Logo" />
            </a>

            <div class="hidden md:flex items-center space-x-8">
                <a href="{{ route('landing.page') }}"
                    class="text-sm font-medium transition-colors hover:text-amber-700 {{ request()->routeIs('landing.page') ? 'text-amber-700 font-bold' : 'text-gray-600' }}">
                    Beranda
                </a>
                <a href="{{ route('syarat-ketentuan') }}"
                    class="text-sm font-medium transition-colors hover:text-amber-700 {{ request()->routeIs('syarat-ketentuan*') ? 'text-amber-700 font-bold' : 'text-gray-600' }}">
                    Syarat & Ketentuan
                </a>
                <a href="{{ route('produk-kami') }}"
                    class="text-sm font-medium transition-colors hover:text-amber-700 {{ request()->routeIs('produk-kami') ? 'text-amber-700 font-bold' : 'text-gray-600' }}">
                    Menu Kami
                </a>
            </div>

            <div class="hidden md:flex items-center gap-4">
                <a href="{{ route('login') }}"
                    class="text-sm font-semibold text-amber-700 hover:text-amber-800 transition px-4 py-2">
                    Masuk
                </a>
                <a href="{{ route('register') }}"
                    class="text-sm font-bold text-white bg-amber-700 hover:bg-amber-800 px-5 py-2.5 rounded-full shadow-md shadow-amber-900/10 transition transform hover:-translate-y-0.5">
                    Daftar Sekarang
                </a>
            </div>

            <button id="menuButtonOut"
                class="md:hidden p-2 text-gray-600 hover:text-amber-700 focus:outline-none transition">
                <i class="fa-solid fa-bars text-2xl"></i>
            </button>
        </div>
    </div>

    <div id="mobileMenuOut"
        class="md:hidden absolute top-20 left-0 w-full bg-white border-b border-gray-100 shadow-xl transform -translate-y-[150%] transition-transform duration-300 ease-in-out z-40">
        <div class="px-6 py-6 space-y-4">
            <a href="{{ route('landing.page') }}"
                class="block text-base font-medium text-gray-700 hover:text-amber-700">Beranda</a>
            <a href="{{ route('syarat-ketentuan') }}"
                class="block text-base font-medium text-gray-700 hover:text-amber-700">Syarat & Ketentuan</a>
            <a href="{{ route('produk-kami') }}"
                class="block text-base font-medium text-gray-700 hover:text-amber-700">Menu Kami</a>

            <div class="border-t border-gray-100 my-4 pt-6 flex flex-col gap-3">
                <a href="{{ route('login') }}"
                    class="block w-full text-center border-2 border-amber-700 text-amber-700 font-bold py-2.5 rounded-xl hover:bg-amber-50 transition">
                    Masuk
                </a>
                <a href="{{ route('register') }}"
                    class="block w-full text-center bg-amber-700 text-white font-bold py-3 rounded-xl hover:bg-amber-800 shadow-lg transition">
                    Daftar Akun
                </a>
            </div>
        </div>
    </div>
</nav>

<script>
    const menuBtnOut = document.getElementById('menuButtonOut');
    const mobileMenuOut = document.getElementById('mobileMenuOut');
    let isMenuOpenOut = false;

    menuBtnOut.addEventListener('click', () => {
        isMenuOpenOut = !isMenuOpenOut;
        if (isMenuOpenOut) {
            mobileMenuOut.classList.remove('-translate-y-[150%]');
            menuBtnOut.innerHTML = '<i class="fa-solid fa-xmark text-2xl"></i>';
        } else {
            mobileMenuOut.classList.add('-translate-y-[150%]');
            menuBtnOut.innerHTML = '<i class="fa-solid fa-bars text-2xl"></i>';
        }
    });
</script>