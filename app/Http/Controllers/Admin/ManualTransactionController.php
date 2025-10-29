<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ManualTransaksiData;
use App\Models\ManualTransaksiDetailData;
use App\Models\User;
use DB;
use Illuminate\Http\Request;

class ManualTransactionController extends Controller
{
    public function manualTransaksiIndex(Request $request)
    {
        $search = $request->input('search');
        $status = $request->input('status');
        $tipe = $request->input('tipe_pemesanan');
        $fromDate = $request->input('from_date');
        $toDate = $request->input('to_date');
        $creator = $request->input('created_by');
        $preorderStart = $request->input('preorder_start');
        $preorderEnd = $request->input('preorder_end');

        $manualTransaksiData = ManualTransaksiData::with('creator')
            ->when(
                $search,
                fn($q) =>
                $q->where(function ($query) use ($search) {
                    $query->where('customer_name', 'like', "%$search%")
                        ->orWhere('customer_phone', 'like', "%$search%")
                        ->orWhere('alamat', 'like', "%$search%");
                })
            )
            ->when($status, fn($q) => $q->where('status', $status))
            ->when($tipe, fn($q) => $q->where('tipe_pemesanan', $tipe))
            ->when($creator, fn($q) => $q->where('created_by', $creator))
            ->when(
                $fromDate && $toDate,
                fn($q) =>
                $q->whereBetween('tanggal_transaksi', [$fromDate, $toDate])
            )
            ->when($preorderStart && $preorderEnd, function ($q) use ($preorderStart, $preorderEnd) {
                $q->whereBetween('preorder_start', [$preorderStart, $preorderEnd]);
            })
            ->when($preorderStart && !$preorderEnd, fn($q) => $q->whereDate('preorder_start', '>=', $preorderStart))
            ->when(!$preorderStart && $preorderEnd, fn($q) => $q->whereDate('preorder_end', '<=', $preorderEnd))
            ->latest()
            ->paginate(10);

        $adminUsers = User::where('role', 'admin')->pluck('name', 'id');

        return view('admin.ManualTransaksiData.Pages.viewManualTransaksiData', compact(
            'manualTransaksiData',
            'adminUsers'
        ));
    }

    public function createManualTransaksi()
    {
        return view('admin.ManualTransaksiData.Pages.createTransaksiData');
    }

    public function storeManualTransaksi(Request $request)
    {
        $validated = $request->validate([
            'customer_name' => 'nullable|string|max:255',
            'customer_phone' => 'nullable|string|max:20',
            'alamat' => 'nullable|string',
            'tanggal_transaksi' => 'required|date',
            'tipe_pemesanan' => 'required|in:pre-order,order-via-whatsapp',
            'preorder_start' => 'nullable|required_if:tipe_pemesanan,pre-order|date',
            'preorder_end' => 'nullable|required_if:tipe_pemesanan,pre-order|date|after_or_equal:preorder_start',
            'total_harga' => 'nullable|numeric|min:0',
            'notes' => 'nullable|string',

            'details' => 'required|array|min:1',
            'details.*.nama_produk' => 'required|string|max:255',
            'details.*.quantity' => 'required|integer|min:1',
            'details.*.harga_satuan' => 'required|numeric|min:0',
        ]);


        DB::transaction(function () use ($validated) {
            $validated['created_by'] = auth()->id();

            $manualTransaksi = ManualTransaksiData::create($validated);

            $total = 0;
            foreach ($validated['details'] as $detail) {
                $manualTransaksi->manualTransaksiDetailDatas()->create($detail);
                $total += $detail['quantity'] * $detail['harga_satuan'];
            }

            $manualTransaksi->update(['total_harga' => $total]);
        });


        return redirect()
            ->route('dashboard.admin.manual-transaksi.create')
            ->with('success', 'Data transaksi berhasil dibuat. Silakan tambahkan produk.');
    }

    public function editManualTransaksi($id)
    {
        $manualTransaksi = ManualTransaksiData::with('manualTransaksiDetailDatas')->findOrFail($id);

        return view('admin.ManualTransaksiData.Pages.editTransaksiData', compact('manualTransaksi'));
    }

    public function updateManualTransaksi(Request $request, $id)
    {
        $manualTransaksi = ManualTransaksiData::findOrFail($id);

        $validated = $request->validate([
            'customer_name' => 'nullable|string|max:255',
            'customer_phone' => 'nullable|string|max:20',
            'alamat' => 'nullable|string',
            'tanggal_transaksi' => 'required|date',
            'tipe_pemesanan' => 'required|in:pre-order,order-via-whatsapp',
            'preorder_start' => 'nullable|required_if:tipe_pemesanan,pre-order|date',
            'preorder_end' => 'nullable|required_if:tipe_pemesanan,pre-order|date|after_or_equal:preorder_start',
            'total_harga' => 'nullable|numeric|min:0',
            'status' => 'nullable|string|max:50',
            'notes' => 'nullable|string',

            'details' => 'required|array|min:1',
            'details.*.id' => 'nullable|exists:manual_transaksi_detail_data,id',
            'details.*.nama_produk' => 'required|string|max:255',
            'details.*.quantity' => 'required|integer|min:1',
            'details.*.harga_satuan' => 'required|numeric|min:0',
        ]);


        DB::transaction(function () use ($manualTransaksi, $validated) {
            $validated['updated_by'] = auth()->id();

            $manualTransaksi->update($validated);

            $existingDetailIds = $manualTransaksi->manualTransaksiDetailDatas->pluck('id')->toArray();
            $submittedIds = collect($validated['details'])->pluck('id')->filter()->toArray();

            $toDelete = array_diff($existingDetailIds, $submittedIds);
            ManualTransaksiDetailData::whereIn('id', $toDelete)->delete();

            $total = 0;
            foreach ($validated['details'] as $detail) {
                $total += $detail['quantity'] * $detail['harga_satuan'];
                if (isset($detail['id'])) {
                    ManualTransaksiDetailData::find($detail['id'])->update($detail);
                } else {
                    $manualTransaksi->manualTransaksiDetailDatas()->create($detail);
                }
            }

            $manualTransaksi->update(['total_harga' => $total]);
        });
        return redirect()
            ->route('dashboard.admin.manual-transaksi.index')
            ->with('success', 'Data transaksi berhasil diperbarui.');
    }

    public function destroyManualTransaksi($id)
    {
        $manualTransaksi = ManualTransaksiData::findOrFail($id);
        $manualTransaksi->delete();

        return redirect()
            ->route('dashboard.admin.manual-transaksi.index')
            ->with('success', 'Data transaksi berhasil dihapus.');
    }
}
