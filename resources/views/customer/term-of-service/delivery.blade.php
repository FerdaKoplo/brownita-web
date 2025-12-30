@extends('layout.customer.app')
@section('title', 'Delivery - Syarat & Ketentuan')

@section('content')
<div class="min-h-screen bg-gray-50 px-4 lg:px-32 py-12">
    
    <div class="text-center mb-12">
        <div class="inline-flex items-center justify-center w-16 h-16 bg-amber-100 text-amber-800 rounded-full mb-4">
            <i class="fa-solid fa-truck-fast text-2xl"></i>
        </div>
        <h2 class="text-3xl lg:text-4xl font-bold text-gray-800">Kebijakan Pengiriman</h2>
        <p class="text-gray-500 mt-2">Panduan pengiriman pesanan Anda agar sampai dengan aman.</p>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-8 max-w-6xl mx-auto">
        
        <div class="bg-white p-8 rounded-2xl shadow-sm border border-gray-100 hover:shadow-md transition-shadow">
            <h3 class="flex items-center text-xl font-bold text-gray-800 mb-4">
                <i class="fa-solid fa-map-location-dot text-amber-600 mr-3"></i> Alamat & Kurir
            </h3>
            <ul class="space-y-3 text-gray-600 leading-relaxed">
                <li class="flex items-start">
                    <i class="fa-solid fa-check text-green-500 mt-1.5 mr-3 text-xs"></i>
                    <span>Pesanan dikirim sesuai alamat yang tertera. <strong>Kecurangan alamat</strong> (di luar area yang dipilih) akan menyebabkan pembatalan delivery (menjadi Pick-Up) dan biaya kirim hangus.</span>
                </li>
                <li class="flex items-start">
                    <i class="fa-solid fa-check text-green-500 mt-1.5 mr-3 text-xs"></i>
                    <span>Pengiriman menggunakan <strong>Ojek Online</strong> atau kurir langganan kami. Pemesanan ojol mandiri diperbolehkan sesuai kesepakatan.</span>
                </li>
            </ul>
        </div>

        <div class="bg-white p-8 rounded-2xl shadow-sm border border-gray-100 hover:shadow-md transition-shadow">
            <h3 class="flex items-center text-xl font-bold text-gray-800 mb-4">
                <i class="fa-solid fa-clock text-amber-600 mr-3"></i> Estimasi Waktu
            </h3>
            <ul class="space-y-3 text-gray-600 leading-relaxed">
                <li class="flex items-start">
                    <i class="fa-solid fa-circle-exclamation text-amber-500 mt-1.5 mr-3 text-xs"></i>
                    <span>Mohon beri jeda waktu <strong>± 1 jam</strong> dari waktu yang diinginkan untuk mengantisipasi macet atau cuaca.</span>
                </li>
                <li class="flex items-start">
                    <i class="fa-solid fa-circle-exclamation text-amber-500 mt-1.5 mr-3 text-xs"></i>
                    <span>Untuk pesanan acara (kue basah/hantaran), mohon request pengiriman <strong>1 jam sebelum acara dimulai</strong>.</span>
                </li>
            </ul>
        </div>

        <div class="bg-white p-8 rounded-2xl shadow-sm border border-gray-100 hover:shadow-md transition-shadow md:col-span-2">
            <h3 class="flex items-center text-xl font-bold text-gray-800 mb-4">
                <i class="fa-solid fa-shield-halved text-amber-600 mr-3"></i> Tanggung Jawab & Kondisi
            </h3>
            <div class="grid md:grid-cols-2 gap-6 text-gray-600 leading-relaxed">
                <div>
                    <p class="mb-3"><strong>Pengecekan Kue:</strong> Saat kurir tiba, mohon periksa kondisi kue bersama. Komplain hanya diterima saat kurir masih di lokasi.</p>
                    <p class="text-sm bg-red-50 text-red-700 p-3 rounded-lg border border-red-100">
                        <i class="fa-solid fa-triangle-exclamation mr-1"></i> Kami tidak bertanggung jawab atas kerusakan setelah kue berpindah tangan dari kurir ke penerima.
                    </p>
                </div>
                <div>
                    <p class="mb-3"><strong>Force Majeure:</strong> Kami tidak bertanggung jawab atas kegagalan pengiriman akibat bencana alam, kerusuhan, atau kejadian di luar kendali kami.</p>
                </div>
            </div>
        </div>

        <div class="bg-white p-8 rounded-2xl shadow-sm border border-gray-100 hover:shadow-md transition-shadow md:col-span-2">
            <h3 class="flex items-center text-xl font-bold text-gray-800 mb-4">
                <i class="fa-solid fa-building text-amber-600 mr-3"></i> Prosedur Penerimaan
            </h3>
            <ul class="space-y-4 text-gray-600 leading-relaxed">
                <li class="flex items-start">
                    <span class="bg-amber-100 text-amber-800 font-bold rounded-full w-6 h-6 flex items-center justify-center mr-3 text-xs flex-shrink-0">1</span>
                    <span><strong>Gedung/Kantor:</strong> Kurir hanya mengantar sampai Lobby/Pos Depan. Pastikan nomor HP aktif. Untuk pesanan banyak, mohon standby di Lobby.</span>
                </li>
                <li class="flex items-start">
                    <span class="bg-amber-100 text-amber-800 font-bold rounded-full w-6 h-6 flex items-center justify-center mr-3 text-xs flex-shrink-0">2</span>
                    <span><strong>Waktu Tunggu:</strong> Kurir menunggu maksimal <strong>30 menit</strong>. Jika tidak ada respons, kurir berhak membawa kembali pesanan dan melanjutkan rute lain.</span>
                </li>
                <li class="flex items-start">
                    <span class="bg-amber-100 text-amber-800 font-bold rounded-full w-6 h-6 flex items-center justify-center mr-3 text-xs flex-shrink-0">3</span>
                    <span>Jika berhalangan, mohon infokan via WhatsApp (H-1) mengenai orang lain yang bisa menerima atau tempat penitipan paket.</span>
                </li>
            </ul>
        </div>

    </div>

    <div class="flex flex-col-reverse md:flex-row justify-between items-center max-w-6xl mx-auto mt-12 gap-4">
        <a href="{{ route('syarat-ketentuan.payment') }}" 
           class="group flex items-center gap-2 px-6 py-3 rounded-xl border-2 border-gray-200 text-gray-600 font-semibold hover:border-amber-600 hover:text-amber-600 transition-all w-full md:w-auto justify-center">
            <i class="fa-solid fa-arrow-left group-hover:-translate-x-1 transition-transform"></i> Sebelumnya: Payment
        </a>
        <a href="{{ route('syarat-ketentuan.pickup') }}" 
           class="group flex items-center gap-2 px-8 py-3 rounded-xl bg-amber-700 text-white font-semibold hover:bg-amber-800 hover:shadow-lg transition-all w-full md:w-auto justify-center">
            Selanjutnya: Pick-Up <i class="fa-solid fa-arrow-right group-hover:translate-x-1 transition-transform"></i>
        </a>
    </div>
</div>
@endsection