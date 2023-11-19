@extends('admin.layouts.after-login-layout')


@section('unique-content')

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Home Page Setting</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Dashboard</a></li>
              <li class="breadcrumb-item"><a href="{{route('admin.home-page-setting.homepage.list')}}">Home Page Setting List</a></li>
              <li class="breadcrumb-item active">Home Page Setting Edit</li>
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
                      <form action="{{route('admin.home-page-setting.update')}}" method="POST" enctype="multipart/form-data" id="edit_homepage">
                            {{ csrf_field() }}
                            <input type="hidden" name="encString" value="{{ $encryptCode }}">
                          <div class="row">
                              <div class="col-md-12">
                              
                                      <div class="form-group row">
                                      <label  class="col-sm-3 col-form-label"> Title En: <span class="error">*</span></label>
                                        <div class="col-sm-9">
                                          <input type="text" name="title_en" id="title_en" class="form-control" value="{{ $details->title_en }}" placeholder="Title En" title="Title En">
                                        </div>
                                      </div>
                                      <div class="form-group row">
                                        <label  class="col-sm-3 col-form-label"> Title Ar: <span class="error">*</span></label>
                                          <div class="col-sm-9">
                                            <input type="text" name="title_ar" id="title_ar" class="form-control" value="{{ $details->title_ar }}" placeholder="Title Ar" title="Title Ar">
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
                                        <label class="col-sm-3 col-form-label">Description Ar: <span class="error">*</span> </label>
                                        <div class="col-sm-9">
                                        <textarea class="textarea" name="description_ar" id="description_ar" placeholder="Description Ar"
                                        style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;">{{ $details->description_ar }}</textarea>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                      <label  class="col-sm-3 col-form-label"> Feature Project Heading En: <span class="error">*</span></label>
                                        <div class="col-sm-9">
                                          <input type="text" name="feature_project_heading_en" id="feature_project_heading_en" class="form-control" value="{{ $details->feature_project_heading_en }}" placeholder="Feature Project Heading En" title="Feature Project Heading En">
                                        </div>
                                      </div>
                                      <div class="form-group row">
                                        <label  class="col-sm-3 col-form-label"> Feature Project Heading Ar: <span class="error">*</span></label>
                                          <div class="col-sm-9">
                                            <input type="text" name="feature_project_heading_ar" id="feature_project_heading_ar" class="form-control" value="{{ $details->feature_project_heading_ar }}" placeholder="Feature Project Heading Ar" title="Feature Project Heading Ar">
                                          </div>
                                        </div>
                                        <div class="form-group row">
                                          <label  class="col-sm-3 col-form-label"> Feature Project Button Text En: <span class="error">*</span></label>
                                            <div class="col-sm-9">
                                              <input type="text" name="feature_project_button_text_en" id="feature_project_button_text_en" class="form-control" value="{{ $details->feature_project_button_text_en }}" placeholder="Feature Project Button Text En" title="Feature Project Button Text En">
                                            </div>
                                          </div>
                                          <div class="form-group row">
                                            <label  class="col-sm-3 col-form-label"> Feature Project Button Text Ar: <span class="error">*</span></label>
                                              <div class="col-sm-9">
                                                <input type="text" name="feature_project_button_text_ar" id="feature_project_button_text_ar" class="form-control" value="{{ $details->feature_project_button_text_ar }}" placeholder="Feature Project Button Text Ar" title="Feature Project Button Text Ar">
                                              </div>
                                            </div>
   
                                    {{-- <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">Status: <span class="error">*</span></label>
                                        <div class="col-sm-9">
                                        <select class="form-control select2 select2-danger select2bs4" name="status" data-dropdown-css-class="select2-danger" style="width: 100%;" disabled>
                                            <option value="">Choose option</option>
                                            <option value="A" {{ $details->status == 'A' ? 'selected' : '' }} >Active</option>
                                            <option value="I" {{ $details->status == 'I' ? 'selected' : '' }} >Inactive</option>
                                        </select  >
                                        </div>
                                      </div>  --}}

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
        <input type="text" name="meta_title" id="meta_title" class="form-control" value="{{ $details->meta_title }}"  placeholder="Meta Title En" title="Meta Title En">
      </div>
    </div>

    <div class="form-group row">
      <label  class="col-sm-3 col-form-label"> Meta Title Ar: </label>
      <div class="col-sm-9">
        <input type="text" name="meta_title_ar" id="meta_title_ar" class="form-control" value="{{ $details->meta_title_ar }}"  placeholder="Meta Title Ar" title="Meta Title Ar">
      </div>
    </div>
                                      
    <div class="form-group row">
      <label  class="col-sm-3 col-form-label"> Meta Descriptions En: </label>
        <div class="col-sm-9">
          <input type="text" name="meta_descriptions" id="meta_descriptions" class="form-control" value="{{ $details->meta_descriptions }}"  placeholder="Meta Descriptions En" title="Meta Descriptions En">
        </div>
    </div>

    <div class="form-group row">
      <label  class="col-sm-3 col-form-label"> Meta Descriptions Ar: </label>
        <div class="col-sm-9">
          <input type="text" name="meta_descriptions_ar" id="meta_descriptions_ar" class="form-control" value="{{ $details->meta_descriptions_ar }}"  placeholder="Meta Descriptions Ar" title="Meta Descriptions Ar">
        </div>
    </div>

    <div class="form-group row">
      <label  class="col-sm-3 col-form-label"> Meta Keyword En: </label>
        <div class="col-sm-9">
          <input type="text" name="meta_keyword" id="meta_keyword" class="form-control" value="{{ $details->meta_keyword }}"  placeholder="Meta Keyword En" title="Meta Keyword En">
        </div>
    </div>

    <div class="form-group row">
      <label  class="col-sm-3 col-form-label"> Meta Keyword Ar: </label>
        <div class="col-sm-9">
          <input type="text" name="meta_keyword_ar" id="meta_keyword_ar" class="form-control" value="{{ $details->meta_keyword_ar }}"  placeholder="Meta Keyword Ar" title="Meta Keyword Ar">
        </div>
    </div>

    <div class="form-group row">
      <label  class="col-sm-3 col-form-label"> Alt Text En: </label>
        <div class="col-sm-9">
          <input type="text" name="alt_text" id="alt_text" class="form-control"  value="{{ $details->alt_text }}" placeholder="Alt Text En" title="Alt Text En">
        </div>
    </div>

    <div class="form-group row">
      <label  class="col-sm-3 col-form-label"> Alt Text Ar: </label>
        <div class="col-sm-9">
          <input type="text" name="alt_text_ar" id="alt_text_ar" class="form-control"  value="{{ $details->alt_text_ar }}" placeholder="Alt Text Ar" title="Alt Text Ar">
        </div>
    </div>

    <div class="form-group row">
      <label  class="col-sm-3 col-form-label"> Canonical En: </label>
        <div class="col-sm-9">
          <input type="text" name="canonical" id="canonical" class="form-control"  value="{{ $details->canonical }}" placeholder="Canonical En" title="Canonical En">
        </div>
    </div>

    <div class="form-group row">
      <label  class="col-sm-3 col-form-label"> Canonical Ar: </label>
        <div class="col-sm-9">
          <input type="text" name="canonical_ar" id="canonical_ar" class="form-control"  value="{{ $details->canonical_ar }}" placeholder="Canonical Ar" title="Canonical Ar">
        </div>
    </div>

</div>  
<!----------------- SEO end !-------->
                                      
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


      

         
         
              
             

                

     