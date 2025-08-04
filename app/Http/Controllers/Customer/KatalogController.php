<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Katalog;
use Illuminate\Http\Request;

class KatalogController extends Controller
{
    public function showKatalog(Request $request)
    {
        $allCategories = Category::all();

        $filterCategoryIds = array_filter((array) $request->get('category_id'));
        $searchKeyword = $request->get('search');
        $statusFilter = $request->get('status');
        $katalogQuery = Katalog::with('images');

        $sort = $request->get('sort');
        // clean inputan sebelum diquery
        $minPrice = (int) preg_replace('/[^\d]/', '', $request->get('min_price'));
        $maxPrice = (int) preg_replace('/[^\d]/', '', $request->get('max_price'));

        if ($minPrice) {
            $katalogQuery->where('harga', '>=', $minPrice);
        }
        if ($maxPrice) {
            $katalogQuery->where('harga', '<=', $maxPrice);
        }

        if ($sort === 'asc') {
            $katalogQuery->orderBy('harga', 'asc');
        } elseif ($sort === 'desc') {
            $katalogQuery->orderBy('harga', 'desc');
        }

        if (!empty($filterCategoryIds)) {
            $katalogQuery->whereIn('category_id', $filterCategoryIds);
        }

        if ($searchKeyword) {
            $katalogQuery->where(function ($q) use ($searchKeyword) {
                $q->where('nama_produk', 'LIKE', "%$searchKeyword%")
                  ->orWhere('deskripsi', 'LIKE', "%$searchKeyword%");
            });
        }

        if ($statusFilter) {
            $katalogQuery->where('status', $statusFilter);
        }

        $filteredKatalog = $katalogQuery->paginate(9);

        $statisticQuery = Katalog::query();

        if (!empty($filterCategoryIds)) {
            $statisticQuery->whereIn('category_id', $filterCategoryIds);
        }

        if ($searchKeyword) {
            $statisticQuery->where(function ($q) use ($searchKeyword) {
                $q->where('nama_produk', 'LIKE', "%$searchKeyword%")
                  ->orWhere('deskripsi', 'LIKE', "%$searchKeyword%");
            });
        }

        $katalogStats = [
            'total' => $statisticQuery->count(),
            'tersedia' => (clone $statisticQuery)->where('status', 'tersedia')->count(),
            'habis' => (clone $statisticQuery)->where('status', 'habis')->count(),
        ];

        return view('customer.katalog', [
            'categories' => $allCategories,
            'catalogues' => $filteredKatalog,
            'selectedCategoryId' => $filterCategoryIds,
            'searchQuery' => $searchKeyword,
            'statusFilter' => $statusFilter,
            'stats' => $katalogStats,
        ]);
    }

    public function showDetail($id)
    {
        $produk = Katalog::with(['images', 'category'])->findOrFail($id);

        return view('customer.detail-produk', [
            'produk' => $produk,
        ]);
    }
}
