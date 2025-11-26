<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;

class DashboardUserController extends Controller
{
    public function index()
    {
    $items = \App\Models\Item::latest()->get();

    return view('user.dashboard', compact('items'));
    }
}


