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
                      <form action="{{route('admin.project.save')}}" method="POST" enctype="multipart/form-data" id="create_project">
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
                                          <input type="text" name="name" id="name" class="form-control" placeholder="Name En" title="Name En">
                                        </div>
                                      </div>
                                      <div class="form-group row">
                                      <label  class="col-sm-3 col-form-label"> Slogan En: <span class="error">*</span></label>
                                        <div class="col-sm-9">
                                          <input type="text" name="slogan" id="slogan" class="form-control" placeholder="Slogan En" title="Slogan En">
                                        </div>
                                      </div>
                                      
                                      <div class="form-group row">
                                      <label  class="col-sm-3 col-form-label"> Heading En: <span class="error">*</span></label>
                                        <div class="col-sm-9">
                                          <input type="text" name="heading" id="heading" class="form-control" placeholder="Heading En" title="Heading En">
                                        </div>
                                      </div>
                                    
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">Content En: <span class="error">*</span> </label>
                                        <div class="col-sm-9">
                                        <textarea class="textarea" name="content" id="content" placeholder="Content En"
                                        style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"></textarea>
                                        </div>
                                    </div> 
                                    <div class="form-group row">
                                      <label class="col-sm-3 col-form-label">Short Description En: <span class="error">*</span> </label>
                                      <div class="col-sm-9">
                                      <textarea class="textarea" name="short_description_en" id="short_description_en" placeholder="Short Description En"
                                      style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"></textarea>
                                      </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">Brochure:</label>
                                        <div class="col-sm-9">
                                            <input type="file" name="brochure"  id="brochure"  class="form-control" accept="application/pdf" >
                                            <span class="system required" style="color: red;">(Only pdf file allowed.)*
                                        </div>
                                      </div>
                                </div>
                                <div class="card card-primary">
                                <div class="card-header">
                                  <h3 class="card-title">Arabic</h3>
                                </div>
                              </div>
                              <div class="col-md-12">
                              
                                      <div class="form-group row">
                                        <label  class="col-sm-3 col-form-label"> Name Ar: <span class="error">*</span></label>
                                          <div class="col-sm-9">
                                            <input type="text" name="name_ar" id="name_ar" class="form-control" placeholder="Name Ar" title="Name Ar">
                                          </div>
                                      </div>
                                       <div class="form-group row">
                                      <label  class="col-sm-3 col-form-label"> Slogan Ar: <span class="error">*</span></label>
                                        <div class="col-sm-9">
                                          <input type="text" name="slogan_ar" id="slogan_ar" class="form-control" placeholder="Slogan Ar" title="Slogan Ar">
                                        </div>
                                      </div>
                                      
                                      <div class="form-group row">
                                        <label  class="col-sm-3 col-form-label"> Heading Ar: <span class="error">*</span></label>
                                          <div class="col-sm-9">
                                            <input type="text" name="heading_ar" id="name_ar" class="form-control" placeholder="Heading Ar" title="Heading Ar">
                                          </div>
                                      </div>

                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">Content Ar: <span class="error">*</span> </label>
                                        <div class="col-sm-9">
                                        <textarea class="textarea" name="content_ar" id="content_ar" placeholder="Content Ar"
                                        style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"></textarea>
                                        </div>
                                    </div> 
                                    <div class="form-group row">
                                      <label class="col-sm-3 col-form-label">Short Description Ar: <span class="error">*</span> </label>
                                      <div class="col-sm-9">
                                      <textarea class="textarea" name="short_description_ar" id="short_description_ar" placeholder="Short Description Ar"
                                      style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"></textarea>
                                      </div>
                                    </div>
                                    
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">Brochure:</label>
                                        <div class="col-sm-9">
                                            <input type="file" name="brochure_ar"  id="brochure_ar"  class="form-control"  accept="application/pdf">
                                            <span class="system required" style="color: red;">(Only pdf file allowed.)*
                                        </div>
                                      </div> 
                                </div>

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
        <input type="text" name="meta_title" id="meta_title" class="form-control"  placeholder="Meta Title En" title="Meta Title En">
      </div>
    </div>

    <div class="form-group row">
      <label  class="col-sm-3 col-form-label"> Meta Title Ar: </label>
      <div class="col-sm-9">
        <input type="text" name="meta_title_ar" id="meta_title_ar" class="form-control"  placeholder="Meta Title Ar" title="Meta Title Ar">
      </div>
    </div>
                                      
    <div class="form-group row">
      <label  class="col-sm-3 col-form-label"> Meta Descriptions En: </label>
        <div class="col-sm-9">
          <input type="text" name="meta_descriptions" id="meta_descriptions" class="form-control"  placeholder="Meta Descriptions En" title="Meta Descriptions En">
        </div>
    </div>

    <div class="form-group row">
      <label  class="col-sm-3 col-form-label"> Meta Descriptions Ar: </label>
        <div class="col-sm-9">
          <input type="text" name="meta_descriptions_ar" id="meta_descriptions_ar" class="form-control"  placeholder="Meta Descriptions Ar" title="Meta Descriptions Ar">
        </div>
    </div>

    <div class="form-group row">
      <label  class="col-sm-3 col-form-label"> Meta Keyword En: </label>
        <div class="col-sm-9">
          <input type="text" name="meta_keyword" id="meta_keyword" class="form-control"  placeholder="Meta Keyword En" title="Meta Keyword En">
        </div>
    </div>

    <div class="form-group row">
      <label  class="col-sm-3 col-form-label"> Meta Keyword Ar: </label>
        <div class="col-sm-9">
          <input type="text" name="meta_keyword_ar" id="meta_keyword_ar" class="form-control"  placeholder="Meta Keyword Ar" title="Meta Keyword Ar">
        </div>
    </div>

    <div class="form-group row">
      <label  class="col-sm-3 col-form-label"> Alt Text En: </label>
        <div class="col-sm-9">
          <input type="text" name="alt_text" id="alt_text" class="form-control"  placeholder="Alt Text En" title="Alt Text En">
        </div>
    </div>

    <div class="form-group row">
      <label  class="col-sm-3 col-form-label"> Alt Text Ar: </label>
        <div class="col-sm-9">
          <input type="text" name="alt_text_ar" id="alt_text_ar" class="form-control"  placeholder="Alt Text Ar" title="Alt Text Ar">
        </div>
    </div>

    <div class="form-group row">
      <label  class="col-sm-3 col-form-label"> Canonical En: </label>
        <div class="col-sm-9">
          <input type="text" name="canonical" id="canonical" class="form-control"  placeholder="Canonical En" title="Canonical En">
        </div>
    </div>

    <div class="form-group row">
      <label  class="col-sm-3 col-form-label"> Canonical Ar: </label>
        <div class="col-sm-9">
          <input type="text" name="canonical_ar" id="canonical_ar" class="form-control"  placeholder="Canonical Ar" title="Canonical Ar">
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
                                          <input type="text" name="page_slug" id="page_slug" class="form-control"  placeholder="Page Slug" title="Page Slug">
                                          <span style="color: red;">{{ $errors->first('slugerror') }}</span>
                                          <span class="system required" style="color: red;">(If this field is blank it's taken english title by default slug)*</span>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                          <label  class="col-sm-3 col-form-label"> Display Order: <span class="error">*</span></label>
                                            <div class="col-sm-9">
                                              <input type="text" name="display_order" id="display_order" class="form-control"  placeholder="Display Order" title="Display Order">
                                            </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">Banner Image:<span class="error">*</span></label>
                                        <div class="col-sm-9">
                                            <input type="file" name="banner_image"  id="banner_image"  class="form-control">
                                            <span class="system required" style="color: red;">(Recommended Image Size: 1530 &times; 830)*</span>
                                        </div>
                                      </div> 

                                      <div class="form-group row">
                                      <label  class="col-sm-3 col-form-label" ></label>
                                      <div class="col-sm-9">
                                        <div class="row bannerImages" >
                                        
                                        </div>
                                      </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">Mobile Banner Image:<span class="error">*</span></label>
                                        <div class="col-sm-9">
                                            <input type="file" name="mobile_banner_image"  id="mobile_banner_image"  class="form-control">
                                            <span class="system required" style="color: red;">(Recommended Image Size: 767 &times; 818)*</span>
                                        </div>
                                      </div> 

                                      <div class="form-group row">
                                      <label  class="col-sm-3 col-form-label" ></label>
                                      <div class="col-sm-9">
                                        <div class="row mobilebannerImages" >
                                        
                                        </div>
                                      </div>
                                    </div>
                                    

                                      <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">Content Video:</label>
                                        <div class="col-sm-9">
                                            <textarea class="textarea" name="content_video" id="content_video" placeholder="Video embed code"
                                        style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"></textarea>
                                        </div>
                                        </div>
                              

                                    <div class="form-group row">
                                      <label  class="col-sm-3 col-form-label"> Map: <span class="error">*</span></label>
                                        <div class="col-sm-9">
                                          <textarea class="textarea" name="map" id="map" placeholder="Map embed code"
                                        style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"></textarea>
                                        </div>
                                       
                                      </div>
                                    
                                    <div class="form-group row">
                                      <label  class="col-sm-3 col-form-label">Near To: <span class="error">*</span></label>
                                        <div class="col-sm-9">
                                          <!-- <input type="checkbox" name="near_to[]" value="Riyadh Front"> Riyadh Front
                                          <input type="checkbox" name="near_to[]" value="University"> University
                                          <input type="checkbox" name="near_to[]" value="Airport"> Airport
                                          <input type="checkbox" name="near_to[]" value="Railway"> Railway -->
                                          @foreach($nearData as $nd)
                                          <input type="checkbox" name="near_to[]" id="near_to" value="{{$nd->id}}"> {{ $nd->near_name }}
                                          @endforeach
                                        </div>
                                      </div>

                                    <div class="form-group row">
                                      <label  class="col-sm-3 col-form-label">Services: <span class="error">*</span></label>
                                        <div class="col-sm-9">
                                          <!-- <input type="checkbox" name="services[]" value="Playgrounds"> Playgrounds
                                          <input type="checkbox" name="services[]" value="Security Escorts"> Security Escorts
                                          <input type="checkbox" name="services[]" value="Closed Mall"> Closed Mall
                                          <input type="checkbox" name="services[]" value="Driver Room"> Driver Room
                                          <input type="checkbox" name="services[]" value="Gym"> Gym
                                          <input type="checkbox" name="services[]" value="Swimming Pool"> Swimming Pool -->
                                          @foreach($serviceData as $sd)
                                          <input type="checkbox" name="services[]" id="services" value="{{ $sd->id }}"> {{ $sd->service_name }}
                                          @endforeach
                                        </div>
                                      </div>
                                     
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">Virtual Tour Image:</label>
                                        <div class="col-sm-9">
                                            <textarea class="textarea" name="virtual_toure_image" id="virtual_toure_image" placeholder="Virtual Tour Image embed code"
                                        style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"></textarea>
                                        </div>
                                      </div>
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">Gallery Image:</label>
                                        <div class="col-sm-9">
                                            <input type="file" name="gallery_image[]"  id="gallery_image"  class="form-control" multiple>
                                            <span class="system required" style="color: red;">(Recommended Image Size: 800 &times; 600)*</span>
                                        </div>

                                    </div> 
                                    <div class="form-group row">
                                      <label  class="col-sm-3 col-form-label" ></label>
                                      <div class="col-sm-9">
                                        <div class="row projectImages" >
                                        
                                        </div>
                                      </div>
                                    </div> 
                                    {{--<div class="form-group row">
                                      <label class="col-sm-3 col-form-label">Project Logo:</label>
                                      <div class="col-sm-9">
                                          <input type="file" name="project_logo"  id="project_logo"  class="form-control" >
                                          <span class="system required" style="color: red;">(Recommended Image Size: 100 &times; 100)*</span>
                                      </div>

                                  </div>--}} 

                                    <div class="form-group row">
                                      <label  class="col-sm-3 col-form-label">Project Status: <span class="error">*</span></label>
                                        <div class="col-sm-9">
                                         <select class="form-control select2 select2-danger select2bs4" name="project_status" id="project_status" data-dropdown-css-class="select2-danger" style="width: 100%;" required>
                                            <option value="">Choose option</option>
                                            @foreach($statusData as $sd)
                                              <option value="{{$sd->id}}">{{$sd->status}}</option>
                                            @endforeach
                                          </select>
                                        </div>
                                      </div>

                                     <div class="form-group row">
                                      <label  class="col-sm-3 col-form-label">Project Type: <span class="error">*</span></label>
                                        <div class="col-sm-9">
                                         <select class="form-control select2 select2-danger select2bs4" name="type" id="type" data-dropdown-css-class="select2-danger" style="width: 100%;" required>
                                            <option value="">Choose option</option>
                                            @foreach($typeData as $td)
                                              <option value="{{$td->id}}">{{$td->type}}</option>
                                            @endforeach
                                          </select>
                                        </div>
                                      </div>


                                      <div class="form-group row">
                                      <label  class="col-sm-3 col-form-label">City: <span class="error">*</span></label>
                                        <div class="col-sm-9">
                                          <select class="form-control select2 select2-danger select2bs4" name="city" id="city" data-dropdown-css-class="select2-danger" style="width: 100%;" required>
                                            <option value="">Choose option</option>
                                            @foreach($cityData as $city)
                                              <option value="{{$city->id}}">{{$city->name_en}}</option>
                                            @endforeach
                                        </select>
                                        </div>
                                      </div>

                                      <div class="form-group row">
                                      <label  class="col-sm-3 col-form-label">Bedroom: <span class="error">*</span></label>
                                        <div class="col-sm-9">
                                          <select class="form-control select2 select2-danger select2bs4" name="bedroom" id="bedroom" data-dropdown-css-class="select2-danger" style="width: 100%;" required>
                                            <option value="">Choose option</option>
                                            <option value="1">1</option>
                                            <option value="2">2</option>
                                            <option value="3">3</option>
                                            <option value="4">4</option>
                                            <option value="5">5</option>
                                            <option value="6">6</option>
                                            <option value="7">7</option>
                                            <option value="8">8</option>
                                            <option value="9">9</option>
                                            <option value="10">10</option>
                                        </select>
                                        </div>
                                      </div>

                                      <div class="form-group row">
                                      <label  class="col-sm-3 col-form-label">Space: <span class="error">*</span></label>
                                        <div class="col-sm-9">
                                          <select class="form-control select2 select2-danger select2bs4" name="space" id="space" data-dropdown-css-class="select2-danger" style="width: 100%;" required>
                                            <option value="">Choose option</option>
                                            <option value="100">100</option>
                                            <option value="150">150</option>
                                            <option value="200">200</option>
                                            <option value="250">250</option>
                                            <option value="300">300</option>
                                            <option value="350">350</option>
                                            <option value="400">400</option>
                                            <option value="400">500</option>
                                            <option value="400">600</option>
                                            <option value="400">700</option>
                                            <option value="400">800</option>
                                            <option value="400">900</option>
                                            <option value="1000">1000</option>
                                        </select>
                                        </div>
                                      </div>
                                        
                                      <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">View Status: <span class="error">*</span></label>
                                        <div class="col-sm-9">
                                        <select class="form-control select2 select2-danger select2bs4" name="status" data-dropdown-css-class="select2-danger" style="width: 100%;" required>
                                            <option value="1" selected="">Active</option>
                                            <option value="0">Inactive</option>
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

                                  <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">Video Thumbnail Image:<span class="error"></span></label>
                                        <div class="col-sm-9">
                                            <input type="file" name="video_thumbnail_image"  id="video_thumbnail_image"  class="form-control">
                                            <span class="" style="color: red;">(Recommended Image Size: 729 &times; 401)*</span>
                                        </div>
                                      </div>  

                                    
                                    <div class="card-footer">
                                      <div class="">
                                          <a class="btn btn-primary back_new" href="{{route('admin.project.index')}}">Back</a>
                                          <button id="" type="submit" class="btn btn-success submit_new">Add</button>
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

$(function () {
  //Initialize Select2 Elements
  $('.select2bs4').select2({
          theme: 'bootstrap4'
  })  
})

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

  function readURL1(input, place, counter) {
      let filesArray = input.files;
      if (filesArray && filesArray.length > 0) {
        for(i = 0;i < filesArray.length; i++ ){
          var reader = new FileReader();
            reader.onload = function(e) {
              if(counter == 1)
              {
                $('.'+place).append('<div id="imageDiv201" class="col-sm-3"><img src="'+e.target.result+'" alt="" height="100" width="100%" id="brand_icon"><div style="margin-top: 5px;"><div class="row"><div class="col-sm-6"><button style="background:red;border:none;color:white;border-radius:3px;" class="deletemedia" data-id="0" >Delete</button></div><!--<div class="col-sm-6"><div style="text-align: right"><input type="checkbox" alt="" name="upload_banner_image[]" value="Y" ></div></div>--></div></div></div>');
              }
              else
              {
                $('.'+place).html('<div id="imageDiv201" class="col-sm-3"><img src="'+e.target.result+'" alt="" height="100" width="100%" id="brand_icon"><div style="margin-top: 5px;"><div class="row"><div class="col-sm-6"><button style="background:red;border:none;color:white;border-radius:3px;" class="deletemedia" data-id="0" >Delete</button></div><!--<div class="col-sm-6"><div style="text-align: right"><input type="checkbox" alt="" name="upload_banner_image[]" value="Y" ></div></div>--></div></div></div>');
              }
              
            }
            reader.readAsDataURL(filesArray[i]);
        }
      }
  }

  $("#gallery_image").change(function() {
      readURL(this, 'projectImages',1);
  });

  $("#unit_image").change(function() {
      readURL(this, 'unitImages',1);
  });

  $("#banner_image").change(function() {
      readURL(this, 'bannerImages',0);
  });

  $("#mobile_banner_image").change(function() {
    readURL1(this, 'mobilebannerImages',0);
  });

  $("#content_image").change(function() {
      readURL(this, 'contentImages',0);
  });

  $("#virtual_tour_image").change(function() {
      readURL(this, 'vtImages',0);
  });

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
                  let  imageDivId = $(this).attr('data-id');
                  if(imageDivId != 0){
                    
                    var fdata = new FormData();
                    fdata.append("_token","{{ csrf_token() }}");
                    fdata.append("encryptId",$(this).attr('data-encrypt'));

                    $.ajax({
                        type: "POST",
                        contentType: false,
                        processData: false, 
                        url: "{{ route('admin.cms-management.cms-image-delete') }}",
                        data: fdata,
                        success: function(response)
                        {
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
$("#create_project").validate({
    rules: {
      name: {
            required: true,  
        },
        heading:{
            required: true,
        },
        slogan:{
            required: true,
        },
        slogan_ar:{
            required: true,
        },
        heading_ar:{
            required: true,
        },
        short_description_en:{
            required: true,
        },
        short_description_ar:{
            required: true,
        },
        name_ar: {
            required: true,      
        },
        content: {
            required: true,
                 
        },
        content_ar: {
            required: true,
                 
        },
        /*brochure:{
            required: true,
        },
        brochure_ar:{
            required: true,
        },*/
        banner_image:{
            required: true,
        },
        mobile_banner_image:{
            required: true,
        },
        /* content_video:{
            required: true,
        },*/
        map:{
            required: true,
        }, 
        near_to:{
            required: true,
        }, 
        services:{
            required: true,
        }, 
        /*virtual_toure_image:{
            required: true,
        },*/  
        gallery_image:{
            required: true,
        }, 
        project_status:{
            required: true,
        },
        type:{
            required: true,
        },
        city:{
            required: true,
        },
        bedroom:{
            required: true,
        },
        space:{
            required: true,
        },
        display_order:{
            required: true,
        },
        status:{
            required:true,
        },

    },
    messages: {
      name: {
            required:  "This field is required", 
        },
        heading: {
            required:  "This field is required", 
        },
        slogan: {
            required:  "This field is required", 
        },
        slogan_ar: {
            required:  "This field is required", 
        },
        heading_ar: {
            required:  "This field is required", 
        },
        short_description_en: {
            required:  "This field is required", 
        },
        short_description_ar: {
            required:  "This field is required", 
        },
        name_ar: {
            required:  "This field is required",  
        },
        content: {
            required:  "This field is required", 
        },
        content_ar: {
            required:  "This field is required",
        },
        /*brochure: {
            required:  "This field is required",  
        },
        brochure_ar: {
            required:  "This field is required",  
        },*/
        banner_image: {
            required:  "This field is required",  
        },
        mobile_banner_image: {
            required:  "This field is required",  
        },
        /*content_video: {
            required:  "This field is required",  
        },*/
        map: {
            required:  "This field is required",  
        },

        near_to: {
            required:  "This field is required",  
        },
        services: {
            required:  "This field is required",  
        },
        /*virtual_toure_image: {
            required:  "This field is required",  
        },*/
        gallery_image: {
            required:  "This field is required",  
        },
        project_status: {
            required:  "This field is required",  
        },
         type: {
            required:  "This field is required",  
        },

        city: {
            required:  "This field is required",  
        },

        bedroom: {
            required:  "This field is required",  
        },
        space: {
            required:  "This field is required",  
        },
        display_order: {
            required:  "This field is required",  
        },
       status:{
          required: "This field is required"  
       }   
    },
    errorElement: 'span',
        // errorPlacement: function (error, element) {
        // error.addClass('invalid-feedback');
        // element.closest('.form-group').append(error);
        // },
        highlight: function (element, errorClass, validClass) {
        $(element).addClass('is-invalid');
        },
        unhighlight: function (element, errorClass, validClass) {
        $(element).removeClass('is-invalid');
        },
    submitHandler: function(form) {
        form.submit();
    }
});
</script>
@endpush

      

         
         
              
             

                

     