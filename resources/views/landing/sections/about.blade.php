<section class="relative bg-amber-700 text-white">
    <div class="max-w-6xl mx-auto grid md:grid-cols-2 gap-8 px-6 py-16 items-center relative z-10">
        <div class="p-2 rounded-xl">
            <img src="{{ asset('images/tentang-brownita.png') }}" class="rounded-lg w-[375px]">
        </div>

        <div>
            <h2 class="text-[40px] font-bold mb-4">
                {{ $data['title'] ?? 'Tentang Brownita' }}
            </h2>

            <p class="text-[21px] leading-relaxed">
                {{ $data['desc'] ?? '' }}
            </p>
        </div>
    </div>

    <div class="absolute bottom-[-1px] left-0 w-full h-40 bg-amber-800 [clip-path:polygon(0_18%,100%_100%,0_100%)]"></div>
</section>
