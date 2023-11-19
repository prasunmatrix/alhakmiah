
@extends('front.en.layout.inner')
@section('page-content')
      <section class="investor_banner" data-aos="fade-up" data-aos-delay="300">
      @if (!empty($jobsBanner['banner']))
         <!-- <img src="{{ asset('/front/en') }}/assets/images/joinus-banner.jpg" alt=""> -->
      <img src="{{ asset('assets/cms/banner_images/') }}/{{ $jobsBanner['banner'] }}" alt=""> 
       @else
       <img src="{{ asset('/front/en') }}/assets/images/joinus-banner.jpg" alt="">
       @endif
         <div class="container">
            <div class="inner_banner_txt">
               <h2 data-aos="fade-up" data-aos-delay="300">{{$pageTite->join_us_en}}</h2>
            </div>
         </div>
      </section>
      <!-- join us start -->

      
      <section class="joinus-content">
         <div class="container">
            <div class="row">
               <div class="col-lg-12">
                  <div class="joinus-form">
                     <div class="left">
                        <h2>Send your information</h2>
                     </div>
                     <div class="right">
                        <form action="{{route('front.jobApplyAnyone') }}" method="POST" enctype="multipart/form-data">
                           {{ csrf_field() }}
                          
                           <div class="form-row">                           
                              <input type="text" name="name"   placeholder="Name" id="applyname">
                           </div>
                           <div class="form-row">
                              <input name="phone" type="text"  id="applyphone" placeholder="Phone ">
                           </div>
                           <div class="form-row">                           
                              <input type="text" name="email"   id="applyemail"  placeholder="Email">  
                           </div>
                           <div class="form-row">                   
                              <div class="file-input">
                                <input type="file" id="file" class="file" name ="contact_info">
                                <label for="file">
                                  <span class="cv-select"> Attachment  </span>
                                  <span class="file-name"></span>
                                </label>
                              </div>
                           </div>
                           {{-- <div class="form-row">                           
                              <input type="file" name="attach" class="form-control" id="applyattach" placeholder="Attachment">  
                           </div> --}}
                           <div class="form-row">                   
                              <div class="g-recaptcha" data-sitekey="{{ env('GOOGLE_CAPTCHA_KEY') }}" data-callback="recaptchaDataCallbackRegister" 
				                        data-expired-callback="recapchaExpireCallbackRegister"></div>
				                     <input type="hidden" name="grecaptcha" id="hiddenRecaptchaRegister">
                           </div>
                           <div class="form-row">
                              <input name="" type="submit" value="Send" class="btn-submit">
                           </div>
                           @if(session('message'))
                           {!! session('message') !!}
                           @endif
                        </form>
                     </div>
                  </div>
                  <div class="header">
                     <div class="left"><h2>Available Positions</h2></div>
                     {{-- <div class="right"><img src="{{ asset('front/en/assets/images/sign.png')  }}" alt=""></div> --}}
                  </div>
                  <?php
                  if(count($jobs) >0)
                  {
                  ?>
                  @foreach($jobs as $data)
                  <div class="joinus-row">
                     <div class="icon"> @if (!empty($data['jobs_icon']))
                        <img src="{{ asset('/assets/images') }}/{{ $data['jobs_icon'] }}" alt="" >
                        @else
                        <img src="{{ asset('/admin/upload/common/no-image-found.jpg') }}" alt="" >
                        @endif</div>
                        <div class="txt">
                           <h3>{{ $data['title_en']}}</h3>
                           <p>{{ html_entity_decode(substr($data['description_en'],0,300)) }}</p>
                        </div>
                     <div class="btn-link"><a  data-fancybox data-type="ajax" id="#short-bio" data-id="{{ $data->id }}" data-encrypt="{{ encrypt($data->id, Config::get('Constant.ENC_KEY')) }}" class="link-color1" title="Apply now" data-src="{{ route('front.jobApplyForm',$data->id) }}"  href="javascript:;"> Apply now </a> </div>
                  </div>
                  @endforeach
                  <?php } else{ echo "There are no jobs available at the moment";}?>

               </div>
            </div>
         </div>
      </section>
      
      <script src="https://www.google.com/recaptcha/api.js" async defer></script>
      <script>

         function recaptchaDataCallbackRegister(response){
               $('#hiddenRecaptchaRegister').val(response);
         }

         function recapchaExpireCallbackRegister(){
               $('#hiddenRecaptchaRegister').val('');
         }


   </script>
@endsection