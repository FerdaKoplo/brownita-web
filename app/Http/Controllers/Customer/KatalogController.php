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

        if (!empty($filterCategoryIds)) {
            $katalogQuery->whereIn('category_id', $filterCategoryIds);
        }

        if ($searchKeyword) {
            $katalogQuery->where(function ($q) use ($searchKeyword) {
                $q->where('nama_produk', 'LIKE', "%$searchKeyword%")
                  ->orWhere('deskripsi', 'LIKE', "%$searchKeyword%");

      public function showKatalog(Request $request)
    {
        $categories = Category::all();
        $selectedCategoryIds = array_filter((array) $request->get('category_id'));
        $searchQuery = $request->get('search');
        $statusFilter = $request->get('status');

        $query = Katalog::query();

        if (!empty($selectedCategoryIds)) {
            $query->whereIn('category_id', $selectedCategoryIds);
        }

        if ($searchQuery) {
            $query->where(function ($q) use ($searchQuery) {
                $q->where('nama_produk', 'LIKE', "%$searchQuery%")
                  ->orWhere('deskripsi', 'LIKE', "%$searchQuery%");

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

            $query->where('status', $statusFilter);
        }

        $catalogues = $query->paginate(9);

        $statsQuery = Katalog::query();

        if (!empty($selectedCategoryIds)) {
            $statsQuery->whereIn('category_id', $selectedCategoryIds);
        }

        if ($searchQuery) {
            $statsQuery->where(function ($q) use ($searchQuery) {
                $q->where('nama_produk', 'LIKE', "%$searchQuery%")
                  ->orWhere('deskripsi', 'LIKE', "%$searchQuery%");
            });
        }

        $stats = [
            'total' => $statsQuery->count(),
            'tersedia' => (clone $statsQuery)->where('status', 'tersedia')->count(),
            'habis' => (clone $statsQuery)->where('status', 'habis')->count(),
        ];

        return view('customer.katalog', [
            'categories' => $categories,
            'catalogues' => $catalogues,
            'selectedCategoryId' => $selectedCategoryIds,
            'searchQuery' => $searchQuery,
            'statusFilter' => $statusFilter,
            'stats' => $stats,

        ]);
    }

    public function showDetail($id)
    {

        $produk = Katalog::with(['images', 'category'])->findOrFail($id);

        return view('customer.detail-produk', [
            'produk' => $produk,

        $produk = Katalog::findOrFail($id);
        $gambarArray = explode(';', $produk->gambar_produk ?? '');

        return view('customer.detail-produk', [
            'produk' => $produk,
            'gambarArray' => $gambarArray,

        ]);
    }
}
