<nav class="bg-brand-secondary px-32 p-5 top-0 sticky">
    <div class="text-white flex justify-between items-center">
        <h1 class="font-kameron  text-2xl">
            <a href="{{ route('landing.page') }}">
                BROWNITA
            </a>
        </h1>
        <ul class="flex items-center gap-12">
            <li>
                <a href="">
                    Syarat & Ketentuan
                </a>
            </li>
            <li>
                <a href="">
                    Produk Kami
                </a>
            </li>
            <div class="flex gap-4">
                <li class="border-brand-light border-2 hover:border-brand-secondary hover:bg-brand-light hover:text-brand-secondary duration-300 px-5 py-1.5 rounded-full">
                    <a href="{{ route('login') }}" class="font-semibold">
                        Login
                    </a>
                </li>
                <li class="px-5 py-1.5 rounded-full  bg-brand-light text-brand-secondary  ">
                    <a href="{{ route('register') }}" class="font-semibold">
                        Register
                    </a>
                </li>
            </div>
        </ul>
    </div>
</nav>
