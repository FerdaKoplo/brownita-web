<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function kategoriIndex(){
        $categories = Category::all();
        return view('admin.KategoriResource.Pages.viewKategori', compact('categories'));
    }

    // public function show(){

    // }

    public function createKategori(){
        return view('admin.KategoriResource.Pages.createKategori');
    }

    public function storeKategori(Request $request){
        $validate = $request->validate([
            'nama_kategori' => 'required|string|max:255',
            'deskripsi_kategori' => 'required|string|max:255'
        ]);

        Category::create($validate);
        return redirect('/dashboard/admin/kategori')->with('success', 'Kategori berhasil ditambahkan!');
    }

    public function editKategori($id){

    }

    public function updateKategori(){

    }

    public function deleteKategori(){

    }
}
