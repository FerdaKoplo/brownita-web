@extends('layout.customer.app')
@section('title', 'Pembayaran')

@section('content')
    <div class="flex flex-col items-center justify-center gap-10 p-6 md:p-10 max-w-xl mx-auto">
        <a href="{{ route('produk-kami') }}">
            <button
                class="bg-amber-700 hover:bg-black  transition-colors duration-300 py-2 px-6 rounded-full text-white font-semibold flex gap-2 items-center text-lg">
                <i class="fa-solid fa-chevron-left"></i>
                Kembali
            </button>
        </a>

        @if($transaksi->status === 'pending' && $transaksi->expires_at)
            <div class="bg-red-100 text-red-700 p-3 rounded-lg text-center">
                <p id="countdown" class="font-semibold"></p>
            </div>

            <script>
                // Use timestamp (milliseconds) to avoid timezone issues
                const expiryTime = {{ $transaksi->expires_at->getTimestamp() * 1000 }}
                                                                                                const countdownEl = document.getElementById("countdown")

                if (countdownEl) {
                    const interval = setInterval(() => {
                        const now = Date.now()
                        const distance = expiryTime - now

                        if (distance <= 0) {
                            clearInterval(interval);
                            countdownEl.innerHTML = "Waktu pembayaran sudah habis. Transaksi dibatalkan."
                        } else {
                            const hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60))
                            const minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60))
                            const seconds = Math.floor((distance % (1000 * 60)) / 1000)
                            countdownEl.innerHTML = `Bayar sebelum: ${hours} jam ${minutes} menit ${seconds} detik`
                        }
                    }, 1000)
                }
            </script>
        @endif

        @if($transaksi->status === 'batal')
            <div class="bg-red-100 text-red-700 p-3 rounded-lg text-center">
                <p class="font-semibold">Transaksi dibatalkan karena waktu pembayaran habis.</p>
            </div>
        @endif

        <div
            class="bg-white/90 backdrop-blur-md p-8 sm:p-10 rounded-2xl shadow-xl w-full max-w-lg mx-auto text-center space-y-10 border border-gray-100">

            <div class="space-y-1">
                <h2 class="text-3xl font-bold text-gray-800">Pembayaran</h2>
                <p class="text-gray-500 text-sm sm:text-base">Selesaikan pembayaran sebelum waktu habis</p>
            </div>

            <div class="space-y-5">
                <p class="text-gray-700 font-medium text-lg">Scan QR dengan aplikasi e-wallet Anda</p>

                <div class="bg-gray-50 rounded-xl p-6 shadow-sm flex flex-col items-center gap-5">
                    <p class="text-gray-800 font-semibold text-lg">Brownita Restoran</p>
                    <img src="{{ asset('images/qr.png') }}" alt="QR Gopay"
                        class="mx-auto w-48 sm:w-56 h-auto rounded-lg shadow-md border border-gray-300">
                    <p class="text-gray-400 text-xs sm:text-sm italic">Gunakan Gopay, OVO, Dana, atau e-wallet lain untuk scan</p>
                </div>
            </div>

            <div class="relative flex items-center justify-center">
                <div class="w-full h-px bg-gray-200"></div>
                <span class="absolute bg-white px-4 text-gray-400 text-sm font-medium">atau</span>
            </div>

            <div class="bg-gray-50 rounded-xl  p-6 shadow-sm flex flex-col items-center gap-5">
                <p class="text-gray-800 font-semibold text-lg">Transfer Bank</p>
                <img src="{{ asset('images/mandiri_logo.svg') }}" alt="mandiri" class="w-24 sm:w-28" />
                <div class="flex flex-col items-center gap-1">
                    <p class="text-gray-700 font-semibold">a.n <span class="text-amber-700">Nita Hawindati</span></p>
                    <p class="text-gray-900 text-xl font-bold tracking-wider">142•002•5698•597</p>
                </div>
                <p class="text-xs text-gray-400 italic">Pastikan nama penerima sesuai sebelum transfer</p>
            </div>

            <div class="bg-amber-50 rounded-xl p-6  text-center space-y-2">
                <p class="text-gray-700 text-base font-medium">Total yang harus dibayar</p>
                <p class="text-4xl sm:text-5xl font-bold text-amber-700">
                    Rp {{ number_format($transaksi->total_harga, 0, ',', '.') }}
                </p>
            </div>
        </div>



        <div class="flex items-center gap-3 bg-amber-100 text-black px-4 py-3 rounded-lg  text-sm">
            <i class="fa-solid fa-circle-exclamation text-xl"></i>
            <p>Setelah pembayaran, admin akan memverifikasi secara manual.</p>
        </div>

        @if($transaksi->bukti_pembayaran)
            <div class="bg-green-100 p-6 rounded-lg text-center max-w-md mx-auto">
                <p class="text-green-700 font-semibold text-lg">Bukti pembayaran sudah diupload</p>

            </div>
        @else
            <form action="{{ route('customer.transaksi.uploadBukti', $transaksi->id) }}" method="POST"
                enctype="multipart/form-data" class="max-w-md mx-auto space-y-6">
                @csrf
                <div class="bg-white p-6 rounded-2xl shadow-md w-full">
                    <h2 class="text-xl font-semibold text-gray-800 mb-4">Upload Bukti Pembayaran</h2>
                    <div
                        class="border-2 border-dashed border-amber-500 rounded-xl p-6 text-center cursor-pointer hover:bg-amber-50 transition">
                        <input id="bukti_pembayaran" type="file" name="bukti_pembayaran" accept="image/*" class="hidden"
                            required />
                        <label for="bukti_pembayaran" class="cursor-pointer text-gray-600">
                            <i class="fa-solid fa-cloud-arrow-up text-3xl text-amber-600 mb-2"></i>
                            <p class="font-medium">Klik untuk pilih file</p>
                            <p class="text-sm text-gray-400 mt-1">Format JPG/PNG, max 2MB</p>
                        </label>
                    </div>
                    <img id="previewImage" class="hidden mt-4 mx-auto max-h-56 rounded-lg shadow-md border" />
                    <button type="submit"
                        class="mt-6 w-full bg-amber-700 hover:bg-black text-white py-3 rounded-xl font-semibold transition">
                        Upload Bukti Pembayaran
                    </button>
                </div>
            </form>
        @endif

        <a href="{{ route('customer.transaksi.index') }}">
            <button
                class="bg-amber-700 hover:bg-black transition-colors duration-300 py-3 px-6 rounded-full text-white font-medium text-sm">
                Lihat Riwayat Transaksi
            </button>
        </a>

        <div class="bg-white p-4 rounded-xl gap-5 shadow-md flex items-center justify-between">
            <div>
                <p class="font-semibold text-gray-800">Butuh bantuan?</p>
                <p class="text-sm text-gray-500">Hubungi admin untuk konfirmasi lebih cepat.</p>
            </div>
            <a href="https://wa.me/6281217018289" target="_blank"
                class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-lg flex items-center gap-2">
                <i class="fa-brands fa-whatsapp"></i> Chat
            </a>
        </div>

    </div>

    <script>
        const fileInput = document.getElementById('bukti_pembayaran');
        const previewImage = document.getElementById('previewImage');
        const submitBtn = document.querySelector('button[type="submit"]');

        fileInput.addEventListener('change', function () {
            submitBtn.disabled = fileInput.files.length === 0;

            if (fileInput.files.length === 0) {
                previewImage.src = '#';
                previewImage.classList.add('hidden');
                return;
            }

            const file = fileInput.files[0];

            if (!file.type.startsWith('image/')) {
                alert('File harus berupa gambar!');
                fileInput.value = '';
                previewImage.classList.add('hidden');
                return;
            }

            if (file.size > 2 * 1024 * 1024) {
                alert('Ukuran file maksimal 2MB');
                fileInput.value = '';
                previewImage.classList.add('hidden');
                return;
            }

            const reader = new FileReader();
            reader.onload = function (e) {
                previewImage.src = e.target.result;
                previewImage.classList.remove('hidden');
            };
            reader.readAsDataURL(file);
        });
    </script>
@endsection