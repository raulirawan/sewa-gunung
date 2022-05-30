<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Transaction;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $setuju = Transaction::where('status','disetujui')->count();
        $pending = Transaction::where('status','pending')->count();
        $batal = Transaction::where('status','dibatalkan')->count();
        return view('Admin.dashboard', compact('setuju','pending','batal'));
    }
}
