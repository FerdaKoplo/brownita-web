<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function kategoriIndex()
    {
        $categories = Category::all();
        return view('admin.KategoriResource.Pages.viewKategori', compact('categories'));
    }

    // public function show(){

    // }

    public function kategoriCreate()
    {
        return view('admin.KategoriResource.Pages.createKategori');
    }

    public function kategoriStore(Request $request)
    {
        $validate = $request->validate([
            'nama_kategori' => 'required|string|max:255',
            'deskripsi_kategori' => 'required|string|max:255'
        ]);

        Category::create($validate);
        return redirect('/dashboard/admin/kategori')->with('success', 'Kategori berhasil ditambahkan!');
    }

    public function kategoriEdit($id)
    {
        $categories = Category::find($id);
        return view('admin.KategoriResource.Pages.editKategori', compact('categories'));
    }

    public function kategoriUpdate(Request $request, $id)
    {
        $validate = $request->validate([
            'nama_kategori' => 'required|string|max:255',
            'deskripsi_kategori' => 'required|string|max:255'
        ]);

        $categories = Category::findOrFail($id);
        $categories->update($validate);
        return redirect('/dashboard/admin/kategori')->with('success', 'Kategori berhasil dirubah!');

    }

    public function kategoriDelete($id)
    {
        $categories = Category::findOrFail($id);
        $categories->delete();

        return redirect('/dashboard/admin/kategori')->with('success', 'Kategori berhasil dihapus!');
    }
}
