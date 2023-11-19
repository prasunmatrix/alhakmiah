@extends('admin.layouts.after-login-layout')


@section('unique-content')

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Media Tab Title Management</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Dashboard</a></li>
              <li class="breadcrumb-item"><a href="">Media Tab Edit</a></li>
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
                      <form action="{{route('admin.mediatab.updatemediatab')}}" method="POST" enctype="multipart/form-data" id="edit_media_tab">
                            {{ csrf_field() }}
                            <input type="hidden" name="encString" value="{{ $encryptCode }}">
                                  <div class="row">

                                    <div class="card card-primary">
                                      <div class="card-header">
                                        <h3 class="card-title">News Tab Title Settings</h3>
                                      </div>
                                    </div>

                                    <div class="col-md-12"> 
                                      <div class="form-group row">
                                        <label  class="col-sm-3 col-form-label"> News Title En: <span class="error">*</span></label>
                                          <div class="col-sm-9">
                                            <input type="text" name="news_en" id="news_en" class="form-control" value="{{ $details->news_en}}" placeholder="News Tab Title En" title="News Tab Title En">
                                          </div>
                                        </div>
                                      </div>
                                

                                    <div class="col-md-12"> 
                                      <div class="form-group row">
                                        <label  class="col-sm-3 col-form-label"> News Title Ar: <span class="error">*</span></label>
                                          <div class="col-sm-9">
                                            <input type="text" name="news_ar" id="news_ar" class="form-control" value="{{ $details->news_ar}}" placeholder="News Tab Title Ar" >
                                          </div>
                                        </div>
                                      </div>
                                 
                                      <div class="card card-primary">
                                        <div class="card-header">
                                          <h3 class="card-title">TV Channels Tab Title Settings</h3>
                                        </div>
                                      </div>
                                    
                                      <div class="col-md-12"> 
                                      <div class="form-group row">
                                        <label  class="col-sm-3 col-form-label"> TV Channels Title En: <span class="error">*</span></label>
                                          <div class="col-sm-9">
                                            <input type="text" name="tv_channel_en" id="tv_channel_en" class="form-control" value="{{ $details->tv_channel_en}}" placeholder="TV Channels Title En" title="TV Channels Title En">
                                          </div>
                                        </div>
                                      </div>
                                

                                    <div class="col-md-12"> 
                                      <div class="form-group row">
                                        <label  class="col-sm-3 col-form-label"> TV Channels Title Ar: <span class="error">*</span></label>
                                          <div class="col-sm-9">
                                            <input type="text" name="tv_channel_ar" id="tv_channel_ar" class="form-control" value="{{ $details->tv_channel_ar}}" placeholder="TV Channels Title Ar" >
                                          </div>
                                        </div>
                                      </div>
                                     
                                      
                                      <div class=" card card-primary">
                                        <div class="card-header">
                                          <h3 class="card-title"> Press Kit Tab Title Settings </h3>
                                        </div>
                                      </div>
                                      
                                      <div class="col-md-12"> 
                                      <div class="form-group row">
                                        <label  class="col-sm-3 col-form-label"> Press Kit Title En: <span class="error">*</span></label>
                                          <div class="col-sm-9">
                                            <input type="text" name="press_kit_en" id="press_kit_en" class="form-control" value="{{ $details->press_kit_en}}" placeholder="Press Kit Title En" title="Press Kit Title En">
                                          </div>
                                        </div>
                                      </div>
                                

                                    <div class="col-md-12"> 
                                      <div class="form-group row">
                                        <label  class="col-sm-3 col-form-label"> Press Kit Title Ar: <span class="error">*</span></label>
                                          <div class="col-sm-9">
                                            <input type="text" name="press_kit_ar" id="press_kit_ar" class="form-control" value="{{ $details->press_kit_ar}}" placeholder="Press Kit Title Ar" >
                                          </div>
                                        </div>
                                      </div>

                                      <div class=" card card-primary">
                                        <div class="card-header">
                                          <h3 class="card-title"> Press Kit Heading Settings </h3>
                                        </div>
                                      </div>
                                      
                                      <div class="col-md-12"> 
                                      <div class="form-group row">
                                        <label  class="col-sm-3 col-form-label"> Press Kit Heading En: </label>
                                          <div class="col-sm-9">
                                            <input type="text" name="press_kit_heading_en" id="press_kit_heading_en" class="form-control" value="{{ $details->press_kit_heading_en}}" placeholder="Press Kit Heading En" title="Press Kit Heading En">
                                          </div>
                                        </div>
                                      </div>
                                

                                    <div class="col-md-12"> 
                                      <div class="form-group row">
                                        <label  class="col-sm-3 col-form-label"> Press Kit Heading Ar: </label>
                                          <div class="col-sm-9">
                                            <input type="text" name="press_kit_heading_ar" id="press_kit_heading_ar" class="form-control" value="{{ $details->press_kit_heading_ar}}" placeholder="Press Kit Heading Ar" >
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

  function readURL(input) {
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
  }

  $("#banner_image").change(function() {
      readURL(this);
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
$("#edit_media_tab").validate({
    rules: {
      news_en: {
            required: true,   
        },
        news_ar: {
            required: true,     
        },
        tv_channel_en:{
            required: true,
        },
        tv_channel_ar:{
            required:true,
        },
        press_kit_en:{
            required:true,
        },
        press_kit_ar:{
            required:true,
        },

    },
    messages: {
      news_en: {
            required:  "This field is required", 
        },
        news_ar: {
            required:  "This field is required",  
        },
        tv_channel_en: {
            required:  "This field is required", 
        },
        tv_channel_ar: {
            required:  "This field is required",
        },
        press_kit_en: {
            required:  "This field is required",  
        },
        press_kit_ar:{
          required: "This field is required"  ,
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


      

         
         
              
             

                

     