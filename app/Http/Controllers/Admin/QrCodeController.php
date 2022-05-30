<?php

namespace App\Http\Controllers\Admin;

use App\Transaction;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Yajra\DataTables\Facades\DataTables;

class QrCodeController extends Controller
{
    public function index()
    {
        if (request()->ajax()) {

            $query  = Transaction::query();
            $query->where('status','disetujui')->orWhere('status','naik');
            return DataTables::of($query)
                ->editColumn('status', function ($item) {
                    if($item->status == 'disetujui'){
                        return '<span class="badge badge-success">DISETUJUI</span>';
                    } elseif($item->status == 'pending') {
                        return '<span class="badge badge-warning">PENDING</span>';
                    } elseif($item->status == 'naik') {
                        return '<span class="badge badge-success">NAIK</span>';
                    }
                    else {
                        return '<span class="badge badge-danger">DIBATALKAN</span>';
                    }
                })
                ->editColumn('nama_ketua_kelompok', function ($item) {
                    return $item->ketuaKelompok->nama_ketua_kelompok;
                })
                ->editColumn('created_at', function ($item) {
                    return $item->created_at;
                })
                ->rawColumns(['status'])
                ->make();
        }

        return view('Admin.scan-qr-code.index');
    }

    public function update(Request $request)
    {
        $data = Transaction::where('kode_booking', $request->kode_booking)->first();

        $data->status = 'naik';
        $data->save();

        return redirect()->route('scan.index')->with('success','Data Berhasil di Update');
    }
}
