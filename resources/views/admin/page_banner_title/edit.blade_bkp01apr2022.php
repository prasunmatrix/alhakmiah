@extends('admin.layouts.after-login-layout')


@section('unique-content')

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Page Banner Title Management</h1>
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
                      <form action="{{route('admin.social.updatepagetitle')}}" method="POST" enctype="multipart/form-data" id="edit_title_page">
                            {{ csrf_field() }}
                            <input type="hidden" name="encString" value="{{ $encryptCode }}">
                                  <div class="row">

                                    <div class="card card-primary">
                                      <div class="card-header">
                                        <h3 class="card-title">Communities Page Banner Title Settings</h3>
                                      </div>
                                    </div>

                                    <div class="col-md-12"> 
                                      <div class="form-group row">
                                        <label  class="col-sm-3 col-form-label"> Communities Title En: <span class="error">*</span></label>
                                          <div class="col-sm-9">
                                            <input type="text" name="communities_en" id="communities_en" class="form-control" value="{{ $details->communities_en}}" placeholder="Communities Title En" title="Communities Title En">
                                          </div>
                                        </div>
                                      </div>
                                

                                    <div class="col-md-12"> 
                                      <div class="form-group row">
                                        <label  class="col-sm-3 col-form-label"> Communities Title Ar: <span class="error">*</span></label>
                                          <div class="col-sm-9">
                                            <input type="text" name="communities_ar" id="communities_ar" class="form-control" value="{{ $details->communities_ar}}" placeholder="Communities Title Ar" >
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

                                        </div> 

                                      <div class="card card-primary">
                                        <div class="card-header">
                                          <h3 class="card-title">Service Page Banner Title Settings</h3>
                                        </div>
                                      </div>
                                    
                                      <div class="col-md-12"> 
                                      <div class="form-group row">
                                        <label  class="col-sm-3 col-form-label"> Service Title En: <span class="error">*</span></label>
                                          <div class="col-sm-9">
                                            <input type="text" name="service_en" id="service_en" class="form-control" value="{{ $details->service_en}}" placeholder="Service Title En" title="Service Title En">
                                          </div>
                                        </div>
                                      </div>
                                

                                    <div class="col-md-12"> 
                                      <div class="form-group row">
                                        <label  class="col-sm-3 col-form-label"> Service Title Ar: <span class="error">*</span></label>
                                          <div class="col-sm-9">
                                            <input type="text" name="service_ar" id="service_ar" class="form-control" value="{{ $details->service_ar}}" placeholder="Service Title Ar" >
                                          </div>
                                        </div>
                                      </div>
                                     
                                      
                                      <div class=" card card-primary">
                                        <div class="card-header">
                                          <h3 class="card-title"> Investor Relations Page Banner Title Settings </h3>
                                        </div>
                                      </div>
                                      
                                      <div class="col-md-12"> 
                                      <div class="form-group row">
                                        <label  class="col-sm-3 col-form-label"> Investor Relations Title En: <span class="error">*</span></label>
                                          <div class="col-sm-9">
                                            <input type="text" name="investor_relation_en" id="investor_relation_en" class="form-control" value="{{ $details->investor_relation_en}}" placeholder="Investor Relations Title En" title="Investor Relations Title En">
                                          </div>
                                        </div>
                                      </div>
                                

                                    <div class="col-md-12"> 
                                      <div class="form-group row">
                                        <label  class="col-sm-3 col-form-label"> Investor Relations Title Ar: <span class="error">*</span></label>
                                          <div class="col-sm-9">
                                            <input type="text" name="investor_relation_ar" id="investor_relation_ar" class="form-control" value="{{ $details->investor_relation_ar}}" placeholder="Investor Relations Title Ar" >
                                          </div>
                                        </div>
                                      </div>
                                     
                                      
                                   
                                          <div class=" card card-primary">
                                            <div class="card-header">
                                              <h3 class="card-title"> Media Center Page Banner Title Settings </h3>
                                            </div>
                                          </div>

                                          <div class="col-md-12"> 
                                      <div class="form-group row">
                                        <label  class="col-sm-3 col-form-label"> Media Center Title En: <span class="error">*</span></label>
                                          <div class="col-sm-9">
                                            <input type="text" name="media_center_en" id="media_center_en" class="form-control" value="{{ $details->media_center_en}}" placeholder="Media Center Title En" title="Media Center Title En">
                                          </div>
                                        </div>
                                      </div>
                                

                                    <div class="col-md-12"> 
                                      <div class="form-group row">
                                        <label  class="col-sm-3 col-form-label"> Media Center Title Ar: <span class="error">*</span></label>
                                          <div class="col-sm-9">
                                            <input type="text" name="media_center_ar" id="media_center_ar" class="form-control" value="{{ $details->media_center_ar}}" placeholder="Media Center Title Ar" >
                                          </div>
                                        </div>
                                      </div>
                                          
                                              
                                      <div class=" card card-primary">
                                        <div class="card-header">
                                          <h3 class="card-title">Join Us page Banner Title Settings </h3>
                                        </div>
                                      </div>
                                      <div class="col-md-12"> 
                                        <div class="form-group row">
                                          <label  class="col-sm-3 col-form-label">Join Us Title En: <span class="error">*</span></label>
                                            <div class="col-sm-9">
                                                <input type="text" name="join_us_en" id="join_us_en" class="form-control" value="{{ $details->join_us_en}}" placeholder="Join Us Title En" title="Join Us Title En">
                                          </div>
                                            </div>
                                        </div>
                                        <div class="col-md-12"> 
                                          <div class="form-group row">
                                            <label  class="col-sm-3 col-form-label">Join Us Title Ar: <span class="error">*</span></label>
                                              <div class="col-sm-9">
                                                  <input type="text" name="join_us_ar" id="join_us_ar" class="form-control" value="{{ $details->join_us_ar}}" placeholder="Join Us Title Ar" title="Join Us Title Ar">
                                            </div>
                                              </div>
                                          </div>

                                            <div class=" card card-primary">
                                          <div class="card-header">
                                            <h3 class="card-title">Contact Us Page Banner Title Settings </h3>
                                          </div>
                                        </div>
                                        <div class="col-md-12"> 
                                          <div class="form-group row">
                                            <label  class="col-sm-3 col-form-label">Contact Us Title En: <span class="error">*</span></label>
                                              <div class="col-sm-9">
                                                  <input type="text" name="contact_us_en" id="contact_us_en" class="form-control" value="{{ $details->contact_us_en}}" placeholder="Contact Us Title En" title="Contact Us Title En">
                                            </div>
                                              </div>
                                          </div>
                                          <div class="col-md-12"> 
                                            <div class="form-group row">
                                              <label  class="col-sm-3 col-form-label">Contact Us Title Ar: <span class="error">*</span></label>
                                                <div class="col-sm-9">
                                                    <input type="text" name="contact_us_ar" id="contact_us_ar" class="form-control" value="{{ $details->contact_us_ar}}" placeholder="Contact Us Title Ar" title="Contact Us Title Ar">
                                              </div>
                                                </div>
                                            </div>

                                            &nbsp;&nbsp;&nbsp;
                                        <div class="col-md-12">                 
                                            @if (!empty($details->contact_banner_image))
                                            <div class="form-group row">
                                                <label class="col-sm-3 col-form-label">Previous Banner:</label>
                                                <div class="col-sm-9">

                                                  <img src="{{ asset('assets/images/'.$details->contact_banner_image.'') }}" alt="" height="100" width="70%" >
                                                  <input type="hidden" name="old_banner"  id="old_banner"  class="form-control" value="{{$details->contact_banner_image}}"  >
                                                </div>
                                            </div> 
                                            @endif
                                    
                                            <div class="form-group row">
                                              <label class="col-sm-3 col-form-label">Banner Image: <span class="error">*</span></label>
                                              <div class="col-sm-9">
                                                  <input type="file" name="contact_banner_image"  id="contact_banner_image"  class="form-control">
                                                  <span class="system required" style="color: red;">(Recommended Image Size: 1530 &times; 830)*</span>
                                              </div>
                                            </div> 

                                          <div class="form-group row">
                                            <label  class="col-sm-3 col-form-label" >Selected Banner Images : </label>
                                            <div class="col-sm-9">
                                              <div class="row contactbannerImages" >
                                              
                                              </div>
                                            </div>
                                          </div>

                                      </div>

                                      <div class=" card card-primary">
                                          <div class="card-header">
                                            <h3 class="card-title">Our Achievement page Settings </h3>
                                          </div>
                                      </div>
                                        <div class="col-md-12"> 
                                          <div class="form-group row">
                                            <label  class="col-sm-3 col-form-label">Our Achievement Title En: <span class="error">*</span></label>
                                              <div class="col-sm-9">
                                                  <input type="text" name="our_achievement_heading_en" id="our_achievement_heading_en" class="form-control" value="{{ $details->our_achievement_heading_en}}" placeholder="Our Achievement Title En" title="Our Achievement Title En">
                                                </div>
                                              </div>
                                        </div>
                                        <div class="col-md-12"> 
                                          <div class="form-group row">
                                            <label  class="col-sm-3 col-form-label">Our Achievement Title Ar: <span class="error">*</span></label>
                                              <div class="col-sm-9">
                                                  <input type="text" name="our_achievement_heading_ar" id="our_achievement_heading_ar" class="form-control" value="{{ $details->our_achievement_heading_ar}}" placeholder="Our Achievement Title Ar" title="Our Achievement Title Ar">
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

                                          <div class="col-md-12"> 
                                            <div class="form-group row">
                                              <label class="col-sm-3 col-form-label"> Our Achievement Description En:  </label>
                                                <div class="col-sm-9">
                                                  <textarea class="textarea" name="ach_description_en" id="ach_description_en" placeholder="Achievement Description En"
                                                    style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;">{{ $details->ach_description_en }}</textarea>
                                                </div>
                                            </div> 
                                          </div>
                                          
                                          <div class="col-md-12"> 
                                              <div class="form-group row">
                                                  <label class="col-sm-3 col-form-label"> Our Achievement Description Ar:  </label>
                                                  <div class="col-sm-9">
                                                  <textarea class="textarea" name="ach_description_ar" id="ach_description_ar" placeholder="Achievement Description Ar"
                                                  style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;">{{ $details->ach_description_ar }}</textarea>
                                                  </div>
                                              </div>
                                          </div>  

                                          &nbsp;&nbsp;&nbsp;
                                          <div class="col-md-12">                 
                                            @if (!empty($details->achievement_banner_image))
                                            <div class="form-group row">
                                                <label class="col-sm-3 col-form-label">Previous Banner:</label>
                                                <div class="col-sm-9">

                                                  <img src="{{ asset('assets/images/'.$details->achievement_banner_image.'') }}" alt="" height="100" width="70%" >
                                                  <input type="hidden" name="old_banner"  id="old_banner"  class="form-control" value="{{$details->achievement_banner_image}}"  >
                                                </div>
                                            </div> 
                                            @endif
                                    
                                          <div class="form-group row">
                                            <label class="col-sm-3 col-form-label">Banner Image: <span class="error">*</span></label>
                                            <div class="col-sm-9">
                                                <input type="file" name="achievement_banner_image"  id="achievement_banner_image"  class="form-control">
                                                <span class="system required" style="color: red;">(Recommended Image Size: 1530 &times; 830)*</span>
                                            </div>
                                          </div> 

                                          <div class="form-group row">
                                            <label  class="col-sm-3 col-form-label" >Selected Banner Images : </label>
                                            <div class="col-sm-9">
                                              <div class="row achievementbannerImages" >
                                              
                                              </div>
                                            </div>
                                          </div>
                                          </div>

                                          <div class=" card card-primary">
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
                                                      </div>

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
     //readURL(this);
     readURL(this, 'bannerImages',0);
  });

  $("#contact_banner_image").change(function() {
      //readURL(this);
      readURL(this, 'contactbannerImages',0);
  });

  $("#achievement_banner_image").change(function() {
      //readURL(this);
      readURL(this, 'achievementbannerImages',0);
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
$("#edit_title_page").validate({
    rules: {
        communities_en: {
            required: true,   
        },
        communities_ar: {
            required: true,     
        },
        service_en:{
            required: true,
        },
        service_ar:{
            required:true,
        },
        investor_relation_en:{
            required:true,
        },
        investor_relation_ar:{
            required:true,
        },
        media_center_en:{
            required:true,
        },
        media_center_ar:{
            required:true,
        },
        join_us_en:{
            required:true,
        },
        join_us_ar:{
            required:true,
        },
        contact_us_en:{
            required:true,
        },
        contact_us_ar:{
            required:true,
        },
        our_achievement_heading_en:{
            required:true,
        },
        our_achievement_heading_ar:{
            required:true,
        },
        ach_title_en:{
            required:true,
        },
        ach_title_ar:{
            required:true,
        },
        project_details_service_heading_en:{
            required:true,
        },
        project_details_service_heading_ar:{
            required:true,
        },
        project_details_unit_heading_en:{
            required:true,
        },
        project_details_unit_heading_ar:{
            required:true,
        },

    },
    messages: {
      communities_en: {
            required:  "This field is required", 
        },
        communities_ar: {
            required:  "This field is required",  
        },
        service_en: {
            required:  "This field is required", 
        },
        service_ar: {
            required:  "This field is required",
        },
        investor_relation_en: {
            required:  "This field is required",  
        },
        investor_relation_ar:{
          required: "This field is required"  ,
       } , 
       media_center_en:{
          required: "This field is required" , 
       } ,  
       media_center_ar:{
          required: "This field is required" , 
       } , 
       join_us_en:{
          required: "This field is required" , 
       } , 
       join_us_ar:{
          required: "This field is required" , 
       } , 
       contact_us_en:{
          required: "This field is required" , 
       } ,
       contact_us_ar:{
          required: "This field is required" , 
       } ,
       our_achievement_heading_en:{
          required: "This field is required" , 
       } ,
       our_achievement_heading_ar:{
          required: "This field is required" , 
       } ,
       ach_title_en:{
          required: "This field is required" , 
       } ,
       ach_title_ar:{
          required: "This field is required" , 
       } ,
       project_details_service_heading_en:{
          required: "This field is required" , 
       } ,
       project_details_service_heading_ar:{
          required: "This field is required" , 
       } ,
       project_details_unit_heading_en:{
          required: "This field is required" , 
       } ,
       project_details_unit_heading_ar:{
          required: "This field is required" , 
       } ,
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


      

         
         
              
             

                

     