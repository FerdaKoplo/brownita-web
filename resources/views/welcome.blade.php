<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Brownita</title>

    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body>

    @php
    Cache::forget('landing_sections');
@endphp

@php
    use Illuminate\Support\Facades\Cache;

    $sections = Cache::rememberForever('landing_sections', function () {
        return \App\Models\LandingPage::all()
            ->keyBy('section_key')
            ->map(fn ($s) => $s->content);
    });
@endphp

@if (Auth::check())
    @include('components.customer.logged-in.nav')
@else
   @include('components.customer.logged-out.nav')
@endif

{{-- HERO --}}
<div class="min-h-screen flex items-center bg-white justify-center mt-16 px-8 py-12">
    <div class="grid grid-cols-1 md:grid-cols-2 gap-40 max-w-6xl w-full items-center">
        <div class="max-w-md space-y-6 text-black">
            <h1 id="heroTitle" class="font-inter opacity-0 text-[44px] font-extrabold leading-snug">
                {{ $sections['hero']['title'] ?? 'Eat Me and Fix Your Mood!' }}
            </h1>

            <p id="heroDesc" class="text-[19px] opacity-0 leading-relaxed">
                {{ $sections['hero']['desc'] ?? '' }}
            </p>

            <div id="heroButtons" class="flex gap-4 pt-2 opacity-0">
                <a href="{{ $sections['hero']['cta_wa'] ?? 'https://wa.me/6281217018289' }}"
                   target="_blank"
                   class="px-6 py-[10px] rounded-md border-2 border-black font-semibold hover:bg-black hover:text-white transition">
                    HUBUNGI KAMI
                </a>

                <a href="{{ $sections['hero']['cta_catalog'] ?? route('produk-kami') }}"
                   class="px-6 py-[10px] rounded-md bg-amber-700 text-white font-semibold hover:opacity-90 transition">
                    KATALOG
                </a>
            </div>
        </div>

        {{-- HERO IMAGES (STATIC) --}}
        <div id="heroImages"
             class="max-w-[500px] opacity-0 w-full grid grid-cols-2 gap-2 rounded-xl border border-amber-700 p-2 bg-amber-700">
            <img src="{{ asset('images/bundt-cakes.png') }}" class="rounded-md">
            <div class="grid grid-rows-2 gap-2">
                <img src="{{ asset('images/snacks.png') }}" class="rounded-md">
                <img src="{{ asset('images/bundt-cakes.png') }}" class="rounded-md">
            </div>
        </div>
    </div>
</div>

{{-- ABOUT --}}
<section class="relative bg-amber-700 text-white">
    <div class="max-w-6xl mx-auto grid md:grid-cols-2 gap-8 px-6 py-16 items-center relative z-10">
        <div class="p-2 rounded-xl">
            <img src="{{ asset('images/tentang-brownita.png') }}" class="rounded-lg w-[375px]">
        </div>

        <div>
            <h2 class="text-[40px] font-bold mb-4">
                {{ $sections['about']['title'] ?? 'Tentang Brownita' }}
            </h2>

            <p class="text-[21px] leading-relaxed">
                {{ $sections['about']['desc'] ?? '' }}
            </p>
        </div>
    </div>

    <div class="absolute bottom-[-1px] left-0 w-full h-40 bg-amber-800 [clip-path:polygon(0_18%,100%_100%,0_100%)]"></div>
</section>

{{-- FOUNDER --}}
<section class="bg-amber-800 text-white pt-16 pb-32 px-6">
    <div class="max-w-6xl mx-auto text-center">
        <h2 class="text-[40px] font-bold mb-4">
            {{ $sections['founder']['title'] ?? 'Profil Founder' }}
        </h2>

        <p class="text-[21px] leading-relaxed">
            {{ $sections['founder']['desc'] ?? '' }}
        </p>
    </div>
</section>

{{-- SLANTED --}}
<div class="bg-white">
    <div class="-mt-[1px] h-40 bg-amber-800 [clip-path:polygon(100%_0,100%_100%,0_18%,0_0)]"></div>
</div>

{{-- LOCATION --}}
<section class="bg-white text-black py-16 px-6">
    <div class="max-w-xl mx-auto text-center space-y-6">

        <h2 class="text-[50px] font-bold">
            {{ $sections['location']['title'] ?? 'Lokasi Kami' }}
        </h2>

        <p class="text-[18px] font-bold">
            {{ $sections['location']['address'] ?? '' }}
        </p>

        <div class="relative inline-block">
            <div class="absolute bottom-4 left-4 w-full h-full bg-amber-700 rounded-[30px]"></div>

            <iframe
                class="relative z-10 rounded-[30px] w-[300px] md:w-[380px]"
                src="{{ $sections['location']['map_url'] ?? '' }}"
                loading="lazy">
            </iframe>
        </div>

        <a href="{{ $sections['location']['maps_link'] ?? '#' }}"
           target="_blank"
           class="inline-flex items-center px-4 py-2 border border-black rounded-full font-bold hover:bg-black hover:text-white transition">
            Buka di Google Maps
            <i class="ml-2 fas fa-map-marker-alt"></i>
        </a>

        {{-- SOCIAL --}}
        <div class="pt-12">
            <h3 class="text-[28px] font-bold mb-4">
                {{ $sections['social']['title'] ?? 'Temukan kami juga di' }}
            </h3>

            <div class="flex justify-center gap-4">
                <a href="{{ $sections['social']['wa'] ?? 'https://wa.me/6281217018289' }}"
                   target="_blank"
                   class="inline-flex items-center px-4 py-2 border border-black rounded-full font-bold hover:bg-black hover:text-white">
                    Hubungi kami
                    <i class="ml-2 fab fa-whatsapp"></i>
                </a>

                <a href="{{ $sections['social']['ig'] ?? 'https://instagram.com/_brownita' }}"
                   target="_blank"
                   class="inline-flex items-center px-4 py-2 bg-amber-700 text-white rounded-full font-bold">
                    Instagram kami
                    <i class="ml-2 fab fa-instagram"></i>
                </a>
            </div>
        </div>

    </div>
</section>

</body>
</html>
