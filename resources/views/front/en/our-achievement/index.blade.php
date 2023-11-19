@extends('front.en.layout.inner')
@section('page-content')
  <section class="hero-banner alt inner_banner" data-aos="fade-up" data-aos-delay="1000">
  {{--<img src="{{ asset('front/en/assets/images/our-achievements.jpg') }}" alt="">--}}
  @if (!empty($ourAchievementsHeading->achievement_banner_image))
        <img src="{{ asset('assets/images/'.$ourAchievementsHeading->achievement_banner_image.'') }}" alt="">
        @else
        <img src="{{ asset('/admin/upload/common/no-image-found.jpg') }}">
    @endif
    <div class="container">
      <div class="inner_banner_txt">
        <h2>{{$ourAchievementsHeading['our_achievement_heading_en']}}</h2>
      </div>
    </div>
  </section>

  <section class="about_content">
    <div class="container">
        <div class="row">
        <div class="col-lg-12">
                


    <div class="c-timeline-heading">
      <h2>Our Achievements</h2>
      @if (!empty($ourAchievementsHeading->ach_description_en))
      <p class="achiev-description">
      {{$ourAchievementsHeading['ach_description_en']}}
      </p>
      @endif
    </div>
<section class="c-timeline c-animated c-in-viewport">                        
        <div class="c-timeline_dynamic">
            <div class="c-timeline_slider__scale">
              <button class="c-timeline_slider__prev-slide" disabled>
                  <svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px"
                    y="0px" width="30px" height="30px" viewBox="0 0 960 560" enable-background="new 0 0 960 560"
                    xml:space="preserve">
                    <g>
                        <path d="M480,344.181L268.869,131.889c-15.756-15.859-41.3-15.859-57.054,0c-15.754,15.857-15.754,41.57,0,57.431l237.632,238.937
                          c8.395,8.451,19.562,12.254,30.553,11.698c10.993,0.556,22.159-3.247,30.555-11.698l237.631-238.937
                          c15.756-15.86,15.756-41.571,0-57.431s-41.299-15.859-57.051,0L480,344.181z"></path>
                    </g>
                  </svg>
              </button>
              <div id="slider" class="c-timeline_slider__scale_line">
                  <div class="c-timeline_slider__scale_pointer">
                    <img class="c-timeline_slider__scale_pointer__image"
                        src="{{ asset('front/en/assets/images/master-plan-timeline-button-pointer.svg') }}" alt="pointer" />
                  </div>
              </div>
              <button class="c-timeline_slider__next-slide">
                  <svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px"
                    y="0px" width="30px" height="30px" viewBox="0 0 960 560" enable-background="new 0 0 960 560"
                    xml:space="preserve">
                    <g>
                        <path d="M480,344.181L268.869,131.889c-15.756-15.859-41.3-15.859-57.054,0c-15.754,15.857-15.754,41.57,0,57.431l237.632,238.937
                          c8.395,8.451,19.562,12.254,30.553,11.698c10.993,0.556,22.159-3.247,30.555-11.698l237.631-238.937
                          c15.756-15.86,15.756-41.571,0-57.431s-41.299-15.859-57.051,0L480,344.181z"></path>
                    </g>
                  </svg>
              </button>
            </div>
            <div class="c-timeline_slider">
              <div class="c-timeline_slider__slides">
                <?php
                  foreach($ourAchievements as $data)
                  {
                    $year=  \Carbon::parse($data->year)->format('Y')  ;
                ?>
                  <div class="c-timeline_slider__slide animated">
                    <div class="c-timeline_slider__slide_date">
                        <span><?php echo  $year; ?></span>                    
                    </div>
                    <div class="c-timeline_slider__slide_text c-text">
                        <?php  
                          if(!empty($data->image)){
                        ?>
                        <div class="pic"><img src="{{ asset('/assets/ourachievement/'.$data->image) }}" alt=""></div>
                        <?php } else{ ?>
                        <div class="pic"><img src="{{ asset('/admin/upload/common/no-image-found.jpg') }}" alt=""></div> 
                        <?php } ?>
                        <div class="des">
                          <p><?php echo $data->description_en; ?></p>
                        </div>
                    </div>
                  </div>
                <?php } ?>    
                 

              </div>
            </div>
            <div class="c-timeline_slider__scale-horizontal">
              <button class="c-timeline_slider__prev-slide-left" disabled>
                  <svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px"
                    y="0px" width="30px" height="30px" viewBox="0 0 960 560" enable-background="new 0 0 960 560"
                    xml:space="preserve">
                    <g>
                        <path d="M480,344.181L268.869,131.889c-15.756-15.859-41.3-15.859-57.054,0c-15.754,15.857-15.754,41.57,0,57.431l237.632,238.937
                          c8.395,8.451,19.562,12.254,30.553,11.698c10.993,0.556,22.159-3.247,30.555-11.698l237.631-238.937
                          c15.756-15.86,15.756-41.571,0-57.431s-41.299-15.859-57.051,0L480,344.181z"></path>
                    </g>
                  </svg>
              </button>
              <div id="slider" class="c-timeline_slider__scale_line-horizontal">
                  <div class="c-timeline_slider__scale_pointer-horizontal">
                    <img class="c-timeline_slider__scale_pointer__image-horizontal"
                        src="{{ asset('front/en/assets/images/master-plan-timeline-button-pointer.svg') }}" alt="pointer" />
                  </div>
              </div>
              <button class="c-timeline_slider__next-slide-right">
                  <svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px"
                    y="0px" width="30px" height="30px" viewBox="0 0 960 560" enable-background="new 0 0 960 560"
                    xml:space="preserve">
                    <g>
                        <path d="M480,344.181L268.869,131.889c-15.756-15.859-41.3-15.859-57.054,0c-15.754,15.857-15.754,41.57,0,57.431l237.632,238.937
                          c8.395,8.451,19.562,12.254,30.553,11.698c10.993,0.556,22.159-3.247,30.555-11.698l237.631-238.937
                          c15.756-15.86,15.756-41.571,0-57.431s-41.299-15.859-57.051,0L480,344.181z"></path>
                    </g>
                  </svg>
              </button>
            </div>
        </div>
</section>
</div>
    </div>
</section>
  @endsection
