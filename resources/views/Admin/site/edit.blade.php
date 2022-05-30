@extends('layouts.dashboard-admin')

@section('title', 'Halaman Edit User')

@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Edit User</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">User</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">

                <div class="row">
                    <div class="col-12">

                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Form Edit Data User</h3>
                            </div>
                            <!-- /.card-header -->
                            <form method="POST" action="{{ route('admin.kuota-gunung.update', $data->id) }}"
                                enctype="multipart/form-data">
                                @csrf
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Tanggal</label>
                                        <input type="date" class="form-control"
                                            value="{{ $data->tanggal }}" name="tanggal" placeholder="Nama Lengkap" required>
                                    </div>

                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Tanggal</label>
                                        <select name="site_id" id="site_id" class="form-control">
                                            <option value="">Pilih Site</option>
                                            @foreach ($sites as $site)
                                                <option value="{{ $site->id }}" {{ $site->id == $data->site_id ? 'selected' : '' }} >{{ $site->nama_site }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Kuota</label>
                                        <input type="number" class="form-control"
                                            value="{{ $data->kuota }}" name="kuota" placeholder="Kuota" required>
                                    </div>


                                </div>


                                <div class="card-footer">
                                    <button type="submit" class="btn btn-primary">Simpan</button>
                                </div>
                        </div>
                        <!-- /.card-body -->

                        </form>

                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
    </div>
@endsection
