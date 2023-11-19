@extends('admin.layouts.after-login-layout')


@section('unique-content')

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Position Management</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Dashboard</a></li>
              <li class="breadcrumb-item"><a href="{{route('admin.category.list')}}">Position List</a></li>
              <li class="breadcrumb-item active">Position Create</li>
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
                      <form action="{{route('admin.position.position.Save')}}" method="POST" enctype="multipart/form-data" id="position_add">
                            {{ csrf_field() }}
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
                                          <input type="text" name="name_en" id="name_en" class="form-control" placeholder="Titlr En" title="Titlr En">
                                        </div>
                                      </div>

                                      <div class="form-group row">
                                      <label  class="col-sm-3 col-form-label"> Designation En: <span class="error">*</span></label>
                                        <div class="col-sm-9">
                                          <input type="text" name="designation_en" id="designation_en" class="form-control" placeholder="Designation En" title="Designation En">
                                        </div>
                                      </div>
                                     
                                      <div class="form-group row">
                                      <label  class="col-sm-3 col-form-label"> Description En: <span class="error">*</span></label>
                                        <div class="col-sm-9">
                                          <input type="text" name="description_en" id="description_en" class="form-control" placeholder="Description En" title="Description En">
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
                                          <input type="text" name="name_ar" id="name_ar" class="form-control" placeholder="Titlr Ar" title="Titlr Ar">
                                        </div>
                                      </div>
                                  </div>

                                  <div class="col-md-12"> 
                                      <div class="form-group row">
                                      <label  class="col-sm-3 col-form-label"> Designation Ar: <span class="error">*</span></label>
                                        <div class="col-sm-9">
                                          <input type="text" name="designation_ar" id="designation_ar" class="form-control" placeholder="Designation Ar" title="Designation Ar">
                                        </div>
                                      </div>
                                  </div>

                                  <div class="col-md-12"> 
                                      <div class="form-group row">
                                      <label  class="col-sm-3 col-form-label"> Description Ar: <span class="error">*</span></label>
                                        <div class="col-sm-9">
                                          <input type="text" name="description_ar" id="description_ar" class="form-control" placeholder="Description Ar" title="Description Ar">
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
                                      <label  class="col-sm-3 col-form-label">Category: <span class="error">*</span></label>
                                        <div class="col-sm-9">
                                          <select class="form-control select2 select2-danger select2bs4" name="category" id="category" data-dropdown-css-class="select2-danger" style="width: 100%;" required>
                                            <option value="">Choose option</option>
                                            @foreach($categories as $cat)
                                              <option value="{{$cat->id}}">{{$cat->name_en}} / {{$cat->name_ar}}</option>
                                            @endforeach
                                        </select>
                                        </div>
                                      </div>

                                      <div class="form-group row">
                                      <label  class="col-sm-3 col-form-label">Sub Category: </label>
                                        <div class="col-sm-9">
                                          <select class="form-control select2 select2-danger select2bs4" name="subcategory" id="subcategory" data-dropdown-css-class="select2-danger" style="width: 100%;">
                                            <option value="">Choose option</option>
                                            {{--@foreach($categories as $cat)
                                              <option value="{{$cat->id}}">{{$cat->name_en}} / {{$cat->name_ar}}</option>
                                            @endforeach--}}
                                        </select>
                                        </div>
                                      </div>  
                                   
                                  <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">Image:<span class="error">*</span></label>
                                        <div class="col-sm-9">
                                            <input type="file" name="ceo_image"  id="ceo_image"  class="form-control" >
                                            <span class="system required" style="color: red;">(Recommended Image Size: 600 &times; 550)*</span>
                                        </div>
                                    </div> 
                                    <div class="form-group row">
                                      <label  class="col-sm-3 col-form-label" > Image : </label>
                                      <div class="col-sm-9">
                                        <div class="row bannerImages" >
                                        
                                        </div>
                                      </div>
                                    </div> 
                                   
                                    
                                      <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">Status: <span class="error">*</span></label>
                                        <div class="col-sm-9">
                                        <select class="form-control select2 select2-danger select2bs4" name="status" data-dropdown-css-class="select2-danger" style="width: 100%;">
                                            <option value="">Choose option</option>
                                            <option value="A" selected>Active</option>
                                            <option value="I">Inactive</option>
                                        </select>
                                        </div>
                                     

                                    </div>
                                    <div class="card-footer">
                                      <div class="">
                                          <a class="btn btn-primary back_new" href="{{route('admin.position.list')}}">Back</a>
                                          <button id="" type="submit" class="btn btn-success submit_new">Add</button>
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

<script type="text/javascript">
    $(document).ready(function() {
        $('select[name="category"]').on('change', function() {
            var cat_id = $(this).val();
			//alert(cat_id);
            if(cat_id) {
              var fdata = new FormData();
              
              fdata.append("_token","{{ csrf_token() }}");
              fdata.append("cat_id",cat_id);
                $.ajax({
                    url: "{{ route('admin.position.getsubcategory') }}",
                    type: "POST",
                    contentType: false,
                    processData: false, 
                    data:fdata,
                    dataType: "json",
                    success:function(data) {
                        console.log(data.record);
                        $('select[name="subcategory"]').empty();
                        var optionSubCat ='<option value="">Choose Option</option>';
                        //var optionSubCat ='';
                        $.each(data.record, function(key, value) {
                            optionSubCat +='<option value="'+ value.id +'">'+ value.name_en +'/'+value.name_ar +'</option>';
                            
                        });
                        $('select[name="subcategory"]').html(optionSubCat);;

                    }
                });
            }else{
                $('select[name="subcategory"]').empty();
            }
        });
    });
</script>

<script>

$(function () {
    $('.textarea').summernote()
  })

$('#custom7').on('change', function(){
   this.value = this.checked ? 1 : 0;
   // alert(this.value);
}).change();
  
//  $(function () {
//     // Summernote
//     $('.textarea').summernote()
//   })  

$(function () {
  //Initialize Select2 Elements
  $('.select2bs4').select2({
          theme: 'bootstrap4'
  }) 
  
  $('#date').daterangepicker({
      singleDatePicker: true,
      showDropdowns: true,
        defaultViewDate:{},
        locale: {
            format: 'DD/MM/YYYY'
        }
    });
})





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
// $.validator.addMethod("valid_number", function(value, element) {
//     if (/^[0-9]\d*(\.\d+)?$/.test(value)) {
//         return true;
//     } else {
//         return false;
//     }
// });

$("#position_add").validate({
    rules: {
      name_en: {
            required: true,  
        },
        name_ar: {
            required: true,      
        },
        category:{
          required: true,
        },
        designation_en:{
          required: true,
        },
        designation_ar:{
          required: true,
        },
        description_en:{
          required: true,
        },
        description_ar:{
          required: true,
        },
        status:{
            required:true,
        },

    },
    
    messages: {
      name_en: {
            required:  "This field is required", 
        },
        name_ar: {
            required:  "This field is required",  
        },
        category: {
            required:  "This field is required",  
        },
        designation_en: {
            required:  "This field is required",  
        },
        designation_ar: {
            required:  "This field is required",  
        },
        description_en: {
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

   /*function readURL(input, place, counter) {
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

  $("#slider_1").change(function() {
      readURL(this, 'sliderImages1',0);
  });
  $("#slider_2").change(function() {
      readURL(this, 'sliderImages2',0);
  });*/

  function readURL1(input) {
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

  $("#ceo_image").change(function() {
      readURL(this, 'bannerImages',0);
  });
</script>
@endpush

      

         
         
              
             

                

     