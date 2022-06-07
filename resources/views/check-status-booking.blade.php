@extends('layouts.frontend')

@section('title', 'Gunung Slamet')

@section('content')
    <!-- bradcam_area_start -->
    <div class="bradcam_area breadcam_bg">
        <h3>Halaman Cek Status Booking</h3>
    </div>
    <!-- bradcam_area_end -->

    <!-- about_area_start -->
    <div class="container mt-5 mb-5">
        <h2 class="text-center">Booking Status</h2>
        <div class="row mt-5">
            <div class="col-xl-8 align-self-center">
                {{-- <form action=""> --}}
                <div class="row mb-4">
                    <div class="col-xl-6" style="font-weight: bold">
                        Status
                    </div>
                    <div class="col-xl-6 text-white">
                        @if ($transaction->status == 'disetujui')
                            <span class="badge bg-success">Di Setujui</span>
                        @elseif($transaction->status == 'pending')
                        <span class="badge bg-warning">Pending</span>
                        @elseif($transaction->status == 'naik')
                        <span class="badge bg-success">Naik</span>
                        @elseif($transaction->status == 'turun')
                        <span class="badge bg-danger">Pendakian Selesai</span>
                        @else
                        <span class="badge bg-danger">Di Batalkan</span>
                        @endif
                    </div>
                </div>
                <div class="row mb-4">
                    <div class="col-xl-6" style="font-weight: bold">
                        Kode Booking
                    </div>
                    <div class="col-xl-6">
                        {{ $transaction->kode_booking }}
                    </div>
                </div>
                <div class="row mb-4">
                    <div class="col-xl-6" style="font-weight: bold">
                        Nama Ketua Kelompok
                    </div>
                    <div class="col-xl-6">
                        {{ $transaction->ketuaKelompok->nama_ketua_kelompok }}
                    </div>
                </div>


                <div class="row mb-4">
                    <div class="col-xl-6" style="font-weight: bold">
                        Tanggal Berangkat
                    </div>
                    <div class="col-xl-6">
                        {{ $transaction->tanggal_berangkat }}
                    </div>
                </div>
                <div class="row mb-4">
                    <div class="col-xl-6" style="font-weight: bold">
                        Tanggal Pulang
                    </div>
                    <div class="col-xl-6">
                        {{ $transaction->tanggal_pulang }}
                    </div>
                </div>

                <div class="row mb-4">
                    <div class="col-xl-6" style="font-weight: bold">
                        Jumlah Pengunjung
                    </div>
                    <div class="col-xl-6">
                        {{ $jumlah_anggota}} Orang
                    </div>
                </div>

                <div class="row mb-4">
                    <div class="col-xl-6" style="font-weight: bold">
                        Total Harga
                    </div>
                    <div class="col-xl-6">
                        Rp{{ number_format($transaction->total_harga) }}
                    </div>
                </div>

            </div>
            <div class="col-xl-4 align-self-center">
                <div class="text-center">
                    {!! QrCode::size(200)->generate($transaction->kode_booking) !!} <br>
                <span style="font-size: 20px; font-weight: bold">
                    {{ $transaction->site->nama_site }}
                </span>
                </div>
            </div>
        </div>
    </div>

@endsection
