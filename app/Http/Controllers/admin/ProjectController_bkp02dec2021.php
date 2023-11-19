<?php
/*****************************************************/
# ProjectController
# Page/Class name   : ProjectController
# Author            :
# Created Date      : 30-03-2020
# Functionality     : index, add, edit. delete 
# Purpose           : Project Management
/*****************************************************/

/*namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Auth;
use Cookie;
use Illuminate\Http\Request;
use Validator;
use Input;*/
namespace App\Http\Controllers\admin;

use App;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Helper, AdminHelper, Image, Auth, Hash, Redirect, Validator, View;
use Illuminate\Support\Facades\File as FileSystem;

use App\Models\Timezone;
use Config;
use Carbon\Carbon;

use App\Models\User;
use App\Models\Project;
use App\Models\ProjectFaq;
use App\Models\ProjectGallery;
use App\Models\ProjectUnit;
use App\Models\ProjectUnitGallery;

use App\Models\ProjectNearPlace;
use App\Models\ProjectService;

use App\Models\ProjectStatus;
use App\Models\ProjectType;

use App\Models\City;

use Session;
use DB;
use File;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Exception;

class ProjectController extends Controller
{
    private static $paginationLimit= 10;
    //=================================================================
    /*****************************************************/
    # ProjectController
    # Function name : index
    # Author        :
    # Created Date  : ProjectController
    # Purpose       : Show the list of the projects
    # Params        : 
    /*****************************************************/

    public function index()
    {  
        $projectData = array();
        
        $projectData['page_title']="Project Management";
        $projectData['panel_title']="Project Management";
        if(isset($_GET['q']) and !empty($_GET['q']))
        {
            $searchKeyword = $_GET['q'];
        }
        else
        {
            $searchKeyword = '';
        }

        if($searchKeyword != '')
        {
            //echo 'hello'; die;
            $projects = Project::orWhere('name', 'like', '%' .trim($searchKeyword) . '%')->orWhere('name_ar', 'like', '%' .trim($searchKeyword) . '%')->orderBy('id','desc')->paginate(self::$paginationLimit);  
        }
        else
        {
            //echo 'hi'; die;
            $projects = Project::orderBy('id','desc')->paginate(self::$paginationLimit);  
        }

        //$projects = Project::paginate(self::$paginationLimit);    
        $projectData['projects'] = $projects;
        
        
        return view('admin/project/index',$projectData);

    }

    //=================================================================
    /*****************************************************/
    # ProjectController
    # Function name : add
    # Author        :
    # Created Date  : ProjectController
    # Purpose       : Show project add form
    # Params        : Request $request
    /*****************************************************/

    public function add(Request $request)
    {  
        $projectData = array();

        $projectData['page_title']='Project Create ';
        $projectData['panel_title']='Project Create ';

        $serviceData = ProjectService::where('status','1')->get();   
        $projectData['serviceData'] = $serviceData;
        
        $nearData = ProjectNearPlace::where('status','1')->get();   
        $projectData['nearData'] = $nearData;

        $typeData = ProjectType::where('status_flag','1')->get();   
        $projectData['typeData'] = $typeData;

        $statusData = ProjectStatus::where('status_flag','1')->get();   
        $projectData['statusData'] = $statusData;

        $cityData = City::where('status','A')->get();   
        $projectData['cityData'] = $cityData;
        //dd($projectData);

        return view('admin/project/add',$projectData);
    }

    //=================================================================
    /*****************************************************/
    # ProjectController
    # Function name : save
    # Author        :
    # Created Date  : ProjectController
    # Purpose       : Save project form data.
    # Params        : Request $request
    /*****************************************************/
    
    public function save(Request $request)
    {
        
        try {
            //dd($request->all());

            $validator = Validator::make($request->all(), [
                        'name' => 'required|unique:projects',
                        'name_ar' => 'required',
                        'heading' => 'required',
                        'heading_ar' => 'required',
                        'content' => 'required',
                        'content_ar' => 'required',
                         'slogan' => 'required',
                        'slogan_ar' => 'required',
                        'short_description_en' => 'required',
                        'short_description_ar' => 'required',
                        'banner_image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2000',
                        'map' => 'required',
                        'near_to' => 'required',
                        'services' => 'required',
                        /*'content_video' => 'required',*/
                        'type' => 'required',
                        'project_status' => 'required',
                        'city' => 'required',
                        'bedroom' => 'required',
                        'space' => 'required',
                        //'project_logo' => 'required',
                        //'gallery_image' => 'image|mimes:jpeg,png,jpg,gif|max:20000',
                        'status' => 'required'
                    ]);
                    
            if ($validator->fails()) { 
                
                        return redirect('admin/project/add')
                                    ->withErrors($validator)
                                    ->withInput();
            } else {

                 /* BANNER IMAGE */
                $banner_image = $request->file('banner_image');
                if(!empty($banner_image)) {
                $banner_imagename = pathinfo($banner_image->getClientOriginalName(), PATHINFO_FILENAME).'_'.time().'.'.$banner_image->getClientOriginalExtension();
                    
                    $banner_destinationPath = public_path('/admin/upload/project/banner/thumbnail');
                    
                    $bannerimg = Image::make($banner_image->getRealPath());

                    $bannerimg->resize(262, 271, function ($constraint) {
                        $constraint->aspectRatio();
                    })->save($banner_destinationPath.'/'.$banner_imagename);

                    $banner_destinationPath_original = public_path('/admin/upload/project/banner/original');
                    $banner_image->move($banner_destinationPath_original, $banner_imagename);
                } else {

                    $banner_imagename = '';
                }
                /* BANNER IMAGE END */


                /* Brochure */
                $brochure = $request->file('brochure');
                if(!empty($brochure)) {
                $brochurename = pathinfo($brochure->getClientOriginalName(), PATHINFO_FILENAME).'_'.time().'.'.$brochure->getClientOriginalExtension();
                    
                    $brochure_destinationPath = public_path('/admin/upload/project/brochure/english');
                    
                    // $bannerimg = Image::make($banner_image->getRealPath());

                    // $bannerimg->resize(262, 271, function ($constraint) {
                    //     $constraint->aspectRatio();
                    // })->save($banner_destinationPath.'/'.$banner_imagename);

                    // $banner_destinationPath_original = public_path('/admin/upload/project/banner/original');
                    $brochure->move($brochure_destinationPath, $brochurename);
                } else {

                    $brochurename = '';
                }
                /* Brochure END */


                /* Brochure Ar */
                $brochure_ar = $request->file('brochure_ar');
                if(!empty($brochure_ar)) {
                $brochurename_ar = pathinfo($brochure_ar->getClientOriginalName(), PATHINFO_FILENAME).'_'.time().'.'.$brochure_ar->getClientOriginalExtension();
                    
                    $brochure_destinationPath_ar = public_path('/admin/upload/project/brochure/arabic');
                    
                    // $bannerimg = Image::make($banner_image->getRealPath());

                    // $bannerimg->resize(262, 271, function ($constraint) {
                    //     $constraint->aspectRatio();
                    // })->save($banner_destinationPath.'/'.$banner_imagename);

                    // $banner_destinationPath_original = public_path('/admin/upload/project/banner/original');
                    $brochure_ar->move($brochure_destinationPath_ar, $brochurename_ar);
                } else {

                    $brochurename_ar = '';
                }
                /* Brochure Ar END */

                //==========code by pk date: 10/11/2021 ============// 
                $page_slug=$request->page_slug;
                $count=Project::select('slug_name')->where('slug_name','=',$page_slug)->count();
                if($count>0)
                {
                  // session()->flash('error', 'Slug already exists');
                  // Session::flash('alert-class', 'alert-danger');
                  // return redirect('admin/project/add');
                  $errMsg = array();
                        $errMsg['slugerror'] = 'Slug already exists!';
                        return Redirect::back()
                                    ->withErrors($errMsg)
                                    ->withInput();
                }
                if($page_slug!="")
                {
                  $pageSlug=$page_slug;
                }
                else
                {
                  $slug_name = Str::slug($request->name, '-');
                  $pageSlug=$slug_name;
                }
                //==========code by pk date: 10/11/2021 ============//

                //$slug_name = Str::slug($request->name, '-');

                $project = new \App\Models\Project;
                //$gallery = new \App\Models\ProjectGallery;
                //$project->slug_name = $slug_name;
                $project->slug_name = $pageSlug;
                $project->name = $request->name;
                $project->name_ar = $request->name_ar;
                $project->slogan = $request->slogan;
                $project->slogan_ar = $request->slogan_ar;
                $project->banner = $banner_imagename;
                $project->heading = $request->heading;
                $project->heading_ar = $request->heading_ar;
                $project->brochure = $brochurename;
                $project->brochure_ar = $brochurename_ar;
                $project->content_video = $request->content_video;
                $project->content = $request->content;
                $project->content_ar = $request->content_ar;
                $project->short_description_en = $request->short_description_en;
                $project->short_description_ar = $request->short_description_ar;
                $project->map = $request->map;
                $project->near_to = implode(',',$request->near_to);
                $project->services = implode(',',$request->services);
                $project->virtual_toure_image = $request->virtual_toure_image;
                $project->type = $request->type;
                $project->project_status = $request->project_status;
                $project->bedroom = $request->bedroom;
                $project->city = $request->city;
                $project->space = $request->space;
                $project->featured = '0';
                $project->status = $request->status;
                $project->display_order = $request->display_order;

                $project->meta_title = $request->meta_title;
                $project->meta_descriptions = $request->meta_descriptions;
                $project->meta_keyword = $request->meta_keyword;
                $project->alt_text = $request->alt_text;
                $project->canonical = $request->canonical;

                $project->meta_title_ar             = trim($request->meta_title_ar, ' ');
                $project->meta_descriptions_ar      = trim($request->meta_descriptions_ar, ' ');
                $project->meta_keyword_ar           = trim($request->meta_keyword_ar, ' ');
                $project->alt_text_ar               = trim($request->alt_text_ar, ' ');
                $project->canonical_ar              = trim($request->canonical_ar, ' ');

                //==========code by pk date: 14/11/2021 ============//
                //echo htmlentities($request->json_ld); 
                $project->json_ld = htmlentities($request->json_ld);
                $project->global_site_tag = htmlentities($request->global_site_tag);
                //==========code by pk date: 14/11/2021 ============//

                /*if($request->file('project_logo')) {
                    $files1=$request->file('project_logo');
                    $fullFileName1 = time().'.'.$files1->getClientOriginalExtension();
                    $destinationPath ='admin/upload/project-logo';
                    $img =Image::make($request->file('project_logo')->getRealPath());
                    $img->resize(105, 105, function ($constraint) {
                        $constraint->aspectRatio();
                    })->save($destinationPath.'/'.$fullFileName1);
                    $files1->move($destinationPath, $fullFileName1);
                    $project->project_logo=$fullFileName1;
                     //dd($project->project_logo) ;        
                }*/

                if($request->file('video_thumbnail_image')) {
                    $files1=$request->file('video_thumbnail_image');
                    $fullFileName1 = time().'.'.$files1->getClientOriginalExtension();
                    $destinationPath ='admin/upload/project/video_thumbnail_image';
                    $img =Image::make($request->file('video_thumbnail_image')->getRealPath());
                    $img->resize(729, 401, function ($constraint) {
                        $constraint->aspectRatio();
                    })->save($destinationPath.'/'.$fullFileName1);
                    $files1->move($destinationPath, $fullFileName1);
                    $project->video_thumbnail_image=$fullFileName1;       
                }
                if($request->file('mobile_banner_image')) {
                    $files2=$request->file('mobile_banner_image');
                    $fullFileName2 = time().'.'.$files2->getClientOriginalExtension();
                    $destinationPath ='admin/upload/project/mobile_banner_image';
                    $img =Image::make($request->file('mobile_banner_image')->getRealPath());
                    $img->resize(767, 818, function ($constraint) {
                        $constraint->aspectRatio();
                    })->save($destinationPath.'/'.$fullFileName2);
                    $files2->move($destinationPath, $fullFileName2);
                    $project->mobile_banner_image=$fullFileName2;       
                }

                $project->save();

                $project_id = $project->id;


                /* Gallery */
                $galdestinationPath_thumb = public_path('/admin/upload/project/gallery/thumbnail');
                $galdestinationPath_original = public_path('/admin/upload/project/gallery/original');
                $gallery_image = $request->file('gallery_image');
                if(!empty($gallery_image)) {
                    $galname = array();
                    foreach($gallery_image as $gi)
                    {
                        $gallery_image_each ='';
                        $gallery_image_each = pathinfo($gi->getClientOriginalName(), PATHINFO_FILENAME).'_'.time().'.'.$gi->getClientOriginalExtension();
                        //$gi->move($refdestinationPath, $refname_each);

                        $galimg = Image::make($gi->getRealPath());

                        $galimg->resize(262, 271, function ($constraint) {
                            $constraint->aspectRatio();
                        })->save($galdestinationPath_thumb.'/'.$gallery_image_each);

                        //$banner_destinationPath_original = public_path('/admin/upload/project/banner/original');
                        $gi->move($galdestinationPath_original, $gallery_image_each);

                        $galname[] = $gallery_image_each;
                    }
                }
                else{
                    $galname = '';
                }
                /* Gallery END */
                //dd($galname);

                if(!empty($galname))
                {
                    // echo $project_id;
                    // dd($galname);
                    foreach($galname as $gn)
                    {
                        $gallery = new \App\Models\ProjectGallery;

                        $gallery->project_id = $project_id;
                        $gallery->gallery_image = $gn;

                        $gallery->save();
                    }
                }

                session()->flash('success', 'Record added successfully');
                Session::flash('alert-class', 'alert-success'); 
                return redirect('admin/project/index');

            }

        }
        catch (\Exception $e) {
            Log::error($e->getMessage());
            //session()->flash('message', $e->getMessage());
            
            session()->flash('error', $e->getMessage());
            Session::flash('alert-class', 'alert-danger');
            return redirect('admin/project/add');
           
        }
    }

    //=================================================================
    
    /*****************************************************/
    # ProjectController
    # Function name : edit
    # Author        :
    # Created Date  : ProjectController
    # Purpose       : Load edit solution page template
    # Params        : Request $request
    /*****************************************************/
    public function edit($pid)
    {
        $projectData = array();

        $id = decrypt($pid, Config::get('Constant.ENC_KEY'));

        $projectData['page_title']='Project Edit ';
        $projectData['panel_title']='Project Edit ';

        $serviceData = ProjectService::where('status','1')->get();   
        $projectData['serviceData'] = $serviceData;
        
        $nearData = ProjectNearPlace::where('status','1')->get();   
        $projectData['nearData'] = $nearData;

        $typeData = ProjectType::where('status_flag','1')->get();   
        $projectData['typeData'] = $typeData;

        $statusData = ProjectStatus::where('status_flag','1')->get();   
        $projectData['statusData'] = $statusData;

        $cityData = City::where('status','A')->get();   
        $projectData['cityData'] = $cityData;

        $projectDetail = Project::where('id',$id)->first();
        $projectData['projectDetail'] = $projectDetail;

        $projectGallery = ProjectGallery::where('project_id',$id)->get();
        $projectData['projectGallery'] = $projectGallery;
        //dd($projectData);

        return view('admin/project/edit',$projectData);
    }

    //====================================================================
    /*****************************************************/
    # ProjectController
    # Function name : update
    # Author        :
    # Created Date  : ProjectController
    # Purpose       : Update solution page data
    # Params        : Request $request
    /*****************************************************/
    public function update(Request $request) {
      //  echo "<pre>";
      //  print_r($request->all()); die;
        try {
            //dd($request->all());

            $validator = Validator::make($request->all(), [
                'name' => 'required',
                'name_ar' => 'required',
                'heading' => 'required',
                'heading_ar' => 'required',
                'content' => 'required',
                'content_ar' => 'required',
                'slogan' => 'required',
                'slogan_ar' => 'required',
                'short_description_en' => 'required',
                'short_description_ar' => 'required',
                //'banner_image' => 'image|mimes:jpeg,png,jpg,gif|max:2000',
                'map' => 'required',
                'near_to' => 'required',
                'services' => 'required',
                /*'content_video' => 'required',*/
                'type' => 'required',
                'project_status' => 'required',
                'city' => 'required',
                'bedroom' => 'required',
                'space' => 'required',
                //'gallery_image' => 'image|mimes:jpeg,png,jpg,gif|max:20000',
                //'status' => 'required'
            ]);
                    
            if ($validator->fails()) { 
                
                        return redirect('admin/project/edit/'.encrypt($request->project_id, Config::get('Constant.ENC_KEY')))
                                    ->withErrors($validator)
                                    ->withInput();
            } else {

                //$unit = new \App\Models\ProjectUnit;
                //$gallery = new \App\Models\ProjectGallery;

                 /* BANNER IMAGE */
                 $banner_image = $request->file('banner_image');
                 if(!empty($banner_image)) {
                 $banner_imagename = pathinfo($banner_image->getClientOriginalName(), PATHINFO_FILENAME).'_'.time().'.'.$banner_image->getClientOriginalExtension();
                     
                     $banner_destinationPath = public_path('/admin/upload/project/banner/thumbnail');
                     
                     $bannerimg = Image::make($banner_image->getRealPath());
 
                     $bannerimg->resize(262, 271, function ($constraint) {
                         $constraint->aspectRatio();
                     })->save($banner_destinationPath.'/'.$banner_imagename);
 
                     $banner_destinationPath_original = public_path('/admin/upload/project/banner/original');
                     $banner_image->move($banner_destinationPath_original, $banner_imagename);
                 } else {
                    
                     $banner_imagename = $_POST['old_banner'];
                 }
                 /* BANNER IMAGE END */ 

                 /* Brochure */
                $brochure = $request->file('brochure');
                if(!empty($brochure)) {
                $brochurename = pathinfo($brochure->getClientOriginalName(), PATHINFO_FILENAME).'_'.time().'.'.$brochure->getClientOriginalExtension();
                    
                    $brochure_destinationPath = public_path('/admin/upload/project/brochure/english');
                    
                    // $bannerimg = Image::make($banner_image->getRealPath());

                    // $bannerimg->resize(262, 271, function ($constraint) {
                    //     $constraint->aspectRatio();
                    // })->save($banner_destinationPath.'/'.$banner_imagename);

                    // $banner_destinationPath_original = public_path('/admin/upload/project/banner/original');
                    $brochure->move($brochure_destinationPath, $brochurename);
                } else { 
                    $brochurename = isset($_POST['old_brochure'])?$_POST['old_brochure']:'';
                }
                //dd($brochurename);
                /* Brochure END */

                /* Brochure Ar */
                $brochure_ar = $request->file('brochure_ar');
                if(!empty($brochure_ar)) {
                $brochurename_ar = pathinfo($brochure_ar->getClientOriginalName(), PATHINFO_FILENAME).'_'.time().'.'.$brochure_ar->getClientOriginalExtension();
                    
                    $brochure_destinationPath_ar = public_path('/admin/upload/project/brochure/arabic');
                    
                    // $bannerimg = Image::make($banner_image->getRealPath());

                    // $bannerimg->resize(262, 271, function ($constraint) {
                    //     $constraint->aspectRatio();
                    // })->save($banner_destinationPath.'/'.$banner_imagename);

                    // $banner_destinationPath_original = public_path('/admin/upload/project/banner/original');
                    $brochure_ar->move($brochure_destinationPath_ar, $brochurename_ar);
                } else {

                    $brochurename_ar = isset($_POST['old_brochure_ar'])?$_POST['old_brochure_ar']:'';
                }
                /* Brochure Ar END */

                //==========code by pk date: 10/11/2021 ============//
                $page_slug=$request->page_slug;
                $count=Project::select('slug_name')->where('slug_name','=',$page_slug)->where('id','!=',$request->project_id)->count();
                if($count>0)
                {
                  //session()->flash('error', 'Slug already exists');
                  //Session::flash('alert-class', 'alert-danger');
                  //return redirect('admin/project/edit/'.encrypt($request->project_id, Config::get('Constant.ENC_KEY')));
                  $errMsg = array();
                        $errMsg['slugerror'] = 'Slug already exists!';
                        return Redirect::back()
                                    ->withErrors($errMsg)
                                    ->withInput();
                }
                if($page_slug!="")
                {
                  $pageSlug=$page_slug;
                }
                else
                {
                  $slug_name = Str::slug($request->name, '-');
                  $pageSlug=$slug_name;
                }
                //==========code by pk date: 10/11/2021 ============//
                $project = Project::find($request->project_id);
                $project->slug_name = $pageSlug;
                $project->name = $request->name;
                $project->name_ar = $request->name_ar;
                 $project->slogan = $request->slogan;
                $project->slogan_ar = $request->slogan_ar;
                $project->banner = $banner_imagename;
                $project->heading = $request->heading;
                $project->heading_ar = $request->heading_ar;
                $project->brochure = $brochurename;
                $project->brochure_ar = $brochurename_ar;
                $project->content_video = $request->content_video;
                $project->content = $request->content;
                $project->content_ar = $request->content_ar;
                $project->short_description_en = $request->short_description_en;
                $project->short_description_ar = $request->short_description_ar;
                $project->map = $request->map;
                $project->near_to = implode(',',$request->near_to);
                $project->services = implode(',',$request->services);
                $project->virtual_toure_image = $request->virtual_toure_image;
                $project->type = $request->type;
                $project->project_status = $request->project_status;
                $project->bedroom = $request->bedroom;
                $project->city = $request->city;
                $project->display_order = $request->display_order;

                $project->meta_title = $request->meta_title;
                $project->meta_descriptions = $request->meta_descriptions;
                $project->meta_keyword = $request->meta_keyword;
                $project->alt_text = $request->alt_text;
                $project->canonical = $request->canonical;

                $project->meta_title_ar             = trim($request->meta_title_ar, ' ');
                $project->meta_descriptions_ar      = trim($request->meta_descriptions_ar, ' ');
                $project->meta_keyword_ar           = trim($request->meta_keyword_ar, ' ');
                $project->alt_text_ar               = trim($request->alt_text_ar, ' ');
                $project->canonical_ar              = trim($request->canonical_ar, ' ');

                //==========code by pk date: 14/11/2021 ============//
                //echo htmlentities($request->json_ld); die;
                //echo $request->json_ld; die; 
                $project->json_ld = $request->json_ld;
                $project->global_site_tag = $request->global_site_tag;
                //==========code by pk date: 14/11/2021 ============//
                
                /*$project->Brocher_en_chk = $request->Brocher_en_chk;
                $project->Brocher_ar_chk = $request->Brocher_ar_chk;*/
                $project->reservation_en_chk = $request->reservation_en_chk;
                $project->reservation_ar_chk = $request->reservation_ar_chk;
                if($request->file('featured_image')) {

                    $files=$request->file('featured_image');
                    $fullFileName = time().'.'.$files->getClientOriginalExtension();
                    $destinationPath                  = 'admin/upload/project/featured_image';
                    $uploadResponse                   = $files->move($destinationPath,$fullFileName);

                    $project->featured_image=$fullFileName;
                } 
                $project->space = $request->space;

                /*if($request->file('project_logo')) {
                    $files1=$request->file('project_logo');
                    $fullFileName1 = time().'.'.$files1->getClientOriginalExtension();
                    $destinationPath1= 'admin/upload/project-logo';
                    $img =Image::make($request->file('project_logo')->getRealPath());
                    $img->resize(105, 105, function ($constraint) {
                        $constraint->aspectRatio();
                    })->save($destinationPath1.'/'.$fullFileName1);
                    $uploadResponse=  $files1->move($destinationPath1, $fullFileName1);
                    $project->project_logo=$fullFileName1; 
                            
                }*/

                if($request->file('video_thumbnail_image')) {
                    $files1=$request->file('video_thumbnail_image');
                    $fullFileName1 = time().'.'.$files1->getClientOriginalExtension();
                    $destinationPath ='admin/upload/project/video_thumbnail_image';
                    $img =Image::make($request->file('video_thumbnail_image')->getRealPath());
                    $img->resize(729, 401, function ($constraint) {
                        $constraint->aspectRatio();
                    })->save($destinationPath.'/'.$fullFileName1);
                    $files1->move($destinationPath, $fullFileName1);
                    $project->video_thumbnail_image=$fullFileName1;       
                }
                if($request->file('mobile_banner_image')) {
                    $files2=$request->file('mobile_banner_image');
                    $fullFileName2 = time().'.'.$files2->getClientOriginalExtension();
                    $destinationPath ='admin/upload/project/mobile_banner_image';
                    $img =Image::make($request->file('mobile_banner_image')->getRealPath());
                    $img->resize(767, 818, function ($constraint) {
                        $constraint->aspectRatio();
                    })->save($destinationPath.'/'.$fullFileName2);
                    $files2->move($destinationPath, $fullFileName2);
                    $project->mobile_banner_image=$fullFileName2;       
                }
                $project->save();

                // $getUnit = ProjectUnit::where('id',$request->unit_id)->first();
                // $project_id = $getUnit->project_id;

                $galleryImages= ProjectGallery::where('project_id',$request->project_id)->get();
                    foreach($galleryImages as $galleryImage){
                        //if(!empty($request->galleryImage[$unitImage->id]) && $request->galleryImage[$unitImage->id] == "Y" )
                        // if(!empty($request->galleryImage[$unitImage->id]) )
                        //     ProjectUnitGallery::where(["id"=>$homeImage->id])->update(['is_checked' => 'Y']);
                        // else
                        //     ProjectUnitGallery::where(["id"=>$homeImage->id])->update(['is_checked' => 'N']);
                        if(isset($_POST['oldimg']) and $_POST['oldimg']!='')
                        {
                            if(!in_array($galleryImage->id, $_POST['oldimg']))
                            {
                                ProjectGallery::where('id', $galleryImage->id)->delete();
                            } 
                        }
                        
                    }


                /* Gallery */
                $galdestinationPath_thumb = public_path('/admin/upload/project/gallery/thumbnail');
                $galdestinationPath_original = public_path('/admin/upload/project/gallery/original');
                $gallery_image = $request->file('gallery_image');
                if(!empty($gallery_image)) {
                    $galname = array();
                    foreach($gallery_image as $gi)
                    {
                        $gallery_image_each ='';
                        $gallery_image_each = pathinfo($gi->getClientOriginalName(), PATHINFO_FILENAME).'_'.time().'.'.$gi->getClientOriginalExtension();
                        //$gi->move($refdestinationPath, $refname_each);

                        $galimg = Image::make($gi->getRealPath());

                        $galimg->resize(262, 271, function ($constraint) {
                            $constraint->aspectRatio();
                        })->save($galdestinationPath_thumb.'/'.$gallery_image_each);

                        //$banner_destinationPath_original = public_path('/admin/upload/project/banner/original');
                        $gi->move($galdestinationPath_original, $gallery_image_each);

                        $galname[] = $gallery_image_each;
                    }
                }
                else{
                    $galname = '';
                }
                /* Gallery END */
                //dd($galname);

                if(!empty($galname))
                {
                    // echo $project_id;
                    // dd($galname);
                    foreach($galname as $gn)
                    {
                        $gallery = new \App\Models\ProjectGallery;

                        $gallery->project_id = $request->project_id;
                        $gallery->gallery_image = $gn;

                        $gallery->save();
                    }
                }

                session()->flash('success', 'Record edited successfully');
                Session::flash('alert-class', 'alert-success'); 
                return redirect('admin/project/index');

            }

        }
        catch (\Exception $e) {
            Log::error($e->getMessage());
            //session()->flash('message', $e->getMessage());
            
            session()->flash('error', $e->getMessage());
            Session::flash('alert-class', 'alert-danger');
            return redirect('admin/project/edit/'.encrypt($request->project_id, Config::get('Constant.ENC_KEY')));
           
        }
    }

    //===================================================================
    /*****************************************************/
    # ProjectController
    # Function name : delete
    # Author        :
    # Created Date  : ProjectController
    # Purpose       : Delete solution data
    # Params        : $id
    /*****************************************************/

    public function projectDelete($pid)
    {

        $id = decrypt($pid, Config::get('Constant.ENC_KEY'));
       
        try {

            // $project = ProjectUnit::where('id', $id)->first();
            // $project_id = $project->project_id;
            
            $projectUnits = ProjectUnit::where('project_id', $id);

            foreach($projectUnits as $projectUnit)
            {
            //   $projectUnitGalleries =  ProjectUnitGallery::where('unit_id', $projectUnit->id);

            //   foreach($projectUnitGalleries as $projectUnitGallery)
            //   {
                ProjectUnitGallery::where('unit_id', $projectUnit->id)->delete();
            //   }
                
            }
            ProjectUnit::where('project_id', $id)->delete();
            ProjectGallery::where('project_id', $id)->delete();
            Project::where('id', $id)->delete();
            

            session()->flash('success', 'Project deleted successfully');
            Session::flash('alert-class', 'alert-success'); 

            return redirect('admin/project/index');
            
            } catch (\Exception $e) {
                Log::error($e->getMessage());
                session()->flash('error', $e->getMessage());
                Session::flash('alert-class', 'alert-danger');

                return redirect('admin/project/index');
              
            }
        
    }

    //=================================================================
    /*****************************************************/
    # ProjectController
    # Function name : set_feature
    # Author        :
    # Created Date  : ProjectController
    # Purpose       : Change feature status
    # Params        : $id
    /*****************************************************/
    public function set_feature($id){
        
        try {
            DB::table('projects')->update(array('featured' => '0'));
            $decId = decrypt($id, Config::get('Constant.ENC_KEY'));

            $project = Project::find($decId);
            
            $project->featured = '1';
            $project->save();
            
        
            session()->flash('success', 'Featured update successfully');
            Session::flash('alert-class', 'alert-success');
            return redirect('admin/project/index');
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            session()->flash('error', $e->getMessage());
            Session::flash('alert-class', 'alert-danger');
          return redirect('admin/project/index');
        }
    }

    //===================================================

    //=================================================================
    /*****************************************************/
    # ProjectController
    # Function name : set_status
    # Author        :
    # Created Date  : ProjectController
    # Purpose       : Change solution status
    # Params        : $id
    /*****************************************************/


     public function set_status(Request $request){
    
        $response['has_error']=1;
        $response['msg']="Something went wrong.Please try again later.";

        $projectId = decrypt($request->encryptCode, Config::get('Constant.ENC_KEY')); // get user-id After Decrypt with salt key.

        $projectObj = Project::findOrFail($projectId);
        $updateStatus = $projectObj->status == '1' ? '0' : '1'; 
        $projectObj->status=$updateStatus;
        //$projectObj->updated_at=Carbon::now();
        //$projectObj->updated_by=Auth::guard('admin')->user()->id;
        $saveResponse=$projectObj->save();       
        if($saveResponse){
            $response['has_error']=0;
            $response['msg']="Successfully changed status.";
        }
        return $response;
    }

    //===================================================
    /*****************************************************/
    # ProjectController
    # Function name : unitIndex
    # Author        :
    # Created Date  : ProjectController
    # Purpose       : unit listing
    # Params        : Request $request
    /*****************************************************/
    
    public function unitIndex($id)
    {
        $decId = decrypt($id, Config::get('Constant.ENC_KEY'));
        $unitData = array();
        
        $unitData['page_title']="Project Unit Management";
        $unitData['panel_title']="Project Unit Management";

        $projectUnits = ProjectUnit::where('project_id',$decId)->paginate(self::$paginationLimit);  
        $unitData['projectUnits'] = $projectUnits;
        $unitData['unitid'] = $decId;

        //dd($unitData);
        
        
        return view('admin/project_unit/index',$unitData);
    }
    //===========================================================================

    /*****************************************************/
    # ProjectController
    # Function name : unitAdd
    # Author        :
    # Created Date  : ProjectController
    # Purpose       : Show project unit add form
    # Params        : Request $request
    /*****************************************************/

    public function unitAdd(Request $request, $id)
    {  
        $unitData = array();

        //$decId = decrypt($id, Config::get('Constant.ENC_KEY'));

        $unitData['page_title']='Project Unit Create ';
        $unitData['panel_title']='Project Unit Create ';

        //$unitData['project_id']=$decId;

        $unitData['project_id']=$id;


        

        return view('admin/project_unit/add',$unitData);
    }

    //=================================================================
    /*****************************************************/
    # ProjectController
    # Function name : unitSave
    # Author        :
    # Created Date  : ProjectController
    # Purpose       : Save project unit form data.
    # Params        : Request $request
    /*****************************************************/
    
    public function unitSave(Request $request)
    {
        try {

            $validator = Validator::make($request->all(), [
                        'unit_name' => 'required',
                        'unit_subheading' => 'required',
                        'unit_content' => 'required',
                        'unit_name_ar' => 'required',
                        'unit_subheading_ar' => 'required',
                        'unit_content_ar' => 'required',
                        //'gallery_image' => 'image|mimes:jpeg,png,jpg,gif|max:20000'
                    ]);
                    
            if ($validator->fails()) { 
                
                        return redirect('admin/unit/add/'.$request->project_id)
                                    ->withErrors($validator)
                                    ->withInput();
            } else {

                $unit = new \App\Models\ProjectUnit;
                //$gallery = new \App\Models\ProjectGallery;
                $unit->project_id = $request->project_id;
                $unit->unit_name = $request->unit_name;
                $unit->unit_name_ar = $request->unit_name_ar;
                $unit->unit_subheading = $request->unit_subheading;
                $unit->unit_subheading_ar = $request->unit_subheading_ar;
                $unit->unit_content = $request->unit_content;
                $unit->unit_content_ar = $request->unit_content_ar;
                

                $unit->save();

                $unit_id = $unit->id;


                /* Gallery */
                $galdestinationPath_thumb = public_path('/admin/upload/unit/gallery/thumbnail');
                $galdestinationPath_original = public_path('/admin/upload/unit/gallery/original');
                $gallery_image = $request->file('gallery_image');
                if(!empty($gallery_image)) {
                    $galname = array();
                    foreach($gallery_image as $gi)
                    {
                        $gallery_image_each ='';
                        $gallery_image_each = pathinfo($gi->getClientOriginalName(), PATHINFO_FILENAME).'_'.time().'.'.$gi->getClientOriginalExtension();
                        //$gi->move($refdestinationPath, $refname_each);

                        $galimg = Image::make($gi->getRealPath());

                        $galimg->resize(262, 271, function ($constraint) {
                            $constraint->aspectRatio();
                        })->save($galdestinationPath_thumb.'/'.$gallery_image_each);

                        //$banner_destinationPath_original = public_path('/admin/upload/project/banner/original');
                        $gi->move($galdestinationPath_original, $gallery_image_each);

                        $galname[] = $gallery_image_each;
                    }
                }
                else{
                    $galname = '';
                }
                /* Gallery END */
                //dd($galname);

                if(!empty($galname))
                {
                    // echo $project_id;
                    // dd($galname);
                    foreach($galname as $gn)
                    {
                        $gallery = new \App\Models\ProjectUnitGallery;

                        $gallery->unit_id = $unit_id;
                        $gallery->unit_image = $gn;

                        $gallery->save();
                    }
                }

                session()->flash('success', 'Record added successfully');
                Session::flash('alert-class', 'alert-success'); 
                return redirect('admin/unit/index/'.encrypt($request->project_id, Config::get('Constant.ENC_KEY')));

            }

        }
        catch (\Exception $e) {
            Log::error($e->getMessage());
            //session()->flash('message', $e->getMessage());
            
            session()->flash('error', $e->getMessage());
            Session::flash('alert-class', 'alert-danger');
            return redirect('admin/unit/add/'.$request->project_id);
           
        }
    }


    //=================================================================
    /*****************************************************/
    # ProjectController
    # Function name : unitEdit
    # Author        :
    # Created Date  : ProjectController
    # Purpose       : Edit project unit form.
    # Params        : Request $request
    /*****************************************************/
    
    public function unitEdit($id)
    {
        $unitData['page_title']='Project Unit Edit ';
        $unitData['panel_title']='Project Unit Edit ';

        $unitData['unitDetail'] = ProjectUnit::where('id',$id)->first();

        $unitData['unitGalleryDetail'] = ProjectUnitGallery::where('unit_id',$id)->get();

        return view('admin/project_unit/edit',$unitData);


    }

      //=================================================================
    /*****************************************************/
    # ProjectController
    # Function name : unitSave
    # Author        :
    # Created Date  : ProjectController
    # Purpose       : Save project unit form data.
    # Params        : Request $request
    /*****************************************************/
    
    public function unitUpdate(Request $request)
    {
        try {

            $validator = Validator::make($request->all(), [
                        'unit_name' => 'required',
                        'unit_subheading' => 'required',
                        'unit_content' => 'required',
                        'unit_name_ar' => 'required',
                        'unit_subheading_ar' => 'required',
                        'unit_content_ar' => 'required',
                    ]);
                    
            if ($validator->fails()) { 
                
                        return redirect('admin/unit/edit/'.$request->unit_id)
                                    ->withErrors($validator)
                                    ->withInput();
            } else {

                //$unit = new \App\Models\ProjectUnit;
                //$gallery = new \App\Models\ProjectGallery;
                $unit = ProjectUnit::find($request->unit_id);
                $unit->unit_name = $request->unit_name;
                $unit->unit_name_ar = $request->unit_name_ar;
                $unit->unit_subheading = $request->unit_subheading;
                $unit->unit_subheading_ar = $request->unit_subheading_ar;
                $unit->unit_content = $request->unit_content;
                $unit->unit_content_ar = $request->unit_content_ar;
            
                $unit->save();
                $getUnit = ProjectUnit::where('id',$request->unit_id)->first();
                $project_id = $getUnit->project_id;

                $unitImages= ProjectUnitGallery::where('unit_id',$request->unit_id)->get();
                    foreach($unitImages as $unitImage){
                        //if(!empty($request->galleryImage[$unitImage->id]) && $request->galleryImage[$unitImage->id] == "Y" )
                        // if(!empty($request->galleryImage[$unitImage->id]) )
                        //     ProjectUnitGallery::where(["id"=>$homeImage->id])->update(['is_checked' => 'Y']);
                        // else
                        //     ProjectUnitGallery::where(["id"=>$homeImage->id])->update(['is_checked' => 'N']);
                        if(isset($_POST['oldimg']) and $_POST['oldimg']!='')
                        {
                            if(!in_array($unitImage->id, $_POST['oldimg']))
                            {
                                ProjectUnitGallery::where('id', $unitImage->id)->delete();
                            }
                        }
                        
                    }


                /* Gallery */
                $galdestinationPath_thumb = public_path('/admin/upload/unit/gallery/thumbnail');
                $galdestinationPath_original = public_path('/admin/upload/unit/gallery/original');
                $gallery_image = $request->file('gallery_image');
                if(!empty($gallery_image)) {
                    $galname = array();
                    foreach($gallery_image as $gi)
                    {
                        $gallery_image_each ='';
                        $gallery_image_each = pathinfo($gi->getClientOriginalName(), PATHINFO_FILENAME).'_'.time().'.'.$gi->getClientOriginalExtension();
                        //$gi->move($refdestinationPath, $refname_each);

                        $galimg = Image::make($gi->getRealPath());

                        $galimg->resize(262, 271, function ($constraint) {
                            $constraint->aspectRatio();
                        })->save($galdestinationPath_thumb.'/'.$gallery_image_each);

                        //$banner_destinationPath_original = public_path('/admin/upload/project/banner/original');
                        $gi->move($galdestinationPath_original, $gallery_image_each);

                        $galname[] = $gallery_image_each;
                    }
                }
                else{
                    $galname = '';
                }
                /* Gallery END */
                //dd($galname);

                if(!empty($galname))
                {
                    // echo $project_id;
                    // dd($galname);
                    foreach($galname as $gn)
                    {
                        $gallery = new \App\Models\ProjectUnitGallery;

                        $gallery->unit_id = $request->unit_id;
                        $gallery->unit_image = $gn;

                        $gallery->save();
                    }
                }

                session()->flash('success', 'Record edited successfully');
                Session::flash('alert-class', 'alert-success'); 
                return redirect('admin/unit/index/'.encrypt($project_id, Config::get('Constant.ENC_KEY')));

            }

        }
        catch (\Exception $e) {
            Log::error($e->getMessage());
            //session()->flash('message', $e->getMessage());
            
            session()->flash('error', $e->getMessage());
            Session::flash('alert-class', 'alert-danger');
            return redirect('admin/unit/edit/'.$request->unit_id);
           
        }
    }

    //=================================================================
    /*****************************************************/
    # ProjectController
    # Function name : unitDelete
    # Author        :
    # Created Date  : ProjectController
    # Purpose       : delete project unit data.
    # Params        : Request $request
    /*****************************************************/
    
    public function unitDelete($id)
    {
        try {
            $project = ProjectUnit::where('id', $id)->first();
            $project_id = $project->project_id;
            ProjectUnitGallery::where('unit_id', $id)->delete();
            ProjectUnit::where('id', $id)->delete();

            session()->flash('success', 'Unit deleted successfully');
            Session::flash('alert-class', 'alert-success'); 

            return redirect('admin/unit/index/'.encrypt($project_id, Config::get('Constant.ENC_KEY')));
            
            } catch (\Exception $e) {
                Log::error($e->getMessage());
                session()->flash('error', 'Some error occured during delete unit');
                Session::flash('alert-class', 'alert-danger');

                return redirect('admin/unit/index/'.encrypt($project_id, Config::get('Constant.ENC_KEY')));
              
            }
            
    }

     public function getProjectFeaturedStatus(Request $request){
        $response['status']=false;
        $projectObj= Project::where('id',$request->project_id)->first();

        if($projectObj->featured == '0' && ($projectObj->featured_image == null  || $projectObj->featured_image == '' ))
            $response['status']=true;

        return $response;
    }


    public function uploadFeatutredImage(Request $request){
        $project_id = $request->input('featured_project_id');
        if($project_id){
            DB::table('projects')->update(array('featured' => '0'));
            $files=$request->file('featured_image');
            $fullFileName = time().'.'.$files->getClientOriginalExtension();
            $destinationPath                  = 'admin/upload/project/featured_image';
            $uploadResponse                   = $files->move($destinationPath,$fullFileName);

            $project = Project::find($project_id);
            $project->featured_image=$fullFileName;
            $project->featured = '1';
            $project->save();
            session()->flash('success', 'Successfully Set Featured Image');
            Session::flash('alert-class', 'alert-success'); 
        } else{
            session()->flash('error','Something Went wrong Please try again later.');
            Session::flash('alert-class', 'alert-danger');
        }
        return redirect()->back();
    }
// project pdf delete 
public function PdfprojectDelete(Request $request){
        //dd($request->all());
        $investorId= $request->pdfId;
        $resources= $request->pdfsource;
        
        $response['has_error']= 1;
        $response['msg']= 'Something went wrong. Please try again later.';

        $saveResponse = Project::where("id", $investorId)->update([$resources => '']);

        if($saveResponse){
            $response['has_error']= 0;
            $response['msg']= 'Successfully deleted.';
        }    
        return json_encode( $response );    
    }

}
