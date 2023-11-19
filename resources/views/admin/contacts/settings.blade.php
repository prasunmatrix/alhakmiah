@extends('admin.layouts.after-login-layout')


@section('unique-content')

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Contact Us Management</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Dashboard</a></li>
              <li class="breadcrumb-item"><a href="#">Contact Us Settings</a></li>
              </a>
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
                      <form action="{{route('admin.contacts.save-contact-settings')}}" method="POST" enctype="multipart/form-data" id="edit_service">
                            {{ csrf_field() }}
                            <input type="hidden" name="encString" value="{{ $encryptCode }}">
                                  <div class="row">

                                        <div class="card card-primary">
                                        <div class="card-header">
                                            <h3 class="card-title">Contact Us Settings</h3>
                                        </div>
                                        </div>

                                          <div class="col-md-12"> 
                                            <div class="form-group row">
                                              <label class="col-sm-3 col-form-label">Contact Us Description En: <span class="error">*</span> </label>
                                              <div class="col-sm-9">
                                              <textarea class="textarea" name="contact_us_text_en" id="contact_us_text_en" placeholder="Contact Us Description En"
                                              style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;">{{ $details->contact_us_text_en}}</textarea>
                                              </div>
                                            </div>
                                          </div>

                                          <div class="col-md-12"> 
                                            <div class="form-group row">
                                              <label class="col-sm-3 col-form-label">Contact Us Description Ar: <span class="error">*</span> </label>
                                              <div class="col-sm-9">
                                              <textarea class="textarea" name="contact_us_text_ar" id="contact_us_text_ar" placeholder="Contact Us Description Ar"
                                              style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;">{{ $details->contact_us_text_ar}}</textarea>
                                              </div>
                                            </div>
                                          </div>


                                          <div class="col-md-12"> 
                                            <div class="form-group row">
                                              <label class="col-sm-3 col-form-label">Contact Us Map: <span class="error">*</span> </label>
                                              <div class="col-sm-9">
                                              <textarea class="textarea" name="contact_us_map" id="contact_us_map" placeholder="Contact Us Map"
                                              style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;">{{ $details->contact_us_map}}</textarea>
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
<script>
  
  $(function () {
    $('.textarea').summernote()
  })

</script>     
@endpush  


      

         
         
              
             

                

     