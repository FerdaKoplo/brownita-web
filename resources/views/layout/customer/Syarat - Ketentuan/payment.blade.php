<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment - Syarat & Ketentuan | Brownita</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        'brand-primary': '#6B7280',
                        'brand-secondary': '#607274',
                        'brand-light': '#E4D2A3',
                        'brand-brown': '#6C4E31',
                        'brand-cream': '#E4D2A3'
                    },
                    fontFamily: {
                        'kameron': ['serif']
                    }
                }
            }
        }
    </script>
</head>
<body class="bg-brand-cream min-h-screen">
    <nav class="bg-brand-secondary px-8 lg:px-32 py-5 top-0 sticky z-50">
        <div class="text-white flex justify-between items-center">
            <h1 class="font-kameron text-2xl font-bold">
                <a href="{{ route('landing.page') }}" class="hover:text-brand-light transition-colors duration-300">
                    BROWNITA
                </a>
            </h1>
            <ul class="hidden md:flex items-center gap-8 lg:gap-12">
                <li>
                    <a href="{{ route('landing.page') }}" class="hover:text-brand-light transition-colors duration-300">
                        Beranda
                    </a>
                </li>
                <li>
                    <a href="{{ route('syarat-ketentuan') }}" class="text-brand-light font-semibold">
                        Syarat & Ketentuan
                    </a>
                </li>
                <li>
                    <a href="{{ route('produk-kami') }}" class="hover:text-brand-light transition-colors duration-300">
                        Produk Kami
                    </a>
                </li>
                <li class="flex gap-4 ml-4">
                    <a href="{{ route('login') }}" class="font-semibold border-brand-light border-2 hover:bg-brand-light hover:text-brand-secondary transition-all duration-300 px-5 py-1.5 rounded-full">
                        Login
                    </a>
                    <a href="{{ route('register') }}" class="font-semibold px-5 py-1.5 rounded-full bg-brand-light text-brand-secondary hover:bg-opacity-90 transition-all duration-300">
                        Register
                    </a>
                </li>
            </ul>
        </div>
    </nav>

    <main class="px-4 lg:px-32 py-10">
        
        <h2 class="text-3xl lg:text-4xl font-bold text-brand-brown text-center mb-8 underline">Payment</h2>
        <ol class="bg-[#f7f5e6] rounded-xl p-6 text-brand-brown text-lg space-y-3 list-decimal max-w-3xl mx-auto">
            <li>Pembayaran dapat dilakukan melalui transfer atau tunai jika pemesanan dilakukan secara langsung dan datang ke tempat kami.</li>
            <li>Pembayaran untuk pemesanan hantaran, cake, catering, dll melalui rekening BCA 5065104455 dan BNI 0187814766 atas nama Nita Hawindati. Untuk gethuk & kursus online melalui rekening BCA 4290630091 atas nama Afida Noor.</li>
            <li>Tidak menerima pembayaran COD melalui kurir.</li>
            <li>Jika tidak ada Pembayaran hingga batas transfer yang ditentukan, Kami berhak membatalkan (Cancel) Order tersebut.</li>
            <li>Semua Payment yang sudah dilakukan bersifat non-Refundable & non-Cancellation. Payment akan kami refund sepenuhnya, jika perubahan/ kesalahan ada di pihak kami.</li>
            <li>Kami tidak bertanggung jawab atas pembayaran yang Anda lakukan kepada pihak perantara, jika ada.</li>
        </ol>
        <div class="flex justify-between max-w-3xl mx-auto mt-10">
            <a href="{{ route('syarat-ketentuan.order') }}" class="flex items-center gap-2 px-6 py-2 rounded-lg bg-brand-secondary text-white font-semibold hover:bg-brand-brown transition">
                <i class="fa-solid fa-arrow-left"></i> Kembali
            </a>
            <a href="{{ route('syarat-ketentuan.delivery') }}" class="flex items-center gap-2 px-6 py-2 rounded-lg bg-brand-brown text-white font-semibold hover:bg-brand-secondary transition">
                <i class="fa-solid fa-truck"></i> Delivery
            </a>
        </div>
    </main>
</body>
</html>