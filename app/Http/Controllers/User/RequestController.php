<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request; // HTTP Request
use App\Models\Request as RequestModel; // Model Request
use App\Models\Item;

class RequestController extends Controller
{
    public function index()
    {
        $requests = RequestModel::where('user_id', auth()->id())
            ->with('item')
            ->paginate(10);

        return view('user.requests.index', compact('requests'));
    }

    public function create()
    {
        $items = Item::where('status', 'tersedia')->paginate(10);

        return view('user.requests.create', compact('items'));
    }

    public function store(Request $req)
    {
        $req->validate([
            'item_id' => 'required|exists:items,id',
            'pesan' => 'nullable|string'
        ]);

        RequestModel::create([
            'item_id' => $req->item_id,
            'user_id' => auth()->id(),
            'pesan' => $req->pesan,
            'status' => 'menunggu'
        ]);

        return redirect()->route('user.requests.index')
            ->with('success', 'Permintaan berhasil dikirim');
    }

    public function destroy($id)
    {
        $reqData = RequestModel::findOrFail($id);

        if ($reqData->user_id != auth()->id()) {
            abort(403, 'Anda tidak memiliki hak untuk membatalkan permintaan ini');
        }

        $reqData->delete();

        return back()->with('success', 'Permintaan berhasil dibatalkan');
    }
}
