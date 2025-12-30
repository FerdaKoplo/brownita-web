@extends('layout.customer.app')
@section('title', 'Pembayaran')

@section('content')
<div class="min-h-screen bg-gray-50 py-12 px-4 flex justify-center items-start">
    <div class="w-full max-w-xl space-y-6">
        
        <a href="{{ route('customer.transaksi.index') }}" class="inline-flex items-center text-gray-500 hover:text-amber-700 transition font-medium mb-2">
            <i class="fa-solid fa-arrow-left mr-2"></i> Kembali ke Riwayat
        </a>

        @if($transaksi->status === 'pending' && $transaksi->expires_at)
            <div class="bg-red-50 border border-red-100 rounded-2xl p-4 flex items-center justify-center gap-3 text-red-700 shadow-sm animate-pulse">
                <i class="fa-regular fa-clock text-xl"></i>
                <span id="countdown" class="font-bold text-lg font-mono">Loading...</span>
            </div>
            <script>
                const expiryTime = {{ $transaksi->expires_at->getTimestamp() * 1000 }};
                const countdownEl = document.getElementById("countdown");
                
                if (countdownEl) {
                    const timer = setInterval(() => {
                        const now = Date.now();
                        const distance = expiryTime - now;
                        
                        if (distance < 0) {
                            clearInterval(timer);
                            countdownEl.innerHTML = "Waktu Habis";
                            window.location.reload(); 
                        } else {
                            const h = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                            const m = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
                            const s = Math.floor((distance % (1000 * 60)) / 1000);
                            countdownEl.innerHTML = `${h}j ${m}m ${s}d`;
                        }
                    }, 1000);
                }
            </script>
        @endif

        <div class="bg-white rounded-3xl shadow-xl border border-gray-100 overflow-hidden">
            
            <div class="bg-gradient-to-br from-amber-700 to-amber-800 p-8 text-center text-white relative overflow-hidden">
                <div class="absolute top-0 left-0 w-full h-full bg-white opacity-5 bg-[url('https://www.transparenttextures.com/patterns/food.png')]"></div>
                <p class="text-amber-100 uppercase tracking-widest text-xs font-bold mb-2">Total Tagihan</p>
                <h1 class="text-4xl font-extrabold tracking-tight">Rp {{ number_format($transaksi->total_harga, 0, ',', '.') }}</h1>
                <div class="mt-4 inline-block bg-white/20 px-3 py-1 rounded-full text-xs backdrop-blur-sm">
                    Order ID: #{{ $transaksi->id }}
                </div>
            </div>

            <div class="p-8 space-y-8">
                
                <div class="text-center">
                    <h3 class="text-gray-900 font-bold mb-4 flex items-center justify-center gap-2">
                        <i class="fa-solid fa-qrcode text-amber-600"></i> Scan QRIS
                    </h3>
                    <div class="bg-white border-2 border-gray-100 p-4 rounded-2xl inline-block shadow-sm">
                        <img src="{{ asset('images/qr.png') }}" alt="QR Code" class="w-48 h-48 object-contain">
                    </div>
                    <p class="text-xs text-gray-400 mt-2">Mendukung Gopay, OVO, Dana, ShopeePay, BCA Mobile</p>
                </div>

                <div class="relative flex items-center py-2">
                    <div class="flex-grow border-t border-gray-200"></div>
                    <span class="flex-shrink-0 mx-4 text-gray-400 text-xs uppercase font-bold tracking-widest">Atau Transfer</span>
                    <div class="flex-grow border-t border-gray-200"></div>
                </div>

                <div class="flex flex-col items-center gap-3">
                    <img src="{{ asset('images/mandiri_logo.svg') }}" alt="Mandiri" class="h-8 opacity-80">
                    <div class="bg-gray-50 rounded-xl p-4 w-full text-center border border-gray-200">
                        <p class="text-sm text-gray-500 mb-1">Bank Mandiri a.n Nita Hawindati</p>
                        <div class="flex items-center justify-center gap-3">
                            <span class="text-xl font-mono font-bold text-gray-800 tracking-wider">1420025698597</span>
                            <button onclick="navigator.clipboard.writeText('1420025698597')" class="text-amber-600 hover:text-amber-800" title="Copy">
                                <i class="fa-regular fa-copy"></i>
                            </button>
                        </div>
                    </div>
                </div>

            </div>

            <div class="bg-gray-50 p-8 border-t border-gray-100">
                @if($transaksi->bukti_pembayaran)
                    <div class="text-center">
                        <div class="w-16 h-16 bg-green-100 text-green-600 rounded-full flex items-center justify-center mx-auto mb-3">
                            <i class="fa-solid fa-check text-2xl"></i>
                        </div>
                        <h3 class="text-green-800 font-bold">Bukti Terkirim</h3>
                        <p class="text-green-600 text-sm">Admin sedang memverifikasi pembayaran Anda.</p>
                    </div>
                @else
                    <form action="{{ route('customer.transaksi.uploadBukti', $transaksi->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <label for="bukti_pembayaran" class="group relative flex flex-col items-center justify-center w-full h-40 border-2 border-dashed border-gray-300 rounded-2xl cursor-pointer bg-white hover:bg-amber-50 hover:border-amber-400 transition-all">
                            <div class="flex flex-col items-center justify-center pt-5 pb-6">
                                <i class="fa-solid fa-cloud-arrow-up text-3xl text-gray-400 group-hover:text-amber-500 mb-3 transition-colors"></i>
                                <p class="mb-1 text-sm text-gray-500"><span class="font-semibold text-gray-700">Klik untuk upload</span> bukti transfer</p>
                                <p class="text-xs text-gray-400">PNG, JPG (Max. 2MB)</p>
                            </div>
                            <input id="bukti_pembayaran" type="file" name="bukti_pembayaran" class="hidden" accept="image/*" />
                            
                            <img id="preview" class="absolute inset-0 w-full h-full object-cover rounded-2xl hidden opacity-90" />
                        </label>
                        
                        <button id="submitBtn" type="submit" disabled class="mt-4 w-full bg-gray-300 text-white font-bold py-3.5 rounded-xl cursor-not-allowed transition shadow-none">
                            Kirim Bukti Pembayaran
                        </button>
                    </form>
                @endif
            </div>
        </div>

        <div class="text-center">
            <a href="https://wa.me/6281217018289" target="_blank" class="inline-flex items-center gap-2 text-gray-500 hover:text-green-600 transition text-sm">
                <i class="fa-brands fa-whatsapp text-lg"></i> Butuh bantuan? Chat Admin
            </a>
        </div>

    </div>
</div>

<script>
    const fileInput = document.getElementById('bukti_pembayaran');
    const preview = document.getElementById('preview');
    const btn = document.getElementById('submitBtn');

    if(fileInput) {
        fileInput.addEventListener('change', function(e) {
            const file = e.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    preview.src = e.target.result;
                    preview.classList.remove('hidden');
                }
                reader.readAsDataURL(file);
                
                btn.disabled = false;
                btn.classList.remove('bg-gray-300', 'cursor-not-allowed', 'shadow-none');
                btn.classList.add('bg-amber-700', 'hover:bg-amber-800', 'shadow-lg', 'transform', 'active:scale-95');
            }
        });
    }
</script>
@endsection