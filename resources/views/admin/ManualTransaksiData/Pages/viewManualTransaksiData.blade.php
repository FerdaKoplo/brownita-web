@extends('layout.admin.layout')
@section('title', 'Manual Transaksi')

@section('content')
    <div class="bg-gray-50 min-h-screen p-4" x-data="manualTransaksiForm()">
        <div class="flex flex-col gap-4">

            {{-- Header --}}
            <div class="flex flex-wrap justify-between items-center gap-y-3">
                <h1 class="text-2xl sm:text-4xl font-bold text-gray-800">Daftar Manual Transaksi</h1>
                <button @click="toggleForm()"
                    class="bg-amber-700 hover:bg-orange-700 transition text-white px-3 py-2 sm:px-4 sm:py-2 rounded-lg font-medium text-sm sm:text-base">
                    <span x-text="formVisible ? 'Tutup Form' : '+ Buat Transaksi'"></span>
                </button>
            </div>

            {{-- Form --}}
            <div x-show="formVisible" x-transition:enter="transform transition ease-out duration-300"
                x-transition:enter-start="-translate-y-10 opacity-0" x-transition:enter-end="translate-y-0 opacity-100"
                x-transition:leave="transform transition ease-in duration-200"
                x-transition:leave-start="translate-y-0 opacity-100" x-transition:leave-end="-translate-y-12 opacity-0"
                class="bg-white p-4 rounded-lg shadow-md">
                <form @submit.prevent="submitForm">
                    {{-- Customer Info --}}
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mb-4">
                        <input type="text" placeholder="Nama Customer" x-model="form.customer_name"
                            class="border rounded px-2 py-1 w-full">
                        <input type="text" placeholder="No. HP" x-model="form.customer_phone"
                            class="border rounded px-2 py-1 w-full">
                        <textarea placeholder="Alamat" x-model="form.alamat"
                            class="border rounded px-2 py-1 w-full sm:col-span-2"></textarea>
                    </div>

                    {{-- Pre-order --}}
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mb-4">
                        <select x-model="form.tipe_pemesanan" class="border rounded px-2 py-1 w-full">
                            <option value="">Pilih Tipe Pemesanan</option>
                            <option value="pre-order">Pre-Order</option>
                            <option value="order-via-whatsapp">Order via WhatsApp</option>
                        </select>

                        <template x-if="form.tipe_pemesanan === 'pre-order'">
                            <div class="flex gap-2">
                                <input type="date" x-model="form.preorder_start" class="border rounded px-2 py-1 w-full">
                                <input type="date" x-model="form.preorder_deadline" class="border rounded px-2 py-1 w-full">
                            </div>
                        </template>
                    </div>

                    {{-- Tanggal Transaksi --}}
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mb-4">
                        <input type="date" x-model="form.tanggal_transaksi" class="border rounded px-2 py-1 w-full">
                    </div>

                    {{-- Produk --}}
                    <div class="mb-4">
                        <h2 class="font-semibold mb-2">Produk</h2>
                        <template x-for="(item, index) in form.details" :key="index">
                            <div class="flex gap-2 mb-2">
                                <input type="text" placeholder="Nama Produk" x-model="item.nama_produk"
                                    class="border rounded px-2 py-1 flex-1">
                                <input type="number" placeholder="Qty" x-model="item.quantity"
                                    class="border rounded px-2 py-1 w-20">
                                <input type="number" placeholder="Harga Satuan" x-model="item.harga_satuan"
                                    class="border rounded px-2 py-1 w-32">
                                <button type="button" @click="removeDetail(index)" class="text-red-500 px-2 py-1">X</button>
                            </div>
                        </template>
                        <button type="button" @click="addDetail()" class="bg-gray-200 hover:bg-gray-300 px-3 py-1 rounded">+
                            Tambah Produk</button>
                    </div>

                    {{-- Submit --}}
                    <div>
                        <button type="submit" class="bg-amber-700 hover:bg-orange-700 text-white px-4 py-2 rounded">
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
                            <th class="border-b-2 px-4 py-3">Tipe Pemesanan</th>
                            <th class="border-b-2 px-4 py-3">Tanggal Transaksi</th>
                            <th class="border-b-2 px-4 py-3">Pre-Order Start</th>
                            <th class="border-b-2 px-4 py-3">Produk</th>
                            <th class="border-b-2 px-4 py-3">Dibuat Oleh</th>
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
                                <td class="px-4 py-3">{{ ucfirst(str_replace('-', ' ', $transaction->tipe_pemesanan)) }}</td>
                                <td class="px-4 py-3">{{ optional($transaction->tanggal_transaksi)->format('d-m-Y') }}</td>
                                <td class="px-4 py-3">{{ optional($transaction->preorder_start)->format('d-m-Y') ?? '-' }}</td>
                                <td class="px-4 py-3">
                                    <ul class="list-disc ml-5">
                                        @foreach($transaction->details as $item)
                                            <li>{{ $item->nama_produk }} ({{ $item->quantity }} x
                                                {{ number_format($item->harga_satuan, 0, ',', '.') }})
                                            </li>
                                        @endforeach
                                    </ul>
                                </td>
                                <td class="px-4 py-3">{{ $transaction->creator->name ?? '-' }}</td>
                                <td class="px-4 py-3 space-x-2">
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

            {{-- Pagination --}}
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
                        preorder_start: transaction.preorder_start,
                        preorder_deadline: transaction.preorder_deadline,
                        details: transaction.details.map(d => ({
                            nama_produk: d.nama_produk,
                            quantity: d.quantity,
                            harga_satuan: d.harga_satuan
                        }))
                    };
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