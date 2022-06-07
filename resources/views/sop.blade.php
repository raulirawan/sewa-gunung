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
    <h3>SOP</h3>
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
                   <h2>SOP
                   </h2>
                   <ul class="blog-info-link mt-3 mb-4">
                   </ul>
                   {!! App\SOP::first()->isi !!}

                </div>
             </div>


          </div>

       </div>
    </div>
 </section>
 <!--================ Blog Area end =================-->
@endsection
