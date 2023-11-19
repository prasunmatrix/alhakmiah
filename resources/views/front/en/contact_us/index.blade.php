
@extends('front.en.layout.inner')
@section('page-content')
      
      <section class="investor_banner contact" data-aos="fade-up" data-aos-delay="300">
         <!--<img src="{{ asset('/front/en') }}/assets/images/contact-banner.jpg" alt="">-->
         @if (!empty($pageTite->contact_banner_image))
              <img src="{{ asset('assets/images/'.$pageTite->contact_banner_image.'') }}" alt="">
              @else
              <img src="{{ asset('/admin/upload/common/no-image-found.jpg') }}">
         @endif
         <div class="container">
            <div class="inner_banner_txt">
            <h2 data-aos="fade-up" data-aos-delay="300">{{$pageTite->contact_us_en}}
               </h2>
            </div>
         </div>
      </section>
      <!-- join us start -->

      
     <!--   <section class="investor_banner contact" data-aos="fade-up" data-aos-delay="300">
         <img src="assets/images/contact-banner.jpg" alt="">
         <div class="container">
            <div class="inner_banner_txt">
               <h2 data-aos="fade-up" data-aos-delay="300">The future expands<br>
                  Upon dream and vision
               </h2>
            </div>
         </div>
      </section> -->
      <!-- contact us start -->
      <section class="contact-content">
         <div class="container">
            <div class="row">
               <div class="col-lg-12">
                  <div class="contact-address">
                     {{-- { $contactUsSettings->contact_us_text_en } --}}
                     <div class="txt">
                        {!!($contactUsSettings->contact_us_text_en)!!}
                      <!--   <div class="contact-social">
                           <ul>
                              <li><a href="{{$contactUsSettings->instagram  }}"><i class="fa fa-instagram" aria-hidden="true"></i></a></li>
                              <li><a href="{{$contactUsSettings->linkedin  }}"><i class="fa fa-linkedin" aria-hidden="true"></i></a></li>
                              <li><a href="{{$contactUsSettings->twitter  }}"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
                              <li><a href="{{$contactUsSettings->youtube  }}"><i class="fa fa-youtube-play" aria-hidden="true"></i></a></li>
                              <li><a href="{{$contactUsSettings->whatsapp  }}"><i class="fa fa-whatsapp" aria-hidden="true"></i></a></li>
                              <li><a href="{{$contactUsSettings->facebook  }}"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>                                 
                           </ul>
                        </div> -->
                   </div>
                     <div class="map"> {!!($contactUsSettings->contact_us_map)!!}</div>
                  </div>
                  <div class="contact-form">
                     <div class="left">
                        <h2>We are Happy<br> To Contact You
                        </h2>
                     </div>
                     <div class="right">
                        <form>
                           <div class="form-row">                           
                              <input name="name" id="name" type="text" placeholder="Name">
                           </div>
                           <div class="form-row">
                              <input name="phone" id="phone" type="text" placeholder="Mobile Number"> 
                           </div>
                           <div class="form-row">                           
                              <input name="email" id="email" type="email" placeholder="Email">  
                           </div>
                           <div class="form-row">                   
                              <textarea name="comment" id="comment"  cols="" rows="" placeholder="Message"></textarea>
                           </div>
                           <div class="form-row">
                              <input  type="submit" id="send"  value="Send" class="btn-submit">
                           </div>
                           <div class="message_box" style="margin:10px 0px;">
                           </div>
                        </form>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </section>
      <!-- contact us end -->

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>

$(function () {
    $('.textarea').summernote()
  })
$(document).ready(function() {
  var delay = 2000;
  $('#send').click(function(e){
    e.preventDefault();


   var name = $('#name').val();
   if(name == ''){
      $('.message_box').html('<span style="color:red;">Enter Your Name!</span>');
       $('#name').focus();
       return false;
   }
 
   var email = $('#email').val();
   if(email == ''){

      $('.message_box').html('<span style="color:red;">Enter Email Address!</span>');
      $('#email').focus();
      return false;
   }

   var phone = $('#phone').val();
   if(phone == ''){
      $('.message_box').html('<span style="color:red;">Enter Your phone!</span>');
       $('#phone').focus();
       return false;
   }
   // if( $("#email").val()!='' ){
     //  // if( !isValidEmailAddress( $("#email").val() ) ){
     //  // $('.message_box').html('<span style="color:red;">Provided email address is incorrect!</span>');
     //  // $('#email').focus();
   //     return false;
   //     //}

   // }
 
   var comment = $('#comment').val();
   var _token = "{{ csrf_token() }}";

   if(comment == ''){
      $('.message_box').html('<span style="color:red;">Enter Your Message Here!</span>');
      $('#comment').focus();
      return false;
   } 

      $.ajax({
         type: "POST",
         url: "{{ url('send_contact') }}",
         data: "name="+name+"&email="+email+"&comment="+comment+"&_token="+_token+"&phone="+phone,
         beforeSend: function() {

           $('.message_box').html('<img src="assets/ajax-loader.gif" width="25" height="25"/>');
           $('.btn-submit').prop("disabled", true);
         }, 
         success: function(data)
         {
            // setTimeout(function() {
            // $('.message_box').html(data);
            //  }, delay);
            $('.message_box').html(data);
            window.setTimeout(function () {
              window.location.reload();
            }, 4000);




         }
      });
  });


 
});
</script>

@endsection