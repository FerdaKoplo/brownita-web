@extends('layout.customer.app')
@section('title', 'Pickup - Syarat & Ketentuan')

@section('content')
    <div class="min-h-screen bg-gray-50 px-4 lg:px-32 py-12">

        <div class="max-w-3xl mx-auto text-center">
            <div class="inline-flex items-center justify-center w-20 h-20 bg-amber-100 text-amber-800 rounded-full mb-6">
                <i class="fa-solid fa-shop text-3xl"></i>
            </div>
            <h2 class="text-3xl lg:text-4xl font-bold text-gray-800 mb-4">Pengambilan Sendiri (Pick-Up)</h2>
            <p class="text-gray-500 mb-10">
                Anda dapat mengambil pesanan langsung di lokasi kami untuk memastikan keamanan produk.
            </p>

            <div class="bg-white text-left p-8 md:p-10 rounded-3xl shadow-lg border border-gray-100">
                <ul class="space-y-6">
                    <li class="flex gap-4">
                        <div
                            class="flex-shrink-0 w-10 h-10 rounded-full bg-amber-50 flex items-center justify-center text-amber-700 font-bold">
                            1</div>
                        <div>
                            <h4 class="font-bold text-gray-800">Lokasi Pengambilan</h4>
                            <p class="text-gray-600 text-sm mt-1">Seluruh proses Pick Up hanya dilakukan di alamat toko
                                kami.</p>
                        </div>
                    </li>

                    <li class="flex gap-4">
                        <div
                            class="flex-shrink-0 w-10 h-10 rounded-full bg-amber-50 flex items-center justify-center text-amber-700 font-bold">
                            2</div>
                        <div>
                            <h4 class="font-bold text-gray-800">Pengaturan Kurir</h4>
                            <p class="text-gray-600 text-sm mt-1">
                                Anda bertanggung jawab penuh untuk memesan kurir (Gojek/Grab/Pribadi). Kami tidak memesankan
                                kurir untuk metode Pick-Up.
                            </p>
                        </div>
                    </li>

                    <li class="flex gap-4">
                        <div
                            class="flex-shrink-0 w-10 h-10 rounded-full bg-amber-50 flex items-center justify-center text-amber-700 font-bold">
                            3</div>
                        <div>
                            <h4 class="font-bold text-gray-800">Konfirmasi Waktu</h4>
                            <p class="text-gray-600 text-sm mt-1">
                                Mohon konfirmasi via WhatsApp sebelum jam pengambilan agar kami dapat memastikan pesanan
                                sudah siap.
                            </p>
                        </div>
                    </li>

                    <li class="flex gap-4">
                        <div
                            class="flex-shrink-0 w-10 h-10 rounded-full bg-red-50 flex items-center justify-center text-red-700 font-bold">
                            4</div>
                        <div>
                            <h4 class="font-bold text-gray-800">Tanggung Jawab Kerusakan</h4>
                            <p class="text-gray-600 text-sm mt-1">
                                Kami memastikan kue dalam kondisi sempurna saat meninggalkan toko. Segala kerusakan selama
                                perjalanan setelah meninggalkan lokasi kami adalah di luar tanggung jawab Brownita.
                            </p>
                        </div>
                    </li>
                </ul>
            </div>

            <div class="flex flex-col-reverse md:flex-row justify-between items-center mt-10 gap-4">
                <a href="{{ route('syarat-ketentuan.delivery') }}"
                    class="group flex items-center gap-2 px-6 py-3 rounded-xl border-2 border-gray-200 text-gray-600 font-semibold hover:border-amber-600 hover:text-amber-600 transition-all w-full md:w-auto justify-center">
                    <i class="fa-solid fa-arrow-left group-hover:-translate-x-1 transition-transform"></i> Sebelumnya:
                    Delivery
                </a>

                <a href="{{ route('syarat-ketentuan.order') }}"
                    class="group flex items-center gap-2 px-8 py-3 rounded-xl bg-gray-900 text-white font-semibold hover:bg-black hover:shadow-lg transition-all w-full md:w-auto justify-center">
                    <i class="fa-solid fa-rotate-right group-hover:rotate-180 transition-transform duration-500"></i>
                    Kembali ke Awal
                </a>
            </div>

        </div>
    </div>
@endsection