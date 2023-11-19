<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0, shrink-to-fit=no">
    <link rel="shortcut icon" href="{{ asset('/front/ar') }}/assets/images/favicon.png">
    <title>الحاكمية - رائدة صناعة التطوير العقاري في المملكة</title>
    <link rel="stylesheet" href="{{ asset('/front/ar') }}/assets/css/aos.css">
    <link rel="stylesheet" href="{{ asset('/front/ar') }}/assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{ asset('/front/ar') }}/assets/css/font-awesome.min.css">
    <link rel="stylesheet" href="{{ asset('/front/ar') }}/assets/css/owl.carousel.min.css">
    
    <link rel="stylesheet" href="{{ asset('/front/ar') }}/assets/css/custom.css">
    <script src="https://unpkg.com/aos@next/dist/aos.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.7/jquery.fancybox.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.7/jquery.fancybox.css" rel="stylesheet"/>
  </head>

  @php 
  $projectDetails = \App\Models\Project::where('status','1')->orderBy('display_order','asc')->get();
  $headerDetails = \App\Models\Social::first();
  $getSocial = \App\Models\Social::find('1');
  @endphp

  <body>
  <!--<a href="tel:{{ $getSocial->phone }}" class="sticky-callus-btn">Call Us</a>-->
    <?php 
     $ourStory               = \App\Models\Cms::where('slug_name','our-story')->first();
     $lifeWellLived          = \App\Models\Cms::where('slug_name','a-life-well-lived')->first();
     $ceoMessage             = \App\Models\Cms::where('slug_name','ceo-message')->first();
     $ourAchievement         = \App\Models\Cms::where('slug_name','our-achievements')->first();
     $socialResponsibility   = \App\Models\Cms::where('slug_name','social-responsiblities')->first();

     $allCms   = \App\Models\Cms::whereNull('deleted_at')->where('status','A')->where('displayabout','1')->orderBy('display_order', 'ASC')->get();
     $slugArr=[];
      $currentUrl=\Request::url();
      $currentSlugArr=explode('/', $currentUrl);
      $currentSlug=$currentSlugArr[count($currentSlugArr)-1];
     foreach($allCms as $value)
     {
        $slugArr[]=$value->slug_name;
     }
     $ourAchievementTitle   = \App\Models\PageTitle::whereNull('deleted_at')->first(); 
     //echo "<pre>"; print_r($ourAchievementTitle);echo "</pre>";
     //echo "<pre>"; print_r($slugArr);
     //echo "<pre>"; print_r($allCms);echo "</pre>";
     $allCmsInvestor   = \App\Models\Cms::whereNull('deleted_at')->where('status','A')->where('displayunderinvestor','1')->orderBy('display_order', 'ASC')->get();
    ?>

    <section class="header">
      <div class="container" data-aos="fade-up">
        <div class="row align-items-center">
          <div class="col-lg-2">
            <div class="logo">
              <a href="{{ url('/') }}/ar/home"><img src="{{ asset('assets/images/'.$headerDetails->header_logo.'') }}" alt=""></a>
              <div class="mobClick">
                <span></span>
                <span></span>
                <span></span>
              </div>
            </div>
          </div>
          <div class="col-lg-10">
            <div class="site-lang">
              <ul>
                <li><a href="{{ url('/') }}/{{$switch_link}}">{{$switch_lang}}</a></li>
                <li>
                    <span class="search"><img src="{{ asset('/front/ar') }}/assets/images/search.png" alt=""></span>
                     <div class="drop-search">
                      <form action="{{route('ar.search.index')}}" method="GET">
                        <input type="text" name="key" placeholder="بحث" required>
                        <input type="submit" name="" value="">
                        <div class="search-close"><i class="fa fa-close"></i></div>
                      </form>
                    </div>
                  </li>
              </ul>
            </div>
            <div class="site-nav clearfix">
              <ul>
                <li><a class="{{(Request::is('ar/cms/our-story') || Request::is('ar/cms/our-story/*')) 
                ||(Request::is('ar/cms/a-life-well-lived') || Request::is('ar/cms/a-life-well-lived/*'))
                ||(Request::is('ar/cms/ceo-message') || Request::is('ar/cms/ceo-message/*'))
                
                ||(Request::is('ar/cms/social-responsiblities') || Request::is('ar/cms/social-responsiblities/*'))
                ||(Request::is('ar/our-achievements') || Request::is('ar/our-achievements/*') || in_array($currentSlug, $slugArr))
                ? 'active' : ''}}" href="#">‫‫من نحن</a>
                  <ul>
                  <?php
                      foreach( $allCms as $key => $menu)
                      { ?>
                        <li><a class="menu-pic {{ ($menu->slug_name==$currentSlug) ? 'active' : '' }}"  id="menu_{{$key}}" href="{{ url('ar/') }}/cms/{{$menu->slug_name}}">{{$menu->name_ar}}</a></li>
                      <?php
                      }
                      ?>
                    <li><a class="menu-pic {{(Request::is('ar/our-achievements') || Request::is('ar/our-achievements/*')) ? '' : ''}}" id="menu_eleven" href="{{ url('/') }}/ar/our-achievements">{{$ourAchievementTitle->ach_title_ar}}</a></li>
                    
                       <div class="item-img">

                       <?php
                      foreach( $allCms as $key => $menu)
                      { ?>
                        <div class="item-img-single" id="divmenu_{{$key}}" @if($key==0)style="display: block;"@endif>
                           @if (!empty($menu->banner_image))
                            <img src="{{ asset('assets/cms/banner_images/') }}/{{ $menu->banner_image }}" alt="">
                            @else
                             <img src="{{ asset('/front/en') }}/assets/images/menu-img.png" alt="">
                            @endif
                        </div>
                        <?php
                      }
                      ?>
                      <div class="item-img-single" id="divmenu_eleven">  
                           {{--<img src="{{ asset('front/ar') }}/assets/images/our-achievements.jpg" alt="">--}}
                           <img src="{{ asset('assets/images/'.$ourAchievementTitle->achievement_banner_image.'') }}" alt="">
                      </div>
                       
                      </div>


                  </ul>
                </li>

                @php  $projectRoutes = ['ar.projectdetail.detail'];
                $cid = 0;
                if ($projectDetails) {
                  $cid = $projectDetails[0]->id;
                } 
                @endphp

                <li><a class="communitu-main-menu {{(Request::is('ar/communities') || Request::is('ar/communities/*') || in_array(\Request::route()->getName(), $projectRoutes)) ? 'active' : ''}}" href="{{ url('/') }}/ar/communities" data-cid="{{ $cid }}">مجتمعاتنا</a>
                  <ul>
                    @foreach ( $projectDetails as $project )
                    
                     <li class="">
                     
                       <a class="menu-pic-community @if ($project->slug_name == $communityDetailsSlug)active @endif "  id="community_{{ $project->id }}" href="{{route('ar.projectdetail.detail',[$project->slug_name])}}">{{ $project->name_ar }}</a>
                     </li>
                     @endforeach

                     <div class="item-img">
                      @foreach ( $projectDetails as $keyProject => $project )
                      <div class="item-img-single item-img-single-community" id="div_community_{{ $project->id }}" @if ($keyProject == 0)style="display: block;" @endif>
                         @if (!empty($project['banner']))
                          <img src="{{ asset('/admin/upload/project/banner/original/'.$project->banner) }}" alt="">
                          @else
                           <img src="{{ asset('/front/en') }}/assets/images/menu-img.png" alt="">
                          @endif
                      </div>
                      @endforeach
                    </div>
                     
                     
                   </ul>
                
                </li>

                {{-- <li><a class="{{(Request::is('ar/cms/our-communities') || Request::is('ar/cms/our-communities/*')) ? 'active' : ''}}" href="{{ url('/') }}/ar/cms/our-communities">مجتمعاتنا</a></li> --}}
                <li><a class="{{(Request::is('ar/service') || Request::is('ar/service/*')) ? 'active' : ''}}" href="{{ url('/') }}/ar/service">خدماتنا</a></li>
                {{--<li><a class="{{(Request::is('ar/investor-relations') || Request::is('ar/investor-relations/*')) ? 'active' : ''}}" href="{{ url('/') }}/ar/investor-relations">علاقات المستثمرين</a></li>--}}
                
                <li>
                {{--<a class="investor-main-menu {{(Request::is('ar/investor-relations') || Request::is('ar/investor-relations/*') || $currentSlug=='board-of-directors' || $currentSlug=='executive-management' || $currentSlug=='company-committes' || $currentSlug=='governance' || $currentSlug=='the-company-article')  ? 'active' : ''}}" href="{{ url('/') }}/ar/investor-relations">علاقات المستثمرين</a>--}}
                     <a class="investor-main-menu {{(Request::is('ar/investor-relations') || Request::is('ar/investor-relations/*') || $currentSlug=='board-of-directors' || $currentSlug=='executive-management' || $currentSlug=='company-committes' || $currentSlug=='governance' || $currentSlug=='the-company-article')  ? 'active' : ''}}" href="javascript:void(0);">علاقات المستثمرين</a>
                     <ul>
                    <?php
                      foreach( $allCmsInvestor as $key => $menu)
                      { ?>
                        <li><a class="menu-pic-investor {{ ($menu->slug_name==$currentSlug) ? 'active' : '' }}"  id="divmenu_{{$key}}" data-cid="{{$key}}" href="{{ url('/') }}/ar/cms/{{$menu->slug_name}}">{{$menu->name_ar}}</a></li>
                      <?php
                      }
                      ?>
                      
                      <div class="item-img">

                      <?php
                      foreach( $allCmsInvestor as $key => $menu)
                      { ?>
                        <div class="item-img-single item-img-single-investor" id="divmenux_{{$key}}" @if($key==0)style="display: block;"@endif>
                           @if (!empty($menu->banner_image))
                            <img src="{{ asset('assets/cms/banner_images/') }}/{{ $menu->banner_image }}" alt="">
                            @else
                             <img src="{{ asset('/front/en') }}/assets/images/menu-img.png" alt="">
                            @endif
                        </div>
                        <?php
                      }
                      ?>

                      </div>
                      
                    </ul>
                  </li>

                @php $newsRoutes = ['front.news-details']; @endphp
                <li><a class="{{(Request::is('ar/media-center') || Request::is('ar/media-center/*') || in_array(\Request::route()->getName(), $newsRoutes)) ? 'active' : ''}}" href="{{ url('/') }}/ar/media-center">المركز الإعلامي</a></li>
                <li><a class="{{(Request::is('ar/join-us') || Request::is('ar/join-us/*')) ? 'active' : ''}}" href="{{ url('/') }}/ar/join-us">انضم لنا</a></li>
                <li><a class="{{(Request::is('ar/contact-us') || Request::is('ar/contact-us/*')) ? 'active' : ''}}" href="{{ url('/') }}/ar/contact-us">اتصل بنا</a></li>
                <!-- <li><a class="{{(Request::is('ar/our-achievements') || Request::is('ar/our-achievements/*')) ? 'active' : ''}}" href="{{ url('/') }}/ar/our-achievements">إنجازاتنا</a></li> -->
              </ul>
            </div>
          </div>
        </div>
      </div>
    </section>
