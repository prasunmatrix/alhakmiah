<?php

namespace App\Http\Controllers\admin;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Country; 
use App\Models\State;
use App\Http\Requests\StateUpdateRequest;  
use App\Http\Requests\StateRequest; 
use Helper, AdminHelper, Image, Validator,  View;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\CmsExport;
use Session;
use Auth;
use Redirect;
use Carbon\Carbon;
use Yajra\Datatables\Datatables;
use Config;
use Exception;



class StateController extends Controller
{
    public $data= array();
    private static $paginationLimit= 10;


    /*****************************************************/
    # StateController
    # Function name : countryList
    # Author        :
    # Created Date  : 2-4-2021
    # Purpose       : state Listing
    #                 
    #                 
    # Params        : 
    /*****************************************************/

    public function stateList(Request $request){

        $this->data['page_title']="State List";
        $this->data['panel_title']="State List";
        $searchKeyword = $_GET['q'] ?? '' ;
        $stateObj= State::select('*');  
            if(!empty($searchKeyword))
            $stateObj->orWhere('name_en', 'like', '%' .trim($searchKeyword) . '%');
            $stateObj->whereNull('deleted_at')->orderBy('id','desc')->get();  
            $this->data['stateList']=$stateObj->paginate(self::$paginationLimit);
       
        return view('admin.state.list',$this->data);
    }

    /*****************************************************/
    # FaqController
    # Function name : stateAdd
    # Author        :
    # Created Date  : 02-04-2021
    # Purpose       : State Add
    #                 
    #                 
    # Params        : 
    /*****************************************************/
    public function stateAdd (Request $request){
        $this->data['page_title']='State Create ';
        $this->data['panel_title']='State Create ';
        $this->data['countries']=Country::get();

        return view('admin.state.add',$this->data);
    }

    /*****************************************************/
    # FaqController
    # Function name : state
    # Author        :
    # Created Date  : 02-04-2021
    # Purpose       : State Save
    #                 
    #                 
    # Params        : 
    /*****************************************************/

    public function stateSave(StateRequest $request){
        
        try
        {
        	if ($request->isMethod('POST'))
        	{
               
                $faqModelObj             = new State ;
                $faqModelObj->name_en    = trim($request->name_en, ' ');
                $faqModelObj->name_ar    = trim($request->name_ar, ' ');
                $faqModelObj->country_id = $request->country_id;
                $faqModelObj->status     = $request->status;
                $faqModelObj->created_at = Carbon::now();
                $faqModelObj->updated_at = Carbon::now();
                $save = $faqModelObj->save();            

                if ($save) {
             
                    return redirect()->route('admin.state.state.list')->with('success','state has been added successfully.');;
                } else {
                    return redirect()->back()->with('error', 'An error occurred while adding the Cms');
                }
				
			}
			
		} catch (Exception $e) {
			return redirect()->back()->with('error', $e->getMessage());
        } 
    }

    /*****************************************************/
    # FaqController
    # Function name : stateEdit
    # Author        :
    # Created Date  : 02-04-2021
    # Purpose       : State Edit
    #                 
    #                 
    # Params        : 
    /*****************************************************/


    public function stateEdit(Request $request, $encryptString) {
        $this->data['page_title']='State Edit';
        $this->data['panel_title']='State Edit';
        $countryId = decrypt($encryptString, Config::get('Constant.ENC_KEY')); // get user-id After Decrypt with salt key.
        $this->data['details'] = State::findOrFail($countryId);
        $this->data['encryptCode'] = $encryptString;
        $this->data['countries']=Country::get();
        return view('admin.state.edit',$this->data); 
    }



    /*****************************************************/
    # FaqController
    # Function name : state update
    # Author        :
    # Created Date  : 31-03-2021
    # Purpose       :  update
    #                 
    #                 
    # Params        : 
    /*****************************************************/

    public function update(StateUpdateRequest $request){
   
        
        try
        {
            if ($request->isMethod('POST'))
            {
                $countryId = !empty($request->encString) ? decrypt($request->encString, Config::get('Constant.ENC_KEY')) : 0;
                
                $faqModelObj =  State::findOrFail($countryId);
                $faqModelObj->name_en            = trim($request->name_en, ' ');
                $faqModelObj->name_ar            = trim($request->name_ar, ' ');
                $faqModelObj->country_id         = $request->country_id;
                $faqModelObj->status              = $request->status;
                $faqModelObj->created_at          = Carbon::now();
                $faqModelObj->updated_at          = Carbon::now();
                $save = $faqModelObj->save(); 

                
                if($save){
                    return redirect()->route('admin.state.state.list')->with('success','State has been updated successfully.');;
                
                } else {
                    return redirect()->back()->with('error', 'An error occurred while adding the Cms');
                }
                
            }
            
        } catch (Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        } 
    }
       
        
        
    /*****************************************************/
    # FaqController
    # Function name : stateDelete
    # Author        :
    # Created Date  : 02-04-2021
    # Purpose       : state Delete
    #                 
    #                 
    # Params        : 
    /*****************************************************/
    
    public function stateDelete(Request $request,$encryptString)
    {

        $faqId = decrypt($encryptString, Config::get('Constant.ENC_KEY')); // get user-id After Decrypt with salt key.
        $details = State::findOrFail($faqId);


        if ($details) {
            $details->deleted_at=Carbon::now();
            $details->save();
            return redirect()->route('admin.state.state.list')->with('success','State has been deleted successfully!');
        } else {
            $request->session()->flash('alert-danger', 'An error occurred while deleting the Cms list');
             return redirect()->back();
        }
    }
    /*****************************************************/
    # FaqController
    # Function name : ImageDelete
    # Author        :
    # Created Date  : 20-07-2020
    # Purpose       : Cms Multiple Delete
    #                 
    #                 
    # Params        : 
    /*****************************************************/

    public function ImageDelete(Request $request){

        // dd($request->all());
        $response['has_error']= 1;
        $response['msg']= 'Something went wrong. Please try again later.';
        $cmsimageId = decrypt($request->encryptId, Config::get('Constant.ENC_KEY')); // get user-id After Decrypt with salt key.
    
        $cmsImageModelObj = CmsImage::findOrFail($cmsimageId);
        $saveResponse= $cmsImageModelObj->delete();
    
        if($saveResponse){
            $response['has_error']= 0;
            $response['msg']= 'Successfully deleted.';
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


  

    public function resetStateStatus(Request $request){
    
        $response['has_error']=1;
        $response['msg']="Something went wrong.Please try again later.";

        $cmsId = decrypt($request->encryptCode, Config::get('Constant.ENC_KEY')); // get user-id After Decrypt with salt key.

        $cmsObj = State::findOrFail($cmsId);
        $updateStatus = $cmsObj->status == 'A' ? 'I' : 'A'; 
        $cmsObj->status=$updateStatus;
        $saveResponse=$cmsObj->save();       
        if($saveResponse){
            $response['has_error']=0;
            $response['msg']="Successfully changed status.";
        }
        return $response;
    }


}