<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Katalog;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class KatalogController extends Controller
{
    public function katalogIndex(Request $request)
    {

        $search = $request->input('search');

        $catalogues = Katalog::with('category')
            ->when($search, function ($query, $search) {
                $query->where('nama_produk', 'like', "%{$search}%");
            })
            ->get();
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
            'gambar_produk' => 'nullable|array',
            'gambar_produk.*' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'deskripsi' => 'nullable|string|max:1000',
            'harga' => 'required|numeric|min:0',
        ]);

        $gambarPaths = [];

        if ($request->hasFile('gambar_produk')) {
            foreach ($request->file('gambar_produk') as $index => $file) {
                $filename = Str::slug($request->nama_produk) . '-' . time() . "-$index." . $file->getClientOriginalExtension();
                $path = $file->storeAs('produk', $filename, 'public');
                $gambarPaths[] = $path;

            }

            // Simpan sebagai string dengan delimiter ;
            $validate['gambar_produk'] = implode(';', $gambarPaths);
        }
        else {
            $validate['gambar_produk'] = null;
        }

        Katalog::create($validate);

        \Log::info('Gambar paths yang disimpan:', $gambarPaths);
        \Log::info('Isi validate:', $validate);
        return redirect('/dashboard/admin/katalog')->with('success', 'Katalog berhasil ditambahkan!');
    }


    public function katalogEdit($id)
    {
        $catalogues = Katalog::findOrFail($id);
        $categories = Category::all();

        return view('admin.KatalogResource.Pages.editKatalog', compact('catalogues', 'categories'));

    }

    // Customer katalog function
    public function showKatalog(Request $request)
    {
        $validate = $request->validate([
            'category_id' => 'required|exists:categories,id',
            'nama_produk' => 'required|string|max:255',
            'gambar_produk' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'deskripsi' => 'nullable|string|max:1000',
            'harga' => 'required|numeric|min:0',
            'status' => 'required|in:tersedia,habis',
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
    }


    // Method untuk API atau AJAX request
    public function getKatalogData(Request $request)
    {
        try {
            $statusFilter = $request->get('status');
            $query = Katalog::with('category');

            // Filter berdasarkan kategori
            if ($request->has('category_id') && $request->category_id) {
                $query->where('category_id', $request->category_id);
            }

            // Filter berdasarkan status (array checkbox)
            if ($statusFilter) {
                $query->where('status', $statusFilter);
            } else {
                $query->where('status', 'tersedia');
            }



            return view('katalog', compact('statusFilter'));

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
