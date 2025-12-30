<button id="sidebarToggle"
    class="lg:hidden  top-4 left-4 z-50 p-2.5 rounded-lg  text-gray-600 hover:text-amber-700 transition-colors border border-gray-100">
    <i class="fa-solid fa-bars text-xl"></i>
</button>

<div id="sidebarOverlay" class="hidden fixed inset-0 bg-gray-900/50 backdrop-blur-sm z-40 transition-opacity"></div>

<nav id="sidebar"
    class="fixed top-0 left-0 h-screen w-64 bg-white border-r border-gray-200 transform -translate-x-full lg:translate-x-0 transition-transform duration-300 ease-in-out z-50 flex flex-col">

    <div class="h-16 flex items-center px-6 border-b border-gray-100">
        <a href="{{ route('dashboard.admin') }}" class="flex items-center gap-3 group">
            <div
                class="w-8 h-8 rounded-lg bg-amber-700 text-white flex items-center justify-center font-bold text-lg shadow-sm group-hover:scale-105 transition-transform">
                B
            </div>
            <span
                class="text-lg font-bold text-gray-800 tracking-tight group-hover:text-amber-700 transition-colors">BROWNITA</span>
        </a>
    </div>

    <div class="flex-1 overflow-y-auto px-4 py-6 space-y-1">

        <div class="px-2 mb-2 text-xs font-bold text-gray-400 uppercase tracking-wider">Content</div>

        <a href="{{ route('dashboard.admin.landing-page.view') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm font-medium transition-all duration-200 group
           {{ request()->routeIs('dashboard.admin.landing-page.view')
    ? 'bg-amber-50 text-amber-700'
    : 'text-gray-600 hover:bg-gray-50 hover:text-gray-900' }}">
            <i
                class="fa-solid fa-pager w-5 text-center {{ request()->routeIs('dashboard.admin.landing-page.view') ? 'text-amber-600' : 'text-gray-400 group-hover:text-gray-500' }}"></i>
            <span>Landing Page</span>
        </a>

        <a href="{{ route('dashboard.admin.katalog.view') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm font-medium transition-all duration-200 group
           {{ request()->routeIs('dashboard.admin.katalog.view')
    ? 'bg-amber-50 text-amber-700'
    : 'text-gray-600 hover:bg-gray-50 hover:text-gray-900' }}">
            <i
                class="fa-solid fa-utensils w-5 text-center {{ request()->routeIs('dashboard.admin.katalog.view') ? 'text-amber-600' : 'text-gray-400 group-hover:text-gray-500' }}"></i>
            <span>Katalog Menu</span>
        </a>

        <a href="{{ route('dashboard.admin.kategori.view') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm font-medium transition-all duration-200 group
           {{ request()->routeIs('dashboard.admin.kategori.view')
    ? 'bg-amber-50 text-amber-700'
    : 'text-gray-600 hover:bg-gray-50 hover:text-gray-900' }}">
            <i
                class="fa-solid fa-layer-group w-5 text-center {{ request()->routeIs('dashboard.admin.kategori.view') ? 'text-amber-600' : 'text-gray-400 group-hover:text-gray-500' }}"></i>
            <span>Kategori</span>
        </a>

        <div class="mt-6 px-2 mb-2 text-xs font-bold text-gray-400 uppercase tracking-wider">Transaksi</div>

        <a href="{{ route('dashboard.admin.customer-transaction.view') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm font-medium transition-all duration-200 group
           {{ request()->routeIs('dashboard.admin.customer-transaction.view')
    ? 'bg-amber-50 text-amber-700'
    : 'text-gray-600 hover:bg-gray-50 hover:text-gray-900' }}">
            <i
                class="fa-solid fa-receipt w-5 text-center {{ request()->routeIs('dashboard.admin.customer-transaction.view') ? 'text-amber-600' : 'text-gray-400 group-hover:text-gray-500' }}"></i>
            <span>Pesanan Masuk</span>
        </a>

        <a href="{{ route('dashboard.admin.manual-transaksi.index') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm font-medium transition-all duration-200 group
           {{ request()->routeIs('dashboard.admin.manual-transaksi.index')
    ? 'bg-amber-50 text-amber-700'
    : 'text-gray-600 hover:bg-gray-50 hover:text-gray-900' }}">
            <i
                class="fa-solid fa-pen-to-square w-5 text-center {{ request()->routeIs('dashboard.admin.manual-transaksi.index') ? 'text-amber-600' : 'text-gray-400 group-hover:text-gray-500' }}"></i>
            <span>Input Manual</span>
        </a>

        <div class="mt-6 px-2 mb-2 text-xs font-bold text-gray-400 uppercase tracking-wider">Pengguna</div>

        <a href="{{ route('dashboard.admin.akun.view') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm font-medium transition-all duration-200 group
           {{ request()->routeIs('dashboard.admin.akun.view')
    ? 'bg-amber-50 text-amber-700'
    : 'text-gray-600 hover:bg-gray-50 hover:text-gray-900' }}">
            <i
                class="fa-solid fa-users-gear w-5 text-center {{ request()->routeIs('dashboard.admin.akun.view') ? 'text-amber-600' : 'text-gray-400 group-hover:text-gray-500' }}"></i>
            <span>Admin Users</span>
        </a>

    </div>

    <div class="p-4 border-t border-gray-100">
        <form class="logoutForm w-full" action="{{ route('logout.post') }}" method="POST">
            @csrf
            <button type="submit"
                class="flex items-center justify-center gap-2 w-full px-4 py-2.5 rounded-lg text-sm font-medium text-red-600 bg-red-50 hover:bg-red-100 hover:text-red-700 transition-colors">
                <i class="fa-solid fa-arrow-right-from-bracket"></i>
                <span>Logout</span>
            </button>
        </form>
    </div>
</nav>

<script>
    const toggleBtn = document.getElementById('sidebarToggle');
    const sidebar = document.getElementById('sidebar');
    const overlay = document.getElementById('sidebarOverlay');

    function toggleSidebar() {
        sidebar.classList.toggle('-translate-x-full');
        overlay.classList.toggle('hidden');
    }

    toggleBtn.addEventListener('click', toggleSidebar);
    overlay.addEventListener('click', toggleSidebar);
</script>