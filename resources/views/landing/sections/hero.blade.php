<div class="min-h-screen flex items-center bg-white justify-center mt-16 px-8 py-12">
    <div class="grid grid-cols-1 md:grid-cols-2 gap-40 max-w-6xl w-full items-center">
        <div class="max-w-md space-y-6 text-black">
            <h1  class="font-inter  text-[44px] font-extrabold leading-snug">
                {{ $data['title'] ?? 'Eat Me and Fix Your Mood!' }}
            </h1>

            <p class="text-[19px]  leading-relaxed">
                {{ $data['desc'] ?? '' }}
            </p>

            <div  class="flex gap-4 pt-2 ">
                <a href="{{ $data['cta_wa'] ?? 'https://wa.me/6281217018289' }}" target="_blank"
                    class="px-6 py-[10px] rounded-md border-2 border-black font-semibold hover:bg-black hover:text-white transition">
                    HUBUNGI KAMI
                </a>

                <a href="{{ route('produk-kami') }}"
                    class="px-6 py-[10px] rounded-md bg-amber-700 text-white font-semibold hover:opacity-90 transition">
                    KATALOG
                </a>
            </div>
        </div>

        <div 
            class="max-w-[500px]  w-full grid grid-cols-2 gap-2 rounded-xl border border-amber-700 p-2 bg-amber-700">
            <img  src="{{ asset('images/bundt-cakes.png') }}" alt="Kue"
                class="object-cover w-full h-full rounded-md">
            <div class="grid grid-rows-2 gap-2">
                <img  src="{{ asset('images/snacks.png') }}" alt="Snack"
                    class="object-cover w-full h-full rounded-md">
                <img  src="{{ asset('images/bundt-cakes.png') }}" alt="Cake"
                    class="object-cover w-full h-full rounded-md">
            </div>
        </div>
    </div>
</div>
</div>