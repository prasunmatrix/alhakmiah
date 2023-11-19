@extends('front.ar.layout.inner')
@section('page-content')


  {{-- <section class="investor_banner" data-aos="fade-up" data-aos-delay="300">
   @if (!empty($newsBanner->banner))
     <img src="{{ asset('assets/cms/banner_images') }}/{{ $newsBanner->banner }}" alt="" >
   
    @else
     <img src="{{ asset('/admin/upload/common/no-image-found.jpg') }}" alt=""  >
    @endif
    <div class="container">
      <div class="inner_banner_txt">
        <h2 data-aos="fade-up" data-aos-delay="300">{{$news['title_ar']}}</h2>
      </div>
    </div>
  </section>

  <section class="news-details" data-aos="fade-up" data-aos-delay="300">
    <div class="container">
        <div class="row">
          <div class="col-lg-4">
            <div class="pic">
              <img src="{{ asset('/assets/images') }}/{{ $news['slider_1'] }}" alt="" >
            </div>
          </div>
          <div class="col-lg-8">
            <h2>{{$news['title_ar']}}</h2>
            <p class="date">{{\Carbon::parse($news->created_at)->format('d-m-Y')  }}</p>
            {!!html_entity_decode($news['description_ar'])!!}
          </div>
        </div>      
    </div>
    
  </section> --}}

  <section class="news-wrapper-details">
    <div class="news-content">
       <h2>{{$blog['title_ar']}}</h2>
       <div class="pic">
          @if (!empty($blog->blog_big_image))
          <img src="{{ asset('/assets/blog-images/big-image/') }}/{{ $blog['blog_big_image'] }}" alt="" style="width:640px;height:480px" >
        
          @else
          <img src="{{ asset('/admin/upload/common/no-image-found.jpg') }}" alt=""  >
          @endif
       </div>
       <div class="txt"> 
         {!! $blog['description_ar'] !!}
       </div>            
    </div>         
 </section>
@endsection