@extends('admin.layouts.after-login-layout')


@section('unique-content')

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>CEO Brochure Management</h1>
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
                      <form action="{{route('admin.position.updateceopdf')}}" method="POST" enctype="multipart/form-data" id="edit_title_page">
                            {{ csrf_field() }}
                            <input type="hidden" name="encString" value="{{ $encryptCode }}">
                                  <div class="row">

                                    <div class="col-md-12"> 
                                        @if (!empty($details->brochure_en))
                                           <div class="form-group row">
                                              <label class="col-sm-3 col-form-label">Previous Brochure:</label>
                                              <div class="col-sm-9">

                                                <a href="{{ asset('/admin/upload/ceo_brochure/english') }}/{{$details->brochure_en}}" target="_blank">{{$details->brochure_en}}</a>
                                                <input type="hidden" name="old_brochure"  id="old_brochure"  class="form-control" value="{{$details->brochure_en}}" required>
                                              </div>
                                          </div> 
                                           
                                        @endif

                                        <div class="form-group row">
                                          <label class="col-sm-3 col-form-label">Brochure En:</label>
                                          <div class="col-sm-9">
                                              <input type="file" name="brochure_en"  id="brochure_en"  class="form-control" accept="application/pdf">
                                              <span class="system required" style="color: red;">(Only pdf file allowed.)*
                                          </div>
                                        </div>
                                    </div>
                                

                                    <div class="col-md-12"> 
                                        @if (!empty($details->brochure_ar))
                                              <div class="form-group row">
                                                  <label class="col-sm-3 col-form-label">Previous Brochure:</label>
                                                  <div class="col-sm-9">

                                                    <a href="{{ asset('/admin/upload/ceo_brochure/arabic') }}/{{$details->brochure_ar}}" target="_blank">{{$details->brochure_ar}}</a>
                                                    <input type="hidden" name="old_brochure_ar"  id="old_brochure_ar"  class="form-control" value="{{$details->brochure_ar}}" required>
                                                  </div>
                                              </div> 
                                              
                                        @endif

                                    
                                        <div class="form-group row">
                                            <label class="col-sm-3 col-form-label">Brochure Ar:</label>
                                            <div class="col-sm-9">
                                                <input type="file" name="brochure_ar"  id="brochure_ar"  class="form-control" accept="application/pdf">
                                                <span class="system required" style="color: red;">(Only pdf file allowed.)*
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


      

         
         
              
             

                

     