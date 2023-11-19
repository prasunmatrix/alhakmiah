@extends('admin.layouts.after-login-layout')


@section('unique-content')

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>News Management</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Dashboard</a></li>
              <li class="breadcrumb-item"><a href="{{route('admin.home-page-setting.homepage.list')}}">News List</a></li>
              <li class="breadcrumb-item active">News Edit</li>
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
                      <form action="{{route('admin.blog.update')}}" method="POST" enctype="multipart/form-data" id="edit_blog">
                            {{ csrf_field() }}
                            <input type="hidden" name="encString" value="{{ $encryptCode }}">
                          <div class="row">
                            <div class="card card-primary">
                                <div class="card-header">
                                  <h3 class="card-title">English</h3>
                                </div>
                              </div>
                              <div class="col-md-12">
                              
                                      <div class="form-group row">
                                      <label  class="col-sm-3 col-form-label"> Title En: <span class="error">*</span></label>
                                        <div class="col-sm-9">
                                          <input type="text" name="title_en" id="title_en" class="form-control" value="{{ $details->title_en }}" placeholder="Title En" title="Title En">
                                        </div>
                                      </div>
                                      <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">Description En: <span class="error">*</span> </label>
                                        <div class="col-sm-9">
                                        <textarea class="textarea" name="description_en" id="description_en" placeholder="Description En"
                                        style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;">{{ $details->description_en }}</textarea>
                                        </div>
                                      </div> 
                                      <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">Short Description En: <span class="error">*</span> </label>
                                        <div class="col-sm-9">
                                        <textarea class="textarea" name="short_description_en" id="short_description_en" placeholder="Short Description En"
                                        style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;">{{ $details->short_description_en }}</textarea>
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
                                        <label  class="col-sm-3 col-form-label"> Title Ar: <span class="error">*</span></label>
                                          <div class="col-sm-9">
                                            <input type="text" name="title_ar" id="title_ar" class="form-control" value="{{ $details->title_ar }}" placeholder="Title Ar" title="Title Ar">
                                          </div>
                                        </div>
                                 
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">Description Ar: <span class="error">*</span> </label>
                                        <div class="col-sm-9">
                                        <textarea class="textarea" name="description_ar" id="description_ar" placeholder="Description Ar"
                                        style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;">{{ $details->description_ar }}</textarea>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                      <label class="col-sm-3 col-form-label">Short  Description Ar: <span class="error">*</span> </label>
                                      <div class="col-sm-9">
                                      <textarea class="textarea" name="short_description_ar" id="short_description_ar" placeholder="Short Description Ar"
                                      style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;">{{ $details->short_description_ar }}</textarea>
                                      </div>
                                  </div>
                                </div>
                                <div class="card card-primary">
                                  <div class="card-header">
                                      <h3 class="card-title">General</h3>
                                    </div>
                                  </div>

                                   <div class="col-md-12">
                                     @if (!empty($details->blog_small_image))
                                           <div class="form-group row">
                                              <label class="col-sm-3 col-form-label">Previous Small Images:</label>
                                              <div class="col-sm-9">

                                                <img src="{{ asset('assets/blog-images/small-image/'.$details->blog_small_image.'') }}" alt="" height="100" width="30%" >
                                                
                                              </div>
                                          </div> 
                                           
                                   @endif
                                    
                                  <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Blog Small Image :</label>
                                      <div class="col-sm-9">
                                        <input type="file" name="blog_small_image"  id="blog_small_image"  class="form-control">
                                        <span class="system required" style="color: red;">(Recommended Image Size: 400 &times; 270)*</span>
                                      </div>
                                  </div> 

                                      <div class="form-group row">
                                      <!-- <label  class="col-sm-3 col-form-label" >Selected Slider-1 : </label> -->
                                      <div class="col-sm-9">
                                        <div class="row sliderImages1" >
                                        
                                        </div>
                                      </div>
                                    </div>
                                    <div class="col-md-12">
                                     @if (!empty($details->blog_big_image))
                                           <div class="form-group row">
                                              <label class="col-sm-3 col-form-label">Previous Big Images:</label>
                                              <div class="col-sm-9">

                                                <img src="{{ asset('assets/blog-images/big-image/'.$details->blog_big_image.'') }}" alt="" height="100" width="30%" >
                                                
                                              </div>
                                          </div> 
                                           
                                   @endif
                                    
                                  <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Blog Big Image :</label>
                                      <div class="col-sm-9">
                                        <input type="file" name="blog_big_image"  id="blog_big_image"  class="form-control">
                                        <span class="system required" style="color: red;">(Recommended Image Size: 640 &times; 480)*</span>
                                      </div>
                                  </div> 

                                      <div class="form-group row">
                                      <!-- <label  class="col-sm-3 col-form-label" >Selected Slider-1 : </label> -->
                                      <div class="col-sm-9">
                                        <div class="row sliderImages2" >
                                        
                                        </div>
                                      </div>
                                    </div>
                                    <div class="form-group row">
                                      <label class="col-sm-3 col-form-label">Show in frontend: <span class="error">*</span></label>
                                      <div class="col-sm-9">
                                        <input type="checkbox" name="show_in_front" value="1" @if($details->show_in_front == "1" ) {{ 'checked' }} @endif  id="custom7" >
                                        
                                      </div>
                                    </div>

                                    <div class="form-group row">
                                        <label  class="col-sm-3 col-form-label"> Blog Date: <span class="error">*</span></label>
                                          <div class="col-sm-4">
                                            <input type="date" name="blog_date" id="blog_date" class="form-control" value="{{ $details->blog_date }}" placeholder="News Date" title="News Date">
                                          </div>
                                    </div>

                                   <!--  <div class="col-md-12">
                                     @if (!empty($details->slider_2))
                                           <div class="form-group row">
                                              <label class="col-sm-3 col-form-label">Previous Slider-2:</label>
                                              <div class="col-sm-9">

                                                <img src="{{ asset('assets/images/'.$details->slider_2.'') }}" alt="" height="100" width="70%" >
                                                
                                              </div>
                                          </div> 
                                           
                                   @endif -->
                                    
                               <!--   <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">News Slider-2 :</label>
                                        <div class="col-sm-9">
                                            <input type="file" name="slider_2"  id="slider_2"  class="form-control">
                                        </div>
                                      </div> 

                                      <div class="form-group row">
                                      <label  class="col-sm-3 col-form-label" >Selected Slider-2 : </label>
                                      <div class="col-sm-9">
                                        <div class="row sliderImages2" >
                                        
                                        </div>
                                      </div>
                                    </div> -->
                                  <div class="col-md-12">
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
                                          <a class="btn btn-primary back_new" href="{{route('admin.news.news.list')}}">Back</a>
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

$('#custom7').on('change', function(){
   this.value = this.checked ? 1 : 0;
   // alert(this.value);
}).change();

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
$("#edit_blog").validate({
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
        news_date: {
            required: true,
                 
        },
        // banner_image:{
        //     required: true,
        // },
        status:{
            required:true,
        },
        short_description_en: {
            required: true,
            maxlength: 150
                 
        },
        short_description_ar: {
            required: true,
            maxlength: 150
                 
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
        news_date: {
            required:  "This field is required",
        },
        // banner_image: {
        //     required:  "This field is required",  
        // },
       status:{
          required: "This field is required"  
       },
       short_description_en: {
            required:  "This field is required",
            maxlength: "Short Description should not more then 150 characters"
        },
        short_description_ar: {
            required:  "This field is required",
            maxlength: "Short Description should not more then 150 characters"
        },   
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
<script type="text/javascript">
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

  $("#blog_small_image").change(function() {
      readURL(this, 'sliderImages1',0);
  });
  $("#blog_big_image").change(function() {
      readURL(this, 'sliderImages2',0);
  });
</script>    
@endpush  


      

         
         
              
             

                

     