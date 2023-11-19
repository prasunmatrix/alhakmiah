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
                      <form action="{{route('admin.investor-relations.update')}}" method="POST" enctype="multipart/form-data" id="edit_investor">
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
                                        <label  class="col-sm-3 col-form-label"> Description En: <span class="error">*</span></label>
                                          <div class="col-sm-9">
                                          <textarea class="textarea" name="description_en" id="description_en" placeholder="Description Ar"
                                        style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;">{{  $details->description_en }}</textarea>

                                          </div>
                                        </div>
                                    </div>

                                    {{-- <div class="col-md-12"> 
                                       <div class="form-group row">
                                        <label  class="col-sm-3 col-form-label"> Finacial Results: <span class="error">*</span></label>
                                          <div class="col-sm-9">

                                            <input type="radio" name="type" value='1' @if($details->f_type =="1") checked @endif >Link
                                            <input type="radio" name="type"  value='0' @if($details->f_type =="0") checked @endif >Pdf
                                          </div>
                                      </div>

                                     <div class="form-group row" id="link">
                                        <label class="col-sm-3 col-form-label"> <span class="error"></span> </label>
                                        <div class="col-sm-9"> 
                                        <input type="text" name="financial_link" id="financial_link"  value="{{ $details->financial_link }}" class="form-control" placeholder="Enter link" >

                                        </div>
                                      </div> 

                                      @if (!empty($details->financial_pdf))
                                           <div class="form-group row">
                                              <label class="col-sm-3 col-form-label">Previous Pdf:</label>
                                              <div class="col-sm-9">

                                                <a href="{{ asset('/assets/images/') }}/{{$details->financial_pdf}}" target="_blank">{{$details->financial_pdf}}</a>
                                          
                                              </div>
                                          </div>   
                                    @endif
                                      <div class="form-group row " id="pdf">
                                        <label class="col-sm-3 col-form-label"> <span class="error"></span> </label>
                                        <div class="col-sm-9">
                                          <input type="file" name="financial_pdf" id="financial_pdf" class="form-control" accept=".pdf"> 
                                        </div>
                                      </div> 
                                </div> --}}


                                <!-- annual -->

                                {{-- <div class="col-md-12"> 
                                       <div class="form-group row">
                                        <label  class="col-sm-3 col-form-label"> Annual Reports: <span class="error">*</span></label>
                                          <div class="col-sm-9">

                                            <input type="radio" name="a_type" value='1' @if($details->a_type =="1") checked @endif /> Link

                                            <input type="radio" name="a_type" value="0" @if($details->a_type =="0") checked @endif  /> Pdf
                                          </div>
                                      </div>

                                     <div class="form-group row" id="a_link">
                                        <label class="col-sm-3 col-form-label"> <span class="error"></span> </label>
                                        <div class="col-sm-9"> 
                                        <input type="text" name="annual_link" id="annual_link"  value="{{ $details->annual_link }}" class="form-control" placeholder="Enter link" >

                                        </div>
                                      </div> 

                                      @if (!empty($details->annual_pdf))
                                           <div class="form-group row">
                                              <label class="col-sm-3 col-form-label">Previous Pdf:</label>
                                              <div class="col-sm-9">

                                                <a href="{{ asset('/assets/images/') }}/{{$details->annual_pdf}}" target="_blank">{{$details->annual_pdf}}</a>
                                          
                                              </div>
                                          </div>   
                                    @endif
                                      <div class="form-group row " id="a_pdf">
                                        <label class="col-sm-3 col-form-label"> <span class="error"></span> </label>
                                        <div class="col-sm-9">
                                          <input type="file" name="annual_pdf" id="annual_pdf" class="form-control" accept=".pdf"> 
                                        </div>
                                      </div> 
                                </div> --}}

                                <!-- basel -->

                                {{-- <div class="col-md-12"> 
                                       <div class="form-group row">
                                        <label  class="col-sm-3 col-form-label"> Basel Reports: <span class="error">*</span></label>
                                          <div class="col-sm-9">

                                            <input type="radio" name="b_type" value='1' @if($details->b_type =="1") checked @endif /> Link

                                            <input type="radio" name="b_type" value="0" @if($details->b_type =="0") checked @endif  /> Pdf
                                          </div>
                                      </div>

                                     <div class="form-group row" id="b_link">
                                        <label class="col-sm-3 col-form-label"> <span class="error"></span> </label>
                                        <div class="col-sm-9"> 
                                        <input type="text" name="basel_link" id="basel_link"  value="{{ $details->basel_link }}" class="form-control" placeholder="Enter link" >

                                        </div>
                                      </div> 

                                      @if (!empty($details->basel_pdf))
                                           <div class="form-group row">
                                              <label class="col-sm-3 col-form-label">Previous Pdf:</label>
                                              <div class="col-sm-9">

                                                <a href="{{ asset('/assets/images/') }}/{{$details->basel_pdf}}" target="_blank">{{$details->basel_pdf}}</a>
                                          
                                              </div>
                                          </div>   
                                    @endif
                                      <div class="form-group row " id="b_pdf">
                                        <label class="col-sm-3 col-form-label"> <span class="error"></span> </label>
                                        <div class="col-sm-9">
                                          <input type="file" name="basel_pdf" id="basel_pdf" class="form-control" accept=".pdf"> 
                                        </div>
                                      </div> 
                                </div> --}}

                                <!-- profit -->

                                {{-- <div class="col-md-12"> 
                                       <div class="form-group row">
                                        <label  class="col-sm-3 col-form-label"> Profit Presentation: <span class="error">*</span></label>
                                          <div class="col-sm-9">

                                            <input type="radio" name="p_type" value='1' @if($details->p_type =="1") checked @endif /> Link

                                            <input type="radio" name="p_type" value="0" @if($details->p_type =="0") checked @endif  /> Pdf
                                          </div>
                                      </div>

                                     <div class="form-group row" id="p_link">
                                        <label class="col-sm-3 col-form-label"> <span class="error"></span> </label>
                                        <div class="col-sm-9"> 
                                        <input type="text" name="profit_link" id="profit_link"  value="{{ $details->profit_link }}" class="form-control" placeholder="Enter link" >

                                        </div>
                                      </div> 

                                      @if (!empty($details->profit_pdf))
                                           <div class="form-group row">
                                              <label class="col-sm-3 col-form-label">Previous Pdf:</label>
                                              <div class="col-sm-9">

                                                <a href="{{ asset('/assets/images/') }}/{{$details->profit_pdf}}" target="_blank">{{$details->profit_pdf}}</a>
                                          
                                              </div>
                                          </div>   
                                    @endif
                                      <div class="form-group row " id="p_pdf">
                                        <label class="col-sm-3 col-form-label"> <span class="error"></span> </label>
                                        <div class="col-sm-9">
                                          <input type="file" name="profit_pdf" id="profit_pdf" class="form-control" accept=".pdf"> 
                                        </div>
                                      </div> 
                                </div> --}}
                               

                                    <div class="card card-primary">
                                        <div class="card-header">
                                          <h3 class="card-title">Arabic</h3>
                                        </div>
                                      </div>

                                    <div class="col-md-12"> 
                                      <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">Title Ar: <span class="error">*</span> </label>
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

                                  </div>

                                  <!-- finacial arebic -->

                                  {{-- <div class="col-md-12"> 
                                       <div class="form-group row">
                                        <label  class="col-sm-3 col-form-label"> Finacial Results: <span class="error">*</span></label>
                                          <div class="col-sm-9">

                                            <input type="radio" name="f_type_ar" value='1' @if($details->f_type_ar =="1") checked @endif >Link
                                            <input type="radio" name="f_type_ar"  value='0' @if($details->f_type_ar =="0") checked @endif >Pdf
                                          </div>
                                      </div>

                                     <div class="form-group row" id="f_link_ar">
                                        <label class="col-sm-3 col-form-label"> <span class="error"></span> </label>
                                        <div class="col-sm-9"> 
                                        <input type="text" name="financial_link_ar" id="financial_link_ar"  value="{{ $details->financial_link_ar }}" class="form-control" placeholder="Enter link" >

                                        </div>
                                      </div> 

                                      @if (!empty($details->financial_pdf_ar))
                                           <div class="form-group row">
                                              <label class="col-sm-3 col-form-label">Previous Pdf:</label>
                                              <div class="col-sm-9">

                                                <a href="{{ asset('/assets/images/') }}/{{$details->financial_pdf_ar}}" target="_blank">{{$details->financial_pdf_ar}}</a>
                                          
                                              </div>
                                          </div>   
                                    @endif
                                      <div class="form-group row " id="f_pdf_ar">
                                        <label class="col-sm-3 col-form-label"> <span class="error"></span> </label>
                                        <div class="col-sm-9">
                                          <input type="file" name="financial_pdf_ar" id="financial_pdf_ar" class="form-control" accept=".pdf"> 
                                        </div>
                                      </div> 
                                </div> --}}

                                <!-- annual  -->

                                  {{-- <div class="col-md-12"> 
                                       <div class="form-group row">
                                        <label  class="col-sm-3 col-form-label"> Annual Results: <span class="error">*</span></label>
                                          <div class="col-sm-9">

                                            <input type="radio" name="a_type_ar" value='1' @if($details->a_type_ar =="1") checked @endif >Link
                                            <input type="radio" name="a_type_ar"  value='0' @if($details->a_type_ar =="0") checked @endif >Pdf
                                          </div>
                                      </div>

                                     <div class="form-group row" id="a_link_ar">
                                        <label class="col-sm-3 col-form-label"> <span class="error"></span> </label>
                                        <div class="col-sm-9"> 
                                        <input type="text" name="annual_link_ar" id="annual_link_ar"  value="{{ $details->annual_link_ar }}" class="form-control" placeholder="Enter link" >

                                        </div>
                                      </div> 

                                      @if (!empty($details->annual_pdf_ar))
                                           <div class="form-group row">
                                              <label class="col-sm-3 col-form-label">Previous Pdf:</label>
                                              <div class="col-sm-9">

                                                <a href="{{ asset('/assets/images/') }}/{{$details->annual_pdf_ar}}" target="_blank">{{$details->annual_pdf_ar}}</a>
                                          
                                              </div>
                                          </div>   
                                    @endif
                                      <div class="form-group row " id="a_pdf_ar">
                                        <label class="col-sm-3 col-form-label"> <span class="error"></span> </label>
                                        <div class="col-sm-9">
                                          <input type="file" name="annual_pdf_ar" id="annual_pdf_ar" class="form-control" accept=".pdf"> 
                                        </div>
                                      </div> 
                                </div> --}}

                                <!-- basel  -->

                                  {{-- <div class="col-md-12"> 
                                       <div class="form-group row">
                                        <label  class="col-sm-3 col-form-label"> Basel Report: <span class="error">*</span></label>
                                          <div class="col-sm-9">

                                            <input type="radio" name="b_type_ar" value='1' @if($details->b_type_ar =="1") checked @endif >Link
                                            <input type="radio" name="b_type_ar"  value='0' @if($details->b_type_ar =="0") checked @endif >Pdf
                                          </div>
                                      </div>

                                     <div class="form-group row" id="b_link_ar">
                                        <label class="col-sm-3 col-form-label"> <span class="error"></span> </label>
                                        <div class="col-sm-9"> 
                                        <input type="text" name="basel_link_ar" id="basel_link_ar"  value="{{ $details->basel_link_ar }}" class="form-control" placeholder="Enter link" >

                                        </div>
                                      </div> 

                                      @if (!empty($details->basel_pdf_ar))
                                           <div class="form-group row">
                                              <label class="col-sm-3 col-form-label">Previous Pdf:</label>
                                              <div class="col-sm-9">

                                                <a href="{{ asset('/assets/images/') }}/{{$details->basel_pdf_ar}}" target="_blank">{{$details->basel_pdf_ar}}</a>
                                          
                                              </div>
                                          </div>   
                                    @endif
                                      <div class="form-group row " id="b_pdf_ar">
                                        <label class="col-sm-3 col-form-label"> <span class="error"></span> </label>
                                        <div class="col-sm-9">
                                          <input type="file" name="basel_pdf_ar" id="basel_pdf_ar" class="form-control" accept=".pdf"> 
                                        </div>
                                      </div> 
                                </div> --}}
                                 <!-- profit  -->

                                  {{-- <div class="col-md-12"> 
                                       <div class="form-group row">
                                        <label  class="col-sm-3 col-form-label"> Profit Presentation: <span class="error">*</span></label>
                                          <div class="col-sm-9">

                                            <input type="radio" name="p_type_ar" value='1' @if($details->p_type_ar =="1") checked @endif >Link
                                            <input type="radio" name="p_type_ar"  value='0' @if($details->p_type_ar =="0") checked @endif >Pdf
                                          </div>
                                      </div>

                                     <div class="form-group row" id="p_link_ar">
                                        <label class="col-sm-3 col-form-label"> <span class="error"></span> </label>
                                        <div class="col-sm-9"> 
                                        <input type="text" name="profit_link_ar" id="profit_link_ar"  value="{{ $details->profit_link_ar }}" class="form-control" placeholder="Enter link" >

                                        </div>
                                      </div> 

                                      @if (!empty($details->profit_pdf_ar))
                                           <div class="form-group row">
                                              <label class="col-sm-3 col-form-label">Previous Pdf:</label>
                                              <div class="col-sm-9">

                                                <a href="{{ asset('/assets/images/') }}/{{$details->profit_pdf_ar}}" target="_blank">{{$details->profit_pdf_ar}}</a>
                                          
                                              </div>
                                          </div>   
                                    @endif
                                      <div class="form-group row " id="p_pdf_ar">
                                        <label class="col-sm-3 col-form-label"> <span class="error"></span> </label>
                                        <div class="col-sm-9">
                                          <input type="file" name="profit_pdf_ar" id="profit_pdf_ar" class="form-control" accept=".pdf"> 
                                        </div>
                                      </div> 
                                </div> --}}


                                     

                                      <div class="card card-primary">
                                        <div class="card-header">
                                          <h3 class="card-title">General</h3>
                                        </div>
                                      </div>

                                    <div class="col-md-12">
                                     @if (!empty($details->banner))
                                           <div class="form-group row">
                                              <label class="col-sm-3 col-form-label">Previous Banner:</label>
                                              <div class="col-sm-9">

                                                <img src="{{ asset('assets/images/'.$details->banner.'') }}" alt="" height="100" width="70%" >
                                                <input type="hidden" name="old_banner"  id="old_banner"  class="form-control" value="{{$details->banner}}"  >
                                              </div>
                                          </div> 
                                           
                                  @endif
                                    
                                 <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">Investor Banner :</label>
                                        <div class="col-sm-9">
                                            <input type="file" name="banner"  id="banner"  class="form-control" accept="image/*">
                                             <span class="system required" style="color: red;">(Recommended Image Size: 1529 &times; 829)*</span>
                                        </div>
                                      </div> 

                                      <div class="form-group row">
                                      <label  class="col-sm-3 col-form-label" ></label>
                                      <div class="col-sm-9">
                                        <div class="row bannerImages" >
                                        
                                        </div>
                                      </div>
                                    </div>
                                  </div>

                                    <div class="col-md-12" style="display: none">      
                                     <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">Status: <span class="error">*</span></label>
                                        <div class="col-sm-9">
                                        <select class="form-control select2 select2-danger select2bs4" name="status" id="status"        data-dropdown-css-class="select2-danger" style="width: 100%;">
                                            <option value="">Choose option</option>
                                            <option value="A" {{ $details->status == 'A' ? 'selected' : '' }}>Active</option>
                                            <option value="I" {{ $details->status == 'I' ? 'selected' : '' }} >Inactive</option>
                                        </select>
                                        </div>
                                      </div>

                                    </div>

                                    <div class="col-md-12">
                                      <div class="form-group row">
                                        <label  class="col-sm-3 col-form-label"> Heading En: <span class="error">*</span></label>
                                          <div class="col-sm-9">
                                            <input type="text" name="heading_en" id="heading_en" class="form-control" value="{{ $details->heading_en }}" placeholder="Heading En" title="Heading En">
                                          </div>
                                        </div>
                                        <div class="form-group row">
                                        <label  class="col-sm-3 col-form-label"> Heading Ar: <span class="error">*</span></label>
                                          <div class="col-sm-9">
                                            <input type="text" name="heading_ar" id="heading_ar" class="form-control" value="{{ $details->heading_ar }}" placeholder="Heading Ar" title="Heading Ar">
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
$("#edit_investor").validate({
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
        year:{
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


      

         
         
              
             

                

     