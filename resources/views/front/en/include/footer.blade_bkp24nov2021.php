<?php $getSocial = \App\Models\Social::find('1'); ?>
<footer class="site-footer">
    <div class="container">
      <div class="row align-items-end">
        <div class="col-xl-3 col-md-12">
          <div class="foot-left">
            <div class="foot-logo">
              <a href="{{ url('/') }}/home"><img src="{{ asset('assets/images/'.$getSocial->footer_logo.'') }}" alt=""></a>
            </div>
          <p>Customer Service Center <span>{{ $getSocial->phone }}</span></p>
          <p><span><a style="color: white;" href="mailto:{{ $getSocial->email }}">{{ $getSocial->email }}</a></span></p>
          <div class="footer-social">
            <ul>
              <li><a href="{{ $getSocial->twitter }}"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
              <li><a href="{{ $getSocial->instagram }}"><i class="fa fa-instagram" aria-hidden="true"></i></a></li>
              <li><a href="{{ $getSocial->linkedin }}"><i class="fa fa-linkedin" aria-hidden="true"></i></a></li>
              <li><a href="{{ $getSocial->facebook }}"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
              <li><a href="{{ $getSocial->youtube }}"><i class="fa fa-youtube-play" aria-hidden="true"></i></a></li>
            </ul>
          </div>
          </div>
        </div>
        <div class="col-xl-3 col-md-4">
          <div class="foot-link">
            <ul>
              <li><a href="{{ url('/') }}/cms/our-story">Our Story</a></li>
              <li><a href="{{ url('/') }}/communities">Communities</a></li>
              <li><a href="{{ url('/') }}/cms/board-of-directors">Board of Directors</a></li>
            </ul>
          </div>
        </div>
        <div class="col-xl-3 col-md-4">
          <div class="foot-link">
            <ul>
              <li><a href="{{ url('/') }}/service">Services</a></li>
              <li><a href="{{ url('/') }}/media-center">Media Center</a></li>
              <li><a href="{{ url('/') }}/join-us">Join us</a></li>
            </ul>
          </div>
        </div>
        <div class="col-xl-3 col-md-4">
          <div class="foot-link">
            <ul>
            <li><a href="{{ url('/') }}/cms/governance">Governance</a></li>
              <li><a href="{{ url('/') }}/cms/terms-conditions">Terms & Conditions</a></li>
              <li><a href="{{ url('/') }}/cms/privacy-policy">Privacy Policy</a></li>
            </ul>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-md-12">
          <div class="foot-link mobile">
            <ul>
              <li><a href="{{ url('/') }}/cms/our-communities">Communities</a></li>
              <li><a href="{{ url('/') }}/service">Services</a></li>
              <li><a href="{{ url('/') }}/cms/media-center">Media Center</a></li>
              <li><a href="{{ url('/') }}/cms/terms-conditions">Terms & Conditions</a></li>
              <li><a href="{{ url('/') }}/cms/privacy-policy">Privacy Policy</a></li>
            </ul>
          </div>
        </div>
      </div>
    </div>
  </footer>
  


  <div class="nav-overlay"></div>

  <!-- jQuery first, then Popper.js, then Bootstrap JS -->
  <!-- <script src="https://code.jquery.com/jquery-1.12.4.min.js"></script>
  <script src="{{ asset('/front/en') }}/assets/js/owl.carousel.min.js"></script>
  <script src="https://unpkg.com/aos@next/dist/aos.js"></script>
  <script src="{{ asset('/front/en') }}/assets/js/custom.js"></script> -->

  <!-- jQuery first, then Popper.js, then Bootstrap JS -->
  <script src="https://code.jquery.com/jquery-1.12.4.min.js"></script>
  <script src="{{ asset('/front/en') }}/assets/js/bootstrap.min.js"></script>
  <script src="{{ asset('/front/en') }}/assets/js/owl.carousel.min.js"></script>
  <script src="https://unpkg.com/aos@next/dist/aos.js"></script>
  <script src="{{ asset('/front/en') }}/assets/js/custom.js"></script>
  <script src="{{ asset('/front/en') }}/assets/js/html5lightbox.js"></script>
  <script src="{{ asset('/front/en') }}/assets/js/timeline.js"></script>
  <script src="{{asset('assets/js/jquery.validate.js')}}"></script>

  <!--Start of Tawk.to Script-->
    <!--<script type="text/javascript">
    var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();
    (function(){
    var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
    s1.async=true;
    s1.src='https://embed.tawk.to/60dabf547f4b000ac03a118f/1f9b7mp7f';
    s1.charset='UTF-8';
    s1.setAttribute('crossorigin','*');
    s0.parentNode.insertBefore(s1,s0);
    })();
    </script>-->
    <!--End of Tawk.to Script-->
  </body>
</html>