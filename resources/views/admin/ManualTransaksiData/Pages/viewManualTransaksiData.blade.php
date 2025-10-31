@extends('layout.admin.layout')
@section('title', 'Manual Transaksi')

@section('content')
    <div class="bg-gray-50 min-h-screen p-4 sm:p-6" x-data="manualTransaksiForm()">
        <div class="flex flex-col gap-4">

            {{-- Header --}}
            <div class="flex flex-wrap justify-between items-center gap-y-3">
                <h1 class="text-2xl sm:text-4xl font-bold text-gray-800">Daftar Manual Transaksi</h1>
                <button @click="toggleForm()"
                    class="bg-amber-700 hover:bg-orange-700 transition text-white px-3 py-2 sm:px-4 sm:py-2 rounded-lg font-medium text-sm sm:text-base">
                    <span x-text="formVisible ? 'Tutup Form' : '+ Buat Transaksi'"></span>
                </button>
            </div>

            <form action="{{ route('dashboard.admin.manual-transaksi.index') }}" method="GET"
                class="w-full sm:max-w-5xl flex flex-col md:flex-row flex-wrap gap-4 md:gap-6 bg-white p-4 rounded-lg shadow-md">

                {{-- Search --}}
                <div
                    class="flex items-center gap-2 shadow-sm hover:shadow-md duration-300 rounded-lg bg-white p-3 flex-1 min-w-full sm:min-w-[250px]">
                    <i class="fa-solid fa-magnifying-glass text-gray-500"></i>
                    <input type="text" name="search" value="{{ request('search') }}"
                        class="w-full bg-transparent outline-none text-gray-700 placeholder-gray-400 text-sm sm:text-base"
                        placeholder="Cari Nama Customer, No HP, atau Alamat...">
                </div>

                {{-- Tipe Pemesanan --}}
                <div class="flex flex-col w-full sm:w-auto gap-1">
                    <span class="text-xs text-gray-400">Tipe Pemesanan</span>
                    <select name="tipe_pemesanan" class="rounded px-2 py-1 border text-sm sm:text-base w-full">
                        <option value="">Semua Tipe</option>
                        <option value="pre-order" {{ request('tipe_pemesanan') == 'pre-order' ? 'selected' : '' }}>Pre-Order
                        </option>
                        <option value="order-via-whatsapp" {{ request('tipe_pemesanan') == 'order-via-whatsapp' ? 'selected' : '' }}>Order via WhatsApp
                        </option>
                    </select>
                </div>

                {{-- Status --}}
                <div class="flex flex-col w-full sm:w-auto gap-1">
                    <span class="text-xs text-gray-400">Status Transaksi</span>
                    <select name="status" class="rounded px-2 py-1 border text-sm sm:text-base w-full">
                        <option value="">Semua Status</option>
                        <option value="draft" {{ request('status') == 'draft' ? 'selected' : '' }}>Draft</option>
                        <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                        <option value="dibayar" {{ request('status') == 'dibayar' ? 'selected' : '' }}>Dibayar</option>
                        <option value="dibatalkan" {{ request('status') == 'dibatalkan' ? 'selected' : '' }}>Dibatalkan
                        </option>
                        <option value="selesai" {{ request('status') == 'selesai' ? 'selected' : '' }}>Selesai</option>
                    </select>
                </div>

                {{-- Date Filters --}}
                <div class="grid grid-cols-2 sm:grid-cols-4 gap-2 w-full">
                    <div class="flex flex-col gap-1">
                        <span class="text-xs text-gray-400">Tanggal Mulai</span>
                        <input type="date" name="from_date" value="{{ request('from_date') }}"
                            class="border rounded px-2 py-1 text-sm w-full">
                    </div>
                    <div class="flex flex-col gap-1">
                        <span class="text-xs text-gray-400">Tanggal Selesai</span>
                        <input type="date" name="to_date" value="{{ request('to_date') }}"
                            class="border rounded px-2 py-1 text-sm w-full">
                    </div>
                    <div class="flex flex-col gap-1">
                        <span class="text-xs text-gray-400">Preorder Start</span>
                        <input type="date" name="preorder_start" value="{{ request('preorder_start') }}"
                            class="border rounded px-2 py-1 text-sm w-full">
                    </div>
                    <div class="flex flex-col gap-1">
                        <span class="text-xs text-gray-400">Preorder End</span>
                        <input type="date" name="preorder_deadline" value="{{ request('preorder_deadline') }}"
                            class="border rounded px-2 py-1 text-sm w-full">
                    </div>
                </div>

                {{-- Submit & Reset --}}
                <div class="flex flex-wrap gap-3 items-center justify-end mt-2 w-full">
                    <button type="submit"
                        class="bg-amber-600 text-white px-4 py-2 rounded text-sm sm:text-base w-full sm:w-auto hover:bg-black transition">Filter</button>
                    <a href="{{ route('dashboard.admin.manual-transaksi.index') }}"
                        class="text-red-500 font-semibold text-sm sm:text-base hover:underline text-center w-full sm:w-auto">Reset</a>
                </div>
            </form>

            {{-- Form --}}
            <div x-show="formVisible" x-transition:enter="transform transition ease-out duration-300"
                x-transition:enter-start="-translate-y-10 opacity-0" x-transition:enter-end="translate-y-0 opacity-100"
                x-transition:leave="transform transition ease-in duration-200"
                x-transition:leave-start="translate-y-0 opacity-100" x-transition:leave-end="-translate-y-12 opacity-0"
                class="bg-white p-4 sm:p-6 rounded-lg shadow-md">

                <form @submit.prevent="submitForm" class="space-y-10">
                    {{-- Customer Info --}}
                    <h2 class="font-semibold mb-2 text-lg sm:text-xl">Customer Info</h2>
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 sm:gap-6 mb-4">
                        <div class="flex flex-col gap-2">
                            <label class="block text-sm font-medium text-gray-700">Nama Customer</label>
                            <input type="text" placeholder="Nama Customer" x-model="form.customer_name"
                                class="border rounded px-2 py-1 w-full">
                        </div>
                        <div class="flex flex-col gap-2">
                            <label class="block text-sm font-medium text-gray-700">No Hp Customer</label>
                            <input type="text" placeholder="No. HP" x-model="form.customer_phone"
                                class="border rounded px-2 py-1 w-full">
                        </div>
                        <div class="flex flex-col gap-2 sm:col-span-2">
                            <label class="block text-sm font-medium text-gray-700">Alamat Customer</label>
                            <textarea placeholder="Alamat" x-model="form.alamat" rows="4"
                                class="border rounded px-2 py-1 w-full"></textarea>
                        </div>
                    </div>

                    {{-- Pre-order --}}
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mb-4">
                        <div class="flex flex-col gap-2">
                            <label class="block text-sm font-medium text-gray-700">Tipe Pemesanan</label>
                            <select x-model="form.tipe_pemesanan" class="border rounded px-2 py-1 w-full">
                                <option value="">Pilih Tipe Pemesanan</option>
                                <option value="pre-order">Pre-Order</option>
                                <option value="order-via-whatsapp">Order via WhatsApp</option>
                            </select>
                        </div>

                        <template x-if="form.tipe_pemesanan === 'pre-order'">
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 w-full">
                                <div class="flex flex-col gap-2">
                                    <label class="block text-sm font-medium text-gray-700">Mulai Pre-Order</label>
                                    <input type="date" x-model="form.preorder_start"
                                        class="border rounded px-2 py-1 w-full">
                                </div>
                                <div class="flex flex-col gap-2">
                                    <label class="block text-sm font-medium text-gray-700">Akhir Pre-Order</label>
                                    <input type="date" x-model="form.preorder_deadline"
                                        class="border rounded px-2 py-1 w-full">
                                </div>
                            </div>
                        </template>
                    </div>

                    {{-- Status --}}
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mb-4">
                        <div class="flex flex-col gap-2">
                            <label class="block text-sm font-medium text-gray-700">Status</label>
                            <select x-model="form.status" class="border rounded px-2 py-1 w-full">
                                <option value="draft">Draft</option>
                                <option value="pending">Pending</option>
                                <option value="dibayar">Dibayar</option>
                                <option value="dibatalkan">Dibatalkan</option>
                                <option value="selesai">Selesai</option>
                            </select>
                        </div>
                    </div>

                    {{-- Tanggal Transaksi --}}
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mb-4">
                        <div class="flex flex-col gap-2">
                            <label class="block text-sm font-medium text-gray-700">Tanggal Transaksi</label>
                            <input type="date" x-model="form.tanggal_transaksi" class="border rounded px-2 py-1 w-full">
                        </div>
                    </div>

                    {{-- Produk --}}
                    <div class="space-y-10">
                        <h2 class="font-semibold mb-2 text-lg sm:text-xl">Produk</h2>

                        <div class="overflow-x-auto">
                            <div class="min-w-[800px] space-y-4">
                                <template x-for="(item, index) in form.details" :key="index">
                                    <div class="flex flex-col sm:flex-row gap-3 sm:gap-4 mb-2 w-full">
                                        <div class="flex flex-col gap-2 w-full sm:w-1/3">
                                            <label class="block text-sm font-medium text-gray-700">Nama Produk</label>
                                            <input type="text" placeholder="Nama Produk" x-model="item.nama_produk"
                                                class="border rounded px-2 py-1 w-full">
                                        </div>

                                        <div class="flex flex-col gap-2 w-full sm:w-1/4">
                                            <label class="block text-sm font-medium text-gray-700">Jumlah Barang</label>
                                            <input type="number" placeholder="Qty" x-model="item.quantity"
                                                class="border rounded px-2 py-1 w-full">
                                        </div>

                                        <div x-data="rupiahFormatter(item)" class="flex flex-col gap-2 w-full sm:w-1/3">
                                            <label class="block text-sm font-medium text-gray-700">Harga Barang</label>
                                            <input type="text" x-model="harga_tampil" x-on:input="formatInput"
                                                placeholder="Rp 100.000"
                                                class=" block w-full bg-white border  border-gray-300 rounded px-2 py-1 text-gray-800">
                                        </div>

                                        <div class="flex items-center sm:items-end">
                                            <button type="button" @click="removeDetail(index)"
                                                class="text-red-500 px-2  py-1">
                                                <i class="fa-solid fa-xmark fa-bold text-lg"></i>
                                            </button>
                                        </div>
                                    </div>
                                </template>
                            </div>
                        </div>

                        <button type="button" @click="addDetail()"
                            class="bg-gray-200 hover:bg-gray-300 px-3 py-2 rounded text-sm sm:text-base w-full sm:w-auto">
                            + Tambah Produk
                        </button>
                    </div>

                    {{-- Submit --}}
                    <div class="mt-4 flex flex-col sm:flex-row justify-end gap-3">
                        <button type="submit"
                            class="bg-amber-700 hover:bg-orange-700 text-white px-4 py-2 rounded w-full sm:w-auto">
                            <span x-text="mode === 'create' ? 'Simpan Transaksi' : 'Update Transaksi'"></span>
                        </button>
                    </div>
                </form>
            </div>


            {{-- Table --}}
            <div class="overflow-x-auto rounded-lg shadow-md border overflow-hidden mt-4">
                <table class="w-full text-left min-w-[1200px] border-separate border-spacing-0">
                    <thead class="bg-white border-b border-gray-300 text-sm sm:text-base">
                        <tr>
                            <th class="border-b-2 px-4 py-3">#</th>
                            <th class="border-b-2 px-4 py-3">Customer</th>
                            <th class="border-b-2 px-4 py-3">No. HP</th>
                            <th class="border-b-2 px-4 py-3">Alamat</th>
                            {{-- <th class="border-b-2 px-4 py-3">Tipe Pemesanan</th> --}}
                            <th class="border-b-2 px-4 py-3">Status</th>
                            <th class="border-b-2 px-4 py-3">Tanggal Transaksi</th>
                            <th class="border-b-2 px-4 py-3">Pre-Order Start</th>
                            <th class="border-b-2 px-4 py-3">Pre-Order End</th>
                            <th class="border-b-2 px-4 py-3">Produk</th>
                            {{-- <th class="border-b-2 px-4 py-3">Dibuat Oleh</th> --}}
                            <th class="border-b-2 px-4 py-3">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200 text-sm sm:text-base">
                        @forelse ($manualTransaksiData as $index => $transaction)
                            <tr class="hover:bg-gray-50 transition">
                                <td class="px-4 py-3">{{ $manualTransaksiData->firstItem() + $index }}</td>
                                <td class="px-4 py-3 font-medium text-gray-900">{{ $transaction->customer_name }}</td>
                                <td class="px-4 py-3">{{ $transaction->customer_phone }}</td>
                                <td class="px-4 py-3 max-w-xs truncate" title="{{ $transaction->alamat }}">
                                    {{ $transaction->alamat }}
                                </td>
                                {{-- <td class="px-4 py-3">
                                    @php
                                    $type = $transaction->tipe_pemesanan;
                                    $chipStyles = [
                                    'pre-order' => 'bg-blue-100 text-blue-700 ',
                                    'order-via-whatsapp' => 'bg-green-100 text-green-800 ',
                                    ];
                                    $style = $chipStyles[$type] ?? 'bg-gray-100 text-gray-700 border border-gray-300';
                                    @endphp

                                    <span class="px-1 py-1 text-xs sm:text-sm font-medium rounded {{ $style }}">
                                        {{ ucfirst(str_replace('-', ' ', $type ?? '-')) }}
                                    </span>
                                </td> --}}
                                <td class="px-4 py-3 capitalize">
                                    <span class="px-2 py-1 rounded text-white" :class="{
                                                                                                'bg-gray-400': '{{ $transaction->status }}' === 'draft',
                                                                                                'bg-yellow-400': '{{ $transaction->status }}' === 'pending',
                                                                                                'bg-green-400': '{{ $transaction->status }}' === 'dibayar',
                                                                                                'bg-red-400': '{{ $transaction->status }}' === 'dibatalkan',
                                                                                                'bg-blue-400': '{{ $transaction->status }}' === 'selesai',
                                                                                            }">
                                        {{ $transaction->status }}
                                    </span>
                                </td>
                                <td class="px-4 py-3">{{ optional($transaction->tanggal_transaksi)->format('d-m-Y') }}</td>
                                <td class="px-4 py-3">{{ optional($transaction->preorder_start)->format('d-m-Y') ?? '-' }}</td>
                                <td class="px-4 py-3">{{ optional($transaction->preorder_deadline)->format('d-m-Y') ?? '-' }}
                                </td>
                                <td class="px-4 py-3 text-right">
                                    <div class="flex flex-col gap-2 items-start">
                                        Rp
                                        {{ number_format($transaction->details->sum(fn($item) => $item->quantity * $item->harga_satuan), 0, ',', '.') }}

                                        <!-- View Details button -->
                                        <button type="button" @click="openDetailModal(@js($transaction))"
                                            class="text-amber-700 hover:text-orange-800 text-sm ml-2 font-semibold">
                                            Lihat Detail
                                        </button>
                                    </div>
                                </td>

                                {{-- <td class="px-4 py-3">{{ $transaction->creator->name ?? '-' }}</td> --}}
                                <td class="px-4 py-3 space-x-2 flex items-center">
                                    <button type="button" x-data="{ transaction: @js($transaction) }"
                                        @click="editTransaction(transaction)"
                                        class="text-blue-600 hover:text-blue-800 transition">
                                        <i class="fa-solid fa-pen-to-square"></i>
                                    </button>
                                    <form class="inline deleteForm"
                                        action="{{ route('dashboard.admin.manual-transaksi.destroy', $transaction->id) }}"
                                        method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-400 hover:text-red-800 transition">
                                            <i class="fa-solid fa-trash"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="10" class="text-center py-5 text-gray-500">Tidak ada data transaksi.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Detail Modal -->
            <div x-show="detailModalVisible" x-transition.opacity.duration.200ms @click.away="detailModalVisible = false"
                class="fixed inset-0 bg-black/40 flex items-center justify-center z-50 p-2 sm:p-4">

                <div x-transition.opacity.duration.300ms
                    class="bg-white rounded-xl shadow-lg w-full max-w-3xl p-4 sm:p-6 relative overflow-y-auto max-h-[90vh]">

                    <!-- Close button -->
                    <button @click="detailModalVisible = false"
                        class="absolute top-3 right-3 text-gray-400 hover:text-gray-700 text-lg sm:text-xl">
                        ✕
                    </button>

                    <!-- Header -->
                    <div class="flex flex-col gap-1 sm:gap-3 mb-6 sm:mb-8 text-center sm:text-left">
                        <h2 class="text-2xl sm:text-3xl font-bold text-gray-800">Detail Produk</h2>
                        <span class="text-gray-400 text-sm sm:text-base">Detail dari produk yang dibeli customer</span>
                    </div>

                    <!-- Transaction Detail -->
                    <template x-if="selectedTransaction">
                        <div class="flex flex-col gap-3 text-sm sm:text-base">
                            <p class="text-gray-600">
                                <strong class="mr-2">Customer:</strong>
                                <span x-text="selectedTransaction.customer_name"></span>
                            </p>

                            <div>
                                <strong class="text-gray-700 mr-2">Tipe Pemesanan:</strong>
                                <span x-text="selectedTransaction.tipe_pemesanan" :class="{
                                'bg-green-100 text-green-600': selectedTransaction.tipe_pemesanan === 'order-via-whatsapp',
                                ' bg-blue-100 text-blue-600': selectedTransaction.tipe_pemesanan === 'pre-order',
                                'bg-yellow-100 text-yellow-600': !['order-via-whatsapp', 'pre-order'].includes(selectedTransaction.tipe_pemesanan)
                            }" class="inline-block px-3 py-1 text-xs sm:text-sm font-medium rounded-full">
                                </span>
                            </div>

                            <!-- Table -->
                            <div class="overflow-x-auto mt-3">
                                <table class="w-full text-xs sm:text-sm">
                                    <thead class="bg-gray-100">
                                        <tr>
                                            <th class="px-3 py-2 text-left">Nama Produk</th>
                                            <th class="px-3 py-2 text-right">Jumlah</th>
                                            <th class="px-3 py-2 text-right">Harga Satuan</th>
                                            <th class="px-3 py-2 text-right">Subtotal</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <template x-for="detail in selectedTransaction.details" :key="detail.id">
                                            <tr class="">
                                                <td class="px-3 py-2" x-text="detail.nama_produk"></td>
                                                <td class="px-3 py-2 text-right" x-text="detail.quantity"></td>
                                                <td class="px-3 py-2 text-right"
                                                    x-text="`Rp ${Number(detail.harga_satuan).toLocaleString('id-ID')}`">
                                                </td>
                                                <td class="px-3 py-2 text-right"
                                                    x-text="`Rp ${(detail.quantity * detail.harga_satuan).toLocaleString('id-ID')}`">
                                                </td>
                                            </tr>
                                        </template>
                                    </tbody>
                                </table>
                            </div>

                            <!-- Total -->
                            <div class="text-right text-lg sm:text-xl font-semibold mt-4 border-t border-black pt-3">
                                Total:
                                <span
                                    x-text="`Rp ${selectedTransaction.details.reduce((sum, d) => sum + (d.quantity * d.harga_satuan), 0).toLocaleString('id-ID')}`"></span>
                            </div>
                        </div>
                    </template>
                </div>
            </div>


            @if($manualTransaksiData->hasPages())
                <div class="flex justify-center gap-10 items-center mt-6">
                    @if($manualTransaksiData->onFirstPage())
                        <span class="text-gray-400 flex justify-center items-center gap-2">
                            <i class="fa-solid fa-angle-left"></i> Prev
                        </span>
                    @else
                        <a href="{{ $manualTransaksiData->appends(request()->query())->previousPageUrl() }}"
                            class="text-amber-700 justify-center font-semibold flex items-center gap-2">
                            <i class="fa-solid fa-angle-left"></i> Prev
                        </a>
                    @endif

                    @foreach ($manualTransaksiData->getUrlRange(1, $manualTransaksiData->lastPage()) as $page => $url)
                        <a href="{{ $url }}"
                            class="{{ $page == $manualTransaksiData->currentPage() ? 'bg-black text-white' : 'text-amber-700' }} px-2 py-1 rounded">
                            {{ $page }}
                        </a>
                    @endforeach

                    @if($manualTransaksiData->hasMorePages())
                        <a href="{{ $manualTransaksiData->appends(request()->query())->nextPageUrl() }}"
                            class="text-amber-700 font-semibold justify-center flex items-center gap-2">
                            Next <i class="fa-solid fa-angle-right"></i>
                        </a>
                    @else
                        <span class="text-gray-400 flex items-center gap-2">
                            Next <i class="fa-solid fa-angle-right"></i>
                        </span>
                    @endif
                </div>
            @endif

        </div>
    </div>

    <script>
        function rupiahFormatter(item) {
            return {
                harga_tampil: item.harga_satuan
                    ? 'Rp ' + new Intl.NumberFormat('id-ID').format(item.harga_satuan)
                    : '',

                formatInput(e) {
                    const angka = e.target.value.replace(/[^,\d]/g, '');
                    this.harga_tampil = angka ? 'Rp ' + this.formatRupiah(angka) : '';
                    item.harga_satuan = parseInt(angka.replace(/\./g, '')) || 0;
                },

                formatRupiah(angka) {
                    if (!angka) return '';
                    let number_string = angka.replace(/[^,\d]/g, ''),
                        split = number_string.split(','),
                        sisa = split[0].length % 3,
                        rupiah = split[0].substr(0, sisa),
                        ribuan = split[0].substr(sisa).match(/\d{3}/gi);

                    if (ribuan) {
                        const separator = sisa ? '.' : '';
                        rupiah += separator + ribuan.join('.');
                    }
                    return split[1] !== undefined ? rupiah + ',' + split[1] : rupiah;
                }
            };
        }
    </script>

    <script>
        function manualTransaksiForm() {
            return {
                formVisible: false,
                mode: 'create',
                editingId: null,
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
                        tanggal_transaksi: '',
                        status: '',
                        tipe_pemesanan: '',
                        preorder_start: '',
                        preorder_deadline: '',
                        details: [],
                    };
                },

                editTransaction(transaction) {
                    this.formVisible = true;
                    this.mode = 'edit';
                    this.editingId = transaction.id;
                    this.form = {
                        customer_name: transaction.customer_name,
                        customer_phone: transaction.customer_phone,
                        alamat: transaction.alamat,
                        tanggal_transaksi: transaction.tanggal_transaksi,
                        tipe_pemesanan: transaction.tipe_pemesanan,
                        status: transaction.status,
                        preorder_start: transaction.preorder_start,
                        preorder_deadline: transaction.preorder_deadline,
                        details: transaction.details.map(d => ({
                            nama_produk: d.nama_produk,
                            quantity: d.quantity,
                            harga_satuan: d.harga_satuan
                        }))
                    };
                },

                detailModalVisible: false,
                selectedTransaction: null,

                openDetailModal(transaction) {
                    this.selectedTransaction = transaction
                    this.detailModalVisible = true
                },


                addDetail() {
                    this.form.details.push({ nama_produk: '', quantity: 1, harga_satuan: 0 });
                },

                removeDetail(index) {
                    this.form.details.splice(index, 1);
                },

                async submitForm() {
                    try {
                        if (!this.form.tanggal_transaksi) {
                            this.form.tanggal_transaksi = new Date().toISOString().split('T')[0];
                        }

                        const url = this.mode === 'create'
                            ? "{{ route('dashboard.admin.manual-transaksi.store') }}"
                            : "{{ route('dashboard.admin.manual-transaksi.update', ':id') }}".replace(':id', this.editingId)

                        const method = this.mode === 'create' ? 'POST' : 'PUT';

                        const res = await fetch(url, {
                            method,
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                                'Accept': 'application/json'
                            },
                            body: JSON.stringify(this.form)
                        });

                        const data = await res.json();

                        if (!res.ok) {
                            let errorMsg = '';
                            if (data.errors) {
                                for (let key in data.errors) {
                                    errorMsg += data.errors[key].join('\n') + '\n';
                                }
                            } else if (data.message) {
                                errorMsg = data.message;
                            } else {
                                errorMsg = 'Terjadi kesalahan saat menyimpan data.';
                            }

                            Swal.fire({ icon: 'error', title: 'Gagal!', text: errorMsg });
                            return;
                        }

                        Swal.fire({ icon: 'success', title: 'Berhasil!', text: 'Transaksi berhasil disimpan!' })
                            .then(() => location.reload());

                    } catch (err) {
                        console.error(err);
                        Swal.fire({ icon: 'error', title: 'Error!', text: 'Terjadi kesalahan pada koneksi atau server.' });
                    }
                }
            }
        }
    </script>
@endsection