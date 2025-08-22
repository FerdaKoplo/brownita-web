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
                const expiryTime = new Date("{{ $transaksi->expires_at->format('Y-m-d\TH:i:s') }}").getTime();
                const countdownEl = document.getElementById("countdown");

                if (countdownEl) {
                    const interval = setInterval(() => {
                        const now = new Date().getTime();
                        const distance = expiryTime - now;

                        if (distance <= 0) {
                            clearInterval(interval);
                            countdownEl.innerHTML = "⏳ Waktu pembayaran sudah habis. Transaksi dibatalkan.";
                            window.location.reload();
                        } else {
                            const hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                            const minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
                            const seconds = Math.floor((distance % (1000 * 60)) / 1000);
                            countdownEl.innerHTML = `Bayar sebelum: ${hours} jam ${minutes} menit ${seconds} detik`;
                        }
                    }, 1000);
                }
            </script>
        @endif

        <div class="bg-white p-6 rounded-2xl shadow-md w-full text-center space-y-4">
            <h2 class="text-xl font-semibold text-gray-800">Scan untuk Membayar</h2>
            <img src="{{ asset('images/qr.png') }}" alt="QR Gopay"
                class="mx-auto w-56 h-auto rounded-lg shadow-lg border" />
            <p class="text-lg font-medium text-gray-600">Total yang harus dibayar:</p>
            <p class="text-3xl font-bold text-amber-700">Rp {{ number_format($transaksi->total_harga, 0, ',', '.') }}</p>
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
