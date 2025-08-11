@extends('layout.customer.app')
@section('title', 'Delivery - Syarat & Ketentuan | Brownita')
@section('content')
<div class="px-4 lg:px-32 py-10">
    <h2 class="text-3xl lg:text-4xl font-bold text-brand-brown text-center mb-8 underline">Delivery</h2>
    <div class="grid grid-cols-1 md:grid-cols-2 gap-8 max-w-5xl mx-auto">
        <!-- Kolom Kiri -->
        <ol class="bg-amber-50 rounded-xl p-6 text-brand-brown text-lg space-y-3 list-decimal">
            <li>Seluruh order hanya akan dikirim ke alamat sesuai yang anda tuliskan saat pemesanan. Jika ditemukan
                pemberian informasi yang salah atau kecurangan di bagian Delivery (alamat tidak sesuai dengan atau di
                luar dari Area Delivery yang dipilih) dalam bentuk apapun, baik disengaja maupun tidak, maka Kami berhak
                membatalkan Delivery, sehingga Order tersebut otomatis menjadi Pick Up & Uang Delivery dianggap hangus.
            </li>
            <li>Semua pengiriman adalah memakai ojek online atau kurir langganan dari pihak kami. Pemesanan ojek online
                bisa dilakukan oleh customer sesuai dengan kesepakatan.</li>
            <li>Kami tidak menjamin Delivery tiba tepat di jam tertentu. Mohon beri jeda ± 1 jam untuk alasan kemacetan,
                cuaca, dan kondisi jalan.</li>
            <li>Untuk kue basah/hantaran/nasi, mohon beri jeda setidaknya 1 jam sebelum acara. Misal acara jam 7, mohon
                infokan pengiriman maksimal jam 6.</li>
            <li>Kami tidak bertanggung jawab atas kerusakan, kesulitan maupun kegagalan pesanan, yang disebabkan
                kejadian memaksa (Force Majeure) atau berada di luar kendali yang tidak dapat dihindari dan diatasi
                dengan upaya yang wajar. Kejadian tersebut dapat berupa bencana alam (kebanjiran, kebakaran, dll.),
                pemadaman listrik, kerusuhan, sengketa, aturan, dan atau kebijakan pemerintah, dan kejadian lainnya yang
                mengakibatkan kegagalan pesanan tiba ke tempat tujuan.</li>
        </ol>
        <!-- Kolom Kanan -->
        <ol class="bg-amber-50 rounded-xl p-6 text-brand-brown text-lg space-y-3 list-decimal" type="a">
            <li>
                Saat Kurir tiba di lokasi, standard peraturan Kami untuk kurir & Penerima bersama memeriksa kondisi kue.
                Mohon laporkan komplain jika ditemukan kondisi kue kurang baik, dengan kehadiran Kurir kami. Kami tidak
                bertanggung jawab atas kondisi kue lebih dari poin tersebut, terlebih lagi jika sudah berpindah tangan
                dari Kurir kami, kepada Penerima, lalu kepada Anda.
            </li>
            <li>
                Untuk pengiriman ke gedung/perkantoran/hotel, kurir hanya mengantar sampai lobby/pos depan sesuai
                kebijaksanaan manajemen gedung, mohon pastikan no hp penerima aktif dan bisa dihubungi saat kurir kami
                tiba di lokasi. Khusus hantaran/pesanan lain dalam jumlah banyak mohon ada penerima yang standby di
                lobby/tempat yang sudah disepakati, kurir kami akan menginfokan posisi terakhir sesaat sebelum tiba di
                lokasi.
            </li>
            <li>
                Kurir kami hanya akan menunggu maksimal 30 menit, terhitung dari informasi Order tersebut telah tiba di
                lokasi Anda. Apabila:
                <ul class="list-disc pl-5">
                    <li>Tidak ada konfirmasi dari Pemesan maupun Penerima,</li>
                    <li>Tidak ada nomor kontak yang bisa dihubungi,</li>
                    <li>Tidak ada jawaban dari alamat yang tertulis,</li>
                    <li>Tidak ada tempat penitipan,</li>
                </ul>
                Maka Kurir berhak membawa kembali, dan akan melanjutkan Delivery ke alamat berikutnya, sehubungan dengan
                proses Delivery yang harus dilakukan oleh Kurir ke beberapa lokasi. Bila Penerima berhalangan menerima
                Delivery, dimohon kerjasamanya untuk memberi info ke Whatsapp kami mengenai di mana dan kepada siapa
                Order dapat dititipkan dan atas nama siapa. Konfirmasi terkait hal ini paling lambat H-1 sebelum
                pengiriman.
            </li>
        </ol>
    </div>
    <div class="flex justify-between max-w-5xl mx-auto mt-10">
        <a href="{{ route('syarat-ketentuan.payment') }}"
            class="flex items-center gap-2 px-6 py-2 rounded-lg bg-amber-700 text-white font-semibold hover:bg-brand-brown transition">
            <i class="fa-solid fa-arrow-left"></i> Kembali
        </a>
        <a href="{{ route('syarat-ketentuan.pickup') }}"
            class="flex items-center gap-2 px-6 py-2 rounded-lg bg-brand-brown text-black font-semibold hover:bg-black hover:text-white transition">
            <i class="fa-solid fa-person-walking-luggage"></i> Pick-Up
        </a>
    </div>
</div>
@endsection
