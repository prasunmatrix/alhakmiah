@extends('admin.layouts.after-login-layout')

@section('unique-content')
@php
echo '<pre>';
echo $unitid;
echo '</pre>';
//die;
@endphp
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark">{{$panel_title}}</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Home</a></li>
                            <li class="breadcrumb-item"><a href="{{route('admin.project.index')}}">Project List</a></li>
                            <li class="breadcrumb-item active">Project Unit List</li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <!-- Small boxes (Stat box) -->
                <div class="row">
                    <div class="col-12">

                        <!-- /.card -->

                        <div class="card card-primary">
                                <div class="card-header">
                                    <h3 class="card-title">
                                        <a href="{{route('admin.unit.add',[$unitid])}}"
                                        class="btn btn-xs create_button" style="margin-left: 810px;">+ Unit
                                        Create</a>
                                    </h3>
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
                               
                               
                                    <div id="example2_wrapper" class="dataTables_wrapper dt-bootstrap4">
                                        <div class="row">
                                            <div class="col-sm-12 col-md-6"></div>
                                            <div class="col-sm-12 col-md-6"></div>
                                        </div>
                                       
                                   <!--  <form method="GET">
                                        <div class="row">
                                            
                                            <div class="col-sm-9">
                                                <input type="search" name="q" class="form-control" id="" placeholder="Search by name en" value="{{ $_GET['q'] ?? '' }}">
                                            </div>
                                            
                                            <div class="col-sm-3">
                                                <button type="submit" class="btn btn-info btn-sm">Search</button>
                                                <a href="{{ route('admin.cms-management.cms.list') }}" class="btn btn-sm btn-danger">Reset</a>
                                                <a href="{{ route('admin.cms-management.cms-export') }}" class="btn btn-success btn-sm">Export</a>
                                            </div>
                                        
                                        </div>
                                    </form> -->
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <table id="moduleTable"
                                                class="table table-bordered table-hover dataTable dtr-inline"
                                                       role="grid" aria-describedby="example2_info">
                                                    <thead>
                                                    <tr role="row">
                                                        <th>Name En</th>
                                                        <th>Name Ar</th>
                                                        <th> Created On</th>
                                                        <th><em class="fa fa-cog"></em> Action</th>
                                                        
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    @if (count($projectUnits) > 0)
                                                        @foreach($projectUnits as $projectUnit )
                                                            <tr role="row" class="odd">
                                                            
                                                            <td>{{$projectUnit->unit_name}}</td>
                                                            <td>{{$projectUnit->unit_name_ar}}</td>
                                                            
                                                            <td>{{ $projectUnit->created_at }}</td>
                                                       
                                                            <td class=""> 
                                                                <div class="btn-group btn-group-sm">
                                                                    
                                                                    <a href="{{route('admin.unit.edit',[$projectUnit->id])}}" class="btn btn-info" data-toggle="tooltip" title="Edit"><i class="fas fa-edit"></i></a>
                                                                    <a href="{{route('admin.unit.delete',[$projectUnit->id])}}" class="btn btn-danger" onClick="return confirm('Are you sure to delete?');" title="Delete"><i class="fas fa-trash"></i></a>

                                                                                                   
                                                                </div>    
                                                             </td>
                                                            </tr>
                                                            @endforeach
                                                        @else

                                                        <tr role="row" class="odd"><td colspan="4">Sorry no record available</td></tr>

                                                        @endif
                                                    </tbody>
                                                </table>
                                                
                                            </div>
                                        </div>
                                    </div>
                                    <!-- /.card-body -->
                                </div>
                                <div class="card-footer clearfix">
                                    <div class="paginationDiv ">
                                        <div class="float-right">
                                            {{ $projectUnits->appends(\Request::except('page'))->render() }}
                                        </div>
                                    </div>
                                </div>
                            
                            <!-- /.card-body -->
                        </div>
                        
                        <!-- /.card -->
                    </div>
                    <!-- /.col -->
                </div>
                <!-- /.row (main row) -->
            </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>

    
    <!-- /.content-wrapper -->
    <div>

        @endsection

        @push('custom-scripts')
        
        <script>
                   
            $('#date').daterangepicker({
                 autoUpdateInput: true,
                 locale: {
                     format: 'DD/MM/YYYY'
                 }})
         </script>

            
                <!-- Sweet alert -->
                <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
                <script src="{{asset('assets/plugins/toastr/toastr.min.js')}}"></script>
           <script>


        //minimum 8 digit,small+capital letter,number,special character
        $.validator.addMethod("valid_password", function(value, element) {
            if (/^(?=.*?[a-z])(?=.*?[A-Z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{8,}$/.test(value)) {
                return true;
            } else {
                return false;
            }
        });

       

    $(document).on('click','.changepasword',function(e){
            e.preventDefault();
           
            $("#password").val('');
            $("#confirm_password").val('');
            $('#memberEncString').val($(this).attr('data-encrypt'));
    })

   
              

                    $(document).on('click', '.delete-alert', function (e) {
                            e.preventDefault();
                            var redirectUrl = $(this).data('redirect-url');
                            // alert(redirectUrl)
                            swal({
                                title: "Are you sure?",
                                text: "Once deleted, you will not be able to recover this imaginary file!",
                                icon: "warning",
                                buttons: true,
                                dangerMode: true,
                                })
                            .then((willDelete) => {
                                if (willDelete) {
                                    window.location.href = redirectUrl;
                                } 
                            });
                        });

            $(document).on('click','.changeStatus',function(e){
                e.preventDefault();
                let redirectUrl= $(this).data('redirect-url');
                var btnId=$(this).attr('id');
                    swal({
                        title: "Are you sure?",
                        text: "Do you want to change the status?",
                        icon: "warning",
                        buttons: true,
                        dangerMode: true,
                        })
                    .then((trueResponse ) => {
                        if (trueResponse) {
                            $.ajax({
                                url: redirectUrl,
                                cache: false,
                                success: function(response){
                                    
                                    if(response.has_error == 0){
                                        $(document).Toasts('create', {
                                        class: 'bg-info', 
                                        title: 'Success',
                                        body: response.msg,
                                        delay: 3000,
                                        autohide:true
                                    })
                                        if($('#'+btnId).hasClass('btn-warning')){
                                            $('#'+btnId).removeClass('btn-warning');
                                            $('#'+btnId).addClass('btn-success');
                                            $('#'+btnId).html('Active');
                                        } else {
                                            $('#'+btnId).removeClass('btn-success');
                                            $('#'+btnId).addClass('btn-warning');
                                            $('#'+btnId).html('Inactive');
                                        }
                                    } else {
                                        alert('Something went wrong ');
                                    }
                                }
                            });
                        } 
                    });
            });

            $(document).on('click','.changeAvailable',function(e){
                e.preventDefault();
                let redirectUrl= $(this).data('redirect-url');
                var btnId1=$(this).attr('id');
                    swal({
                        title: "Are you sure?",
                        text: "Do you want to change the availability?",
                        icon: "warning",
                        buttons: true,
                        dangerMode: true,
                        })
                    .then((trueResponse ) => {
                        if (trueResponse) {
                            $.ajax({
                                url: redirectUrl,
                                cache: false,
                                success: function(response){
                                    
                                    if(response.has_error == 0){
                                        $(document).Toasts('create', {
                                        class: 'bg-info', 
                                        title: 'Success',
                                        body: response.msg,
                                        delay: 3000,
                                        autohide:true
                                    })
                                        if($('#'+btnId1).hasClass('btn-warning')){
                                            $('#'+btnId1).removeClass('btn-warning');
                                            $('#'+btnId1).addClass('btn-success');
                                            $('#'+btnId1).html('Yes');
                                        } else {
                                            $('#'+btnId1).removeClass('btn-success');
                                            $('#'+btnId1).addClass('btn-warning');
                                            $('#'+btnId1).html('No');
                                        }
                                    } else {
                                        alert('Something went wrong ');
                                    }
                                }
                            });
                        } 
                    });
            });
    </script>
    @endpush
 
