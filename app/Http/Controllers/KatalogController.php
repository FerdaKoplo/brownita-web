<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Katalog;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class KatalogController extends Controller
{
    public function katalogIndex()
    {
        $catalogues = Katalog::with('category')->get();
        return view('admin.KatalogResource.Pages.viewKatalog', compact('catalogues'));
    }

    public function katalogCreate()
    {
        $categories = Category::all();
        return view('admin.KatalogResource.Pages.createKatalog', compact('categories'));
    }

    public function katalogStore(Request $request)
    {

        $validate = $request->validate([
            'category_id' => 'required|exists:categories,id',
            'nama_produk' => 'required|string|max:255',
            'gambar_produk' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'deskripsi' => 'nullable|string|max:1000',
            'harga' => 'required|numeric|min:0',
        ]);


        if ($request->hasFile('gambar_produk')) {
            $file = $request->file('gambar_produk');
            $filename = Str::slug($request->nama_produk) . '.' . $file->getClientOriginalExtension();
            $filePath = $file->storeAs('cover', $filename, 'public');
            $validate['gambar_produk'] = $filePath;
        } else {
            $isnull = 'null';
            $validate['gambar_produk'] = $isnull;
        }

        Katalog::create($validate);
        return redirect('/dashboard/admin/katalog')->with('success', 'Katalog berhasil ditambahkan!');
    }

    public function katalogEdit()
    {

    }

    // Customer katalog function
    public function showKatalog(Request $request)
    {
        try {
            $categories = Category::all();
            $selectedCategoryId = $request->get('category_id');

            // Debug: cek apakah data kategori ada
            \Log::info('Categories count: ' . $categories->count());
            \Log::info('Selected category ID: ' . $selectedCategoryId);

            // Query dasar
            $query = Katalog::query();

            // Filter berdasarkan kategori jika ada
            if ($selectedCategoryId) {
                $query->where('category_id', $selectedCategoryId);
            }

            // Pagination
            $catalogues = $query->paginate(9);

            // Debug: cek apakah data katalog ada
            \Log::info('Catalogues count: ' . $catalogues->count());

            // Pastikan semua variabel ada sebelum dikirim ke view
            $data = [
                'categories' => $categories,
                'catalogues' => $catalogues,
                'selectedCategoryId' => $selectedCategoryId
            ];

            return view('customer.katalog', $data); // Ubah path view ke customer.katalog

        } catch (\Exception $e) {
            \Log::error('Error in showKatalog: ' . $e->getMessage());

            // Jika error, kirim data kosong
            return view('customer.katalog', [
                'categories' => collect([]),
                'catalogues' => new \Illuminate\Pagination\LengthAwarePaginator([], 0, 9),
                'selectedCategoryId' => null
            ]);
        }
    }

    // Method untuk API atau AJAX request
    public function getKatalogData(Request $request)
    {
        try {
            $query = Katalog::with('category');

            // Filter berdasarkan kategori
            if ($request->has('category_id') && $request->category_id) {
                $query->where('category_id', $request->category_id);
            }

            // Filter berdasarkan status (array checkbox)
            if ($request->has('status') && is_array($request->status) && count($request->status) > 0) {
                $query->whereIn('status', $request->status);
            }

            // Filter pencarian
            if ($request->has('search') && $request->search) {
                $query->where(function ($q) use ($request) {
                    $q->where('nama_produk', 'LIKE', '%' . $request->search . '%')
                        ->orWhere('deskripsi', 'LIKE', '%' . $request->search . '%');
                });
            }

            $catalogues = $query->orderBy('created_at', 'desc')->paginate(9);

            return response()->json([
                'success' => true,
                'data' => $catalogues,
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal mengambil data katalog',
                'error' => $e->getMessage()
            ], 500);
        }
    }

}
