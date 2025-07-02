<nav class="fixed top-0 left-0 h-screen w-60 list-none bg-brand-secondary text-white p-6">
    <div class="flex flex-col gap-10">
        <div class="flex flex-col gap-5">
            <a href="{{ route('dashboard.admin') }}" class="text-xl font-kameron font-bold">ADMIN BROWNITA</a>
            <div class="border"></div>
        </div>
        <ul class="flex flex-col gap-5 font-semibold ">
            <a href="{{ route('dashboard.admin.kategori.view') }}" class="flex items-center gap-3">
                <i class="fa-solid fa-layer-group"></i>
                <li>Kategori</li>
            </a>
            <a href="{{ route('dashboard.admin.katalog.view') }}" class="flex items-center gap-3">
                <i class="fa-solid fa-utensils"></i>
                <li>Katalog</li>
            </a>
            <a href="" class="flex items-center gap-3">
                <i class="fa-solid fa-user"></i>
                <li>Akun</li>
            </a>
        </ul>
        <a href="" class="bottom-8 font-semibold fixed flex items-center gap-3">
            <i class="fa-solid fa-right-from-bracket"></i>
            <p>
                Logout
            </p>
        </a>
    </div>
</nav>
