<?php

namespace App\Http\Controllers;

use App\Transaction;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    public function cekStatusBooking(Request $request)
    {

        $transaction = Transaction::where('kode_booking', $request->kode_booking)->firstOrFail();

        $anggota = json_decode($transaction->anggota_kelompok) ?? '';
        if(!empty($anggota)) {
        $jumlah_anggota = count($anggota) + 1;
        } else {
        $jumlah_anggota = 1;
        }
        return view('check-status-booking', compact('transaction','jumlah_anggota'));
    }

    public function tataCaraPembayaran()
    {
        return view('cara-pembayaran');
    }

    public function sop()
    {

        return view('sop');
    }
}
