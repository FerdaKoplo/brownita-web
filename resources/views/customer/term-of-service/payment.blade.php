@extends('layout.customer.app')
@section('title', 'Payment - Syarat & Ketentuan')

@section('content')
    <div class="min-h-screen bg-gray-50 px-4 lg:px-32 py-12">

        <div class="text-center mb-12">
            <div class="inline-flex items-center justify-center w-16 h-16 bg-amber-100 text-amber-800 rounded-full mb-4">
                <i class="fa-solid fa-credit-card text-2xl"></i>
            </div>
            <h2 class="text-3xl lg:text-4xl font-bold text-gray-800">Metode Pembayaran</h2>
            <p class="text-gray-500 mt-2">Informasi rekening dan kebijakan pembayaran.</p>
        </div>

        <div class="max-w-4xl mx-auto space-y-8">

            <div class="bg-white rounded-2xl shadow-lg border border-gray-100 overflow-hidden">
                <div class="bg-amber-700 p-4 text-white text-center font-bold uppercase tracking-wider text-sm">
                    Rekening Resmi Brownita
                </div>
                <div class="p-8 grid md:grid-cols-2 gap-8">

                    <div class="flex flex-col items-center text-center p-4 bg-gray-50 rounded-xl border border-gray-200">
                        <span class="text-xs text-gray-500 font-bold uppercase mb-2">Hantaran, Cake, Catering</span>
                        <div class="flex gap-2 mb-3">
                            <img src="https://upload.wikimedia.org/wikipedia/commons/5/5c/Bank_Central_Asia.svg" alt="BCA"
                                class="h-6">
                            <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/f/f0/Bank_Negara_Indonesia_logo_%282004%29.svg/1200px-Bank_Negara_Indonesia_logo_%282004%29.svg.png" alt="BNI" class="h-6">
                        </div>
                        <div class="space-y-1">
                            <p class="font-mono text-xl font-bold text-gray-800">5065104455 (BCA)</p>
                            <p class="font-mono text-xl font-bold text-gray-800">0187814766 (BNI)</p>
                        </div>
                        <p class="text-sm text-gray-500 mt-2">a.n Nita Hawindati</p>
                    </div>

                    <div class="flex flex-col items-center text-center p-4 bg-gray-50 rounded-xl border border-gray-200">
                        <span class="text-xs text-gray-500 font-bold uppercase mb-2">Gethuk & Kursus Online</span>
                        <div class="mb-3">
                            <img src="https://upload.wikimedia.org/wikipedia/commons/5/5c/Bank_Central_Asia.svg" alt="BCA"
                                class="h-6">
                        </div>
                        <p class="font-mono text-xl font-bold text-gray-800">4290630091</p>
                        <p class="text-sm text-gray-500 mt-2">a.n Afida Noor</p>
                    </div>

                </div>
            </div>

            <div class="bg-white p-8 rounded-2xl shadow-sm border border-gray-100">
                <h3 class="font-bold text-gray-800 text-lg mb-4">Ketentuan Pembayaran</h3>
                <ul class="space-y-4 text-gray-600">
                    <li class="flex items-start">
                        <i class="fa-solid fa-circle-check text-green-500 mt-1 mr-3 text-sm"></i>
                        <span><strong>Tunai/Transfer:</strong> Pembayaran tunai hanya berlaku untuk pemesanan langsung di
                            tempat (offline store).</span>
                    </li>
                    <li class="flex items-start">
                        <i class="fa-solid fa-ban text-red-500 mt-1 mr-3 text-sm"></i>
                        <span><strong>No COD:</strong> Kami tidak menerima pembayaran Cash On Delivery (COD) melalui
                            kurir.</span>
                    </li>
                    <li class="flex items-start">
                        <i class="fa-solid fa-clock text-amber-500 mt-1 mr-3 text-sm"></i>
                        <span><strong>Batas Waktu:</strong> Order otomatis batal (Cancel) jika pembayaran tidak diterima
                            hingga batas waktu yang ditentukan.</span>
                    </li>
                    <li class="flex items-start">
                        <i class="fa-solid fa-file-shield text-gray-400 mt-1 mr-3 text-sm"></i>
                        <span><strong>Non-Refundable:</strong> Pembayaran yang sudah masuk tidak dapat
                            dibatalkan/dikembalikan, kecuali kesalahan berasal dari pihak kami.</span>
                    </li>
                </ul>
            </div>

        </div>

        <div class="flex flex-col-reverse md:flex-row justify-between items-center max-w-4xl mx-auto mt-12 gap-4">
            <a href="{{ route('syarat-ketentuan.order') }}"
                class="group flex items-center gap-2 px-6 py-3 rounded-xl border-2 border-gray-200 text-gray-600 font-semibold hover:border-amber-600 hover:text-amber-600 transition-all w-full md:w-auto justify-center">
                <i class="fa-solid fa-arrow-left group-hover:-translate-x-1 transition-transform"></i> Sebelumnya: Order
            </a>
            <a href="{{ route('syarat-ketentuan.delivery') }}"
                class="group flex items-center gap-2 px-8 py-3 rounded-xl bg-amber-700 text-white font-semibold hover:bg-amber-800 hover:shadow-lg transition-all w-full md:w-auto justify-center">
                Selanjutnya: Delivery <i class="fa-solid fa-arrow-right group-hover:translate-x-1 transition-transform"></i>
            </a>
        </div>
    </div>
@endsection