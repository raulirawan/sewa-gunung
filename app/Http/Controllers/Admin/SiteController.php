<?php

namespace App\Http\Controllers\Admin;

use App\Site;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SiteController extends Controller
{
    public function index()
    {
        $data = Site::all();
        return view('Admin.site.index', compact('data'));
    }

    public function create()
    {
        return view('Admin.site.create');
    }

    public function store(Request $request)
    {
        $data = new Site();

        $data->nama_site = $request->nama_site;
        $data->harga = $request->harga;
        $data->slug = Str::slug($request->nama_site);
        $data->isi = $request->isi;

        $data->save();

        if($data != null) {
            return redirect()->route('admin.site.index')->with('success','Data Berhasil di Tambah');
        } else {
            return redirect()->route('admin.site.index')->with('error','Data Gagal di Tambah');
        }
    }

    public function edit($id)
    {
        $item = Site::findOrFail($id);
        return view('Admin.site.edit', compact('item'));
    }


    public function update(Request $request, $id)
    {
        $data = Site::findOrFail($id);

        $data->nama_site = $request->nama_site;
        $data->harga = $request->harga;
        $data->slug = Str::slug($request->nama_site);
        $data->isi = $request->isi;

        $data->save();

        if($data != null) {
            return redirect()->route('admin.site.index')->with('success','Data Berhasil di Update');
        } else {
            return redirect()->route('admin.site.index')->with('error','Data Gagal di Update');
        }
    }

    public function delete($id)
    {
        $data = Site::findOrFail($id);

        if($data != null) {
            $data->delete();
            return redirect()->route('admin.site.index')->with('success','Data Berhasil di Hapus');
        } else {
            return redirect()->route('admin.site.index')->with('error','Data Gagal di Hapus');
        }
    }
}
