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
            'gambar_produk' => 'nullable|array',
            'gambar_produk.*' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'deskripsi' => 'nullable|string|max:1000',
            'harga' => 'required|numeric|min:0',
        ]);

        $gambarPaths = [];

        if ($request->hasFile('gambar_produk')) {
<<<<<<< HEAD
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
=======
            $file = $request->file('gambar_produk');
            $filename = Str::slug($request->nama_produk) . '.' . $file->getClientOriginalExtension();
            $filePath = $file->storeAs('cover', $filename, 'public');
            $validate['gambar_produk'] = $filePath;
        } else {
            $isnull = 'null';
            $validate['gambar_produk'] = $isnull;
>>>>>>> origin/staging
        }

        Katalog::create($validate);

        \Log::info('Gambar paths yang disimpan:', $gambarPaths);
        \Log::info('Isi validate:', $validate);
        return redirect('/dashboard/admin/katalog')->with('success', 'Katalog berhasil ditambahkan!');
    }

<<<<<<< HEAD

    public function katalogEdit()
=======
    public function katalogEdit($id)
>>>>>>> origin/staging
    {
        $catalogues = Katalog::findOrFail($id);
        $categories = Category::all();

        return view('admin.KatalogResource.Pages.editKatalog', compact('catalogues', 'categories'));

    }
<<<<<<< HEAD

    // Customer katalog function
    public function showKatalog(Request $request)
    {
        try {
            $categories = \App\Models\Category::all();
            $selectedCategoryIds = array_filter((array) $request->get('category_id'));
            $searchQuery = $request->get('search');
            $statusFilter = $request->get('status');

            $query = \App\Models\Katalog::query();

            // Filter kategori
            if (!empty($selectedCategoryIds)) {
                $query->whereIn('category_id', $selectedCategoryIds);
            }

            // Filter search
            if ($searchQuery) {
                $query->where(function ($q) use ($searchQuery) {
                    $q->where('nama_produk', 'LIKE', "%$searchQuery%")
                        ->orWhere('deskripsi', 'LIKE', "%$searchQuery%");
                });
            }

            // Filter status
            if ($statusFilter) {
                $query->where('status', $statusFilter);
            }

            $catalogues = $query->paginate(9);

            // Stats
            $statsQuery = \App\Models\Katalog::query();

            if (!empty($selectedCategoryIds)) {
                $statsQuery->whereIn('category_id', $selectedCategoryIds);
            }
            if ($searchQuery) {
                $statsQuery->where(function ($q) use ($searchQuery) {
                    $q->where('nama_produk', 'LIKE', "%$searchQuery%")
                        ->orWhere('deskripsi', 'LIKE', "%$searchQuery%");
                });
            }

            $tersediaResult = (clone $statsQuery)->where('status', 'tersedia')->count();
            $habisResult = (clone $statsQuery)->where('status', 'habis')->count();

            $stats = [
                'total' => $statsQuery->count(),
                'tersedia' => $tersediaResult,
                'habis' => $habisResult,
            ];

            $data = [
                'categories' => $categories,
                'catalogues' => $catalogues,
                'selectedCategoryId' => $selectedCategoryIds,
                'searchQuery' => $searchQuery,
                'statusFilter' => $statusFilter,
                'stats' => $stats,
            ];

            if ($request->ajax()) {
                return response()->view('customer.katalog', $data);
            }

            return view('customer.katalog', $data);

        } catch (\Exception $e) {
            \Log::error('Error in showKatalog: ' . $e->getMessage());

            return view('customer.katalog', [
                'categories' => \App\Models\Category::all(),
                'catalogues' => new \Illuminate\Pagination\LengthAwarePaginator([], 0, 9),
                'selectedCategoryId' => [],
                'searchQuery' => null,
                'statusFilter' => null,
                'stats' => [
                    'total' => 0,
                    'tersedia' => 0,
                    'habis' => 0,
                ]
            ]);
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

    public function showDetail($id)
    {
        $produk = Katalog::findOrFail($id);

        // Ambil semua gambar dari satu field
        $gambarArray = explode(';', $produk->gambar_produk ?? '');

        return view('customer.detail-produk', [
            'produk' => $produk,
            'gambarArray' => $gambarArray,
        ]);
    }

    public function show($id)
    {
        $produk = Katalog::findOrFail($id);

        // Pisahkan string gambar menjadi array
        $gambarArray = explode(';', $produk->gambar_produk ?? '');

        return view('customer.detail-produk', [
            'produk' => $produk,
            'gambarArray' => $gambarArray,
        ]);
    }
=======
    public function katalogUpdate(Request $request, $id)
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

        $catalogues = Katalog::findOrFail($id);
        $catalogues->update($validate);
        return redirect('/dashboard/admin/katalog')->with('success', 'Katalog berhasil dirubah!');
    }

    public function katalogDelete($id)
    {
        $catalogues = Katalog::findOrFail($id);
        $catalogues->delete();
        return redirect('/dashboard/admin/katalog')->with('success', 'Katalog berhasil dihapus!');
    }

>>>>>>> origin/staging
}
