<button id="sidebarToggle" class="lg:hidden  text-xl top-4 left-4 z-50 p-2 rounded-md text-amber-700">
    <i class="fa-solid fa-bars"></i>
</button>

<div id="sidebarOverlay" class="hidden fixed inset-0 bg-black bg-opacity-50 z-40"></div>

<nav id="sidebar"
    class="fixed top-0 left-0 h-screen w-60 bg-black text-white p-6 transform -translate-x-full lg:translate-x-0 transition-transform duration-300 z-50">
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

        <form class="logoutForm" action="{{ route('logout.post') }}" method="POST">
            @csrf
            <button type="submit"
                class="text-white bg-red-400 px-12 rounded-md py-3 flex gap-3 items-center mt-auto">
                <i class="fa-solid fa-right-from-bracket"></i>
                <p>Logout</p>
            </button>
        </form>
    </div>
</nav>

<script>
    const sidebarToggle = document.getElementById('sidebarToggle');
    const sidebar = document.getElementById('sidebar');
    const overlay = document.getElementById('sidebarOverlay');

    sidebarToggle.addEventListener('click', () => {
        sidebar.classList.toggle('-translate-x-full');
        overlay.classList.toggle('hidden');
    });

    overlay.addEventListener('click', () => {
        sidebar.classList.add('-translate-x-full');
        overlay.classList.add('hidden');
    });
</script>
