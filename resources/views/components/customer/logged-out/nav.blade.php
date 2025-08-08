<nav class="shadow-md bg-white p-5 top-0 sticky z-50">
  <div class="flex justify-between items-center px-4 md:px-16 lg:px-32 text-black">
    <!-- Logo -->
    <h1 class="font-kameron text-2xl">
      <a href="{{ route('landing.page') }}">
        <img src="images/brownitaLogo.png" class="h-10 bg-white rounded-xl" alt="Brownita Logo" />
      </a>
    </h1>

    <!-- Hamburger Button: hanya muncul di mobile -->
    <button id="menuButton" class="md:hidden text-amber-700 focus:outline-none" aria-label="Toggle menu">
      <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
      </svg>
    </button>

    <!-- Menu Desktop -->
    <ul class="hidden md:flex items-center gap-12">
      <li><a href="{{ route('landing.page') }}" class="hover:text-amber-700 transition">Beranda</a></li>
      <li><a href="{{ route('syarat-ketentuan') }}" class="hover:text-amber-700 transition">Syarat & Ketentuan</a></li>
      <li><a href="{{ route('produk-kami') }}" class="hover:text-amber-700 transition">Produk Kami</a></li>

      <div class="flex gap-4 ml-6">
        <li class="border-amber-700 border-2 hover:border-brand-secondary hover:bg-amber-700 hover:text-white duration-300 px-5 py-1.5 rounded-full">
          <a href="{{ route('login') }}" class="font-semibold">Login</a>
        </li>
        <li class="px-5 py-1.5 rounded-full bg-amber-700 text-white">
          <a href="{{ route('register') }}" class="font-semibold">Register</a>
        </li>
      </div>
    </ul>
  </div>

  <!-- Mobile Menu: muncul saat hamburger diklik -->
  <div id="mobileMenu" class="md:hidden px-4 pt-4 pb-6 hidden flex-col gap-4 border-t border-gray-200 bg-white shadow-md">
    <a href="{{ route('landing.page') }}" class="block py-2 text-black font-semibold hover:text-amber-700 transition">Beranda</a>
    <a href="{{ route('syarat-ketentuan') }}" class="block py-2 text-black font-semibold hover:text-amber-700 transition">Syarat & Ketentuan</a>
    <a href="{{ route('produk-kami') }}" class="block py-2 text-black font-semibold hover:text-amber-700 transition">Produk Kami</a>

    <div class="flex flex-col gap-3 mt-4 border-t border-gray-200 pt-4">
      <a href="{{ route('login') }}" class="block text-center border-amber-700 border-2 rounded-full py-2 font-semibold hover:bg-amber-700 hover:text-white transition">
        Login
      </a>
      <a href="{{ route('register') }}" class="block text-center bg-amber-700 text-white rounded-full py-2 font-semibold hover:bg-amber-800 transition">
        Register
      </a>
    </div>
  </div>

  <script>
    const menuButton = document.getElementById('menuButton');
    const mobileMenu = document.getElementById('mobileMenu');

    menuButton.addEventListener('click', () => {
      mobileMenu.classList.toggle('hidden');
      if (!mobileMenu.classList.contains('hidden')) {
        document.body.style.overflow = 'hidden';
      } else {
        document.body.style.overflow = '';
      }
    });
  </script>
</nav>
