<head>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>

<header class="header">
    <div class="header-container">
        <div class="logo">
            <a href="{{ route('home') }}">BROWNITA</a>
        </div>
        <nav class="nav-links">
            <a href="{{ route('home') }}">Home</a>
            <a href="{{ route('tentang-kami') }}">Tentang Kami</a>
            <a href="{{ route('founder') }}">Founder</a>
            <a href="{{ route('produk-kami') }}">Produk Kami</a>
            <a href="{{ route('lokasi') }}">Lokasi</a>
        </nav>

        <div class="menu-toggle" id="menuToggle">
            ☰
        </div>
    </div>
</header>


<script>
    function toggleNav() {
        const navList = document.querySelector('.main-nav ul');
        navList.classList.toggle('show');
    }
</script>
