@extends('layout.customer.app')
@section('title', 'Syarat - Ketentuan')
@section('content')
    <div class="px-8 lg:px-32 py-16">
        <!-- Header Section -->
        <div class="text-center mb-16">
            <h2 class="text-4xl lg:text-5xl font-bold text-brand-brown mb-4">
                Syarat & Ketentuan
            </h2>
            <div class="w-32 h-1 bg-brand-brown mx-auto mb-8"></div>
            <p class="text-brand-brown text-lg lg:text-xl max-w-4xl mx-auto leading-relaxed">
                Selamat datang di Brownita (Pricelist kami). Kami <br>
                menganjurkan anda untuk membaca dan memahami <br>
                Syarat dan Ketentuan ini dengan seksama.
            </p>
        </div>

        <!-- Process Steps -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 max-w-6xl mx-auto">
            <!-- Order -->
            <a href="{{ route('syarat-ketentuan.order') }}"
                class="flex flex-col items-center justify-center bg-amber-700 hover:bg-opacity-90 transition-all duration-300 rounded-2xl p-8 text-white shadow-lg cursor-pointer group focus:outline-none focus:ring-4 focus:ring-brand-light">
                <div class="mb-4">
                    <svg class="w-12 h-12 mx-auto group-hover:scale-110 transition-transform duration-300"
                        fill="currentColor" viewBox="0 0 24 24">
                        <g transform="matrix(0.71 0 0 0.71 12 12)">
                            <path style="fill: currentColor;" transform="translate(-16, -15.55)"
                                d="M 16 3.09375 L 7.09375 12 L 2 12 L 2 18 L 3.25 18 L 6.03125 27.28125 L 6.25 28 L 25.75 28 L 25.96875 27.28125 L 28.75 18 L 30 18 L 30 12 L 24.90625 12 Z M 16 5.9375 L 22.0625 12 L 9.9375 12 Z M 4 14 L 28 14 L 28 16 L 27.25 16 L 27.03125 16.71875 L 24.25 26 L 7.75 26 L 4.96875 16.71875 L 4.75 16 L 4 16 Z M 11 17 L 11 24 L 13 24 L 13 17 Z M 15 17 L 15 24 L 17 24 L 17 17 Z M 19 17 L 19 24 L 21 24 L 21 17 Z" />
                        </g>
                    </svg>
                </div>
                <span class="text-xl font-bold mt-2">Order</span>
            </a>
            <!-- Payment -->
            <a href="{{ route('syarat-ketentuan.payment') }}"
                class="flex flex-col items-center justify-center bg-amber-700 hover:bg-opacity-90 transition-all duration-300 rounded-2xl p-8 text-white shadow-lg cursor-pointer group focus:outline-none focus:ring-4 focus:ring-brand-light">
                <div class="mb-4">
                    <svg class="w-12 h-12 mx-auto group-hover:scale-110 transition-transform duration-300"
                        fill="currentColor" viewBox="0 0 24 24">
                        <path
                            d="M20 4H4C2.89 4 2.01 4.89 2.01 6L2 18C2 19.11 2.89 20 4 20H20C21.11 20 22 19.11 22 18V6C22 4.89 21.11 4 20 4ZM20 18H4V12H20V18ZM20 8H4V6H20V8Z" />
                    </svg>
                </div>
                <span class="text-xl font-bold mt-2">Payment</span>
            </a>

            <!-- Delivery -->
            <a href="{{ route('syarat-ketentuan.delivery') }}"
                class="flex flex-col items-center justify-center bg-amber-700 hover:bg-opacity-90 transition-all duration-300 rounded-2xl p-8 text-white shadow-lg cursor-pointer group focus:outline-none focus:ring-4 focus:ring-brand-light">
                <div class="mb-4">
                    <svg class="w-12 h-12 mx-auto group-hover:scale-110 transition-transform duration-300"
                        fill="currentColor" viewBox="0 0 24 24">
                        <path
                            d="M19 7C19 5.9 18.1 5 17 5H15V4C15 2.9 14.1 2 13 2H11C9.9 2 9 2.9 9 4V5H7C5.9 5 5 5.9 5 7V19C5 20.1 5.9 21 7 21H17C18.1 21 19 20.1 19 19V7ZM11 4H13V5H11V4ZM17 19H7V7H9V8H15V7H17V19Z" />
                        <path d="M12 9L16 13H13V17H11V13H8L12 9Z" />
                    </svg>
                </div>
                <span class="text-xl font-bold mt-2">Delivery</span>
            </a>

            <!-- Pick-Up -->
            <a href="{{ route('syarat-ketentuan.pickup') }}"
                class="flex flex-col items-center justify-center bg-amber-700 hover:bg-opacity-90 transition-all duration-300 rounded-2xl p-8 text-white shadow-lg cursor-pointer group focus:outline-none focus:ring-4 focus:ring-brand-light">
                <div class="mb-4">
                    <svg class="w-12 h-12 mx-auto group-hover:scale-110 transition-transform duration-300"
                        fill="currentColor" viewBox="0 0 24 24">
                        <path
                            d="M12 2C13.1 2 14 2.9 14 4C14 5.1 13.1 6 12 6C10.9 6 10 5.1 10 4C10 2.9 10.9 2 12 2ZM21 9V7L15 1H9V3H13.5L19 8.5V9H21ZM9 7V21H15V7H9ZM11 9H13V11H11V9ZM11 13H13V15H11V13ZM11 17H13V19H11V17Z" />
                    </svg>
                </div>
                <span class="text-xl font-bold mt-2">Pick-Up</span>
            </a>
        </div>
    </div>
@endsection
