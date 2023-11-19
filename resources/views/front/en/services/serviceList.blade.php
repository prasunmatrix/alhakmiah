@extends('front.en.layout.inner')


@section('page-content')
  <section class="investor_banner" data-aos="fade-up" data-aos-delay="300">
    @if (!empty($getBanner->banner))
              <!-- <div class="item" style="background-image: url('{{ asset('assets/cms/banner_images') }}/{{ $getBanner->banner }}');"> -->
              <img src="{{ asset('assets/cms/banner_images') }}/{{ $getBanner->banner }}">
              @else
             <!--  <div class="item" style="background-image: url('{{ asset('/admin/upload/common/no-image-found.jpg') }}');"> -->
              <img src="{{ asset('/admin/upload/common/no-image-found.jpg') }}">
             @endif
    <div class="container">
       <div class="inner_banner_txt">
        <h2>{{$pageTite->service_en}}</h2>
       </div>
    </div>
 </section>

{{-- @if(count($serviceData) > 0)
@php $count = 1; @endphp
  <section class="txt-block">
    @foreach($serviceData as $sd)
   
    <div class="txt-block-main style-1" id="each-service-{{$sd->id}}">
      <div class="container">
        <div class="row align-items-center">
          <div class="col-lg-4" data-aos="fade-up" data-aos-delay="300">
            <div class="@if($count/2 != 0) txt-block-right @else txt-block-left @endif">
              <h2>{{$sd->title_en}}</h2>
               @if (!empty($sd->image))
              <img src="{{ asset('/assets/images') }}/{{ $sd->image }}" alt=""  width="100px">
              @else
              <img src="{{ asset('/admin/upload/common/no-image-found.jpg') }}" alt="" height="100px" width="100px">
              @endif
            </div>
          </div>
          <div class="col-lg-8" data-aos="fade-up" data-aos-delay="500">
            <div class="@if($count/2 != 0) txt-block-left @else txt-block-right @endif">
              <p>@php echo html_entity_decode(substr($sd->description_en,0,300)); @endphp</p>
              <!-- <a class="site-link gradient" href="#">Read More</a> -->
          </div>
        </div>
      </div>
    </div>
  </div>
    @php $count=$count+1; @endphp
    @endforeach --}}

    <!-- <div class="txt-block-main style-2">
      <div class="container">
        <div class="row align-items-end">
          <div class="col-lg-4" data-aos="fade-up" data-aos-delay="300">
            <div class="txt-block-right">
              <h2>لمزيد من المعلومات</h2>
              <img src="{{ asset('/front/en') }}/assets/images/icon-9.png" alt="">
            </div>
          </div>
          <div class="col-lg-8" data-aos="fade-up" data-aos-delay="500">
            <div class="txt-block-left">
              <p>لوريم ايبسوم هو نموذج افتراضي يوضع في التصاميم لتعرض على العميل ليتصور طريقه وضع النصوص بالتصاميم سواء كانت تصاميم مطبوعه، بروشور او فلاير على سبيل المثال، او نماذج مواقع انترنت. وعند موافقه العميل المبدئيه على التصميم يتم ازالة هذا النص من التصميم ويتم وضع النصوص النهائية المطلوبة للتصميم ويقول البعض ان وضع النصوص التجريبية بالتصميم قد تشغل المشاهد عن وضع الكثير من الملاحظات او الانتقادات للتصميم الاساسي.</p>
              <a class="site-link gradient" href="#">لمزيد من المعلومات</a>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="txt-block-main style-3">
      <div class="container">
        <div class="row align-items-end">
          <div class="col-lg-4" data-aos="fade-up" data-aos-delay="300">
            <div class="txt-block-right">
              <h2>لمزيد من المعلومات</h2>
              <img src="{{ asset('/front/en') }}/assets/images/icon-10.png" alt="">
            </div>
          </div>
          <div class="col-lg-8" data-aos="fade-up" data-aos-delay="500">
            <div class="txt-block-left">
              <p>لوريم ايبسوم هو نموذج افتراضي يوضع في التصاميم لتعرض على العميل ليتصور طريقه وضع النصوص بالتصاميم سواء كانت تصاميم مطبوعه، بروشور او فلاير على سبيل المثال، او نماذج مواقع انترنت. وعند موافقه العميل المبدئيه على التصميم يتم ازالة هذا النص من التصميم ويتم وضع النصوص النهائية المطلوبة للتصميم ويقول البعض ان وضع النصوص التجريبية بالتصميم قد تشغل المشاهد عن وضع الكثير من الملاحظات او الانتقادات للتصميم الاساسي.</p>
              <a class="site-link gradient" href="#">لمزيد من المعلومات</a>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="txt-block-main style-4">
      <div class="container">
        <div class="row align-items-end">
          <div class="col-lg-4" data-aos="fade-up" data-aos-delay="300">
            <div class="txt-block-right">
              <h2>لمزيد من المعلومات</h2>
              <img src="{{ asset('/front/en') }}/assets/images/icon-11.png" alt="">
            </div>
          </div>
          <div class="col-lg-8" data-aos="fade-up" data-aos-delay="500">
            <div class="txt-block-left">
              <p>لوريم ايبسوم هو نموذج افتراضي يوضع في التصاميم لتعرض على العميل ليتصور طريقه وضع النصوص بالتصاميم سواء كانت تصاميم مطبوعه، بروشور او فلاير على سبيل المثال، او نماذج مواقع انترنت. وعند موافقه العميل المبدئيه على التصميم يتم ازالة هذا النص من التصميم ويتم وضع النصوص النهائية المطلوبة للتصميم ويقول البعض ان وضع النصوص التجريبية بالتصميم قد تشغل المشاهد عن وضع الكثير من الملاحظات او الانتقادات للتصميم الاساسي.</p>
              <a class="site-link gradient" href="#">لمزيد من المعلومات</a>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="txt-block-main style-5">
      <div class="container">
        <div class="row align-items-end">
          <div class="col-lg-4" data-aos="fade-up" data-aos-delay="300">
            <div class="txt-block-right">
              <h2>لمزيد من المعلومات</h2>
              <img src="{{ asset('/front/en') }}/assets/images/icon-12.png" alt="">
            </div>
          </div>
          <div class="col-lg-8" data-aos="fade-up" data-aos-delay="500">
            <div class="txt-block-left">
              <p>لوريم ايبسوم هو نموذج افتراضي يوضع في التصاميم لتعرض على العميل ليتصور طريقه وضع النصوص بالتصاميم سواء كانت تصاميم مطبوعه، بروشور او فلاير على سبيل المثال، او نماذج مواقع انترنت. وعند موافقه العميل المبدئيه على التصميم يتم ازالة هذا النص من التصميم ويتم وضع النصوص النهائية المطلوبة للتصميم ويقول البعض ان وضع النصوص التجريبية بالتصميم قد تشغل المشاهد عن وضع الكثير من الملاحظات او الانتقادات للتصميم الاساسي.</p>
              <a class="site-link gradient" href="#">لمزيد من المعلومات</a>
            </div>
          </div>
        </div>
      </div>
    </div> -->
          {{-- <div class="card-footer page-list clearfix">
            <div class="paginationDiv ">
                <div class="float-right">
                    {{ $serviceData->appends(\Request::except('page'))->render() }}
                </div>
          </div>
  </section>
  @endif --}}
  @if(count($serviceData) > 0)
  @php $count = 1; @endphp
  <section class="news-wrapper">
    @foreach($serviceData as $sd)
    <div class="news-list" id="each-service-{{$sd->title_en}}">
       <div class="pic">
        @if (!empty($sd->image))
        <img src="{{ asset('/assets/images') }}/{{ $sd->image }}" alt=""  width="100px">
        @else
        <img src="{{ asset('/admin/upload/common/no-image-found.jpg') }}" alt="" height="100px" width="100px">
        @endif
       </div>
       <div class="txt">
          <h2>{{$sd->title_en}}</h2>
         <!--  <p class="date">{{\Carbon::parse($sd->created_at)->format('d-m-Y')  }}</p> -->
          <p>{!!($sd->description_en)!!}</p>
          {{-- <a href="#" class="read-more">Read More</a> --}}
       </div>            
    </div>
    @php $count=$count+1; @endphp
    @endforeach
    <div class="card-footer page-list clearfix">
      <div class="paginationDiv ">
          <div class="float-right">
              {{ $serviceData->appends(\Request::except('page'))->render() }}
          </div>
      </div>
    </div>
 </section>
 @endif
  <!--<section class="bottom-bar">
    <div class="container">
      <h2>For Further Information</h2>
    </div>
  </section>-->

  @endsection