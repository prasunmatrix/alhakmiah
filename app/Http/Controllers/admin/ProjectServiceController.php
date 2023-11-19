<?php
/*****************************************************/
# ProjectController
# Page/Class name   : ProjectServiceController
# Author            :
# Created Date      : 31-03-2020
# Functionality     : index, add, edit. delete 
# Purpose           : Project service management
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
use Helper, AdminHelper, Image, Auth, Hash, Redirect, Validator, View, Input;
use Illuminate\Support\Facades\File as FileSystem;

use App\Models\Timezone;
use Config;
use Carbon\Carbon;

use App\Models\User;
use App\Models\ProjectService;

use Session;
use DB;
use File;
use Illuminate\Support\Facades\Log;
use Exception;

class ProjectServiceController extends Controller
{
    private static $paginationLimit= 10;
    //=================================================================
    /*****************************************************/
    # ProjectServiceController
    # Function name : index
    # Author        :
    # Created Date  : ProjectServiceController
    # Purpose       : Show the list of the project services
    # Params        : 
    /*****************************************************/

    public function index()
    {  
        $projectServiceData = array();
        
        $projectServiceData['page_title']="Project Service Management";
        $projectServiceData['panel_title']="Project Service Management";

        $projectServices = ProjectService::paginate(self::$paginationLimit);    
        $projectServiceData['projectServices'] = $projectServices;
        
        
        return view('admin/project_service/index',$projectServiceData);

    }

    //=================================================================
    /*****************************************************/
    # ProjectServiceController
    # Function name : add
    # Author        :
    # Created Date  : ProjectServiceController
    # Purpose       : Show project service add form
    # Params        : Request $request
    /*****************************************************/

    public function add(Request $request)
    {  
        $projectServiceData = array();

        $projectServiceData['page_title']='Project Service Create ';
        $projectServiceData['panel_title']='Project Service Create ';

        return view('admin/project_service/add',$projectServiceData);
    }

    //=================================================================
    /*****************************************************/
    # ProjectServiceController
    # Function name : save
    # Author        :
    # Created Date  : ProjectServiceController
    # Purpose       : Save project service form data.
    # Params        : Request $request
    /*****************************************************/
    
    public function save(Request $request)
    {
        //dd($request);
        try {

       


            $validator = Validator::make($request->all(), [
                        'service_name' => 'required',
                        'service_name_ar' => 'required',
                        'service_image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2000',
                        'status' => 'required'
                    ],[
                         'service_name.required'=>'please enter service name in english',
                         'service_name_ar.required'=>'please enter service name in arabic',
                         

            ]);
                    
            if ($validator->fails()) { 
                
                        return redirect('admin/projectservices/add')
                                    ->withErrors($validator)
                                    ->withInput();
            } else {

                 /* SERVICE IMAGE */
                $service_image = $request->file('service_image');
                if(!empty($service_image)) {
                $service_imagename = pathinfo($service_image->getClientOriginalName(), PATHINFO_FILENAME).'_'.time().'.'.$service_image->getClientOriginalExtension();
                    
                    $service_image_destinationPath = public_path('/admin/upload/project_services/thumbnail');
                    
                    $service_img = Image::make($service_image->getRealPath());

                    $service_img->resize(100, 100, function ($constraint) {
                        $constraint->aspectRatio();
                    })->save($service_image_destinationPath.'/'.$service_imagename);

                    $service_image_destinationPath_original = public_path('/admin/upload/project_services/original');
                    $service_image->move($service_image_destinationPath_original, $service_imagename);
                } else {

                    $service_imagename = '';
                }
                /* SERVICE IMAGE END */

                

                $projectser = new \App\Models\ProjectService;

                $projectser->service_name = $request->service_name;
                $projectser->service_name_ar = $request->service_name_ar;
                $projectser->service_image = $service_imagename;
                $projectser->status = $request->status;

                $projectser->save();

                session()->flash('success', 'Service added successfully');
                Session::flash('alert-class', 'alert-success'); 
                return redirect('admin/projectservices/index');



            }

        }
        catch (\Exception $e) {
            Log::error($e->getMessage());
            //session()->flash('message', $e->getMessage());
            
            session()->flash('error', $e->getMessage());
            Session::flash('alert-class', 'alert-danger');
            return redirect('admin/projectservices/add');
           
        }
    }


    //===================================================================
    /*****************************************************/
    # ProjectServiceController
    # Function name : delete
    # Author        :
    # Created Date  : ProjectServiceController
    # Purpose       : Delete project service data
    # Params        : $id
    /*****************************************************/

    public function delete($id)
    {
        try {
        $decId = decrypt($id, Config::get('Constant.ENC_KEY'));
        ProjectService::where('id', $decId)->delete();
        session()->flash('success', 'Project service record deleted successfully');
        Session::flash('alert-class', 'alert-success'); 
        return redirect('admin/projectservices/index');
        
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            session()->flash('error', 'Some error occured during delete record');
            Session::flash('alert-class', 'alert-danger');
            return redirect('admin/projectservices/index');
        }
        
    }
    //===========================================================================
    /*****************************************************/
    # ProjectServiceController
    # Function name : edit
    # Author        :
    # Created Date  : ProjectServiceController
    # Purpose       : Load edit project service page template
    # Params        : Request $request
    /*****************************************************/
    public function edit($id)
    {
        $serviceData['page_title']='Project Service Edit ';
        $serviceData['panel_title']='Project Service Edit ';

        $edid = decrypt($id, Config::get('Constant.ENC_KEY'));
        $serviceDetail = ProjectService::where('id',$edid)->first();
        $serviceData['serviceDetail'] = $serviceDetail;

        return view('admin/project_service/edit',$serviceData);
    }

    //====================================================================
    /*****************************************************/
    # ProjectServiceController
    # Function name : update
    # Author        :
    # Created Date  : ProjectServiceController
    # Purpose       : Update project service data
    # Params        : Request $request
    /*****************************************************/
    public function update(Request $request) {
        $serviceId = $request->project_service_id;

        $sid = encrypt($serviceId, Config::get('Constant.ENC_KEY'));
        

        try {
            $validator = Validator::make($request->all(), [
                        'service_name' => 'required',
                        'service_name_ar' => 'required',
                        'service_image' => 'image|mimes:jpeg,png,jpg,gif|max:2000'
                    ]);
                    
            if ($validator->fails()) { 
                
                        return redirect('admin/projectservices/edit/'.$sid)
                                    ->withErrors($validator)
                                    ->withInput();
            } else {

                /* SERVICE IMAGE */
                $service_image = $request->file('service_image');
                if(!empty($service_image)) {
                $service_imagename = pathinfo($service_image->getClientOriginalName(), PATHINFO_FILENAME).'_'.time().'.'.$service_image->getClientOriginalExtension();
                    
                    $service_image_destinationPath = public_path('/admin/upload/project_services/thumbnail');
                    
                    $service_img = Image::make($service_image->getRealPath());

                    $service_img->resize(100, 100, function ($constraint) {
                        $constraint->aspectRatio();
                    })->save($service_image_destinationPath.'/'.$service_imagename);

                    $service_image_destinationPath_original = public_path('/admin/upload/project_services/original');
                    $service_image->move($service_image_destinationPath_original, $service_imagename);
                } else {

                    $service_imagename = $request->old_service_image;
                }
                /* SERVICE IMAGE END */

                $serviceData = ProjectService::find($serviceId);
                $serviceData->service_name = $request->service_name;
                $serviceData->service_name_ar = $request->service_name_ar;
                $serviceData->service_image = $service_imagename;
                $serviceData->save();

                session()->flash('success', 'Service edited successfully');
                Session::flash('alert-class', 'alert-success'); 
                return redirect('admin/projectservices/index');

            }

        }
        catch (\Exception $e) {
                    Log::error($e->getMessage());
                    session()->flash('error', $e->getMessage());
                    Session::flash('alert-class', 'alert-danger');
                   return redirect('admin/projectservices/edit/'.$sid);
                }
    }
//=================================================================
    /*****************************************************/
    # ProjectServiceController
    # Function name : set_status
    # Author        :
    # Created Date  : ProjectServiceController
    # Purpose       : Change project service status
    # Params        : $id
    /****************************************************/
   

     public function set_status(Request $request){
    
        $response['has_error']=1;
        $response['msg']="Something went wrong.Please try again later.";

        $serviceId = decrypt($request->encryptCode, Config::get('Constant.ENC_KEY')); // get user-id After Decrypt with salt key.

        $serviceObj = ProjectService::findOrFail($serviceId);
        $updateStatus = $serviceObj->status == '1' ? '0' : '1'; 
        $serviceObj->status=$updateStatus;
        $saveResponse=$serviceObj->save();       
        if($saveResponse){
            $response['has_error']=0;
            $response['msg']="Successfully changed status.";
        }
        return $response;
    }
}