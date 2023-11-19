@extends('front.ar.layout.inner')


@section('page-content')


  <section class="investor_banner" data-aos="fade-up" data-aos-delay="300">
  @if (!empty($pageTite->banner_image))
    <img src="{{ asset('assets/images/'.$pageTite->banner_image.'') }}" alt="">
    @else
    <img src="{{ asset('/admin/upload/common/no-image-found.jpg') }}">
  @endif
    <div class="container">
       <div class="inner_banner_txt">
        <h2>{{$pageTite->communities_ar}}</h2>
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
              <!-- <select class="" name="">
                <option value="">حالة المشروع </option>
                <option value="">حالة المشروع </option>
                <option value="">حالة المشروع </option>
              </select> -->
              <select class="" name="type">
                <option class="custom-font" value="" @if($ptype == '') selected @endif>النـــوع</option>
                @foreach($typeData as $td)
                  <option class="custom-font" value="{{$td->id}}" @if($ptype == $td->id) selected @endif>{{$td->type_ar}}</option>
                @endforeach
              </select>
            </div>
          </li>
          <li>
            <div class="select-wrap">
              <!-- <select class="" name="">
                <option value="">غرف النوم </option>
                <option value="">غرف النوم </option>
                <option value="">غرف النوم </option>
              </select> -->
              <select class="" name="city">
                <option class="custom-font" value="" @if($pcity == '') selected @endif>المدينة</option>
                   @foreach($cityData as $city)
                      <option class="custom-font" value="{{$city->id}}" @if($pcity == $city->id) selected @endif>{{$city->name_ar}}</option>
                   @endforeach
              </select>
            </div>
          </li>
          <li>
            <div class="select-wrap">
              <select class="" name="space">
                <option class="custom-font" value="" @if($pspace == '') selected @endif>المساحة</option>
                <option class="custom-font" value="0-199" @if($pspace == '0-199') selected @endif>أقل من 200</option>
                <option class="custom-font" value="200-300" @if($pspace == '200-300') selected @endif>200-300</option>
                <option class="custom-font" value="300-400" @if($pspace == '300-400') selected @endif>300-400</option>
                <option class="custom-font" value="400" @if($pspace == '400') selected @endif>أكثر من 400</option>
              </select>
            </div>
          </li>
          <li>
            <div class="select-wrap">
              <select class="" name="bedroom">
                <option class="custom-font" value="" @if($pbedroom == '') selected @endif>غرف نوم</option>
                <option class="custom-font" value="1" @if($pbedroom == '1') selected @endif>1</option>
                <option class="custom-font" value="2" @if($pbedroom == '2') selected @endif>2</option>
                <option class="custom-font" value="3" @if($pbedroom == '3') selected @endif>3</option>
                <option class="custom-font" value="4" @if($pbedroom == '4') selected @endif>4</option>
                <option class="custom-font" value="more-than-4" @if($pbedroom == 'more-than-4') selected @endif>أكثر من 4</option>
              </select>
            </div>
          </li>

          <li>
            <div class="select-wrap">
              <!-- <select class="" name="">
                <option value="">النـــوع </option>
                <option value="">النـــوع </option>
                <option value="">النـــوع </option>
              </select> -->

              <select class="" name="project_status">
                            <option class="custom-font" value="" @if($pstatus == '') selected @endif>حالة المشروع</option>
                            @foreach($statusData as $sd)
                                <option class="custom-font" value="{{$sd->id}}" @if($pstatus == $sd->id) selected @endif>{{$sd->status_ar}}</option>
                            @endforeach
              </select>
            </div>
          </li>
        </ul>

        <div class="btns">
          <button class="btn" type="submit" name="button">البحث</button>
          <!-- <a href="{{route('projectlist.index')}}" class="btn alt">Reassignment</a>

          <button class="btn" type="button" name="button">البحث  </button> -->
          <a href="{{route('projectlist.index')}}" class="btn alt">إعادة التعيين  </a>
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
              <!-- <img src="{{ asset('/front/ar') }}/assets/images/project-1.jpg" alt=""> -->
              </div>
            </div>
            <div class="txt">
              <div class="strip"><img src="{{ asset('/front/ar') }}/assets/images/strip.png" alt=""></div>
              <h2>{{$project->name_ar}}</h2>
              <p>{!! substr($project->content_ar, 0,  1000) !!}</p>

              <a href="{{route('projectdetail.detail',[$project->slug_name])}}" class="read-more">اكتشف المزيد</a>
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
      <p>لا يوجد سجل مشروع متاح</p>
      @endif



  </section>

<section class="project-bottom">
  <div class="container">
    <div class="row">
      <div class="col-lg-2">
        <img src="{{ asset('/front/ar') }}/assets/images/project-bottom.png" alt="">
      </div>
      <div class="col-lg-3">
        <h2>معنى آخر  <br>
للعــــمــارة</h2>
      </div>      
    </div>
  </div>
</section>

@endsection