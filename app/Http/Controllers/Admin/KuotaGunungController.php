<?php

namespace App\Http\Controllers\Admin;

use App\Site;
use App\KuotaGunung;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class KuotaGunungController extends Controller
{
    public function index()
    {
        $data = KuotaGunung::orderBy('tanggal','asc')->get();
        $sites = Site::all();
        return view('Admin.kuota-gunung.index', compact('data','sites'));
    }

    public function store(Request $request)
    {
        $data = new KuotaGunung();

        $kuotaGunung = KuotaGunung::where('tanggal', $request->tanggal)->where('site_id', $request->site_id)->first();

        if($kuotaGunung != null)
        {
            return redirect()->route('admin.kuota-gunung.index')->with('error','Tanggal Dan Site Sudah Tersedia, Silahkan Coba Yang Lain Ya!');
        }

        $data->tanggal = $request->tanggal;
        $data->site_id = $request->site_id;
        $data->kuota = $request->kuota;

        $data->save();

        if($data != null) {
            return redirect()->route('admin.kuota-gunung.index')->with('success','Data Berhasil di Tambah');
        } else {
            return redirect()->route('admin.kuota-gunung.index')->with('error','Data Gagal di Tambah');
        }
    }

    public function edit($id)
    {
        $data = KuotaGunung::findOrFail($id);
        $sites = Site::all();
        return view('Admin.site.edit', compact('data','sites'));
    }

    public function update(Request $request, $id)
    {
        $data = KuotaGunung::findOrFail($id);

        $kuotaGunung = KuotaGunung::where('tanggal', $request->tanggal)->where('site_id', $request->site_id)->first();

        if($data->tanggal == $request->tanggal && $data->site_id == $request->site_id) {
            $data->tanggal = $request->tanggal;
            $data->site_id = $request->site_id;
            $data->kuota = $request->kuota;

            $data->save();

            if($data != null) {
                return redirect()->route('admin.kuota-gunung.index')->with('success','Data Berhasil di Update');
            } else {
                return redirect()->route('admin.kuota-gunung.index')->with('error','Data Gagal di Update');
            }
        } elseif ($kuotaGunung == null){
            $data->tanggal = $request->tanggal;
            $data->site_id = $request->site_id;
            $data->kuota = $request->kuota;

            $data->save();

            if($data != null) {
                return redirect()->route('admin.kuota-gunung.index')->with('success','Data Berhasil di Update');
            } else {
                return redirect()->route('admin.kuota-gunung.index')->with('error','Data Gagal di Update');
            }
        } else {

            return redirect()->route('admin.kuota-gunung.index')->with('error','Tanggal Dan Site Sudah Tersedia, Silahkan Coba Yang Lain Ya!');
        }

    }

    public function delete($id)
    {
        $data = KuotaGunung::findOrFail($id);

        if($data != null) {
            $data->delete();
            return redirect()->route('admin.kuota-gunung.index')->with('success','Data Berhasil di Hapus');
        } else {
            return redirect()->route('admin.kuota-gunung.index')->with('error','Data Gagal di Hapus');
        }
    }
}
