@extends('front.ar.layout.inner')
@section('page-content')
<section class="hero-banner alt inner_banner" data-aos="fade-up" data-aos-delay="1000">
   @if (!empty($cmsPage['banner_image']))
   <img src="{{ asset('assets/cms/banner_images/'.$cmsPage['banner_image'].'') }}" alt="">
   @else
   <img src="{{ asset('/admin/upload/common/no-image-found.jpg') }}" alt="">
   @endif
   <div class="container">
      <div class="inner_banner_txt">
         <h2 data-aos="fade-up" data-aos-delay="300">{{$cmsPage['page_title_ar']}}</h2>
      </div>
   </div>
</section>
@if ($cmsPage['slug_name']!='our-brand' && $cmsPage['slug_name']!='our-brands')
<section class="about_content">
   <div class="container">
      <div class="row">
         <div class="col-lg-12">
            <div class="our-story">
               <h2>{{$cmsPage['name_ar']  }}</h2>
               {!!$cmsPage['description_ar']!!}
               
            <?php
            if( !empty($cmsPage['brochure_ar']) && !empty($cmsPage['brochure_label_ar']) )
            {
            ?>
              <p>
                <a class="dwnbtnall" href="{{ asset('assets/cms/brochure/brochure_ar') }}/{{$cmsPage['brochure_ar']}}" target="_blank  n">{{ $cmsPage['brochure_label_ar']  }}</a>
              </p>
            <?php
            } 
            else if( !empty($cmsPage['brochure_ar']) )
            {
            ?>
            <p>
              <a class="dwnbtnall" href="{{ asset('assets/cms/brochure/brochure_ar') }}/{{$cmsPage['brochure_ar']}}" target="_blank  n">تحميل</a>
            </p>
            <?php
            }
            else{}
            ?>
            </div>
         </div>
      </div>
   </div>
</section>
@endif
@if ($cmsPage['slug_name']=='board-of-directors' || $cmsPage['slug_name']=='executive-management')
<section class="cms-tab">
   <div class="container">
      <div class="row">
         <div class="col-lg-12">
            <ul class="nav nav-pills al-hakiam_tabList" id="ceo-tab" role="tablist">
               <?php
                  $i=0;
                  $class="";
                  $act="";
                  foreach($category as $cat)
                  {
                    $i++;
                    if($i==1)
                    {
                      $class="active";
                      $act="true";
                    }
                    else{
                      $class="";
                      $act="false";
                    }
                  ?>  
               <li class="nav-item">
                  <a class="nav-link <?php echo $class; ?>" id="<?php echo $cat->id; ?>-tab" data-toggle="pill" href="#<?php echo $cat->id; ?>" role="tab" aria-controls="<?php echo $cat->id; ?>" aria-selected="<?php echo $act; ?>"><?php echo $cat->name_ar; ?></a>
               </li>
               <?php } ?>
               <?php
                  foreach($subcategories as $subcat)
                  {
                    
                      $class_sub="";
                      $act_sub="false";
                    
                  ?>  
               <li class="nav-item">
                  <a class="nav-link <?php echo $class_sub; ?>" id="<?php echo $subcat->id; ?>-tab" data-toggle="pill" href="#<?php echo $subcat->id; ?>" role="tab" aria-controls="<?php echo $subcat->id; ?>" aria-selected="<?php echo $act_sub; ?>"><?php echo $subcat->name_ar; ?></a>
               </li>
               <?php } ?>
               <!--<li class="nav-item">
                  <a class="nav-link" id="pills-management-tab" data-toggle="pill" href="#pills-management" role="tab" aria-controls="pills-management" aria-selected="false">Executive Management</a>
                  </li>-->
            </ul>
            <div class="tab-content al-hakiam_tabContent" id="pills-tabContent">
               <?php
                  $catId='';
                  $catId2='';
                  $j=0;
                  $classnew="";
                  $anotherclassnew="";
                  foreach($position as $details)
                  {
                    $catId2=$details->cat_id;
                    if($catId!=$details->cat_id)
                    {
                      $catId= $details->cat_id;
                      
                      $j++;
                      if($j==1)
                      {
                        $classnew="active";
                        $anotherclassnew="show";
                        ?>
               <div class="tab-pane fade show active" id="<?php echo $details->cat_id; ?>" role="tabpanel" aria-labelledby="<?php echo $details->cat_id; ?>-tab">
                  <div class="list-row">
                     <?php 
                        }
                        else{
                          $classnew="";
                          $anotherclassnew="";
                          ?>
                  </div>
               </div>
               <div class="tab-pane fade" id="<?php echo $details->cat_id; ?>" role="tabpanel" aria-labelledby="<?php echo $details->cat_id; ?>-tab">
                  <div class="list-row">
                     <?php
                        }
                        ?>
                     <!--<div class="tab-pane fade <?php //echo $anotherclassnew; ?> <?php //echo $classnew; ?>" id="<?php //echo $details->cat_id; ?>" role="tabpanel" aria-labelledby="<?php //echo $details->cat_id; ?>-tab">
                        <div class="list-row">-->
                     <?php 
                        }
                        ?>
                     <div class="item">
                        <div class="pic"><img src="{{ asset('/admin/upload/ceo_image') }}/{{ $details->image }}" alt=""></div>
                        <h4><?php echo  $details->name_ar; ?></h4>
                        <h5><?php echo  $details->designation_ar; ?></h5>
                        <p><?php echo  $details->description_ar; ?></p>
                     </div>
                     <?php if( $catId2!= $catId){
                        ?>
                  </div>
               </div>
               <?php 
                  } }?>
               <?php
                  $catIdSub='';
                  $catIdSub2='';
                  $classnew="";
                  $anotherclassnew="";
                  foreach($sub_position as $details)
                  {
                    $catIdSub2=$details->subcat_id;
                    if($catIdSub!=$details->subcat_id)
                    {
                      $catIdSub= $details->subsubcat_id;
                      
                      
                        $classnew="";
                        $anotherclassnew="";
                        ?>
            </div>
         </div>
         <div class="tab-pane fade" id="<?php echo $details->subcat_id; ?>" role="tabpanel" aria-labelledby="<?php echo $details->subcat_id; ?>-tab">
            <div class="list-row">
               <?php 
                  }
                  ?>
               <div class="item">
                  <div class="pic"><img src="{{ asset('/admin/upload/ceo_image') }}/{{ $details->image }}" alt=""></div>
                  <h4><?php echo  $details->name_ar; ?></h4>
                  <h5><?php echo  $details->designation_ar; ?></h5>
                  <p><?php echo  $details->description_ar; ?></p>
               </div>
               <?php if( $catIdSub2!= $catIdSub){
                  ?>
            </div>
         </div>
         <?php 
            } }?>
      </div>
   </div>
   </div>
   </div>
</section>
@endif

@if ($cmsPage['slug_name']=='company-committes')
<section class="cms-tab">
   <div class="container">
      <div class="row">
         <div class="col-lg-12">
            <ul class="nav nav-pills al-hakiam_tabList" id="ceo-tab" role="tablist">
            <?php
                $i=0;
                $class="";
                $act="";
                foreach($subcategories as $subcat)
                {
                  $i++;
                  if($i==1)
                  {
                    $class="active";
                    $act="true";
                  }
                  else
                  {
                    $class="";
                    $act="false";
                  }
                ?>  
               <li class="nav-item">
                  <a class="nav-link <?php echo $class; ?>" id="<?php echo $subcat->id; ?>-tab" data-toggle="pill" href="#<?php echo $subcat->id; ?>" role="tab" aria-controls="<?php echo $subcat->id; ?>" aria-selected="<?php echo $act; ?>"><?php echo $subcat->name_ar; ?></a>
               </li>
               <?php }   ?>
            </ul>
            <div class="tab-content al-hakiam_tabContent" id="pills-tabContent">
            <?php
                $j=0;
                $classNew="";
                foreach($subcategories as $subcat)
                {
                  $j++;
                  if($j==1)
                  {
                    $classNew="show active";
                  }
                  else
                  {
                    $classNew="";
                  }
                ?>  
               <div class="tab-pane fade <?php echo $classNew; ?>" id="<?php echo $subcat->id; ?>" role="tabpanel" aria-labelledby="<?php echo $subcat->id; ?>-tab">
                  <div class="list-row">
                  <?php
                  
                  foreach($sub_position as $index=>$details)
                  {
                    if($subcat->id!=$details->subcat_id) continue;
                  ?>
                    <div class="item">
                      <div class="pic"><img src="{{ asset('/admin/upload/ceo_image') }}/{{ $details->image }}" alt=""></div>
                      <h4><?php echo  $details->name_ar; ?></h4>
                      <h5><?php echo  $details->designation_ar; ?></h5>
                      <p><?php echo  $details->description_ar; ?></p>
                    </div>
                    <?php } ?> 
                  </div>
               </div>
               <?php } ?> 
            </div>
         </div>
      </div>
   </div>
</section>
@endif

@if ($cmsPage['slug_name']=='our-brand' ||  $cmsPage['slug_name']=='our-brands') 
<section class="brand-list">
   <div class="container">
      <div class="row">
         <div class="col-lg-12">
          <h2>{{ $cmsPage['name_ar']  }}</h2>
            <ul>
            @foreach($brandlist as $brands)
            <?php
              $brandExtension=$brands->brochure;
              $ext=explode(".",$brandExtension);
            ?>
               <li>
                  <div class="brand-logo">
                  <?php
                  //if( isset($ext[1]) && $ext[1] == 'mp3')
                  if (!empty($brands->mpthree))
                  { 
                   ?>
                        <a data-fancybox="s" data-type="video" data-src="{{ asset('assets/brand-mpthree/'.$brands->mpthree) }}">
                          <img src="{{ asset('assets/brand-images/'.$brands->press_image) }}" />
                        </a>
                   <?php
                  }else{
                    ?>
                  <a href="{{ asset('assets/brand-images/'.$brands->press_image) }}" data-fancybox="s"><img src="{{ asset('assets/brand-images/'.$brands->press_image) }}" alt="" class="width-100"></a>
                  <?php
                  }
                  ?>  
                  </div>
                  <a href="{{ asset('assets/brand-brochure/'.$brands->brochure) }}" class="btn-brand" target="_blank  n" download>{{$brands->title_ar}}</a>
               </li>
            @endforeach   
            </ul>

            <!-- <div class="brand-btn">
              <div class="top-btn">
                <a href="#"><img src="{{ asset('/front/ar') }}/assets/images/brand-btn-2-lg.png" alt=""></a>
                <a href="#"><img src="{{ asset('/front/ar') }}/assets/images/brand-btn-1-lg.png" alt=""></a>                
              </div>
              <div class="bottom-btn"><a href="#"><img src="{{ asset('/front/ar') }}/assets/images/brand-btn-3-lg.png" alt=""></a></div>
            </div> -->
         </div>
      </div>
   </div>
</section>
@endif
@if(!empty($_GET['key']))
 <section class="brand-list">
    <div class="container">
      <div class="row">
        <div class="col-lg-12">
          <div class="brand-btn">
            <div class="top-btn">
              <a href="#" class="btn-download1">
                <div class="icon1"><img src="{{ asset('/front/ar') }}/assets/images/icon-download.png" alt=""></div>
                <div class="txt">تحميل  </div>
                <div class="icon2"><img src="{{ asset('/front/ar') }}/assets/images/icon-music.png" alt=""></div>
              </a>
              <a href="#" class="btn-download1">
                <div class="icon1"><img src="{{ asset('/front/ar') }}/assets/images/icon-play.png" alt=""></div>
                <div class="txt">تحميل  </div>
                <div class="icon2"><img src="{{ asset('/front/ar') }}/assets/images/icon-music.png" alt=""></div>
              </a>               
            </div>
            <div class="bottom-btn">
              <a href="#" class="btn-download2">
                <div class="icon1"><img src="{{ asset('/front/ar') }}/assets/images/icon-download.png" alt=""></div>
                <div class="txt">تحميل  </div>
                <div class="icon2"><img src="{{ asset('/front/ar') }}/assets/images/logo-white.png" alt=""></div>
              </a>
            </div>
          </div>
        </div>
      </div>
    </div>
 </section>        
 @endif 
<script>
   $(document).ready(function(){
     $('.nav-link').click(function(){
       var cid=$(this).prop('id').split('-')[0];
       $('.tab-pane').each(function(){
         $(this).removeClass('active').removeClass('show');
         if($(this).prop('id')==cid){
           $(this).addClass('active').addClass('show');
         }
       });
     })
   });
</script>  
@endsection
