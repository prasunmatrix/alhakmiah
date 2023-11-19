<?php $getSocial = \App\Models\Social::find('1'); ?>
<footer class="site-footer">
    <div class="container">
      <div class="row align-items-end">
        <div class="col-xl-3 col-md-12">
          <div class="foot-left">
            <div class="foot-logo">
              <a href="{{ url('/') }}/ar/home"><img src="{{ asset('assets/images/'.$getSocial->footer_logo.'') }}" alt=""></a>
            </div>
          <p> مركز رعاية العملاء <span><a href="tel:{{ $getSocial->phone }}">{{ $getSocial->phone }}</a></span></p>
          <p><span class="email"><a style="color: white;" href="mailto:{{ $getSocial->email }}">{{ $getSocial->email }}</a></span></p>
          <div class="footer-social">
              <ul>
                <li><a href="{{ $getSocial->twitter }}" target="_blank"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
                <li><a href="{{ $getSocial->instagram }}" target="_blank"><i class="fa fa-instagram" aria-hidden="true"></i></a></li>
                <li><a href="{{ $getSocial->linkedin }}" target="_blank"><i class="fa fa-linkedin" aria-hidden="true"></i></a></li>
                <li><a href="{{ $getSocial->facebook }}" target="_blank"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
                <li><a href="{{ $getSocial->youtube }}" target="_blank"><i class="fa fa-youtube-play" aria-hidden="true"></i></a></li>
            </ul>
          </div>
          </div>
        </div>
        <div class="col-xl-3 col-md-4">
          <div class="foot-link">
            <ul>
              <li><a href="{{ url('/') }}/ar/cms/our-story">قصتنا</a></li>
              <li><a href="{{ url('/') }}/ar/communities">مجتمعاتنا</a></li>
              <li><a href="{{ url('/') }}/ar/cms/board-of-directors">مجلس الإدارة</a></li>
            </ul>
          </div>
        </div>
        <div class="col-xl-3 col-md-4">
          <div class="foot-link">
            <ul>
              <li><a href="{{ url('/') }}/ar/service">خدماتنا</a></li>
              <li><a href="{{ url('/') }}/ar/media-center">المركز الإعلامي</a></li>
              {{--<li><a href="{{ url('/') }}/ar/join-us">انضم لنا( التوظيف )</a></li>--}}
              <li><a href="{{ url('/') }}/ar/join-us">انضم لنا</a></li>
            </ul>
          </div>
        </div>
        <div class="col-xl-3 col-md-4">
          <div class="foot-link">
            <ul>
            <li><a href="{{ url('/') }}/ar/cms/governance">الحوكمة</a></li>
              <li><a href="{{ url('/') }}/ar/cms/terms-conditions">الشروط والأحكام</a></li>
              <li><a href="{{ url('/') }}/ar/cms/privacy-policy">سياسة الخصوصية</a></li>
            </ul>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-md-12">
          <div class="foot-link mobile">
            <ul>
              <li><a href="{{ url('/') }}/ar/cms/our-communities">مجتمعاتنا</a></li>
              <li><a href="{{ url('/') }}/ar/service">خدماتنا</a></li>
              <li><a href="{{ url('/') }}/ar/cms/media-center">المركز الإعلامي</a></li>
              <li><a href="{{ url('/') }}/ar/cms/terms-conditions">الشروط والأحكام</a></li>
              <li><a href="{{ url('/') }}/ar/cms/privacy-policy">سياسة الخصوصية</a></li>
            </ul>
          </div>
        </div>
      </div>
    </div>
  </footer>


  <div class="nav-overlay"></div>

  <!-- jQuery first, then Popper.js, then Bootstrap JS -->
  <script src="https://code.jquery.com/jquery-1.12.4.min.js"></script>
  <script src="{{ asset('/front/ar') }}/assets/js/bootstrap.min.js"></script>
  <script src="{{ asset('/front/ar') }}/assets/js/owl.carousel.min.js"></script>
  <!--<script src="https://unpkg.com/aos@next/dist/aos.js"></script>-->
  <script src="{{ asset('/front/ar') }}/assets/js/custom.js"></script>
  <script src="{{ asset('/front/ar') }}/assets/js/timeline.js"></script>
  <script src="{{ asset('/front/en') }}/assets/js/html5lightbox.js"></script>
  <!--Start of Tawk.to Script-->
<!--<script type="text/javascript">
var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();
(function(){
var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
s1.async=true;
s1.src='https://embed.tawk.to/60d9eb8865b7290ac638549e/1f9besr97';
s1.charset='UTF-8';
s1.setAttribute('crossorigin','*');
s0.parentNode.insertBefore(s1,s0);
})();
</script>-->
<!--End of Tawk.to Script-->
  </body>
</html>

