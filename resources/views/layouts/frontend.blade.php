<!doctype html>
<html class="no-js" lang="zxx">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>@yield('title')</title>
    <meta name="description" content="">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('assets/gunung-slamet.png') }}">

    <!-- CSS here -->
    @include('includes.frontend.style')
</head>

<body>

    @include('includes.frontend.header')

    @yield('content')

    @include('includes.frontend.footer')

    <!-- link that opens popup -->

    <!-- form itself end-->
    <form id="test-form" class="white-popup-block mfp-hide" action="{{ route('cek.status.booking') }}" method="GET" enctype="multipart/form-data">
        <div class="popup_box ">
            <div class="popup_inner">
                <h3>Cek Status Booking Anda</h3>
                <form >
                    <div class="row">
                        <div class="col-xl-12 mb-4">
                            <input type="text" name="kode_booking" id="kode_booking" class="form-control" placeholder="Masukan Kode Booking">
                        </div>
                        <div class="col-xl-12">
                            <button type="submit" class="boxed-btn3">Cek Status</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </form>
    <!-- form itself end -->
    @stack('up-script')
    @include('includes.frontend.script')
    @stack('down-script')
    <script>
        $('#datepicker').datepicker({
            iconsLibrary: 'fontawesome',
            icons: {
                rightIcon: '<span class="fa fa-caret-down"></span>'
            }
        });
        $('#datepicker2').datepicker({
            iconsLibrary: 'fontawesome',
            icons: {
                rightIcon: '<span class="fa fa-caret-down"></span>'
            }

        });
    </script>



</body>

</html>
