<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\RequestDonation;
use App\Models\Item;

class RequestController extends Controller
{
    public function index()
    {
        // // Tampilkan request milik user
        // $requests = RequestDonation::where('user_id', auth()->id())
        $request = Request::where('user_id', auth()->id())->count()
            ->with('item')
            ->paginate(10);

        return view('user.requests.index', compact('requests'));
    }

    public function create()
    {
        // Tampilkan item yang tersedia
        $items = Item::where('status', 'tersedia')->paginate(10);

        return view('user.requests.create', compact('items'));
    }

    public function store(Request $req)
    {
        $req->validate([
            'item_id' => 'required|exists:items,id',
            'pesan' => 'nullable|string'
        ]);

        RequestDonation::create([
            'item_id' => $req->item_id,
            'user_id' => auth()->id(),  // dulu id_penerima
            'pesan' => $req->pesan,
            'status' => 'menunggu'
        ]);

        return redirect()->route('user.requests.index')->with('success', 'Permintaan berhasil dikirim');
    }

    public function destroy($id)
    {
        $reqData = RequestDonation::findOrFail($id);

        if ($reqData->user_id != auth()->id()) {
            abort(403, 'Anda tidak memiliki hak untuk membatalkan permintaan ini');
        }

        $reqData->delete();

        return back()->with('success', 'Permintaan berhasil dibatalkan');
    }
}
