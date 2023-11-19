<?php

namespace App\Http\Controllers\admin;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Banner;
use App\Models\CmsImage;
use App\Http\Requests\BannerRequest;
use App\Http\Requests\updateBannerRequest;
use Helper, AdminHelper, Image, Validator,  View;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\CmsExport;
use Auth;
use Redirect;
use Carbon\Carbon;
use Yajra\Datatables\Datatables;
use Config;



class BannerController extends Controller
{
    public $data= array();
    private static $paginationLimit= 10;


    /*****************************************************/
    # BannerController
    # Function name : bannerList
    # Author        :
    # Created Date  : 09-04-2021
    # Purpose       : bannerList Listing
    #                 
    #                 
    # Params        : 
    /*****************************************************/

    public function bannerList(Request $request){
        
        $this->data['page_title']="Banner List";
        $this->data['panel_title']="Banner List";
        $searchKeyword = $_GET['q'] ?? '' ;
        $newsObj= Banner::select('*');  
            if(!empty($searchKeyword))
            $newsObj->orWhere('title_en', 'like', '%' .trim($searchKeyword) . '%');
            $newsObj->orWhere('title_ar', 'like', '%' .trim($searchKeyword) . '%');
            $newsObj->whereNull('deleted_at')->orderBy('id','desc')->get();  
       $this->data['bannerList']=$newsObj->paginate(self::$paginationLimit);
        
        return view('admin.banner.list',$this->data);
    }


    public function bannerAdd (Request $request){
        $this->data['page_title']= 'Banner Create ';
        $this->data['panel_title']='Banner Create ';
    
        return view('admin.banner.add',$this->data);
    }

    /*****************************************************/
    # FaqController
    # Function name : newsSave
    # Author        :
    # Created Date  : 31-03-2021
    # Purpose       : Banner Save
    #                 
    #                 
    # Params        : 
    /*****************************************************/

    public function BannerSave(BannerRequest $request){
        
        try
        {
            if ($request->isMethod('POST'))
            {
               
                $bannerModelObj                      = new Banner ;
                $bannerModelObj->title_en            = trim($request->title_en, ' ');
                $bannerModelObj->title_ar            = trim($request->title_ar, ' ');
                $bannerModelObj->type                = $request->type;
                if($request->file('banner')) {

                    $files=$request->file('banner');
                    $fullFileName = time().'.'.$files->getClientOriginalExtension();
                    $destinationPath                  = 'assets/cms/banner_images';
                    $uploadResponse                   = $files->move($destinationPath,$fullFileName);

                    $bannerModelObj->banner=$fullFileName;
                }
                if($request->file('banner_video')) {

                    $files=$request->file('banner_video');
                    $fullFileName = time().'.'.$files->getClientOriginalExtension();
                    $destinationPath                  = 'assets/banner_video';
                    $uploadResponse                   = $files->move($destinationPath,$fullFileName);

                    $bannerModelObj->banner_video=$fullFileName;
                } 
             
                $bannerModelObj->created_at          = Carbon::now();
                $bannerModelObj->updated_at          = Carbon::now();
                $bannerModelObj->status              = $request->status;
                $save = $bannerModelObj->save();            

                if ($save) {
             
                    return redirect()->route('admin.banner.list')->with('success','Banner has been added successfully.');;
                } else {
                    return redirect()->back()->with('error', 'An error occurred while adding the Cms');
                }
                
            }
            
        } catch (Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        } 
    }

     /*****************************************************/
    # NewsController
    # Function name : NewsEdit
    # Author        :
    # Created Date  : 20-07-2020
    # Purpose       : Service Edit
    #                 
    #                 
    # Params        : 
    /*****************************************************/


    public function BannerEdit(Request $request, $encryptString) {
        $this->data['page_title']='Banner Edit';
        $this->data['panel_title']='Banner Edit';
        $bannerId = decrypt($encryptString, Config::get('Constant.ENC_KEY')); // get user-id After Decrypt with salt key.
        $this->data['details'] = Banner::findOrFail($bannerId);
        $this->data['encryptCode'] = $encryptString;
        //dd($this->data['details']);
        return view('admin.banner.edit',$this->data); 
    }

   

    /*****************************************************/
    # NewsController
    # Function name : banner update
    # Author        :
    # Created Date  : 31-03-2021
    # Purpose       :  update
    #                 
    #                 
    # Params        : 
    /*****************************************************/

    public function update(updateBannerRequest $request){

        try
        {
        	if ($request->isMethod('POST'))
        	{
                $serviceId = !empty($request->encString) ? decrypt($request->encString, Config::get('Constant.ENC_KEY')) : 0;
                
                $bannerModelObj =  Banner::findOrFail($serviceId);


                $bannerModelObj->title_en            = trim($request->title_en, ' ');
                $bannerModelObj->title_ar            = trim($request->title_ar, ' ');
                $bannerModelObj->type                = $request->type;
                $bannerModelObj->status              = $request->status;
                $bannerModelObj->created_at          = Carbon::now();
                $bannerModelObj->updated_at          = Carbon::now();

                if($request->file('banner')) {

                    $files=$request->file('banner');
                    $fullFileName = time().'.'.$files->getClientOriginalExtension();
                    $destinationPath                  = 'assets/cms/banner_images';
                    $uploadResponse                   = $files->move($destinationPath,$fullFileName);

                    $bannerModelObj->banner=$fullFileName;
                } 

                if($request->file('banner_video')) {

                    $files=$request->file('banner_video');
                    $fullFileName = time().'.'.$files->getClientOriginalExtension();
                    $destinationPath                  = 'assets/banner_video';
                    $uploadResponse                   = $files->move($destinationPath,$fullFileName);

                    $bannerModelObj->banner_video=$fullFileName;
                } 
                $save = $bannerModelObj->save(); 

                
                if($save){
                    return redirect()->route('admin.banner.list')->with('success','Banner has been updated successfully.');;
                
                } else {
                    return redirect()->back()->with('error', 'An error occurred while adding the Cms');
                }
				
			}
			
		} catch (Exception $e) {
			return redirect()->back()->with('error', $e->getMessage());
        } 
    }

   

    /*****************************************************/
    # NewsController
    # Function name : newsDelete
    # Author        :
    # Created Date  : 31-03-2021
    # Purpose       : Banner Delete
    #                 
    #                 
    # Params        : 
    /*****************************************************/
    
    public function BannerDelete(Request $request,$encryptString)
    {

        $bannerId = decrypt($encryptString, Config::get('Constant.ENC_KEY')); // get user-id After Decrypt with salt key.
        $details = Banner::findOrFail($bannerId);


        if ($details) {
            $details->deleted_at=Carbon::now();
            $details->save();
            return redirect()->route('admin.banner.list')->with('success','Banner has been deleted successfully!');
        } else {
            $request->session()->flash('alert-danger', 'An error occurred while deleting the Cms list');
             return redirect()->back();
        }
    }

    /*****************************************************/
    # newsController
    # Function name : resetNewsStatus
    # Author        :
    # Created Date  : 01-04-2021
    # Purpose       : Reset Banner Status
    #                 
    #                 
    # Params        : 
    /*****************************************************/

    public function resetBannerStatus(Request $request){
    
        $response['has_error']=1;
        $response['msg']="Something went wrong.Please try again later.";

        $homeId = decrypt($request->encryptCode, Config::get('Constant.ENC_KEY')); // get user-id After Decrypt with salt key.

        $homeObj = Banner::findOrFail($homeId);
        $updateStatus = $homeObj->status == '1' ? '0' : '1'; 
        $homeObj->status=$updateStatus;
        $saveResponse=$homeObj->save();       
        if($saveResponse){
            $response['has_error']=0;
            $response['msg']="Succressfuuly changed status.";
        }
        return $response;
    }

 

}