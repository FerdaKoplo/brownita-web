@extends('layout.customer.app')
@section('title', 'Order - Syarat & Ketentuan | Brownita')
@section('content')
<div class="px-4 lg:px-32 py-10">
    <h2 id="orderTOSTitle" class="text-3xl lg:text-4xl font-bold text-brand-brown text-center mb-8 underline">Order</h2>
    <div class="grid grid-cols-1 md:grid-cols-2 gap-8 max-w-5xl mx-auto">
        <!-- Kolom Kiri -->
        <ol class="row-animate opacity-0 bg-amber-50 rounded-xl p-6 text-brand-brown text-lg space-y-3 list-decimal">
            <li>Pemesanan hantaran luxury minimum H-30, dan untuk hantaran deluxe minimum H-7 dengan catatan masih ada
                slot. Untuk nasi kotak, tumpeng, kue nampan, snackbox dan lain lain minimum H-7. Untuk kue kue lain yg
                sifatnya dadakan bisa ditanyakan lebih lanjut sesuai stok yang ada.</li>
            <li>Khusus Gethuk bisa pesan H-1 atau pada saat hari H selama persediaan masih ada.</li>
            <li>Pemesanan bisa dilakukan melalui wa admin yang sudah tercantum di instagram, atau pemesanan secara
                langsung/datang ke alamat kami.</li>
            <li>Pemesanan melalui wa admin yaitu: a. Hantaran, Catering, dll wa : 081217018289 b. Gethuk & kursus online
                wa : 081233369606</li>
            <li>Semua harga yang tercantum adalah dalam Rupiah (IDR) dan bersifat tetap (fixed price/non-negotiable).
            </li>
            <li>Harga dapat berubah sewaktu-waktu.</li>
            <li>Segera setelah menerima rincian total tagihan, customer wajib melakukan pembayaran full atau down
                payment maximal 24 jam setelah rincian tagihan diterima. Pelunasan adalah maximal H-3 untuk hantaran,
                nasi kotak, tumpeng, dll. Pelunasan H-1 untuk kue - kue dadakan atau sesuai dengan informasi yang kami
                berikan melalui whatsapp.</li>
            <li>Kami berhak untuk tidak memproses Order Anda, jika Kami tidak dapat memvalidasi Payment Anda atau
                Payment tersebut belum selesai. Kami juga berhak untuk tidak memproses Order Anda jika data yang Anda
                input, terutama data Delivery, tidak lengkap atau tidak benar.</li>
        </ol>
        <!-- Kolom Kanan -->
        <ol class="row-animate bg-[#f7f5e6] opacity-0 rounded-xl p-6 text-brand-brown text-lg space-y-3 list-decimal" type="a">
            <li>
                Jika ada perubahan atas Order,
                <ol class="list-[lower-alpha] pl-5">
                    <li>Mohon infokan perubahan tersebut paling lambat H-3 (72 jam) melalui Whatsapp Kami. Jika sudah
                        kurang dari H-3, perubahan tidak bisa Kami terima & Order akan Kami proses seperti semula.</li>
                    <li>Untuk 1 Order atau Transaksi, jumlah perubahan yang Kami tolerir hanya sebanyak 2 kali dan dalam
                        bentuk apapun (baik Product, Ukuran, Flavor, Warna, Tulisan, Data Pemesan, Waktu Delivery, Data
                        Penerima, dll.)</li>
                </ol>
            </li>
            <li>Kami hanya menyediakan topper/kartu ucapan dan tidak menyediakan lilin.</li>
            <li>Kami tidak melayani permintaan untuk pengambilan foto atas hasil jadi kue yang dipesan.</li>
        </ol>
    </div>
    <div class="flex justify-between max-w-5xl mx-auto mt-10">
        <a href="{{ route('syarat-ketentuan') }}"
            class="flex items-center gap-2 px-6 py-2 rounded-lg bg-amber-700 text-white font-semibold hover:bg-brand-brown transition">
            <i class="fa-solid fa-arrow-left"></i> Kembali
        </a>
        <a href="{{ route('syarat-ketentuan.payment') }}"
            class="flex items-center gap-2 px-6 py-2 rounded-lg bg-brand-brown text-black font-semibold hover:bg-black hover:text-white transition">
            <i class="fa-solid fa-credit-card"></i> Payment
        </a>
    </div>
</div>
@endsection
