<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Item;
use App\Models\Category;
use App\Models\Tip;

class DashboardAdminController extends Controller
{
    public function index()
    {
        // Hitung total barang
        $totalBarang = Item::count();

        // Hitung total kategori
        $totalCategory = Category::count();

        // Hitung total tip
        $totalTip = Tip::count();

        return view('admin.dashboard', compact(
            'totalBarang',
            'totalCategory',
            'totalTip'
        ));
    }
}

