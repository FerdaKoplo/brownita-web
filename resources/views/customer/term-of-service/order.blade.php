@extends('layout.customer.app')
@section('title', 'Order - Syarat & Ketentuan')

@section('content')
    <div class="min-h-screen bg-gray-50 px-4 lg:px-32 py-12">

        <div class="text-center mb-12">
            <div class="inline-flex items-center justify-center w-16 h-16 bg-amber-100 text-amber-800 rounded-full mb-4">
                <i class="fa-solid fa-cart-plus text-2xl"></i>
            </div>
            <h2 class="text-3xl lg:text-4xl font-bold text-gray-800">Aturan Pemesanan</h2>
            <p class="text-gray-500 mt-2">Panduan melakukan order agar pesanan Anda diproses dengan lancar.</p>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 max-w-6xl mx-auto">

            <div class="bg-white p-8 rounded-2xl shadow-sm border border-gray-100 hover:shadow-md transition-shadow">
                <h3 class="flex items-center text-xl font-bold text-gray-800 mb-6">
                    <i class="fa-regular fa-clock text-amber-600 mr-3"></i> Waktu Pemesanan (H-Min)
                </h3>
                <ul class="space-y-4 text-gray-600 leading-relaxed ">
                    <li class="flex gap-3">
                        <span class="font-bold text-amber-600">H-30:</span>
                        <span>Hantaran Luxury.</span>
                    </li>
                    <li class="flex gap-3">
                        <span class="font-bold text-amber-600">H-7:</span>
                        <span>Hantaran Deluxe, Nasi Kotak, Tumpeng, Kue Nampan, <br> Snackbox (selama slot tersedia).</span>
                    </li>
                    <li class="flex gap-3">
                        <span class="font-bold text-amber-600">H-1 / Hari H:</span>
                        <span>Khusus <strong>Gethuk</strong> (selama persediaan ada). <br>Kue dadakan lain harap konfirmasi
                            stok.</span>
                    </li>
                </ul>

                <div class="mt-8 pt-6 border-t border-gray-100">
                    <h4 class="font-bold text-gray-800 mb-3">Kontak Pemesanan (WhatsApp)</h4>
                    <div class="space-y-2">
                        <div class="flex items-center gap-2 p-3 bg-amber-50 rounded-lg text-amber-800">
                            <i class="fa-brands fa-whatsapp text-lg"></i>
                            <div>
                                <span class="block text-xs font-semibold uppercase text-amber-600">Hantaran & Catering</span>
                                <span class="font-mono text-lg font-bold">0812-1701-8289</span>
                            </div>
                        </div>
                        <div class="flex items-center gap-2 p-3 bg-amber-50 rounded-lg text-amber-800">
                            <i class="fa-brands fa-whatsapp text-lg"></i>
                            <div>
                                <span class="block text-xs font-semibold uppercase text-amber-600">Gethuk & Kursus</span>
                                <span class="font-mono text-lg font-bold">0812-3336-9606</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="space-y-8">
                <div class="bg-white p-8 rounded-2xl shadow-sm border border-gray-100 hover:shadow-md transition-shadow">
                    <h3 class="flex items-center text-xl font-bold text-gray-800 mb-4">
                        <i class="fa-solid fa-file-invoice-dollar text-amber-600 mr-3"></i> Pembayaran
                    </h3>
                    <ul class="list-disc list-outside pl-5 space-y-2 text-gray-600">
                        <li>Harga <strong>Fixed Price</strong> (Tidak dapat ditawar) dan dapat berubah sewaktu-waktu.</li>
                        <li>Wajib DP/Full Payment maksimal <strong>24 jam</strong> setelah tagihan diterima.</li>
                        <li>Pelunasan Hantaran/Nasi Kotak: <strong>H-3</strong>.</li>
                        <li>Pelunasan Kue Dadakan: <strong>H-1</strong>.</li>
                        <li>Kami berhak menolak order jika pembayaran tidak valid atau data pengiriman tidak lengkap.</li>
                    </ul>
                </div>

                <div class="bg-amber-50 p-8 rounded-2xl border border-amber-100">
                    <h3 class="flex items-center text-xl font-bold text-amber-800 mb-4">
                        <i class="fa-solid fa-pen-to-square mr-3"></i> Perubahan Order
                    </h3>
                    <p class="text-amber-900 mb-3 text-sm">
                        <i class="fa-solid fa-triangle-exclamation mr-1"></i> Perubahan maksimal H-3 (72 jam). Kurang dari
                        itu, order diproses sesuai data awal.
                    </p>
                    <ul class="list-disc list-outside pl-5 space-y-2 text-amber-900 text-sm">
                        <li>Maksimal revisi: <strong>2 kali</strong> per transaksi.</li>
                        <li>Mencakup: Produk, Ukuran, Rasa, Tulisan, Waktu & Alamat Kirim.</li>
                        <li>Kami <strong>tidak menyediakan lilin</strong> (hanya topper/kartu ucapan).</li>
                        <li>Tidak melayani permintaan foto hasil jadi kue.</li>
                    </ul>
                </div>
            </div>

        </div>

        <div class="flex flex-col-reverse md:flex-row justify-between items-center max-w-6xl mx-auto mt-12 gap-4">
            <a href="{{ route('syarat-ketentuan') }}"
                class="group flex items-center gap-2 px-6 py-3 rounded-xl border-2 border-gray-200 text-gray-600 font-semibold hover:border-amber-600 hover:text-amber-600 transition-all w-full md:w-auto justify-center">
                <i class="fa-solid fa-arrow-left group-hover:-translate-x-1 transition-transform"></i> Kembali ke Menu
            </a>
            <a href="{{ route('syarat-ketentuan.payment') }}"
                class="group flex items-center gap-2 px-8 py-3 rounded-xl bg-amber-700 text-white font-semibold hover:bg-amber-800 hover:shadow-lg transition-all w-full md:w-auto justify-center">
                Selanjutnya: Payment <i class="fa-solid fa-arrow-right group-hover:translate-x-1 transition-transform"></i>
            </a>
        </div>
    </div>
@endsection