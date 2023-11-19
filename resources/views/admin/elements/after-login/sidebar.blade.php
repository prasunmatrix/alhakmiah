<!-- Main Sidebar Container -->
@php
    $admin = auth()->guard('admin')->user();
    $admin_image = $admin->profilePicLink
   
@endphp
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{route('admin.dashboard')}}" class="brand-link">
        <img src="{{asset('assets/dist/img/AdminLTELogo.png')}}" alt="User Logo"
             class="brand-image img-circle elevation-3"
             style="opacity: .8">
        <span class="brand-text font-weight-light">Admin Panel</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
               <a href="{{route('admin.profile')}}"> <img src="{{asset('assets/dist/img/user2-160x160.jpg')}}" class="img-circle elevation-2"
                     alt="User Image"></a>
            </div>
            <div class="info">
                <a href="#" class="d-block">{{ $admin->name }}</a>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
                     with font-awesome or any other icon font library -->
                <li class="nav-item has-treeview @if(Route::currentRouteName()=='admin.dashboard' 
                || Route::currentRouteName()=='admin.settings' 
                ){{'menu-open'}}@endif">
                    <a href="#"
                       class="nav-link @if(Route::currentRouteName()=='admin.dashboard' 
                       || Route::currentRouteName()=='admin.settings' 
                       ){{'active'}}@endif">
                        <i class="nav-icon fa fa-home"></i>
                        <p>
                            Home
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview @if(Route::currentRouteName()=='admin.dashboard' 
                    || Route::currentRouteName()=='admin.settings'){{'style="display: block;"'}}@endif">
                        <li class="nav-item">
                            <a href="{{ route('admin.dashboard') }}"
                               class="nav-link @if(Route::currentRouteName()=='admin.dashboard'){{'active'}}@endif">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Dashboard</p>
                            </a>
                        </li>
                        {{-- <li class="nav-item">
                            <a href="{{ route('admin.settings') }}"
                               class="nav-link @if(Route::currentRouteName()=='admin.settings'){{'active'}}@endif">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Configurations</p>
                            </a>
                        </li> --}}
                    </ul>
                </li>

                <!-- setting -->
                <li class="nav-item has-treeview @if(

                     Route::currentRouteName()=='admin.country.country.list' || 
                     Route::currentRouteName()=='admin.country.country.add' ||
                     Route::currentRouteName()=='admin.country.edit' ||
                     Route::currentRouteName()=='admin.city.city.list' ||
                     Route::currentRouteName()=='admin.state.state.list'||
                     Route::currentRouteName()=='admin.social.edit'||
                     Route::currentRouteName()=='admin.city.city.add'||
                     Route::currentRouteName()=='admin.city.edit' ||
                     Route::currentRouteName()=='admin.state.state.add' ||
                     Route::currentRouteName()=='admin.state.state.list'||
                     Route::currentRouteName()=='admin.state.edit' ||
                     Route::currentRouteName()=='admin.social.editpagetilte' ||
                     Route::currentRouteName()=='admin.social.editcontactseo'
                ){{'menu-open'}}@endif">
                    <a href="#"
                       class="nav-link @if(Route::currentRouteName()=='admin.country.country.list' || 
                                                                                    
                            Route::currentRouteName()=='admin.country.country.add' ||
                            Route::currentRouteName()=='admin.country.edit' ||
                            Route::currentRouteName()=='admin.city.city.add'||
                            Route::currentRouteName()=='admin.city.edit' ||
                            Route::currentRouteName()=='admin.city.city.list' ||
                            Route::currentRouteName()=='admin.state.state.add' ||
                            Route::currentRouteName()=='admin.state.state.list'||
                            Route::currentRouteName()=='admin.state.edit' ||
                            Route::currentRouteName()=='admin.social.edit' ||
                            Route::currentRouteName()=='admin.social.editpagetilte' ||
                            Route::currentRouteName()=='admin.social.editcontactseo'
                       ){{'active'}}@endif">
                         <i class="nav-icon fas fa-bars"></i>
                        <p>
                            Settings
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview @if(Route::currentRouteName()=='admin.country.country.list'||
                     
                        Route::currentRouteName()=='admin.country.country.add' ||
                        Route::currentRouteName()=='admin.country.edit' ||
                        Route::currentRouteName()=='admin.city.city.add'||
                        Route::currentRouteName()=='admin.city.edit' ||
                        Route::currentRouteName()=='admin.city.city.list' ||
                        Route::currentRouteName()=='admin.state.state.add' ||
                        Route::currentRouteName()=='admin.state.state.list'||
                        Route::currentRouteName()=='admin.state.edit' ||
                        Route::currentRouteName()=='admin.social.edit' ||
                        Route::currentRouteName()=='admin.social.editpagetilte' ||
                        Route::currentRouteName()=='admin.social.editcontactseo'
                    ){{'style="display: block;"'}}@endif">
                        <li class="nav-item">
                            <a href="{{ route('admin.country.country.list') }}"
                               class="nav-link @if(Route::currentRouteName()=='admin.country.country.list' ||
                                Route::currentRouteName()=='admin.country.country.add' ||
                                Route::currentRouteName()=='admin.country.edit' 
                               ){{'active'}}@endif">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Countries</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.state.state.list') }}"
                               class="nav-link @if(Route::currentRouteName()=='admin.state.state.list' ||
                               Route::currentRouteName()=='admin.state.state.add'||
                                Route::currentRouteName()=='admin.state.edit'
                               ){{'active'}}@endif">
                                <i class="far fa-circle nav-icon"></i>
                                <p>States</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.city.city.list') }}"
                               class="nav-link @if(Route::currentRouteName()=='admin.city.city.list' ||
                                                    Route::currentRouteName()=='admin.city.city.add'||
                                                    Route::currentRouteName()=='admin.city.edit'
                               ){{'active'}}@endif">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Cities</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="{{ route('admin.social.edit') }}"
                               class="nav-link @if(Route::currentRouteName()=='admin.social.edit'){{'active'}}@endif">
                                <i class="far fa-circle nav-icon"></i>
                                <p>General Setting</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="{{ route('admin.social.editpagetilte') }}"
                               class="nav-link @if(Route::currentRouteName()=='admin.social.editpagetilte'){{'active'}}@endif">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Page Banner Title Setting</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="{{ route('admin.social.editcontactseo') }}"
                               class="nav-link @if(Route::currentRouteName()=='admin.social.editcontactseo'){{'active'}}@endif">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Contact Page Seo Setting</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.social.editjoinseo') }}"
                               class="nav-link @if(Route::currentRouteName()=='admin.social.editjoinseo'){{'active'}}@endif">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Join Page Seo Setting</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.social.editmediacenterseo') }}"
                               class="nav-link @if(Route::currentRouteName()=='admin.social.editmediacenterseo'){{'active'}}@endif">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Media Center Page Seo Setting</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.social.editserviceseo') }}"
                               class="nav-link @if(Route::currentRouteName()=='admin.social.editserviceseo'){{'active'}}@endif">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Service Page Seo Setting</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.social.editcommunitiesseo') }}"
                               class="nav-link @if(Route::currentRouteName()=='admin.social.editcommunitiesseo'){{'active'}}@endif">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Communities Main Page Seo Setting</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.social.editourachievementsseo') }}"
                               class="nav-link @if(Route::currentRouteName()=='admin.social.editourachievementsseo'){{'active'}}@endif">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Our Achievement Page Seo Setting</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.social.editsearchseo') }}"
                               class="nav-link @if(Route::currentRouteName()=='admin.social.editsearchseo'){{'active'}}@endif">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Search Page Seo Setting</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.social.editblogseo') }}"
                               class="nav-link @if(Route::currentRouteName()=='admin.social.editblogseo'){{'active'}}@endif">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Blog Page Setting</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <!-- role & permission -->

               <!--  <li class="nav-item has-treeview @if(Route::currentRouteName()=='admin.roles' 
                || Route::currentRouteName()=='admin.roles.create' 
                ){{'menu-open'}}@endif">
                    <a href="#"
                       class="nav-link @if(Route::currentRouteName()=='admin.roles' 
                       || Route::currentRouteName()=='admin.roles.create' 
                       ){{'active'}}@endif">
                       
                        <i class="nav-icon far fa-share-square"></i>

                        <p>
                            Role & Permissions
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview menu-open">
                        @if(auth()->guard('admin')->user()->hasAllPermission(['role-list']))
                        <li class="nav-item">
                            <a href="{{ route('admin.roles') }}"
                               class="nav-link active">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Roles</p>
                            </a>
                        </li>
                        @endif
                        {{-- <li class="nav-item">
                            <a href="{{ route('admin.settings') }}"
                               class="nav-link ">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Permissions</p>
                            </a>
                        </li> --}}
                    </ul>
                </li> -->
                <li class="nav-item has-treeview @if(
                            Route::currentRouteName()=='admin.user-management.user.list'||
                            Route::currentRouteName()=='admin.user-management.user.add'||
                            Route::currentRouteName()=='admin.user-management.user-edit'|| 
                           
                            Route::currentRouteName()=='admin.user-management.edit' 
                            
                           ){{'menu-open'}}@endif">
                    <a href="#"
                    class="nav-link @if( 
                                        Route::currentRouteName()=='admin.user-management.user.list'||
                                        Route::currentRouteName()=='admin.user-management.user.add' ||
                                        Route::currentRouteName()=='admin.user-management.user-edit' ||
                                        Route::currentRouteName()=='admin.user-management.edit' ||
                                      
                                        Route::currentRouteName()=='admin.user-management.site.user.list'){{'active'}}@endif">
                        <i class="nav-icon fa fa-users"></i>
                        <p>
                            User Management
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview @if(
                                    Route::currentRouteName()=='admin.user-management.user.list' ||
                                    Route::currentRouteName()=='admin.user-management.user.add' || 
                                    Route::currentRouteName()=='admin.user-management.user-edit' || 
                                    
                                    Route::currentRouteName()=='admin.user-management.edit' ||
                                   
                                    Route::currentRouteName()=='admin.user-management.site.user.list'){{'style="display: block;"'}}@endif">
                        

                        
             
                        <li class="nav-item">
                            <a href="{{route('admin.user-management.user.list' )}}"
                             class="nav-link @if(Route::currentRouteName()=='admin.user-management.user.list' 
                                        ||(Route::currentRouteName()=='admin.user-management.user-edit' && isset($details->usertype) && $details->usertype != 'FU')
                                      ){{'active'}}@endif">
                                <i class="far fa-circle nav-icon"></i>
                                <p> User List</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="{{route('admin.user-management.user.add')}}"
                             class="nav-link @if( \Route::currentRouteName()=='admin.user-management.user.add'){{'active'}}@endif">
                                <i class="far fa-circle nav-icon"></i>
                                <p> User Create</p>
                            </a>
                        </li>
                        
                        {{-- <li class="nav-item">
                            <a href="{{route('admin.user-management.site.user.list' )}}"
                             class="nav-link @if(Route::currentRouteName()=='admin.user-management.site.user.list' 
                                        || (Route::currentRouteName()=='admin.user-management.user-edit' && isset($details->usertype) && $details->usertype == 'FU')
                                        ){{'active'}}@endif">
                                <i class="far fa-circle nav-icon"></i>
                                <p> App User List</p>
                            </a>
                        </li> --}}
                    </ul>
                </li>

                

        <!-- banner -->

         <li class="nav-item has-treeview @if( 
                    Route::currentRouteName()=='admin.banner.list'||
                    Route::currentRouteName()=='admin.banner.add'||
                    Route::currentRouteName()=='admin.banner.edit' 
                
                
                    ){{'menu-open'}}@endif">
            <a href="#"
            class="nav-link @if( 
                                Route::currentRouteName()=='admin.banner.list'||
                                Route::currentRouteName()=='admin.banner.add' ||
                                Route::currentRouteName()=='admin.banner.edit' 
                                ){{'active'}}@endif">

                <i class="nav-icon fas fa-file-alt fa-lg"> </i>
                <p>
                Home Banner Management
                    <i class="right fas fa-angle-left"></i>
                </p>
            </a>
            <ul class="nav nav-treeview @if(Route::currentRouteName()=='admin.banner.list' ||
                                            Route::currentRouteName()=='admin.banner.add' ||
                                            Route::currentRouteName()=='admin.banner.edit'
                                            
                        ){{'style="display: block;"'}}@endif">
                
                
                <li class="nav-item">
                    <a href="{{route('admin.banner.list' )}}"
                    class="nav-link @if(Route::currentRouteName()=='admin.banner.list' ||
                                       
                                        Route::currentRouteName()=='admin.banner.edit'
                                
                                ){{'active'}}@endif">
                        <i class="far fa-circle nav-icon"></i>
                        <p> Banner List</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{route('admin.banner.add' )}}"
                    class="nav-link @if(
                                        Route::currentRouteName()=='admin.banner.add' 
                                
                                ){{'active'}}@endif">
                        <i class="far fa-circle nav-icon"></i>
                        <p> Banner Add</p>
                    </a>
                </li>
            
            </ul>
        </li>

         <!-- home page  setting-->
            <li class="nav-item has-treeview @if( 
                    Route::currentRouteName()=='admin.home-page-setting.homepage.list'||
                    Route::currentRouteName()=='admin.home-page-setting.edit'||
                    Route::currentRouteName()=='admin.service.home.list'||
                    Route::currentRouteName()=='admin.home-page-gallery.edit'||
                    Route::currentRouteName()=='admin.home-page-setting.edithomeheading'

                
                
                    ){{'menu-open'}}@endif">
            <a href="#"
            class="nav-link @if( 
                                Route::currentRouteName()=='admin.home-page-setting.homepage.list'||
                         
                                Route::currentRouteName()=='admin.home-page-setting.edit'||
                                Route::currentRouteName()=='admin.home-page-setting.edithomeheading' 
                                ){{'active'}}@endif">


      
                <i class="nav-icon fa fa-h-square" aria-hidden="true"></i>
                <p>
                Home Page  Setting
                    <i class="right fas fa-angle-left"></i>
                </p>
            </a>
            <ul class="nav nav-treeview @if(Route::currentRouteName()=='admin.home-page-setting.homepage.list' ||
                                            
                                            Route::currentRouteName()=='admin.home-page-setting.edit'||
                                            Route::currentRouteName()=='admin.home-page-setting.edithomeheading'
                                            
                        ){{'style="display: block;"'}}@endif">
                
                
                <li class="nav-item">
                    <a href="{{route('admin.home-page-setting.edit' )}}"
                    class="nav-link @if(Route::currentRouteName()=='admin.home-page-setting.edit' 
                                
                                ){{'active'}}@endif">
                        <i class="far fa-circle nav-icon"></i>
                        <p> Home Page First Block  </p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{route('admin.home-page-gallery.edit' )}}"
                    class="nav-link @if(Route::currentRouteName()=='admin.home-page-gallery.edit' 
                                
                                ){{'active'}}@endif">
                        <i class="far fa-circle nav-icon"></i>
                        <p> Home Page Gallery Block</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{route('admin.service.home.list' )}}"
                    class="nav-link @if(Route::currentRouteName()=='admin.service.home.list' 
                                
                                ){{'active'}}@endif">
                        <i class="far fa-circle nav-icon"></i>
                        <p> Home Active Service Block</p>
                    </a>
                </li>   
                
                <li class="nav-item">
                    <a href="{{route('admin.home-page-setting.edithomeheading' )}}"
                    class="nav-link @if(Route::currentRouteName()=='admin.home-page-setting.edithomeheading' 
                                
                                ){{'active'}}@endif">
                        <i class="far fa-circle nav-icon"></i>
                        <p> Home Page Heading Settings</p>
                    </a>
                </li> 
                
            </ul>
        </li>

      

        <!-- project service management-->
         <li class="nav-item has-treeview @if( 
                            Route::currentRouteName()=='admin.projectservices.index'||
                            Route::currentRouteName()=='admin.projectservices.add'||
                            Route::currentRouteName()=='admin.projectservices.edit'|| 


                            Route::currentRouteName()=='admin.projectnear.index'||
                            Route::currentRouteName()=='admin.projectnear.add'||
                            Route::currentRouteName()=='admin.projectnear.edit'||

                            Route::currentRouteName()=='admin.status.index'||
                            Route::currentRouteName()=='admin.status.add'||
                            Route::currentRouteName()=='admin.status.edit'||

                            Route::currentRouteName()=='admin.type.index'||
                            Route::currentRouteName()=='admin.type.add'||
                            Route::currentRouteName()=='admin.type.edit'
                        
                        
                            ){{'menu-open'}}@endif">
                    <a href="#"
                    class="nav-link @if( 
                                        Route::currentRouteName()=='admin.projectservices.index'||
                                        Route::currentRouteName()=='admin.projectservices.add' ||
                                        Route::currentRouteName()=='admin.projectservices.edit' 
                                        ){{'active'}}@endif">
                        <i class="nav-icon fas fa-file-alt fa-lg"> </i>
                        <p>
                        Project Setting
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview @if(Route::currentRouteName()=='admin.projectservices.index' ||
                                                    Route::currentRouteName()=='admin.projectservices.add' ||
                                                    Route::currentRouteName()=='admin.projectservices.edit'
                                                    
                                ){{'style="display: block;"'}}@endif">
                        
                        
                        <li class="nav-item">
                            <a href="{{route('admin.projectservices.index' )}}"
                            class="nav-link @if(Route::currentRouteName()=='admin.projectservices.index' ||
                                               
                                                Route::currentRouteName()=='admin.projectservices.edit'
                                        
                                        ){{'active'}}@endif">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Project Service List</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="{{route('admin.projectnear.index' )}}"
                            class="nav-link @if(Route::currentRouteName()=='admin.projectnear.index' ||
                                               
                                                Route::currentRouteName()=='admin.projectnear.edit'
                                        
                                        ){{'active'}}@endif">
                                <i class="far fa-circle nav-icon"></i>
                                <p> Place Near Place List</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="{{route('admin.status.index' )}}"
                            class="nav-link @if(Route::currentRouteName()=='admin.status.index' ||
                                               
                                                Route::currentRouteName()=='admin.status.edit'
                                        
                                        ){{'active'}}@endif">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Project Status List</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="{{route('admin.type.index' )}}"
                            class="nav-link @if(Route::currentRouteName()=='admin.type.index' ||
                                               
                                                Route::currentRouteName()=='admin.type.edit'
                                        
                                        ){{'active'}}@endif">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Project Type List</p>
                            </a>
                        </li>
                          
                    </ul>
                </li>

        <!-- project management-->
        <li class="nav-item has-treeview @if( 
                    Route::currentRouteName()=='admin.project.index'||
                    Route::currentRouteName()=='admin.project.add'||
                    Route::currentRouteName()=='admin.project.edit'||
                    Route::currentRouteName()=='admin.unit.index'||
                    Route::currentRouteName()=='admin.unit.add'||
                    Route::currentRouteName()=='admin.unit.edit'
                
                    ){{'menu-open'}}@endif">
            <a href="#"
            class="nav-link @if( 
                                Route::currentRouteName()=='admin.project.index'||
                                Route::currentRouteName()=='admin.project.add' ||
                                Route::currentRouteName()=='admin.project.edit'||
                                Route::currentRouteName()=='admin.unit.index'||
                                Route::currentRouteName()=='admin.unit.add'||
                                Route::currentRouteName()=='admin.unit.edit' 
                                ){{'active'}}@endif">
                <i class="nav-icon fas fa-file-alt fa-lg"> </i>
                <p>
                Project Management
                    <i class="right fas fa-angle-left"></i>
                </p>
            </a>
            <ul class="nav nav-treeview @if(Route::currentRouteName()=='admin.project.index' ||
                                            Route::currentRouteName()=='admin.project.add' ||
                                            Route::currentRouteName()=='admin.project.edit'||
                                            Route::currentRouteName()=='admin.unit.index'||
                                            Route::currentRouteName()=='admin.unit.add'||
                                            Route::currentRouteName()=='admin.unit.edit'
                                            
                        ){{'style="display: block;"'}}@endif">
                
                
                <li class="nav-item">
                    <a href="{{route('admin.project.index' )}}"
                    class="nav-link @if(Route::currentRouteName()=='admin.project.index' ||
                                       
                                        Route::currentRouteName()=='admin.project.edit'
                                
                                ){{'active'}}@endif">
                        <i class="far fa-circle nav-icon"></i>
                        <p> Project List</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{route('admin.project.add' )}}"
                    class="nav-link @if(
                                        Route::currentRouteName()=='admin.project.add' 
                                
                                ){{'active'}}@endif">
                        <i class="far fa-circle nav-icon"></i>
                        <p> Project Add</p>
                    </a>
                </li>
                
                </ul>
        </li>

         <!-- cms -->

         <li class="nav-item has-treeview @if( 
                    Route::currentRouteName()=='admin.cms-management.cms.list'||
                    Route::currentRouteName()=='admin.cms-management.cms.add'||
                    Route::currentRouteName()=='admin.cms-management.edit' 
                
                
                    ){{'menu-open'}}@endif">
            <a href="#"
            class="nav-link @if( 
                                Route::currentRouteName()=='admin.cms-management.cms.list'||
                                Route::currentRouteName()=='admin.cms-management.cms.add' ||
                                Route::currentRouteName()=='admin.cms-management.edit' 
                                ){{'active'}}@endif">

                <i class="nav-icon fas fa-file-alt fa-lg"> </i>
                <p>
                Cms Management
                    <i class="right fas fa-angle-left"></i>
                </p>
            </a>
            <ul class="nav nav-treeview @if(Route::currentRouteName()=='admin.cms-management.cms.list' ||
                                            Route::currentRouteName()=='admin.cms-management.cms.add' ||
                                            Route::currentRouteName()=='admin.cms-management.edit'
                                            
                        ){{'style="display: block;"'}}@endif">
                
                
                <li class="nav-item">
                    <a href="{{route('admin.cms-management.cms.list' )}}"
                    class="nav-link @if(Route::currentRouteName()=='admin.cms-management.cms.list' ||
                                       
                                        Route::currentRouteName()=='admin.cms-management.edit'
                                
                                ){{'active'}}@endif">
                        <i class="far fa-circle nav-icon"></i>
                        <p> Cms List</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{route('admin.cms-management.cms.add' )}}"
                    class="nav-link @if(
                                        Route::currentRouteName()=='admin.cms-management.cms.add' 
                                
                                ){{'active'}}@endif">
                        <i class="far fa-circle nav-icon"></i>
                        <p> Cms Add</p>
                    </a>
                </li>  
            </ul>
        </li>

        <!-- service-->

          <li class="nav-item has-treeview @if( 
                    Route::currentRouteName()=='admin.service.service.list'||
                    Route::currentRouteName()=='admin.service.service.add'||
                    Route::currentRouteName()=='admin.service.edit' 
                
                
                    ){{'menu-open'}}@endif">
            <a href="#"
            class="nav-link @if( 
                    Route::currentRouteName()=='admin.service.service.list'||
                    Route::currentRouteName()=='admin.service.service.add'||
                    Route::currentRouteName()=='admin.service.edit' 
                                ){{'active'}}@endif">
             
                <i class="nav-icon fab fa-usps"></i>
                <p>
                 Services Management
                    <i class="right fas fa-angle-left"></i>
                </p>
            </a>
            <ul class="nav nav-treeview @if(
                    Route::currentRouteName()=='admin.service.service.list'||
                    Route::currentRouteName()=='admin.service.service.add'||
                    Route::currentRouteName()=='admin.service.edit' 
                                            
                        ){{'style="display: block;"'}}@endif">
                 <li class="nav-item">
                    <a href="{{route('admin.service.service.list' )}}"
                    class="nav-link @if(Route::currentRouteName()=='admin.service.service.list'||
                                       
                                        Route::currentRouteName()=='admin.service.edit' 
                                
                                ){{'active'}}@endif">
                        <i class="far fa-circle nav-icon"></i>
                        <p> Service List</p>
                    </a>
                </li>
                
                
                
                <li class="nav-item">
                    <a href="{{route('admin.service.service.add' )}}"
                    class="nav-link @if(
                                        Route::currentRouteName()=='admin.service.service.add'
                                
                                ){{'active'}}@endif">
                        <i class="far fa-circle nav-icon"></i>
                        <p> Service Add</p>
                    </a>
                </li>
   
            </ul>
        </li>

       <!-- Blog Start -->
        <li class="nav-item has-treeview @if( 
            Route::currentRouteName()=='admin.blog.blog.list'||
            Route::currentRouteName()=='admin.blog.blog.add'||
            Route::currentRouteName()=='admin.blog.blog.edit'                                     
          ){{'menu-open'}}@endif">
            <a href="#"
              class="nav-link @if( 
                Route::currentRouteName()=='admin.blog.blog.list'||
                Route::currentRouteName()=='admin.blog.blog.add'||
                Route::currentRouteName()=='admin.blog.blog.edit'                     
                ){{'active'}}@endif">
                <i class="nav-icon fas fa-blog" aria-hidden="true"></i>
                <p>Blog<i class="right fas fa-angle-left"></i></p>
            </a>                
            <ul class="nav nav-treeview @if(
                    Route::currentRouteName()=='admin.blog.blog.list'||
                    Route::currentRouteName()=='admin.blog.blog.add'||
                    Route::currentRouteName()=='admin.blog.blog.edit'                                               
                  ){{'style="display: block;"'}}@endif">
                <li class="nav-item">
                    <a href="{{route('admin.blog.blog.list' )}}"
                    class="nav-link @if(Route::currentRouteName()=='admin.blog.blog.list'||
                                       
                                        Route::currentRouteName()=='admin.blog.blog.edit' ||
                                        Route::currentRouteName()=='admin.blog.blog.add'
                                
                                ){{'active'}}@endif">
                        <i class="far fa-circle nav-icon"></i>
                        <p> Blog</p>
                    </a>
                </li>
            </ul>
        </li>
        <!-- Blog End -->                          
        <!-- news-->

          <li class="nav-item has-treeview @if( 
                    Route::currentRouteName()=='admin.news.news.list'||
                    Route::currentRouteName()=='admin.news.news.add'||
                    Route::currentRouteName()=='admin.news.news.edit' ||
                    Route::currentRouteName()=='admin.tv-channels.list'||
                    Route::currentRouteName()=='admin.tv-channels.add'||
                    Route::currentRouteName()=='admin.tv-channels.edit' ||
                    Route::currentRouteName()=='admin.press-kits.list'||
                    Route::currentRouteName()=='admin.press-kits.add'||
                    Route::currentRouteName()=='admin.press-kits.edit'||
                    Route::currentRouteName()=='admin.brand-guideline.list'||
                    Route::currentRouteName()=='admin.brand-guideline.add'||
                    Route::currentRouteName()=='admin.brand-guideline.edit'||
                    Route::currentRouteName()=='admin.mediatab.editmediatab'
                
                
                    ){{'menu-open'}}@endif">
            <a href="#"
            class="nav-link @if( 
                    Route::currentRouteName()=='admin.news.news.list'||
                    Route::currentRouteName()=='admin.news.news.add'||
                    Route::currentRouteName()=='admin.news.news.edit' ||
                    Route::currentRouteName()=='admin.tv-channels.list'||
                    Route::currentRouteName()=='admin.tv-channels.add'||
                    Route::currentRouteName()=='admin.tv-channels.edit' ||
                    Route::currentRouteName()=='admin.press-kits.list'||
                    Route::currentRouteName()=='admin.press-kits.add'||
                    Route::currentRouteName()=='admin.press-kits.edit' ||
                    Route::currentRouteName()=='admin.brand-guideline.list'||
                    Route::currentRouteName()=='admin.brand-guideline.add'||
                    Route::currentRouteName()=='admin.brand-guideline.edit'||
                    Route::currentRouteName()=='admin.mediatab.editmediatab'
                                ){{'active'}}@endif">
     
      
                <i class="nav-icon  fa fa-envelope-open" aria-hidden="true"></i>
                <p>
                Media Center
                    <i class="right fas fa-angle-left"></i>

                </p>
            </a>
            <ul class="nav nav-treeview @if(
                    Route::currentRouteName()=='admin.news.news.list'||
                    Route::currentRouteName()=='admin.news.news.add'||
                    Route::currentRouteName()=='admin.news.news.edit' ||
                    Route::currentRouteName()=='admin.tv-channels.list'||
                    Route::currentRouteName()=='admin.tv-channels.add'||
                    Route::currentRouteName()=='admin.tv-channels.edit' ||
                    Route::currentRouteName()=='admin.press-kits.list'||
                    Route::currentRouteName()=='admin.press-kits.add'||
                    Route::currentRouteName()=='admin.press-kits.edit'||
                    Route::currentRouteName()=='admin.brand-guideline.list'||
                    Route::currentRouteName()=='admin.brand-guideline.add'||
                    Route::currentRouteName()=='admin.brand-guideline.edit'||
                    Route::currentRouteName()=='admin.mediatab.editmediatab' 
                                            
                        ){{'style="display: block;"'}}@endif">
                
                
                <li class="nav-item">
                    <a href="{{route('admin.news.news.list' )}}"
                    class="nav-link @if(Route::currentRouteName()=='admin.news.news.list'||
                                       
                                        Route::currentRouteName()=='admin.news.news.edit' ||
                                        Route::currentRouteName()=='admin.news.news.add'
                                
                                ){{'active'}}@endif">
                        <i class="far fa-circle nav-icon"></i>
                        <p> News</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{route('admin.tv-channels.list' )}}"
                    class="nav-link @if(
                                        Route::currentRouteName()=='admin.tv-channels.list' ||
                                        Route::currentRouteName()=='admin.tv-channels.add'||
                                        Route::currentRouteName()=='admin.tv-channels.edit'
                                
                                ){{'active'}}@endif">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Tv Interviews</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{route('admin.press-kits.list' )}}"
                    class="nav-link @if(
                                        Route::currentRouteName()=='admin.press-kits.list'||
                                        Route::currentRouteName()=='admin.press-kits.add'||
                                        Route::currentRouteName()=='admin.press-kits.edit'
                                ){{'active'}}@endif">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Press Kit</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{route('admin.brand-guideline.list' )}}"
                    class="nav-link @if(
                                        Route::currentRouteName()=='admin.brand-guideline.list'||
                                        Route::currentRouteName()=='admin.brand-guideline.add'||
                                        Route::currentRouteName()=='admin.brand-guideline.edit'
                                
                                ){{'active'}}@endif">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Brand Guidelines</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('admin.mediatab.editmediatab') }}"
                        class="nav-link @if(Route::currentRouteName()=='admin.mediatab.editmediatab'){{'active'}}@endif">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Media Tab Setting</p>
                    </a>
                </li>
   
            </ul>
        </li>
        <!-- investor-->
        <li class="nav-item has-treeview @if( 
                    Route::currentRouteName()=='admin.investor-relations.list'||
                    Route::currentRouteName()=='admin.investor-relations.add'||
                    Route::currentRouteName()=='admin.investor-relations.investor-achievement-edit' ||
                    Route::currentRouteName()=='admin.investor-relations.edit'
                
                
                    ){{'menu-open'}}@endif">
            <a href="#"
            class="nav-link @if( 
                                Route::currentRouteName()=='admin.investor-relations.list'||
                                Route::currentRouteName()=='admin.investor-relations.add' ||
                                Route::currentRouteName()=='admin.investor-relations.investor-achievement-edit'||
                                Route::currentRouteName()=='admin.investor-relations.edit' 
                                ){{'active'}}@endif">
              
                <i class="nav-icon fa fa-fax" aria-hidden="true"></i>
                <p>
                Investors Relations
                    <i class="right fas fa-angle-left"></i>
                </p>
            </a>
            <ul class="nav nav-treeview @if(Route::currentRouteName()=='admin.investor-relations.list' ||
                                            Route::currentRouteName()=='admin.investor-relations.add' ||
                                            Route::currentRouteName()=='admin.investor-relations.investor-achievement-edit'||
                                            Route::currentRouteName()=='admin.investor-relations.edit'
                                            
                        ){{'style="display: block;"'}}@endif">
                
                
                <li class="nav-item">
                    <a href="{{route('admin.investor-relations.edit' )}}"
                    class="nav-link @if(Route::currentRouteName()=='admin.investor-relations.edit' 
                                
                                ){{'active'}}@endif">
                        <i class="far fa-circle nav-icon"></i>
                        <p> Investor Cms</p>
                    </a>
                </li>
<! ---  Button text changes --> 
		<li class="nav-item">
                    <a href="{{route('admin.investor-relations.admincmschng')}}"
                    class="nav-link @if(Route::currentRouteName()=='admin.investor-relations.admincmschng' 
                                
                                ){{'active'}}@endif">
                        <i class="far fa-circle nav-icon"></i>
                        <p> CMS text change</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{route('admin.investor-relations.add' )}}"
                    class="nav-link @if(
                                        Route::currentRouteName()=='admin.investor-relations.add'
                                
                                ){{'active'}}@endif">
                        <i class="far fa-circle nav-icon"></i>
                        <p> Investor Add</p>
                    </a>
                </li> 
                <li class="nav-item">
                    <a href="{{route('admin.investor-relations.list' )}}"
                    class="nav-link @if(
                                        Route::currentRouteName()=='admin.investor-relations.list'  ||
                                        Route::currentRouteName()=='admin.investor-relations.investor-achievement-edit'
                                
                                ){{'active'}}@endif">
                        <i class="far fa-circle nav-icon"></i>
                        <p> Investor List</p>
                    </a>
                </li> 
            
                
            </ul>
        </li>
        
        <!-- Position Category-->                
        <li class="nav-item has-treeview @if( 
                    Route::currentRouteName()=='admin.category.list'||
                    Route::currentRouteName()=='admin.category.add'||
                    Route::currentRouteName()=='admin.category.edit'||

                    Route::currentRouteName()=='admin.subcategory.list'||
                    Route::currentRouteName()=='admin.subcategory.add'||
                    Route::currentRouteName()=='admin.subcategory.edit'
                
                    ){{'menu-open'}}@endif">
            <a href="#"
            class="nav-link @if( 
                                Route::currentRouteName()=='admin.category.list'||
                                Route::currentRouteName()=='admin.category.add'||
                                Route::currentRouteName()=='admin.category.edit'||

                                Route::currentRouteName()=='admin.subcategory.list'||
                                Route::currentRouteName()=='admin.subcategory.add'||
                                Route::currentRouteName()=='admin.subcategory.edit'

                                ){{'active'}}@endif">
              
                <i class="nav-icon fa fa-university" aria-hidden="true"></i>
                <p>
                Category Management
                    <i class="right fas fa-angle-left"></i>
                </p>
            </a>
            <ul class="nav nav-treeview @if(Route::currentRouteName()=='admin.category.list'||
                                            Route::currentRouteName()=='admin.category.add'||
                                            Route::currentRouteName()=='admin.category.edit'||
                                            
                                            Route::currentRouteName()=='admin.subcategory.list'||
                                            Route::currentRouteName()=='admin.subcategory.add'||
                                            Route::currentRouteName()=='admin.subcategory.edit'
                                            
                        ){{'style="display: block;"'}}@endif">
                
                
                <li class="nav-item">
                    <a href="{{route('admin.category.list' )}}"
                    class="nav-link @if(Route::currentRouteName()=='admin.category.list'||
                                        Route::currentRouteName()=='admin.category.edit' 
                                
                                ){{'active'}}@endif">
                        <i class="far fa-circle nav-icon"></i>
                        <p>  Category List</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{route('admin.category.add' )}}"
                    class="nav-link @if(Route::currentRouteName()=='admin.category.add'
                                
                                ){{'active'}}@endif">
                        <i class="far fa-circle nav-icon"></i>
                        <p> Category Add</p>
                    </a>
                </li>

                {{--<li class="nav-item">
                    <a href="{{route('admin.subcategory.list' )}}"
                    class="nav-link @if(Route::currentRouteName()=='admin.subcategory.list'||
                                        Route::currentRouteName()=='admin.subcategory.edit' 
                                
                                ){{'active'}}@endif">
                        <i class="far fa-circle nav-icon"></i>
                        <p>  Sub Category List</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{route('admin.subcategory.add' )}}"
                    class="nav-link @if(Route::currentRouteName()=='admin.subcategory.add'
                                
                                ){{'active'}}@endif">
                        <i class="far fa-circle nav-icon"></i>
                        <p> Sub Category Add</p>
                    </a>
                </li>--}}
                
            </ul>
        </li>
        <!-- Position category--> 

        

        <!-- Position Management-->                
        <li class="nav-item has-treeview @if( 
                    Route::currentRouteName()=='admin.position.list'||
                    Route::currentRouteName()=='admin.position.add'||
                    Route::currentRouteName()=='admin.position.edit'||
                    Route::currentRouteName()=='admin.position.editceopdf'
                
                
                    ){{'menu-open'}}@endif">
            <a href="#"
            class="nav-link @if( 
                                Route::currentRouteName()=='admin.position.list'||
                                Route::currentRouteName()=='admin.position.add'||
                                Route::currentRouteName()=='admin.position.edit'||
                                Route::currentRouteName()=='admin.position.editceopdf'
                                ){{'active'}}@endif">
              
                <i class="nav-icon fa fa-list" aria-hidden="true"></i>
                <p>
                CEO Tab Management
                    <i class="right fas fa-angle-left"></i>
                </p>
            </a>
            <ul class="nav nav-treeview @if(Route::currentRouteName()=='admin.position.list'||
                                            Route::currentRouteName()=='admin.position.add'||
                                            Route::currentRouteName()=='admin.position.edit'||
                                            Route::currentRouteName()=='admin.position.editceopdf' 
                                            
                        ){{'style="display: block;"'}}@endif">
                
                
                <li class="nav-item">
                    <a href="{{route('admin.position.list' )}}"
                    class="nav-link @if(Route::currentRouteName()=='admin.position.list'||
                                        Route::currentRouteName()=='admin.position.edit' 
                                
                                ){{'active'}}@endif">
                        <i class="far fa-circle nav-icon"></i>
                        <p>  Position List</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{route('admin.position.add' )}}"
                    class="nav-link @if(Route::currentRouteName()=='admin.position.add'
                                
                                ){{'active'}}@endif">
                        <i class="far fa-circle nav-icon"></i>
                        <p> Position Add</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{route('admin.position.editceopdf' )}}"
                    class="nav-link @if(Route::currentRouteName()=='admin.position.editceopdf'
                                
                                ){{'active'}}@endif">
                        <i class="far fa-circle nav-icon"></i>
                        <p> CEO Brochure</p>
                    </a>
                </li>
                
            </ul>
        </li>
        <!-- Position Management-->

        <!-- Our Brand Management-->                
        <li class="nav-item has-treeview @if( 
                    Route::currentRouteName()=='admin.ourbrand.list'||
                    Route::currentRouteName()=='admin.ourbrand.add'||
                    Route::currentRouteName()=='admin.ourbrand.edit'
                
                
                    ){{'menu-open'}}@endif">
            <a href="#"
            class="nav-link @if( 
                                Route::currentRouteName()=='admin.ourbrand.list'||
                                Route::currentRouteName()=='admin.ourbrand.add'||
                                Route::currentRouteName()=='admin.ourbrand.edit'
                                ){{'active'}}@endif">
              
                <i class="nav-icon fa fa-cog" aria-hidden="true"></i>
                <p>
                Our Brand Management
                    <i class="right fas fa-angle-left"></i>
                </p>
            </a>
            <ul class="nav nav-treeview @if(Route::currentRouteName()=='admin.ourbrand.list'||
                                            Route::currentRouteName()=='admin.ourbrand.add'||
                                            Route::currentRouteName()=='admin.ourbrand.edit'||
                                            Route::currentRouteName()=='admin.ourbrand.ourbrandsettings' 
                                            
                        ){{'style="display: block;"'}}@endif">
                
                
                <li class="nav-item">
                    <a href="{{route('admin.ourbrand.list' )}}"
                    class="nav-link @if(Route::currentRouteName()=='admin.ourbrand.list'||
                                        Route::currentRouteName()=='admin.ourbrand.edit' 
                                
                                ){{'active'}}@endif">
                        <i class="far fa-circle nav-icon"></i>
                        <p>  Brand List</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{route('admin.ourbrand.add' )}}"
                    class="nav-link @if(Route::currentRouteName()=='admin.ourbrand.add'
                                
                                ){{'active'}}@endif">
                        <i class="far fa-circle nav-icon"></i>
                        <p> Brand Add</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{route('admin.ourbrand.ourbrandsettings' )}}"
                    class="nav-link @if(Route::currentRouteName()=='admin.ourbrand.ourbrandsettings'
                                
                                ){{'active'}}@endif">
                        <i class="far fa-circle nav-icon"></i>
                        <p> Our Brand Settings</p>
                    </a>
                </li>
                
            </ul>
        </li>
        <!-- Our Brand Management-->

        <!-- faq-->
        <li class="nav-item has-treeview @if( 
                    Route::currentRouteName()=='admin.project.faq.index'||
                    Route::currentRouteName()=='admin.project.faq.add'||
                    Route::currentRouteName()=='admin.project.faq.edit' 
                    
                
                
                    ){{'menu-open'}}@endif">
            <a href="#"
            class="nav-link @if( 
                                Route::currentRouteName()=='admin.project.faq.index'||
                                Route::currentRouteName()=='admin.project.faq.add' ||
                                Route::currentRouteName()=='admin.project.faq.edit' 
                              
                                ){{'active'}}@endif">
              
                <i class="nav-icon fa fa-paperclip" aria-hidden="true"></i>
                <p>
                Faq Management
                    <i class="right fas fa-angle-left"></i>
                </p>
            </a>
            <ul class="nav nav-treeview @if(Route::currentRouteName()=='admin.project.faq.index' ||
                                            Route::currentRouteName()=='admin.project.faq.add' ||
                                            Route::currentRouteName()=='admin.project.faq.edit' 
                                         
                                            
                        ){{'style="display: block;"'}}@endif">
                
                
                <li class="nav-item">
                    <a href="{{route('admin.project.faq.index' )}}"
                    class="nav-link @if(Route::currentRouteName()=='admin.project.faq.index' ||
                                       
                                        Route::currentRouteName()=='admin.project.faq.edit'
                                
                                ){{'active'}}@endif">
                        <i class="far fa-circle nav-icon"></i>
                        <p> Faq List</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{route('admin.project.faq.add' )}}"
                    class="nav-link @if(
                                        Route::currentRouteName()=='admin.project.faq.add' 
                                
                                ){{'active'}}@endif">
                        <i class="far fa-circle nav-icon"></i>
                        <p> Faq Add</p>
                    </a>
                </li>
                
            </ul>
        </li>

         <!-- jobs-->

          <li class="nav-item has-treeview @if( 
                    Route::currentRouteName()=='admin.jobs.jobs.list'||
                    Route::currentRouteName()=='admin.jobs.jobs.add'||
                    Route::currentRouteName()=='admin.jobs.edit' 
                
                
                    ){{'menu-open'}}@endif">
            <a href="#"
            class="nav-link @if( 
                    Route::currentRouteName()=='admin.jobs.jobs.list'||
                    Route::currentRouteName()=='admin.jobs.jobs.add'||
                    Route::currentRouteName()=='admin.jobs.edit' 
                                ){{'active'}}@endif">
     
      
                <i class="nav-icon  fa fa-envelope-open" aria-hidden="true"></i>
                <p>
                Join Us 
                    <i class="right fas fa-angle-left"></i>

                </p>
            </a>
            <ul class="nav nav-treeview @if(
                    Route::currentRouteName()=='admin.jobs.jobs.list'||
                    Route::currentRouteName()=='admin.jobs.jobs.add'||
                    Route::currentRouteName()=='admin.jobs.edit' 
                                            
                        ){{'style="display: block;"'}}@endif">
                
                
                <li class="nav-item">
                    <a href="{{route('admin.jobs.jobs.list' )}}"
                    class="nav-link @if(Route::currentRouteName()=='admin.jobs.jobs.list'||
                                       
                                        Route::currentRouteName()=='admin.jobs.edit' 
                                
                                ){{'active'}}@endif">
                        <i class="far fa-circle nav-icon"></i>
                        <p> Join Us List</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{route('admin.jobs.jobs.add' )}}"
                    class="nav-link @if(
                                        Route::currentRouteName()=='admin.jobs.jobs.add'
                                
                                ){{'active'}}@endif">
                        <i class="far fa-circle nav-icon"></i>
                        <p> Join Us Add</p>
                    </a>
                </li>
   
            </ul>
        </li>

        <!-- contacts-->
        <li class="nav-item has-treeview @if( 
                    Route::currentRouteName()=='admin.contacts.contacts.list'||
                    Route::currentRouteName()=='admin.contacts.contact-settings'
                
                
                    ){{'menu-open'}}@endif">
            <a href="#"
            class="nav-link @if( 
                                Route::currentRouteName()=='admin.contacts.contacts.list'||
                                Route::currentRouteName()=='admin.contacts.contact-settings'
                                ){{'active'}}@endif">
              
                <i class="nav-icon fa fa-fax" aria-hidden="true"></i>
                <p>
                Contacts Us
                    <i class="right fas fa-angle-left"></i>
                </p>
            </a>
            <ul class="nav nav-treeview @if(Route::currentRouteName()=='admin.contacts.contacts.list'||
                                         Route::currentRouteName()=='admin.contacts.contact-settings' 
                                            
                        ){{'style="display: block;"'}}@endif">
                
                
                <li class="nav-item">
                    <a href="{{route('admin.contacts.contacts.list' )}}"
                    class="nav-link @if(Route::currentRouteName()=='admin.contacts.contacts.list'
                                
                                ){{'active'}}@endif">
                        <i class="far fa-circle nav-icon"></i>
                        <p> Contacts List</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{route('admin.contacts.contact-settings' )}}"
                    class="nav-link @if(Route::currentRouteName()=='admin.contacts.contact-settings'
                                
                                ){{'active'}}@endif">
                        <i class="far fa-circle nav-icon"></i>
                        <p> Contacts Settings</p>
                    </a>
                </li>
                
            </ul>
        </li>


        <li class="nav-item has-treeview @if( 
                    Route::currentRouteName()=='admin.our-achievements.list'||
                    Route::currentRouteName()=='admin.our-achievements.add'||
                    Route::currentRouteName()=='admin.our-achievements.edit'
                
                
                    ){{'menu-open'}}@endif">
            <a href="#"
            class="nav-link @if( 
                                Route::currentRouteName()=='admin.our-achievements.list'||
                                Route::currentRouteName()=='admin.our-achievements.add'||
                                Route::currentRouteName()=='admin.our-achievements.edit'
                                ){{'active'}}@endif">
              
                <i class="nav-icon fa fa-trophy" aria-hidden="true"></i>
                <p>
                Our Achievement Manage
                    <i class="right fas fa-angle-left"></i>
                </p>
            </a>
            <ul class="nav nav-treeview @if(Route::currentRouteName()=='admin.our-achievements.list'||
                                            Route::currentRouteName()=='admin.our-achievements.add'||
                                            Route::currentRouteName()=='admin.our-achievements.edit' 
                                            
                        ){{'style="display: block;"'}}@endif">
                
                
                <li class="nav-item">
                    <a href="{{route('admin.our-achievements.list' )}}"
                    class="nav-link @if(Route::currentRouteName()=='admin.our-achievements.list'||
                                        Route::currentRouteName()=='admin.our-achievements.edit' 
                                
                                ){{'active'}}@endif">
                        <i class="far fa-circle nav-icon"></i>
                        <p>  Our Achievement List</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{route('admin.our-achievements.add' )}}"
                    class="nav-link @if(Route::currentRouteName()=='admin.our-achievements.add'
                                
                                ){{'active'}}@endif">
                        <i class="far fa-circle nav-icon"></i>
                        <p> Our Achievement Add</p>
                    </a>
                </li>
                
            </ul>
        </li>


         <!-- Chat-->
        {{--<li class="nav-item has-treeview @if( 
          
            Route::currentRouteName()=='admin.project.faq.chat.admin' 
        
        
            ){{'menu-open'}}@endif">
    <a href="#"
    class="nav-link @if( 
                      
                        Route::currentRouteName()=='admin.project.faq.chat.admin'
                        ){{'active'}}@endif">
      
        <i class="nav-icon fa fa-fax" aria-hidden="true"></i>
        <p>
        Chat Management
            <i class="right fas fa-angle-left"></i>
        </p>
    </a>
    <ul class="nav nav-treeview @if(
                                    Route::currentRouteName()=='admin.project.faq.chat.admin'
                                    
                ){{'style="display: block;"'}}@endif">
        
        <li class="nav-item">
            <a href="{{route('admin.project.faq.chat.admin' )}}"
            class="nav-link @if(
                                Route::currentRouteName()=='admin.project.faq.chat.admin' 
                        
                        ){{'active'}}@endif">
                <i class="far fa-circle nav-icon"></i>
                <p> Customer Support Chat</p>
            </a>
        </li>
    </ul>
</li>--}}

                <!-- -->
            </ul>

        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
