@extends('layout.admin.layout')
@section('title', 'Dashboard')
@section('content')

<div class="p-4 md:p-6 mt-7 md:mt-0  bg-gray-50">
    <h1 class="text-2xl md:text-3xl font-bold mb-6 text-center md:text-left">
        Eat me and fix your mood!
    </h1>

    <!-- Statistik -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 md:gap-6">
        <div class="p-4 bg-pink-200 rounded-xl shadow  flex flex-col items-center md:items-start">
            <h2 class="text-lg md:text-xl font-semibold">Total Transaksi</h2>
            <div class="flex items-center gap-4 mt-2">
                <i class="fa-solid fa-scroll text-2xl md:text-3xl"></i>
                <p class="text-2xl md:text-3xl">{{ $totalTransaksi }}</p>
            </div>
        </div>

        <div class="p-4 bg-red-300 rounded-xl shadow flex flex-col items-center md:items-start">
            <h2 class="text-lg md:text-xl font-semibold ">Total Produk</h2>
            <div class="flex items-center gap-4 mt-2 ">
                <i class="fa-solid fa-utensils text-2xl md:text-3xl"></i>
                <p class="text-2xl md:text-3xl font-medium">{{ $totalProduk }}</p>
            </div>
        </div>
    </div>

    <!-- Chart -->
    <div class="mt-10">
        <h2 class="text-lg md:text-xl font-bold mb-4 text-center md:text-left">Status Transaksi</h2>
        <div class="w-full h-64 md:h-96">
            <canvas id="statusChart"></canvas>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const ctx = document.getElementById('statusChart').getContext('2d');
    const statusChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: {!! json_encode(array_keys($statusTransaksi->toArray())) !!},
            datasets: [{
                label: 'Jumlah Transaksi',
                data: {!! json_encode(array_values($statusTransaksi->toArray())) !!},
                backgroundColor: ['#FFB6C1', '#F08080', '#CD5C5C', '#8B0000'],
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });
</script>

@endsection
