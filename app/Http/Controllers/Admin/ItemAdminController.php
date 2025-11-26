<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Item;

class ItemAdminController extends Controller
{
    public function index() {
        $items = Item::orderBy('status')->paginate(15);
        return view('admin.items.index', compact('items'));
    }
    
    public function acc($id)
    {
    $item = Item::findOrFail($id);
    $item->update(['status' => 'approved']);

    return back()->with('success', 'Barang berhasil disetujui.');
    }
    
    public function reject($id)
    {
    $item = Item::findOrFail($id);
    $item->update(['status' => 'rejected']);

    return back()->with('success', 'Barang ditolak.');
    }

    
}
