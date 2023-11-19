@extends('admin.layouts.after-login-layout')

@section('unique-content')
<div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark">Cms Management</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{route('admin.'.\App::getLocale().'.dashboard')}}">Home</a></li>
                            <li class="breadcrumb-item active">Cms List</li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->
    <section class="content">
        <div class="container-fluid">
            <!-- Small boxes (Stat box) -->
            <div class="card card-primary">
                <div class="card-header">
                  <h3 class="card-title">{{$panel_title}}</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                  <div class="card-body">
                    <div class="form-group">
                        <label for="name">Page Title:</label>
                        @if(isset($pageDetails->name)){{ $pageDetails->name }}@endif
                    </div> 
                    <div class="form-group">
                        <label for="rules">Page Details:</label>
                        @if(isset($pageDetails->description)){!! $pageDetails->description !!}@endif  
                    </div>
                    <!-- /.card-body -->
                    <div class="">
                       
                            <a class="btn btn-primary back_new" href="{{route('admin.'.\App::getLocale().'.cms-management.list')}}">Back</a>
                                
                            
                    </div>
                  </div>        
            </div>
            <div class="row">
              <div class="col-md-1">
              
                  
              </div>
            </div>
        </div>    
    </section>
</div>
@endsection