
  <!-- /.navbar -->
@extends('admin.layouts.after-login-layout')


@section('unique-content')


  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Dashboard</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item active">Dashboard</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
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
        <!-- Small boxes (Stat box) -->
        <div class="row">
          <div class="col-lg-4 col-6">
            <!-- small box -->
            <div class="small-box bg-info">
              <div class="inner">
                <h3>
                 {{$projects}}
                </h3>

                <p><strong>TOTAL PROJECTS</strong></p>
              </div>
              <div class="icon">
                <i class="ion ion-bag"></i>
              </div>
              <a href="{{route('admin.project.index')}}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-4 col-6">
            <!-- small box -->
            <div class="small-box bg-success">
              <div class="inner">
                <h3>
                  {{$cms}}
                </h3>

                <p><strong> TOTAL PAGES</strong> </p>
              </div>
              <div class="icon">
                <i class="ion ion-stats-bars"></i>
              </div>
              <a href="{{route('admin.cms-management.cms.list')}}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-4 col-6">
            <!-- small box -->
            <div class="small-box bg-warning">
              <div class="inner">
                <h3>
                  {{$service}}
                </h3>

                <p><strong>TOTAL SERVICES </strong></p>
              </div>
              <div class="icon">
                <i class="ion ion-person-add"></i>
              </div>
              <a href="{{route('admin.service.service.list')}}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
    
        </div>
        <!-- /.row -->
        <!-- Main row -->
        <div class="row">
          <div class="col-lg-12">
           <h3>Projects</h3>

          <table class="table">
          <thead class="thead-default ">
            <tr>
              <th>#</th>
              <th> Name</th>
              <th> City</th>
              <th>Banner</th>
              <th>Status</th>
            </tr>
          </thead>
          <tbody>
            @foreach($projectList as $key => $data)
            <tr>
              <th scope="row">{{$key+1}}</th>
              <td><a href="{{route('projectdetail.detail',$data->slug_name)}} " target="_blank">{{$data->name}}<br/> {{$data->name_ar}}</a> </td>
              <td>{{$data->getCity->name_en}} <br/> {{$data->getCity->name_ar}} </td>
              <td> @if (!empty($data->banner))
                    <img src="{{ asset('/admin/upload/project/banner/thumbnail') }}/{{ $data->banner }}" alt="" height="80px" width="80px">
                    @else
                    <img src="{{ asset('/admin/upload/common/no-image-found.jpg') }}" alt="" height="80px" width="80px">
                    @endif
              </td>
              @if($data->status =='1')
                       <td>Active</td>
                     @else
                       <td>Inactive</td>
                  @endif
            </tr>
           @endforeach 
          </tbody>
        </table>


            

        <h3>Service</h3>

        <table class="table">
          <thead class="thead-default ">
            <tr>
              <th>#</th>
              <th> Title</th>
              <th>Descrption</th>
              <th>Status</th>
            </tr>
          </thead>
          <tbody>
            @foreach($serviceList as $key => $data)
            <tr>
              <th scope="row">{{$key+1}}</th>
              <td>{{$data->title_en}} <br/> {{$data->title_ar}} </td>
              <td>
                {{((strlen($data->description_en) > 70) ? substr($data->description_en,0,70).'...' : $data->description_en)}} <br/> 

                {{((strlen($data->description_ar) > 70) ? substr($data->description_ar,0,70).'...' : $data->description_ar)}} 
              </td>
              @if($data->status =='A')
                       <td>Active</td>
                     @else
                       <td>Inactive</td>
                  @endif
            </tr>
           @endforeach 
          </tbody>
        </table>

         <h3>Pages</h3>

        <table class="table">
          <thead class="thead-default ">
            <tr>
              <th>#</th>
              <th>Title</th>
              <th>Descrption</th>
              <th>Status</th>
            </tr>
          </thead>
          <tbody>
            @foreach($cmsList as $key => $data)
            <tr>
              <th scope="row">{{$key+1}}</th>
              <td>{{$data->name_en}} <br/> {{$data->name_ar}} </td>
              <td>
              

                {{((strlen($data->description_en) > 70) ? substr(strip_tags($data->description_en),0,70).'...' : strip_tags($data->description_en))}}  <br/> 

                {{((strlen($data->description_ar) > 70) ? substr(strip_tags($data->description_ar),0,70).'...' : strip_tags($data->description_ar))}} 
              </td>

              @if($data->status =='A')
                       <td>Active</td>
                     @else
                       <td>Inactive</td>
                  @endif
            </tr>
           @endforeach 
          </tbody>
        </table>

        </div>
         
        </div>
        <!-- /.row (main row) -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
 <style type="text/css">
    .thead-default {
    background-color: black;
    color: white;
}
  </style>

@endsection
