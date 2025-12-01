<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Item;
use App\Models\Category;

class DashboardUserController extends Controller
{
    public function index(Request $request)
    {
        $categories = Category::all();

        // Mulai query
        $items = Item::query()
            ->where('status', 'approved'); // pastikan item kamu memang status=accepted

        // Filter kategori
        if ($request->filled('kategori')) {
            $items->where('category_id', $request->kategori);
        }

        // Filter search nama barang
        if ($request->filled('q')) {
            $items->where('nama_barang', 'LIKE', "%{$request->q}%");
        }

        // Ambil data
        $items = $items->latest()->get();

        return view('user.dashboard', compact('items', 'categories'));
    }
}
