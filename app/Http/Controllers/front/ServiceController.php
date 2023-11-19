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
namespace App\Http\Controllers\front;

use App;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Helper, AdminHelper, Image, Auth, Hash, Redirect, Validator, View;
use Illuminate\Support\Facades\File as FileSystem;

use App\Models\Timezone;
use Config;
use Carbon\Carbon;
use App\Traits\CommonVariables;
use App\Models\User;
use App\Models\Service; 
use App\Models\ServiceBanner;
use App\Models\{PageTitle,ServiceSeo};
use Session;
use DB;
use File;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Exception;

class ServiceController extends Controller
{
    use CommonVariables;
    private static $paginationLimit=10;

    public function __construct() {
        // Variables assign for view page
        $this->shareVariables();
    }



    //=================================================================
    /*****************************************************/
    # ServiceController
    # Function name : index
    # Author        :
    # Created Date  : ServiceController
    # Purpose       : Show the list of the service
    # Params        : 
    /*****************************************************/

	public function index()
	{  
        $pageData = array();

        $pageData['switch_lang'] = 'AR';
        $pageData['switch_link'] = 'service';
		
        // $projectData['page_title']="Project Management";
        // $projectData['panel_title']="Project Management";

        

        $serviceData = Service::where('status','A')->whereNull('deleted_at')->orderBy('id', 'DESC')->paginate(self::$paginationLimit);
        $pageData['serviceData'] = $serviceData;
        $pageData['getBanner'] = ServiceBanner::where('status','1')->first(); 

        $pageData['pageTite']  = PageTitle::where(['id'=>'1'])
                                         ->first();

        $data['serviceSeo'] =  ServiceSeo::where(['status'=>'A'])->first();                                 
        $serviceSeo=$data['serviceSeo'];
        $slug='service';
        $pageData['slug_name'] = $slug;
        $metaDetail[$slug]['title'] = $serviceSeo->meta_title; 
        $metaDetail[$slug]['meta_descriptions'] = $serviceSeo->meta_descriptions;
        $metaDetail[$slug]['meta_keyword'] = $serviceSeo->meta_keyword;
        $metaDetail[$slug]['alt_text'] = $serviceSeo->alt_text;
        $metaDetail[$slug]['canonical'] = $serviceSeo->canonical;

        $pageData['metaDetail'] = $metaDetail;                                         
		return view('front/en/services/serviceList',$pageData);

	}

    //=================================================================
    /*****************************************************/
    # ServiceController
    # Function name : each
    # Author        :
    # Created Date  : ServiceController
    # Purpose       : Show the detail of the service
    # Params        : $slug
    /*****************************************************/

	public function each($slug)
	{  
        $eachProject = array();

        $eachProject['switch_lang'] = 'AR';
        $eachProject['switch_link'] = 'ar/project-detail/'.$slug;
        $eachProject['slug'] = $slug;

        $projectDetail = Project::where('slug_name', $slug)->first();

        $serviceData = ProjectService::where('status','1')->get();   
        $eachProject['serviceData'] = $serviceData;
        
        $nearData = ProjectNearPlace::where('status','1')->get();   
        $eachProject['nearData'] = $nearData;

        $galleryData = ProjectGallery::where('project_id',$projectDetail->id)->get();   
        $eachProject['galleryData'] = $galleryData;

        $faqData = ProjectFaq::where('status','A')->get();   
        $eachProject['faqData'] = $faqData;

        $unitData = ProjectUnit::where('project_id',$projectDetail->id)->get();   
        $eachProject['unitData'] = $unitData;

        $unitGalleryData = ProjectUnitGallery::all();
        $eachProject['unitGalleryData'] = $unitGalleryData;

        //dd($faqData);

        $eachProject['projectDetail'] = $projectDetail;

        return view('front/en/project/projectEach',$eachProject);
    }


    //=================================================================
    /*****************************************************/
    # ProjectController
    # Function name : ServiceController
    # Author        :
    # Created Date  : ProjectController
    # Purpose       : Show the list of the service
    # Params        : 
    /*****************************************************/

	public function indexAr()
	{  
        $pageData = array();

        $pageData['switch_lang'] = 'EN';
        $pageData['switch_link'] = 'en/service';
		
        // $projectData['page_title']="Project Management";
        // $projectData['panel_title']="Project Management";

        

        $serviceData = Service::where('status','A')->whereNull('deleted_at')->orderBy('id', 'DESC')->paginate(self::$paginationLimit); 
        //$serviceData = App\Models\Service::where(['show_in_front'=>'1','status'=>'A'])->whereNull('deleted_at')->get();
        $pageData['getBanner'] = ServiceBanner::where('status','1')->first();
        $pageData['serviceData'] = $serviceData;

        $pageData['pageTite']  = PageTitle::where(['id'=>'1'])
                                         ->first();
        
        $data['serviceSeo'] =  ServiceSeo::where(['status'=>'A'])->first();                                 
        $serviceSeo=$data['serviceSeo'];
        $slug='service';
        $pageData['slug_name'] = $slug;
        $metaDetail[$slug]['title_ar'] = $serviceSeo->meta_title_ar; 
        $metaDetail[$slug]['meta_descriptions_ar'] = $serviceSeo->meta_descriptions_ar;
        $metaDetail[$slug]['meta_keyword_ar'] = $serviceSeo->meta_keyword_ar;
        $metaDetail[$slug]['alt_text_ar'] = $serviceSeo->alt_text_ar;
        $metaDetail[$slug]['canonical_ar'] = $serviceSeo->canonical_ar;

        $pageData['metaDetail'] = $metaDetail;                                 
		
		return view('front/ar/services/serviceList',$pageData);

	}

    //=================================================================
    /*****************************************************/
    # ServiceController
    # Function name : each
    # Author        :
    # Created Date  : ServiceController
    # Purpose       : Show the detail of the service
    # Params        : $slug
    /*****************************************************/

	public function eachAr($slug)
	{  
        $eachProject = array();
        $eachProject['switch_lang'] = 'EN';
        $eachProject['switch_link'] = 'project-detail/'.$slug;
        $eachProject['slug'] = $slug;

        $projectDetail = Project::where('slug_name', $slug)->first();

        $serviceData = ProjectService::where('status','1')->get();   
        $eachProject['serviceData'] = $serviceData;
        
        $nearData = ProjectNearPlace::where('status','1')->get();   
        $eachProject['nearData'] = $nearData;

        $galleryData = ProjectGallery::where('project_id',$projectDetail->id)->get();   
        $eachProject['galleryData'] = $galleryData;

        $faqData = ProjectFaq::where('status','A')->get();   
        $eachProject['faqData'] = $faqData;

        $unitData = ProjectUnit::where('project_id',$projectDetail->id)->get();   
        $eachProject['unitData'] = $unitData;

        $unitGalleryData = ProjectUnitGallery::all();
        $eachProject['unitGalleryData'] = $unitGalleryData;

        //dd($faqData);

        $eachProject['projectDetail'] = $projectDetail;

        return view('front/ar/project/projectEach',$eachProject);
    }





}