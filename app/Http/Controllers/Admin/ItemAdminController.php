<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Item;

class ItemAdminController extends Controller
{
    public function index()
    {
        $items = Item::orderBy('status')->paginate(15);
        return view('admin.items.index', compact('items'));
    }

    public function acc($id)
    {
        $item = Item::findOrFail($id);
        $item->update([
            'status' => 'approved',
            'alasan' => null
        ]);

        return back()->with('success', 'Barang berhasil disetujui.');
    }

    public function reject(Request $request, $id)
    {
        $request->validate([
            'alasan' => 'required|min:3'
        ]);

        $item = Item::findOrFail($id);
        $item->update([
            'status' => 'rejected',
            'alasan' => $request->alasan
        ]);

        return back()->with('success', 'Barang berhasil ditolak beserta alasan.');
    }
}
