<?php
/*****************************************************/
# ProjectTypeController
# Page/Class name   : ProjectTypeController
# Author            :
# Created Date      : 02-04-2020
# Functionality     : index, add, edit. delete 
# Purpose           : Project Type management
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
use App\Models\ProjectType;

use Session;
use DB;
use File;
use Illuminate\Support\Facades\Log;
use Exception;

class ProjectTypeController extends Controller
{
    private static $paginationLimit= 10;
    //=================================================================
    /*****************************************************/
    # ProjectTypeController
    # Function name : index
    # Author        :
    # Created Date  : ProjectTypeController
    # Purpose       : Show the list of the Project Type
    # Params        : 
    /*****************************************************/

	public function index()
	{  
        $typeData = array();
		
        $typeData['page_title']="Project Type";
        $typeData['panel_title']="Project Type";

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
            $type = ProjectType::orWhere('type', 'like', '%' .trim($searchKeyword) . '%')->orWhere('type_ar', 'like', '%' .trim($searchKeyword) . '%')->paginate(self::$paginationLimit);  
        }
        else
        {
            //echo 'hi'; die;
            $type = ProjectType::paginate(self::$paginationLimit);  
        }

        //$projectNears = ProjectNearPlace::paginate(self::$paginationLimit);	
        $typeData['type'] = $type;
        
		
		return view('admin/project_type/index',$typeData);

	}

    //=================================================================
    /*****************************************************/
    # ProjectTypeController
    # Function name : add
    # Author        :
    # Created Date  : ProjectTypeController
    # Purpose       : Show Project Type add form
    # Params        : Request $request
    /*****************************************************/

    public function add(Request $request)
    {  
        $typeData = array();

        $typeData['page_title']='Project Type Create ';
        $typeData['panel_title']='Project Type Create ';

        return view('admin/project_type/add',$typeData);
    }

    //=================================================================
    /*****************************************************/
    # ProjectTypeController
    # Function name : save
    # Author        :
    # Created Date  : ProjectTypeController
    # Purpose       : Save Project Type form data.
    # Params        : Request $request
    /*****************************************************/
    
    public function save(Request $request)
    {
        //dd($request);
        try {

          
            $validator = Validator::make($request->all(), [
                        'type' => 'required',
                        'type_ar' => 'required',
                        'status_flag' => 'required'
                    ],[
                         'type.required'=>'please enter service type in english',
                         'type_ar.required'=>'please enter service type in arabic',
                         

            ]);
                    
            if ($validator->fails()) { 
                
                        return redirect('admin/type/add')
                                    ->withErrors($validator)
                                    ->withInput();
            } else {

                $ptype = new \App\Models\ProjectType;

                $ptype->type = $request->type;
                $ptype->type_ar = $request->type_ar;
                $ptype->status_flag = $request->status_flag;

                $ptype->save();

                session()->flash('success', 'Record added successfully');
                Session::flash('alert-class', 'alert-success'); 
                return redirect('admin/type/index');



            }

        }
        catch (\Exception $e) {
            Log::error($e->getMessage());
            //session()->flash('message', $e->getMessage());
            
            session()->flash('error', $e->getMessage());
            Session::flash('alert-class', 'alert-danger');
            return redirect('admin/type/add');
           
        }
    }


    //===================================================================
    /*****************************************************/
    # ProjectTypeController
    # Function name : delete
    # Author        :
    # Created Date  : ProjectTypeController
    # Purpose       : Delete Project Type data
    # Params        : $id
    /*****************************************************/

    public function delete($id)
    {
        try {
        $decId = decrypt($id, Config::get('Constant.ENC_KEY'));
        ProjectType::where('id', $decId)->delete();
        session()->flash('success', 'Record deleted successfully');
        Session::flash('alert-class', 'alert-success'); 
        return redirect('admin/type/index');
        
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            session()->flash('error', 'Some error occured during delete record');
            Session::flash('alert-class', 'alert-danger');
            return redirect('admin/type/index');
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
        $typeData['page_title']='Project Type Edit ';
        $typeData['panel_title']='Project Type Edit ';

        $edid = decrypt($id, Config::get('Constant.ENC_KEY'));
        $typeDetail = ProjectType::where('id',$edid)->first();
        $typeData['typeDetail'] = $typeDetail;

        return view('admin/project_type/edit',$typeData);
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
        $sId = $request->project_type_id;

        $esid = encrypt($sId, Config::get('Constant.ENC_KEY'));
        

        try {
            $validator = Validator::make($request->all(), [
                        'type' => 'required',
                        'type_ar' => 'required',
                    ]);
                    
            if ($validator->fails()) { 
                
                        return redirect('admin/type/edit/'.$nid)
                                    ->withErrors($validator)
                                    ->withInput();
            } else {

                
                $typeData = ProjectType::find($sId);
                $typeData->status = $request->type;
                $typeData->status_ar = $request->type_ar;
                $typeData->save();

                session()->flash('success', 'Status edited successfully');
                Session::flash('alert-class', 'alert-success'); 
                return redirect('admin/type/index');

            }

        }
        catch (\Exception $e) {
                    Log::error($e->getMessage());
                    session()->flash('error', $e->getMessage());
                    Session::flash('alert-class', 'alert-danger');
                   return redirect('admin/type/edit/'.$esid);
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

        $st = ProjectType::findOrFail($edid);
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