<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Item;

class InboxController extends Controller
{
    public function index()
    {
        $messages = Item::where('user_id', auth()->id())
            ->whereIn('status', ['approved', 'rejected'])
            ->latest()
            ->paginate(10);  // gunakan paginate, bukan get()


        return view('user.inbox.index', compact('messages'));
    }

    public function show($id)
    {
        $msg = Item::where('user_id', auth()->id())->findOrFail($id);

        return view('user.inbox.show', compact('msg'));
    }
}
