@extends('front.en.layout.inner')


@section('page-content')


{{-- <section class="hero-banner alt" data-aos="fade-up" data-aos-delay="1000">
    <div class="owl-carousel heroslide">
      <div class="item"> <img src="{{ asset('/admin/upload/project/banner/original') }}/{{ $projectDetail->banner }}">
        <div class="heroslide-txt">
          <div class="container">
            <div class="row align-items-center">
              <div class="col-12">
                <h1>{{$projectDetail->name}}</h1>
                <!-- <img src="{{ asset('/front/en') }}/assets/images/Banner-logo4.png" alt=""> -->
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section> --}}
  <section class="investor_banner desktopview" data-aos="fade-up" data-aos-delay="300">
    <img src="{{ asset('/admin/upload/project/banner/original') }}/{{ $projectDetail->banner }}">
    {{--<div class="container">
       <div class="inner_banner_txt">
        <img src="{{ asset('/admin/upload/project-logo/'.$projectDetail->project_logo.'') }}" alt="" >
       </div>
    </div>--}}
 </section>

 <section class="investor_banner mobileview" data-aos="fade-up" data-aos-delay="300">
    <img src="{{ asset('/admin/upload/project/mobile_banner_image') }}/{{ $projectDetail->mobile_banner_image }}">
    {{--<div class="container">
       <div class="inner_banner_txt">
        <img src="{{ asset('/admin/upload/project-logo/'.$projectDetail->project_logo.'') }}" alt="" >
       </div>
    </div>--}}
 </section>


  <section class="txt-block al-hakmiah_text--section section01">
    <div class="container">
      <h2 class="al-hakiam_title text-center">{{$projectDetail->slogan}}</h2>
    </div>
    <div class="txt-block-main al-hakmiah_text--block col-pd-0 style-2">
      <div class="container-fluid">
        <div class="row align-items-center">
          <div class="col-lg-6 aos-init aos-animate order-1">
            <div class="txt-block-right pd-0">
            <?php 
              if($projectDetail->content_video!='')
              {
                ?>
                <a href="{{ $projectDetail->content_video }}" class="html5lightbox"><img src="{{ asset('admin/upload/project/video_thumbnail_image/'.$projectDetail['video_thumbnail_image'].'') }}" alt="" class="width-100"></a>
                <?php
              }
              else
              {
                ?>
                <img src="{{ asset('admin/upload/project/video_thumbnail_image/'.$projectDetail['video_thumbnail_image'].'') }}" alt="" class="width-100">
                <?php
              }
              ?>
              {{--<a href="{{ $projectDetail->content_video }}" class="html5lightbox"><img src="{{ asset('admin/upload/project/video_thumbnail_image/'.$projectDetail['video_thumbnail_image'].'') }}" alt="" class="width-100"></a>--}}
              <!--{!!html_entity_decode($projectDetail->content_video)!!} -->
            </div>
          </div>
          <div class="col-lg-6 ">
            <div class="al-hakmiah_container">
              <div class="txt-block-left">
                <p>{!! $projectDetail->content !!}</p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>


  <section class="services alt section02">
    <div class="container">
      <h2  class="al-hakiam_title">General Location</h2>
    </div>
    <div class="container-fluid">
      <div class="row align-items-center col-pd-0">
        <div class="col-md-6 aos-init aos-animate">
          <div class="txt-block-right pd-0">
            <!-- <img src="assets/images/map.png" alt="" class="width-100"> -->
            {!!html_entity_decode($projectDetail->map)!!}
          </div>
        </div>
        @if($projectDetail->near_to!='')

        @php
            $nearto = explode(',',$projectDetail->near_to);
        @endphp
        <div class="col-md-6">
          <div class="al-hakmiah_container">
            <div class="txt-block-left">
              <h3 class="al-hakmiah_subtitle">Near To</h3>
              <div  class="section02-icon_block">
                <ul class="section02-icon_list">
                    @foreach($nearData as $nd)
                        @if (in_array($nd->id, $nearto))
                            <li data-aos="fade-up" data-aos-delay="300">
                                <img src="{{ asset('/admin/upload/project_near/thumbnail') }}/{{ $nd->near_image }}" alt="">
                                <h2>{{$nd->near_name}}</h2>
                            </li>
                        @endif
                    @endforeach
                  
                </ul>
              </div>
            </div>
          </div>
        </div>
        @endif
      </div>
    </div>
  </section>

  
@if($projectDetail->services!='')
@php
    $services = explode(',',$projectDetail->services);
@endphp
  <div class="project-heading project-features">
    <h2>{{$projectDetailsPageHeading->project_details_service_heading_en}}</h2>
  </div>
  <section class="section03 project-features">
    <div class="container">      
      <ul class="section03_list">
        @foreach($serviceData as $sd)
                        @if (in_array($sd->id, $services))
                            <li >
                                <img src="{{ asset('/admin/upload/project_services/thumbnail') }}/{{ $sd->service_image }}" alt="">
                                <h2>{{$sd->service_name}}</h2>
                            </li>
                        @endif
        @endforeach
        
      </ul>
    </div>
  </section>
@endif

@if(count($unitData)>0)
 <div class="project-heading">
    <h2>{{$projectDetailsPageHeading->project_details_unit_heading_en}}</h2>
  </div>
  <section class="section04">
    <div class="container">      
      <div class="section04_tab-block">
        <ul class="nav nav-pills al-hakiam_tabList" id="pills-tab" role="tablist">

            @php $cnt = 1; @endphp
            @foreach($unitData as $ud)
                 <li class="nav-item">
                    <a class="nav-link @if($cnt == 1) active @endif" id="pills-{{$ud->id}}-tab" data-toggle="pill" href="#pills-{{$ud->id}}" role="tab" aria-controls="pills-{{$ud->id}}" aria-selected="true">{{$ud->unit_name}}</a>
                 </li>
                @php $cnt++; @endphp
            @endforeach
        </ul>
        <div class="tab-content al-hakiam_tabContent" id="pills-tabContent">
                    @php $cnt = 1; @endphp
                    @foreach($unitData as $ud)

                        <div class="tab-pane fade @if($cnt == 1) show active @endif" id="pills-{{$ud->id}}" role="tabpanel" aria-labelledby="pills-{{$ud->id}}-tab">
                          <div class="row">
                            <div class="col-lg-8 col-md-7">
                              <div class="owl-carousel owl-theme al-hakiam_tabSlider">
                                <!-- <div class="item"><img src="assets/images/section04-slider_img.jpg"></div>
                                <div class="item"><img src="assets/images/section04-slider_img.jpg"></div> -->
                                @foreach($unitGalleryData as $unitGallery)
                                    @if($unitGallery->unit_id == $ud->id)
                                    <div class="item"><a href="{{ asset('/admin/upload/unit/gallery/original') }}/{{ $unitGallery->unit_image }}" class="html5lightbox" data-group="set2">
                                    <img src="{{ asset('/admin/upload/unit/gallery/original') }}/{{ $unitGallery->unit_image }}" alt=""></a></div>
                                    @endif
                                @endforeach
                            </div>
                            </div>
                            <div class="col-lg-4 col-md-5">
                                {{-- <div class="al-hakiam_tabSlider--title"> --}}
                                  <!-- <h2><span>3</span> bedroom <br> <span>265</span> bedrooms</h2> -->
                                {{-- </div> --}}
                                <div class="al-hakiam_tabSlider--content project-tab">
                                 <h3>{!! $ud->unit_subheading !!}</h3>
                                  <!-- <ul class="al-hakiam_tabSlider--content-list">
                                      <li>Unit components</li>
                                      <li>Unit components</li>
                                      <li>Unit components</li>
                                      <li>Unit components</li>
                                      <li>Unit components</li>
                                      <li>Unit components</li>
                                  </ul> -->
                                  <p>{!!($ud->unit_content)!!}</p>
                                </div>
                            </div>
                          </div>
                      </div>
                      @php $cnt++; @endphp
                  @endforeach
        
        </div>
      </div>
    </div>
  </section>
@endif

@if($projectDetail->virtual_toure_image != '')
  <section class="section05">
    <div class="project-heading">
      <h2>Virtual Tour</h2>
    </div>
    <div class="al-hakiam_circle-view">
      <div class="container">
        <div class="al-hakiam_circle-view-content text-center">
            <!-- <img src="assets/images/360.png" alt>
            <p>Unit components <span>360</span></p> -->
            {!!html_entity_decode($projectDetail->virtual_toure_image)!!}
        </div>
      </div>
    </div>
  </section>
@endif

@if(count($galleryData) > 0)
  <section class="section06 prop-img">
    <div class="al-hakiam_gallery-wrapper">
      <h2 class="text-center al-hakiam_title">The Gallery</h2>
    <div class="owl-carousel prop-slide">
        @foreach($galleryData as $gd)
            <div class="item">
                <div class="prop-slide-single"><a href="{{ asset('/admin/upload/project/gallery/original') }}/{{ $gd->gallery_image }}" class="html5lightbox" data-group="set1">
                <img src="{{ asset('/admin/upload/project/gallery/original') }}/{{ $gd->gallery_image }}" alt=""></a></div>
            </div>
        @endforeach
      
    </div>
    <div class="gallery-btns text-center">
 @if(!empty($projectDetail->brochure))
      <a class="site-link single-color" href="{{ asset('/admin/upload/project/brochure/english') }}/{{$projectDetail->brochure}}" target="_blank  n">Download the brochure</a>
@endif
 @if($projectDetail->reservation_en_chk !=0)
      <a class="site-link single-color" href="#">Online reservation</a>
@endif
    </div>
    </div>
  </section>
@endif
  <section class="section07 al-hakiam_formArea"  id="pcontact">
    <div class="container">
        <div class="row">
            <div class="col-lg-4 col-md-6">
                <div class="al-hakiam_formTitle">
                  <h2 class="text-right al-hakiam_title" >Contact Us</h2>
                </div>
            </div>
            <div class="col-lg-8 col-md-6">
              <form class="al-hakiam_form" action="{{route('projectcontact.savecontact')}}" method="POST">
                {{ csrf_field() }}
                <input type="hidden" name="slug" value="{{$slug}}">
                <input type="hidden" name="project_name" value="{{$projectDetail->name}}">
                <div class="form-group">
                  <input type="text" class="form-control" placeholder="Name" name="fullname">
                </div>
                <div class="form-group">
                  <input type="number" class="form-control" placeholder="Phone Number" name="phone">
                </div>
                <div class="form-group">
                  <input type="email" class="form-control" placeholder="Email" name="emailid">
                </div>
                <div class="al-hakiam_formSubmit text-left">
                  <button type="submit" class="btn btn-primary site-link single-color">Send</button>
                </div>

                @if(count($errors) > 0)
                                <div class="alert alert-danger alert-dismissable">
                                    <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
                                    @foreach ($errors->all() as $error)
                                        <span>{{ $error }}</span><br/>
                                    @endforeach
                                </div>
                            @endif

                            @if(Session::has('success'))
                                <div class="alert alert-success alert-dismissable __web-inspector-hide-shortcut__">
                                    <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
                                    {{ Session::get('success') }}
                                </div>
                            @endif

                            @if(Session::has('error'))
                                <div class="alert alert-danger alert-dismissable">
                                    <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
                                    {{ Session::get('error') }}
                                </div>
                            @endif

              </form>
            </div>
        </div>
    </div>
  </section>

  
@if(count($faqData) > 0)
  <section class="project-stat section08">
    <div class="container">
      <div class="al-hakiam-faq_block">
        <h2  class="text-right al-hakiam_title" data-aos="fade-up" data-aos-delay="300">Frequently Asked Questions</h2>
        <div class="al-hakiam-faq" data-aos="fade-up" data-aos-delay="500">
          <div class="faq" id="accordion">
            @php $count = 1; @endphp
            @foreach($faqData as $fd)
            <div class="card">
                <div class="card-header" id="faqHeading-@php echo $count; @endphp">
                    <div class="mb-0">
                        <h5 class="faq-title" data-toggle="collapse" data-target="#faqCollapse-@php echo $count; @endphp" data-aria-expanded="true" data-aria-controls="faqCollapse-@php echo $count; @endphp">
                            {{$fd->question_en}} <span class="faq-icon">+</span>
                        </h5>
                    </div>
                </div>
                <div id="faqCollapse-@php echo $count; @endphp" class="collapse" aria-labelledby="faqHeading-@php echo $count; @endphp" data-parent="#accordion">
                    <div class="card-body">                        
                        <p>{{$fd->answer_en}}</p>
                    </div>
                </div>
            </div>
             @php $count++; @endphp
            @endforeach
            
        </div>
        </div>
      </div>
    </div>
  </section>
@endif

@endsection
