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

        <h1 class="text-3xl font-bold text-black text-center">
            Silakan Scan QR Gopay untuk Membayar
        </h1>

        <img src="{{ asset('images/qr.png') }}" alt="QR Gopay"
            class="w-60 h-auto rounded-lg shadow-xl hover:scale-105 transition-transform duration-300">

        <div class="text-lg text-black text-center bg-amber-700/20 p-4 rounded-lg  w-full">
            <p>Total yang harus dibayar:</p>
            <p class="text-2xl font-bold mt-2">Rp {{ number_format($transaksi->total_harga, 0, ',', '.') }}</p>
        </div>

        <div class="flex items-center gap-3 bg-amber-100 text-black px-4 py-3 rounded-lg  text-sm">
            <i class="fa-solid fa-circle-exclamation text-xl"></i>
            <p>Setelah pembayaran, admin akan memverifikasi secara manual.</p>
        </div>

        @if($transaksi->bukti_pembayaran)
            <div class="bg-green-100 p-6 rounded-lg text-center max-w-md mx-auto">
                <p class="text-green-700 font-semibold text-lg">Bukti pembayaran sudah diupload</p>
                <a href="{{ asset('storage/' . $transaksi->bukti_pembayaran) }}" target="_blank"
                class="mt-3 inline-block text-blue-600 hover:underline font-medium">
                    Lihat Bukti Pembayaran
                </a>
            </div>
        @else
            <form action="{{ route('customer.transaksi.uploadBukti', $transaksi->id) }}" method="POST"
                enctype="multipart/form-data" class="max-w-md mx-auto space-y-6">
                @csrf

                <label for="bukti_pembayaran" class="block mb-2 font-semibold text-gray-700 cursor-pointer">
                    Pilih File Bukti Pembayaran
                </label>

                <div class="relative">
                    <input id="bukti_pembayaran" type="file" name="bukti_pembayaran" accept="image/*" required
                        class="opacity-0 absolute inset-0 w-full h-full cursor-pointer" />

                    <div id="customFileBtn"
                        class="border border-amber-700 text-amber-700 hover:bg-amber-700 hover:text-white transition
                                rounded-lg py-3 px-4 text-center font-semibold cursor-pointer select-none">
                        Klik untuk memilih file...
                    </div>
                </div>

                <p class="text-sm text-gray-500">Format file: JPG, PNG. Maksimal ukuran: 2MB.</p>

                <img id="previewImage" src="#" alt="Preview Bukti Pembayaran"
                    class="hidden mt-4 mx-auto max-w-full rounded-lg shadow-lg border
                            opacity-0 transition-opacity duration-500" />

                <button type="submit"
                        class="w-full bg-amber-700 hover:bg-amber-800 text-white py-3 rounded-lg font-semibold
                            transition-colors duration-300">
                    Upload Bukti Pembayaran
                </button>
            </form>
        @endif
        <a href="{{ route('customer.transaksi.index') }}">
            <button
                class="bg-amber-700 hover:bg-black transition-colors duration-300 py-3 px-6 rounded-full text-white font-medium text-sm">
                Lihat Riwayat Transaksi
            </button>
        </a>
    </div>

    <script>
         const fileInput = document.getElementById('bukti_pembayaran');
        const customBtn = document.getElementById('customFileBtn');
        const previewImage = document.getElementById('previewImage');

        // Update button text when file selected
        fileInput.addEventListener('change', function () {
            if (fileInput.files.length === 0) {
                customBtn.textContent = 'Klik untuk memilih file...';
                previewImage.src = '#';
                previewImage.classList.add('opacity-0', 'hidden');
                return;
            }

            const file = fileInput.files[0];

            // Validate file type
            if (!file.type.startsWith('image/')) {
                alert('File harus berupa gambar!');
                fileInput.value = '';
                customBtn.textContent = 'Klik untuk memilih file...';
                previewImage.src = '#';
                previewImage.classList.add('opacity-0', 'hidden');
                return;
            }

            // Validate file size max 2MB
            if (file.size > 2 * 1024 * 1024) {
                alert('Ukuran file maksimal 2MB');
                fileInput.value = '';
                customBtn.textContent = 'Klik untuk memilih file...';
                previewImage.src = '#';
                previewImage.classList.add('opacity-0', 'hidden');
                return;
            }

            // Update button text
            customBtn.textContent = file.name;

            // Show preview with fade-in effect
            const reader = new FileReader();
            reader.onload = function (e) {
                previewImage.src = e.target.result;
                previewImage.classList.remove('hidden');
                setTimeout(() => {
                    previewImage.classList.remove('opacity-0');
                }, 10);
            };
            reader.readAsDataURL(file);
        });

        // Clicking custom button triggers file input click
        customBtn.addEventListener('click', () => {
            fileInput.click();
        });
    </script>
@endsection
