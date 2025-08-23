@extends('layout.customer.app')
@section('title', 'Payment - Syarat & Ketentuan | Brownita')
@section('content')
<main class="px-4 lg:px-32 py-10">
    <h2 id="paymentTitleTOS" class="text-3xl lg:text-4xl font-bold text-brand-brown text-center mb-8 underline">Payment</h2>
    <ol id="row-animate-payment" class="bg-amber-50 opacity-0 rounded-xl  p-6 text-brand-brown text-lg space-y-3 list-decimal max-w-3xl mx-auto">
        <li>Pembayaran dapat dilakukan melalui transfer atau tunai jika pemesanan dilakukan secara langsung dan datang
            ke tempat kami.</li>
        <li>Pembayaran untuk pemesanan hantaran, cake, catering, dll melalui rekening BCA 5065104455 dan BNI 0187814766
            atas nama Nita Hawindati. Untuk gethuk & kursus online melalui rekening BCA 4290630091 atas nama Afida Noor.
        </li>
        <li>Tidak menerima pembayaran COD melalui kurir.</li>
        <li>Jika tidak ada Pembayaran hingga batas transfer yang ditentukan, Kami berhak membatalkan (Cancel) Order
            tersebut.</li>
        <li>Semua Payment yang sudah dilakukan bersifat non-Refundable & non-Cancellation. Payment akan kami refund
            sepenuhnya, jika perubahan/ kesalahan ada di pihak kami.</li>
        <li>Kami tidak bertanggung jawab atas pembayaran yang Anda lakukan kepada pihak perantara, jika ada.</li>
    </ol>
    <div class="flex justify-between max-w-3xl mx-auto mt-10">
        <a href="{{ route('syarat-ketentuan.order') }}"
            class="flex items-center gap-2 px-6 py-2 rounded-lg bg-amber-700 text-white font-semibold hover:bg-brand-brown transition">
            <i class="fa-solid fa-arrow-left"></i> Kembali
        </a>
        <a href="{{ route('syarat-ketentuan.delivery') }}"
            class="flex items-center gap-2 px-6 py-2 rounded-lg bg-brand-brown text-black font-semibold hover:bg-black hover:text-white transition">
            <i class="fa-solid fa-truck"></i> Delivery
        </a>
    </div>
</main>
@endsection
