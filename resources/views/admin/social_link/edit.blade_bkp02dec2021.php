@extends('admin.layouts.after-login-layout')


@section('unique-content')

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Social</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Dashboard</a></li>
              <li class="breadcrumb-item"><a href="">Social List</a></li>
              </a>
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
                      <form action="{{route('admin.social.update')}}" method="POST" enctype="multipart/form-data" id="edit_social">
                            {{ csrf_field() }}
                            <input type="hidden" name="encString" value="{{ $encryptCode }}">
                                  <div class="row">

                                    <div class="card card-primary">
                                      <div class="card-header">
                                        <h3 class="card-title">Social Settings</h3>
                                      </div>
                                    </div>

                                    <div class="col-md-12"> 
                                      <div class="form-group row">
                                        <label  class="col-sm-3 col-form-label"> Facebook: <span class="error">*</span></label>
                                          <div class="col-sm-9">
                                            <input type="url" name="facebook" id="facebook" class="form-control" value="{{ $details->facebook}}" placeholder="facebook link" title="facebook link">
                                          </div>
                                        </div>
                                      </div>
                                

                                    <div class="col-md-12"> 
                                      <div class="form-group row">
                                        <label  class="col-sm-3 col-form-label"> YouTube: <span class="error">*</span></label>
                                          <div class="col-sm-9">
                                            <input type="url" name="youtube" id="youtube" class="form-control" value="{{ $details->youtube}}" placeholder="youtube link" >
                                          </div>
                                        </div>
                                      </div>
                                 
                                    <div class="col-md-12"> 
                                      <div class="form-group row">
                                        <label  class="col-sm-3 col-form-label"> Linkedin: <span class="error">*</span></label>
                                          <div class="col-sm-9">
                                            <input type="url" name="linkedin" id="linkedin" class="form-control" value="{{ $details->linkedin}}" placeholder="linkedin link" title="linkedin link">
                                          </div>
                                        </div>
                                      </div>
                                    
                                    <div class="col-md-12"> 
                                      <div class="form-group row">
                                        <label  class="col-sm-3 col-form-label"> Instagram: <span class="error">*</span></label>
                                          <div class="col-sm-9">
                                            <input type="url" name="instagram" id="instagram" class="form-control" value="{{ $details->instagram}}" placeholder="instagram link" title="instagram link">
                                          </div>
                                        </div>
                                      </div>
                                   
                                
                                    <div class="col-md-12"> 
                                      <div class="form-group row">
                                        <label  class="col-sm-3 col-form-label">Twitter: <span class="error">*</span></label>
                                          <div class="col-sm-9">
                                            <input type="url" name="twitter" id="twitter" class="form-control" value="{{ $details->twitter}}" placeholder="twitter link" title="twitter link">
                                          </div>
                                        </div>
                                      </div>
                               
                                     <div class="col-md-12"> 
                                      <div class="form-group row">
                                        <label  class="col-sm-3 col-form-label">Whatsapp: <span class="error">*</span></label>
                                          <div class="col-sm-9">
                                            <input type="text" name="whatsapp" id="whatsapp" class="form-control" value="{{ $details->whatsapp}}" placeholder="whatsapp link" title="whatsapp link">
                                          </div>
                                        </div>
                                      </div>

                                      <div class="col-md-12"> 
                                      <div class="form-group row">
                                        <label  class="col-sm-3 col-form-label">Footer Email: <span class="error">*</span></label>
                                          <div class="col-sm-9">
                                             <input type="email" name="email" id="email" class="form-control" value="{{ $details->email}}" placeholder="Email" title="email">
                                        </div>
                                          </div>
                                      </div>
                                      
                                      <div class="col-md-12"> 
                                      <div class="form-group row">
                                        <label  class="col-sm-3 col-form-label">Phone: <span class="error">*</span></label>
                                          <div class="col-sm-9">
                                             <input type="text" name="phone" id="phone" class="form-control" value="{{ $details->phone}}" placeholder="Phone" title="phone">
                                        </div>
                                          </div>
                                      </div>
                                     
                                      <div class="card card-primary">
                                        <div class="card-header">
                                          <h3 class="card-title">Header Logo Settings</h3>
                                        </div>
                                      </div>
                                    
                                      
                                      &nbsp;&nbsp;&nbsp;
                                      @if (!empty($details->header_logo))
                                      <div class="col-md-12"> 
                                           <div class="form-group row">
                                              <label class="col-sm-3 col-form-label">Header Current Image:</label>
                                              <div class="col-sm-9">

                                                <img src="{{ asset('assets/images/'.$details->header_logo.'') }}" alt="">
                                                
                                              </div>
                                          </div> 
                                        </div>
                                           
                                      @endif

                                      <div class="col-md-12"> 
                                      <div class="form-group row">
                                        <label  class="col-sm-3 col-form-label">Header Logo: <span class="error">*</span></label>
                                          <div class="col-sm-9">
                                             <input type="file" name="header_logo" id="header_logo" class="form-control" value="{{ $details->header_logo}}" placeholder="Email" title="header_logo"  accept="image/gif, image/jpeg, image/png" />
                                        </div>
                                          </div>
                                      </div>
                                      
                                      <div class=" card card-primary">
                                        <div class="card-header">
                                          <h3 class="card-title"> Footer Logo Settings </h3>
                                        </div>
                                      </div>
                                      &nbsp; &nbsp; &nbsp;
                                      @if (!empty($details->footer_logo))
                                      <div class="col-md-12"> 
                                           <div class="form-group row">
                                              <label class="col-sm-3 col-form-label"> Footer Current Image: </label>
                                              <div class="col-sm-9">

                                                <img src="{{ asset('assets/images/'.$details->footer_logo.'') }}" alt="" >
                                                
                                              </div>
                                          </div> 
                                        </div>
                                  @endif
                                      <div class="col-md-12"> 
                                      <div class="form-group row">
                                        <label  class="col-sm-3 col-form-label">Footer Logo: <span class="error">*</span></label>
                                          <div class="col-sm-9">
                                             <input type="file" name="footer_logo" id="footer_logo" class="form-control" value="{{ $details->footer_logo}}" placeholder="Email" title="footer_logo"  accept="image/gif, image/jpeg, image/png" />
                                        </div>
                                          </div>
                                      </div>
                                   
                                          <div class=" card card-primary">
                                            <div class="card-header">
                                              <h3 class="card-title"> Email Settings </h3>
                                            </div>
                                          </div>
                                          <div class="col-md-12"> 
                                            <div class="form-group row">
                                              <label  class="col-sm-3 col-form-label">Contact Us Email: <span class="error">*</span></label>
                                                <div class="col-sm-9">
                                                   <input type="email" name="contact_us_email" id="contact_us_email" class="form-control" value="{{ $details->contact_us_email}}" placeholder="Contact Us Email" title="Contact Us Email">
                                              </div>
                                                </div>
                                            </div>

                                            <div class="col-md-12"> 
                                              <div class="form-group row">
                                                <label  class="col-sm-3 col-form-label">Join Us Email: <span class="error">*</span></label>
                                                  <div class="col-sm-9">
                                                     <input type="email" name="join_us_email" id="join_us_email" class="form-control" value="{{ $details->join_us_email}}" placeholder="Join Us Email" title="Join Us Email">
                                                </div>
                                                  </div>
                                              </div>

                                              <div class="col-md-12"> 
                                              <div class="form-group row">
                                                <label  class="col-sm-3 col-form-label">Project Email: <span class="error">*</span></label>
                                                  <div class="col-sm-9">
                                                     <input type="email" name="project_email" id="project_email" class="form-control" value="{{ $details->project_email}}" placeholder="Project Email" title="Project Email">
                                                </div>
                                                  </div>
                                              </div>

                                              <div class="col-md-12" style="display: none"> 
                                                <div class="form-group row">
                                                  <label class="col-sm-3 col-form-label">Status: <span class="error">*</span></label>
                                                  <div class="col-sm-9">
                                                  <select class="form-control select2 select2-danger select2bs4" name="status" data-dropdown-css-class="select2-danger" style="width: 100%;">
                                                      <option value="">Choose option</option>
                                                      <option value="A" {{ $details->status == 'A' ? 'selected' : '' }}>Active</option>
                                                      <option value="I" {{ $details->status == 'I' ? 'selected' : '' }} >Inactive</option>
                                                  </select>
                                                  </div>
                                                </div>
                                              </div>
                                              {{--<div class=" card card-primary">
                                                <div class="card-header">
                                                  <h3 class="card-title"> Project details page Settings </h3>
                                                </div>
                                              </div>
                                              <div class="col-md-12"> 
                                                <div class="form-group row">
                                                  <label  class="col-sm-3 col-form-label">Project Details Page Services Heading En: <span class="error">*</span></label>
                                                    <div class="col-sm-9">
                                                       <input type="text" name="project_details_service_heading_en" id="project_details_service_heading_en" class="form-control" value="{{ $details->project_details_service_heading_en}}" placeholder="Project Details Page Services Heading En" title="Project Details Page Services Heading En">
                                                  </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-12"> 
                                                  <div class="form-group row">
                                                    <label  class="col-sm-3 col-form-label">Project Details Page Services Heading Ar: <span class="error">*</span></label>
                                                      <div class="col-sm-9">
                                                         <input type="text" name="project_details_service_heading_ar" id="project_details_service_heading_ar" class="form-control" value="{{ $details->project_details_service_heading_ar}}" placeholder="Project Details Page Services Heading Ar" title="Project Details Page Services Heading Ar">
                                                    </div>
                                                      </div>
                                                  </div>
                                                  <div class="col-md-12"> 
                                                    <div class="form-group row">
                                                      <label  class="col-sm-3 col-form-label">Project Details Page Units Heading En:<span class="error">*</span></label>
                                                        <div class="col-sm-9">
                                                           <input type="text" name="project_details_unit_heading_en" id="project_details_unit_heading_en" class="form-control" value="{{ $details->project_details_unit_heading_en}}" placeholder="Project Details Page Units Heading En" title="Project Details Page Services Heading En">
                                                      </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12"> 
                                                      <div class="form-group row">
                                                        <label  class="col-sm-3 col-form-label">Project Details Page Units Heading Ar:<span class="error">*</span></label>
                                                          <div class="col-sm-9">
                                                             <input type="text" name="project_details_unit_heading_ar" id="project_details_unit_heading_ar" class="form-control" value="{{ $details->project_details_unit_heading_ar}}" placeholder="Project Details Page Units Heading Ar" title="Project Details Page Services Heading Ar">
                                                        </div>
                                                          </div>
                                                      </div>--}}
                                                      {{--<div class=" card card-primary">
                                                        <div class="card-header">
                                                          <h3 class="card-title">Our Achievement page Settings </h3>
                                                        </div>
                                                      </div>
                                                      <div class="col-md-12"> 
                                                        <div class="form-group row">
                                                          <label  class="col-sm-3 col-form-label">Our Achievement Heading En: <span class="error">*</span></label>
                                                            <div class="col-sm-9">
                                                               <input type="text" name="our_responsibility_heading" id="our_responsibility_heading" class="form-control" value="{{ $details->our_responsibility_heading}}" placeholder="Our Responsibilites Heading En" title="Our Responsibilites Heading En">
                                                          </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-12"> 
                                                          <div class="form-group row">
                                                            <label  class="col-sm-3 col-form-label">Our Achievement Heading Ar: <span class="error">*</span></label>
                                                              <div class="col-sm-9">
                                                                 <input type="text" name="our_responsibility_heading_ar" id="our_responsibility_heading_ar" class="form-control" value="{{ $details->our_responsibility_heading_ar}}" placeholder="Our Responsibilites Heading Ar" title="Our Responsibilites Heading Ar">
                                                            </div>
                                                              </div>
                                                          </div>

                                                          <div class="col-md-12"> 
                                                        <div class="form-group row">
                                                          <label  class="col-sm-3 col-form-label">Our Achievement Page Title En: <span class="error">*</span></label>
                                                            <div class="col-sm-9">
                                                               <input type="text" name="ach_title_en" id="ach_title_en" class="form-control" value="{{ $details->ach_title_en}}" placeholder="Our Achievement Page Title En" title="Our Achievement Page Title En">
                                                          </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-12"> 
                                                          <div class="form-group row">
                                                            <label  class="col-sm-3 col-form-label">Our Achievement Page Title Ar: <span class="error">*</span></label>
                                                              <div class="col-sm-9">
                                                                 <input type="text" name="ach_title_ar" id="ach_title_ar" class="form-control" value="{{ $details->ach_title_ar}}" placeholder="Our Achievement Page Title Ar" title="Our Achievement Page Title Ar">
                                                            </div>
                                                              </div>
                                                          </div>

                                                          &nbsp;&nbsp;&nbsp;
                                          <div class="col-md-12">                 
                                            @if (!empty($details->banner_image))
                                            <div class="form-group row">
                                                <label class="col-sm-3 col-form-label">Previous Banner:</label>
                                                <div class="col-sm-9">

                                                  <img src="{{ asset('assets/images/'.$details->banner_image.'') }}" alt="" height="100" width="70%" >
                                                  <input type="hidden" name="old_banner"  id="old_banner"  class="form-control" value="{{$details->banner_image}}"  >
                                                </div>
                                            </div> 
                                            @endif
                                    
                                          <div class="form-group row">
                                            <label class="col-sm-3 col-form-label">Banner Image: <span class="error">*</span></label>
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
                                          </div>--}}

                                                          {{--<div class=" card card-primary">
                                                            <div class="card-header">
                                                              <h3 class="card-title">Home Page Services Heading Settings </h3>
                                                            </div>
                                                          </div>

                                                          <div class="col-md-12"> 
                                                            <div class="form-group row">
                                                              <label  class="col-sm-3 col-form-label">Service Heading En: <span class="error">*</span></label>
                                                                <div class="col-sm-9">
                                                                  <input type="text" name="service_title_en" id="service_title_en" class="form-control" value="{{ $details->service_title_en}}" placeholder="Service Heading En" title="Service Heading En">
                                                                </div>
                                                              </div>
                                                          </div>
                                                          <div class="col-md-12"> 
                                                            <div class="form-group row">
                                                              <label  class="col-sm-3 col-form-label">Service Heading Ar: <span class="error">*</span></label>
                                                                <div class="col-sm-9">
                                                                  <input type="text" name="service_title_ar" id="service_title_ar" class="form-control" value="{{ $details->service_title_ar}}" placeholder="Service Heading Ar" title="Service Heading Ar">
                                                                </div>
                                                              </div>
                                                          </div>

                                                          <div class=" card card-primary">
                                                        <div class="card-header">
                                                          <h3 class="card-title">Home Page Latest News Heading Settings </h3>
                                                        </div>
                                                      </div>
                                                      <div class="col-md-12"> 
                                                        <div class="form-group row">
                                                          <label  class="col-sm-3 col-form-label">Latest News Heading En: <span class="error">*</span></label>
                                                            <div class="col-sm-9">
                                                               <input type="text" name="latest_news_title_en" id="latest_news_title_en" class="form-control" value="{{ $details->latest_news_title_en}}" placeholder="Latest News Heading En" title="Latest News Heading En">
                                                          </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-12"> 
                                                          <div class="form-group row">
                                                            <label  class="col-sm-3 col-form-label">Latest News Heading Ar: <span class="error">*</span></label>
                                                              <div class="col-sm-9">
                                                                 <input type="text" name="latest_news_title_ar" id="latest_news_title_ar" class="form-control" value="{{ $details->latest_news_title_ar}}" placeholder="Latest News Heading Ar" title="Latest News Heading Ar">
                                                            </div>
                                                              </div>
                                                          </div>

                                                          <div class=" card card-primary">
                                                        <div class="card-header">
                                                          <h3 class="card-title">Home Page Achievement Heading Settings </h3>
                                                        </div>
                                                      </div>
                                                      <div class="col-md-12"> 
                                                        <div class="form-group row">
                                                          <label  class="col-sm-3 col-form-label">Achievement Heading En: <span class="error">*</span></label>
                                                            <div class="col-sm-9">
                                                               <input type="text" name="achievement_title_en" id="achievement_title_en" class="form-control" value="{{ $details->achievement_title_en}}" placeholder="Achievement Heading En" title="Achievement Heading En">
                                                          </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-12"> 
                                                          <div class="form-group row">
                                                            <label  class="col-sm-3 col-form-label">Achievement Heading Ar: <span class="error">*</span></label>
                                                              <div class="col-sm-9">
                                                                 <input type="text" name="achievement_title_ar" id="achievement_title_ar" class="form-control" value="{{ $details->achievement_title_ar}}" placeholder="Achievement Heading Ar" title="Achievement Heading Ar">
                                                            </div>
                                                              </div>
                                                          </div>--}}           

                                              <div class="card-footer">
                                                <div class="">
                                                    <a class="btn btn-primary back_new" href="{{ url()->previous() }}">Back</a>
                                                    <button id="" type="submit" class="btn btn-success submit_new">Update</button>
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
  
  $(function () {
    $('.textarea').summernote()
  })

  /*function readURL(input) {
      let filesArray = input.files;
      if (filesArray && filesArray.length > 0) {
        for(i = 0;i < filesArray.length; i++ ){
          var reader = new FileReader();
            reader.onload = function(e) {
              $('.cmsImages').append('<div id="imageDiv20" class="col-sm-3"><img src="'+e.target.result+'" alt="" height="100" width="100%" id="brand_icon"><div style="margin-top: 5px;"><div class="row"><div class="col-sm-6"><button style="background:red;border:none;color:white;border-radius:3px;" class="deletemedia" data-id="0" >Delete</button></div><div class="col-sm-6"><div style="text-align: right"><input type="checkbox" alt="" name="upload_banner_image[]" value="Y" ></div></div></div></div></div>');
            }
            reader.readAsDataURL(filesArray[i]);
        }
      }
  }*/

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

  $("#banner_image").change(function() {
      /*readURL(this);*/
      readURL(this, 'bannerImages',0);
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

$(function () {
  //Initialize Select2 Elements
  $('.select2bs4').select2({
          theme: 'bootstrap4'
  })  
})

//Integer and decimal
$.validator.addMethod("valid_number", function(value, element) {
    if (/^[0-9]\d*(\.\d+)?$/.test(value)) {
        return true;
    } else {
        return false;
    }
});
$("#edit_social").validate({
    rules: {
      facebook: {
            required: true,  
        },
       
        youtube: {
            required: true,      
        },
        twitter: {
            required: true,
                 
        },
        linkedin: {
            required: true,
                 
        },
        phone:{
            required: true,
        },
        instagram:{
            required:true,
        },
        whatsapp:{
            required:true,
        },
        email:{
            required:true,
        },
        contact_us_email:{
            required:true,
        },
        join_us_email:{
            required:true,
        },
        project_email:{
            required:true,
        },
        achievement_title_en:{
            required:true,
        },
        achievement_title_ar:{
            required:true,
        },
        latest_news_title_en:{
            required:true,
        },
        latest_news_title_ar:{
            required:true,
        },
        service_title_en:{
            required:true,
        },
        service_title_ar:{
            required:true,
        },
        /*ach_title_en:{
            required:true,
        },
        ach_title_ar:{
            required:true,
        },*/

    },
    messages: {
      facebook: {
            required:  "This field is required", 
        },
        youtube: {
            required:  "This field is required",  
        },
        twitter: {
            required:  "This field is required", 
        },
        linkedin: {
            required:  "This field is required",
        },
        phone: {
            required:  "This field is required",  
        },
       instagram:{
          required: "This field is required"  ,
       } , 
       whatsapp:{
          required: "This field is required" , 
       } ,  
       email:{
          required: "This field is required" , 
       } , 
       contact_us_email:{
          required: "This field is required" , 
       } , 
       join_us_email:{
          required: "This field is required" , 
       } ,
       project_email:{
          required: "This field is required" , 
       } ,
       achievement_title_en:{
          required: "This field is required" , 
       } ,
       achievement_title_ar:{
          required: "This field is required" , 
       } ,
       latest_news_title_en:{
          required: "This field is required" , 
       } ,
       latest_news_title_ar:{
          required: "This field is required" , 
       } ,
       service_title_en:{
          required: "This field is required" , 
       } ,
       service_title_ar:{
          required: "This field is required" , 
       } ,
       /*ach_title_en:{
          required: "This field is required" , 
       } ,
       ach_title_ar:{
          required: "This field is required" , 
       } ,*/
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


      

         
         
              
             

                

     