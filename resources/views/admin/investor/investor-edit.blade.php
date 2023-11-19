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
                      <form action="{{route('admin.investor-relations.Save')}}" method="POST" enctype="multipart/form-data" id="edit_investor">
                            {{ csrf_field() }}
                            <input type="hidden" name="encString" value="{{ $encryptCode }}">
                          <div class="row">

                              <div class="card card-primary">
                                <div class="card-header">
                                  <h3 class="card-title">English</h3>
                                </div>
                            </div>
                                <!-- annual -->

                               

                                <div class="col-md-12"> 
                                    @if (!empty($details->annual_pdf))
                                    <div class="form-group row" id="annual_pdf_{{$details->id}}">
                                       <label class="col-sm-3 col-form-label">Previous Pdf:</label>
                                       <div class="col-sm-9">

                                         <a href="{{ asset('/assets/annual-pdf/'.$details->annual_pdf) }}" target="_blank">{{$details->annual_pdf}}</a>
                                         <button style="background:red;border:none;color:white;border-radius:3px;" class="deletemedia" data-id="{{$details->id}}" data-source="annual_pdf">Delete</button>
                                       </div>
                                   </div>   
                                @endif
                                      <div class="form-group row " id="a_pdf">
                                        <label class="col-sm-3 col-form-label">Annual Results: <span class="error"></span> </label>
                                        <div class="col-sm-9">
                                          <input type="file" name="annual_pdf" id="annual_pdf" class="form-control" accept=".pdf"> 
                                          <span class="system required" style="color: red;">(only  pdf file allowed)*</span>
                                        </div>
                                      </div> 
                                </div>

                                <!-- basel -->

                                <div class="col-md-12"> 
                                    @if (!empty($details->basel_pdf))
                                           <div class="form-group row" id="basel_pdf_{{$details->id}}">
                                              <label class="col-sm-3 col-form-label">Previous Pdf:</label>
                                              <div class="col-sm-9">

                                                <a href="{{ asset('/assets/basel-pdf/'.$details->basel_pdf) }}" target="_blank">{{$details->basel_pdf}}</a>
                                                <button style="background:red;border:none;color:white;border-radius:3px;" class="deletemedia" data-id="{{$details->id}}" data-source="basel_pdf">Delete</button>
                                              </div>
                                          </div>   
                                    @endif
                                      <div class="form-group row " id="b_pdf">
                                        <label class="col-sm-3 col-form-label"> Basel Report:<span class="error"></span> </label>
                                        <div class="col-sm-9">
                                          <input type="file" name="basel_pdf" id="basel_pdf" class="form-control" accept=".pdf"> 
                                          <span class="system required" style="color: red;">(only  pdf file allowed)*</span>
                                        </div>
                                      </div> 
                                </div>

                                <!-- profit -->

                                <div class="col-md-12"> 
                                    @if (!empty($details->profit_pdf))
                                    <div class="form-group row" id="profit_pdf_{{$details->id}}">
                                       <label class="col-sm-3 col-form-label">Previous Pdf:</label>
                                       <div class="col-sm-9">

                                         <a href="{{ asset('/assets/profit-pdf/') }}/{{$details->profit_pdf}}" target="_blank">{{$details->profit_pdf}}</a>
                                         <button style="background:red;border:none;color:white;border-radius:3px;" class="deletemedia" data-id="{{$details->id}}" data-source="profit_pdf">Delete</button> 
                                       </div>
                                   </div>   
                                    @endif
                                      <div class="form-group row " id="p_pdf">
                                        <label class="col-sm-3 col-form-label">Profit Presentation <span class="error"></span> </label>
                                        <div class="col-sm-9">
                                          <input type="file" name="profit_pdf" id="profit_pdf" class="form-control" accept=".pdf"> 
                                          <span class="system required" style="color: red;">(only  pdf file allowed)*</span>
                                        </div>
                                      </div> 
                                </div>

                                
                                <div class="col-md-12">
                                    @if (!empty($details->financial_pdf))
                                <div class="form-group row" id="financial_pdf_{{$details->id}}">
                                   <label class="col-sm-3 col-form-label">Previous Pdf:</label>
                                   <div class="col-sm-9">

                                     <a href="{{ asset('/assets/financial-pdf/'.$details->financial_pdf) }}" target="_blank">{{$details->financial_pdf}}</a>
                                     <button style="background:red;border:none;color:white;border-radius:3px;" class="deletemedia" data-id="{{$details->id}}" data-source="financial_pdf">Delete</button> 
                                   </div>
                                </div>   
                                @endif
 
                                    <div class="form-group row " >
                                      <label class="col-sm-3 col-form-label"> Finacial Results:<span class="error"></span> </label>
                                      <div class="col-sm-9">
                                        <input type="file" name="financial_pdf" id="financial_pdf" class="form-control" accept=".pdf"> 
                                        <span class="system required" style="color: red;">(only  pdf file allowed)*</span>
                                      </div>
                                    </div>
                                    
                              </div>

                                    <div class="card card-primary">
                                        <div class="card-header">
                                          <h3 class="card-title">Arabic</h3>
                                        </div>
                                      </div>
                                  <!-- finacial arebic -->

                                  <div class="col-md-12"> 
                                    @if (!empty($details->financial_pdf_ar))
                                    <div class="form-group row" id="financial_pdf_ar_{{$details->id}}">
                                       <label class="col-sm-3 col-form-label">Previous Pdf:</label>
                                       <div class="col-sm-9">

                                         <a href="{{ asset('/assets/financial-pdf/'.$details->financial_pdf_ar) }}" target="_blank">{{$details->financial_pdf_ar}}</a>
                                         <button style="background:red;border:none;color:white;border-radius:3px;" class="deletemedia" data-id="{{$details->id}}" data-source="financial_pdf_ar">Delete</button>
                                       </div>
                                   </div>   
                             @endif
                                      <div class="form-group row " id="f_pdf_ar">
                                        <label class="col-sm-3 col-form-label"> Finacial Results:<span class="error"></span> </label>
                                        <div class="col-sm-9">
                                          <input type="file" name="financial_pdf_ar" id="financial_pdf_ar" class="form-control" accept=".pdf">
                                          <span class="system required" style="color: red;">(only  pdf file allowed)*</span> 
                                        </div>
                                      </div> 
                                </div>

                                <!-- annual  -->

                                  <div class="col-md-12"> 

                                    @if (!empty($details->annual_pdf_ar))
                                    <div class="form-group row" id="annual_pdf_ar_{{$details->id}}">
                                       <label class="col-sm-3 col-form-label">Previous Pdf:</label>
                                       <div class="col-sm-9">

                                         <a href="{{ asset('/assets/annual-pdf/'.$details->annual_pdf_ar) }}" target="_blank">{{$details->annual_pdf_ar}}</a>
                                         <button style="background:red;border:none;color:white;border-radius:3px;" class="deletemedia" data-id="{{$details->id}}" data-source="annual_pdf_ar">Delete</button>
                                       </div>
                                    </div>   
                                    @endif
                                      <div class="form-group row " id="a_pdf_ar">
                                        <label class="col-sm-3 col-form-label">Annual Results: <span class="error"></span> </label>
                                        <div class="col-sm-9">
                                          <input type="file" name="annual_pdf_ar" id="annual_pdf_ar" class="form-control" accept=".pdf"> 
                                          <span class="system required" style="color: red;">(only  pdf file allowed)*</span>
                                        </div>
                                      </div> 
                                </div>

                                <!-- basel  -->

                                  <div class="col-md-12"> 
                                    @if (!empty($details->basel_pdf_ar))
                                    <div class="form-group row" id="basel_pdf_ar_{{$details->id}}">
                                       <label class="col-sm-3 col-form-label">Previous Pdf:</label>
                                       <div class="col-sm-9">

                                         <a href="{{ asset('/assets/basel-pdf/'.$details->basel_pdf_ar) }}" target="_blank">{{$details->basel_pdf_ar}}</a>
                                         <button style="background:red;border:none;color:white;border-radius:3px;" class="deletemedia" data-id="{{$details->id}}" data-source="basel_pdf_ar">Delete</button>
                                       </div>
                                     </div>   
                                    @endif
                                      <div class="form-group row " id="b_pdf_ar">
                                        <label class="col-sm-3 col-form-label">Basel Report: <span class="error"></span> </label>
                                        <div class="col-sm-9">
                                          <input type="file" name="basel_pdf_ar" id="basel_pdf_ar" class="form-control" accept=".pdf">
                                          <span class="system required" style="color: red;">(only  pdf file allowed)*</span> 
                                        </div>
                                      </div> 
                                </div>
                                 <!-- profit  -->

                                  <div class="col-md-12"> 
                                    @if (!empty($details->profit_pdf_ar))
                                    <div class="form-group row" id="profit_pdf_ar_{{$details->id}}">
                                       <label class="col-sm-3 col-form-label">Previous Pdf:</label>
                                       <div class="col-sm-9">

                                         <a href="{{ asset('/assets/profit-pdf/'.$details->profit_pdf_ar) }}" target="_blank">{{$details->profit_pdf_ar}}</a>
                                         <button style="background:red;border:none;color:white;border-radius:3px;" class="deletemedia" data-id="{{$details->id}}" data-source="profit_pdf_ar">Delete</button>
                                       </div>
                                     </div>   
                                    @endif
                                      <div class="form-group row " id="p_pdf_ar">
                                        <label class="col-sm-3 col-form-label"> Profit Presentation:<span class="error"></span> </label>
                                        <div class="col-sm-9">
                                          <input type="file" name="profit_pdf_ar" id="profit_pdf_ar" class="form-control" accept=".pdf"> 
                                          <span class="system required" style="color: red;">(only  pdf file allowed)*</span>
                                        </div>
                                      </div> 
                                </div>

                                <div class="card card-primary">
                                    <div class="card-header">
                                      <h3 class="card-title">General</h3>
                                    </div>
                                  </div>
                                <div class="col-md-12">  
                                    
                                    <div class="form-group row " id="b_pdf">
                                        <label class="col-sm-3 col-form-label"> Year:<span class="error"></span> </label>
                                        <div class="col-sm-9">
                                          <input type="text" name="year" id="year" class="form-control" value={{ $details->year }} placeholder="Year" title="Year"> 
                                        </div>
                                      </div> 
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
                  var  pdfId = $(this).attr('data-id'); 
                  var  pdfsource = $(this).attr('data-source');
                  if(pdfId != 0){
                    var fdata = new FormData();
                    fdata.append("_token","{{ csrf_token() }}");
                    fdata.append("pdfId",pdfId);
                    fdata.append("pdfsource",pdfsource);

                    $.ajax({
                        type: "POST",
                        dataType:'JSON',
                        contentType: false,
                        processData: false, 
                        url: "{{ route('admin.investor-relations.investor-pdf-delete') }}",
                        data: fdata,
                        success: function(response)
                        {
                          //alert(response.has_error);  
                          if(response.has_error == 0){
                              $('#'+pdfsource+'_'+pdfId).remove();
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
                  } /*else{
                    $(this).parent().parent().parent().parent().remove();
                    $(document).Toasts('create', {
                                        class: 'bg-info', 
                                        title: 'Success',
                                        body: "Successfully Removed.",
                                        delay: 3000,
                                        autohide:true
                                });
                  }*/
                    
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
$("#edit_investor").validate({
    rules: {
      name_en: {
            required: true,  
        },
       
        name_ar: {
            required: true,      
        },
        description_en: {
            required: true,
                 
        },
        description_ar: {
            required: true,
                 
        },
        year:{
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
        description_en: {
            required:  "This field is required", 
        },
        description_ar: {
            required:  "This field is required",
        },
        year: {
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


      

         
         
              
             

                

     