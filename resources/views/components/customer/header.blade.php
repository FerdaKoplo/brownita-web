<head>

</head>

<header class="bg-[#607274] py-5 top-0 sticky z-50">
    <div class="w-[90%] max-w-[1200px] mx-auto flex justify-between items-center">
        <div class="text-white font-bold text-2xl font-kameron">
            <a href="{{ route('landing.page') }}">BROWNITA</a>
        </div>

        <nav class="hidden md:flex space-x-6 font-bold font-inter">
            <a href="{{ route('landing.page') }}" class="text-white hover:text-[#CCB88C]">Home</a>
            <a href="{{ route('landing.page') }}#tentang-kami" class="text-white hover:text-[#CCB88C]">Tentang Kami</a>
            <a href="{{ route('landing.page') }}#founder" class="text-white hover:text-[#CCB88C]">Founder</a>
            <a href="{{ route('produk-kami') }}" class="text-white hover:text-[#CCB88C]">Produk Kami</a>
            <a href="{{ route('landing.page') }}#lokasi" class="text-white hover:text-[#CCB88C]">Lokasi</a>
        </nav>

        <div class="md:hidden text-white text-2xl cursor-pointer" id="menuToggle">
            ☰
        </div>
    </div>
</header>

<script>
    // Menu toggle (jika kamu pakai nav responsive)
    document.getElementById('menuToggle').addEventListener('click', function () {
        const nav = document.querySelector('nav');
        nav.classList.toggle('hidden');
    });
</script>
