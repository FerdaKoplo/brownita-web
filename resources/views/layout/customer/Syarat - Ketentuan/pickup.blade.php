{{-- filepath: resources/views/layout/customer/Syarat - Ketentuan/pickup.blade.php --}}
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pick-Up - Syarat & Ketentuan | Brownita</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css"
        integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
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
        <h2 class="text-3xl lg:text-4xl font-bold text-brand-brown text-center mb-8 underline">Pick-Up</h2>
        <ol class="bg-[#f7f5e6] rounded-xl p-6 text-brand-brown text-lg space-y-3 list-decimal max-w-4xl mx-auto border border-brand-brown">
            <li>Seluruh Pick Up hanya dilakukan di alamat kami.</li>
            <li>Anda bertanggung jawab untuk memesan atau mengatur kurir Pick Up. Kurir Pick Up tidak pernah dipesan dari pihak Kami.</li>
            <li>Saat melakukan Pick Up, mohon pastikan/infokan kembali ke kami sebelum jam pick up untuk memastikan pesanan sudah disiapkan.</li>
            <li>Kondisi Kue/pesanan dalam keadaan baik. Kami tegaskan bahwa setiap Kue/pesanan ada dalam kondisi baik saat meninggalkan tempat Kami. Kami tidak bertanggung jawab atas kondisi kue/pesanan setelah meninggalkan tempat kami.</li>
        </ol>
        <div class="flex justify-between max-w-4xl mx-auto mt-10 gap-4">
            <a href="{{ route('syarat-ketentuan.delivery') }}" class="flex items-center gap-2 px-8 py-3 rounded-lg bg-brand-brown text-white font-semibold hover:bg-brand-secondary transition text-lg">
                <i class="fa-solid fa-arrow-left"></i> Kembali
            </a>
            <a href="{{ route('syarat-ketentuan.order') }}" class="flex items-center gap-2 px-8 py-3 rounded-lg border-2 border-brand-brown text-brand-brown font-semibold hover:bg-brand-brown hover:text-white transition text-lg bg-transparent">
                <i class="fa-solid fa-cart-shopping"></i> Order
            </a>
        </div>
    </main>

    @include('components.customer.whatsapp.whatsapp')
</body>
</html>