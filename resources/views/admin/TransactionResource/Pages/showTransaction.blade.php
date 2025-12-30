@extends('layout.admin.layout')
@section('title', 'Detail Transaksi #' . $transaksi->id)

@section('content')
    <div class="p-6 bg-gray-50 min-h-screen space-y-6">

        <div class="flex items-center gap-2 text-sm text-gray-500 mb-2">
            <a href="{{ route('dashboard.admin.customer-transaction.view') }}" class="hover:text-amber-700 transition">
                <i class="fa-solid fa-arrow-left mr-1"></i> Kembali ke Riwayat
            </a>
            <span>/</span>
            <span class="text-gray-900 font-medium">Detail Order #{{ $transaksi->id }}</span>
        </div>

        <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
            <div>
                <h1 class="text-3xl font-bold text-gray-900 tracking-tight">Detail Transaksi</h1>
                <p class="text-gray-500 text-sm mt-1">
                    Dipesan pada {{ $transaksi->created_at->format('d F Y, H:i') }}
                </p>
            </div>

            @php
                $statusColors = [
                    'pending' => 'bg-yellow-100 text-yellow-700 border-yellow-200',
                    'dibayar' => 'bg-indigo-100 text-indigo-700 border-indigo-200',
                    'dikirim' => 'bg-blue-100 text-blue-700 border-blue-200',
                    'selesai' => 'bg-green-100 text-green-700 border-green-200',
                    'batal' => 'bg-red-100 text-red-700 border-red-200',
                ];
                $color = $statusColors[$transaksi->status] ?? 'bg-gray-100 text-gray-700';
            @endphp
            <div class="px-4 py-1.5 rounded-full border {{ $color }} font-bold uppercase text-sm tracking-wide">
                {{ $transaksi->status }}
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

            <div class="lg:col-span-2 space-y-6">

                <div class="bg-white border border-gray-200 rounded-xl shadow-sm overflow-hidden">
                    <div class="px-6 py-4 border-b border-gray-100 bg-gray-50 flex justify-between items-center">
                        <h3 class="font-bold text-gray-800">Item Pesanan</h3>
                        <span class="text-xs text-gray-500">{{ $transaksi->details->count() }} item</span>
                    </div>
                    <div class="overflow-x-auto">
                        <table class="w-full text-left">
                            <thead class="bg-white text-xs uppercase text-gray-500 font-semibold border-b border-gray-100">
                                <tr>
                                    <th class="px-6 py-4">Produk</th>
                                    <th class="px-6 py-4 text-center">Qty</th>
                                    <th class="px-6 py-4 text-right">Harga</th>
                                    <th class="px-6 py-4 text-right">Subtotal</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-50">
                                @foreach ($transaksi->details as $detail)
                                    <tr class="hover:bg-gray-50 transition">
                                        <td class="px-6 py-4">
                                            <div class="flex items-center gap-3">
                                                @if($detail->katalog && $detail->katalog->images->first())
                                                    <img src="{{ asset('storage/' . $detail->katalog->images->first()->gambar_produk) }}"
                                                        class="w-10 h-10 rounded object-cover border border-gray-200">
                                                @else
                                                    <div
                                                        class="w-10 h-10 bg-gray-100 rounded flex items-center justify-center text-gray-400 text-xs">
                                                        <i class="fa-solid fa-image"></i>
                                                    </div>
                                                @endif
                                                <div>
                                                    <p class="font-medium text-gray-900 text-sm">
                                                        {{ $detail->katalog->nama_produk ?? 'Produk Dihapus' }}
                                                    </p>
                                                    <p class="text-xs text-gray-500">
                                                        {{ $detail->katalog->category->nama_kategori ?? '-' }}
                                                    </p>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 text-center text-sm font-medium">{{ $detail->quantity }}</td>
                                        <td class="px-6 py-4 text-right text-sm text-gray-600">
                                            Rp {{ number_format($detail->harga_satuan, 0, ',', '.') }}
                                        </td>
                                        <td class="px-6 py-4 text-right text-sm font-bold text-gray-900">
                                            Rp {{ number_format($detail->quantity * $detail->harga_satuan, 0, ',', '.') }}
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                            <tfoot class="bg-gray-50 border-t border-gray-200">
                                <tr>
                                    <td colspan="3" class="px-6 py-4 text-right text-sm font-bold text-gray-600 uppercase">
                                        Total Pembayaran</td>
                                    <td class="px-6 py-4 text-right text-lg font-bold text-amber-700">
                                        Rp {{ number_format($transaksi->total_harga, 0, ',', '.') }}
                                    </td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>

                <div class="bg-white border border-gray-200 rounded-xl shadow-sm p-6">
                    <h3 class="font-bold text-gray-800 mb-4 flex items-center gap-2">
                        <i class="fa-solid fa-receipt text-amber-600"></i> Bukti Pembayaran
                    </h3>

                    @if($transaksi->bukti_pembayaran)
                        <div class="flex flex-col sm:flex-row gap-6 items-start">
                            <a href="{{ asset('storage/' . $transaksi->bukti_pembayaran) }}" target="_blank"
                                class="block w-full sm:w-1/3 group relative overflow-hidden rounded-lg border border-gray-200 shadow-sm">
                                <img src="{{ asset('storage/' . $transaksi->bukti_pembayaran) }}"
                                    class="w-full h-auto object-cover group-hover:scale-105 transition-transform duration-300">
                                <div
                                    class="absolute inset-0 bg-black/30 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity">
                                    <span class="text-white text-xs font-bold bg-black/50 px-2 py-1 rounded">
                                        <i class="fa-solid fa-magnifying-glass-plus"></i> Zoom
                                    </span>
                                </div>
                            </a>
                            <div class="flex-1 space-y-3">
                                <p class="text-sm text-gray-600">
                                    <span class="font-bold">Diupload:</span> {{ $transaksi->updated_at->format('d M Y, H:i') }}
                                </p>
                                <a href="{{ asset('storage/' . $transaksi->bukti_pembayaran) }}" download
                                    class="inline-flex items-center gap-2 px-4 py-2 bg-gray-100 hover:bg-gray-200 text-gray-700 text-sm font-medium rounded-lg transition">
                                    <i class="fa-solid fa-download"></i> Download Gambar
                                </a>
                            </div>
                        </div>
                    @else
                        <div
                            class="flex flex-col items-center justify-center py-8 bg-gray-50 border-2 border-dashed border-gray-200 rounded-lg text-gray-400">
                            <i class="fa-solid fa-image-slash text-3xl mb-2"></i>
                            <p class="text-sm">Belum ada bukti pembayaran diupload</p>
                        </div>
                    @endif
                </div>

            </div>

            <div class="space-y-6">

                <div class="bg-white border border-gray-200 rounded-xl shadow-sm p-6">
                    <h3 class="font-bold text-gray-800 mb-4 border-b border-gray-100 pb-2">Informasi Pelanggan</h3>

                    <div class="space-y-4">
                        <div class="flex items-center gap-3">
                            <div
                                class="w-10 h-10 rounded-full bg-amber-50 text-amber-700 flex items-center justify-center font-bold text-lg">
                                {{ substr($transaksi->user->name ?? '?', 0, 1) }}
                            </div>
                            <div>
                                <p class="text-sm font-bold text-gray-900">{{ $transaksi->user->name ?? 'Deleted User' }}
                                </p>
                                <p class="text-xs text-gray-500">{{ $transaksi->user->email ?? '-' }}</p>
                            </div>
                        </div>

                        @if($transaksi->user->no_handphone)
                            <div class="bg-gray-50 p-3 rounded-lg border border-gray-100">
                                <label class="text-xs font-bold text-gray-400 uppercase block mb-1">Kontak WhatsApp</label>
                                <div class="flex items-center justify-between">
                                    <span class="font-mono text-sm font-medium text-gray-800" id="phoneNum">
                                        {{ $transaksi->user->no_handphone }}
                                    </span>
                                    <div class="flex gap-2">
                                        <button onclick="copyToClipboard('{{ $transaksi->user->no_handphone }}')"
                                            class="w-7 h-7 flex items-center justify-center bg-white border border-gray-200 rounded text-gray-500 hover:text-blue-600 hover:border-blue-300 transition"
                                            title="Salin Nomor">
                                            <i class="fa-regular fa-copy text-xs"></i>
                                        </button>

                                        @php
                                            $rawPhone = $transaksi->user->no_handphone;
                                            if (Str::startsWith($rawPhone, '0')) {
                                                $rawPhone = '62' . substr($rawPhone, 1);
                                            }
                                            $waLink = "https://wa.me/{$rawPhone}?text=Halo%20kak%20{$transaksi->user->name},%20terkait%20pesanan%20ID%20#{$transaksi->id}...";
                                        @endphp
                                        <a href="{{ $waLink }}" target="_blank"
                                            class="w-7 h-7 flex items-center justify-center bg-green-50 border border-green-200 rounded text-green-600 hover:bg-green-100 transition"
                                            title="Chat WhatsApp">
                                            <i class="fa-brands fa-whatsapp text-sm"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        @endif

                        <div>
                            <label class="text-xs font-bold text-gray-400 uppercase block mb-1">Alamat Pengiriman</label>
                            <p
                                class="text-sm text-gray-700 bg-gray-50 p-3 rounded-lg border border-gray-100 leading-relaxed">
                                {{ $transaksi->alamat }}
                            </p>
                        </div>
                    </div>
                </div>

                <div class="bg-white border border-gray-200 rounded-xl shadow-sm p-6">
                    <h3 class="font-bold text-gray-800 mb-4">Update Status</h3>

                    <form action="{{ route('dashboard.admin.customer-transaction.update', $transaksi->id) }}" method="POST"
                        class="space-y-4">
                        @csrf
                        @method('PUT')

                        <div>
                            <label class="text-xs text-gray-500 mb-1 block">Ubah Status Pesanan</label>
                            <select name="status"
                                class="w-full px-3 py-2 border border-gray-300 rounded-lg text-sm focus:ring-amber-500 focus:border-amber-500 cursor-pointer">
                                <option value="pending" {{ $transaksi->status === 'pending' ? 'selected' : '' }}>Pending
                                    (Menunggu Bayar)</option>
                                <option value="dibayar" {{ $transaksi->status === 'dibayar' ? 'selected' : '' }}>Dibayar
                                    (Verifikasi Lunas)</option>
                                <option value="dikirim" {{ $transaksi->status === 'dikirim' ? 'selected' : '' }}>Dikirim
                                    (Sedang Diantar)</option>
                                <option value="selesai" {{ $transaksi->status === 'selesai' ? 'selected' : '' }}>Selesai
                                    (Diterima)</option>
                                <option value="batal" {{ $transaksi->status === 'batal' ? 'selected' : '' }}>Batalkan Pesanan
                                </option>
                            </select>
                        </div>

                        <button type="submit"
                            class="w-full py-2.5 bg-amber-700 hover:bg-amber-800 text-white font-bold rounded-lg shadow-sm transition flex items-center justify-center gap-2">
                            <i class="fa-solid fa-floppy-disk"></i> Simpan Perubahan
                        </button>
                    </form>
                </div>

            </div>
        </div>
    </div>

    <script>
        function copyToClipboard(text) {
            navigator.clipboard.writeText(text).then(() => {
                const btn = event.currentTarget;
                const originalIcon = btn.innerHTML;

                btn.innerHTML = '<i class="fa-solid fa-check text-green-600"></i>';
                btn.classList.add('border-green-300', 'bg-green-50');

                setTimeout(() => {
                    btn.innerHTML = originalIcon;
                    btn.classList.remove('border-green-300', 'bg-green-50');
                }, 2000);
            });
        }
    </script>
@endsection