@extends('admin.layouts.after-login-layout')


@section('unique-content')

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Brand Guideline Management</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Dashboard</a></li>
              <li class="breadcrumb-item"><a href="{{route('admin.tv-channels.list')}}">Brand Guideline List</a></li>
              <li class="breadcrumb-item active">Brand Guideline Edit</li>
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
                      <form action="{{route('admin.brand-guideline.update')}}" method="POST" enctype="multipart/form-data" id="edit_brand_guideline">
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
                                    <input type="text" name="title_en" id="title_en" value="{{ $details->title_en }}" class="form-control"  placeholder="Titlr En" title="Titlr En">
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
                                            <input type="text" name="title_ar" id="title_ar" value="{{ $details->title_ar }}" class="form-control" placeholder="Titlr Ar" title="Titlr Ar">
                                          </div>
                                        </div>
                                    </div>
                                <div class="card card-primary">
                                  <div class="card-header">
                                      <h3 class="card-title">General</h3>
                                    </div>
                                  </div>


                                   <div class="col-md-12">
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">Previous File:</label>
                                        <div class="col-sm-9">
                                            <a href="{{ asset('assets/brand-guidelines-pdf/'.$details->pdf_upload) }}" target="_blank">{{$details->pdf_upload}}</a>
                                          
                                        </div>
                                    </div> 
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">File Upload:<span class="error">*</span></label>
                                        <div class="col-sm-9">
                                            <input type="file" name="pdf_upload" id="pdf_upload" class="form-control" accept=".pdf,.mp3"> 
                                             <span class="system required" style="color: red;">(Only pdf/mp3 file allowed)*</span> 
                        
                                        </div>
                                    </div>

                                    @if (!empty($details->thumbnail_image))
                                    <div class="form-group row">
                                       <label class="col-sm-3 col-form-label">Previous Images:</label>
                                       <div class="col-sm-9">
                                         <img src="{{ asset('assets/brand_guideline_images/'.$details->thumbnail_image.'') }}" alt="" height="100" width="30%" >
                                       </div>
                                   </div> 
                                    
                                    @endif
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">File thumbnail Image:<span class="error">*</span></label>
                                        <div class="col-sm-9">
                                            <input type="file" name="thumbnail_image"  id="thumbnail_image"  class="form-control" >
                                             <span class="system required" style="color: red;">(Recommended Image Size: 400 &times; 270)*</span>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <!-- <label  class="col-sm-3 col-form-label" > Preview Slider-1 : </label> -->
                                        <div class="col-sm-9">
                                          <div class="row thumbnailmages" >
                                          
                                          </div>
                                        </div>
                                      </div>
                                    
                                      {{--<div class="form-group row">
                                        <label class="col-sm-3 col-form-label">Previous Mp3  Media:</label>
                                        <div class="col-sm-9">
                                            <audio controls="" style="vertical-align: middle" src="{{ asset('assets/media_mp3_upload/'.$details->media.'') }}" type="audio/mp3" controlslist="nodownload">
                                                Your browser does not support the audio element.
                                            </audio>
                                        </div>
                                    </div>
                                    
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label"> Upload mp3 Media:<span class="error">*</span></label>
                                        <div class="col-sm-9">
                                            <input type="file" name="media"  id="media"   class="form-control" >
                                             
                                              <span class="system required" style="color: red;">(Only upload mp3 allowed)*</span>
                                        </div>
                                    </div>--}} 

                                    {{-- <div class="form-group row">
                                        <!-- <label  class="col-sm-3 col-form-label" > Preview Slider-1 : </label> -->
                                        <div class="col-sm-9">
                                          <div class="row medialmages" >
                                          
                                          </div>
                                        </div>
                                      </div> --}}
                                   
                                  
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
                                    
                                    <div class="card-footer">
                                      <div class="">
                                          <a class="btn btn-primary back_new" href="{{route('admin.brand-guideline.list')}}">Back</a>
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
$("#edit_brand_guideline").validate({
    rules: {
      title_en: {
            required: true,  
        },
       
        title_ar: {
            required: true,      
        },
        // description_en: {
        //     required: true,
                 
        // },
        // description_ar: {
        //     required: true,
                 
        // },
        // banner_image:{
        //     required: true,
        // },
        status:{
            required:true,
        },
        // short_description_en: {
        //     required: true,
           
                 
        // },
        // short_description_ar: {
        //     required: true,
            
                 
        // },

    },
    messages: {
      title_en: {
            required:  "This field is required", 
        },
        title_ar: {
            required:  "This field is required",  
        },
        // description_en: {
        //     required:  "This field is required", 
        // },
        // description_ar: {
        //     required:  "This field is required",
        // },
        // banner_image: {
        //     required:  "This field is required",  
        // },
       status:{
          required: "This field is required"  
       },
      //  short_description_en: {
      //       required:  "This field is required",
            
      //   },
      //   short_description_ar: {
      //       required:  "This field is required",
            
      //   },   
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

  $("#thumbnail_image").change(function() {
      readURL(this, 'thumbnailmages',0);
  });
//   $("#media").change(function() {
//       readURL(this, 'medialmages',0);
//   });
</script>    
@endpush  


      

         
         
              
             

                

     