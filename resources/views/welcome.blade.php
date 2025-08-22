<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Brownita</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css"
        integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body>
    {{-- @include('components.customer.header') --}}
    @if (Auth::check())
        @include('components.customer.logged-in.nav')
    @else
        @include('components.customer.logged-out.nav')
    @endif
    <div class="min-h-screen flex items-center  bg-white justify-center px-8 py-12">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-40 max-w-6xl w-full items-center">
            <div class="max-w-md space-y-6 text-black text-left">
                <!-- Judul -->
                <h1 id="heroTitle" class="font-inter opacity-0 text-[44px] font-extrabold leading-snug">
                    Eat Me and Fix Your<br class="sm:hidden" /> Mood!
                </h1>

                <!-- Deskripsi -->
                <p id="heroDesc" class="text-[19px] opacity-0 leading-relaxed text-black">
                    Hantaran homemade berkelas, snack box premium, nasi kotak istimewa, dan gethuk tradisional —
                    kelezatan autentik 100% halal dari dapur rumah untuk setiap momen berharga.
                </p>

                <!-- Tombol -->
                <div id="heroButtons" class="flex gap-4 pt-2 opacity-0">
                    <a  href="https://wa.me/6281217018289" target="_blank" rel="noopener noreferrer"
                        class="px-6 py-[10px] rounded-md border-2  border-black text-black font-semibold text-[16px] tracking-wide hover:bg-black hover:text-white transition-all">
                        HUBUNGI KAMI
                    </a>
                    <a href="{{ route('produk-kami') }}"
                        class="px-6 py-[10px] rounded-md  bg-amber-700 text-white font-semibold text-[16px] tracking-wide hover:opacity-90 transition-all">
                        KATALOG
                    </a>
                </div>
            </div>

            <!-- Image -->
            <div
                id="heroImages"
                class="max-w-[500px] opacity-0 w-full grid grid-cols-2 gap-2 rounded-xl border border-amber-700 p-2 bg-amber-700">
                <img id="heroImg1" src="{{ asset('images/bundt-cakes.png') }}" alt="Kue"
                    class="object-cover w-full h-full rounded-md">
                <div class="grid grid-rows-2 gap-2">
                    <img id="heroImg2" src="{{ asset('images/snacks.png') }}" alt="Snack"
                        class="object-cover w-full h-full rounded-md">
                    <img id="heroImg3" src="{{ asset('images/bundt-cakes.png') }}" alt="Cake"
                        class="object-cover w-full h-full rounded-md">
                </div>
            </div>
        </div>
        <br>
    </div>

    <!-- Tentang Brownita -->
    <section id="aboutSection" class="relative bg-amber-700 text-white">
        <!-- Konten -->
        <div class="max-w-6xl mx-auto grid md:grid-cols-2 gap-8 px-6 py-16 items-center relative z-10">
            <!-- Gambar -->
            <div id="aboutImage" class="p-2 bg-brand-dark rounded-xl w-fit">
                <img src="{{ asset('images/tentang-brownita.png') }}" alt="Tentang Brownita"
                    class="rounded-lg w-[375px] h-auto object-cover" />
            </div>

            <!-- Teks -->
            <div>
                <h2 id="tentang-kami" class="text-2xl text-[40px] font-bold mb-4">Tentang Brownita</h2>
                <br>
                <p id="aboutDesc" class="text-xs md:text-sm  leading-relaxed !text-[21px]">
                    Brownita hadir sebagai kuliner homemade premium yang telah dipercaya keluarga Indonesia sejak 2007.
                    Dengan legalitas resmi sebagai Industri Rumah Tangga Pangan yang terdaftar di Kementerian Kesehatan
                    dan Surat Keterangan Domisili Usaha dari Pemerintah Kabupaten Sidoarjo, kami menghadirkan standar
                    profesional dalam setiap sajian berkualitas tinggi.

                    Keahlian kami terfokus pada empat spesialisasi utama: paket hantaran, snack box premium, nasi kotak
                    istimewa, dan gethuk tradisional.

                    Beroperasi di Wisma Tropodo BV-02, RT 082 RW 009, Desa Tropodo, Kecamatan Waru, Kabupaten Sidoarjo,
                    Jawa Timur, Brownita menggabungkan kehangatan cita rasa rumahan dengan pendekatan bisnis yang
                    terstruktur dan responsif.
                </p>
            </div>
        </div>

        <!-- Bidang Miring -->
        <div
            class="absolute bottom-[-1px] left-0 w-full h-40 bg-amber-800 z-0 [clip-path:polygon(0_18%,100%_100%,0_100%)]">
        </div>
    </section>

    <!-- Profil Founder -->
    <section id="profilSection" class="relative bg-amber-800 text-white pt-16 pb-32 px-6">
        <div class="max-w-6xl mx-auto flex flex-col justify-center text-center gap-8 items-center">
            <!-- Teks -->
            <div>
                <h2 id="founder" class="text-xl !text-[40px] font-bold mb-4">Profil Founder</h2>
                <br>
                <p id="founderDesc" class="text-sm leading-relaxed !text-[21px]">
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore
                    et dolore magna aliqua.
                    Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
                    consequat.
                    Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla
                    pariatur.
                    Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id
                    est laborum
                </p>
            </div>

            {{-- <!-- Gambar Kosong -->
            <div class="flex justify-center">
                <div class="w-64 h-48 border-2 border-brand-light rounded-lg flex items-center justify-center">
                    <i class="fa fa-image text-4xl text-brand-light/60"></i>
                </div>
            </div> --}}
        </div>
    </section>

    <!-- Bidang Miring Bawah -->
    <div class="bg-white">
        <div class="-mt-[1px] h-40 w-full bg-amber-800 [clip-path:polygon(100%_0,100%_100%,0_18%,0_0)]"></div>
    </div>

    <!-- Section Lokasi -->
    <section id="locationSection" class="relative bg-white text-black py-16 px-6">
        <div class="max-w-xl mx-auto text-center space-y-6">
            <!-- Judul -->
            <h2 id="lokasi" class="text-2xl font-bold text-[50px]">Lokasi Kami</h2>

            <br>
            <!-- Alamat -->
            <p id="landingAddress" class="text-center text-[18px] leading-relaxed font-bold max-w-[420px] mx-auto">
                Wisma Tropodo, Jl. Raya Wisma Tropodo Jl. Kapuas No.K7, Tropodo Kulon, Tropodo,
                Kec. Waru, Kabupaten Sidoarjo, Jawa Timur 61256
            </p>

            <br>
            <!-- Peta dengan bayangan -->
            <div id="landingMap" class="relative opacity-0 inline-block">
                <div class="absolute bottom-4 left-4 w-full h-full bg-amber-700 rounded-[30px] z-0"></div>
                <iframe class="relative z-10 rounded-[30px] w-[300px] md:w-[380px] shadow-lg"
                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d1978.480824413675!2d112.75668633558196!3d-7.358195855305758!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2dd7e504b3a86c83%3A0x399eaa44dd432fd5!2sBrownita!5e0!3m2!1sen!2sid!4v1754669122529!5m2!1sen!2sid"
                    width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy"
                    referrerpolicy="no-referrer-when-downgrade"></iframe>
                {{-- <img src="/location.png') }}" alt="Peta Lokasi" class="" /> --}}
            </div>

            <!-- Tombol Buka Maps -->
            <div id="btnMap" class="pt-4">
                <a href="https://maps.app.goo.gl/BAMwA5hFGJmGgJ1p8?g_st=ac" target="_blank"
                    class=" font-bold inline-flex items-center px-4 py-2 border border-black text-sm rounded-full hover:bg-black hover:text-white transition">
                    Buka di Google Maps
                    <i class="ml-2 fas fa-map-marker-alt"></i>
                </a>
            </div>

            <!-- Temukan kami juga di -->
            <div class="pt-12">
                <h3 id="foundUsTitle" class="text-lg font-bold mb-4 !text-[28px]">Temukan kami juga di</h3>

                <br>
                <div id="btnSocialMedia" class="flex justify-center gap-4">
                    <!-- Tombol WA -->
                    <a href="https://wa.me/6281217018289" target="_blank"
                        class="font-bold inline-flex items-center px-4 py-2 border group border-black rounded-full text-sm hover:bg-black hover:text-white transition">
                        Hubungi kami
                        <i class="ml-2 fab fa-whatsapp text-black group-hover:text-white text-xl"></i>
                    </a>
                    <!-- Tombol IG -->
                    <a href="https://www.instagram.com/_brownita/" target="_blank"
                        class="font-bold inline-flex items-center px-4 py-2 bg-amber-700 text-white rounded-full text-sm hover:opacity-80 transition">
                        Instagram kami
                        <i class="ml-2 fab fa-instagram text-white text-xl"></i>
                    </a>
                </div>
            </div>
        </div>
    </section>
</body>
</html>
