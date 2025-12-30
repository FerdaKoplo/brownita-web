@extends('layout.admin.layout')
@section('title', 'Dashboard Overview')

@section('content')

<div class="p-6 bg-gray-50 min-h-screen space-y-8">

    <div class="flex flex-col md:flex-row md:items-end justify-between gap-4">
        <div>
            <h1 class="text-3xl font-bold text-gray-900 tracking-tight">Dashboard Overview</h1>
            <p class="text-gray-500 mt-1 font-medium">
                <span class="text-amber-600">"Eat me and fix your mood!"</span> — Have a productive day!
            </p>
        </div>
        <div class="bg-white border border-gray-200 px-4 py-2 rounded-lg shadow-sm text-sm text-gray-600 flex items-center gap-2">
            <i class="fa-regular fa-calendar"></i>
            {{ now()->format('l, d F Y') }}
        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        
        <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 relative overflow-hidden group hover:shadow-md transition-all">
            <div class="absolute top-0 right-0 p-4 opacity-10 group-hover:opacity-20 transition-opacity">
                <i class="fa-solid fa-receipt text-6xl text-amber-500 transform rotate-12"></i>
            </div>
            <div class="relative z-10 flex items-center gap-4">
                <div class="w-14 h-14 rounded-full bg-amber-50 text-amber-600 flex items-center justify-center text-2xl shadow-sm">
                    <i class="fa-solid fa-scroll"></i>
                </div>
                <div>
                    <p class="text-sm font-semibold text-gray-500 uppercase tracking-wide">Total Transaksi</p>
                    <h3 class="text-3xl font-bold text-gray-800 mt-1">{{ $totalTransaksi }}</h3>
                </div>
            </div>
            <div class="mt-4 flex items-center text-xs font-medium text-green-600 bg-green-50 w-fit px-2 py-1 rounded">
                <i class="fa-solid fa-arrow-up mr-1"></i> Data updated live
            </div>
        </div>

        <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 relative overflow-hidden group hover:shadow-md transition-all">
            <div class="absolute top-0 right-0 p-4 opacity-10 group-hover:opacity-20 transition-opacity">
                <i class="fa-solid fa-cake-candles text-6xl text-rose-500 transform -rotate-12"></i>
            </div>
            <div class="relative z-10 flex items-center gap-4">
                <div class="w-14 h-14 rounded-full bg-rose-50 text-rose-600 flex items-center justify-center text-2xl shadow-sm">
                    <i class="fa-solid fa-utensils"></i>
                </div>
                <div>
                    <p class="text-sm font-semibold text-gray-500 uppercase tracking-wide">Total Menu</p>
                    <h3 class="text-3xl font-bold text-gray-800 mt-1">{{ $totalProduk }}</h3>
                </div>
            </div>
            <div class="mt-4 flex items-center text-xs font-medium text-gray-500">
                Active products in catalog
            </div>
        </div>

        <div class="bg-gradient-to-br from-amber-700 to-orange-600 p-6 rounded-2xl shadow-lg text-white relative overflow-hidden">
            <div class="relative z-10">
                <h3 class="font-bold text-lg mb-1">Aksi Cepat</h3>
                <p class="text-amber-100 text-sm mb-4">Kelola toko dengan cepat.</p>
                <div class="flex gap-2">
                    <a href="{{ route('dashboard.admin.katalog.create') }}" class="bg-white/20 hover:bg-white/30 backdrop-blur-sm px-3 py-2 rounded-lg text-sm font-medium transition">
                        + Produk
                    </a>
                    <a href="{{route('dashboard.admin.customer-transaction.view') }}" class="bg-white/20 hover:bg-white/30 backdrop-blur-sm px-3 py-2 rounded-lg text-sm font-medium transition">
                        Lihat Order
                    </a>
                </div>
            </div>
            <div class="absolute -bottom-10 -right-10 w-32 h-32 bg-white/10 rounded-full blur-2xl"></div>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <div class="lg:col-span-2 bg-white p-6 rounded-2xl shadow-sm border border-gray-100">
            <div class="flex justify-between items-center mb-6">
                <div>
                    <h2 class="text-lg font-bold text-gray-800">Analitik Pesanan</h2>
                    <p class="text-sm text-gray-500">Distribusi status transaksi saat ini</p>
                </div>
                <select class="text-xs border-gray-300 rounded-lg text-gray-500">
                    <option>Bulan Ini</option>
                    <option>Tahun Ini</option>
                </select>
            </div>
            
            <div class="relative w-full h-80">
                <canvas id="statusChart"></canvas>
            </div>
        </div>

        <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 flex flex-col">
            <h2 class="text-lg font-bold text-gray-800 mb-4">Status Overview</h2>
            <div class="flex-1 overflow-y-auto space-y-4 pr-2">
                @foreach($statusTransaksi as $status => $count)
                    <div class="flex items-center justify-between p-3 rounded-xl bg-gray-50 hover:bg-gray-100 transition">
                        <div class="flex items-center gap-3">
                            @php
                                $colors = [
                                    'pending' => 'bg-yellow-400',
                                    'dibayar' => 'bg-green-500',
                                    'selesai' => 'bg-blue-500',
                                    'batal' => 'bg-red-500'
                                ];
                                $bg = $colors[$status] ?? 'bg-gray-400';
                            @endphp
                            <div class="w-3 h-3 rounded-full {{ $bg }}"></div>
                            <span class="text-sm font-medium text-gray-700 capitalize">{{ $status }}</span>
                        </div>
                        <span class="font-bold text-gray-900">{{ $count }}</span>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const ctx = document.getElementById('statusChart').getContext('2d');
    
    const gradientPending = ctx.createLinearGradient(0, 0, 0, 400);
    gradientPending.addColorStop(0, '#FCD34D'); 
    gradientPending.addColorStop(1, '#F59E0B'); 

    const statusChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: {!! json_encode(array_keys($statusTransaksi->toArray())) !!}.map(label => label.charAt(0).toUpperCase() + label.slice(1)), // Capitalize labels
            datasets: [{
                label: 'Jumlah Transaksi',
                data: {!! json_encode(array_values($statusTransaksi->toArray())) !!},
                backgroundColor: [
                    'rgba(251, 191, 36, 0.8)', 
                    'rgba(34, 197, 94, 0.8)',   
                    'rgba(59, 130, 246, 0.8)',  
                    'rgba(239, 68, 68, 0.8)'    
                ],
                borderColor: [
                    '#d97706',
                    '#15803d',
                    '#1d4ed8',
                    '#b91c1c'
                ],
                borderWidth: 1,
                borderRadius: 6,
                borderSkipped: false,
                barThickness: 40,
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    display: false
                },
                tooltip: {
                    backgroundColor: '#1f2937',
                    padding: 12,
                    cornerRadius: 8,
                    titleFont: { size: 13 },
                    bodyFont: { size: 13 }
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    grid: {
                        color: '#f3f4f6',
                        borderDash: [5, 5]
                    },
                    ticks: {
                        font: { family: "'Inter', sans-serif" }
                    }
                },
                x: {
                    grid: {
                        display: false
                    },
                    ticks: {
                        font: { family: "'Inter', sans-serif", weight: 'bold' }
                    }
                }
            }
        }
    });
</script>

@endsection