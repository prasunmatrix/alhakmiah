<?php

namespace App\Http\Controllers\admin;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\HomePageSetting;
use App\Models\Social;
use App\Models\CmsImage;
use App\Http\Requests\HomeSettingRequest;
use Helper, AdminHelper, Image, Validator,  View;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\CmsExport;
//use Illuminate\Support\Facades\Auth;
use Auth;
use Redirect;
use Carbon\Carbon;
use Yajra\Datatables\Datatables;
use Config;



class HomePageSettingController extends Controller
{
    public $data= array();
    private static $paginationLimit= 10;


    /*****************************************************/
    # HomePageSettingController
    # Function name : homepageList
    # Author        :
    # Created Date  : 20-07-2020
    # Purpose       : Homepagesetting Listing
    #                 
    #                 
    # Params        : 
    /*****************************************************/

    public function homePageList(Request $request){
        $this->data['page_title']="Home Page Setting List";
        $this->data['panel_title']="Home Page Setting List";
        $searchKeyword = $_GET['q'] ?? '' ;
        $homeObj= Homepagesetting::select('*');  
            if(!empty($searchKeyword))
            $homeObj->orWhere('title_en', 'like', '%' .trim($searchKeyword) . '%');
            $homeObj->orWhere('title_ar', 'like', '%' .trim($searchKeyword) . '%');
            $homeObj->orderBy('id','desc')->get();  
       $this->data['homePageList']=$homeObj->paginate(self::$paginationLimit);
        
        return view('admin.homepagesetting.homepage-list',$this->data);
    }

   

    /*****************************************************/
    # HomePageSettingController
    # Function name : home page setting update
    # Author        :
    # Created Date  : 31-03-2021
    # Purpose       : Homepagesetting update
    #                 
    #                 
    # Params        : 
    /*****************************************************/

    public function update(HomeSettingRequest $request){
   
        
        try
        {
        	if ($request->isMethod('POST'))
        	{
                $homePageId = !empty($request->encString) ? decrypt($request->encString, Config::get('Constant.ENC_KEY')) : 0;
                
                $homeModelObj =  Homepagesetting::findOrFail($homePageId);
                $homeModelObj->title_en                        = trim($request->title_en, ' ');
                $homeModelObj->title_ar                        = trim($request->title_ar, ' ');
                $homeModelObj->description_en                  = $request->description_en;
                $homeModelObj->description_ar                  = $request->description_ar;
                $homeModelObj->feature_project_heading_en      = $request->feature_project_heading_en;
                $homeModelObj->feature_project_heading_ar      = $request->feature_project_heading_ar;
                $homeModelObj->feature_project_button_text_en  = $request->feature_project_button_text_en;
                $homeModelObj->feature_project_button_text_ar  = $request->feature_project_button_text_ar;
                //$homeModelObj->status              = $request->status;
                $homeModelObj->status              = 'A';
                $homeModelObj->created_at          = Carbon::now();
                $homeModelObj->updated_at          = Carbon::now();
                $save = $homeModelObj->save();            

                if($save){
                    return redirect()->route('admin.home-page-setting.edit')->with('success','Home page setting has been updated successfully.');;
                
                } else {
                    return redirect()->back()->with('error', 'An error occurred while adding the Cms');
                }
				
			}
			
		} catch (Exception $e) {
			return redirect()->back()->with('error', $e->getMessage());
        } 
    }

    /*****************************************************/
    # HomePageSettingController
    # Function name : cmsEdit
    # Author        :
    # Created Date  : 20-07-2020
    # Purpose       : Cms Edit
    #                 
    #                 
    # Params        : 
    /*****************************************************/


    public function homePageEdit(Request $request) {
        $this->data['page_title']='Home Page Setting Edit';
        $this->data['panel_title']='Home Page Setting Edit';
        $encryptString= encrypt('2', Config::get('Constant.ENC_KEY'));; 
        $homePageId = decrypt($encryptString, Config::get('Constant.ENC_KEY')); // get user-id After Decrypt with salt key.
        $this->data['details'] = Homepagesetting::findOrFail($homePageId);
        $this->data['encryptCode'] = $encryptString;
        //dd($this->data['details']);
        return view('admin.homepagesetting.homepage-edit',$this->data); 
    }

    /*****************************************************/
    # HomePageSettingController
    # Function name : resetcmsStatus
    # Author        :
    # Created Date  : 20-07-2020
    # Purpose       : Reset Homepagesetting Status
    #                 
    #                 
    # Params        : 
    /*****************************************************/

    public function resethomeStatus(Request $request){
    
        $response['has_error']=1;
        $response['msg']="Something went wrong.Please try again later.";

        $cmsId = decrypt($request->encryptCode, Config::get('Constant.ENC_KEY')); // get user-id After Decrypt with salt key.

        $homeObj = Homepagesetting::findOrFail($cmsId);
        $updateStatus = $homeObj->status == 'A' ? 'I' : 'A'; 
        $homeObj->status=$updateStatus;
        $homeObj->updated_at=Carbon::now();
        $homeObj->updated_by=Auth::guard('admin')->user()->id;
        $saveResponse=$homeObj->save();       
        if($saveResponse){
            $response['has_error']=0;
            $response['msg']="Succressfuuly changed status.";
        }
        return $response;
    }


  
                         
        
  
    public function cmsExport(){
        // $currentTimeStamp = time().'directjobpost_list';
        // $response=[];
        ob_end_clean();
        ob_start();
    return Excel::download(new CmsExport, 'cms_list-'.time().'.xlsx');
    }


    /************SocialController*****************************************/
    # SocialController
    # Function name : socialEdit
    # Author        :
    # Created Date  : 05-04-2021
    # Purpose       : Social Edit
    #                 
    #                 
    # Params        : 
    /*****************************************************/


    public function headingEdit(Request $request) {
        $this->data['page_title']='Home Page Heading Edit';
        $this->data['panel_title']='Home Page Heading Edit';
        $encryptString= encrypt('1', Config::get('Constant.ENC_KEY'));; 
        $socialId = decrypt($encryptString, Config::get('Constant.ENC_KEY')); // get user-id After Decrypt with salt key.
        $this->data['details'] = Social::findOrFail($socialId);
        $this->data['encryptCode'] = $encryptString;
        //dd($this->data['details']);
        return view('admin.homepagesetting.homepageheading-edit',$this->data); 
    }

    /*****************************************************/
    # SocialController
    # Function name : service update
    # Author        :
    # Created Date  : 31-03-2021
    # Purpose       :  update
    #                 
    #                 
    # Params        : 
    /*****************************************************/

    public function updateHeading(Request $request){
        //exit('okay');
        try
        {
        	if ($request->isMethod('POST'))
        	{
                $socialId = !empty($request->encString) ? decrypt($request->encString, Config::get('Constant.ENC_KEY')) : 0;
                
                $socialModelObj =  Social::findOrFail($socialId);
                
                $socialModelObj->achievement_title_en            = trim($request->achievement_title_en, '');
                $socialModelObj->achievement_title_ar            = trim($request->achievement_title_ar, '');

                $socialModelObj->latest_news_title_en            = trim($request->latest_news_title_en, '');
                $socialModelObj->latest_news_title_ar            = trim($request->latest_news_title_ar, '');

                $socialModelObj->service_title_en            = trim($request->service_title_en, '');
                $socialModelObj->service_title_ar            = trim($request->service_title_ar, '');

                if($request->file('header_logo')) {
                    $files=$request->file('header_logo');
                    $fullFileName = time().'.'.$files->getClientOriginalExtension();
                    $destinationPath               = 'assets/images';
                    $uploadResponse                = $files->move($destinationPath,$fullFileName);
                    $socialModelObj->header_logo=$fullFileName;
                }
                if($request->file('footer_logo')) {
                    $files=$request->file('footer_logo');
                    $fullFileName = time().'.'.$files->getClientOriginalExtension();
                    $destinationPath               = 'assets/images';
                    $uploadResponse                = $files->move($destinationPath,$fullFileName);
                    $socialModelObj->footer_logo=$fullFileName;
                }
                if($request->file('banner_image')) {
                    $files=$request->file('banner_image');
                    $fullFileName = time().'.'.$files->getClientOriginalExtension();
                    $destinationPath               = 'assets/images';
                    $uploadResponse                = $files->move($destinationPath,$fullFileName);
                    $socialModelObj->banner_image=$fullFileName;
                }

                $socialModelObj->status          = $request->status;
                $socialModelObj->created_at      = Carbon::now();
                $socialModelObj->updated_at      = Carbon::now();
                $save = $socialModelObj->save(); 

                if($save){
                    return redirect()->route('admin.home-page-setting.edithomeheading')->with('success','Home page heading has been updated successfully.');;
                
                } else {
                    return redirect()->back()->with('error', 'An error occurred while adding the Cms');
                }
				
			}
			
		} catch (Exception $e) {
			return redirect()->back()->with('error', $e->getMessage());
        } 
    }
    

}