@extends('admin.layouts.after-login-layout')


@section('unique-content')

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Project Management</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Dashboard</a></li>
              <li class="breadcrumb-item"><a href="{{route('admin.project.index')}}">Project List</a></li>
              <li class="breadcrumb-item active">{{$panel_title}}</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>
    <section class="content">
      <div class="container-fluid"> 
          <!-- SELECT2 EXAMPLE -->
        <div class="row">
            <div class="col-12">
                <div class="card card-primary">
                                <div class="card-header">
                                  <h3 class="card-title">{{$panel_title}}</h3>
                                </div>
          
                  <!-- /.card-header -->
                    <div class="card-body">
                        @if(count($errors) > 0)
                                <div class="alert alert-danger alert-dismissable">
                                    <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
                                    @foreach ($errors->all() as $error)
                                        <span>{{ $error }}</span><br/>
                                    @endforeach
                                </div>
                            @endif

                            @if(Session::has('success'))
                                <div class="alert alert-success alert-dismissable __web-inspector-hide-shortcut__">
                                    <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
                                    {{ Session::get('success') }}
                                </div>
                            @endif

                            @if(Session::has('error'))
                                <div class="alert alert-danger alert-dismissable">
                                    <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
                                    {{ Session::get('error') }}
                                </div>
                            @endif
                      <form action="{{route('admin.project.update')}}" method="POST" enctype="multipart/form-data" id="create_project">
                            {{ csrf_field() }}
                          <div class="row">
                             

                                <div class="card card-primary">
                                <div class="card-header">
                                  <h3 class="card-title">English</h3>
                                </div>
                              </div>
                              <div class="col-md-12">
                              
                                      <div class="form-group row">
                                      <label  class="col-sm-3 col-form-label"> Name En: <span class="error">*</span></label>
                                        <div class="col-sm-9">
                                          <input type="text" name="name" id="name" value="{{$projectDetail->name}}" class="form-control" placeholder="Name En" title="Name En" required>
                                        </div>
                                      </div>
                                      <div class="form-group row">
                                      <label  class="col-sm-3 col-form-label"> Slogan En: <span class="error">*</span></label>
                                        <div class="col-sm-9">
                                          <input type="text" name="slogan" id="slogan"  value="{{$projectDetail->slogan}}" class="form-control" placeholder="Slogan En" title="Slogan En" required>
                                        </div>
                                      </div>
                                      
                                      <div class="form-group row">
                                      <label  class="col-sm-3 col-form-label"> Heading En: <span class="error">*</span></label>
                                        <div class="col-sm-9">
                                          <input type="text" name="heading" id="heading" value="{{$projectDetail->heading}}" class="form-control" placeholder="Heading En" title="Heading En" required>
                                        </div>
                                      </div>
                                   
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">Content En: <span class="error">*</span> </label>
                                        <div class="col-sm-9">
                                        <textarea class="textarea" name="content" id="content" placeholder="Content En"
                                        style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"required>{{$projectDetail->content}}</textarea>
                                        </div>
                                    </div> 
                                    <div class="form-group row">
                                      <label class="col-sm-3 col-form-label">Short Description En: <span class="error">*</span> </label>
                                      <div class="col-sm-9">
                                      <textarea class="textarea" name="short_description_en" id="short_description_en" placeholder="Short Description En"
                                      style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;">{{$projectDetail->short_description_en}}</textarea>
                                      </div>
                                    </div>

                                   
                            <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Brochure & Reversation:</label>
                            <div class="col-sm-9">
                              <div class="alhakmia">
                                <ul class="tabs">
                                <li class="tab-link current" data-tab="tab-1">Brochure</li>
                                <li class="tab-link" data-tab="tab-2">Reversation</li>
                                </ul>
                              <div id="tab-1" class="tab-content current">
                                
                              <div class="form-group row" >
                                  {{--<div class="col-md-3"> 
                                    <input name="Brocher_en_chk" type="checkbox" value="1" @if($projectDetail->Brocher_en_chk == 1) checked @endif> Brocher will be display
                                  </div>--}}
                                  @if (!empty($projectDetail->brochure))
                                  <div id="brochure_{{$projectDetail->id}}">
                                      <div class="col-md-10">
                                          <a href="{{ asset('/admin/upload/project/brochure/english') }}/{{$projectDetail->brochure}}" target="_blank">{{$projectDetail->brochure}}</a>
                                          <input type="hidden" name="old_brochure"  id="old_brochure"  class="form-control" value="{{$projectDetail->brochure}}" required>

                                      </div>             
                                      <div class="col-md-2">
                                        <button style="background:red;border:none;color:white;border-radius:3px;" class="deletemedia" data-id="{{$projectDetail->id}}" data-source="brochure">Delete</button>
                                      </div> 
                                  </div>
                                  @endif
                                </div>  
                               


                                <div class="form-group row">    <!--- pdf upload -->
                                  <div class="col-md-6">
                                  <input type="file" name="brochure"  id="brochure"  class="form-control" accept="application/pdf">
                                  <span class="system required" style="color: red;">(Only pdf file allowed.)*
                                  </span>
                                  </div>
                                </div>    <!--- pdf upload -->                            
                              </div> <!--- tab 1 -->

                              <div id="tab-2" class="tab-content">
                                <div class="form-group row">
                                  <div class="col-md-4">
                                  <input name="reservation_en_chk" type="checkbox" value="1" @if($projectDetail->reservation_en_chk == 1) checked @endif> Online Reversation
                                  </div>
                                </div>
                              </div>
                               </div>
                              </div>
                            </div>

                                          <!--  <div class="form-group row">
                                              <label class="col-sm-3 col-form-label">Previous Brochure:</label>
                                              <div class="col-sm-9">

                                                <a href="{{ asset('/admin/upload/project/brochure/english') }}/{{$projectDetail->brochure}}" target="_blank">{{$projectDetail->brochure}}</a>
                                                <input type="hidden" name="old_brochure"  id="old_brochure"  class="form-control" value="{{$projectDetail->brochure}}" required>
                                              </div>
                                          </div>  -->
                                           

                                  <!--  <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">Brochure:</label>
                                        <div class="col-sm-9">
                                            <input type="file" name="brochure"  id="brochure"  class="form-control" accept="application/pdf">
                                            <span class="system required" style="color: red;">(Only pdf file allowed.)*
                                        </div>
                                      </div>
                                </div>-->

                                <div class="card card-primary">
                                <div class="card-header">
                                  <h3 class="card-title">Arabic</h3>
                                </div>
                              </div>
                              <div class="col-md-12">
                              
                                      <div class="form-group row">
                                        <label  class="col-sm-3 col-form-label"> Name Ar: <span class="error">*</span></label>
                                          <div class="col-sm-9">
                                            <input type="text" name="name_ar" id="name_ar" value="{{$projectDetail->name_ar}}" class="form-control" placeholder="Name Ar" title="Name Ar" required>
                                          </div>
                                      </div>
                                      <div class="form-group row">
                                      <label  class="col-sm-3 col-form-label"> Slogan Ar: <span class="error">*</span></label>
                                        <div class="col-sm-9">
                                          <input type="text" name="slogan_ar" id="slogan_ar"  value="{{$projectDetail->slogan_ar}}" class="form-control" placeholder="Slogan Ar" title="Slogan Ar" required>
                                        </div>
                                      </div>
                                      <div class="form-group row">
                                        <label  class="col-sm-3 col-form-label"> Heading Ar: <span class="error">*</span></label>
                                          <div class="col-sm-9">
                                            <input type="text" name="heading_ar" id="heading_ar" value="{{$projectDetail->heading_ar}}" class="form-control" placeholder="Heading Ar" title="Heading Ar" required>
                                          </div>
                                      </div>

                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">Content Ar: <span class="error">*</span> </label>
                                        <div class="col-sm-9">
                                        <textarea class="textarea" name="content_ar" id="content_ar" placeholder="Content Ar"
                                        style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;" required>{{$projectDetail->content_ar}}</textarea>
                                        </div>
                                    </div> 
                                    <div class="form-group row">
                                      <label class="col-sm-3 col-form-label">Short Description Ar: <span class="error">*</span> </label>
                                      <div class="col-sm-9">
                                      <textarea class="textarea" name="short_description_ar" id="short_description_ar" placeholder="Short Description Ar"
                                      style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;" required>{{$projectDetail->short_description_ar}}</textarea>
                                      </div>
                                    </div>

                               

                                    <div class="form-group row" >
                                              <label class="col-sm-3 col-form-label">Brochure & Reversation:</label>
                                            <div class="col-sm-9">
                                        <div class="alhakmia">
                                          <ul class="tabs">
                                            <li class="tab-link current" data-tab="tab-3">Brochure</li>
                                            <li class="tab-link" data-tab="tab-4">Reversation</li>
                                        </ul>
                            <div id="tab-3" class="tab-content current">                                          
                                <div class="form-group row">
                                      
                                <div class="col-md-6">          
                                      <input type="file" name="brochure_ar"  id="brochure_ar"  class="form-control" accept="application/pdf">
                                      <span class="system required" style="color: red;">(Only pdf file allowed.)*</span>
                                    </div>
                                  </div>
                                  
                                <div class="form-group row" >
                                    {{--<div class="col-md-3">    
                                      <input name="Brocher_ar_chk" type="checkbox" value="1" @if($projectDetail->Brocher_ar_chk == 1) checked @endif> Brocher will be display </div>--}}
                                      @if (!empty($projectDetail->brochure_ar))
                                      <div id="brochure_ar_{{$projectDetail->id}}">
                                    <div class="col-md-10">   
                                        <a href="{{ asset('/admin/upload/project/brochure/arabic') }}/{{$projectDetail->brochure_ar}}" target="_blank">{{$projectDetail->brochure_ar}}</a>
                                        <input type="hidden" name="old_brochure_ar"  id="old_brochure_ar"  class="form-control" value="{{$projectDetail->brochure_ar}}" required>
                                    </div>
                            <div class="col-md-2">   
                            <button style="background:red;border:none;color:white;border-radius:3px;" class="deletemedia" data-id="{{$projectDetail->id}}" data-source="brochure_ar">Delete</button>
                            </div>
                            </div>
                            @endif
                              </div> 
                         

                            </div><!--- tab 3 -->
                          <div id="tab-4" class="tab-content">
                            <div class="col-md-4">   
                            <input name="reservation_ar_chk" type="checkbox" value="1" @if($projectDetail->reservation_ar_chk == 1) checked @endif> Online Reversation
                          </div>
                          </div><!--- tab 4 -->
                        </div>  
                       </div>
                      </div> 
                                           <!-- <div class="form-group row">
                                              <label class="col-sm-3 col-form-label">Previous Brochure:</label>
                                              <div class="col-sm-9">

                                                <a href="{{ asset('/admin/upload/project/brochure/arabic') }}/{{$projectDetail->brochure_ar}}" target="_blank">{{$projectDetail->brochure_ar}}</a>
                                                <input type="hidden" name="old_brochure_ar"  id="old_brochure_ar"  class="form-control" value="{{$projectDetail->brochure_ar}}" required>
                                              </div>
                                          </div>  -->
                                           

                                    
                                    <!-- <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">Brochure:</label>
                                        <div class="col-sm-9">
                                            <input type="file" name="brochure_ar"  id="brochure_ar"  class="form-control" accept="application/pdf">
                                            <span class="system required" style="color: red;">(Only pdf file allowed.)*
                                        </div>

                                      </div> 
                                </div> -->

<!----------------- SEO start !-------->
<div class="card card-primary">
  <div class="card-header">
    <h3 class="card-title">SEO</h3>
  </div>
</div>

<div class="col-md-12">

    <div class="form-group row">
      <label  class="col-sm-3 col-form-label"> Meta Title En: </label>
      <div class="col-sm-9">
        <input type="text" name="meta_title" id="meta_title" class="form-control" value="{{ $projectDetail->meta_title }}"  placeholder="Meta Title En" title="Meta Title En">
      </div>
    </div>

    <div class="form-group row">
      <label  class="col-sm-3 col-form-label"> Meta Title Ar: </label>
      <div class="col-sm-9">
        <input type="text" name="meta_title_ar" id="meta_title_ar" class="form-control" value="{{ $projectDetail->meta_title_ar }}"  placeholder="Meta Title Ar" title="Meta Title Ar">
      </div>
    </div>
                                      
    <div class="form-group row">
      <label  class="col-sm-3 col-form-label"> Meta Descriptions En: </label>
        <div class="col-sm-9">
          <input type="text" name="meta_descriptions" id="meta_descriptions" class="form-control" value="{{ $projectDetail->meta_descriptions }}"  placeholder="Meta Descriptions En" title="Meta Descriptions En">
        </div>
    </div>

    <div class="form-group row">
      <label  class="col-sm-3 col-form-label"> Meta Descriptions Ar: </label>
        <div class="col-sm-9">
          <input type="text" name="meta_descriptions_ar" id="meta_descriptions_ar" class="form-control" value="{{ $projectDetail->meta_descriptions_ar }}"  placeholder="Meta Descriptions Ar" title="Meta Descriptions Ar">
        </div>
    </div>

    <div class="form-group row">
      <label  class="col-sm-3 col-form-label"> Meta Keyword En: </label>
        <div class="col-sm-9">
          <input type="text" name="meta_keyword" id="meta_keyword" class="form-control" value="{{ $projectDetail->meta_keyword }}"  placeholder="Meta Keyword En" title="Meta Keyword En">
        </div>
    </div>

    <div class="form-group row">
      <label  class="col-sm-3 col-form-label"> Meta Keyword Ar: </label>
        <div class="col-sm-9">
          <input type="text" name="meta_keyword_ar" id="meta_keyword_ar" class="form-control" value="{{ $projectDetail->meta_keyword_ar }}"  placeholder="Meta Keyword Ar" title="Meta Keyword Ar">
        </div>
    </div>

    <div class="form-group row">
      <label  class="col-sm-3 col-form-label"> Alt Text En: </label>
        <div class="col-sm-9">
          <input type="text" name="alt_text" id="alt_text" class="form-control"  value="{{ $projectDetail->alt_text }}" placeholder="Alt Text En" title="Alt Text En">
        </div>
    </div>

    <div class="form-group row">
      <label  class="col-sm-3 col-form-label"> Alt Text Ar: </label>
        <div class="col-sm-9">
          <input type="text" name="alt_text_ar" id="alt_text_ar" class="form-control"  value="{{ $projectDetail->alt_text_ar }}" placeholder="Alt Text Ar" title="Alt Text Ar">
        </div>
    </div>

    <div class="form-group row">
      <label  class="col-sm-3 col-form-label"> Canonical En: </label>
        <div class="col-sm-9">
          <input type="text" name="canonical" id="canonical" class="form-control"  value="{{ $projectDetail->canonical }}" placeholder="Canonical En" title="Canonical En">
        </div>
    </div>

    <div class="form-group row">
      <label  class="col-sm-3 col-form-label"> Canonical Ar: </label>
        <div class="col-sm-9">
          <input type="text" name="canonical_ar" id="canonical_ar" class="form-control"  value="{{ $projectDetail->canonical_ar }}" placeholder="Canonical Ar" title="Canonical Ar">
        </div>
    </div>

</div>  
<!----------------- SEO end !-------->
                                
                                <div class="card card-primary">
                                  <div class="card-header">
                                      <h3 class="card-title">General</h3>
                                    </div>
                                  </div>
                                  <div class="col-md-12">
                                    <div class="form-group row">
                                        <label  class="col-sm-3 col-form-label"> Page Slug: <span class="error"></span></label>
                                          <div class="col-sm-9">
                                            <input type="text" name="page_slug" id="page_slug" class="form-control" value="{{ $projectDetail->slug_name }}" placeholder="Page Slug" title="Page Slug">
                                            <span style="color: red;">{{ $errors->first('slugerror') }}</span>
                                            <span class="system required" style="color: red;">(If this field is blank it's taken english title by default slug)*</span>
                                          </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">JSON-LD:</label>
                                        <div class="col-sm-9">
                                          <textarea class="textarea" name="json_ld" id="json_ld" placeholder="JSON-LD" style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;">{{ $projectDetail->json_ld }}</textarea>
                                          <span class="system required" style="color: red;">(The text box contain must have "script" tag)*</span>
                                        </div>
                                    </div>
                                    {{--<div class="form-group row">
                                        <label class="col-sm-3 col-form-label">Global Site Tag:</label>
                                        <div class="col-sm-9">
                                            <textarea class="textarea" name="global_site_tag" id="global_site_tag" placeholder="Global Site Tag"
                                        style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;">{{ $projectDetail->global_site_tag }}</textarea>
                                        <span class="system required" style="color: red;">(The text box contain must have "script" tag)*</span>
                                        </div>
                                    </div>--}}
                                    <div class="form-group row">
                                        <label  class="col-sm-3 col-form-label"> Display Order: <span class="error">*</span></label>
                                          <div class="col-sm-9">
                                            <input type="text" name="display_order" id="display_order" class="form-control" value="{{ $projectDetail->display_order }}" placeholder=" Display Order" title=" Display Order" required>
                                          </div>
                                    </div> 

                                    @if (!empty($projectDetail->banner))
                                            <div class="form-group row">
                                                <label class="col-sm-3 col-form-label">Previous Banner:</label>
                                                <div class="col-sm-9">

                                                  <img src="{{ asset('/admin/upload/project/banner/thumbnail') }}/{{$projectDetail->banner}}" alt="">
                                                  <input type="hidden" name="old_banner"  id="old_banner"  class="form-control" value="{{$projectDetail->banner}}" required>
                                                </div>
                                            </div> 
                                            
                                    @endif

                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">Banner Image:</label>
                                        <div class="col-sm-9">
                                            <input type="file" name="banner_image"  id="banner_image"  class="form-control">
                                            <span class="system required" style="color: red;">(Recommended Image Size: 1530 &times; 830)*</span>
                                        </div>
                                      </div> 

                                      <div class="form-group row">
                                      <label  class="col-sm-3 col-form-label" >Selected Banner Images : </label>
                                      <div class="col-sm-9">
                                        <div class="row bannerImages" >
                                        
                                        </div>
                                      </div>
                                    </div>

                                    @if (!empty($projectDetail->mobile_banner_image))
                                           <div class="form-group row">
                                              <label class="col-sm-3 col-form-label">Previous Mobile Banner:</label>
                                              <div class="col-sm-9">

                                                <img src="{{ asset('/admin/upload/project/mobile_banner_image') }}/{{$projectDetail->mobile_banner_image}}" alt="" height="100" width="30%">
                                                <input type="hidden" name="old_banner1"  id="old_banner1"  class="form-control" value="{{$projectDetail->mobile_banner_image}}" required>
                                              </div>
                                          </div> 
                                           
                                    @endif

                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">Mobile Banner Image:</label>
                                        <div class="col-sm-9">
                                            <input type="file" name="mobile_banner_image"  id="mobile_banner_image"  class="form-control">
                                            <span class="system required" style="color: red;">(Recommended Image Size: 767 &times; 818)*</span>
                                        </div>
                                      </div>    

                                      <div class="form-group row">
                                      <label  class="col-sm-3 col-form-label" > </label>
                                      <div class="col-sm-9">
                                        <div class="row mobilebannerImages" >
                                        
                                        </div>
                                      </div>
                                    </div>  

                                    @if (!empty($projectDetail->featured_image))
                                      <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">Previous Featured Image:</label>
                                        <div class="col-sm-9">

                                          <img src="{{ asset('admin/upload/project/featured_image') }}/{{$projectDetail->featured_image}}" alt=""  height="100" width="30%"  >
                                          <input type="hidden" name="old_featured_image"  id="old_featured_image"  class="form-control" value="{{$projectDetail->featured_image}}" required>
                                        </div>
                                      </div>
                                    @endif

                                    <div class="form-group row">
                                      <label class="col-sm-3 col-form-label">Featured Image:</label>
                                      <div class="col-sm-9">
                                          <input type="file" name="featured_image"  id="featured_image"  class="form-control" @if($projectDetail->featured_image == null && $projectDetail->featured == '1') {{ 'required' }}   @endif>
                                      </div>
                                    </div> 
                                    <div class="form-group row">
                                      <!-- <label  class="col-sm-3 col-form-label" >Selected Slider-1 : </label> -->
                                      <div class="col-sm-9">
                                        <div class="row featuredImage" >
                                        
                                        </div>
                                      </div>
                                    </div>
                                    

                                      <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">Content Video:</label>
                                        <div class="col-sm-9">
                                            <textarea class="textarea" name="content_video" id="content_video" placeholder="Video embed code"
                                        style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;">{{$projectDetail->content_video}}</textarea>
                                        </div>
                                      </div>
                                  

                                    <div class="form-group row">
                                      <label  class="col-sm-3 col-form-label"> Map: <span class="error">*</span></label>
                                        <div class="col-sm-9">
                                          <textarea class="textarea" name="map" id="map" placeholder="Map embed code"
                                        style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;" required>{{$projectDetail->map}}</textarea>
                                        </div>
                                       
                                      </div>
                                     


                                    <div class="form-group row">
                                      <label  class="col-sm-3 col-form-label">Near To: <span class="error">*</span></label>
                                        <div class="col-sm-9">
                                        @php
                                          $nearToArray = explode(',',$projectDetail->near_to);
                                        @endphp
                        
                                          @foreach($nearData as $nd)
                                          <input type="checkbox" name="near_to[]" value="{{$nd->id}}" @if(in_array($nd->id, $nearToArray)) checked @endif> {{ $nd->near_name }}
                                          @endforeach
                                        </div>
                                      </div>

                                    <div class="form-group row">
                                      <label  class="col-sm-3 col-form-label">Services: <span class="error">*</span></label>
                                        <div class="col-sm-9">
                                        @php
                                          $serviceArray = explode(',',$projectDetail->services);
                                        @endphp
                                          @foreach($serviceData as $sd)
                                          <input type="checkbox" name="services[]" value="{{ $sd->id }}" @if(in_array($sd->id, $serviceArray)) checked @endif> {{ $sd->service_name }}
                                          @endforeach
                                        </div>
                                      </div>
                                     
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">Virtual Tour Image:</label>
                                        <div class="col-sm-9">
                                            <textarea class="textarea" name="virtual_toure_image" id="virtual_toure_image" placeholder="Virtual Tour Image embed code"
                                        style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;">{{$projectDetail->virtual_toure_image}}</textarea>
                                        </div>
                                      </div>


                                    <div class="form-group row">
                                        <label  class="col-sm-3 col-form-label" >Gallery : </label>
                                        <div class="col-sm-9">
                                          <div class="row homeImages" >
                                            @foreach ($projectGallery as $data )
                                              <!-- @php $chkd = ''; if ($data->is_checked == 'Y') $chkd = 'checked'; @endphp -->
                                              <div id="imageDiv20" class="col-sm-3">
                                                <img src="{{ asset('admin/upload/project/gallery/thumbnail/'.$data->gallery_image) }}" alt="" height="100" width="100%" id="brand_icon">
                                                <div style="margin-top: 5px;">
                                                  <div class="row">
                                                    <div class="col-sm-12">
                                                    <button style="background:red;border:none;color:white;border-radius:3px;" class="deletemedia" data-id="0" >
                                                        Delete
                                                    </button>
                                                      <input type="hidden" name="oldimg[]" value="{{$data->id}}"/>
                                                    </div>
                                                    <!-- <div class="col-sm-6">
                                                      <div style="text-align: right">
                                                        <input type="checkbox" name="galleryImage[{{ $data->id }}]" value="Y" {{ $chkd }} />
                                                      </div>
                                                    </div> -->
                                                  </div>
                                                </div>
                                              </div>
                                            @endforeach
                                          </div>
                                      </div>
                                    </div>


                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">Gallery Image:</label>
                                        <div class="col-sm-9">
                                            <input type="file" name="gallery_image[]"  id="image"  class="form-control" multiple>
                                            <span class="system required" style="color: red;">(Recommended Image Size: 800 &times; 600)*</span>
                                        </div>

                                    </div> 

                                    {{-- @if (!empty($projectDetail->project_logo)) --}}
                                    {{--<div class="form-group row">
                                       <label class="col-sm-3 col-form-label">Previous Project Logo:</label>
                                       <div class="col-sm-9">
                                        <div class="project-logo-bg">
                                         <img src="{{ asset('/admin/upload/project-logo/'.$projectDetail->project_logo.'') }}" alt="" height="100" width="30%" >
                                        </div>
                                       </div>
                                   </div>--}}  
                                  {{-- @endif --}}
                                    {{--<div class="form-group row">
                                      <label class="col-sm-3 col-form-label">Project Logo:</label>
                                      <div class="col-sm-9">
                                          <input type="file" name="project_logo"  id="project_logo"  class="form-control" >
                                          <span class="system required" style="color: red;">(Recommended Image Size: 100 &times; 100)*</span>
                                      </div>
                                    </div> 
                                    <div class="form-group row">
                                      <!-- <label  class="col-sm-3 col-form-label" >Selected Slider-1 : </label> -->
                                      <div class="col-sm-9">
                                        <div class="row projectlogo" >
                                        
                                        </div>
                                      </div>
                                    </div>--}}
                                    <!-- <div class="form-group row">
                                      <label  class="col-sm-3 col-form-label" >Selected Gallery Images : </label>
                                      <div class="col-sm-9">
                                        <div class="row projectImages" >
                                        
                                        </div>
                                      </div>
                                    </div>  -->

                                    <div class="form-group row">
                                      <label  class="col-sm-3 col-form-label">Project Status: <span class="error">*</span></label>
                                        <div class="col-sm-9">
                                          <select class="form-control select2 select2-danger select2bs4" name="project_status" data-dropdown-css-class="select2-danger" style="width: 100%;" required>
                                              <option value="" @if($projectDetail->project_status == '') selected @endif>Choose option</option>
                                              @foreach($statusData as $sd)
                                                  <option value="{{$sd->id}}" @if($projectDetail->project_status == $sd->id) selected @endif>{{$sd->status}}</option>
                                              @endforeach
                                          </select>
                                        </div>
                                      </div>

                                     <div class="form-group row">
                                      <label  class="col-sm-3 col-form-label">Project Type: <span class="error">*</span></label>
                                        <div class="col-sm-9">
                                          <select class="form-control select2 select2-danger select2bs4" name="type" data-dropdown-css-class="select2-danger" style="width: 100%;" required>
                                              <option value="" @if($projectDetail->type == '') selected @endif>Choose option</option>
                                              @foreach($typeData as $td)
                                                  <option value="{{$td->id}}" @if($projectDetail->type == $td->id) selected @endif>{{$td->type}}</option>
                                              @endforeach
                                          </select>
                                        </div>
                                      </div>

                                      

                                      <div class="form-group row">
                                      <label  class="col-sm-3 col-form-label">City: <span class="error">*</span></label>
                                        <div class="col-sm-9">
                                        <select class="form-control select2 select2-danger select2bs4" name="city" data-dropdown-css-class="select2-danger" style="width: 100%;" required>
                                            <option value="" @if($projectDetail->city == '') selected @endif>Choose option</option>
                                            @foreach($cityData as $city)
                                              <option value="{{$city->id}}" @if($projectDetail->city == $city->id) selected @endif>{{$city->name_en}}</option>
                                            @endforeach
                                        </select>
                                        </div>
                                      </div>

                                      <div class="form-group row">
                                      <label  class="col-sm-3 col-form-label">Bedroom: <span class="error">*</span></label>
                                        <div class="col-sm-9">
                                          <select class="form-control select2 select2-danger select2bs4" name="bedroom" data-dropdown-css-class="select2-danger" style="width: 100%;" required>
                                            <option value="" @if($projectDetail->bedroom == '') selected @endif>Choose option</option>
                                            <option value="1" @if($projectDetail->bedroom == '1') selected @endif>1</option>
                                            <option value="2" @if($projectDetail->bedroom == '2') selected @endif>2</option>
                                            <option value="3" @if($projectDetail->bedroom == '3') selected @endif>3</option>
                                            <option value="4" @if($projectDetail->bedroom == '4') selected @endif>4</option>
                                            <option value="5" @if($projectDetail->bedroom == '5') selected @endif>5</option>
                                            <option value="6" @if($projectDetail->bedroom == '6') selected @endif>6</option>
                                            <option value="7" @if($projectDetail->bedroom == '7') selected @endif>7</option>
                                            <option value="8" @if($projectDetail->bedroom == '8') selected @endif>8</option>
                                            <option value="9" @if($projectDetail->bedroom == '9') selected @endif>9</option>
                                            <option value="10" @if($projectDetail->bedroom == '10') selected @endif>10</option>
                                        </select>
                                        </div>
                                      </div>

                                      <div class="form-group row">
                                      <label  class="col-sm-3 col-form-label">Space: <span class="error">*</span></label>
                                        <div class="col-sm-9">
                                          <select class="form-control select2 select2-danger select2bs4" name="space" data-dropdown-css-class="select2-danger" style="width: 100%;" required>
                                            <option value="" @if($projectDetail->space == '') selected @endif>Choose option</option>
                                            <option value="100" @if($projectDetail->space == '100') selected @endif>100</option>
                                            <option value="150" @if($projectDetail->space == '150') selected @endif>150</option>
                                            <option value="200" @if($projectDetail->space == '200') selected @endif>200</option>
                                            <option value="250" @if($projectDetail->space == '250') selected @endif>250</option>
                                            <option value="300" @if($projectDetail->space == '300') selected @endif>300</option>
                                            <option value="350" @if($projectDetail->space == '350') selected @endif>350</option>
                                            <option value="400" @if($projectDetail->space == '400') selected @endif>400</option>
                                            <option value="500" @if($projectDetail->space == '500') selected @endif>500</option>
                                            <option value="600" @if($projectDetail->space == '600') selected @endif>600</option>
                                            <option value="700" @if($projectDetail->space == '700') selected @endif>700</option>
                                            <option value="800" @if($projectDetail->space == '800') selected @endif>800</option>
                                            <option value="900" @if($projectDetail->space == '900') selected @endif>900</option>
                                            <option value="1000" @if($projectDetail->space == '1000') selected @endif>1000</option>
                                        </select>
                                        </div>
                                      </div>
                                        
                                      

                                  </div>
                                </div>

                                    

                                      <!-- Unit section -->
                                      <!--<div class="form-group row">
                                        <label class="col-sm-3 col-form-label">Unit:<span class="error">*</span></label>
                                        <div class="col-sm-9">
                                           <a href="javascript::void(0);" onClick="addUnit()">Add</a> 
                                        </div>
                                      </div> 

                                      <div class="form-group row">
                                      <label  class="col-sm-3 col-form-label"> Unit Name En: <span class="error">*</span></label>
                                        <div class="col-sm-9">
                                          <input type="text" name="unit_name" id="unit_name" class="form-control" placeholder="Unit Name En" title="Unit Name En">
                                        </div>
                                      </div>
                                      <div class="form-group row">
                                        <label  class="col-sm-3 col-form-label"> Unit Name Ar: <span class="error">*</span></label>
                                          <div class="col-sm-9">
                                            <input type="text" name="unit_name_ar" id="unit_name_ar" class="form-control" placeholder="Unit Name Ar" title="Unit Name Ar">
                                          </div>
                                      </div>


                                      <div class="form-group row">
                                      <label  class="col-sm-3 col-form-label"> Unit Subheading En: <span class="error">*</span></label>
                                        <div class="col-sm-9">
                                          <input type="text" name="unit_subheading" id="unit_subheading" class="form-control" placeholder="Unit Subheading En" title="Unit Subheading En">
                                        </div>
                                      </div>
                                      <div class="form-group row">
                                        <label  class="col-sm-3 col-form-label"> Unit Subheading Ar: <span class="error">*</span></label>
                                          <div class="col-sm-9">
                                            <input type="text" name="unit_subheading_ar" id="unit_subheading_ar" class="form-control" placeholder="Unit Subheading Ar" title="Unit Subheading Ar">
                                          </div>
                                      </div>


                                      <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">Unit Content En: <span class="error">*</span> </label>
                                        <div class="col-sm-9">
                                        <textarea class="textarea" name="unit_content" id="unit_content" placeholder="Unit Content En"
                                        style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"></textarea>
                                        </div>
                                    </div> 

                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">Unit Content Ar: <span class="error">*</span> </label>
                                        <div class="col-sm-9">
                                        <textarea class="textarea" name="unit_content_ar" id="unit_content_ar" placeholder="Unit Content Ar"
                                        style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"></textarea>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">Unit Image:<span class="error">*</span></label>
                                        <div class="col-sm-9">
                                            <input type="file" name="unit_image[]"  id="unit_image"  class="form-control" multiple>
                                        </div>
                                    </div> 
                                    <div class="form-group row">
                                      <label  class="col-sm-3 col-form-label" >Selected Unit Images : </label>
                                      <div class="col-sm-9">
                                        <div class="row unitImages" >
                                        
                                        </div>
                                      </div>
                                    </div> 


                                  <div class="form-group row"  id="faqUnit">
                                      
                                  </div>-->


                                    
                                  <!-- project gallery -->
                                  

                                  <!-- faq -->

                                  <!--<div class="form-group row">
                                        <label class="col-sm-3 col-form-label">FAQ:<span class="error">*</span></label>
                                        <div class="col-sm-9">
                                           <a href="javascript::void(0);" onClick="addFaq()">Add</a> 
                                        </div>
                                    </div> 

                                  <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">FAQ Question (En):<span class="error">*</span></label>
                                        <div class="col-sm-9">
                                            <input type="text" name="question[]" id="question" class="form-control" placeholder="FAQ Question En" title="FAQ Question En">
                                        </div>
                                  </div> 
                                  <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">FAQ Question (Ar):<span class="error">*</span></label>
                                        <div class="col-sm-9">
                                            <input type="text" name="question_ar[]" id="question_ar" class="form-control" placeholder="FAQ Question En" title="FAQ Question En">
                                        </div>
                                  </div>

                                  <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">FAQ Answer (En):<span class="error">*</span></label>
                                        <div class="col-sm-9">
                                            <input type="text" name="answer[]" id="answer" class="form-control" placeholder="FAQ Answer En" title="FAQ Answer En">
                                        </div>
                                  </div> 
                                  <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">FAQ Answser (Ar):<span class="error">*</span></label>
                                        <div class="col-sm-9">
                                            <input type="text" name="answer_ar[]" id="answer_ar" class="form-control" placeholder="FAQ Question En" title="FAQ Answer En">
                                        </div>
                                  </div>



                                  <div class="form-group row"  id="faqAdd">
                                      
                                  </div>-->

                                  @if (!empty($projectDetail->video_thumbnail_image))
                                           <div class="form-group row">
                                              <label class="col-sm-3 col-form-label">Video Thumbnail Image:</label>
                                              <div class="col-sm-9">
                                                <img src="{{ asset('/admin/upload/project/video_thumbnail_image') }}/{{$projectDetail->video_thumbnail_image}}" alt="" height="100" width="30%">
                                              </div>
                                          </div> 
                                  @endif

                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">Video Thumbnail Image:</label>
                                        <div class="col-sm-9">
                                            <input type="file" name="video_thumbnail_image"  id="video_thumbnail_image"  class="form-control">
                                            <span class="system required" style="color: red;">(Recommended Image Size: 729 &times; 401)*</span>
                                        </div>
                                      </div> 

                                    <div class="col-sm-9">
                                    <div class="card-footer">
                                      <div class="">
                                      <input type="hidden" name="project_id" value="{{$projectDetail->id}}">
                                          <a class="btn btn-primary back_new" href="{{route('admin.project.index')}}">Back</a>
                                          <button id="" type="submit" class="btn btn-success submit_new">Update</button>
                                      </div>
                                    </div>
                                  </div>
                              </div>
                          </div>
                              
                      </form>
                </div>
              </div>
            </div>
      </div>
    </section>
    
</div>
@endsection 
 
@push('custom-scripts')

<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script src="{{asset('assets/plugins/toastr/toastr.min.js')}}"></script>

<script>
 // $(function () {
 //    // Summernote
 //    $('.textarea').summernote()
 //  })  

CKEDITOR.replace('content',{
	filebrowserBrowseUrl: '/alhakmiah/public/assets/plugins/ckeditor/ckfinder/ckfinder.html',
	filebrowserUploadUrl: '/alhakmiah/public/assets/plugins/ckeditor/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files'
});
CKEDITOR.replace('short_description_en',{
	filebrowserBrowseUrl: '/alhakmiah/public/assets/plugins/ckeditor/ckfinder/ckfinder.html',
	filebrowserUploadUrl: '/alhakmiah/public/assets/plugins/ckeditor/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files'
});
CKEDITOR.replace('content_ar',{
	filebrowserBrowseUrl: '/alhakmiah/public/assets/plugins/ckeditor/ckfinder/ckfinder.html',
	filebrowserUploadUrl: '/alhakmiah/public/assets/plugins/ckeditor/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files'
});
CKEDITOR.replace('short_description_ar',{
	filebrowserBrowseUrl: '/alhakmiah/public/assets/plugins/ckeditor/ckfinder/ckfinder.html',
	filebrowserUploadUrl: '/alhakmiah/public/assets/plugins/ckeditor/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files'
});
$(function () {
  //Initialize Select2 Elements
  $('.select2bs4').select2({
          theme: 'bootstrap4'
  })  
})

function readURL1(input) {
      let filesArray = input.files;
      if (filesArray && filesArray.length > 0) {
        for(i = 0;i < filesArray.length; i++ ){
          var reader = new FileReader();
            reader.onload = function(e) {
              $('.homeImages').append('<div id="imageDiv20" class="col-sm-3"><img src="'+e.target.result+'" alt="" height="100" width="100%" id="brand_icon"><div style="margin-top: 5px;"><div class="row"><div class="col-sm-6"><button style="background:red;border:none;color:white;border-radius:3px;" class="deletemedia" data-id="0" >Delete</button></div><div class="col-sm-6"><div style="text-align: right"><!--<input type="checkbox" alt="" name="upload_image[]" value="Y" ></div></div></div></div></div>');
            }
            reader.readAsDataURL(filesArray[i]);
        }
      }
  }

  $("#image").change(function() {
      readURL1(this);
  });

function readURL(input, place, counter) {
      let filesArray = input.files;
      if (filesArray && filesArray.length > 0) {
        for(i = 0;i < filesArray.length; i++ ){
          var reader = new FileReader();
            reader.onload = function(e) {
              if(counter == 1)
              {
                $('.'+place).append('<div id="imageDiv20" class="col-sm-3"><img src="'+e.target.result+'" alt="" height="100" width="100%" id="brand_icon"><div style="margin-top: 5px;"><div class="row"><div class="col-sm-6"><button style="background:red;border:none;color:white;border-radius:3px;" class="deletemedia" data-id="0" >Delete</button></div><!--<div class="col-sm-6"><div style="text-align: right"><input type="checkbox" alt="" name="upload_banner_image[]" value="Y" ></div></div>--></div></div></div>');
              }
              else
              {
                $('.'+place).html('<div id="imageDiv20" class="col-sm-3"><img src="'+e.target.result+'" alt="" height="100" width="100%" id="brand_icon"><div style="margin-top: 5px;"><div class="row"><div class="col-sm-6"><button style="background:red;border:none;color:white;border-radius:3px;" class="deletemedia" data-id="0" >Delete</button></div><!--<div class="col-sm-6"><div style="text-align: right"><input type="checkbox" alt="" name="upload_banner_image[]" value="Y" ></div></div>--></div></div></div>');
              }
              
            }
            reader.readAsDataURL(filesArray[i]);
        }
      }
  }

  function readURL2(input, place, counter) {
      let filesArray = input.files;
      if (filesArray && filesArray.length > 0) {
        for(i = 0;i < filesArray.length; i++ ){
          var reader = new FileReader();
            reader.onload = function(e) {
              if(counter == 1)
              {
                $('.'+place).append('<div id="imageDiv202" class="col-sm-3"><img src="'+e.target.result+'" alt="" height="100" width="100%" id="brand_icon"><div style="margin-top: 5px;"><div class="row"><div class="col-sm-6"><button style="background:red;border:none;color:white;border-radius:3px;" class="deletemedia" data-id="0" >Delete</button></div><!--<div class="col-sm-6"><div style="text-align: right"><input type="checkbox" alt="" name="upload_banner_image[]" value="Y" ></div></div>--></div></div></div>');
              }
              else
              {
                $('.'+place).html('<div id="imageDiv202" class="col-sm-3"><img src="'+e.target.result+'" alt="" height="100" width="100%" id="brand_icon"><div style="margin-top: 5px;"><div class="row"><div class="col-sm-6"><button style="background:red;border:none;color:white;border-radius:3px;" class="deletemedia" data-id="0" >Delete</button></div><!--<div class="col-sm-6"><div style="text-align: right"><input type="checkbox" alt="" name="upload_banner_image[]" value="Y" ></div></div>--></div></div></div>');
              }
              
            }
            reader.readAsDataURL(filesArray[i]);
        }
      }
  }
  // $("#gallery_image").change(function() {
  //     readURL(this, 'projectImages',1);
  // });

  $("#unit_image").change(function() {
      readURL(this, 'unitImages',1);
  });

  $("#banner_image").change(function() {
      readURL(this, 'bannerImages',0);
  });

  $("#mobile_banner_image").change(function() {
      readURL2(this, 'mobilebannerImages',0);
  });

  $("#content_image").change(function() {
      readURL(this, 'contentImages',0);
  });

  $("#virtual_tour_image").change(function() {
      readURL(this, 'vtImages',0);
  });
  $("#featured_image").change(function() {
      readURL(this, 'featuredImage',0);
  });

  /*$(document).on('click','.deletemedia',function(e){
            e.preventDefault();
            swal({
                title: "Are you sure?",
                text: "Do you want to delete the media ?",
                icon: "warning",
                buttons: true,
                dangerMode: true,
                })
            .then((trueResponse ) => {
                if (trueResponse) {
                  var  pdfId = $(this).attr('data-id'); 
                    var  pdfsource = $(this).attr('data-source');


                  let  imageDivId = $(this).attr('data-id');
                  if(imageDivId != 0 || pdfsource != 0){
                    
                    var fdata = new FormData();
                    fdata.append("_token","{{ csrf_token() }}");
  //alert(pdfsource);                  
  if(typeof pdfsource !== 'undefined') {
    //alert('enter into if block');
           fdata.append("pdfId",pdfId);
          fdata.append("pdfsource",pdfsource);
  var ajaxurlchk = "{{ route('admin.project.project-pdf-delete') }}";
  } 
  fdata.append("encryptId",$(this).attr('data-encrypt'));
  //var ajaxurlchk = "{{ route('admin.cms-management.cms-image-delete') }}";

                   // fdata.append("encryptId",$(this).attr('data-encrypt'));

                    $.ajax({
                        type: "POST",
                        contentType: false,
                        processData: false, 
                        //url: ajaxurlchk,
                        url: "{{ route('admin.cms-management.cms-image-delete') }}",
                        data: fdata,
                        success: function(response)
                        {
                          var pdf_datadel = JSON.parse(response);
                             alert(response.has_error); 
                            if(response.has_error == 0){
                                $(document).Toasts('create', {
                                        class: 'bg-info', 
                                        title: 'Success',
                                        body: response.msg,
                                        delay: 3000,
                                        autohide:true
                                });
                                // alert(imageDivId);
                               $('#imageDiv'+imageDivId+'').remove();
                            } else if(pdf_datadel.has_error == 0) { 
                                   $('#'+pdfsource+'_'+pdfId).remove();
                                 } else {
                                $(document).Toasts('create', {
                                        class: 'bg-danger', 
                                        title: 'Error',
                                        body: response.msg,
                                        delay: 3000,
                                        autohide:true
                                });
                            }
                        }
                    });
                  } else{
                    $(this).parent().parent().parent().parent().remove();
                    $(document).Toasts('create', {
                                        class: 'bg-info', 
                                        title: 'Success',
                                        body: "Successfully Removed.",
                                        delay: 3000,
                                        autohide:true
                                });
                  }
                    
                } 
            });    
          });*/

$(document).on('click','.deletemedia',function(e){
  e.preventDefault();
  swal({
      title: "Are you sure?",
      text: "Do you want to delete the media ?",
      icon: "warning",
      buttons: true,
      dangerMode: true,
      })
  .then((trueResponse ) => {
      if (trueResponse) {
        var  pdfId = $(this).attr('data-id'); 
        var  pdfsource = $(this).attr('data-source');
        //alert(pdfId);
        //alert(pdfsource);

        let  imageDivId = $(this).attr('data-id');
        if(imageDivId != 0 || typeof pdfsource !== 'undefined'){
          
          var fdata = new FormData();
          fdata.append("_token","{{ csrf_token() }}");
          
          if(typeof pdfsource !== 'undefined') {
            //alert('enter into if block');
                  fdata.append("pdfId",pdfId);
                  fdata.append("pdfsource",pdfsource);
          var ajaxurlchk = "{{ route('admin.project.project-pdf-delete') }}";
          }
          else{
            fdata.append("encryptId",$(this).attr('data-encrypt'));
            var ajaxurlchk = "{{ route('admin.cms-management.cms-image-delete') }}";
          }  
          //console.log(ajaxurlchk);
          $.ajax({
              type: "POST",
              contentType: false,
              processData: false, 
              //url: "{{ route('admin.cms-management.cms-image-delete') }}",
              url: ajaxurlchk,
              data: fdata,
              success: function(response)
              {
                var pdf_datadel = JSON.parse(response);  
                if(response.has_error == 0){
                      $(document).Toasts('create', {
                              class: 'bg-info', 
                              title: 'Success',
                              body: response.msg,
                              delay: 3000,
                              autohide:true
                      });
                      // alert(imageDivId);
                      $('#imageDiv'+imageDivId+'').remove();
                  }else if(pdf_datadel.has_error == 0) { 
                                   $('#'+pdfsource+'_'+pdfId).remove();
                                 } else {
                      $(document).Toasts('create', {
                              class: 'bg-danger', 
                              title: 'Error',
                              body: response.msg,
                              delay: 3000,
                              autohide:true
                      });
                  }
              }
          });
        } else{
          $(this).parent().parent().parent().parent().remove();
          $(document).Toasts('create', {
                              class: 'bg-info', 
                              title: 'Success',
                              body: "Successfully Removed.",
                              delay: 3000,
                              autohide:true
                      });
        }
          
      } 
  });    
});         

//Integer and decimal
$.validator.addMethod("valid_number", function(value, element) {
    if (/^[0-9]\d*(\.\d+)?$/.test(value)) {
        return true;
    } else {
        return false;
    }
});
$("#project_logo").change(function() {
      readURL(this, 'projectlogo',0);
  });
$('.alhakmia ul.tabs li').click(function(){
    var tab_id = $(this).attr('data-tab');

    $('.alhakmia ul.tabs li').removeClass('current');
    $('.alhakmia .tab-content').removeClass('current');

    $(this).addClass('current');
    $("#"+tab_id).addClass('current');
  })
</script>
@endpush