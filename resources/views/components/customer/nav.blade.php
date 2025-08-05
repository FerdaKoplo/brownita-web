<nav class="bg-brand-secondary px-8 lg:px-32 py-5 top-0 sticky z-50">
        <div class="text-white flex justify-between items-center">
            <h1 class="font-kameron text-2xl font-bold">
                <a href="{{ route('landing.page') }}" class="hover:text-brand-light transition-colors duration-300">
                    BROWNITA
                </a>
            </h1>
            <ul class="hidden md:flex items-center gap-8 lg:gap-12">
                <li>
                    <a href="{{ route('landing.page') }}" class="hover:text-brand-light transition-colors duration-300">
                        Beranda
                    </a>
                </li>
                <li>
                    <a href="{{ route('syarat-ketentuan') }}" class="hover:text-brand-light transition-colors duration-300">
                        Syarat & Ketentuan
                    </a>
                </li>
                <li>
                    <a href="{{ route('produk-kami') }}" class="hover:text-brand-light transition-colors duration-300">
                        Produk Kami
                    </a>
                </li>
                <li class="flex gap-4 ml-4">
                    <a href="{{ route('login') }}" class="font-semibold border-brand-light border-2 hover:bg-brand-light hover:text-brand-secondary transition-all duration-300 px-5 py-1.5 rounded-full">
                        Login
                    </a>
                    <a href="{{ route('register') }}" class="font-semibold px-5 py-1.5 rounded-full bg-brand-light text-brand-secondary hover:bg-opacity-90 transition-all duration-300">
                        Register
                    </a>
                </li>
            </ul>
            <!-- Mobile menu button -->
            <button class="md:hidden text-white">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                </svg>
            </button>
        </div>
    </nav>
