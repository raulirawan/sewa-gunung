@extends('layouts.dashboard-admin')

@section('title', 'Halaman Tambah Blog')

@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Tambah Blog</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Blog</li>
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
                                <h3 class="card-title">Form Tambah Data Blog</h3>
                            </div>
                            <!-- /.card-header -->
                            <form method="POST" action="{{ route('admin.blog.store') }}" enctype="multipart/form-data">
                                @csrf
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Nama Blog</label>
                                        <input type="text" class="form-control"
                                            value="{{ old('nama_blog') }}" name="nama_blog" placeholder="Nama Blog" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Gambar</label>
                                        <input type="file" class="form-control"
                                            value="{{ old('gambar') }}" name="gambar" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Isi Blog</label>
                                        <textarea name="isi" class="form-control" id="editor"
                                            value="" placeholder="Isi Blog">{{ old('isi') }}</textarea>
                                    </div>
                                </div>
                                <!-- /.card-body -->
                                <div class="card-footer">
                                    <button type="submit" class="btn btn-primary">Simpan</button>
                                </div>
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
    @push('down-script')
    <script src="https://cdn.ckeditor.com/4.19.0/standard/ckeditor.js"></script>
    <script>
        CKEDITOR.replace( 'isi' );
</script>
    @endpush
@endsection
