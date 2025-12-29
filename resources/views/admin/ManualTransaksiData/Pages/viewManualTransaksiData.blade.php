@extends('layout.admin.layout')
@section('title', 'Manual Transaksi')

@section('content')
    <div class="p-6 bg-gray-50 min-h-screen space-y-6" x-data="manualTransaksiForm()">
        
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
            <div>
                <h1 class="text-3xl font-bold text-gray-900 tracking-tight">Manual Transaksi</h1>
                <p class="text-gray-500 text-sm mt-1">Input pesanan manual (Pre-order / WhatsApp).</p>
            </div>
            <button @click="toggleForm()"
                class="flex items-center gap-2 bg-amber-700 hover:bg-amber-800 text-white px-5 py-2.5 rounded-xl font-semibold shadow-lg shadow-amber-900/20 transition-all hover:-translate-y-0.5">
                <i class="fa-solid" :class="formVisible ? 'fa-times' : 'fa-plus'"></i>
                <span x-text="formVisible ? 'Tutup Form' : 'Buat Transaksi Baru'"></span>
            </button>
        </div>

        <div x-show="formVisible" 
             x-collapse 
             class="bg-white border border-gray-200 rounded-2xl shadow-lg relative z-10 overflow-hidden">
            
            <div class="bg-gray-50 px-6 py-4 border-b border-gray-200 flex justify-between items-center">
                <h2 class="text-lg font-bold text-gray-800" x-text="mode === 'create' ? 'Input Transaksi Baru' : 'Edit Transaksi'"></h2>
                <span class="text-xs text-gray-500 italic">* Wajib diisi</span>
            </div>

            <form @submit.prevent="submitForm" class="p-6 sm:p-8 space-y-8">
                
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                    <div class="space-y-4">
                        <h3 class="text-sm font-bold text-amber-700 uppercase tracking-wider border-b border-gray-100 pb-2">Informasi Pelanggan</h3>
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <div class="col-span-2 sm:col-span-1">
                                <label class="block text-xs font-semibold text-gray-500 uppercase mb-1">Nama Customer</label>
                                <input type="text" x-model="form.customer_name" class="w-full border-gray-300 rounded-lg text-sm focus:ring-amber-500 focus:border-amber-500" placeholder="Contoh: Budi Santoso">
                            </div>
                            <div class="col-span-2 sm:col-span-1">
                                <label class="block text-xs font-semibold text-gray-500 uppercase mb-1">No. WhatsApp</label>
                                <input type="text" x-model="form.customer_phone" class="w-full border-gray-300 rounded-lg text-sm focus:ring-amber-500 focus:border-amber-500" placeholder="0812...">
                            </div>
                            <div class="col-span-2">
                                <label class="block text-xs font-semibold text-gray-500 uppercase mb-1">Alamat Lengkap</label>
                                <textarea x-model="form.alamat" rows="2" class="w-full border-gray-300 rounded-lg text-sm focus:ring-amber-500 focus:border-amber-500 resize-none" placeholder="Alamat pengiriman..."></textarea>
                            </div>
                        </div>
                    </div>

                    <div class="space-y-4">
                        <h3 class="text-sm font-bold text-amber-700 uppercase tracking-wider border-b border-gray-100 pb-2">Detail Pesanan</h3>
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <div>
                                <label class="block text-xs font-semibold text-gray-500 uppercase mb-1">Tanggal Transaksi</label>
                                <input type="date" x-model="form.tanggal_transaksi" class="w-full border-gray-300 rounded-lg text-sm focus:ring-amber-500 focus:border-amber-500">
                            </div>
                            <div>
                                <label class="block text-xs font-semibold text-gray-500 uppercase mb-1">Status Pembayaran</label>
                                <select x-model="form.status" class="w-full border-gray-300 rounded-lg text-sm focus:ring-amber-500 focus:border-amber-500">
                                    <option value="draft">Draft</option>
                                    <option value="pending">Pending</option>
                                    <option value="dibayar">Dibayar (Lunas)</option>
                                    <option value="selesai">Selesai (Dikirim)</option>
                                    <option value="dibatalkan">Dibatalkan</option>
                                </select>
                            </div>
                            <div class="col-span-2">
                                <label class="block text-xs font-semibold text-gray-500 uppercase mb-1">Tipe Pemesanan</label>
                                <select x-model="form.tipe_pemesanan" class="w-full border-gray-300 rounded-lg text-sm focus:ring-amber-500 focus:border-amber-500">
                                    <option value="">-- Pilih Tipe --</option>
                                    <option value="order-via-whatsapp">Order via WhatsApp (Ready Stock)</option>
                                    <option value="pre-order">Pre-Order (PO)</option>
                                </select>
                            </div>
                            
                            <div x-show="form.tipe_pemesanan === 'pre-order'" x-collapse class="col-span-2 grid grid-cols-2 gap-4 bg-gray-50 p-3 rounded-lg border border-gray-100">
                                <div>
                                    <label class="block text-xs font-semibold text-gray-800 mb-1">Mulai PO</label>
                                    <input type="date" x-model="form.preorder_start" class="w-full border-gray-200 rounded-lg text-sm focus:ring-gray-500">
                                </div>
                                <div>
                                    <label class="block text-xs font-semibold text-gray-800 mb-1">Deadline PO</label>
                                    <input type="date" x-model="form.preorder_deadline" class="w-full border-gray-200 rounded-lg text-sm focus:ring-gray-500">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="space-y-4">
                    <div class="flex justify-between items-center border-b border-gray-100 pb-2">
                        <h3 class="text-sm font-bold text-amber-700 uppercase tracking-wider">Keranjang Belanja</h3>
                        <button type="button" @click="addDetail()" class="text-xs bg-gray-100 hover:bg-gray-200 text-gray-700 px-3 py-1.5 rounded-lg transition font-medium flex items-center gap-1">
                            <i class="fa-solid fa-plus"></i> Tambah Baris
                        </button>
                    </div>

                    <div class="bg-gray-50/50 rounded-xl border border-gray-200 overflow-hidden">
                        <table class="w-full text-left">
                            <thead class="bg-gray-100 text-xs font-semibold text-gray-500 uppercase">
                                <tr>
                                    <th class="px-4 py-3">Nama Produk</th>
                                    <th class="px-4 py-3 w-24 text-center">Qty</th>
                                    <th class="px-4 py-3 w-48">Harga Satuan</th>
                                    <th class="px-4 py-3 w-48 text-right">Subtotal</th>
                                    <th class="px-4 py-3 w-10"></th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200">
                                <template x-for="(item, index) in form.details" :key="index">
                                    <tr class="group hover:bg-white transition">
                                        <td class="px-4 py-2">
                                            <input type="text" x-model="item.nama_produk" class="w-full border-gray-300 rounded text-sm py-1.5 focus:ring-amber-500 focus:border-amber-500" placeholder="Nama item...">
                                        </td>
                                        <td class="px-4 py-2">
                                            <input type="number" x-model="item.quantity" class="w-full border-gray-300 rounded text-sm py-1.5 text-center focus:ring-amber-500 focus:border-amber-500" min="1">
                                        </td>
                                        <td class="px-4 py-2">
                                            <div x-data="rupiahFormatter(item)" class="relative">
                                                <span class="absolute left-3 top-1/2 -translate-y-1/2 text-gray-500 text-xs">Rp</span>
                                                <input type="text" x-model="harga_tampil" x-on:input="formatInput" class="w-full border-gray-300 rounded text-sm py-1.5 pl-8 text-right focus:ring-amber-500 focus:border-amber-500">
                                            </div>
                                        </td>
                                        <td class="px-4 py-2 text-right font-medium text-gray-700">
                                            <span x-text="new Intl.NumberFormat('id-ID', { style: 'currency', currency: 'IDR' }).format(item.quantity * item.harga_satuan)"></span>
                                        </td>
                                        <td class="px-4 py-2 text-center">
                                            <button type="button" @click="removeDetail(index)" class="text-gray-400 hover:text-red-500 transition">
                                                <i class="fa-solid fa-trash-can"></i>
                                            </button>
                                        </td>
                                    </tr>
                                </template>
                            </tbody>
                            <tfoot class="bg-gray-50 border-t border-gray-200">
                                <tr>
                                    <td colspan="3" class="px-4 py-3 text-right font-bold text-gray-600 text-sm">Total Transaksi:</td>
                                    <td class="px-4 py-3 text-right font-bold text-amber-700 text-lg">
                                        <span x-text="new Intl.NumberFormat('id-ID', { style: 'currency', currency: 'IDR' }).format(form.details.reduce((sum, item) => sum + (item.quantity * item.harga_satuan), 0))"></span>
                                    </td>
                                    <td></td>
                                </tr>
                            </tfoot>
                        </table>
                        
                        <div x-show="form.details.length === 0" class="p-6 text-center text-gray-400 text-sm italic">
                            Belum ada produk ditambahkan. Klik tombol "Tambah Baris" di atas.
                        </div>
                    </div>
                </div>

                <div class="pt-4 border-t border-gray-100 flex justify-end gap-3">
                    <button type="button" @click="toggleForm()" class="px-5 py-2.5 rounded-lg border border-gray-300 text-gray-700 font-medium hover:bg-gray-50 transition">
                        Batal
                    </button>
                    <button type="submit" class="px-6 py-2.5 rounded-lg bg-amber-700 text-white font-bold shadow-lg shadow-amber-900/20 hover:bg-amber-800 transition transform hover:-translate-y-0.5">
                        <span x-text="mode === 'create' ? 'Simpan Transaksi' : 'Update Perubahan'"></span>
                    </button>
                </div>
            </form>
        </div>

        <div class="bg-white border border-gray-200 rounded-2xl shadow-sm overflow-hidden" x-show="!formVisible" x-transition.opacity>
            
            <div x-data="{ showAdvanced: {{ request()->hasAny(['from_date', 'status', 'tipe_pemesanan']) ? 'true' : 'false' }} }">
                <form action="{{ route('dashboard.admin.manual-transaksi.index') }}" method="GET" class="border-b border-gray-100">
                    <div class="p-5 flex flex-col md:flex-row gap-4 items-center justify-between bg-gray-50/50">
                        <div class="relative w-full md:max-w-md">
                            <i class="fa-solid fa-magnifying-glass absolute left-4 top-1/2 -translate-y-1/2 text-gray-400"></i>
                            <input type="text" name="search" value="{{ request('search') }}"
                                class="w-full pl-11 pr-4 py-2.5 bg-white border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-amber-500/20 focus:border-amber-500 transition-all shadow-sm"
                                placeholder="Cari Customer, No HP, atau Alamat...">
                        </div>
                        
                        <div class="flex gap-2 w-full md:w-auto">
                            <button type="button" @click="showAdvanced = !showAdvanced" class="flex-1 md:flex-none flex items-center justify-center gap-2 px-4 py-2.5 border border-gray-300 bg-white text-gray-700 rounded-lg hover:bg-gray-50 text-sm font-medium transition-colors" :class="showAdvanced ? 'bg-amber-50 border-amber-200 text-amber-700' : ''">
                                <i class="fa-solid fa-filter"></i> Filter
                            </button>
                            <button type="submit" class="flex-1 md:flex-none bg-amber-600 hover:bg-amber-700 text-white px-6 py-2.5 rounded-lg text-sm font-medium shadow-sm transition-colors">
                                Cari
                            </button>
                        </div>
                    </div>

                    <div x-show="showAdvanced" x-collapse class="p-5 bg-white grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-4 border-t border-gray-100">
                        <div>
                            <label class="block text-xs font-semibold text-gray-500 uppercase mb-1">Tipe</label>
                            <select name="tipe_pemesanan" class="w-full border-gray-300 rounded-lg text-sm">
                                <option value="">Semua</option>
                                <option value="pre-order" {{ request('tipe_pemesanan') == 'pre-order' ? 'selected' : '' }}>Pre-Order</option>
                                <option value="order-via-whatsapp" {{ request('tipe_pemesanan') == 'order-via-whatsapp' ? 'selected' : '' }}>WhatsApp</option>
                            </select>
                        </div>
                        <div>
                            <label class="block text-xs font-semibold text-gray-500 uppercase mb-1">Status</label>
                            <select name="status" class="w-full border-gray-300 rounded-lg text-sm">
                                <option value="">Semua</option>
                                <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                                <option value="dibayar" {{ request('status') == 'dibayar' ? 'selected' : '' }}>Dibayar</option>
                                <option value="selesai" {{ request('status') == 'selesai' ? 'selected' : '' }}>Selesai</option>
                            </select>
                        </div>
                        <div>
                            <label class="block text-xs font-semibold text-gray-500 uppercase mb-1">Dari Tanggal</label>
                            <input type="date" name="from_date" value="{{ request('from_date') }}" class="w-full border-gray-300 rounded-lg text-sm">
                        </div>
                        <div>
                            <label class="block text-xs font-semibold text-gray-500 uppercase mb-1">Sampai Tanggal</label>
                            <input type="date" name="to_date" value="{{ request('to_date') }}" class="w-full border-gray-300 rounded-lg text-sm">
                        </div>
                    </div>
                </form>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead class="bg-gray-50 border-b border-gray-200">
                        <tr>
                            <th class="px-6 py-4 text-xs font-semibold text-gray-500 uppercase tracking-wider">Info Transaksi</th>
                            <th class="px-6 py-4 text-xs font-semibold text-gray-500 uppercase tracking-wider">Pelanggan</th>
                            <th class="px-6 py-4 text-xs font-semibold text-gray-500 uppercase tracking-wider">Tipe & Status</th>
                            <th class="px-6 py-4 text-xs font-semibold text-gray-500 uppercase tracking-wider text-right">Total</th>
                            <th class="px-6 py-4 text-xs font-semibold text-gray-500 uppercase tracking-wider text-right">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100 bg-white">
                        @forelse ($manualTransaksiData as $transaction)
                            <tr class="group hover:bg-amber-50/30 transition-colors">
                                <td class="px-6 py-4">
                                    <div class="flex flex-col">
                                        <span class="text-xs text-gray-400 font-mono">#{{ $transaction->id }}</span>
                                        <span class="text-sm font-medium text-gray-900">{{ optional($transaction->tanggal_transaksi)->format('d M Y') }}</span>
                                        @if($transaction->tipe_pemesanan === 'pre-order')
                                            <span class="text-[10px] text-gray-800 mt-1">
                                                PO: {{ optional($transaction->preorder_deadline)->format('d/m') }}
                                            </span>
                                        @endif
                                    </div>
                                </td>
                                <td class="px-6 py-4">
                                    <div class="flex flex-col">
                                        <span class="font-bold text-gray-800">{{ $transaction->customer_name }}</span>
                                        <span class="text-xs text-gray-500 flex items-center gap-1">
                                            <i class="fa-brands fa-whatsapp"></i> {{ $transaction->customer_phone }}
                                        </span>
                                        <span class="text-xs text-gray-400 mt-1 truncate max-w-[150px]" title="{{ $transaction->alamat }}">
                                            {{ $transaction->alamat }}
                                        </span>
                                    </div>
                                </td>
                                <td class="px-6 py-4">
                                    <div class="flex flex-col items-start gap-1.5">
                                        @if($transaction->tipe_pemesanan == 'pre-order')
                                            <span class="px-2 py-0.5 rounded text-[10px] font-bold bg-blue-50 text-blue-600 border border-blue-100 uppercase tracking-wide">Pre-Order</span>
                                        @else
                                            <span class="px-2 py-0.5 rounded text-[10px] font-bold bg-green-50 text-green-600 border border-green-100 uppercase tracking-wide">WhatsApp</span>
                                        @endif

                                        @php
                                            $statusColors = [
                                                'draft' => 'bg-gray-100 text-gray-600',
                                                'pending' => 'bg-yellow-100 text-yellow-700',
                                                'dibayar' => 'bg-indigo-100 text-indigo-700',
                                                'selesai' => 'bg-green-100 text-green-700',
                                                'dibatalkan' => 'bg-red-100 text-red-700',
                                            ];
                                            $color = $statusColors[$transaction->status] ?? 'bg-gray-100 text-gray-600';
                                        @endphp
                                        <span class="px-2.5 py-1 rounded-full text-xs font-semibold {{ $color }}">
                                            {{ ucfirst($transaction->status) }}
                                        </span>
                                    </div>
                                </td>
                                <td class="px-6 py-4 text-right">
                                    <span class="text-sm font-bold text-gray-900">
                                        Rp {{ number_format($transaction->details->sum(fn($item) => $item->quantity * $item->harga_satuan), 0, ',', '.') }}
                                    </span>
                                    {{-- <div class="text-xs text-amber-600 cursor-pointer hover:underline mt-1" @click="openDetailModal(@js($transaction))">
                                        Lihat {{ $transaction->details->count() }} Produk
                                    </div> --}}
                                </td>
                                <td class="px-6 py-4 text-right">
                                    <div class="flex items-center justify-end gap-2">
                                        <button @click="editTransaction(@js($transaction))" class="p-2 bg-white border border-gray-200 rounded-lg text-gray-500 hover:text-blue-600 hover:border-blue-300 shadow-sm transition">
                                            <i class="fa-solid fa-pen-to-square"></i>
                                        </button>
                                        <form class="inline deleteForm" action="{{ route('dashboard.admin.manual-transaksi.destroy', $transaction->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="p-2 bg-white border border-gray-200 rounded-lg text-gray-500 hover:text-red-600 hover:border-red-300 shadow-sm transition">
                                                <i class="fa-solid fa-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="px-6 py-12 text-center text-gray-500">
                                    <div class="flex flex-col items-center gap-2">
                                        <i class="fa-solid fa-clipboard-list text-3xl text-gray-300"></i>
                                        <p>Belum ada data transaksi manual.</p>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            @if($manualTransaksiData->hasPages())
                <div class="px-6 py-4 border-t border-gray-100 bg-gray-50 flex flex-col sm:flex-row justify-between items-center gap-4">
                    <div class="text-sm text-gray-500">
                        Halaman <span class="font-medium">{{ $manualTransaksiData->currentPage() }}</span> dari <span class="font-medium">{{ $manualTransaksiData->lastPage() }}</span>
                    </div>
                    <div>
                        {{ $manualTransaksiData->appends(request()->query())->links('pagination::tailwind') }}
                    </div>
                </div>
            @endif
        </div>
    </div>

    <div x-show="detailModalVisible" 
         style="display: none"
         x-transition.opacity
         class="fixed inset-0 bg-black/50 z-50 flex items-center justify-center p-4 backdrop-blur-sm">
         
        <div @click.away="detailModalVisible = false" class="bg-white rounded-2xl shadow-2xl w-full max-w-2xl max-h-[90vh] overflow-hidden flex flex-col">
            <div class="p-6 border-b border-gray-100 flex justify-between items-start bg-gray-50">
                <div>
                    <h3 class="text-xl font-bold text-gray-900">Rincian Pesanan</h3>
                    <p class="text-sm text-gray-500" x-text="selectedTransaction?.customer_name + ' (' + selectedTransaction?.customer_phone + ')'"></p>
                </div>
                <button @click="detailModalVisible = false" class="text-gray-400 hover:text-gray-600 transition">
                    <i class="fa-solid fa-times text-xl"></i>
                </button>
            </div>
            
            <div class="p-0 overflow-y-auto">
                <table class="w-full text-left text-sm">
                    <thead class="bg-gray-100 text-gray-600 font-semibold border-b">
                        <tr>
                            <th class="px-6 py-3">Produk</th>
                            <th class="px-6 py-3 text-center">Qty</th>
                            <th class="px-6 py-3 text-right">Harga</th>
                            <th class="px-6 py-3 text-right">Total</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100" x-if="selectedTransaction">
                        <template x-for="detail in selectedTransaction?.details" :key="detail.id">
                            <tr>
                                <td class="px-6 py-3 font-medium text-gray-800" x-text="detail.nama_produk"></td>
                                <td class="px-6 py-3 text-center" x-text="detail.quantity"></td>
                                <td class="px-6 py-3 text-right text-gray-600" x-text="new Intl.NumberFormat('id-ID', { style: 'currency', currency: 'IDR' }).format(detail.harga_satuan)"></td>
                                <td class="px-6 py-3 text-right font-bold text-gray-800" x-text="new Intl.NumberFormat('id-ID', { style: 'currency', currency: 'IDR' }).format(detail.quantity * detail.harga_satuan)"></td>
                            </tr>
                        </template>
                    </tbody>
                </table>
            </div>

            <div class="p-6 border-t border-gray-100 bg-gray-50 text-right">
                <span class="text-gray-500 mr-2 text-sm">Total Pembayaran:</span>
                <span class="text-2xl font-bold text-amber-700" x-text="selectedTransaction ? new Intl.NumberFormat('id-ID', { style: 'currency', currency: 'IDR' }).format(selectedTransaction.details.reduce((acc, item) => acc + (item.quantity * item.harga_satuan), 0)) : 0"></span>
            </div>
        </div>
    </div>

    <script>
        function rupiahFormatter(item) {
            return {
                harga_tampil: item.harga_satuan ? new Intl.NumberFormat('id-ID').format(item.harga_satuan) : '',
                formatInput(e) {
                    let number_string = e.target.value.replace(/[^,\d]/g, '').toString();
                    let split = number_string.split(',');
                    let sisa = split[0].length % 3;
                    let rupiah = split[0].substr(0, sisa);
                    let ribuan = split[0].substr(sisa).match(/\d{3}/gi);

                    if (ribuan) {
                        separator = sisa ? '.' : '';
                        rupiah += separator + ribuan.join('.');
                    }

                    rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
                    this.harga_tampil = rupiah;
                    item.harga_satuan = parseInt(number_string.replace(/\./g, '')) || 0;
                }
            };
        }

        function manualTransaksiForm() {
            return {
                formVisible: false,
                mode: 'create',
                editingId: null,
                detailModalVisible: false,
                selectedTransaction: null,
                form: {
                    customer_name: '',
                    customer_phone: '',
                    alamat: '',
                    tanggal_transaksi: '',
                    status: 'draft',
                    tipe_pemesanan: '',
                    preorder_start: '',
                    preorder_deadline: '',
                    details: [],
                },
                toggleForm() {
                    this.formVisible = !this.formVisible;
                    if (!this.formVisible) this.resetForm();
                },
                resetForm() {
                    this.mode = 'create';
                    this.editingId = null;
                    this.form = {
                        customer_name: '',
                        customer_phone: '',
                        alamat: '',
                        tanggal_transaksi: new Date().toISOString().split('T')[0],
                        status: 'draft',
                        tipe_pemesanan: '',
                        preorder_start: '',
                        preorder_deadline: '',
                        details: [],
                    };
                    this.addDetail(); 
                },
                addDetail() {
                    this.form.details.push({ nama_produk: '', quantity: 1, harga_satuan: 0 });
                },
                removeDetail(index) {
                    this.form.details.splice(index, 1);
                },
                editTransaction(transaction) {
                    this.mode = 'edit';
                    this.editingId = transaction.id;
                    this.formVisible = true;
                    this.form = {
                        customer_name: transaction.customer_name,
                        customer_phone: transaction.customer_phone,
                        alamat: transaction.alamat,
                        tanggal_transaksi: transaction.tanggal_transaksi,
                        status: transaction.status,
                        tipe_pemesanan: transaction.tipe_pemesanan,
                        preorder_start: transaction.preorder_start,
                        preorder_deadline: transaction.preorder_deadline,
                        details: transaction.details.map(d => ({
                            nama_produk: d.nama_produk,
                            quantity: d.quantity,
                            harga_satuan: d.harga_satuan
                        }))
                    };
                    window.scrollTo({ top: 0, behavior: 'smooth' });
                },
                openDetailModal(transaction) {
                    this.selectedTransaction = transaction;
                    this.detailModalVisible = true;
                },
                async submitForm() {
                    try {
                        const url = this.mode === 'create'
                            ? "{{ route('dashboard.admin.manual-transaksi.store') }}"
                            : "{{ route('dashboard.admin.manual-transaksi.update', ':id') }}".replace(':id', this.editingId);
                        
                        const method = this.mode === 'create' ? 'POST' : 'PUT';

                        if(this.form.details.length === 0) {
                            Swal.fire({ icon: 'warning', title: 'Oops', text: 'Minimal masukan 1 produk' });
                            return;
                        }

                        const res = await fetch(url, {
                            method: method,
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                                'Accept': 'application/json'
                            },
                            body: JSON.stringify(this.form)
                        });

                        const data = await res.json();

                        if (!res.ok) {
                            let errorMsg = data.message || 'Terjadi kesalahan.';
                            Swal.fire({ icon: 'error', title: 'Gagal!', text: errorMsg });
                            return;
                        }

                        Swal.fire({ 
                            icon: 'success', 
                            title: 'Berhasil!', 
                            text: 'Transaksi berhasil disimpan',
                            timer: 1500,
                            showConfirmButton: false 
                        }).then(() => location.reload());

                    } catch (err) {
                        console.error(err);
                        Swal.fire({ icon: 'error', title: 'Error', text: 'Terjadi kesalahan koneksi.' });
                    }
                }
            };
        }
        
        document.addEventListener('submit', function (e) {
            if (e.target.classList.contains('deleteForm')) {
                e.preventDefault();
                Swal.fire({
                    title: 'Hapus Transaksi?',
                    text: "Data tidak bisa dikembalikan!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#3085d6',
                    confirmButtonText: 'Ya, Hapus'
                }).then((result) => {
                    if (result.isConfirmed) e.target.submit();
                });
            }
        });
    </script>
@endsection