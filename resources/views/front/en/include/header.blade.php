<!doctype html>
<html lang="en">
  @php
    $headerDetails = \App\Models\Social::first();
  @endphp
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0, shrink-to-fit=no">
    <link rel="shortcut icon" href="{{ asset('/front/en') }}/assets/images/favicon.png">
    <!-- <title>Alhakmiah : Real Estate Development Industry Leader in KSA</title> -->
    <title>{{$metaDetail[$slug_name]['title']}}</title>
    <meta name="description" content="{{$metaDetail[$slug_name]['meta_descriptions']}}" />
    <link rel="canonical" href="{{$metaDetail[$slug_name]['canonical']}}" />
    <meta name="keywords" content="{{$metaDetail[$slug_name]['meta_keyword']}}">
    
    @if(Request::is('en/project-detail/*'))
      @if(!empty($projectDetail->json_ld))
      {!! html_entity_decode($projectDetail->json_ld) !!}
      @endif
    @endif
    @if(Request::is('en/cms/*'))
      @if(!empty($cmsPage->json_ld))
      {!! html_entity_decode($cmsPage->json_ld) !!}
      @endif      
    @endif
    @if(!empty($headerDetails->global_site_tag))
      {!! html_entity_decode($headerDetails->global_site_tag) !!}
    @endif

    <link rel="stylesheet" href="{{ asset('/front/en') }}/assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{ asset('/front/en') }}/assets/css/font-awesome.min.css">
    <link rel="stylesheet" href="{{ asset('/front/en') }}/assets/css/owl.carousel.min.css">
    <link rel="stylesheet" href="{{ asset('/front/en') }}/assets/css/aos.css">
    <link rel="stylesheet" href="{{ asset('/front/en') }}/assets/css/custom.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.7/jquery.fancybox.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.7/jquery.fancybox.css" rel="stylesheet"/>
  
  </head>
  @php 
   $projectDetails = \App\Models\Project::where('status','1')->orderBy('display_order','asc')->get();
   //$headerDetails = \App\Models\Social::first();
  @endphp
  <body>
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
                <a href="{{ url('/') }}/en/home"><img src="{{ asset('assets/images/'.$headerDetails->header_logo.'') }}" alt=""></a>
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
                    <span class="search"><img src="{{ asset('/front/en') }}/assets/images/search.png" alt=""></span>
                     <div class="drop-search">
                      <form action="{{route('en.search.index')}}" method="GET">
                        <input type="text" name="key" placeholder="Search..." required>
                        <input type="submit" name="" value="">
                        <div class="search-close"><i class="fa fa-close"></i></div>
                      </form>
                    </div>
                  </li>
                </ul>
              </div>
              <div class="site-nav clearfix">
               
                <ul>
                  <li><a class="{{(Request::is('cms/our-story') || Request::is('cms/our-story/*' )) 
                  || (Request::is('cms/a-life-well-lived') 
                  || Request::is('cms/a-life-well-lived/*')) 
                  || (Request::is('cms/ceo-message') || Request::is('cms/ceo-message/*')) 
                  
                  || (Request::is('cms/social-responsiblities') || Request::is('cms/social-responsiblities/*'))
                  || (Request::is('our-achievements') || Request::is('our-achievements/*') || in_array($currentSlug, $slugArr))
                  ? 'active' : ''}}" href="#">About us</a>
                    <ul>
                    <?php
                      foreach( $allCms as $key => $menu)
                      { ?>
                        <li><a class="menu-pic {{ ($menu->slug_name==$currentSlug) ? 'active' : '' }}"  id="menu_{{$key}}" href="{{ url('en/') }}/cms/{{$menu->slug_name}}">{{$menu->name_en}}</a></li>
                      <?php
                      }
                      ?>
                      <li><a class="menu-pic {{(Request::is('our-achievements') || Request::is('our-achievements/*')) ? '' : ''}}" id="menu_eleven" href="{{ url('/') }}/en/our-achievements">{{$ourAchievementTitle->ach_title_en}}</a></li>
                      
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
                  @php $projectRoutes = ['en.projectdetail.detail'];
                    $cid = 0;
                    if ($projectDetails) {
                      $cid = $projectDetails[0]->id;
                    }
                   @endphp
                  <li><a class="communitu-main-menu {{(Request::is('en/communities') || Request::is('en/communities/*') || in_array(\Request::route()->getName(), $projectRoutes))  ? 'active' : ''}}" href="{{ url('/') }}/en/communities" data-cid="{{ $cid }}" >Communities</a>
                    <ul>
                     @foreach ( $projectDetails as $project )
                      <li>
                        <a class="menu-pic-community @if ($project->slug_name == $communityDetailsSlug)active @endif" id="community_{{ $project->id }}" href="{{route('en.projectdetail.detail',[$project->slug_name])}}">{{ $project->name }}</a>
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
                  {{-- <li>
                    <a class="{{(Request::is('cms/our-communities') || Request::is('cms/our-communities/*')) ? 'active' : ''}}" href="{{ url('/') }}/cms/our-communities">Communities</a></li> --}}
                  <li>
                    <a class="{{(Request::is('en/service') || Request::is('en/service/*')) ? 'active' : ''}}" href="{{ url('/') }}/en/service">Services</a></li>
                  {{--<li><a class="{{(Request::is('investor-relations') || Request::is('investor-relations/*')) ? 'active' : ''}}" href="{{ url('/') }}/investor-relations">Investor Relations</a></li>--}}

                  <li>
                     <a class="investor-main-menu {{(Request::is('investor-relations') || Request::is('investor-relations/*') || $currentSlug=='board-of-directors' || $currentSlug=='executive-management' || $currentSlug=='company-committes' || $currentSlug=='governance' || $currentSlug=='the-company-article')  ? 'active' : ''}}" href="javascript:void(0);">Investor Relations</a>
                     <ul>
                    <?php
                      foreach( $allCmsInvestor as $key => $menu)
                      { ?>
                        <li><a class="menu-pic-investor {{ ($menu->slug_name==$currentSlug) ? 'active' : '' }}"  id="divmenu_{{$key}}" data-cid="{{$key}}" href="{{ url('/') }}/en/cms/{{$menu->slug_name}}">{{$menu->name_en}}</a></li>
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
                  <li><a class="{{(Request::is('en/media-center') || Request::is('en/media-center/*') || in_array(\Request::route()->getName(), $newsRoutes)) ? 'active' : ''}}" href="{{ url('/') }}/en/media-center">Media Center</a></li>
                  <li><a class="{{(Request::is('en/join-us') || Request::is('en/join-us/*')) ? 'active' : ''}}" href="{{ url('/') }}/en/join-us">Join Us</a></li>
                  <li><a class="{{(Request::is('en/contact-us') || Request::is('en/contact-us/*')) ? 'active' : ''}}" href="{{ url('/') }}/en/contact-us">Contact Us</a></li>
                   
                </ul>
              </div>
            </div>
          </div>
        </div>
      </section>

    