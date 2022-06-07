<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\SOP;
use Illuminate\Http\Request;

class SOPController extends Controller
{
    public function index()
    {
        $sop = SOP::first();
        return view('Admin.sop.edit', compact('sop'));
    }

    public function update(Request $request)
    {
        $data = SOP::first();
        $data->isi = $request->isi;
        $data->save();

        if($data != null) {
            return redirect()->route('admin.sop.index')->with('success','Data Berhasil di Update');
        } else {
            return redirect()->route('admin.sop.index')->with('error','Data Gagal di Update');
        }
    }
}
