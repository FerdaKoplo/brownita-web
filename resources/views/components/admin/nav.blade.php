<nav class="fixed top-0 left-0 h-screen w-60 list-none bg-black text-white p-6">
    <div class="flex flex-col gap-10">
        <div class="flex flex-col gap-5">
            <a href="{{ route('dashboard.admin') }}" class="text-xl font-kameron font-bold">ADMIN BROWNITA</a>
            <div class="border"></div>
        </div>
        <ul class="flex w-full flex-col gap-2 font-semibold">
            <li>
                <a href="{{ route('dashboard.admin.kategori.view') }}"
                    class="flex items-center gap-3 w-full px-2 py-3 rounded-md hover:bg-amber-600">
                    <i class="fa-solid fa-layer-group"></i>
                    <span>Kategori</span>
                </a>
            </li>
            <li>
                <a href="{{ route('dashboard.admin.katalog.view') }}"
                    class="flex items-center gap-3 w-full px-2 py-3 rounded-md hover:bg-amber-600">
                    <i class="fa-solid fa-utensils"></i>
                    <span>Katalog</span>
                </a>
            </li>
            <li>
                <a href="{{ route('dashboard.admin.akun.view') }}"
                    class="flex items-center gap-3 w-full px-2 py-3 rounded-md hover:bg-amber-600">
                    <i class="fa-solid fa-user"></i>
                    <span>Akun</span>
                </a>
            </li>
            <li>
                <a href="{{ route('dashboard.admin.customer-transaction.view') }}"
                    class="flex items-center gap-3 w-full px-2 py-3 rounded-md hover:bg-amber-600">
                    <i class="fa-solid fa-scroll"></i>
                    <span>Transaksi Customer</span>
                </a>
            </li>
        </ul>

        <form class="logoutForm" action="{{  route('logout.post') }}" method="POST">
            @csrf
            <button type="submit" class="fixed text-white bg-red-400 px-12 rounded-md  py-3  flex gap-3 items-center bottom-8">
                <i class="fa-solid fa-right-from-bracket"></i>
                <p>
                    Logout
                </p>
            </button>
        </form>
    </div>
</nav>
