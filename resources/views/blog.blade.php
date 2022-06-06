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
    </style>
    @endpush
  <div class="bradcam_area breadcam_bg">
    <h3>{{ $blog->nama_blog }}</h3>
    </div>
<!-- bradcam_area_end -->
   <!--================Blog Area =================-->
   <section class="blog_area single-post-area section-padding">
    <div class="container">
       <div class="row">
          <div class="col-lg-12 posts-list">
             <div class="single-post">
                <div class="feature-img">
                   <img class="img-fluid" style="margin: auto" src="{{ asset($blog->gambar) }}" alt="">
                </div>
                <div class="blog_details">
                   <h2>{{ $blog->nama_blog }}
                   </h2>
                   <ul class="blog-info-link mt-3 mb-4">
                      <li><a href="#"><i class="fa fa-user"></i> Admin</a></li>
                   </ul>
                   {!! $blog->isi !!}
                </div>
             </div>


          </div>

       </div>
    </div>
 </section>
 <!--================ Blog Area end =================-->
@endsection
