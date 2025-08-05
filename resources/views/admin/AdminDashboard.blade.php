@extends('layout.admin.layout')
@section('title', 'Dashboard')
@section('content')

    <div class="p-6">
        <h1 class="text-3xl font-bold mb-6">Eat me and fix your mood!</h1>

        <div class="grid grid-cols-2 gap-6">
            <div class="p-4 bg-pink-200  rounded-xl shadow">
                <h2 class="text-xl font-semibold">Total Transaksi</h2>
                <div class="flex items-center gap-5">
                    <i class="fa-solid fa-scroll text-3xl "></i>
                    <p class="text-3xl mt-2">{{ $totalTransaksi }}</p>
                </div>
            </div>

            <div class="p-4 bg-red-300  rounded-xl shadow">
                <h2 class="text-xl font-semibold">Total Produk</h2>
                <div class="flex items-center gap-5">
                    <i class="fa-solid fa-utensils text-3xl"></i>
                    <p class="text-3xl mt-2">{{ $totalProduk }}</p>
                </div>
            </div>
        </div>

        <div class="mt-10">
            <h2 class="text-xl font-bold mb-4">Status Transaksi</h2>
            <canvas id="statusChart" width="400" height="200"></canvas>
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
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    </script>

@endsection
