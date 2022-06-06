<?php

namespace App\Http\Controllers\Admin;

use App\Blog;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class BlogController extends Controller
{
    public function index()
    {
        $data = Blog::all();
        return view('Admin.blog.index', compact('data'));
    }

    public function create()
    {
        return view('Admin.blog.create');
    }

    public function store(Request $request)
    {
        $data = new Blog();

        $data->nama_blog = $request->nama_blog;
        $data->isi = $request->isi;
        $data->slug = Str::slug($request->nama_blog);

        if($request->hasFile('gambar')) {
            $file = $request->file('gambar');
            $tujuan_upload = 'image/blog/';
            $nama_file = time()."_".$file->getClientOriginalName();
            $nama_file = str_replace(' ', '', $nama_file);
            $file->move($tujuan_upload,$nama_file);
            // if(file_exists($data->gambar)) {
            //     unlink($data->gambar);
            // }
            $data->gambar = $tujuan_upload.$nama_file;
        }


        $data->save();

        if($data != null) {
            return redirect()->route('admin.blog.index')->with('success','Data Berhasil di Tambah');
        } else {
            return redirect()->route('admin.blog.index')->with('error','Data Gagal di Tambah');
        }
    }

    public function edit($id)
    {
        $item = Blog::findOrFail($id);

        return view('Admin.blog.edit', compact('item'));
    }


    public function update(Request $request, $id)
    {
        $data = Blog::findOrFail($id);

        $data->nama_blog = $request->nama_blog;
        $data->isi = $request->isi;
        $data->slug = Str::slug($request->nama_blog);

        if($request->hasFile('gambar')) {
            $file = $request->file('gambar');
            $tujuan_upload = 'image/blog/';
            $nama_file = time()."_".$file->getClientOriginalName();
            $nama_file = str_replace(' ', '', $nama_file);
            $file->move($tujuan_upload,$nama_file);
            if(file_exists($data->gambar)) {
                unlink($data->gambar);
            }
            $data->gambar = $tujuan_upload.$nama_file;
        }
        $data->save();

        if($data != null) {
            return redirect()->route('admin.blog.index')->with('success','Data Berhasil di Tambah');
        } else {
            return redirect()->route('admin.blog.index')->with('error','Data Gagal di Tambah');
        }
    }

    public function delete($id)
    {
        $data = Blog::findOrFail($id);
        if($data != null) {
            if(file_exists($data->gambar)) {
                unlink($data->gambar);
            }
            $data->delete();
            return redirect()->route('admin.blog.index')->with('success','Data Berhasil di Hapus');
        } else {
            return redirect()->route('admin.blog.index')->with('error','Data Gagal di Hapus');
        }
    }
}
