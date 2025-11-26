<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Item;

class HistoryController extends Controller
{
    public function index()
    {
        // Ambil riwayat barang yg sudah ACC atau REJECT
        $items = Item::whereIn('status', ['acc', 'reject'])
                    ->latest()
                    ->get();

        return view('admin.history.index', compact('items'));
    }
}
