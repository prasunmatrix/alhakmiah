@extends('admin.layouts.after-login-layout')


@section('unique-content')

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Investor Management</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Dashboard</a></li>
             
              <li class="breadcrumb-item active">Investor Edit</li>
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
              <form action="{{route('admin.investor-relations.buttonupdate')}}" method="POST" enctype="multipart/form-data" id="button_investor">
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
                                      <label  class="col-sm-3 col-form-label"> View annual reports En: <span class="error">*</span></label>
                                        <div class="col-sm-9">
                                          <input type="text" name="annual_en" id="annual_en" class="form-control" value="" placeholder="View annual reports En" title="View annual reports En">
                                        </div>
                                      </div>
                                      <div class="form-group row">
                                        <label  class="col-sm-3 col-form-label"> View financial results En: <span class="error">*</span></label>
                                          <div class="col-sm-9">
                                           <input type="text" name="financial_en" id="financial_en" class="form-control" value="" placeholder="View financial results En" title="View financial results En">

                                          </div>
                                        </div>
<div class="form-group row">
                                        <label  class="col-sm-3 col-form-label"> Profit presentation En: <span class="error">*</span></label>
                                          <div class="col-sm-9">
                                           <input type="text" name="Profit_en" id="Profit_en" class="form-control" value="" placeholder="Profit presentation En" title="Profit presentation En">

                                          </div>
                                        </div>
<div class="form-group row">
                                        <label  class="col-sm-3 col-form-label"> View the Basel reports En: <span class="error">*</span></label>
                                          <div class="col-sm-9">
                                           <input type="text" name="Basel_en" id="Basel_en" class="form-control" value="" placeholder="View the Basel reports En" title="View the Basel reports En">

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
                                        <label class="col-sm-3 col-form-label">View annual reports Ar: <span class="error">*</span> </label>
                                        <div class="col-sm-9">
                                        <input type="text" name="annual_ar" id="annual_ar" class="form-control" value="" placeholder="Title Ar" title="Title Ar">
                                        </div>
                                      </div> 

                                      <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">View financial results Ar: <span class="error">*</span> </label>
                                        <div class="col-sm-9">
<input type="text" name="financial_ar" id="financial_ar" class="form-control" value="" placeholder="Title Ar" title="Title Ar">
                                        
                                      
                                        </div>
                                    </div>
 <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">Profit presentation Ar: <span class="error">*</span> </label>
                                        <div class="col-sm-9">
                                        <input type="text" name="Profit_ar" id="Profit_ar" class="form-control" value="" placeholder="Profit presentation Ar" title="Title Ar">
                                        </div>
                                      </div>
 <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">View the Basel reports Ar: <span class="error">*</span> </label>
                                        <div class="col-sm-9">
                                        <input type="text" name="Basel_ar" id="Basel_ar" class="form-control" value="" placeholder="View the Basel reports ar" title="Title Ar">
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
<script src="{{asset('assets/js/common.js')}}"></script>
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
$("#button_investor").validate({
    rules: {
      annual_en: {
            required: true,  
        },
       
        financial_en: {
            required: true,      
        },
        annual_ar: {
            required: true,
                 
        },
        financial_ar: {
            required: true,
                 
        },
        

    },
    messages: {
      annual_en: {
            required:  "This field is required", 
        },
        financial_en: {
            required:  "This field is required",  
        },
        annual_ar: {
            required:  "This field is required", 
        },
        financial_ar: {
            required:  "This field is required",
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
 


@endpush  


      

         
         
              
             

                

     
