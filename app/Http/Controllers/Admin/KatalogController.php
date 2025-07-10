<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Katalog;
use Illuminate\Http\Request;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

use Str;


class KatalogController extends Controller
{
    public function katalogIndex(Request $request)
    {

        $search = $request->input('search');

        $catalogues = Katalog::with(['category', 'images'])


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

        $validated = $request->validate([
            'category_id' => 'required|exists:categories,id',
            'nama_produk' => 'required|string|max:255',
            'gambar_produk.*' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',


        $validate = $request->validate([
            'category_id' => 'required|exists:categories,id',
            'nama_produk' => 'required|string|max:255',
            'gambar_produk' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',

            'deskripsi' => 'nullable|string|max:1000',
            'harga' => 'required|numeric|min:0',
        ]);

        $katalog = Katalog::create($validated);

        if ($request->hasFile('gambar_produk')) {
            foreach ($request->file('gambar_produk') as $file) {
                $filename = Str::slug($request->nama_produk) . '-' . uniqid() . '.' . $file->getClientOriginalExtension();
                $path = $file->storeAs('cover', $filename, 'public');

                $katalog->images()->create([
                    'gambar_produk' => $path,
                ]);
            }
        }


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

        $catalogues = Katalog::with('images')->findOrFail($id);
        $categories = Category::all();

        return view('admin.KatalogResource.Pages.editKatalog', compact('catalogues', 'categories'));
    }

    public function katalogUpdate(Request $request, $id)
    {
        $validated = $request->validate([
            'category_id' => 'required|exists:categories,id',
            'nama_produk' => 'required|string|max:255',
            'gambar_produk.*' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',

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


        $katalog = Katalog::findOrFail($id);
        $katalog->update($validated);

        if ($request->hasFile('gambar_produk')) {
            foreach ($katalog->images as $image) {
                Storage::disk('public')->delete($image->gambar_produk);
                $image->delete();
            }

            foreach ($request->file('gambar_produk') as $file) {
                $filename = Str::slug($request->nama_produk) . '-' . uniqid() . '.' . $file->getClientOriginalExtension();
                $path = $file->storeAs('cover', $filename, 'public');

                $katalog->images()->create([
                    'gambar_produk' => $path,
                ]);
            }
        }

        return redirect('/dashboard/admin/katalog')->with('success', 'Katalog berhasil diubah!');

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

        $katalog = Katalog::with('images')->findOrFail($id);

        foreach ($katalog->images as $image) {
            Storage::disk('public')->delete($image->gambar_produk);
            $image->delete();
        }

        $katalog->delete();


        $catalogues = Katalog::findOrFail($id);
        $catalogues->delete();

        return redirect('/dashboard/admin/katalog')->with('success', 'Katalog berhasil dihapus!');
    }
}
