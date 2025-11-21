<?php

namespace App\Http\Controllers\Penerima;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardPenerimaController extends Controller
{
    public function index()
    {
        return view('penerima.dashboard');
    }
}
