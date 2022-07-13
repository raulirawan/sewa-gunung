@extends('layouts.frontend')

@section('title', 'Gunung Slamet')

@section('content')
<style>
.lds-dual-ring {
    display: inline-block;
    width: 40px;
    height: 40px;
  }
  .lds-dual-ring:after {
    content: " ";
    display: block;
    width: 40px;
    height: 40px;
    margin: 8px;
    border-radius: 50%;
    border: 6px solid #fff;
    border-color: #fff transparent #fff transparent;
    animation: lds-dual-ring 1.2s linear infinite;
  }
  @keyframes lds-dual-ring {
    0% {
      transform: rotate(0deg);
    }
    100% {
      transform: rotate(360deg);
    }
  }


</style>
    <!-- bradcam_area_start -->
    <div class="bradcam_area breadcam_bg">
        <h3>Halaman Booking Gunung Slamet</h3>
    </div>
    <!-- bradcam_area_end -->

    <!-- about_area_start -->
    <div class="container mt-5 mb-5">
        <h2 class="text-center">Form Booking</h2>
        <div class="row mt-5">
            <div class="col-xl-12">
                {{-- <form action=""> --}}
                <div class="row mb-4">
                    <div class="col-xl-6">
                        <label for="">Tanggal Kunjungan</label>
                        <input type="date"  class="form-control tanggal_kunjungan" placeholder="Tanggal Kunjungan" disabled
                            value="{{ date("Y-m-d", strtotime($tanggal) ) }}">
                    </div>
                    <div class="col-xl-6">
                        <label for="">Tanggal Pulang</label>
                        <input type="date" class="form-control tanggal_pulang" placeholder="Tanggal Pulang"
                            value="{{ date("Y-m-d", strtotime($tanggal) ) }}">
                    </div>
                </div>

                <div class="row">
                    <input type="hidden" id="initHarga" value="{{ $harga }}">
                    <input type="hidden" id="site_id" value="{{ $site_id }}">
                    <div class="col-12">
                        <h3>Data Ketua Kelompok</h3>
                    </div>
                    <div class="col-xl-6">
                        <div class="form-group">
                            <label for="">Nama Ketua Kelompok</label>
                            <input class="form-control" name="nama_ketua_kelompok" id="nama_ketua_kelompok" type="text"
                                placeholder="Nama Ketua Kelompok">
                        </div>
                    </div>
                    <div class="col-xl-6">
                        <div class="form-group">
                            <label for="">Tanggal Lahir</label>
                            <input type="date" class="form-control" name="tanggal_lahir" id="tanggal_lahir_ketua" placeholder="Tanggal Lahir">
                        </div>
                    </div>
                    <div class="col-xl-6">
                        <div class="form-group">
                            <label for="">Jenis Kelamin</label>
                            <select name="jenis_kelamin" class="form-select wide mb-3" id="jenis_kelamin_ketua">
                                <option value="">Jenis Kelamin</option>
                                <option value="L">Laki - Laki</option>
                                <option value="P">Perempuan</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-xl-6">
                        <div class="form-group">
                            <label for="">Jenis Identitas</label>
                            <select name="jenis_identitas" class="form-select wide mb-3" id="jenis_identitas_ketua">
                                <option value="">Jenis Identitas</option>
                                <option value="KTP">KTP</option>
                                <option value="SIM">SIM</option>
                                <option value="KTM">KTM</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-xl-6">
                        <div class="form-group">
                            <label for="">Nomor Kartu Identitas</label>
                            <input type="number" class="form-control" id="nomor_kartu_identitas_ketua" name="nomor_kartu_identitas"
                                placeholder="Nomor Kartu Identitas">
                        </div>
                    </div>
                    <div class="col-xl-6">
                        <div class="form-group">
                            <label for="">Email</label>
                            <input type="email" class="form-control" name="email" id="email_ketua" placeholder="Email">
                        </div>
                    </div>
                    <div class="col-xl-12">
                        <div class="form-group">
                            <label for="">ALamat Rumah</label>
                            <textarea name="alamat_rumah" id="alamat_rumah_ketua" class="form-control" placeholder="Alamat Rumah"></textarea>
                        </div>
                    </div>
                    <div class="col-xl-6">
                        <div class="form-group">
                            <label for="">Provinsi</label>
                            <input type="text" class="form-control" id="provinsi" name="provinsi" placeholder="Provinsi">
                        </div>
                    </div>
                    <div class="col-xl-6">
                        <div class="form-group">
                            <label for="">Kota</label>
                            <input type="text" class="form-control" id="kota" name="kota" placeholder="Kota">
                        </div>
                    </div>
                    <div class="col-xl-6">
                        <div class="form-group">
                            <label for="">Kecamatan</label>
                            <input type="text" class="form-control" id="kecamatan" name="kecamatan" placeholder="Kecamatan">
                        </div>
                    </div>
                    <div class="col-xl-6">
                        <div class="form-group">
                            <label for="">Kelurahan</label>
                            <input type="text" class="form-control" id="kelurahan" name="kelurahan" placeholder="Kelurahan">
                        </div>
                    </div>
                    <div class="col-xl-12">
                        <div class="form-group">
                            <label for="">Nomor Telepon</label>
                            <input type="number" class="form-control" id="nomor_telepon_ketua" name="nomor_telepon" placeholder="Nomor Telepon">
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-12">
                        <h3>Data Anggota</h3>
                        <table class="table" id="data_anggota">
                            <thead class="thead-dark">
                                <tr>
                                    <th scope="col">Nama Anggota</th>
                                    <th scope="col">Tanggal Lahir</th>
                                    <th scope="col">Jenis Kelamin</th>
                                    <th scope="col">Jenis Identitas</th>
                                    <th scope="col">Nomor Kartu</th>
                                    <th scope="col">Alamat</th>
                                    <th scope="col">Nomor Telepon</th>
                                    <th scope="col">Aksi</th>
                                </tr>
                            </thead>
                            <tbody id="anggota_body">
                                {{-- <tr>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                </tr> --}}
                            </tbody>
                        </table>
                    </div>
                    <div class="col-12 text-center">
                        <a href="#test-form" class="btn btn-info popup-with-form">Tambah Anggota</a>
                    </div>
                </div>


                <div class="row mt-5">
                    <div class="col-12">
                        <h3>Konfirmasi Booking</h3>

                    </div>
                    <div class="col-xl-6">
                        <table class="table">
                            <thead class="thead-dark">
                                <tr>
                                    <th scope="col">Jenis</th>
                                    <th scope="col">Tarif / Hari</th>
                                </tr>
                            </thead>
                            <tbody>
                                <td>WISATAWAN</td>
                                <td>Rp{{ number_format($harga) }}</td>
                            </tbody>
                        </table>
                    </div>
                    <div class="col-xl-6">
                        <p>Rincian Booking Online Anda terdiri dari : <br><small class="text-danger">Termasuk Anggota Kelompok</small></p>
                        <h5><span id="orang">1</span> Orang x <span id="harga">Rp.50.000</span> x <span id="hari">3</span> Hari</h5>

                        <div class="date"><span id="tanggal_kunjungan"></span> S/d <span id="tanggal_pulang"></span></div>

                        <div class="total mt-5">
                            Total Yang Harus Di Bayarkan :
                            <h3 id="total"></h3>
                        </div>
                        <button class="btn btn-info mt-4 btn-block" id="btn_booking_sekarang" onclick="return('Yakin ?')">
                                <div class="lds-dual-ring mb-2 d-none" id="progress"></div>
                                <span id="text-booking" class="py-3">
                                Booking Sekarang
                                </span>
                        </button>

                    </div>
                </div>


                {{-- </form> --}}
            </div>
        </div>
    </div>

    {{-- popup --}}
    <form id="test-form" class="white-popup-block mfp-hide">
        <div class="popup_box ">
                <div class="popup_inner">
                    <h3>Tambah Anggota</h3>
                    {{-- <form action="#"> --}}
                        <div class="row">
                            <div class="col-xl-12">
                                <label for="" class="float-left">Nama Anggota</label>
                                <div class="form-group">
                                    <input class="form-control" id="nama_anggota" type="text"
                                        placeholder="Nama Anggota" required>
                                </div>
                            </div>
                            <div class="col-xl-12">
                                <label for="" class="float-left">Tanggal Lahir</label>
                                <div class="form-group">
                                    <input type="date" class="form-control" id="tanggal_lahir" placeholder="Tanggal Lahir" required>
                                </div>
                            </div>
                            <div class="col-xl-12">
                                <label for="" class="float-left">Jenis Identitas</label>
                                <div class="form-group">
                                    <select name="jenis_identitas" class="form-select wide mb-3" id="jenis_identitas">
                                        <option value="">Jenis Identitas</option>
                                        <option value="KTP">KTP</option>
                                        <option value="SIM">SIM</option>
                                        <option value="KTM">KTM</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-xl-12">
                                <label for=""class="float-left">Nomor Kartu Identitas</label>
                                <div class="form-group">
                                    <input type="number" class="form-control" id="nomor_kartu"
                                        placeholder="Nomor Kartu Identitas">
                                </div>
                            </div>

                            <div class="col-xl-12">
                                <label for="" class="float-left">Jenis Kelamin</label>
                                <div class="form-group">
                                    <select class="form-select wide mb-3" id="jenis_kelamin" required>
                                        <option value="">Jenis Kelamin</option>
                                        <option value="L">Laki - Laki</option>
                                        <option value="P">Perempuan</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-xl-12">
                                <label for="" class="float-left">Alamat Rumah</label>
                                <div class="form-group">
                                    <textarea id="alamat_rumah" class="form-control" placeholder="Alamat Rumah" required></textarea>
                                </div>
                            </div>
                            <div class="col-xl-12">
                                <label for="" class="float-left">Nomor Telepon</label>
                                <div class="form-group">
                                    <input type="number" class="form-control" id="nomor_telepon" placeholder="Nomor Telepon" required>
                                </div>
                            </div>
                            <div class="col-xl-12">
                                <a  class="boxed-btn3" id="tambah_anggota">Tambah Anggota</a>
                            </div>
                        </div>
                    {{-- </form> --}}
                </div>
            </div>
    </form>

    <form id="edit-form" class="white-popup-block mfp-hide">
        <div class="popup_box ">
                <div class="popup_inner">
                    <h3>Edit Anggota</h3>
                    {{-- <form action="#"> --}}
                        <div class="row">
                            <div class="col-xl-12">
                                <label for="" class="float-left">Nama Anggota</label>
                                <div class="form-group">
                                    <input class="form-control" id="nama_anggota" type="text"
                                        placeholder="Nama Anggota" required>
                                </div>
                            </div>
                            <div class="col-xl-12">
                                <label for="" class="float-left">Tanggal Lahir</label>
                                <div class="form-group">
                                    <input type="date" class="form-control" id="tanggal_lahir" placeholder="Tanggal Lahir" required>
                                </div>
                            </div>
                            <div class="col-xl-12">
                                <label for="" class="float-left">Jenis Kelamin</label>
                                <div class="form-group">
                                    <select class="form-select wide mb-3" id="jenis_kelamin" required>
                                        <option value="">Jenis Kelamin</option>
                                        <option value="L">Laki - Laki</option>
                                        <option value="P">Perempuan</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-xl-12">
                                <label for="" class="float-left">Jenis Identitas</label>
                                <div class="form-group">
                                    <select name="jenis_identitas" class="form-select wide mb-3" id="jenis_identitas">
                                        <option value="">Jenis Identitas</option>
                                        <option value="KTP">KTP</option>
                                        <option value="SIM">SIM</option>
                                        <option value="KTM">KTM</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-xl-12">
                                <label for=""class="float-left">Nomor Kartu Identitas</label>
                                <div class="form-group">
                                    <input type="number" class="form-control" id="nomor_kartu"
                                        placeholder="Nomor Kartu Identitas">
                                </div>
                            </div>
                            <div class="col-xl-12">
                                <label for="" class="float-left">Alamat Rumah</label>
                                <div class="form-group">
                                    <textarea id="alamat_rumah" class="form-control" placeholder="Alamat Rumah" required></textarea>
                                </div>
                            </div>
                            <div class="col-xl-12">
                                <label for="" class="float-left">Nomor Telepon</label>
                                <div class="form-group">
                                    <input type="number" class="form-control" id="nomor_telepon" placeholder="Nomor Telepon" required>
                                </div>
                            </div>
                            <div class="col-xl-12">
                                <a  class="boxed-btn3 btn-update" id="update_anggota">Update Anggota</a>
                            </div>
                        </div>
                    {{-- </form> --}}
                </div>
            </div>
    </form>


    @push('down-script')
        <script>
            $(document).ready(function () {


                var harga = parseInt($("#initHarga").val());
                var orang = parseInt($("#orang").text());

                $("#harga").text(harga);

                var start = new Date($('.tanggal_kunjungan').val());
                var end = new Date($('.tanggal_pulang').val());
                var diff = Math.round((end- start)/(1000*60*60*24));
                const dateFormatter = Intl.DateTimeFormat('sv-SE');

                var tanggal_kunjungan = dateFormatter.format(start);
                var tanggal_pulang = dateFormatter.format(end);
                if(start.getTime() === end.getTime()) {
                    var different = 1;
                } else {
                    var different = diff;
                }

                $("#hari").text(different);
                $("#tanggal_kunjungan").text(tanggal_kunjungan);
                $("#tanggal_pulang").text(tanggal_pulang);


                var total = harga * orang * different;
                $("#total").text(total);

                $('.tanggal_pulang').change(function() {
                    var harga = parseInt($("#initHarga").val());
                    var orang = parseInt($("#orang").text());
                    var start = new Date($('.tanggal_kunjungan').val());
                    var end = new Date($('.tanggal_pulang').val());
                    var diff = Math.round((end- start)/(1000*60*60*24));
                    const dateFormatter = Intl.DateTimeFormat('sv-SE');

                    var tanggal_kunjungan = dateFormatter.format(start);
                    var tanggal_pulang = dateFormatter.format(end);
                    if(start.getTime() === end.getTime()) {
                        var different = 1;
                    } else {
                        var different = diff;
                    }

                    $("#hari").text(different);
                    $("#tanggal_kunjungan").text(tanggal_kunjungan);
                    $("#tanggal_pulang").text(tanggal_pulang);


                    var total = harga * orang * different;
                    $("#total").text(total);

                });



            });
            $(document).on('click', '#booking', function(e) {
                e.preventDefault();
                var rows = $("tbody tr", $("#data_anggota")).map(function() {
                    return [$("td", this).map(function() {
                        return this.innerHTML;
                    }).get()];
                }).get();


                $.ajax({
                    type: "POST",
                    url: '{!! route('booking.form.post') !!}',
                    data: {
                        rows,
                        _token: $('meta[name="csrf-token"]').attr('content'),
                    },
                    // success: function (response) {

                    // }
                });
            });

            $(document).on('click', '#tambah_anggota', function() {
                var nama_anggota = $("#nama_anggota").val();
                var tanggal_lahir = $("#tanggal_lahir").val();
                var jenis_kelamin = $("#jenis_kelamin").val();
                var alamat_rumah = $("#alamat_rumah").val();
                var nomor_telepon = $("#nomor_telepon").val();
                var jenis_identitas = $("#jenis_identitas").val();
                var nomor_kartu = $("#nomor_kartu").val();

                if(nama_anggota.length == 0){
                    alert('Nama Tidak Boleh Kosong');
                    return false;
                }

                if(tanggal_lahir.length == 0){
                    alert('Tanggal Tidak Boleh Kosong');
                    return false;
                }
                if(jenis_kelamin.length == 0){
                    alert('Jenis Kelamin Tidak Boleh Kosong');
                    return false;
                }
                if(alamat_rumah.length == 0){
                    alert('Alamat Rumah Tidak Boleh Kosong');
                    return false;
                }
                if(nomor_telepon.length == 0){
                    alert('Telepon Tidak Boleh Kosong');
                    return false;
                }

                if(jenis_identitas.length == 0){
                    alert('Telepon Tidak Boleh Kosong');
                    return false;
                }

                if(nomor_kartu.length == 0){
                    alert('Telepon Tidak Boleh Kosong');
                    return false;
                }




                var tr = '<tr id="tr"> <td>'+nama_anggota+'</td> <td>'+tanggal_lahir+'</td> <td>'+jenis_kelamin+'</td> <td>'+jenis_identitas+'</td> <td>'+nomor_kartu+'</td> <td>'+alamat_rumah+'</td> <td>'+nomor_telepon+'</td> <td><a href="#edit-form" class="btn btn-info btn-sm btn-edit popup-with-form">Edit</a> <a class="btn btn-sm btn-danger btn-delete" style="color:#fff !important;">Delete</a></td></tr>'

                $('#anggota_body').append(tr);


                var initOrang = parseInt($("#orang").text());

                $("#orang").text(initOrang+1);

                $("#nama_anggota").val('');
                $("#tanggal_lahir").val('');
                $("#jenis_kelamin").val('');
                $("#alamat_rumah").val('');
                $("#nomor_telepon").val('');

                var harga = parseInt($("#initHarga").val());
                var orang = parseInt($("#orang").text());

                var start = new Date($('.tanggal_kunjungan').val());
                var end = new Date($('.tanggal_pulang').val());
                var diff = Math.round((end- start)/(1000*60*60*24));
                const dateFormatter = Intl.DateTimeFormat('sv-SE');

                var tanggal_kunjungan = dateFormatter.format(start);
                var tanggal_pulang = dateFormatter.format(end);
                if(start.getTime() === end.getTime()) {
                    var different = 1;
                } else {
                    var different = diff;
                }

                $("#hari").text(different);
                $("#tanggal_kunjungan").text(tanggal_kunjungan);
                $("#tanggal_pulang").text(tanggal_pulang);


                var total = harga * orang * different;
                $("#total").text(total);

            });
            var trEdit = null;
            $(document).on('click', '.btn-edit', function() {
                trEdit = $(this).closest('#tr');
                var nama_anggota = $(trEdit).find('td:eq(0)').text();
                var tanggal_lahir = $(trEdit).find('td:eq(1)').text();
                var jenis_kelamin = $(trEdit).find('td:eq(2)').text();
                var jenis_identitas = $(trEdit).find('td:eq(3)').text();
                var nomor_kartu = $(trEdit).find('td:eq(4)').text();
                var alamat_rumah = $(trEdit).find('td:eq(5)').text();
                var nomor_telepon = $(trEdit).find('td:eq(6)').text();


                $("#nama_anggota").val(nama_anggota);
                $("#tanggal_lahir").val(tanggal_lahir);
                $("#jenis_kelamin").val(jenis_kelamin);
                $("#jenis_identitas").val(jenis_identitas);
                $("#nomor_kartu").val(nomor_kartu);
                $("#alamat_rumah").val(alamat_rumah);
                $("#nomor_telepon").val(nomor_telepon);
            });

            $(document).on('click', '.btn-update', function() {
                if(trEdit){
                    var nama_anggota = $("#nama_anggota").val();
                    var tanggal_lahir = $("#tanggal_lahir").val();
                    var jenis_kelamin = $("#jenis_kelamin").val();
                    var jenis_identitas = $("#jenis_identitas").val();
                    var nomor_kartu = $("#nomor_kartu").val();
                    var alamat_rumah = $("#alamat_rumah").val();
                    var nomor_telepon = $("#nomor_telepon").val();

                    if(nama_anggota.length == 0){
                    alert('Nama Tidak Boleh Kosong');
                    return false;
                    }

                    if(tanggal_lahir.length == 0){
                        alert('Tanggal Tidak Boleh Kosong');
                        return false;
                    }
                    if(jenis_kelamin.length == 0){
                        alert('Jenis Kelamin Tidak Boleh Kosong');
                        return false;
                    }
                    if(alamat_rumah.length == 0){
                        alert('Alamat Rumah Tidak Boleh Kosong');
                        return false;
                    }
                    if(nomor_telepon.length == 0){
                        alert('Telepon Tidak Boleh Kosong');
                        return false;
                    }

                    if(jenis_identitas.length == 0){
                        alert('Jenis Identitas Tidak Boleh Kosong');
                        return false;
                    }
                      if(nomor_kartu.length == 0){
                        alert('Nomor Kartu Tidak Boleh Kosong');
                        return false;
                    }
                    $(trEdit).find('td:eq(0)').text(nama_anggota);
                    $(trEdit).find('td:eq(1)').text(tanggal_lahir);
                    $(trEdit).find('td:eq(2)').text(jenis_kelamin);
                    $(trEdit).find('td:eq(3)').text(jenis_identitas);
                    $(trEdit).find('td:eq(4)').text(nomor_kartu);
                    $(trEdit).find('td:eq(5)').text(alamat_rumah);
                    $(trEdit).find('td:eq(6)').text(nomor_telepon);
                    alert('Berhasil Update');
                    trEdit = null;
                }


            });

            $(document).on('click', '.btn-delete', function() {
                if(confirm("Yakin Ingin Di Hapus ?")) {
                    $(this).closest('#tr').remove();
                    var initOrang = parseInt($("#orang").text());

                    $("#orang").text(initOrang-1);
                    var harga = parseInt($("#initHarga").val());
                    var orang = parseInt($("#orang").text());
                    var start = new Date($('.tanggal_kunjungan').val());
                    var end = new Date($('.tanggal_pulang').val());
                    var diff = Math.round((end- start)/(1000*60*60*24));
                    const dateFormatter = Intl.DateTimeFormat('sv-SE');

                    var tanggal_kunjungan = dateFormatter.format(start);
                    var tanggal_pulang = dateFormatter.format(end);
                    if(start.getTime() === end.getTime()) {
                        var different = 1;
                    } else {
                        var different = diff;
                    }

                    $("#hari").text(different);
                    $("#tanggal_kunjungan").text(tanggal_kunjungan);
                    $("#tanggal_pulang").text(tanggal_pulang);

                    var total = harga * orang * different;
                    $("#total").text(total);
                }

            });

            $('#btn_booking_sekarang').click(function(e) {
                if(confirm("Buat Transaksi?")) {

                    var harga = parseInt($("#initHarga").val());
                    var site_id = $("#site_id").val();
                    var orang = parseInt($("#orang").text());
                    var start = new Date($('.tanggal_kunjungan').val());
                    var end = new Date($('.tanggal_pulang').val());
                    var diff = Math.round((end- start)/(1000*60*60*24));
                    const dateFormatter = Intl.DateTimeFormat('sv-SE');

                    // ketua kelompok
                    var nama_ketua = $("#nama_ketua_kelompok").val();
                    var tanggal_lahir_ketua = $("#tanggal_lahir_ketua").val();
                    var jenis_kelamin_ketua = $("#jenis_kelamin_ketua").val();
                    var jenis_identitas_ketua = $("#jenis_identitas_ketua").val();
                    var nomor_kartu_identitas_ketua = $("#nomor_kartu_identitas_ketua").val();
                    var email_ketua = $("#email_ketua").val();
                    var alamat_rumah_ketua = $("#alamat_rumah_ketua").val();
                    var provinsi = $("#provinsi").val();
                    var kota = $("#kota").val();
                    var kecamatan = $("#kecamatan").val();
                    var kelurahan = $("#kelurahan").val();
                    var nomor_telepon_ketua = $("#nomor_telepon_ketua").val();
                    if(nama_ketua.length == 0){
                        alert('Nama Ketua Kelompok Tidak Boleh Kosong');
                        return false;
                    }

                    if(tanggal_lahir_ketua.length == 0){
                        alert('Tanggal Lahir Ketua Kelompok Tidak Boleh Kosong');
                        return false;
                    }
                    if(jenis_kelamin_ketua.length == 0){
                        alert('Jenis Kelamin Ketua Kelompok Tidak Boleh Kosong');
                        return false;
                    }
                    if(jenis_identitas_ketua.length == 0){
                        alert('Jenis Identitas Ketua Kelompok Tidak Boleh Kosong');
                        return false;
                    }
                    if(nomor_kartu_identitas_ketua.length == 0){
                        alert('Nomor Kartu Indentitas Ketua Kelompok Tidak Boleh Kosong');
                        return false;
                    }

                    if(email_ketua.length == 0){
                        alert('Email Ketua Kelompok Tidak Boleh Kosong');
                        return false;
                    }

                    if(email_ketua.length == 0){
                        alert('Email Ketua Kelompok Tidak Boleh Kosong');
                        return false;
                    }
                    if(alamat_rumah_ketua.length == 0){
                        alert('Alamat Rumah Ketua Kelompok Tidak Boleh Kosong');
                        return false;
                    }
                    if(provinsi.length == 0){
                        alert('Provinsi Ketua Kelompok Tidak Boleh Kosong');
                        return false;
                    }
                    if(kota.length == 0){
                        alert('Kota Ketua Kelompok Tidak Boleh Kosong');
                        return false;
                    }
                    if(kecamatan.length == 0){
                        alert('Kecamatan Ketua Kelompok Tidak Boleh Kosong');
                        return false;
                    }
                    if(kelurahan.length == 0){
                        alert('Kelurahan Ketua Kelompok Tidak Boleh Kosong');
                        return false;
                    }
                    if(nomor_telepon_ketua.length == 0){
                        alert('Nomor Telepon Ketua Kelompok Tidak Boleh Kosong');
                        return false;
                    }

                    var data_anggota_kelompok = $("tbody tr", $("#data_anggota")).map(function() {
                        return [$("td", this).map(function() {
                            return this.innerHTML;
                        }).get()];
                    }).get();

                    var tanggal_kunjungan = dateFormatter.format(start);
                    var tanggal_pulang = dateFormatter.format(end);
                    if(start.getTime() === end.getTime()) {
                        var different = 1;
                    } else {
                        var different = diff;
                    }

                    var total_harga = $("#total").text();

                    e.preventDefault();

                    $("#text-booking").addClass('d-none');
                    $("#progress").removeClass('d-none');
                    $.ajax({
                        type: "POST",
                        url: '{!! route('booking.form.post') !!}',
                        data: {
                            data_anggota_kelompok,
                            orang,
                            site_id,
                            tanggal_kunjungan,
                            tanggal_pulang,
                            total_harga,
                            nama_ketua,
                            tanggal_lahir_ketua,
                            jenis_kelamin_ketua,
                            jenis_identitas_ketua,
                            nomor_kartu_identitas_ketua,
                            email_ketua,
                            alamat_rumah_ketua,
                            provinsi,
                            kota,
                            kecamatan,
                            kelurahan,
                            nomor_telepon_ketua,
                            _token: $('meta[name="csrf-token"]').attr('content'),
                        },
                        success: function (result, textStatus, jqXHR) {
                            $("#text-booking").removeClass('d-none');
                            $("#progress").addClass('d-none');
                            if(result.status == 'success') {
                                alert(result.message);
                                window.location.replace(result.url);
                            } else {
                                alert(result.message);
                                window.location.replace(result.url);
                            }
                        }
                    });
                }

            });

        </script>
    @endpush
@endsection
