<?php

namespace App\Http\Controllers\admin;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Service;
use App\Models\CmsImage;
use App\Http\Requests\ServiceRequest;
use App\Http\Requests\updateServiceRequest;
use Helper, AdminHelper, Image, Validator,  View;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\CmsExport;
use Auth;
use Redirect;
use Carbon\Carbon;
use Yajra\Datatables\Datatables;
use Config;
use Session;

class ServiceController extends Controller
{
    public $data= array();
    private static $paginationLimit= 10;

    /*****************************************************/
    # ServiceController
    # Function name : servioceList
    # Author        :
    # Created Date  : 20-07-2020
    # Purpose       : Homepagesetting Listing
    #                 
    #                 
    # Params        : 
    /*****************************************************/

    public function serviceList(Request $request){
        $this->data['page_title']="Service List";
        $this->data['panel_title']="Service List";
        Session::put('homeActiveUrl','');
        $searchKeyword = $_GET['q'] ?? '' ;
        $serviceObj= Service::select('*');  
            if(!empty($searchKeyword))
            $serviceObj->orWhere('title_en', 'like', '%' .trim($searchKeyword) . '%');
            $serviceObj->orWhere('title_ar', 'like', '%' .trim($searchKeyword) . '%');
            $serviceObj->whereNull('deleted_at')->orderBy('id','desc')->get();  
       $this->data['serviceList']=$serviceObj->paginate(self::$paginationLimit);
        
        return view('admin.service.list',$this->data);
    }
    /*****************************************************/
    # homeActiveService
    # Function name : homeActiveService
    # Author        :
    # Created Date  : 07-04-2021
    # Purpose       : homeActiveService Listing
    #                 
    #                 
    # Params        : 
    /*****************************************************/
    
    public function homeActiveService(Request $request){
        $this->data['page_title']="Service List";
        $this->data['panel_title']="Service List";

        Session::put('homeActiveUrl',$request->route()->getName());

        $searchKeyword = $_GET['q'] ?? '' ;
        $activeServiceObj= Service::select('*');  
            if(!empty($searchKeyword))
            $activeServiceObj->orWhere('title_en', 'like', '%' .trim($searchKeyword) . '%');
            $activeServiceObj->orWhere('title_ar', 'like', '%' .trim($searchKeyword) . '%');
            $activeServiceObj->whereNull('deleted_at');
            $activeServiceObj->where(['status'=>'A']); 
       $this->data['homeActiveService']=$activeServiceObj->orderBy('id','desc')->where('show_in_front','=','1')->whereNull('deleted_at')->get(); 

        
        return view('admin.service.service_active_list',$this->data);
    }


    public function serviceAdd (Request $request){
        $this->data['page_title']='Service Create ';
        $this->data['panel_title']='Service Create ';
    
        return view('admin.service.add',$this->data);
    }

    /*****************************************************/
    # FaqController
    # Function name : serviceSave
    # Author        :
    # Created Date  : 31-03-2021
    # Purpose       : Service Save
    #                 
    #                 
    # Params        : 
    /*****************************************************/

    public function serviceSave(ServiceRequest $request){
        
        try
        {
            if ($request->isMethod('POST'))
            {
               
                $serviceModelObj                = new Service ;
                $serviceModelObj->title_en                    = trim($request->title_en, ' ');
                $serviceModelObj->title_ar                    = trim($request->title_ar, ' ');
                $serviceModelObj->description_en              = $request->description_en;
                $serviceModelObj->description_ar              = $request->description_ar;
                $serviceModelObj->short_description_en        = $request->short_description_en;
                $serviceModelObj->short_description_ar        = $request->short_description_ar;
                $serviceModelObj->show_in_front      = !empty($request->show_in_front)? $request->show_in_front:'0';
               
                $serviceModelObj->created_at          = Carbon::now();
                $serviceModelObj->updated_at          = Carbon::now();
                if($request->file('image')) {

                    $files=$request->file('image');
                    $fullFileName = time().'.'.$files->getClientOriginalExtension();
                    $destinationPath                  = 'assets/images';
                    $uploadResponse                   = $files->move($destinationPath,$fullFileName);

                    $serviceModelObj->image=$fullFileName;
                }
                $save = $serviceModelObj->save();            

                if ($save) {
             
                    return redirect()->route('admin.service.service.list')->with('success','service has been added successfully.');;
                } else {
                    return redirect()->back()->with('error', 'An error occurred while adding the Cms');
                }
                
            }
            
        } catch (Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        } 
    }

   

    /*****************************************************/
    # ServiceController
    # Function name : service update
    # Author        :
    # Created Date  : 31-03-2021
    # Purpose       :  update
    #                 
    #                 
    # Params        : 
    /*****************************************************/

    public function update(updateServiceRequest $request) {
        try
        {
        	if ($request->isMethod('POST'))
        	{
                $serviceId = !empty($request->encString) ? decrypt($request->encString, Config::get('Constant.ENC_KEY')) : 0;
                
                $serviceModelObj =  Service::findOrFail($serviceId);

                
                if($request->file('image')) {

                    $files=$request->file('image');
                    $fullFileName = time().'.'.$files->getClientOriginalExtension();
                    $destinationPath                  = 'assets/images';
                    $uploadResponse                   = $files->move($destinationPath,$fullFileName);

                    $serviceModelObj->image=$fullFileName;
                } 
                
                $serviceModelObj->title_en            = trim($request->title_en, ' ');
                $serviceModelObj->title_ar            = trim($request->title_ar, ' ');
                $serviceModelObj->description_en      = $request->description_en;
                $serviceModelObj->description_ar      = $request->description_ar;
                $serviceModelObj->short_description_en      = $request->short_description_en;
                $serviceModelObj->short_description_ar        = $request->short_description_ar;
                $serviceModelObj->show_in_front       = !empty($request->show_in_front)? $request->show_in_front:'0';
                $serviceModelObj->status              = $request->status;
                $serviceModelObj->created_at          = Carbon::now();
                $serviceModelObj->updated_at          = Carbon::now();
                $save = $serviceModelObj->save();
                
                if ($save) {
                    if (Session::get('homeActiveUrl') != '') {
                        Session::put('homeActiveUrl','');
                        return redirect()->route('admin.service.home.list')->with('success','Service has been updated successfully.');
                    } else {
                        return redirect()->route('admin.service.service.list')->with('success','Service has been updated successfully.');
                    }
                } else {
                    return redirect()->back()->with('error', 'An error occurred while adding the Service');
                }
			}
		} catch (Exception $e) {
			return redirect()->back()->with('error', $e->getMessage());
        } 
    }

    /*****************************************************/
    # ServiceController
    # Function name : serviceEdit
    # Author        :
    # Created Date  : 20-07-2020
    # Purpose       : Service Edit
    #                 
    #                 
    # Params        : 
    /*****************************************************/


    public function serviceEdit(Request $request, $encryptString) {
        $this->data['page_title']='service Edit';
        $this->data['panel_title']='service Edit';
        $serviceId = decrypt($encryptString, Config::get('Constant.ENC_KEY')); // get user-id After Decrypt with salt key.
        $this->data['details'] = Service::findOrFail($serviceId);
        $this->data['encryptCode'] = $encryptString;
        //dd($this->data['details']);
        return view('admin.service.edit',$this->data); 
    }

    /*****************************************************/
    # serviceController
    # Function name : serviceDelete
    # Author        :
    # Created Date  : 31-03-2021
    # Purpose       : Service Delete
    #                 
    #                 
    # Params        : 
    /*****************************************************/
    
    public function serviceDelete(Request $request,$encryptString)
    {

        $serviceId = decrypt($encryptString, Config::get('Constant.ENC_KEY')); // get user-id After Decrypt with salt key.
        $details = Service::findOrFail($serviceId);


        if ($details) {
            $details->deleted_at=Carbon::now();
            $details->save();
            return redirect()->route('admin.service.service.list')->with('success','Service has been deleted successfully!');
        } else {
            $request->session()->flash('alert-danger', 'An error occurred while deleting the Cms list');
             return redirect()->back();
        }
    }
    
     /*****************************************************/
    # ServiceController
    # Function name : resetServicetatus
    # Author        :
    # Created Date  : 01-04-2021
    # Purpose       : Reset Service Status
    #                 
    #                 
    # Params        : 
    /*****************************************************/

    public function resetServicetatus(Request $request){
    
        $response['has_error']=1;
        $response['msg']="Something went wrong.Please try again later.";

        $homeId = decrypt($request->encryptCode, Config::get('Constant.ENC_KEY')); // get user-id After Decrypt with salt key.

        $homeObj = Service::findOrFail($homeId);
        $updateStatus = $homeObj->status == 'A' ? 'I' : 'A'; 
        $homeObj->status=$updateStatus;
        $homeObj->updated_at=Carbon::now();
        
        $saveResponse=$homeObj->save();       
        if($saveResponse){
            $response['has_error']=0;
            $response['msg']="Successfully changed status.";
        }
        return $response;
    }

 

}