@extends('front.ar.layout.inner')
@section('page-content')

  
<section class="investor_banner" data-aos="fade-up" data-aos-delay="300">
    <img src="{{ asset('assets/cms/banner_blog/'.$blogBanner->banner.'')}}" alt="">
    <div class="container">
       <div class="inner_banner_txt">
        <h2 data-aos="fade-up" data-aos-delay="300">{{$pageTite->blog_ar}} </h2>
       </div>
    </div>
 </section>


 <section class="news-tab">
   <div class="container">     
     <div class="section04_tab-block">
       <!-- <ul class="nav nav-pills al-hakiam_tabList" id="pills-tab" role="tablist">
         <li class="nav-item">
           <a class="nav-link active" id="pills-home-tab" data-toggle="pill" href="#pills-home" role="tab" aria-controls="pills-home" aria-selected="true">{{--$mediatab->news_ar--}}</a>
         </li>
         <li class="nav-item">
           <a class="nav-link" id="pills-profile-tab" data-toggle="pill" href="#pills-profile" role="tab" aria-controls="pills-profile" aria-selected="false">{{--$mediatab->tv_channel_ar--}}</a>
         </li>
         <li class="nav-item">
           <a class="nav-link" id="pills-contact-tab" data-toggle="pill" href="#pills-contact" role="tab" aria-controls="pills-contact" aria-selected="false">{{--$mediatab->press_kit_ar--}}</a>
         </li>
         {{-- <li class="nav-item">
           <a class="nav-link" id="pills-fourth-tab" data-toggle="pill" href="#pills-fourth" role="tab" aria-controls="pills-fourth" aria-selected="false">Lorem D</a>
         </li> --}}
       </ul> -->
       <div class="tab-content al-hakiam_tabContent" id="pills-tabContent">
         <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
            <section class="news-wrapper">
               @foreach($blog as $blog)
               <div class="news-list">
                  <div class="pic">
                     <img src="{{ asset('assets/blog-images/small-image/'.$blog->blog_small_image.'')}}" alt="" style="width:338px;height:338px">
                  </div>
                  <div class="txt">
                     <a  href="{{ url('/') }}/blog-details/{{ $blog['slug_name'] }}"><h2>{{ $blog->title_ar }}</h2></a>
                     <p class="date">{{\Carbon::parse($blog->blog_date)->format('d-m-Y')  }}</p>
                     <p>{!! $blog->short_description_ar !!}</p>
                     <a href="{{ url('/') }}/blog-details/{{ $blog['slug_name'] }}" class="read-more">اقرأ أكثر</a> 
                  </div>            
               </div>
               @endforeach
            </section>
         </div>
       </div>

     </div>
    
   </div>
 </section>
 <!-- {{-- <section class="news-wrapper">
    @foreach($news as $news)
    <div class="news-list" data-aos="fade-up" data-aos-delay="300">
       <div class="pic">
          <img src="{{ asset('assets/images/'.$news->slider_1.'')}}" alt="">
       </div>
       <div class="txt">
          <h2>{{ $news->title_ar }}</h2>
          <p class="date">{{\Carbon::parse($news->created_at)->format('d-m-Y')  }}</p>
          <p>{{ $news->description_ar }}</p>
          <a href="{{ url('/') }}/ar/news-details/{{ $news['slug_name'] }}" class="read-more">لمعرفة المزيد</a>
       </div>            
    </div>
    @endforeach
 </section> --}} -->

@endsection

