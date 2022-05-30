@extends('layouts.frontend')

@section('title', 'Gunung Slamet')

@section('content')
    <!-- bradcam_area_start -->
    <div class="bradcam_area breadcam_bg">
        <h3>Halaman Booking Gunung Slamet</h3>
    </div>
    <!-- bradcam_area_end -->

    <!-- about_area_start -->
    <div class="container mt-5 mb-5">
        <div class="row">
            <div class="col-xl-12">
                <form id="form-kuota" action="{{ route('booking.kuota') }}" method="post">
                    @csrf
                    <div class="row">
                        <div class="col-xl-6 mb-4">
                            <select class="form-select wide" id="bulan_tahun" name="bulan_tahun">
                                @foreach ($periods as $period)
                                <option value="{{ $period->month }}-{{ $period->year }}" {{ $period->month == $bulan && $period->year == $tahun ? 'selected' : '' }}>{{ $period->month_name }}, {{ $period->year }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-xl-6">
                            <select class="form-select wide" id="site_id" name="site_id">
                                @foreach ($sites as $site)
                                <option value="{{ $site->id }}" {{ $site->id == $site_id ? 'selected' : '' }}>{{ $site->nama_site }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <div class="row mt-5">
            <div class="col-xl-12">
                <h3>Site : {{ $kuotaGunung->first()->site->nama_site ?? '(Tidak Ada Data Tersedia) ' }}</h3>
                <table class="table">
                    <thead class="thead-dark">
                      <tr>
                        <th>Tanggal Kunjungan</th>
                        <th>Kuota Tersedia</th>
                      </tr>
                    </thead>
                    <tbody>

                        @forelse ($kuotaGunung as $val)
                            <tr>
                                <td>{{ $val->tanggal }}</td>
                                <td>
                                    <a href="{{ route('booking.form', [$val->site_id, $val->tanggal]) }}" class="text-success text-bold">{{ $val->kuota }}</a>
                                </td>
                          </tr>
                        @empty
                        <tr>
                            <td colspan="2" class="text-center">Tidak Ada Data Tersedia</td>
                        </tr>
                        @endforelse
                    </tbody>
                  </table>
            </div>
        </div>
    </div>



    @push('down-script')
    <script>
        (function(){
            $('[name="bulan_tahun"], [name="site_id"]').change(function() {
                $('#form-kuota').submit();
            });
        })();


    </script>
        {{-- <script>
            $('#tes').click(function(e) {
                e.preventDefault();
                var rows = $("tbody tr", $("#mytable")).map(function() {
                    return [$("td", this).map(function() {
                        return this.innerHTML;
                    }).get()];
                }).get();


                $.ajax({
                    type: "POST",
                    url: '{!! route('booking.tes') !!}',
                    data: {
                        rows,
                        _token: $('meta[name="csrf-token"]').attr('content'),
                    },
                    // success: function (response) {

                    // }
                });
            });
        </script> --}}
    @endpush
@endsection
