@extends('front.ar.layout.inner')
@section('page-content')

  {{-- <section class="hero-banner">
    <div class="owl-carousel heroslide">
    @foreach($banners as $data)
        @if (!empty($data['banner']))
       <div class="item" style="background-image: url('{{ asset('/assets/cms/banner_images') }}/{{ $data['banner'] }}');">
        @else
            <div class="item" style="background-image: url('{{ asset('/front/ar') }}/assets/images/home-banner-1.jpg');">
        @endif

        <div class="heroslide-txt">
          <div class="container">
            <div class="row align-items-center">
              <div class="col-12">
                <h1>{{$data['title_ar']}}</h1>
              </div>
            </div>
          </div>
        </div>
      </div>
    @endforeach 
    </div>
  </section> --}}
  <section class="hero-banner">
    @if($banners[0]['type']=="image")
    <div class="owl-carousel heroslide">
      @foreach($banners as $data)
        <div class="item">
          <img src="{{ asset('/assets/cms/banner_images/'.$data['banner'])}}" alt="">
          <div class="heroslide-txt">
            <div class="container">
              <div class="row align-items-center">
                <div class="col-12">
                  <h1>{{$data['title_ar']}}</h1>
                </div>
              </div>
            </div>
          </div>
        </div>
      @endforeach
    </div>
  @elseif($banners[0]->type =="video" && $banners->count()== 1)
    <div class="">
      @foreach($banners as $data)
        <div class="item">
          <video autoplay loop muted playsinline class="video-background">
              <source src="{{ asset('/assets/cms/banner_images/'.$data['banner'])}}" type="video/mp4">
          </video>
          <div class="heroslide-txt">
            <div class="container">
              <div class="row align-items-center">
                <div class="col-12">
                  <h1>{{$data['title_ar']}}</h1>
                </div>
              </div>
            </div>
          </div>
        </div>
      @endforeach 
    </div>
  @endif
  <div id="scroll-down"></div>
</section>

@if($homePageSetting->count() > 0)
  <section class="welcome" id="welcome">
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-lg-8">
          <div class="welcome-main">
            <h2>{{$homePageSetting['title_ar']}}</h2>
            <p>{!! $homePageSetting['description_ar'] !!}</p>
          </div>
        </div>
      </div>
    </div>
  </section>
@endif

@if($homeProject->count() > 0)
   <section class="latest-project">
    <div class="container">
      <h2>{{$homePageSetting->feature_project_heading_ar}}</h2>
      <div class="row align-items-center">
        <div class="col-lg-6">
          <div class="latest-project-right">
            @if (!empty($homeProject['featured_image']))
                <img src="{{ asset('/admin/upload/project/featured_image/'.$homeProject->featured_image) }}" alt="">
            @else
                <img src="{{ asset('/admin/upload/common/no-image-found.jpg') }}" alt="">
            @endif
          </div>
        </div>
        <div class="col-lg-6">
          <div class="latest-project-left">
          <h3>{{$homeProject['name_ar']}}</h3>
          <p><p>{{$homeProject->short_description_ar}}</p></p>
          <a class="site-link" href="{{route('ar.projectdetail.detail',[$homeProject['slug_name']])}}">{{$homePageSetting->feature_project_button_text_ar}}</a>
          </div>
        </div>
      </div>
    </div>
  </section>
@endif

@if($homePageGallery->count() > 0)
  <section class="welcome alt">
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-lg-8">
          <div class="welcome-main">
            
            <h2>{{$homePageGallery['title_ar']}}</h2>
            <p>{{$homePageGallery['description_ar']}} </p>
           
          
          </div>
        </div>
      </div>
    </div>
  </section>
@endif

  <section class="prop-img">
    <div class="container-fluid">
      <div class="owl-carousel prop-slide">
      @foreach($homeGallery as $data)
        <div class="item">
          <div class="prop-slide-single">
            @if (!empty($data->image))
            <a href="{{ asset('/assets/cms/gallery') }}/{{ $data->image }}" class="html5lightbox" 
data-group="set1"><img src="{{ asset('/assets/cms/gallery') }}/{{ $data->image }}" alt=""></a>
                
            @else
                <img src="{{ asset('/admin/upload/common/no-image-found.jpg') }}" alt="">
            @endif

          </div>
        </div>
       @endforeach 

      </div>
    </div>
  </section>
@if(count($homeService) > 0)
  <section class="benefits">
    <div class="container">
      <h2><?php echo $socialLink[0]['service_title_ar'];?></h2>
      <div class="benefits-main">
        <div class="row">
        @foreach($homeService as $data)
          <div class="col-lg-4">
            <div class="benefits-single">
              <h3>{{$data['title_ar']}}</h3>
              <p>{!! ($data['short_description_ar']) !!}</p>
              <!-- <a class="site-link gradient" href="{{ url('/') }}/ar/service/#each-service-{{$data['title_ar']}}">اقرأ أكثر</a> -->
            </div>
          </div>
        @endforeach
        </div>
      </div>
    </div>
  </section>
@endif

  <section class="architecture alt">
    <div class="container">
    <h2><?php echo $socialLink[0]['latest_news_title_ar'];?></h2>
    </div>
  </section>
@if(count($homeNews) > 0)
 <section class="text-sec news-txt">
    <div class="container">
      <div class="row">
        <div class="col-lg-12">
          <div class="news-slide">  
            <div class="owl-carousel owl-theme" id="newsslider">
                @foreach($homeNews as $data)
                <div class="box">
                  <div class="title"><h2>{{$data['title_ar']}}</h2></div>
                  <div class="pic"><img src="{{ asset('/assets/images') }}/{{ $data->slider_1 }}" alt=""></div> 
                  <div class="txt">                   
                  <p> {!! ($data->short_description_ar) !!}</p>
                  <a class="site-link gradient" href="{{ url('/') }}/ar/news-details/{{ $data['slug_name'] }}">اقرأ أكثر</a>
                  </div>
                </div>
                @endforeach
            </div>
          </div>
       
        </div>
      </div>
    </div>
  </section>
@endif
  <section class="architecture sec">
    <div class="container">
      <h2><?php echo $socialLink[0]['achievement_title_ar'];?></h2>
    </div>
  </section>


  @if(count($homeNewSliders) > 0)
  <section class="sec-archive">
    <div class="container">
      <div class="owl-carousel archive-slide">

        @foreach($homeNewSliders as $data)
        <div class="item">
          <div class="item-row">
            
            @php
              $year=  \Carbon::parse($data->year)->format('Y')  ;
              $explodedData = str_split($year);
                                 $indexZero = $explodedData[0];
                                 $indexOne=  $explodedData[1];
                                 $indexTwo=  $explodedData[2];
                                 $indexThree=  $explodedData[3];
            @endphp
            <div class="archive-slide-date">
              <!--  @if (!empty($data->slider_2))
                   <img src="{{ asset('/assets/images') }}/{{ $data->slider_2 }}" alt="">
               @else
                   <img src="{{ asset('/admin/upload/common/no-image-found.jpg') }}" alt="">
               @endif -->
               <span class="date-each">{{$indexZero.$indexOne}}</span>
               <span class="date-each">{{$indexTwo.$indexThree }}</span>
             </div>
              <div class="archive-slide-pic">
     
                @if (!empty($data->image))
                    <img src="{{ asset('/assets/ourachievement/'.$data->image) }}" alt="">
                @else
                    <img src="{{ asset('/admin/upload/common/no-image-found.jpg') }}" alt="">
                @endif
              </div>
              <div class="archive-slide-txt">
                <p>{!!($data->description_ar)!!}</p>
              </div>
           

          </div>
        </div>
        @endforeach

      </div>
    </div>
  </section>
@endif


@endsection

