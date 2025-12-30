@props([
    'number' => '6281217018289', 
    'message' => 'Halo Brownita, saya butuh bantuan.', 
    'label' => 'Chat Admin' 
])

@php
    $url = "https://wa.me/{$number}?text=" . urlencode($message);
@endphp

<a href="{{ $url }}" 
   target="_blank"
   class="fixed z-50 bottom-6 right-6 group flex items-center justify-center 
          bg-[#25D366] text-white shadow-xl hover:shadow-2xl hover:bg-[#20b858]
          transition-all duration-300 ease-in-out transform hover:-translate-y-1
          
          w-14 h-14 rounded-full
          
          md:w-auto md:h-auto md:rounded-full md:px-6 md:py-3"
   aria-label="Chat via WhatsApp">

    <span class="absolute inline-flex h-full w-full rounded-full bg-[#25D366] opacity-75 animate-ping -z-10"></span>

    <i class="fa-brands fa-whatsapp text-3xl md:text-2xl transition-transform group-hover:scale-110"></i>

    <span class="hidden md:block ml-3 font-bold text-base tracking-wide whitespace-nowrap">
        {{ $label }}
    </span>
</a>