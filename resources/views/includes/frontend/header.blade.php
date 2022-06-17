<header>
    <div class="header-area ">
        <div id="sticky-header" class="main-header-area">
            <div class="container-fluid p-0">
                <div class="row align-items-center no-gutters">
                    <div class="col-xl-5 col-lg-6">
                        <div class="main-menu  d-none d-lg-block">
                            <nav>
                                <ul id="navigation">
                                    <li><a class="active" href="{{ route('home') }}">Home</a></li>
                                    <li><a href="#">Rute <i class="ti-angle-down"></i></a>
                                        <ul class="submenu">
                                           @foreach (App\Site::all() as $site)
                                           <li><a href="{{ route('rute.detail', $site->slug) }}">{{ $site->nama_site }}</a></li>
                                           @endforeach
                                        </ul>
                                    </li>
                                    <li><a href="{{ route('sop.index') }}">SOP</a></li>

                                    <li><a href="{{ route('tata.pembayaran.index') }}">Cara Pembayaran</a></li>
                                    <li><a href="{{ route('booking.kuota') }}" class="d-block d-sm-none">Booking Sekarang</a></li>
                                    <li><a class="popup-with-form d-block d-sm-none" href="#test-form">Cek Status Booking</a></li>
                                </ul>
                            </nav>
                        </div>
                    </div>
                    <div class="col-xl-2 col-lg-2">
                        <div class="logo-img">
                            <a href="index.html">
                                <img src="{{ asset('assets/gunung-slamet.png') }}" style="width: 70px" alt="">
                            </a>
                        </div>
                    </div>
                    <div class="col-xl-5 col-lg-4 d-none d-lg-block">
                        <div class="book_room">
                            {{-- <div class="socail_links">
                                <ul>
                                    <li>
                                        <a href="#">
                                            <i class="fa fa-facebook-square"></i>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            <i class="fa fa-twitter"></i>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            <i class="fa fa-instagram"></i>
                                        </a>
                                    </li>
                                </ul>
                            </div> --}}
                            <div class="book_btn d-none d-lg-block">
                            </div>
                            <div class="book_btn d-none d-lg-block">
                                <a href="{{ route('booking.kuota') }}" class="btn-primary">Booking Sekarang</a>
                                <a class="popup-with-form" href="#test-form">Cek Status Booking</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="mobile_menu d-block d-lg-none"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>
<!-- header-end -->
