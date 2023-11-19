@extends('front.en.layout.inner')
@section('page-content')



  <section class="investor_banner" data-aos="fade-up" data-aos-delay="1000">
    <img src="{{ asset('/front/en') }}/assets/images/search-banner.jpg" alt="">
    <div class="container">
      <div class="inner_banner_txt">
        <h2 data-aos="fade-up" data-aos-delay="300">Search</h2>
      </div>
    </div>
  </section>

  {{-- <section class="search-content" data-aos="fade-up" data-aos-delay="500"> 
    <div class="benefits">
      <div class="container">
        <div class="row">
          <div class="col-lg-12">
             <h2 data-aos="fade-up" data-aos-delay="300" class="search-key">Search @if($key != '') <span class="search-key-each">:{{$key}} @endif</span></h2>
            <div data-aos="fade-up" data-aos-delay="300" class="inner-search-form">
              <form action="{{route('search.index')}}" method="GET">
                <input type="text" name="key" placeholder="Search..." required>
                <input type="submit" name="" value="GO">
              </form>
            </div>
          </div>
        </div>                  
        <div class="benefits-main">
          <div class="row">
          @if($projectSearchResults != 'New search') 
            @if(count($projectSearchResults) > 0) 
              @foreach($projectSearchResults as $project)
                <div class="col-lg-12" data-aos="fade-up" data-aos-delay="300">
                  <div class="row">

                    <div class="col-lg-6">
                                  @if (!empty($project->banner))
                                      <img src="{{ asset('/admin/upload/project/banner/thumbnail') }}/{{ $project->banner }}" alt="">
                                  @else
                                      <img src="{{ asset('/admin/upload/common/no-image-found.jpg') }}" alt="">
                                  @endif
                    </div>

                    <div class="col-lg-6">
                  
                      <h3>{{$project->name}}</h3>
                      <p>{!!substr($project->content,0,150)!!}</p>

                      <p class="hlight">Type: Projects</p>
                      <a class="site-link blue" href="{{ url('/') }}/project-detail/{{$project->slug_name}}">Read More</a>
                    </div>
                  </div>
                </div>
              @endforeach
            @endif
          @endif

          

          @if($newsSearchResults != 'New search')
            @if(count($newsSearchResults) > 0) 
              @foreach($newsSearchResults as $news)
                <div class="col-lg-12" data-aos="fade-up" data-aos-delay="300">
                  <div class="row">
                    <div class="col-lg-6">
                                  @if (!empty($news->slider_1))
                                      <img src="{{ asset('/assets/images') }}/{{ $news->slider_1 }}" alt="">
                                  @else
                                      <img src="{{ asset('/admin/upload/common/no-image-found.jpg') }}" alt="">
                                  @endif
                    </div>

                    <div class="col-lg-6">
                      <h3>{{$news['title_en']}}</h3>
                      <p>{!!substr($news->description_en,0,150)!!}</p>

                      <p class="hlight">Type: News</p>


                      <a class="site-link blue" href="{{ url('/') }}/news-details/{{$news->slug_name}}">Read More</a>
                    </div>
                  </div>
                </div>
              @endforeach
            @endif
          @endif

          <div class="col-lg-12">
          @if($newsSearchResults != 'New search' and  $projectSearchResults != 'New search')
            @if(count($projectSearchResults) == 0 and count($newsSearchResults) == 0)
              <h4>No result found.</h4>
            @endif
          @endif
          </div>
    
          </div>
        </div>
      </div> 
    </div>  
  </section> --}}

  <section class="search-results" data-aos="fade-up" data-aos-delay="300">
    <div class="container">
       <div class="row">
          <div class="col-lg-12">
             <div class="search-wrapper">
              <h2 data-aos="fade-up" data-aos-delay="300" class="search-key">Search results for @if($key != '') <span class="search-key-each">"{{$key}}" @endif</span></h2>
                
                  <div data-aos="fade-up" data-aos-delay="300" class="inner-search-form">
                    <form action="{{route('search.index')}}" method="GET">
                      <input type="text" name="key" placeholder="Search..." required>
                      <input type="submit" name="" value="GO">
                    </form>
                  </div>
                <div class="results">
                  @if($projectSearchResults != 'New search') 
                    @if(count($projectSearchResults) > 0) 
                    @foreach($projectSearchResults as $project)
                    <div class="results-row">
                        <div class="pic">
                          @if (!empty($project->banner))
                            <img src="{{ asset('/admin/upload/project/banner/thumbnail') }}/{{ $project->banner }}" alt="">
                          @else
                          <img src="{{ asset('/admin/upload/common/no-image-found.jpg') }}" alt="">
                          @endif
                        </div>
                        <div class="txt">
                          <h3>{{$project->name}}</h3>
                          <p>{!!substr($project->content,0,150)!!}</p>
                          <a href="{{ url('/') }}/project-detail/{{$project->slug_name}}" class="know-more">know more</a>
                        </div>
                    </div>
                    @endforeach
                    @endif
                  @endif


                  @if($newsSearchResults != 'New search')
                    @if(count($newsSearchResults) > 0) 
                    @foreach($newsSearchResults as $news)
                    <div class="results-row">
                        <div class="pic">
                            @if (!empty($news->slider_1))
                            <img src="{{ asset('/assets/images') }}/{{ $news->slider_1 }}" alt="">
                            @else
                                <img src="{{ asset('/admin/upload/common/no-image-found.jpg') }}" alt="">
                            @endif
                        </div>
                        <div class="txt">
                          <h3>{{$news['title_en']}}</h3>
                          <p>{!!($news->short_description_en)!!}</p>
                          <a href="{{ url('/') }}/news-details/{{ $news['slug_name'] }}" class="know-more">know more</a>
                        </div>
                    </div>
                    @endforeach
                    @endif
                  @endif

                  <div class="col-lg-12">
                    @if($newsSearchResults != 'New search' and  $projectSearchResults != 'New search')
                      @if(count($projectSearchResults) == 0 and count($newsSearchResults) == 0)
                        <h4>No result found.</h4>
                      @endif
                    @endif
                    </div>
                   
                </div>
             </div>
          </div>
       </div>
    </div>
 </section>


@endsection

