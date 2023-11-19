@extends('admin.layouts.after-login-layout')


@section('unique-content')

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Cms Management</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Dashboard</a></li>
              <li class="breadcrumb-item"><a href="{{route('admin.cms-management.cms.list')}}">Cms List</a></li>
              <li class="breadcrumb-item active">Cms Edit</li>
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
                      <form action="{{route('admin.cms-management.cms-save')}}" method="POST" enctype="multipart/form-data" id="edit_cms">
                            {{ csrf_field() }}
                            <input type="hidden" name="encString" value="{{ $encryptCode }}">
                          <div class="row">
                              <div class="col-md-12">
                              
                                      <div class="form-group row">
                                      <label  class="col-sm-3 col-form-label"> Name En: <span class="error">*</span></label>
                                        <div class="col-sm-9">
                                          <input type="text" name="name_en" id="name_en" class="form-control" value="{{ $details->name_en }}" placeholder="Name En" title="Name En">
                                        </div>
                                      </div>
                                      <div class="form-group row">
                                        <label  class="col-sm-3 col-form-label"> Name Ar: <span class="error">*</span></label>
                                          <div class="col-sm-9">
                                            <input type="text" name="name_ar" id="name_ar" class="form-control" value="{{ $details->name_ar }}" placeholder="Name Ar" title="Name Ar">
                                          </div>
                                        </div>
                                      
                                      <div class="form-group row">
                                      <label class="col-sm-3 col-form-label"> </label>
                                      <?php
                                        $link1='1. <a href="#linkone">Link One Label</a>';
                                        $middleText= 'Target Area';
                                        $linkgoes1='<a id="linkone"></a>'.'<p>'.
                                        'Text here.....
                                        Text here..... 
                                        Text here.....'.'</p>';
                                      ?>
                                      <div class="col-sm-9">
                                      <div class="tooltipq"><b style="color:blue;">Same page linking:</b>
                                        <span class="tooltiptextq">{{ $link1 }}</br>
                                        <p style="color:red;"><b>Target area</b></p>
                                       {{$linkgoes1}}
                                       </span>
                                      </div>
                                        
                                      </div> 
                                      </div>
                                        
                                      <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">Description En: <span class="error">*</span> </label>
                                        <div class="col-sm-9">
                                        <textarea class="textarea" name="description_en" id="description_en" placeholder="Description En"
                                        style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;">{{ $details->description_en }}</textarea>
                                        <div class="descrip_en_sandip" style="display:none;"></div>    
                                      </div>
                                      </div> 

                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">Description Ar: <span class="error">*</span> </label>
                                        <div class="col-sm-9">
                                        <textarea class="textarea" name="description_ar" id="description_ar" placeholder="Description Ar"
                                        style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;">{{ $details->description_ar }}</textarea>
                                        <div class="descrip_ar_sandip" style="display:none;"></div>
                                        <input type="hidden" value="" id="ar_editor_id">
                                        <input type="hidden" value="" id="ar_editorclsdync">    
                                      </div>
                                    </div>
                                  <!--   <div class="form-group row">
                                        <label  class="col-sm-3 col-form-label" >Banner Image : </label>
                                        <div class="col-sm-9">
                                          <div class="row cmsImages" >
                                            @foreach ($details->SliderImage as $data )
                                              @php $chkd = ''; if ($data->is_checked == 'Y') $chkd = 'checked'; @endphp
                                              <div id="{{ 'imageDiv'.$data->id.'' }}" class="col-sm-3">
                                                <img src="{{ asset('assets/cms/banner_images/'.$data->path.'') }}" alt="" height="100" width="100%" id="brand_icon">
                                                <div style="margin-top: 5px;">
                                                  <div class="row">
                                                    <div class="col-sm-6">
                                                      <button style="background:red;border:none;color:white;border-radius:3px;" class="deletemedia" data-id="{{ $data->id }}" data-encrypt="{{ encrypt($data->id, Config::get('Constant.ENC_KEY')) }}">Delete</button>
                                                    </div>
                                                    <div class="col-sm-6">
                                                      <div style="text-align: right">
                                                        <input type="checkbox" name="bannerImage[{{ $data->id }}]" value="Y" {{ $chkd }} />
                                                      </div>
                                                    </div>
                                                  </div>
                                                </div>
                                              </div>
                                            @endforeach
                                          </div>
                                      </div>
                                    </div> 
 -->
 <!----------------- SEO start !-------->
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
                                <div class="col-md-12">

                                  @if (!empty($details->banner_image))
                                           <div class="form-group row">
                                              <label class="col-sm-3 col-form-label">Previous Banner:</label>
                                              <div class="col-sm-9">

                                                <img src="{{ asset('assets/cms/banner_images/'.$details->banner_image.'') }}" alt="" height="100" width="70%" >
                                                <input type="hidden" name="old_banner"  id="old_banner"  class="form-control" value="{{$details->banner_image}}"  >
                                              </div>
                                          </div> 
                                           
                                  @endif
                                    
                                 <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">Banner Image:</label>
                                        <div class="col-sm-9">
                                            <input type="file" name="banner_image"  id="banner_image"  class="form-control">
                                            <span class="system required" style="color: red;">(Recommended Image Size: 1530 &times; 830)*</span>
                                        </div>
                                      </div> 

                                      <div class="form-group row">
                                      <label  class="col-sm-3 col-form-label" >Selected Banner Images : </label>
                                      <div class="col-sm-9">
                                        <div class="row bannerImages" >
                                        
                                        </div>
                                      </div>
                                    </div>

                                    <div class="form-group row">
                                      <label  class="col-sm-3 col-form-label"> Banner Title En: </label>
                                        <div class="col-sm-9">
                                          <input type="text" name="page_title_en" id="page_title_en" class="form-control" value="{{ $details->page_title_en }}" placeholder="Banner Title En" title="Banner Title En">
                                        </div>
                                      </div>
                                      <div class="form-group row">
                                        <label  class="col-sm-3 col-form-label"> Banner Title Ar: </label>
                                          <div class="col-sm-9">
                                            <input type="text" name="page_title_ar" id="page_title_ar" class="form-control" value="{{ $details->page_title_ar }}" placeholder="Banner Title Ar" title="Banner Title Ar">
                                          </div>
                                        </div>    
                                    
                                        <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">Display Under About: <span class="error">*</span></label>
                                        <div class="col-sm-9">
                                        <select class="form-control select2 select2-danger select2bs4" name="displayabout" data-dropdown-css-class="select2-danger" style="width: 100%;">
                                            <option value="">Choose option</option>
                                            <option value="1" {{ $details->displayabout == '1' ? 'selected' : '' }}>Yes</option>
                                            <option value="0" {{ $details->displayabout == '0' ? 'selected' : '' }} >No</option>
                                        </select>
                                        </div>
                                      </div>

                                      <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">Display Under Investor Relations: <span class="error">*</span></label>
                                        <div class="col-sm-9">
                                        <select class="form-control select2 select2-danger select2bs4" name="displayunderinvestor" data-dropdown-css-class="select2-danger" style="width: 100%;">
                                            <option value="">Choose option</option>
                                            <option value="1" {{ $details->displayunderinvestor == '1' ? 'selected' : '' }}>Yes</option>
                                            <option value="0" {{ $details->displayunderinvestor == '0' ? 'selected' : '' }} >No</option>
                                        </select>
                                        </div>
                                      </div>

                                      <div class="form-group row">
                                        <label  class="col-sm-3 col-form-label"> Display Order: <span class="error">*</span></label>
                                          <div class="col-sm-9">
                                            <input type="text" name="display_order" id="display_order" class="form-control" value="{{ $details->display_order }}" placeholder=" Display Order" title=" Display Order">
                                          </div>
                                        </div> 
                                    
                                        @if (!empty($details->brochure_en))
                                           <div class="form-group row">
                                              <label class="col-sm-3 col-form-label">Previous Profile:</label>
                                              <div class="col-sm-9">

                                                <a href="{{ asset('assets/cms/brochure/brochure_en') }}/{{$details->brochure_en}}" target="_blank">{{$details->brochure_en}}</a>
                                                <input type="hidden" name="old_brochure"  id="old_brochure"  class="form-control" value="{{$details->brochure_en}}" required>
                                              </div>
                                          </div> 
                                           
                                        @endif

                                        <div class="form-group row">
                                          <label class="col-sm-3 col-form-label">Company Profile En:</label>
                                          <div class="col-sm-9">
                                              <input type="file" name="brochure_en"  id="brochure_en"  class="form-control" accept="application/pdf">
                                              <span class="system required" style="color: red;">(Only pdf file allowed.)*
                                          </div>
                                        </div>

                                    
                                        @if (!empty($details->brochure_ar))
                                              <div class="form-group row">
                                                  <label class="col-sm-3 col-form-label">Previous Profile:</label>
                                                  <div class="col-sm-9">

                                                    <a href="{{ asset('assets/cms/brochure/brochure_ar') }}/{{$details->brochure_ar}}" target="_blank">{{$details->brochure_ar}}</a>
                                                    <input type="hidden" name="old_brochure_ar"  id="old_brochure_ar"  class="form-control" value="{{$details->brochure_ar}}" required>
                                                  </div>
                                              </div> 
                                              
                                        @endif

                                    
                                        <div class="form-group row">
                                            <label class="col-sm-3 col-form-label">Company Profile Ar:</label>
                                            <div class="col-sm-9">
                                                <input type="file" name="brochure_ar"  id="brochure_ar"  class="form-control" accept="application/pdf">
                                                <span class="system required" style="color: red;">(Only pdf file allowed.)*
                                            </div>
                                        </div> 

                                      <div class="form-group row">
                                      <label  class="col-sm-3 col-form-label"> Download Button Label En: </label>
                                        <div class="col-sm-9">
                                          <input type="text" name="brochure_label_en" id="brochure_label_en" class="form-control" value="{{ $details->brochure_label_en }}" placeholder="Brochure Label En" title="Brochure Label En">
                                        </div>
                                      </div>
                                      <div class="form-group row">
                                        <label  class="col-sm-3 col-form-label"> Download Button Label Ar: </label>
                                          <div class="col-sm-9">
                                            <input type="text" name="brochure_label_ar" id="brochure_label_ar" class="form-control" value="{{ $details->brochure_label_ar }}" placeholder="Brochure Label Ar" title="Brochure Label Ar">
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
                                    <div class="card-footer">
                                      <div class="">
                                          <a class="btn btn-primary back_new" href="{{route('admin.cms-management.cms.list')}}">Back</a>
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
<style>
.tooltipq {
  position: relative;
  display: inline-block;
  border-bottom: 1px dotted black;
}

.tooltipq .tooltiptextq {
  visibility: hidden;
  width: 180px;
  background-color: black;
  color: #fff;
  text-align: center;
  border-radius: 6px;
  padding: 5px 0;

  /* Position the tooltip */
  position: absolute;
  z-index: 1;
}

.tooltipq:hover .tooltiptextq {
  visibility: visible;
}
</style>
@push('custom-scripts')
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script src="{{asset('assets/plugins/toastr/toastr.min.js')}}"></script>

<script>
 CKEDITOR.replace( 'description_en', {
	filebrowserBrowseUrl: '/alhakmiah/public/assets/plugins/ckeditor/ckfinder/ckfinder.html',
	filebrowserUploadUrl: '/alhakmiah/public/assets/plugins/ckeditor/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files'
} );
</script>
<script>
  CKEDITOR.replace( 'description_ar', {
	filebrowserBrowseUrl: '/alhakmiah/public/assets/plugins/ckeditor/ckfinder/ckfinder.html',
	filebrowserUploadUrl: '/alhakmiah/public/assets/plugins/ckeditor/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files'
} );
</script>

<script>
  /*$(function () {
    $('.textarea').summernote()
  })*/
//for multiple image
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

  $("#banner_image").change(function() {
      readURL(this, 'bannerImages',0);
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
$("#edit_cms").validate({
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
        // banner_image:{
        //     required: true,
        // },
        display_order:{
            required:true,
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
        // banner_image: {
        //     required:  "This field is required",  
        // },
        display_order: {
          required: "This field is required"  
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

$(document).ready(function(){ 
  $(document).on("click",".note-link-btn",function(){

  setTimeout(function(){
  console.log($("#description_en").val());
  $(".descrip_en_sandip").html($("#description_en").val());
  $('#description_en').summernote('code', '');
  $(".descrip_en_sandip").find("a[href*='"+$('.note-link-url1').val()+"']").addClass($(".note-link-text-cls").val());

  $('#description_en').summernote('code', $(".descrip_en_sandip").html());

    },1000);
  })

  $(document).on("keyup",".note-link-url",function(){
   $("#ar_editor_id").val("");
  var docurl = $(this).val();
  $("#ar_editor_id").val(docurl);
})
$(document).on("keyup",".note-link-text-cls",function(){
  $("#ar_editorclsdync").val("");
  var docclass = $(this).val();
  $("#ar_editorclsdync").val(docclass);
})
$(document).on("click",".note-link-btn",function(){
  setTimeout(function(){

  
  $(".descrip_ar_sandip").html($("#description_ar").val());
//console.log(this.href);
let arb_id = $("#ar_editor_id").val();

  $('#description_ar').summernote('code', '');
  $(".descrip_ar_sandip").find("a[href*='"+arb_id+"']").addClass($("#ar_editorclsdync").val());

  $('#description_ar').summernote('code', $(".descrip_ar_sandip").html());
    },1000);
  })
});

</script>     
@endpush  


      

         
         
              
             

                

     