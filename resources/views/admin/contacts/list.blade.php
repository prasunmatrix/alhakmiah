@extends('admin.layouts.after-login-layout')

@section('unique-content')
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark">Contact Us Management</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Home</a></li>
                            <li class="breadcrumb-item active">Contact Us List</li>
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
                                    <h3 class="card-title">{{$panel_title}}
                                        <a href="{{route('admin.cms-management.cms.add')}}"
                                        class="btn btn-xs create_button" style="margin-left: 810px;"></a>
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
                                       
                                    <form method="GET">
                                        <div class="row">
                                            
                                            <div class="col-sm-9">
                                                <input type="search" name="q" class="form-control" id="" placeholder="Search by name en" value="{{ $_GET['q'] ?? '' }}">
                                            </div>
                                            
                                            <div class="col-sm-3">
                                                <button type="submit" class="btn btn-info btn-sm">Search</button>
                                                <a href="{{ route('admin.contacts.contacts.list') }}" class="btn btn-sm btn-danger">Reset</a>
                                               <!--  <a href="{{ route('admin.cms-management.cms-export') }}" class="btn btn-success btn-sm">Export</a> -->
                                            </div>
                                        
                                        </div>
                                    </form>
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <table id="moduleTable"
                                                class="table table-bordered table-hover dataTable dtr-inline"
                                                       role="grid" aria-describedby="example2_info">
                                                    <thead>
                                                    <tr role="row">
                                                       <th>Name</th>
                                                       <th>Email</th>
                                                       <th>Number</th>
                                                        <th>Project</th>
                                                        <th>Message</th>
                                                        <th>Site From</th>
                                                        <th> Requested On</th>
                                                        <th><em class="fa fa-cog"></em> Action</th>
                                                        <!-- <th><em class="fa fa-cog"></em> Action</th> -->
                                                        
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    @foreach($contactList as $data )
                                                        <tr role="row" class="odd">
                                                        
                                                        <td>{{$data->name}}</td>
                                                        <td>{{$data->email}}</td>
                                                        <td>{{$data->number}}</td>
                                                        <td>{{$data->project_name}}</td>
                                                        <td>{{$data->comment}}</td>
                                                        <td>{{$data->site_lang}}</td>
                                                        <td>{{ $data->created_at }}</td>
                                                   
                                                        
                                                        <td class=""> 
                                                                <div class="btn-group btn-group-sm">
                                                                    <a href="{{route('admin.contacts.delete',['encryptCode'=>encrypt($data->id, Config::get('Constant.ENC_KEY'))])}}" class="btn btn-danger delete-alert" id="button" data-toggle="tooltip" title="Delete"><i class="fas fa-trash" onClick="return confirm('Are you sure to delete?');"></i></a>                                 
                                                                </div>    
                                                             </td>
                                                        </tr>
                                                        @endforeach
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
                                            {{ $contactList->appends(\Request::except('page'))->render() }}
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
    </script>

    <script type="text/javascript">
        
         // $(document).on('click', '.delete-alert', function (e) {
         //                    e.preventDefault();
         //                    var redirectUrl = $(this).data('redirect-url');
         //                    // alert(redirectUrl)
         //                    swal({
         //                        title: "Are you sure?",
         //                        text: "Once deleted, you will not be able to recover this imaginary file!",
         //                        icon: "warning",
         //                        buttons: true,
         //                        dangerMode: true,
         //                        })
         //                    .then((willDelete) => {
         //                        if (willDelete) {
         //                            window.location.href = redirectUrl;
         //                        } 
         //                    });
         //                });

         //    $(document).on('click','.changeStatus',function(e){
         //        e.preventDefault();
         //        let redirectUrl= $(this).data('redirect-url');
         //        var btnId=$(this).attr('id');
         //            swal({
         //                title: "Are you sure?",
         //                text: "Do you want to change the status?",
         //                icon: "warning",
         //                buttons: true,
         //                dangerMode: true,
         //                })
         //            .then((trueResponse ) => {
         //                if (trueResponse) {
         //                    $.ajax({
         //                        url: redirectUrl,
         //                        cache: false,
         //                        success: function(response){
                                    
         //                            if(response.has_error == 0){
         //                                $(document).Toasts('create', {
         //                                class: 'bg-info', 
         //                                title: 'Success',
         //                                body: response.msg,
         //                                delay: 3000,
         //                                autohide:true
         //                            })
         //                                if($('#'+btnId).hasClass('btn-warning')){
         //                                    $('#'+btnId).removeClass('btn-warning');
         //                                    $('#'+btnId).addClass('btn-success');
         //                                    $('#'+btnId).html('Active');
         //                                } else {
         //                                    $('#'+btnId).removeClass('btn-success');
         //                                    $('#'+btnId).addClass('btn-warning');
         //                                    $('#'+btnId).html('Inactive');
         //                                }
         //                            } else {
         //                                alert('Something went wrong ');
         //                            }
         //                        }
         //                    });
         //                } 
         //            });
         //    });
    </script>
    @endpush
 