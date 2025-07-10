<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>BROWNITA</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css"
        integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    @vite('resources/css/app.css')
</head>

<body>
     @if (Auth::check())
        @include('components.customer.logged-in.nav')
    @else
        @include('components.customer.logged-out.nav')
    @endif
    <div class="min-h-screen flex items-center  bg-brand-light justify-center px-8 py-12">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-40 max-w-6xl w-full items-center">
            <div class="max-w-md space-y-6 text-[#4d2600] text-left">
                <!-- Judul -->
                <h1 class="font-inter text-[44px] font-extrabold leading-snug">
                    Eat Me and Fix Your<br class="sm:hidden" /> Mood!
                </h1>

                <!-- Deskripsi -->
                <p class="text-[19px] leading-relaxed text-[#4d2600]/90">
                    Kue homemade, aneka snack, jajanan pasar, ricebox dan nasi pilihan — karena makanan enak tak perlu ribet.
                </p>

                <!-- Tombol -->
                <div class="flex gap-4 pt-2">
                    <a href="https://wa.me/6281318484072" target="_blank" rel="noopener noreferrer"
                        class="px-6 py-[10px] rounded-md border-2 border-[#4d2600] text-[#4d2600] font-semibold text-[16px] tracking-wide hover:bg-[#4d2600] hover:text-brand-light transition-all">
                        HUBUNGI KAMI
                    </a>
                    <a href="{{ route('produk-kami') }}" class="px-6 py-[10px] rounded-md bg-[#4d2600] text-brand-light font-semibold text-[16px] tracking-wide hover:opacity-90 transition-all">
                        KATALOG
                    </a>
                </div>
            </div>

            <!-- Image -->
            <div class="max-w-[500px] w-full grid grid-cols-2 gap-2 rounded-xl border border-[#4d2600] p-2 bg-[#4d2600]">
                <img src="{{ Vite::asset('resources/img/cake-boxes.png') }}" alt="Kue" class="object-cover w-full h-full rounded-md">
                <div class="grid grid-rows-2 gap-2">
                    <img src="{{ Vite::asset('resources/img/snacks.png') }}" alt="Snack" class="object-cover w-full h-full rounded-md">
                    <img src="{{ Vite::asset('resources/img/bundt-cakes.png') }}" alt="Cake" class="object-cover w-full h-full rounded-md">
                </div>
            </div>
        </div>
        <br>
    </div>

    <!-- Tentang Brownita -->
    <section class="relative bg-brand-light text-[#4d2600]">
        <!-- Konten -->
        <div class="max-w-6xl mx-auto grid md:grid-cols-2 gap-8 px-6 py-16 items-center relative z-10">
            <!-- Gambar -->
            <div class="p-2 bg-brand-dark rounded-xl w-fit">
                <img src="{{ Vite::asset('resources/img/tentang-brownita.png') }}"
                    alt="Tentang Brownita"
                    class="rounded-lg w-[375px] h-auto object-cover" />
            </div>

            <!-- Teks -->
            <div>
                <h2 id="tentang-kami" class="text-2xl text-[40px] font-bold mb-4">Tentang Brownita</h2>
                <br>
                <p class="text-sm leading-relaxed !text-[21px]">
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.
                    Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.
                    Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.
                    Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum
                </p>
            </div>
        </div>

        <!-- Bidang Miring -->
        <div class="absolute bottom-[-1px] left-0 w-full h-40 bg-brand-dark z-0 [clip-path:polygon(0_18%,100%_100%,0_100%)]"></div>
    </section>

    <!-- Profil Founder -->
    <section class="relative bg-brand-dark text-brand-light pt-16 pb-32 px-6">
        <div class="max-w-6xl mx-auto grid md:grid-cols-2 gap-8 items-center">
            <!-- Teks -->
            <div>
                <h2 id="founder" class="text-xl !text-[40px] font-bold mb-4">Profil Founder</h2>
                <br>
                <p class="text-sm leading-relaxed !text-[21px]">
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.
                    Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.
                    Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.
                    Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum
                </p>
            </div>

            <!-- Gambar Kosong -->
            <div class="flex justify-center">
                <div class="w-64 h-48 border-2 border-brand-light rounded-lg flex items-center justify-center">
                    <i class="fa fa-image text-4xl text-brand-light/60"></i>
                </div>
            </div>
        </div>
    </section>

    <!-- Bidang Miring Bawah -->
    <div class="bg-brand-light">
        <div class="-mt-[1px] h-40 w-full bg-brand-dark [clip-path:polygon(100%_0,100%_100%,0_18%,0_0)]"></div>
    </div>

    <!-- Section Lokasi -->
    <section class="relative bg-brand-light text-[#4d2600] py-16 px-6">
        <div class="max-w-xl mx-auto text-center space-y-6">
            <!-- Judul -->
            <h2 id="lokasi" class="text-2xl font-bold text-[50px]">Lokasi Kami</h2>

            <br>
            <!-- Alamat -->
            <p class="text-center text-[18px] leading-relaxed font-bold max-w-[420px] mx-auto">
                Wisma Tropodo, Jl. Raya Wisma Tropodo Jl. Kapuas No.K7, Tropodo Kulon, Tropodo,
                Kec. Waru, Kabupaten Sidoarjo, Jawa Timur 61256
            </p>


            <br>
            <!-- Peta dengan bayangan -->
            <div class="relative inline-block">
                <div class="absolute bottom-4 left-4 w-full h-full bg-[#607274] rounded-[30px] z-0"></div>
                <img src="{{ Vite::asset('resources/img/location.png') }}"
                    alt="Peta Lokasi"
                    class="relative z-10 rounded-[30px] w-[300px] md:w-[380px] shadow-lg" />
            </div>

            <!-- Tombol Buka Maps -->
            <div class="pt-4">
                <a href="https://maps.app.goo.gl/BAMwA5hFGJmGgJ1p8?g_st=ac"
                    target="_blank"
                    class=" font-bold inline-flex items-center px-4 py-2 border border-[#4d2600] text-sm rounded-full hover:bg-[#4d2600] hover:text-white transition">
                    Buka di Google Maps
                    <i class="ml-2 fas fa-map-marker-alt"></i>
                </a>
            </div>

            <!-- Temukan kami juga di -->
            <div class="pt-12">
                <h3 class="text-lg font-bold mb-4 !text-[28px]">Temukan kami juga di</h3>

                <br>
                <div class="flex justify-center gap-4">
                    <!-- Tombol WA -->
                    <a href="https://wa.me/6281318484072" target="_blank"
                        class="font-bold inline-flex items-center px-4 py-2 border border-[#4d2600] rounded-full text-sm hover:bg-[#4d2600] hover:text-white transition">
                        Hubungi kami
                        <i class="ml-2 fab fa-whatsapp text-brand-dark text-xl"></i>
                    </a>
                    <!-- Tombol IG -->
                    <a href="https://www.instagram.com/_brownita/" target="_blank"
                        class="font-bold inline-flex items-center px-4 py-2 bg-[#4d2600] text-brand-light rounded-full text-sm hover:opacity-80 transition">
                        Instagram kami
                        <i class="ml-2 fab fa-instagram text-brand-light text-xl"></i>
                    </a>
                </div>
            </div>
        </div>
    </section>

<<<<<<< HEAD
    @include('components.customer.whatsapp')
=======
    @include('components.customer.nav')
    <div>
        <div>
            <h1>Eat Me and Fix Your Mood</h1>
        </div>
    </div>
  </h1>

>>>>>>> origin/staging
</body>

</html>