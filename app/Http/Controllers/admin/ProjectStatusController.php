<?php
/*****************************************************/
# ProjectStatusController
# Page/Class name   : ProjectStatusController
# Author            :
# Created Date      : 02-04-2020
# Functionality     : index, add, edit. delete 
# Purpose           : Project status management
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
use App\Models\ProjectStatus;

use Session;
use DB;
use File;
use Illuminate\Support\Facades\Log;
use Exception;

class ProjectStatusController extends Controller
{
    private static $paginationLimit= 10;
    //=================================================================
    /*****************************************************/
    # ProjectStatusController
    # Function name : index
    # Author        :
    # Created Date  : ProjectStatusController
    # Purpose       : Show the list of the project status
    # Params        : 
    /*****************************************************/

	public function index()
	{  
        $statusData = array();
		
        $statusData['page_title']="Project Status";
        $statusData['panel_title']="Project Status";

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
            $status = ProjectStatus::orWhere('status', 'like', '%' .trim($searchKeyword) . '%')->orWhere('status_ar', 'like', '%' .trim($searchKeyword) . '%')->paginate(self::$paginationLimit);  
        }
        else
        {
            //echo 'hi'; die;
            $status = ProjectStatus::paginate(self::$paginationLimit);  
        }

        //$projectNears = ProjectNearPlace::paginate(self::$paginationLimit);	
        $statusData['status'] = $status;
        
		
		return view('admin/project_status/index',$statusData);

	}

    //=================================================================
    /*****************************************************/
    # ProjectStatusController
    # Function name : add
    # Author        :
    # Created Date  : ProjectStatusController
    # Purpose       : Show project status add form
    # Params        : Request $request
    /*****************************************************/

    public function add(Request $request)
    {  
        $statusData = array();

        $statusData['page_title']='Project Status Create ';
        $statusData['panel_title']='Project Status Create ';

        return view('admin/project_status/add',$statusData);
    }

    //=================================================================
    /*****************************************************/
    # ProjectStatusController
    # Function name : save
    # Author        :
    # Created Date  : ProjectStatusController
    # Purpose       : Save project status form data.
    # Params        : Request $request
    /*****************************************************/
    
    public function save(Request $request)
    {
        //dd($request);
        try {

        
            $validator = Validator::make($request->all(), [
                        'status' => 'required',
                        'status_ar' => 'required',
                        'status_flag' => 'required'
                    ],[
                         'status.required'=>'please enter status name in english',
                         'status_ar.required'=>'please enter status name in arabic',
                         

            ]);
                    
            if ($validator->fails()) { 
                
                        return redirect('admin/status/add')
                                    ->withErrors($validator)
                                    ->withInput();
            } else {

                $pstatus = new \App\Models\ProjectStatus;

                $pstatus->status = $request->status;
                $pstatus->status_ar = $request->status_ar;
                $pstatus->status_flag = $request->status_flag;

                $pstatus->save();

                session()->flash('success', 'Record added successfully');
                Session::flash('alert-class', 'alert-success'); 
                return redirect('admin/status/index');



            }

        }
        catch (\Exception $e) {
            Log::error($e->getMessage());
            //session()->flash('message', $e->getMessage());
            
            session()->flash('error', $e->getMessage());
            Session::flash('alert-class', 'alert-danger');
            return redirect('admin/status/add');
           
        }
    }


    //===================================================================
    /*****************************************************/
    # ProjectStatusController
    # Function name : delete
    # Author        :
    # Created Date  : ProjectStatusController
    # Purpose       : Delete project status data
    # Params        : $id
    /*****************************************************/

    public function delete($id)
    {
        try {
        $decId = decrypt($id, Config::get('Constant.ENC_KEY'));
        ProjectStatus::where('id', $decId)->delete();
        session()->flash('success', 'Record deleted successfully');
        Session::flash('alert-class', 'alert-success'); 
        return redirect('admin/status/index');
        
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            session()->flash('error', 'Some error occured during delete record');
            Session::flash('alert-class', 'alert-danger');
            return redirect('admin/status/index');
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
        $statusData['page_title']='Project Status Edit ';
        $statusData['panel_title']='Project Status Edit ';

        $edid = decrypt($id, Config::get('Constant.ENC_KEY'));
        $statusDetail = ProjectStatus::where('id',$edid)->first();
        $statusData['statusDetail'] = $statusDetail;

        return view('admin/project_status/edit',$statusData);
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
        $sId = $request->project_status_id;

        $esid = encrypt($sId, Config::get('Constant.ENC_KEY'));
        

        try {
            $validator = Validator::make($request->all(), [
                        'status' => 'required',
                        'status_ar' => 'required',
                    ]);
                    
            if ($validator->fails()) { 
                
                        return redirect('admin/status/edit/'.$nid)
                                    ->withErrors($validator)
                                    ->withInput();
            } else {

                
                $statusData = ProjectStatus::find($sId);
                $statusData->status = $request->status;
                $statusData->status_ar = $request->status_ar;
                $statusData->save();

                session()->flash('success', 'Status edited successfully');
                Session::flash('alert-class', 'alert-success'); 
                return redirect('admin/status/index');

            }

        }
        catch (\Exception $e) {
                    Log::error($e->getMessage());
                    session()->flash('error', $e->getMessage());
                    Session::flash('alert-class', 'alert-danger');
                   return redirect('admin/status/edit/'.$esid);
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

        $st = ProjectStatus::findOrFail($edid);
        $updateStatus = $st->status_flag == '1' ? '0' : '1'; 
        $st->status_flag=$updateStatus;
        $saveResponse=$st->save();       
        if($saveResponse){
            $response['has_error']=0;
            $response['msg']="Successfully changed status.";
        }
        return $response;
    }
}