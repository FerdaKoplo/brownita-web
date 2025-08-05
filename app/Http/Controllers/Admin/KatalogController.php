<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Katalog;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use App\Models\KatalogImage;


class KatalogController extends Controller
{
    public function katalogIndex(Request $request)
    {
        $search = $request->input('search');

        $catalogues = Katalog::with(['category', 'images'])
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
        $validated = $request->validate(
            [
                'category_id' => 'required|exists:categories,id',
                'nama_produk' => 'required|string|max:255',
                'deskripsi' => 'nullable|string|max:1000',
                'harga' => 'required|numeric|min:0',
                'gambar_produk.*' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            ],
            [
                'nama_produk.required' => 'Nama produk wajib diisi.',
                'gambar_produk.*.image' => 'File harus berupa gambar.',
                'gambar_produk.*.mimes' => 'Gambar harus berformat JPEG, PNG, JPG, atau WEBP.',
                'gambar_produk.*.max' => 'Ukuran gambar maksimal 2MB.',
                'harga.required' => 'Harga wajib diisi.',
                'harga.numeric' => 'Harga harus berupa angka.',
                'harga.min' => 'Harga tidak boleh nol.',    
            ]
        );

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
            'deskripsi' => 'nullable|string|max:1000',
            'harga' => 'required|numeric|min:0',
            'status' => 'required|in:tersedia,habis',
            'gambar_produk.*' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ], [
            'nama_produk.required' => 'Nama produk wajib diisi.',
            'harga.required' => 'Harga produk tidak boleh kosong.',
        ]);

        $katalog = Katalog::with('images')->findOrFail($id);
        $katalog->update($validated);

        if ($request->hasFile('gambar_produk')) {
            // Hapus gambar lama
            foreach ($katalog->images as $image) {
                Storage::disk('public')->delete($image->gambar_produk);
                $image->delete();
            }

            // Simpan gambar baru
            foreach ($request->file('gambar_produk') as $file) {
                $filename = Str::slug($request->nama_produk) . '-' . uniqid() . '.' . $file->getClientOriginalExtension();
                $path = $file->storeAs('cover', $filename, 'public');

                $katalog->images()->create([
                    'gambar_produk' => $path,
                ]);
            }
        }

        return redirect('/dashboard/admin/katalog')->with('success', 'Katalog berhasil diubah!');
    }


    public function katalogDelete($id)
    {
        $katalog = Katalog::with('images')->findOrFail($id);

        // Hapus semua gambar
        foreach ($katalog->images as $image) {
            Storage::disk('public')->delete($image->gambar_produk);
            $image->delete();
        }

        // Hapus katalog
        $katalog->delete();

        return redirect('/dashboard/admin/katalog')->with('success', 'Katalog berhasil dihapus!');
    }


    public function deleteImage($id)
    {
        $image = KatalogImage::findOrFail($id); // Sesuaikan model & relasi
        Storage::delete('public/' . $image->gambar_produk); // hapus file dari storage
        $image->delete(); // hapus record DB

        return back()->with('success', 'Gambar berhasil dihapus.');
    }



}
