@extends('front.en.layout.inner')


@section('page-content')


   <section class="investor_banner" data-aos="fade-up" data-aos-delay="300">
   @if (!empty($pageTite->banner_image))
      <img src="{{ asset('assets/images/'.$pageTite->banner_image.'') }}" alt="">
      @else
      <img src="{{ asset('/admin/upload/common/no-image-found.jpg') }}">
    @endif
    <div class="container">
       <div class="inner_banner_txt">
          <h2>{{$pageTite->communities_en}}</h2>
       </div>
    </div>
 </section>



  <section class="select-group">
  <form action="{{route('projectlist.index')}}" method="GET" id="filter_project">
    <input type="hidden" name="do" value="filter">
    <div class="container">
      <div class="select-group-main project">
        <ul>
          <li>
            <div class="select-wrap">
              
              <select class="" name="project_status">
                            <option value="" @if($pstatus == '') selected @endif>Project status</option>
                            @foreach($statusData as $sd)
                                <option value="{{$sd->id}}" @if($pstatus == $sd->id) selected @endif>{{$sd->status}}</option>
                            @endforeach
              </select>
            </div>
          </li>
          <li>
            <div class="select-wrap">
              <select class="" name="bedroom">
                <option value="" @if($pbedroom == '') selected @endif>Bedrooms</option>
                <option value="1" @if($pbedroom == '1') selected @endif>1</option>
                <option value="2" @if($pbedroom == '2') selected @endif>2</option>
                <option value="3" @if($pbedroom == '3') selected @endif>3</option>
                <option value="4" @if($pbedroom == '4') selected @endif>4</option>
                <option value="more-than-4" @if($pbedroom == 'more-than-4') selected @endif>More Than 4</option>
              </select>
            </div>
          </li>
          <li>
            <div class="select-wrap">
              
              <select class="" name="space">
                <option value="" @if($pspace == '') selected @endif>Area</option>
                <option value="0-199" @if($pspace == '0-199') selected @endif>Less than 200</option>
                <option value="200-300" @if($pspace == '200-300') selected @endif>200-300</option>
                <option value="300-400" @if($pspace == '300-400') selected @endif>300-400</option>
                <option value="400" @if($pspace == '400') selected @endif>More Than 400</option>
              </select>
            </div>
          </li>
          <li>
            <div class="select-wrap">
              
              <select class="" name="city">
                <option value="" @if($pcity == '') selected @endif>City</option>
                   @foreach($cityData as $city)
                      <option value="{{$city->id}}" @if($pcity == $city->id) selected @endif>{{$city->name_en}}</option>
                   @endforeach
              </select>
            </div>
          </li>
          <li>
            <div class="select-wrap">
              
              <select class="" name="type">
                <option value="" @if($ptype == '') selected @endif>Type</option>
                @foreach($typeData as $td)
                  <option value="{{$td->id}}" @if($ptype == $td->id) selected @endif>{{$td->type}}</option>
                @endforeach
              </select>
            </div>
          </li>          
        </ul>

        <div class="btns">

          <button class="btn" type="submit" name="button">Search</button>
          <a href="{{route('projectlist.index')}}" class="btn alt">Reassignment</a>
          
        </div>
      </div>
    </div>
    </form>
  </section>


  <section class="project-list">

  @if(count($projects) > 0)
        @foreach($projects as $project)
            <div class="list-item">
              <div class="pic">
                <div class="content">
                    @if (!empty($project->banner))
                        <img src="{{ asset('/admin/upload/project/banner/original') }}/{{ $project->banner }}" alt="">
                    @else
                        <img src="{{ asset('/admin/upload/common/no-image-found.jpg') }}" alt="">
                    @endif
                  <!-- <img src="{{ asset('/front/en') }}/assets/images/project-1.jpg" alt=""> -->
                </div>
              </div>
              <div class="txt">
                <div class="strip"><img src="{{ asset('/front/en') }}/assets/images/strip.png" alt=""></div>
                <h2>{{$project->name}}</h2>
                <p>{{ substr($project->content, 0,  1000) }}</p>

                <a href="{{route('projectdetail.detail',[$project->slug_name])}}" class="read-more">Read More</a>
              </div>
            </div>
            @endforeach

            {{--<div class="card-footer clearfix">
              <div class="paginationDiv ">
                  <div class="float-right">
                      {{ $projects->appends($pagequery)->render() }}
                  </div>
              </div>
            </div>--}}

          @else
          <p>No project record is available.</p>
          @endif
  </section>
  

<section class="project-bottom">
  <div class="container">
    <div class="row">
      <div class="col-lg-2">
        <img src="{{ asset('/front/en') }}/assets/images/project-bottom.png" alt="">
      </div>
      <div class="col-lg-3">
        <h2>Another meaning <br>
        of architecture</h2>
      </div>      
    </div>
  </div>
</section>
  
@endsection

