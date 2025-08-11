@extends('layout.customer.app')
@section('title', 'Pickup - Syarat & Ketentuan | Brownita')
@section('content')
<div class="px-4 lg:px-32 py-10">
    <h2 class="text-3xl lg:text-4xl font-bold text-brand-brown text-center mb-8 underline">Pick-Up</h2>
    <ol
        class="bg-amber-50 rounded-xl p-6 text-brand-brown text-lg space-y-3 list-decimal max-w-4xl mx-auto border border-brand-brown">
        <li>Seluruh Pick Up hanya dilakukan di alamat kami.</li>
        <li>Anda bertanggung jawab untuk memesan atau mengatur kurir Pick Up. Kurir Pick Up tidak pernah dipesan dari
            pihak Kami.</li>
        <li>Saat melakukan Pick Up, mohon pastikan/infokan kembali ke kami sebelum jam pick up untuk memastikan pesanan
            sudah disiapkan.</li>
        <li>Kondisi Kue/pesanan dalam keadaan baik. Kami tegaskan bahwa setiap Kue/pesanan ada dalam kondisi baik saat
            meninggalkan tempat Kami. Kami tidak bertanggung jawab atas kondisi kue/pesanan setelah meninggalkan tempat
            kami.</li>
    </ol>
    <div class="flex justify-between max-w-4xl mx-auto mt-10 gap-4">
        <a href="{{ route('syarat-ketentuan.delivery') }}"
            class="flex items-center gap-2 px-8 py-3 rounded-lg bg-amber-700 text-white font-semibold  transition text-lg">
            <i class="fa-solid fa-arrow-left"></i> Kembali
        </a>
        <a href="{{ route('syarat-ketentuan.order') }}"
            class="flex items-center gap-2 px-8 py-3 rounded-lg border-2 border-brand-brown text-black font-semibold hover:bg-black hover:text-white transition text-lg bg-transparent">
            <i class="fa-solid fa-cart-shopping"></i> Order
        </a>
    </div>
</div>
@endsection
