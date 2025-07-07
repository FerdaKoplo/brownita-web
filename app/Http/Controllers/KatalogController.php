<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Katalog;
use Illuminate\Http\Request;
use Str;

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

    public function katalogEdit($id)
    {
        $catalogues = Katalog::findOrFail($id);
        $categories = Category::all();

        return view('admin.KatalogResource.Pages.editKatalog', compact('catalogues', 'categories'));

    }
    public function katalogUpdate(Request $request, $id)
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

}
