<?php

namespace App\Http\Controllers\admin;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Banner; 
use App\Models\PageBanner;
use App\Models\JobsBanner;
use App\Models\CmsImage; 
use App\Http\Requests\updateJobsBannerRequest;
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



class JobsBannerController extends Controller
{
    public $data= array();
   




    public function BannerEdit(Request $request) {
        $this->data['page_title']='Jobs Banner Edit';
        $this->data['panel_title']='Jobs Banner Edit';
        $encryptString= encrypt('1', Config::get('Constant.ENC_KEY'));; 
        $bannerId = decrypt($encryptString, Config::get('Constant.ENC_KEY')); // get user-id After Decrypt with salt key.
        $this->data['details'] = JobsBanner::findOrFail($bannerId);
        $this->data['encryptCode'] = $encryptString;
        //dd($this->data['details']);
        return view('admin.jobs_banner.edit',$this->data); 
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

    public function update(updateJobsBannerRequest $request){

        try
        {
        	if ($request->isMethod('POST'))
        	{
                $serviceId = !empty($request->encString) ? decrypt($request->encString, Config::get('Constant.ENC_KEY')) : 0;
                
                $bannerModelObj =  JobsBanner::findOrFail($serviceId);
       
                $bannerModelObj->status              = '1';
                $bannerModelObj->created_at          = Carbon::now();
                $bannerModelObj->updated_at          = Carbon::now();

                if($request->file('banner')) {

                    $files=$request->file('banner');
                    $fullFileName = time().'.'.$files->getClientOriginalExtension();
                    $destinationPath                  = 'assets/cms/banner_images';
                    $uploadResponse                   = $files->move($destinationPath,$fullFileName);

                    $bannerModelObj->banner=$fullFileName;
                } 
                $save = $bannerModelObj->save(); 

                
                if($save){
                    return redirect()->route('admin.jobs-banner.edit')->with('success','Banner has been updated successfully.');;
                
                } else {
                    return redirect()->back()->with('error', 'An error occurred while adding the Cms');
                }
				
			}
			
		} catch (Exception $e) {
			return redirect()->back()->with('error', $e->getMessage());
        } 
    }

   



 

}