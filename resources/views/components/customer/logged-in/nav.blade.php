<nav class="top-0 bg-white sticky z-50">
    <div class="text-black px-32  p-5 flex justify-between items-center">
        <h1 class="font-kameron  text-2xl">
            <a href="{{ route('landing.page') }}">
                BROWNITA
            </a>
        </h1>
        <ul class="flex items-center gap-12">
            <li>
                <a href="{{ route('landing.page') }}">
                    Beranda
                </a>
            </li>
            <li>
                <a href="">
                    Syarat & Ketentuan
                </a>
            </li>
            <li>
                <a href="{{ route('produk-kami') }}">
                    Produk Kami
                </a>
            </li>
        </ul>
    </div>

    <ul class="flex px-32 p-3 items-end justify-end gap-7 text-black bg-gray-100 shadow-md">
        <li>
            <a href="{{ route('keranjang') }}" class="flex items-center gap-5 relative ">
                <i class="fa-solid fa-cart-shopping text-amber-700"></i>
                <p>Keranjang</p>

                @if($keranjangCount > 0)
                    <span class="absolute -top-2 -left-2 bg-black text-white text-xs w-5 h-5 flex items-center justify-center rounded-full animate-pulse">
                        {{ $keranjangCount }}
                    </span>
                @endif
            </a>
        </li>
        <li>
            <a href="{{ route('customer.transaksi.index') }}" class="flex items-center gap-5">
                <i class="fa-solid fa-scroll text-amber-700"></i>
                <p>Riwayat</p>

            </a>
        </li>
        <form class="logoutForm" action="{{  route('logout.post') }}" method="POST">
            @csrf
            <button type="submit" class=" flex gap-3 items-center">
                <i class="fa-solid fa-right-from-bracket text-amber-700"></i>
                <p>
                    Logout
                </p>
            </button>
        </form>
    </ul>
</nav>
