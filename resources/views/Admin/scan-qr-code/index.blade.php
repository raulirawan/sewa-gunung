@extends('layouts.dashboard-admin')

@section('title', 'Halaman Transaksi')

@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Transaksi</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Transaksi</li>
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
                                <h3 class="card-title">Data Transaksi</h3>
                            </div>
                           <form action="{{ route('scan.update') }}" method="POST">
                               @csrf
                            <div class="row input-daterange ml-2 mt-2">
                                <div class="col-md-4">
                                    <input type="text" name="kode_booking" id="kode_booking" class="form-control"
                                        placeholder="Masukan Kode Booking (SCAN NAIK)" required />
                                </div>
                                <div class="col-md-4">
                                    <button type="submit"  class="btn btn-primary">Update</button>
                                </div>

                            </div>
                           </form>
                           <form action="{{ route('scan.update.turun') }}" method="POST">
                            @csrf
                         <div class="row input-daterange ml-2 mt-2">
                             <div class="col-md-4">
                                 <input type="text" name="kode_booking" id="kode_booking" class="form-control"
                                     placeholder="Masukan Kode Booking (SCAN TURUN)" required />
                             </div>
                             <div class="col-md-4">
                                 <button type="submit"  class="btn btn-primary">Update</button>
                             </div>

                         </div>
                        </form>
                            <!-- /.card-header -->
                            <div class="card-body table-responsive">

                                <table id="table-data"
                                    class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th style="width: 5%">Tanggal Transaksi</th>
                                            <th>Kode Booking</th>
                                            <th>Nama Ketua Kelompok</th>
                                            <th style="width: 10%">Tanggal Berangkat</th>
                                            <th style="width: 10%">Tanggal Pulang</th>
                                            <th>Status</th>
                                            {{-- <th>Total Harga</th> --}}
                                            {{-- <th style="width: 15%">Aksi</th> --}}

                                        </tr>
                                    </thead>
                                    <tbody>


                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th colspan="5">Total</th>
                                            <th id="total"></th>
                                        </tr>
                                    </tfoot>
                                </table>
                                {{-- {!! $dataTable->table() !!} --}}
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
@endsection
@push('down-style')
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.css">
@endpush
@push('down-script')
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.0.3/css/buttons.dataTables.min.css">
    <script type="text/javascript" src="https://cdn.datatables.net/buttons/1.3.1/js/dataTables.buttons.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/buttons/1.3.1/js/buttons.html5.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"> </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"> </script>
    <script src="/vendor/datatables/buttons.server-side.js"></script>
    {{-- {!! $dataTable->scripts() !!} --}}

    <script>
        $(document).ready(function() {
            load_data()

            $('#filter').click(function() {
                var from_date = $('#from_date').val();
                var to_date = $('#to_date').val();

                if (from_date != '' && to_date != '') {
                    $('#table-data').DataTable().destroy();
                    load_data(from_date, to_date);
                } else {
                    alert('Silahkan Pilih Tanggal')
                }
            });

            $('#refresh').click(function() {
                $('#from_date').val('');
                $('#to_date').val('');
                $('#table-data').DataTable().destroy();
                load_data();
            });

            function load_data(from_date = '', to_date = '') {
                var datatable = $('#table-data').DataTable({
                    processing: true,
                    serverSide: true,
                    ordering: true,
                    ajax: {
                        url: '{!! url()->current() !!}',
                        type: 'GET',
                    },
                    columns: [
                        {
                            data: 'created_at',
                            name: 'created_at'
                        },
                        {
                            data: 'kode_booking',
                            name: 'kode_booking'
                        },
                        {
                            data: 'nama_ketua_kelompok',
                            name: 'nama_ketua_kelompok'
                        },

                        {
                            data: 'tanggal_berangkat',
                            name: 'tanggal_berangkat'
                        },
                        {
                            data: 'tanggal_pulang',
                            name: 'tanggal_pulang'
                        },

                        {
                            data: 'status',
                            name: 'status',
                        },

                    ],


                });
            }


        });
    </script>
@endpush
