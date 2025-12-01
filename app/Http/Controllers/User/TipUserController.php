<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Tip;

class TipUserController extends Controller
{
    // ============================
    // LIST TIP USER
    // ============================
    public function index()
    {
        $tips = Tip::where('user_id', auth()->id())->paginate(10);
        return view('user.tip.index', compact('tips'));
    }

    // ============================
    // FORM KIRIM TIP
    // ============================
    public function create()
    {
        return view('user.tip.create');
    }

    // ============================
    // PROSES KIRIM TIP
    // ============================
    public function store(Request $request)
    {
        $request->validate([
            'jumlah'          => 'required|numeric',
            'pesan'           => 'nullable|string',
            'bukti_transfer'  => 'nullable|image|max:2048'
        ]);

        $tip = new Tip();
        $tip->user_id = auth()->id();
        $tip->jumlah = $request->jumlah;
        $tip->pesan = $request->pesan;

        // ========= UPLOAD BUKTI TRANSFER ==========
        if ($request->hasFile('bukti_transfer')) {
            // simpan ke storage/app/public/bukti_tf
            $tip->bukti_transfer = $request->file('bukti_transfer')->store('bukti_tf', 'public');
        }

        // simpan database
        $tip->save();

        return redirect()->route('user.tip.index')
                         ->with('success', 'Tip berhasil dikirim!');
    }
}
