<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Katalog;
use Illuminate\Http\Request;
use Str;

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
}
