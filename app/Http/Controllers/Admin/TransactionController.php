<?php

namespace App\Http\Controllers\Admin;

use App\Transaction;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Psy\Readline\Transient;
use Yajra\DataTables\Facades\DataTables;

class TransactionController extends Controller
{
    public function index(Request $request)
    {
        if (request()->ajax()) {

            if (!empty($request->from_date)) {
                if ($request->from_date === $request->to_date) {
                    $query  = Transaction::query();
                    $query->with(['ketuaKelompok','site'])
                          ->whereDate('created_at', $request->from_date);
                } else {
                    $query  = Transaction::query();
                    $query->with(['ketuaKelompok','site'])
                            ->whereBetween('created_at', [$request->from_date.' 00:00:00', $request->to_date.' 23:59:59']);
                }
            } else {
                $today = date('Y-m-d');
                $query  = Transaction::query();
                $query->with(['ketuaKelompok','site'])
                    ->whereDate('created_at', $today);
            }

            return DataTables::of($query)
                ->addColumn('action', function ($item) {
                    return '<a href="' . route('admin.transaksi.detail', $item->id) . '" class="btn-sm btn-info"><i class="fas fa-eye"></i>Detail</a>';
                })
                ->editColumn('status', function ($item) {
                    if($item->status == 'disetujui'){
                        return '<span class="badge badge-success">DISETUJUI</span>';
                    } elseif($item->status == 'pending') {
                        return '<span class="badge badge-warning">PENDING</span>';
                    } elseif($item->status == 'naik') {
                        return '<span class="badge badge-success">NAIK</span>';
                    }elseif($item->status == 'turun') {
                        return '<span class="badge badge-danger">PENDAKIAN SELESAI</span>';
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
                ->rawColumns(['action','status'])
                ->make();
        }

        return view('Admin.transaction.index');
    }

    public function detail($id)
    {
        $transaction = Transaction::findOrFail($id);
        return view('Admin.transaction.detail', compact('transaction'));
    }
}
