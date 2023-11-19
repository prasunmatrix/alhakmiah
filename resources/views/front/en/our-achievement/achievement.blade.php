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

  <section class="achievements-wrapper">
    <div class="container">
      <div class="row">
          <div class="col-lg-12">
              <h2>Our Achievements</h2>
              @if (!empty($ourAchievementsHeading->ach_description_en))
              <p class="achiev-description">{{$ourAchievementsHeading['ach_description_en']}}</p>
              @endif
                <?php
                  foreach($ourAchievements as $data)
                  {
                    $year=  \Carbon::parse($data->year)->format('Y')  ;
                ?>
                <div class="achievements-row">
                  <div class="year" data-aos="fade-up">
                      <h3><?php echo  $year; ?></h3>
                      <!-- <h4>أول اتحاد ملاك</h4> -->
                      <p><?php echo $data->description_en; ?></p>
                  </div>
                  <div class="thum" data-aos="fade-up">
                    <?php  
                      if(!empty($data->image)){
                    ?>
                      <div class="pic"><img src="{{ asset('/assets/ourachievement/'.$data->image) }}" alt=""></div>
                      <?php } else{ ?>
                      <div class="pic"><img src="{{ asset('/admin/upload/common/no-image-found.jpg') }}" alt=""></div>
                      <?php } ?>    
                  </div>
                </div>
              <?php } ?>          
                <!-- <div class="achievements-row">
                  <div class="year" data-aos="fade-up">
                      <h3>2008</h3>
                      <h4>أول مجمع سكني للتمليك</h4>
                      <p> في المنطقة الشرقية وأول مشروع موصوف بالذمة في المملكة العربية السعودية  </p>
                  </div>
                  <div class="thum" data-aos="fade-up">
                      <div class="pic"><img src="assets/images/achievements-pic-2.jpg" alt=""></div>
                  </div>
                </div>

                <div class="achievements-row">
                  <div class="year" data-aos="fade-up">
                      <h3>2010</h3>
                      <h4>أول صندوق عقاري مغلق  </h4>
                      <p>  للأبراج السكنية في المنطقة الشرقيةمرخص من هيئة سوق المال السعودي </p>
                  </div>
                  <div class="thum" data-aos="fade-up">
                      <div class="pic"><img src="assets/images/achievements-pic-3.jpg" alt=""></div>
                  </div>
                </div>

                <div class="achievements-row">
                  <div class="year" data-aos="fade-up">
                      <h3>2012</h3>
                      <h4>إطلاق مشروع الدروازة </h4>
                      
                  </div>
                  <div class="thum" data-aos="fade-up">
                      <div class="pic"><img src="assets/images/achievements-pic-4.jpg" alt=""></div>
                  </div>
                </div>

                <div class="achievements-row">
                  <div class="year" data-aos="fade-up">
                      <h3>2014</h3>
                      <h4>إطلاق مشروع مريف </h4>
                    
                  </div>
                  <div class="thum" data-aos="fade-up">
                      <div class="pic"><img src="assets/images/achievements-pic-5.jpg" alt=""></div>
                  </div>
                </div>

                <div class="achievements-row">
                  <div class="year" data-aos="fade-up">
                      <h3>2015</h3>
                      <h4>مشروع مريف يحصل على أفضل مشروع عقاري </h4>
                      <p> في المنطقة الشرقية  </p>
                  </div>
                  <div class="thum" data-aos="fade-up">
                      <div class="pic"><img src="assets/images/achievements-pic-6.jpg" alt=""></div>
                  </div>
                </div>

                <div class="achievements-row">
                  <div class="year" data-aos="fade-up">
                      <h3>2016</h3>
                      <h4>إطلاق مشروع أبراج </h4>
                      <p> أورسيات السكنية </p>
                  </div>
                  <div class="thum" data-aos="fade-up">
                      <div class="pic"><img src="assets/images/achievements-pic-7.jpg" alt=""></div>
                  </div>
                </div>

                <div class="achievements-row">
                  <div class="year" data-aos="fade-up">
                      <h3>2017</h3>
                      <h4>مشروع الواجهة السكني أول مشروع بالشراكة  </h4>
                      <p> مع وزارة الإسكان على أرض القطاع الخاص 
                        بالمملكة العربية السعودية   </p>
                  </div>
                  <div class="thum" data-aos="fade-up">
                      <div class="pic"><img src="assets/images/achievements-pic-8.jpg" alt=""></div>
                  </div>
                </div>

                <div class="achievements-row">
                  <div class="year" data-aos="fade-up">
                      <h3>2018</h3>
                      <h4>أول وحدة سكنية تُسلّم  لمواطن</h4>
                      <p> في برنامج سكني التابع لوزارة الإسكان </p>
                  </div>
                  <div class="thum" data-aos="fade-up">
                      <div class="pic"><img src="assets/images/achievements-pic-9.jpg" alt=""></div>
                  </div>
                </div>

                <div class="achievements-row">
                  <div class="year" data-aos="fade-up">
                      <h3>2019</h3>
                      <h4>أول وحدة سكنية تم بناؤها خلال 48 ساعة </h4>
                      <p>في المملكة العربية السعودية  </p>
                  </div>
                  <div class="thum" data-aos="fade-up">
                      <div class="pic"><img src="assets/images/achievements-pic-10.jpg" alt=""></div>
                  </div>
                </div> -->
          </div>
      </div>
    </div>
  </section>
  
  @endsection
