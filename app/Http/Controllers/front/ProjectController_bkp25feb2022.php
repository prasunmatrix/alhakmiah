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
use App\Traits\CommonVariables;
use App\Models\Timezone;
use Config;
use Carbon\Carbon;

use App\Models\User;
use App\Models\Project;
use App\Models\ProjectFaq;
use App\Models\ProjectGallery;
use App\Models\ProjectUnit;
use App\Models\ProjectUnitGallery;
use App\Models\Social;
use App\Models\ProjectNearPlace;
use App\Models\ProjectService;

use App\Models\ProjectStatus;
use App\Models\{ProjectType,CommunitiesSeo};

use App\Models\Contact;

use App\Models\City;
use App\Models\PageTitle; 
use Crypt;
use Mail;

use Session;
use DB;
use File;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Exception;

class ProjectController extends Controller
{
    use CommonVariables;
    private static $paginationLimit= 50;

    public function __construct() {
        // Variables assign for view page
        $this->shareVariables();
    }


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

        $projectData['switch_lang'] = 'AR';
        $projectData['switch_link'] = 'communities';
		
        $projectData['page_title']="Project Management";
        $projectData['panel_title']="Project Management";

        

        $typeData = ProjectType::where('status_flag','1')->get();   
        $projectData['typeData'] = $typeData;

        $statusData = ProjectStatus::where('status_flag','1')->get();   
        $projectData['statusData'] = $statusData;

        $cityData = City::where('status','A')->get();   
        $projectData['cityData'] = $cityData;

        $projectData['pageTite']  = PageTitle::where(['id'=>'1'])
                                         ->first();
        //dd($projectData);

        $pstatus = '';
        $pbedroom = '';
        $pspace = '';
        $pcity = '';
        $ptype = '';

        $projectData['pstatus'] = '';
        $projectData['pbedroom'] = '';
        $projectData['pspace'] = '';
        $projectData['pcity'] = '';
        $projectData['ptype'] = '';

        
        if(isset($_GET['do']) and ($_GET['do'] == 'filter'))
        {
            $project_status = $_GET['project_status'];
            $bedroom = $_GET['bedroom'];
            $space = $_GET['space'];
            $city = $_GET['city'];
            $type = $_GET['type'];

            $pstatus = $project_status;
            $pbedroom = $bedroom;
            $pspace = $space;
            $pcity = $city;
            $ptype = $type;

            $projectData['pstatus'] = $pstatus;
            $projectData['pbedroom'] = $pbedroom;
            $projectData['pspace'] = $pspace;
            $projectData['pcity'] = $pcity;
            $projectData['ptype'] = $ptype;

            $pagequery = array(
                'do' => 'filter',
                'project_status' => $_GET['project_status'],
                'bedroom' => $_GET['bedroom'],
                'space' => $_GET['space'],
                'city' => $_GET['city'],
                'type' => $_GET['type']
            );

            /*$query = Project::query();

            $query->when(request('project_status') != '', function ($q) {
                return $q->where('likes', '>', request('likes_amount', 0));
            });
            $query->when(request('filter_by') == 'date', function ($q) {
                return $q->orderBy('created_at', request('ordering_rule', 'desc'));
            });*/

            if(empty($project_status) and empty($bedroom) and empty($space) and empty($city) and empty($type))
            {
                //$projects = Project::where('status', '1')->orderBy('id','desc')->paginate(self::$paginationLimit);
                $projects = Project::where('status', '1')->orderBy('display_order','asc')->paginate(self::$paginationLimit);
            }
            else
            {
                //echo 'hello';
                $projects = Project::where('status', '1')
                
                    ->where(function($query) use($project_status)
                    {
                        if(!empty($project_status))
                        {
                                    $query->where('project_status',$project_status);
                        }
				    })
                
     
                
                    ->where(function($query) use($bedroom) {
                        if(!empty($bedroom)) {
                            if ($bedroom != 'more-than-4') {
                                $query->where('bedroom',$bedroom);
                            } else {
                                $query->where('bedroom','>=',$bedroom);
                            }
                            
                        }
				    })
                

                
                    ->where(function($query) use($space)
                    {
                        if(!empty($space)) {
                            if (strpos($space, '-') !== false) {
                                $explodedData = explode('-', $space);
                                $minValue = $explodedData[0];
                                $maxValue = $explodedData[1];
                                $query->where('space', '>=', $minValue)
                                        ->where('space', '<=', $maxValue);
                            } else {
                                $minValue = $space;
                                $query->where('space', '>', $minValue);
                            }                            
                        }
				    })
                

                
                    ->where(function($query) use($city)
                    {
                        if(!empty($city))
                        {
                                    $query->where('city',$city);
                        }
				    })
                

                
                    ->where(function($query) use($type)
                    {
                        if(!empty($type))
                        {
                                    $query->where('type',$type);
                        }
				    })
                
                
                //->toSql();
                //->paginate(self::$paginationLimit);
                //dd($projects);
                /*->orderBy('id','desc')->paginate(self::$paginationLimit);*/
                ->orderBy('display_order','asc')->paginate(self::$paginationLimit);
                //dd($projects);

            }
        }
        else
        {
            $pagequery = array();
            //$projects = Project::where('status', '1')->orderBy('id','desc')->paginate(self::$paginationLimit);
            $projects = Project::where('status', '1')->orderBy('display_order','asc')->paginate(self::$paginationLimit);
        }

        $projectData['pagequery'] = $pagequery;
        
        $projectData['projects'] = $projects;
        //dd($projectData);

        $data['communitiesSeo'] =  CommunitiesSeo::where(['status'=>'A'])->first();                                 
        $communitiesSeo=$data['communitiesSeo'];
        $slug='communities';
        $projectData['slug_name'] = $slug;
        $metaDetail[$slug]['title'] = $communitiesSeo->meta_title; 
        $metaDetail[$slug]['meta_descriptions'] = $communitiesSeo->meta_descriptions;
        $metaDetail[$slug]['meta_keyword'] = $communitiesSeo->meta_keyword;
        $metaDetail[$slug]['alt_text'] = $communitiesSeo->alt_text;
        $metaDetail[$slug]['canonical'] = $communitiesSeo->canonical;

        $projectData['metaDetail'] = $metaDetail;
		
		return view('front/en/project/projectList',$projectData);

	}

    //=================================================================
    /*****************************************************/
    # ProjectController
    # Function name : each
    # Author        :
    # Created Date  : ProjectController
    # Purpose       : Show the detail of the project
    # Params        : $slug
    /*****************************************************/

	public function each($slug)
	{  
        $data = array();

        $data['switch_lang'] = 'AR';
        $data['switch_link'] = 'project-detail/'.$slug;
        $data['slug'] = $slug;

        $projectDetail = Project::where('slug_name', $slug)->first();

        $serviceData = ProjectService::where('status','1')->get();   
        $data['serviceData'] = $serviceData;
        
        $nearData = ProjectNearPlace::where('status','1')->get();   
        $data['nearData'] = $nearData;

        $galleryData = ProjectGallery::where('project_id',$projectDetail->id)->get();   
        $data['galleryData'] = $galleryData;

        /*$faqData = ProjectFaq::where('status','A')->get();*/  
        $faqData = ProjectFaq::where('project_id',$projectDetail->id)->where('status','A')->get();  
        $data['faqData'] = $faqData;

        $unitData = ProjectUnit::where('project_id',$projectDetail->id)->get();   
        $data['unitData'] = $unitData;

        $unitGalleryData = ProjectUnitGallery::all();
        $data['unitGalleryData'] = $unitGalleryData;

        //dd($faqData);
        /*$data['projectDetailsPageHeading']  =  Social::where(['status'=>'A'])
        ->whereNull('deleted_at')
        ->first();*/
        $data['projectDetailsPageHeading']  =  PageTitle::whereNull('deleted_at')->first();

        $data['projectDetail'] = $projectDetail;

        $data['projectSlug']            = 'projectDetails';
        $data['communityDetailsSlug']   = $slug;

        $data['slug_name'] = $slug;
        $metaDetail[$slug]['title'] = $projectDetail->meta_title;
        $metaDetail[$slug]['meta_descriptions'] = $projectDetail->meta_descriptions;
        $metaDetail[$slug]['meta_keyword'] = $projectDetail->meta_keyword;
        $metaDetail[$slug]['alt_text'] = $projectDetail->alt_text;
        $metaDetail[$slug]['canonical'] = $projectDetail->canonical;

        $data['metaDetail'] = $metaDetail;
        //echo strip_tags(htmlspecialchars_decode($projectDetail->json_ld)); die;        
        return view('front/en/project/projectEach',$data);
    }


    //=================================================================
    /*****************************************************/
    # ProjectController
    # Function name : index
    # Author        :
    # Created Date  : ProjectController
    # Purpose       : Show the list of the projects
    # Params        : 
    /*****************************************************/

	public function indexAr()
	{  
        $projectData['switch_lang'] = 'EN';
        $projectData['switch_link'] = 'en/communities';

        //$projectData = array();
		
        $projectData['page_title']="Project Management";
        $projectData['panel_title']="Project Management";

        

        $typeData = ProjectType::where('status_flag','1')->get();   
        $projectData['typeData'] = $typeData;

        $statusData = ProjectStatus::where('status_flag','1')->get();   
        $projectData['statusData'] = $statusData;

        $cityData = City::where('status','A')->get();   
        $projectData['cityData'] = $cityData;

        $projectData['pageTite']  = PageTitle::where(['id'=>'1'])
                                         ->first();
        //dd($projectData);

        $pstatus = '';
        $pbedroom = '';
        $pspace = '';
        $pcity = '';
        $ptype = '';

        $projectData['pstatus'] = '';
        $projectData['pbedroom'] = '';
        $projectData['pspace'] = '';
        $projectData['pcity'] = '';
        $projectData['ptype'] = '';

        
        if(isset($_GET['do']) and ($_GET['do'] == 'filter'))
        {
            $project_status = $_GET['project_status'];
            $bedroom = $_GET['bedroom'];
            $space = $_GET['space'];
            $city = $_GET['city'];
            $type = $_GET['type'];

            $pstatus = $project_status;
            $pbedroom = $bedroom;
            $pspace = $space;
            $pcity = $city;
            $ptype = $type;

            $projectData['pstatus'] = $pstatus;
            $projectData['pbedroom'] = $pbedroom;
            $projectData['pspace'] = $pspace;
            $projectData['pcity'] = $pcity;
            $projectData['ptype'] = $ptype;

            $pagequery = array(
                'do' => 'filter',
                'project_status' => $_GET['project_status'],
                'bedroom' => $_GET['bedroom'],
                'space' => $_GET['space'],
                'city' => $_GET['city'],
                'type' => $_GET['type']
            );

            /*$query = Project::query();

            $query->when(request('project_status') != '', function ($q) {
                return $q->where('likes', '>', request('likes_amount', 0));
            });
            $query->when(request('filter_by') == 'date', function ($q) {
                return $q->orderBy('created_at', request('ordering_rule', 'desc'));
            });*/

            if(empty($project_status) and empty($bedroom) and empty($space) and empty($city) and empty($type))
            {
                //$projects = Project::where('status', '1')->orderBy('id','desc')->paginate(self::$paginationLimit);
                $projects = Project::where('status', '1')->orderBy('display_order','asc')->paginate(self::$paginationLimit);
            }
            else
            {
                //echo 'hello';
                $projects = Project::where('status', '1')
                
                    ->where(function($query) use($project_status)
                    {
                        if(!empty($project_status))
                        {
                                    $query->where('project_status',$project_status);
                        }
				    })
                
     
                
                    ->where(function($query) use($bedroom)
                    {
                        if(!empty($bedroom)) {
                            if ($bedroom != 'more-than-4') {
                                $query->where('bedroom',$bedroom);
                            } else {
                                $query->where('bedroom','>=',$bedroom);
                            }
                            
                        }
				    })
                

                
                    ->where(function($query) use($space)
                    {
                        if(!empty($space)) {
                            if (strpos($space, '-') !== false) {
                                $explodedData = explode('-', $space);
                                $minValue = $explodedData[0];
                                $maxValue = $explodedData[1];
                                $query->where('space', '>=', $minValue)
                                        ->where('space', '<=', $maxValue);
                            } else {
                                $minValue = $space;
                                $query->where('space', '>', $minValue);
                            }                            
                        }
				    })
                

                
                    ->where(function($query) use($city)
                    {
                        if(!empty($city))
                        {
                                    $query->where('city',$city);
                        }
				    })
                

                
                    ->where(function($query) use($type)
                    {
                        if(!empty($type))
                        {
                                    $query->where('type',$type);
                        }
				    })
                
                
                //->toSql();
                /*->orderBy('id','desc')->orderBy('id','desc')->paginate(self::$paginationLimit);*/
                ->orderBy('id','desc')->orderBy('display_order','asc')->paginate(self::$paginationLimit);
                //dd($projects);
            }
        }
        else
        {
            //$projects = Project::where('status', '1')->orderBy('id','desc')->paginate(self::$paginationLimit);
            $projects = Project::where('status', '1')->orderBy('display_order','asc')->paginate(self::$paginationLimit);
            $pagequery = array();
        }
        $projectData['pagequery'] = $pagequery;
        $projectData['projects'] = $projects;
        //dd($projectData);
        
        $data['communitiesSeo'] =  CommunitiesSeo::where(['status'=>'A'])->first();                                 
        $communitiesSeo=$data['communitiesSeo'];
        $slug='communities';
        $projectData['slug_name'] = $slug;
        $metaDetail[$slug]['title_ar'] = $communitiesSeo->meta_title_ar; 
        $metaDetail[$slug]['meta_descriptions_ar'] = $communitiesSeo->meta_descriptions_ar;
        $metaDetail[$slug]['meta_keyword_ar'] = $communitiesSeo->meta_keyword_ar;
        $metaDetail[$slug]['alt_text_ar'] = $communitiesSeo->alt_text_ar;
        $metaDetail[$slug]['canonical_ar'] = $communitiesSeo->canonical_ar;

        $projectData['metaDetail'] = $metaDetail;
		
		return view('front/ar/project/projectList',$projectData);

	}

    //=================================================================
    /*****************************************************/
    # ProjectController
    # Function name : each
    # Author        :
    # Created Date  : ProjectController
    # Purpose       : Show the detail of the project
    # Params        : $slug
    /*****************************************************/

	public function eachAr($slug)
	{  
        $data = array();
        $data['switch_lang'] = 'EN';
        $data['switch_link'] = 'en/project-detail/'.$slug;
        $data['slug'] = $slug;

        $projectDetail = Project::where('slug_name', $slug)->first();

        $serviceData = ProjectService::where('status','1')->get();   
        $data['serviceData'] = $serviceData;
        
        $nearData = ProjectNearPlace::where('status','1')->get();   
        $data['nearData'] = $nearData;

        $galleryData = ProjectGallery::where('project_id',$projectDetail->id)->get();   
        $data['galleryData'] = $galleryData;

        /*$faqData = ProjectFaq::where('status','A')->get();*/ 
        $faqData = ProjectFaq::where('project_id',$projectDetail->id)->where('status','A')->get();   
        $data['faqData'] = $faqData;

        $unitData = ProjectUnit::where('project_id',$projectDetail->id)->get();   
        $data['unitData'] = $unitData;

        $unitGalleryData = ProjectUnitGallery::all();
        $data['unitGalleryData'] = $unitGalleryData;

        /*$data['projectDetailsPageHeading']  =  Social::where(['status'=>'A'])
        ->whereNull('deleted_at')
        ->first();*/
        $data['projectDetailsPageHeading']  =  PageTitle::whereNull('deleted_at')->first();

        //dd($faqData);

        $data['projectDetail'] = $projectDetail;
        $data['communityDetailsSlug']   = $slug;

        $data['slug_name'] = $slug;
        $metaDetail[$slug]['title_ar'] = $projectDetail->meta_title_ar;
        $metaDetail[$slug]['meta_descriptions_ar'] = $projectDetail->meta_descriptions_ar;
        $metaDetail[$slug]['meta_keyword_ar'] = $projectDetail->meta_keyword_ar;
        $metaDetail[$slug]['alt_text_ar'] = $projectDetail->alt_text_ar;
        $metaDetail[$slug]['canonical_ar'] = $projectDetail->canonical_ar;

        $data['metaDetail'] = $metaDetail;

        return view('front/ar/project/projectEach',$data);
    }



//=================================================================
    /*****************************************************/
    # ProjectController
    # Function name : saveContact
    # Author        :
    # Created Date  : ProjectController
    # Purpose       : Save contact form data.
    # Params        : Request $request
    /*****************************************************/
    
    public function saveContact(Request $request)
    {
        //dd($request); die;
        try {

            $message = [
                    'fullname.required' => 'fullname is required',
                    'phone.required'    => 'phone is required',
                    'emailid.required'  => 'email is required'
                ];

            $validator = Validator::make($request->all(), [
                    'fullname' => 'required',
                    'emailid' => 'required|email',
                    'phone' => 'required',
                 
                    ], $message);
                    
            if ($validator->fails()) { 
                
                        return redirect('en/project-detail/'.$_POST['slug'].'/#pcontact')
                                    ->withErrors($validator)
                                    ->withInput();
            } else {
                $contact = new \App\Models\Contact;
                $fullName=$request->salutation.$request->fullname; 
                $contact->name = $fullName;
                $contact->email = $request->emailid;
                $contact->number = $request->phone;
                $contact->project_name = $request->project_name;
                $contact->site_lang = 'English';

                $contact->save();


                $data = array(
                        'name' => $fullName,
                        'email' => $request->emailid,
                        'phone' => $request->phone,
                        'project_name' => $request->project_name,
                        'fromsite' => 'English'
                );

                $sendMail= Social::first();
                //dd($sendMail);
                //dd($data);
                
                Mail::send('front.en.email_templates.enquiry', $data, function($message) use($data,$sendMail,$contact){
                    $message->from('contact@alhakmiah.com', 'Project Enquiry');
                    //$message->to($sendMail->contact_us_email);
                    $message->to($sendMail->project_email);
                    $message->subject('Al Hakmiah - Project Enquiry For'.''.$contact->project_name);

                    });

                session()->flash('success', 'Message submited successfully. We will contact with you soon.');
                Session::flash('alert-class', 'alert-success'); 
                return redirect('en/project-detail/'.$_POST['slug'].'/#pcontact');



            }

        }
        catch (\Exception $e) {
            Log::error($e->getMessage());
            //session()->flash('message', $e->getMessage());
            
            session()->flash('error', $e->getMessage());
            Session::flash('alert-class', 'alert-danger');
            return redirect('en/project-detail/'.$_POST['slug'].'/#pcontact');
           
        }
    }


    


//=================================================================
    /*****************************************************/
    # ProjectController
    # Function name : saveContactAr
    # Author        :
    # Created Date  : ProjectController
    # Purpose       : Save contact form data.
    # Params        : Request $request
    /*****************************************************/
    
    public function saveContactAr(Request $request)
    {
        //dd($request); die;
        try {

            $message = [

                    'fullname.required' => 'الإسم الكامل ضروري',
                    'phone.required'    => 'الهاتف مطلوب',
                    'emailid.required'  => 'البريد الالكتروني مطلوب'
                ];

            $validator = Validator::make($request->all(), [
                    'fullname' => 'required',
                    'emailid' => 'required|email',
                    'phone' => 'required',
                 
                    ], $message);
                    
            if ($validator->fails()) { 
                
                        return redirect('project-detail/'.$_POST['slug'].'/#pcontact')
                                    ->withErrors($validator)
                                    ->withInput();
            } else {
                $contact = new \App\Models\Contact;

                $fullName=$request->salutation." ".$request->fullname;
                $contact->name = $fullName;
                $contact->email = $request->emailid;
                $contact->number = $request->phone;
                $contact->project_name = $request->project_name;
                $contact->site_lang = 'Arabic';

                $contact->save();

                $data = array(
                        'name' => $fullName,
                        'email' => $request->emailid,
                        'phone' => $request->phone,
                        'project_name' => $request->project_name,
                        'fromsite' => 'Arabic'
                );
                $sendMail= Social::first();

                //dd($data);
                
                Mail::send('front.en.email_templates.enquiry', $data, function($message) use($data,$sendMail,$contact){
                    $message->from('contact@alhakmiah.com', 'Project Enquiry');
                    //$message->to($sendMail->contact_us_email, 'Project Enquiry');
                    $message->to($sendMail->project_email, 'Project Enquiry');
                    $message->subject('Al Hakmiah - Project Enquiry For'.''.$contact->project_name);

                    });

                session()->flash('success', 'تم إرسال الرسالة بنجاح. سوف نتواصل معك قريبا');
                Session::flash('alert-class', 'alert-success'); 
                return redirect('project-detail/'.$_POST['slug'].'/#pcontact');



            }

        }
        catch (\Exception $e) {
            Log::error($e->getMessage());
            //session()->flash('message', $e->getMessage());
            
            session()->flash('error', $e->getMessage());
            Session::flash('alert-class', 'alert-danger');
            return redirect('project-detail/'.$_POST['slug'].'/#pcontact');
           
        }
    }

}