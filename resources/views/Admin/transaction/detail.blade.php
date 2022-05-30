@extends('layouts.dashboard-admin')

@section('title','Halaman Detail Transaksi')

@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Detail Transaksi</h1>
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

            <div class="card">
                <div class="card-header">
                  <h3 class="card-title">Detail Transaksi</h3>
                  <a href="{{ route('admin.transaksi.index') }}" class="btn btn-primary mt-3 btn-xs" style="float: right">Kembali</a>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                  <table class="table table-bordered">

                    <tbody>
                        <tr>
                            <th style="width: 400px">Tanggal Transaksi</th>
                            <td>{{ $transaction->created_at }}</td>
                        </tr>
                        <tr>
                            <th style="width: 400px">Kode Booking</th>
                            <td>{{ $transaction->kode_booking }}</td>
                        </tr>
                        <tr>
                            <th style="width: 400px">Site Tujuan</th>
                            <td>{{ $transaction->site->nama_site }}</td>
                        </tr>
                        <tr>
                            <th style="width: 400px">Nama Ketua Kelompok </th>
                            <td>{{ $transaction->ketuaKelompok->nama_ketua_kelompok }}</td>
                        </tr>
                        <tr>
                            <th style="width: 400px">Tanggal Berangkat</th>
                            <td>{{ $transaction->tanggal_berangkat }}</td>
                        </tr>
                        <tr>
                            <th style="width: 400px">Tanggal Pulang</th>
                            <td>{{ $transaction->tanggal_pulang }}</td>
                        </tr>
                        <tr>
                            <th style="width: 400px">Status</th>
                            @if ($transaction->status == 'disetujui')
                            <td>
                                <span class="badge badge-success">DISETUJUI</span>
                            </td>
                            @elseif ($transaction->status == 'pending')
                            <td>
                                <span class="badge badge-warning">PENDING</span>
                            </td>
                            @else
                            <td>
                                <span class="badge badge-danger">DIBATALKAN</span>
                            </td>

                            @endif
                        </tr>
                        <tr>
                            <th style="width: 400px">Total Harga</th>
                            <td>Rp{{ number_format($transaction->total_harga) }}</td>
                        </tr>

                    </tbody>
                  </table>

                </div>

              </div>

              <div class="card">
                <div class="card-header">
                    <h3 class="card-title">List Anggota Kelompok</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body table-responsive">

                    <table id="table-data"
                        class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Nama Anggota</th>
                                <th>Tanggal Lahir</th>
                                <th>Jenis Kelamin</th>
                                <th>Alamat Rumah</th>
                                <th>Nomor Telepon</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $anggota = json_decode($transaction->anggota_kelompok)
                            @endphp
                            @foreach ($anggota as $val)
                                <tr>
                                    <td>{{ $val->nama_anggota}}</td>
                                    <td>{{ $val->tanggal_lahir }}</td>
                                    <td>
                                        {{ $val->jenis_kelamin == 'L' ? 'Laki - Laki' : 'Perempuan' }}
                                    </td>
                                    <td>{{ $val->alamat_rumah }}</td>
                                    <td>{{ $val->nomor_telepon }}</td>
                                </tr>
                            @endforeach

                        </tbody>
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
