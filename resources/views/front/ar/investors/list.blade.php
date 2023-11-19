@extends('front.ar.layout.inner')
@section('page-content')

<section class="hero-banner alt investor_banner" >

    @if (!empty($investor['banner']))
    <img src="{{ asset('/assets/images') }}/{{ $investor['banner'] }}" alt=""  width="100px">
    @else
    <img src="{{ asset('/admin/upload/common/no-image-found.jpg') }}" alt="" height="100px" width="100px">
    @endif

    <div class="container">
      <div class="inner_banner_txt">
      {{--<h2 >{{$investor['title_ar']}}</h2>--}}
        <h2>{{$pageTite->investor_relation_ar}}</h2>
      </div>
    </div>
  </section>

  <section class="about_content">
    <div class="container">
      <div class="investor-relations-txt">        
        <div class="row">
          <div class="col-lg-12">
           <h2>{{$investor['title_ar']}}</h2> 
          {!!html_entity_decode($investor['description_ar'])!!}
          </div>
        </div>
      </div>
    </div>

   
    <div class="container">            
        <div class="row">
          <div class="col-lg-12">
           <div class="investor-heading">
           <?php echo $investor['heading_ar']?>
           </div>
          </div>
        </div>      
    </div>


    @if(count($investorAchievement)>0)
    <section>
      <div class="container">
        <h2  class="al-hakiam_title text-center"></h2>
        <div class="section04_tab-block">
          <ul class="nav nav-pills al-hakiam_tabList" id="pills-tab" role="tablist">
  
              @php $cnt = 1; @endphp
              @foreach($investorAchievement as $ud)
                   <li class="nav-item">
                      <a class="nav-link @if($cnt == 1) active @endif" id="pills-{{$ud->id}}-tab" data-toggle="pill" href="#pills-{{$ud->id}}" role="tab" aria-controls="pills-{{$ud->id}}" aria-selected="true">{{$ud->year}}</a>
                   </li>
                  @php $cnt++; @endphp
              @endforeach
  
            
          </ul>
          <div class="tab-content al-hakiam_tabContent" id="pills-tabContent">
                      @php $cnt = 1; @endphp
                      @foreach($investorAchievement as $ud)
  
                          <div class="tab-pane fade @if($cnt == 1) show active @endif" id="pills-{{$ud->id}}" role="tabpanel" aria-labelledby="pills-{{$ud->id}}-tab">
                            <div class="investor_icon_sec">
                              <div class="container">
                                <div class="row">
                                <?php if(!empty($ud->financial_pdf_ar)){ ?>
                                  <div class="col-md-6">
                                    <img src="{{ asset('/front/en') }}/assets/images/investor_icon1.jpg" alt="">
                                    <!--<a href="{{asset('/assets/financial-pdf/'.$ud->financial_pdf_ar) }}" class="investor_btn" target="_blank  n">عرض النتائج المالية</a>-->
<a href="{{asset('/assets/financial-pdf/'.$ud->financial_pdf_ar) }}" class="investor_btn" target="_blank  n">{{$button_txt['financial_ar']}}</a>
                                  </div>
                                  <?php } ?>
                                  <?php if(!empty($ud->annual_pdf_ar)){ ?>
                                  <div class="col-md-6">
                                    <img src="{{ asset('/front/en') }}/assets/images/investor_icon2.jpg" alt="">
                                  <!--  <a href="{{asset('/assets/annual-pdf/'.$ud->annual_pdf_ar) }}" class="investor_btn" target="_blank  n">عرض التقارير السنوية</a>-->
          <a href="{{asset('/assets/annual-pdf/'.$ud->annual_pdf_ar) }}" class="investor_btn" target="_blank  n">{{$button_txt['annual_ar']}}</a>
                                  </div>
                                  <?php } ?>
                                  <?php if(!empty($ud->basel_pdf_ar)){ ?>
                                  <div class="col-md-6">
                                    <img src="{{ asset('/front/en') }}/assets/images/investor_icon3.jpg" alt="">
                                   <!-- <a href="{{asset('/assets/basel-pdf/'.$ud->basel_pdf_ar) }}" class="investor_btn" target="_blank  n">عرض تقرير بازل</a>-->
 <a href="{{asset('/assets/basel-pdf/'.$ud->basel_pdf_ar) }}" class="investor_btn" target="_blank  n">{{$button_txt['base_ar']}}</a>
                                  </div>
                                  <?php } ?>
                                  <?php if(!empty($ud->profit_pdf_ar)){ ?>
                                  <div class="col-md-6">
                                    <img src="{{ asset('/front/en') }}/assets/images/investor_icon4.jpg" alt="">
                             <!-- <a href="{{asset('/assets/profit-pdf/'.$ud->profit_pdf_ar) }}" class="investor_btn" target="_blank  n">عرض الربح</a>-->
 <a href="{{asset('/assets/profit-pdf/'.$ud->profit_pdf_ar) }}" class="investor_btn" target="_blank  n">{{$button_txt['profit_ar']}}</a>
                                  </div>
                                  <?php } ?>
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
  </section>
  
@endsection


