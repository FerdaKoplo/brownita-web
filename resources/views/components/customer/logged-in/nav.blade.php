<nav class="top-0 bg-white sticky z-50 shadow">
  <div class="flex justify-between items-center px-4 md:px-16 lg:px-32 py-4">
    <!-- Logo -->
    <a href="{{ route('landing.page') }}" class="flex items-center">
      <img src="images/brownitaLogo.png" class="h-10 rounded-xl" alt="Brownita Logo" />
    </a>

    <!-- Hamburger Button: hanya muncul di mobile -->
    <button id="menuButton" class="md:hidden text-amber-700 focus:outline-none" aria-label="Toggle menu">
      <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
      </svg>
    </button>

    <!-- Menu Desktop: tampil mulai md ke atas -->
    <ul id="menu" class="hidden md:flex items-center gap-12 text-black font-semibold">
      <li><a href="{{ route('landing.page') }}" class="hover:text-amber-700 transition">Beranda</a></li>
      <li><a href="{{ route('syarat-ketentuan') }}" class="hover:text-amber-700 transition">Syarat & Ketentuan</a></li>
      <li><a href="{{ route('produk-kami') }}" class="hover:text-amber-700 transition">Produk Kami</a></li>
    </ul>
  </div>

  <!-- Bottom Menu Desktop: hanya muncul di md ke atas, tidak akan berubah visibilitas saat hamburger diklik -->
  <div
    id="bottomMenu"
    class="hidden md:flex px-4 md:px-16 lg:px-32 p-3 items-center justify-end gap-7 bg-gray-100 text-black shadow-md"
  >
    <a href="{{ route('keranjang') }}" class="flex items-center gap-2 relative hover:text-amber-700 transition">
      <i class="fa-solid fa-cart-shopping text-amber-700"></i>
      <span>Keranjang</span>
      @if($keranjangCount > 0)
      <span
        class="absolute -top-2 -left-3 bg-black text-white text-xs w-5 h-5 flex items-center justify-center rounded-full animate-pulse"
        >{{ $keranjangCount }}</span
      >
      @endif
    </a>
    <a href="{{ route('customer.transaksi.index') }}" class="flex items-center gap-2 hover:text-amber-700 transition">
      <i class="fa-solid fa-scroll text-amber-700"></i>
      <span>Riwayat</span>
    </a>
    <form class="logoutForm" action="{{ route('logout.post') }}" method="POST">
      @csrf
      <button
        type="submit"
        class="flex gap-2 items-center hover:text-amber-700 transition focus:outline-none"
      >
        <i class="fa-solid fa-right-from-bracket text-amber-700"></i>
        <span>Logout</span>
      </button>
    </form>
  </div>

  <!-- Mobile Menu: muncul saat hamburger diklik, hanya menu utama dan bottom menu versi mobile -->
  <div
    id="mobileMenu"
    class="md:hidden bg-white shadow-md border-t border-gray-200 px-4 py-4 hidden flex-col gap-4"
  >
    <a href="{{ route('landing.page') }}" class="block py-2 text-black font-semibold hover:text-amber-700 transition">Beranda</a>
    <a href="{{ route('syarat-ketentuan') }}" class="block py-2 text-black font-semibold hover:text-amber-700 transition">Syarat & Ketentuan</a>
    <a href="{{ route('produk-kami') }}" class="block py-2 text-black font-semibold hover:text-amber-700 transition">Produk Kami</a>
    <div class="border-t border-gray-200 mt-2 pt-2 flex flex-col gap-3">
      <a href="{{ route('keranjang') }}" class="flex items-center gap-2 text-black hover:text-amber-700 transition relative">
        <i class="fa-solid fa-cart-shopping text-amber-700"></i>
        <span>Keranjang</span>
        @if($keranjangCount > 0)
        <span
          class="absolute -top-2 -left-3 bg-black text-white text-xs w-5 h-5 flex items-center justify-center rounded-full animate-pulse"
          >{{ $keranjangCount }}</span
        >
        @endif
      </a>
      <a href="{{ route('customer.transaksi.index') }}" class="flex items-center gap-2 text-black hover:text-amber-700 transition">
        <i class="fa-solid fa-scroll text-amber-700"></i>
        <span>Riwayat</span>
      </a>
      <form class="logoutForm" action="{{ route('logout.post') }}" method="POST">
        @csrf
        <button
          type="submit"
          class="flex gap-2 items-center text-black hover:text-amber-700 transition focus:outline-none"
        >
          <i class="fa-solid fa-right-from-bracket text-amber-700"></i>
          <span>Logout</span>
        </button>
      </form>
    </div>
  </div>

  <script>
    const menuButton = document.getElementById('menuButton');
    const mobileMenu = document.getElementById('mobileMenu');
    menuButton.addEventListener('click', () => {
      mobileMenu.classList.toggle('hidden');
    });
  </script>
</nav>
