@extends('layouts.frontend')

@section('title', 'Gunung Slamet')

@section('content')
  <!-- bradcam_area_start -->
    @push('down-style')
    <style>
        .feature-img img {
            width: 80%;
            height: auto;
            margin: auto;
            display: block;
            background-size:20%;
        }
        .single-post img {
            width: 100%;
        }
        ol {
    counter-reset: section;
    list-style-type: none;
}
.single-post li:before {
    counter-increment: section;
    content: counters(section, ".") ". ";
}

.single-post li li:before {
    counter-increment: section;
    content: counters(section, ".") " ";
}

.single-post ol ol ol {
    counter-reset: list;
    margin: 0;
}

.single-post ol ol ol > li {
    list-style: none;
    position: relative;
}

.single-post ol ol ol > li:before {
    counter-increment: list;
    content: "(" counter(list, lower-alpha) ") ";
    position: absolute;
    left: -1.4em;
}
        </style>
    @endpush
  <div class="bradcam_area breadcam_bg">
    <h3>Tata Cara Pembayaran</h3>
    </div>
<!-- bradcam_area_end -->
   <!--================Blog Area =================-->
   <section class="blog_area single-post-area section-padding">
    <div class="container">
       <div class="row">
          <div class="col-lg-12 posts-list">
             <div class="single-post">
                {{-- <div class="feature-img">
                   <img class="img-fluid" style="margin: auto" src="{{ asset($blog->gambar) }}" alt="">
                </div> --}}
                <div class="blog_details">
                   <h2>Tata Cara Pembayaran
                   </h2>
                   <ul class="blog-info-link mt-3 mb-4">
                   </ul>
                   {{-- <ol type="1">
                        <li>Buka browser dengan alamat url&nbsp;<a href="https://booking-slamet.my.id/">https://booking-slamet.my.id</a></li>
                        <li><img src="https://snipboard.io/UCzkN4.jpg" alt="" /></li>
                    </ol> --}}
                    <ol type="1">
                        <li>Buka browser dengan alamat url <a href="https://booking-gunungslamet.my.id/">https://booking-gunungslamet.my.id</a></li><br>
                             <img src="https://snipboard.io/UCzkN4.jpg" style="width: 90%; margin-bottom: 40px;">

                                     <hr>

                         <li>Memilih Rute Yang Ingin Di Tuju</li><br>
                             <img src="https://snipboard.io/eC5DtR.jpg" style="width: 90%; margin-bottom: 40px;"><br>
                                     <hr>
                         <li>Melengkapi Data Ketua Kelompok</li><br>
                             <img src="https://snipboard.io/O5ZbJC.jpg" style="width: 90%; margin-bottom: 40px;"><br>
                                     <hr>
                         <li>Lengkapi Data Jumlah Anggota </li><br>
                             <img src="https://snipboard.io/eIROnb.jpg" style="width: 90%; margin-bottom: 40px;"><br>
                                     <hr>
                         <li>Melakukan Pembayaran Menggunakan BCA, BNI, BRI, Permata Virtual Account, GOPAY,</li><br>
                          <img src="https://snipboard.io/osdmwc.jpg" style="width: 90%; margin-bottom: 40px;"><br>
                                     <hr>
                          <li>Setelah Pembayaran Berhasil Akan Mendapatkan Email Berupa QR Code Ticket,</li><br>
                                <img src="https://snipboard.io/SbAyzp.jpg" style="width: 90%; margin-bottom: 40px;"><br>
                                        <hr>

                        <li>Selesai Silahkan Tunjukan Email Kepada Petugas Pada Saat proses Check In Ke dalam Gunung Slamet</li><br>
                            <img src="https://snipboard.io/qcPb4K.jpg" style="width: 90%; margin-bottom: 40px;"><br>






                     </ol>
                </div>
             </div>


          </div>

       </div>
    </div>
 </section>
 <!--================ Blog Area end =================-->
@endsection
