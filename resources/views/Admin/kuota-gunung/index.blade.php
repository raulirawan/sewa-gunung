@extends('layouts.dashboard-admin')

@section('title', 'Halaman Site')

@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Kuota Gunung</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Kuota Gunung</li>
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
                        @if (session()->has('success'))
                            <div class="alert alert-success">
                                {{ session()->get('success') }}
                            </div>
                        @endif
                        @if (session()->has('error'))
                            <div class="alert alert-danger">
                                {{ session()->get('error') }}
                            </div>
                        @endif
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Data Kuota Gunung</h3>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <button type="button" class="btn btn-primary" data-toggle="modal"
                                    data-target="#exampleModal">
                                    (+) Tambah Kuota Gunung
                                </button>

                                <table id="example1" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th style="width: 5%">No</th>
                                            <th>Tanggal</th>
                                            <th>Nama Site</th>
                                            <th style="width: 15%">Kuota</th>
                                            <th style="width: 20%">Aksi</th>

                                        </tr>
                                    </thead>
                                    <tbody>

                                        @foreach ($data as $item)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $item->tanggal }}</td>
                                                <td>{{ $item->site->nama_site }}</td>
                                                <td>{{ $item->kuota }} Orang</td>
                                                <td>
                                                    <a href="{{ route('admin.kuota-gunung.edit', $item->id) }}" class="btn btn-sm btn-primary" style='float: left;'>Edit</a>
                                                    <form action="{{ route('admin.kuota-gunung.delete', $item->id) }}"
                                                        method="POST" style='float: left; padding-left: 5px;'>
                                                        @csrf
                                                        <button type="submit" class="btn btn-sm btn-danger"
                                                            onclick="return confirm('Yakin ?')">Hapus</button>
                                                    </form>
                                                </td>
                                            </tr>
                                        @endforeach

                                    </tbody>

                                </table>
                            </div>
                            <!-- /.card-body -->
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

    <!-- Modal Create -->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Tambah Data Site</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="{{ route('admin.kuota-gunung.store') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="card-body">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Tanggal</label>
                                <input type="date" class="form-control"
                                    value="{{ old('tanggal') }}" name="tanggal" placeholder="Tanggal" required>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Tanggal</label>
                                <select name="site_id" id="site_id" class="form-control">
                                    <option value="">Pilih Site</option>
                                    @foreach ($sites as $site)
                                        <option value="{{ $site->id }}">{{ $site->nama_site }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Kuota</label>
                                <input type="number" class="form-control"
                                    value="{{ old('kuota') }}" name="kuota" placeholder="Kuota" required>
                            </div>
                        </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-primary">Simpan Data</button>
                </div>
                </form>

            </div>
        </div>
    </div>


    <!-- Modal Edit -->
    {{-- <div class="modal fade modal-edit" id="modal-edit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Data Site</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="POST" id="form-edit" action="#" enctype="multipart/form-data">
                        @csrf
                        <div class="card-body">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Tanggal</label>
                                <input type="date" class="form-control"
                                    value="{{ old('tanggal') }}" name="tanggal" id="tanggal" placeholder="Tanggal" required>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Tanggal</label>
                                <select name="site_id" id="site_id" class="form-control">
                                    <option value="">Pilih Site</option>
                                    @foreach ($sites as $site)
                                        <option value="{{ $site->id }}">{{ $site->nama_site }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Kuota</label>
                                <input type="number" class="form-control"
                                    value="{{ old('kuota') }}" name="kuota" placeholder="Kuota" required>
                            </div>
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-primary">Simpan Data</button>
                </div>
                </form>

            </div>
        </div>
    </div> --}}



@endsection

@push('down-script')
    @if (count($errors) > 0)
        <script type="text/javascript">
            $(document).ready(function () {
                $('#exampleModal').modal('show');
            });
        </script>
         <script type="text/javascript">
            $(document).ready(function () {
                $('#modal-edit').modal('show');
            });
        </script>
    @endif
    {{-- <script>
        $(document).ready(function() {
            $(document).on('click', '#edit', function() {
                var id = $(this).data('id');
                var nama_site = $(this).data('nama_site');
                var harga = $(this).data('harga');


                $('#nama_site').val(nama_site);
                $('#harga').val(harga);

                $('#form-edit').attr('action','/admin/site/update/' + id);
            });
        });
    </script> --}}
    <script>
        $(function() {
            $("#example1").DataTable({
                "responsive": false,
                "lengthChange": false,
                "autoWidth": false,
            }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
            $('#example2').DataTable({
                "paging": true,
                "lengthChange": false,
                "searching": false,
                "ordering": false,
                "info": false,
                "autoWidth": false,
                "responsive": true,
            });
        });
    </script>
@endpush
