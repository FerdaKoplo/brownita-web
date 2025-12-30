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

            <div class="hidden md:flex items-center gap-6">
                <a href="{{ route('keranjang') }}" class="relative group p-2 rounded-full hover:bg-amber-50 transition">
                    <i
                        class="fa-solid fa-cart-shopping text-gray-600 group-hover:text-amber-700 text-lg transition"></i>
                    @if(isset($keranjangCount) && $keranjangCount > 0)
                        <span
                            class="absolute top-0 right-0 bg-amber-600 text-white text-[10px] font-bold px-1.5 py-0.5 rounded-full ring-2 ring-white shadow-sm">
                            {{ $keranjangCount }}
                        </span>
                    @endif
                </a>

                <a href="{{ route('customer.transaksi.index') }}"
                    class="group p-2 rounded-full hover:bg-amber-50 transition" title="Riwayat Pesanan">
                    <i
                        class="fa-solid fa-clock-rotate-left text-gray-600 group-hover:text-amber-700 text-lg transition"></i>
                </a>

                <div class="h-6 w-px bg-gray-200 mx-1"></div>

                <form action="{{ route('logout.post') }}" method="POST">
                    @csrf
                    <button type="submit"
                        class="flex items-center gap-2 text-sm font-medium text-red-600 hover:text-red-700 transition">
                        <span>Logout</span>
                        <i class="fa-solid fa-arrow-right-from-bracket"></i>
                    </button>
                </form>
            </div>

            <button id="menuButton"
                class="md:hidden p-2 text-gray-600 hover:text-amber-700 focus:outline-none transition">
                <i class="fa-solid fa-bars text-2xl"></i>
            </button>
        </div>
    </div>

    <div id="mobileMenu"
        class="md:hidden absolute top-20 left-0 w-full bg-white border-b border-gray-100 shadow-xl transform -translate-y-[150%] transition-transform duration-300 ease-in-out z-40">
        <div class="px-6 py-6 space-y-4">
            <a href="{{ route('landing.page') }}"
                class="block text-base font-medium text-gray-700 hover:text-amber-700">Beranda</a>
            <a href="{{ route('syarat-ketentuan') }}"
                class="block text-base font-medium text-gray-700 hover:text-amber-700">Syarat & Ketentuan</a>
            <a href="{{ route('produk-kami') }}"
                class="block text-base font-medium text-gray-700 hover:text-amber-700">Produk Kami</a>

            <div class="border-t border-gray-100 my-4 pt-4 space-y-4">
                <a href="{{ route('keranjang') }}"
                    class="flex items-center justify-between text-base font-medium text-gray-700 hover:text-amber-700">
                    <span class="flex items-center gap-3">
                        <i class="fa-solid fa-cart-shopping text-amber-600"></i>
                        Keranjang
                    </span>
                    @if(isset($keranjangCount) && $keranjangCount > 0)
                        <span
                            class="bg-amber-100 text-amber-800 text-xs font-bold px-2 py-1 rounded-full">{{ $keranjangCount }}</span>
                    @endif
                </a>
                <a href="{{ route('customer.transaksi.index') }}"
                    class="flex items-center gap-3 text-base font-medium text-gray-700 hover:text-amber-700">
                    <i class="fa-solid fa-clock-rotate-left text-amber-600"></i>
                    Riwayat Pesanan
                </a>
                <form action="{{ route('logout.post') }}" method="POST">
                    @csrf
                    <button type="submit"
                        class="flex items-center gap-3 text-base font-medium text-red-600 w-full text-left">
                        <i class="fa-solid fa-power-off"></i>
                        Logout
                    </button>
                </form>
            </div>
        </div>
    </div>
</nav>

<script>
    const menuBtn = document.getElementById('menuButton');
    const mobileMenu = document.getElementById('mobileMenu');
    let isMenuOpen = false;

    menuBtn.addEventListener('click', () => {
        isMenuOpen = !isMenuOpen;
        if (isMenuOpen) {
            mobileMenu.classList.remove('-translate-y-[150%]');
            menuBtn.innerHTML = '<i class="fa-solid fa-xmark text-2xl"></i>';
        } else {
            mobileMenu.classList.add('-translate-y-[150%]');
            menuBtn.innerHTML = '<i class="fa-solid fa-bars text-2xl"></i>';
        }
    });
</script>