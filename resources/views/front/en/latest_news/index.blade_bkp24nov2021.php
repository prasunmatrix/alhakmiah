@extends('front.en.layout.inner')
@section('page-content')

  <section class="investor_banner" data-aos="fade-up" data-aos-delay="300">
    <img src="{{ asset('assets/cms/banner_images/'.$newsBanner->banner.'')}}" alt="">
    <div class="container">
       <div class="inner_banner_txt">
          <h2 >{{$pageTite->media_center_en}}</h2>
       </div>
    </div>
 </section>

 <section class="news-tab">
   <div class="container">
     <h2 data-aos="fade-up" data-aos-delay="300" class="al-hakiam_title text-center"></h2>
     <div class="section04_tab-block">
       <ul class="nav nav-pills al-hakiam_tabList" id="pills-tab" role="tablist">
         <li class="nav-item">
           <a class="nav-link active" id="pills-home-tab" data-toggle="pill" href="#pills-home" role="tab" aria-controls="pills-home" aria-selected="true">{{$mediatab->news_en}}</a>
         </li>
         <li class="nav-item">
           <a class="nav-link" id="pills-profile-tab" data-toggle="pill" href="#pills-profile" role="tab" aria-controls="pills-profile" aria-selected="false">{{$mediatab->tv_channel_en}}</a>
         </li>
         <li class="nav-item">
           <a class="nav-link" id="pills-contact-tab" data-toggle="pill" href="#pills-contact" role="tab" aria-controls="pills-contact" aria-selected="false">{{$mediatab->press_kit_en}}</a>
         </li>
         {{-- <li class="nav-item">
           <a class="nav-link" id="pills-fourth-tab" data-toggle="pill" href="#pills-fourth" role="tab" aria-controls="pills-fourth" aria-selected="false">Lorem D</a>
         </li> --}}
       </ul>
       <div class="tab-content al-hakiam_tabContent" id="pills-tabContent">
         <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
            <section class="news-wrapper">
               @foreach($news as $news)
               <div class="news-list">
                  <div class="pic">
                     <img src="{{ asset('assets/images/'.$news->slider_1.'')}}" alt="">
                  </div>
                  <div class="txt">
                     <a  href="{{ url('/') }}/news-details/{{ $news['slug_name'] }}"><h2>{{ $news->title_en }}</h2></a>
                     <p class="date">{{\Carbon::parse($news->news_date)->format('d-m-Y')  }}</p>
                     <p>{!! $news->short_description_en !!}</p>
                     <a href="{{ url('/') }}/news-details/{{ $news['slug_name'] }}" class="read-more">Read More</a> 
                  </div>            
               </div>
               @endforeach
            </section>
         </div>
         <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
            <section class="news-wrapper">
               @foreach($mediaNews as $mediaNews)
               <div class="news-list">
                  <div class="pic">
                     <a href="{{$mediaNews->video_link}}" class="html5lightbox">
                        <img src="{{ asset('/admin/upload/media_center') }}/{{$mediaNews->video_thumbnail_image}}" alt="" class="width-100"></a>
                     {{-- <img src="{{ asset('assets/images/'.$news->slider_1.'')}}" alt=""> --}}
                  </div>
                  <div class="txt">
                     <h2>{{ $mediaNews->title_en }}</h2>
                     <p class="date">{{$mediaNews->interviews_date}}</p>
                     <p>{{ $mediaNews->description_en }}</p>
                     {{-- <a href="{{ url('/') }}/news-details/{{ $news['slug_name'] }}" class="read-more">Read More</a> --}}
                  </div>            
               </div>
               @endforeach
            </section>
         </div>
         <div class="tab-pane fade" id="pills-contact" role="tabpanel" aria-labelledby="pills-contact-tab">
            <div class="investor_icon_sec" data-aos="fade-up" data-aos-delay="900">
            <h2 class="press-kit-heading">{{$mediatab->press_kit_heading_en}}</h2>
               <div class="container">
                 <div class="row">
                  <div class="col-lg-12">
                    <div class="mediaslider-outer">
                    <div class="owl-carousel owl-theme" id="mediaslider">
                      @foreach($pressKits as $pressKit)
                       <div class="box">
                         <img src="{{ asset('assets/press-kit-images/'.$pressKit->press_image) }}" alt=""><br>
                         <div>{{ $pressKit->format_en }}</div>
                         <a href="{{ asset('assets/press-kit-images/'.$pressKit->press_image) }}" class="investor_btn" target="_blank  n" download>Download</a>
                       </div>
                       @endforeach
                    </div>
                    </div>
                  </div>
                 </div>
               </div>
             </div>
             <div class="row">
               <div class="col-lg-12">
                 <div class="guideline">
                   <h2>Brand Guidelines  </h2>
                   <div class="row box-list">
                   @foreach ($brandGuidelines as $brandGuideline)
                         <div class="col-lg-3">
                            <div class="pic"><img src="{{ asset('assets/brand_guideline_images/'.$brandGuideline->thumbnail_image.'') }}" alt=""></div>
                            <a href="{{ asset('assets/brand-guidelines-pdf/'.$brandGuideline->pdf_upload) }}" class="btn-downlaod" target="_blank  n" download>Download</a>
                         </div>
                         {{--<div class="col-lg-3">
                            <div class="pic"><img src="{{ asset('/front/en/assets/images/mp3_thambnail_img.jpg')}}" alt=""></div>
                            <a href="{{ asset('assets/media_mp3_upload/'.$brandGuideline->media.'') }}" class="btn-downlaod" target="_blank  n" download>Download</a>
                         </div>--}}
                     @endforeach
                   </div>
                 </div>
               </div>
              </div>
         </div>
        
       </div>
     </div>
     
   </div>
 </section>
 

 {{-- <section class="news-wrapper">
    @foreach($news as $news)
    <div class="news-list">
       <div class="pic">
          <img src="{{ asset('assets/images/'.$news->slider_1.'')}}" alt="">
       </div>
       <div class="txt">
          <h2>{{ $news->title_en }}</h2>
          <p class="date">{{\Carbon::parse($news->created_at)->format('d-m-Y')  }}</p>
          <p>{{ $news->description_en }}</p>
          <a href="{{ url('/') }}/news-details/{{ $news['slug_name'] }}" class="read-more">Read More</a>
       </div>            
    </div>
    @endforeach
 </section> --}}
@endsection