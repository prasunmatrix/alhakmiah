@extends('admin.layouts.after-login-layout')


@section('unique-content')

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Project Near Place Management</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Dashboard</a></li>
              <li class="breadcrumb-item"><a href="{{route('admin.projectnear.index')}}">Project Near Place List</a></li>
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
                      <form action="{{route('admin.projectnear.update')}}" method="POST" enctype="multipart/form-data" id="edit_project_nearto">
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
                                          <input type="text" name="near_name" id="near_name" class="form-control" placeholder="Name En" title="Name En" value="{{$nearDetail->near_name}}" required>
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
                                            <input type="text" name="near_name_ar" id="near_name_ar" class="form-control" placeholder="Name Ar" title="Name Ar" value="{{$nearDetail->near_name_ar}}" required>
                                          </div>
                                      </div>
                                      
                                      
                                </div>

                                <div class="card card-primary">
                                  <div class="card-header">
                                      <h3 class="card-title">General</h3>
                                    </div>
                                  </div>
                                  <div class="col-md-12">

                                    
                                           @if (!empty($nearDetail->near_image))
                                           <div class="form-group row">
                                              <label class="col-sm-3 col-form-label">Previous Icon Image:</label>
                                              <div class="col-sm-9">

                                                                <img src="{{ asset('/admin/upload/project_near/thumbnail') }}/{{ $nearDetail->near_image }}" alt="">
                                                <input type="hidden" name="old_near_image"  id="old_near_image"  class="form-control" value="{{ $nearDetail->near_image }}" required>
                                              </div>
                                          </div> 
                                           
                                            @endif
                                            

                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">Icon Image:<span class="error">*</span></label>
                                        <div class="col-sm-9">
                                            <input type="file" name="near_image"  id="near_image"  class="form-control" >
                                            <span style="color:red;">(Prefered size 100px X 90px)</span>
                                        </div>
                                      </div> 

                                      <div class="form-group row">
                                      <label  class="col-sm-3 col-form-label" ></label>
                                      <div class="col-sm-9">
                                        <div class="row nearImages" >
                                        
                                        </div>
                                      </div>
                                    </div>

                                        
                                     

                                  </div>
                                </div> 
                                    
                                    <div class="card-footer">
                                      <div class="">
                                          <a class="btn btn-primary back_new" href="{{route('admin.projectnear.index')}}">Back</a>
                                          <input type="hidden" name="project_near_id" value="{{ $nearDetail->id }}">
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

  $("#near_image").change(function() {
      readURL(this, 'nearImages',0);
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
$("#edit_project_nearto").validate({
    rules: {
      near_name: {
            required: true,  
        },
       
        near_name_ar: {
            required: true,      
        },
       
        description_ar: {
            required: true,
                 
        },
      
        status:{
            required:true,
        },

    },
    messages: {
      near_name: {
            required:  "This field is required", 
        },
        near_name_ar: {
            required:  "This field is required",  
        },
       
        description_ar: {
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

      
      

         
         
              
             

                

     