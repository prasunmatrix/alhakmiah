@extends('front.en.layout.inner')
@section('page-content')


 

  <section class="news-wrapper-details">
    <div class="news-content">
       <h2>{{$blog['title_en']}}</h2>
       <div class="pic">
          
          @if (!empty($blog->blog_big_image))
          <img src="{{ asset('/assets/blog-images/big-image/') }}/{{ $blog['blog_big_image'] }}" alt="" style="width:640px;height:480px" >
        
          @else
          <img src="{{ asset('/admin/upload/common/no-image-found.jpg') }}" alt=""  >
          @endif
       </div>
       <div class="txt"> 
         {!! $blog['description_en'] !!}
       </div>            
    </div>         
 </section>
@endsection