<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Tip;

class TipAdminController extends Controller
{
    public function index()
    {
        $tips = Tip::with('user')
            ->select('id', 'user_id', 'jumlah', 'pesan', 'bukti_transfer', 'created_at')
            ->latest()
            ->paginate(10);

        return view('admin.tip.index', compact('tips'));
    }
}
