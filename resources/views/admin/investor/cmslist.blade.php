@extends('admin.layouts.after-login-layout')

@section('unique-content')
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
                            <li class="breadcrumb-item active">CMS Text CHANGE</li>
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
                                        <a href=""
                                        class="btn btn-xs create_button" style="margin-left: 810px;">CMS button changes</a>
                                    </h3>
                                </div>
                               
                            <!-- /.card-header -->
                            <div class="card-body">
                                    

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
                                       
                                 
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <table id="moduleTable"
                                                class="table table-bordered table-hover dataTable dtr-inline"
                                                       role="grid" aria-describedby="example2_info">
                                                    <thead>
                                                    <tr role="row">
                                                        <th>Annual En</th>
                                                        <th>Financial EN</th>
                                                        <th>Profit EN</th>
                                                        <th>Basel EN</th>
                                                        <th>Annual AR</th>
                                                        <th>Financial AR</th>
                                                        <th>Profit AR</th>
                                                        <th>Basel AR</th>
                                                        <th><em class="fa fa-cog"></em> Action</th>
                                                        
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    @if (count($cmstextchange) > 0)
                                                        @foreach($cmstextchange as $projectCmsTxten )
                                                            <tr role="row" class="odd">
                                                            
                                                            <td>{{$projectCmsTxten->annual_en}}</td>
                                                            <td>{{$projectCmsTxten->financial_en}}</td>
                                                            <td>{{$projectCmsTxten->profit_en}}</td>
                                                            <td>{{$projectCmsTxten->base_en}}</td>
 							    <td>{{$projectCmsTxten->annual_ar}}</td>
                                                            <td>{{$projectCmsTxten->financial_ar}}</td>
 							    <td>{{$projectCmsTxten->profit_ar}}</td>
                                                            <td>{{$projectCmsTxten->base_ar}}</td>
                                                            <td class=""> 
                                                                <div class="btn-group btn-group-sm">
                                                                    
                                                                    <a href="{{route('admin.investor-relations.buttonedit',['encryptCode'=>encrypt($projectCmsTxten->id, Config::get('Constant.ENC_KEY'))])}}" class="btn btn-info" data-toggle="tooltip" title="Edit"><i class="fas fa-edit"></i></a>                             
                                                                </div>    
                                                             </td>
                                                            </tr>
                                                            @endforeach
                                                        @else

                                                        <tr role="row" class="odd"><td colspan="6">Sorry no record available</td></tr>

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

       
 
