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
use App\Models\ProjectNearPlace;

use Session;
use DB;
use File;
use Illuminate\Support\Facades\Log;
use Exception;

class ProjectNearController extends Controller
{
    private static $paginationLimit= 10;
    //=================================================================
    /*****************************************************/
    # ProjectNearController
    # Function name : index
    # Author        :
    # Created Date  : ProjectNearController
    # Purpose       : Show the list of the project near place
    # Params        : 
    /*****************************************************/

	public function index()
	{  
        $projectNearData = array();
		
        $projectNearData['page_title']="Project Near Place Management";
        $projectNearData['panel_title']="Project Near Place Management";

        $projectNears = ProjectNearPlace::paginate(self::$paginationLimit);	
        $projectNearData['projectNears'] = $projectNears;
        
		
		return view('admin/project_near/index',$projectNearData);

	}

    //=================================================================
    /*****************************************************/
    # ProjectNearController
    # Function name : add
    # Author        :
    # Created Date  : ProjectNearController
    # Purpose       : Show project near add form
    # Params        : Request $request
    /*****************************************************/

    public function add(Request $request)
    {  
        $projectNearData = array();

        $projectNearData['page_title']='Project Near Place Create ';
        $projectNearData['panel_title']='Project Near Place Create ';

        return view('admin/project_near/add',$projectNearData);
    }

    //=================================================================
    /*****************************************************/
    # ProjectNearController
    # Function name : save
    # Author        :
    # Created Date  : ProjectNearController
    # Purpose       : Save project near form data.
    # Params        : Request $request
    /*****************************************************/
    
    public function save(Request $request)
    {
        //dd($request);
        try {

            $validator = Validator::make($request->all(), [
                        'near_name' => 'required',
                        'near_name_ar' => 'required',
                        'near_image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2000',
                        'status' => 'required'
                    ]);
                    
            if ($validator->fails()) { 
                
                        return redirect('admin/projectnear/add')
                                    ->withErrors($validator)
                                    ->withInput();
            } else {

                 /* NEAR IMAGE */
                $near_image = $request->file('near_image');
                if(!empty($near_image)) {
                $near_imagename = pathinfo($near_image->getClientOriginalName(), PATHINFO_FILENAME).'_'.time().'.'.$near_image->getClientOriginalExtension();
                    
                    $near_image_destinationPath = public_path('/admin/upload/project_near/thumbnail');
                    
                    $near_img = Image::make($near_image->getRealPath());

                    $near_img->resize(100, 100, function ($constraint) {
                        $constraint->aspectRatio();
                    })->save($near_image_destinationPath.'/'.$near_imagename);

                    $near_image_destinationPath_original = public_path('/admin/upload/project_near/original');
                    $near_image->move($near_image_destinationPath_original, $near_imagename);
                } else {

                    $near_imagename = '';
                }
                /* NEAR IMAGE END */

                

                $projectnear = new \App\Models\ProjectNearPlace;

                $projectnear->near_name = $request->near_name;
                $projectnear->near_name_ar = $request->near_name_ar;
                $projectnear->near_image = $near_imagename;
                $projectnear->status = $request->status;

                $projectnear->save();

                session()->flash('success', 'Record added successfully');
                Session::flash('alert-class', 'alert-success'); 
                return redirect('admin/projectnear/index');



            }

        }
        catch (\Exception $e) {
            Log::error($e->getMessage());
            //session()->flash('message', $e->getMessage());
            
            session()->flash('error', $e->getMessage());
            Session::flash('alert-class', 'alert-danger');
            return redirect('admin/projectnear/add');
           
        }
    }


    //===================================================================
    /*****************************************************/
    # ProjectNearController
    # Function name : delete
    # Author        :
    # Created Date  : ProjectNearController
    # Purpose       : Delete project near place data
    # Params        : $id
    /*****************************************************/

    public function delete($id)
    {
        try {
        $decId = decrypt($id, Config::get('Constant.ENC_KEY'));
        ProjectNearPlace::where('id', $decId)->delete();
        session()->flash('success', 'Record deleted successfully');
        Session::flash('alert-class', 'alert-success'); 
        return redirect('admin/projectnear/index');
        
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            session()->flash('error', 'Some error occured during delete record');
            Session::flash('alert-class', 'alert-danger');
            return redirect('admin/projectnear/index');
        }
        
    }
    //===========================================================================
    /*****************************************************/
    # ProjectNearController
    # Function name : edit
    # Author        :
    # Created Date  : ProjectNearController
    # Purpose       : Load edit project near place page template
    # Params        : Request $request
    /*****************************************************/
    public function edit($id)
    {
        $nearData['page_title']='Project Near Place Edit ';
        $nearData['panel_title']='Project Near Place Edit ';

        $edid = decrypt($id, Config::get('Constant.ENC_KEY'));
        $nearDetail = ProjectNearPlace::where('id',$edid)->first();
        $nearData['nearDetail'] = $nearDetail;

        return view('admin/project_near/edit',$nearData);
    }

    //====================================================================
    /*****************************************************/
    # ProjectNearController
    # Function name : update
    # Author        :
    # Created Date  : ProjectNearController
    # Purpose       : Update project near place data
    # Params        : Request $request
    /*****************************************************/
    public function update(Request $request) {
        $nearId = $request->project_near_id;

        $nid = encrypt($nearId, Config::get('Constant.ENC_KEY'));
        

        try {
            $validator = Validator::make($request->all(), [
                        'near_name' => 'required',
                        'near_name_ar' => 'required',
                        'near_image' => 'image|mimes:jpeg,png,jpg,gif|max:2000'
                    ]);
                    
            if ($validator->fails()) { 
                
                        return redirect('admin/projectnear/edit/'.$nid)
                                    ->withErrors($validator)
                                    ->withInput();
            } else {

                /* NEAR IMAGE */
                $near_image = $request->file('near_image');
                if(!empty($near_image)) {
                $near_imagename = pathinfo($near_image->getClientOriginalName(), PATHINFO_FILENAME).'_'.time().'.'.$near_image->getClientOriginalExtension();
                    
                    $near_image_destinationPath = public_path('/admin/upload/project_near/thumbnail');
                    
                    $near_img = Image::make($near_image->getRealPath());

                    $near_img->resize(100, 100, function ($constraint) {
                        $constraint->aspectRatio();
                    })->save($near_image_destinationPath.'/'.$near_imagename);

                    $near_image_destinationPath_original = public_path('/admin/upload/project_near/original');
                    $near_image->move($near_image_destinationPath_original, $near_imagename);
                } else {

                    $near_imagename = $request->old_near_image;
                }
                /* NEAR IMAGE END */

                $nearData = ProjectNearPlace::find($nearId);
                $nearData->near_name = $request->near_name;
                $nearData->near_name_ar = $request->near_name_ar;
                $nearData->near_image = $near_imagename;
                $nearData->save();

                session()->flash('success', 'Near place edited successfully');
                Session::flash('alert-class', 'alert-success'); 
                return redirect('admin/projectnear/index');

            }

        }
        catch (\Exception $e) {
                    Log::error($e->getMessage());
                    session()->flash('error', $e->getMessage());
                    Session::flash('alert-class', 'alert-danger');
                   return redirect('admin/projectnear/edit/'.$nid);
                }
    }
//=================================================================
    /*****************************************************/
    # ProjectNearController
    # Function name : set_status
    # Author        :
    # Created Date  : ProjectNearController
    # Purpose       : Change project near place status
    # Params        : $id
    /****************************************************/
    

    public function set_status(Request $request){
    
        $response['has_error']=1;
        $response['msg']="Something went wrong.Please try again later.";

        $edid = decrypt($request->encryptCode, Config::get('Constant.ENC_KEY')); // get user-id After Decrypt with salt key.

        $near = ProjectNearPlace::findOrFail($edid);
        $updateStatus = $near->status == '1' ? '0' : '1'; 
        $near->status=$updateStatus;
        $saveResponse=$near->save();       
        if($saveResponse){
            $response['has_error']=0;
            $response['msg']="Successfully changed status.";
        }
        return $response;
    }
}