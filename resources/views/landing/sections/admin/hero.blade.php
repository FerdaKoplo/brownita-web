<div class="min-h-screen flex items-center bg-white justify-center mt-16 px-8 py-12">
    <div class="grid grid-cols-1 md:grid-cols-2 gap-40 max-w-6xl w-full items-center">
        <div class="max-w-md space-y-6 text-black">
            <h1 id="heroTitle" class="font-inter opacity-0 text-[44px] font-extrabold leading-snug">
                {{ $data['title'] ?? 'Eat Me and Fix Your Mood!' }}
            </h1>

            <p id="heroDesc" class="text-[19px] opacity-0 leading-relaxed">
                {{ $data['desc'] ?? '' }}
            </p>
        </div>

        <div id="heroImages"
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
</div>
</div>