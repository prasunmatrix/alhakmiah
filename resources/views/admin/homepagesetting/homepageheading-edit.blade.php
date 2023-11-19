@extends('admin.layouts.after-login-layout')


@section('unique-content')

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Home Page Heading Setting</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Dashboard</a></li>
              <li class="breadcrumb-item"><a href="">Social List</a></li>
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
                      <form action="{{route('admin.home-page-setting.updateheading' )}}" method="POST" enctype="multipart/form-data" id="edit_homepage">
                            {{ csrf_field() }}
                            <input type="hidden" name="encString" value="{{ $encryptCode }}">
                                  <div class="row">


                                      <div class=" card card-primary">
                                        <div class="card-header">
                                          <h3 class="card-title">Home Page Services Heading Settings </h3>
                                        </div>
                                      </div>

                                      <div class="col-md-12"> 
                                        <div class="form-group row">
                                          <label  class="col-sm-3 col-form-label">Service Heading En: </label>
                                            <div class="col-sm-9">
                                              <input type="text" name="service_title_en" id="service_title_en" class="form-control" value="{{ $details->service_title_en}}" placeholder="Service Heading En" title="Service Heading En">
                                            </div>
                                          </div>
                                      </div>
                                      <div class="col-md-12"> 
                                        <div class="form-group row">
                                          <label  class="col-sm-3 col-form-label">Service Heading Ar: </label>
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
                                      <label  class="col-sm-3 col-form-label">Latest News Heading En: </label>
                                        <div class="col-sm-9">
                                            <input type="text" name="latest_news_title_en" id="latest_news_title_en" class="form-control" value="{{ $details->latest_news_title_en}}" placeholder="Latest News Heading En" title="Latest News Heading En">
                                      </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12"> 
                                      <div class="form-group row">
                                        <label  class="col-sm-3 col-form-label">Latest News Heading Ar: </label>
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
                                      <label  class="col-sm-3 col-form-label">Achievement Heading En: </label>
                                        <div class="col-sm-9">
                                            <input type="text" name="achievement_title_en" id="achievement_title_en" class="form-control" value="{{ $details->achievement_title_en}}" placeholder="Achievement Heading En" title="Achievement Heading En">
                                      </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12"> 
                                      <div class="form-group row">
                                        <label  class="col-sm-3 col-form-label">Achievement Heading Ar: </label>
                                          <div class="col-sm-9">
                                              <input type="text" name="achievement_title_ar" id="achievement_title_ar" class="form-control" value="{{ $details->achievement_title_ar}}" placeholder="Achievement Heading Ar" title="Achievement Heading Ar">
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
<script src="//cdn.ckeditor.com/4.5.9/standard/ckeditor.js"></script>
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
$("#edit_homepage").validate({
    rules: {
      title_en: {
            required: true,  
        },
       
        title_ar: {
            required: true,      
        },
        description_en: {
            required: true,
                 
        },
        description_ar: {
            required: true,
                 
        },
        banner_image:{
            required: true,
        },
        status:{
            required:true,
        },


    },
    messages: {
      title_en: {
            required:  "This field is required", 
        },
        title_ar: {
            required:  "This field is required",  
        },
        description_en: {
            required:  "This field is required", 
        },


        description_ar: {
            required:  "This field is required",
        },
        banner_image: {
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


      

         
         
              
             

                

     