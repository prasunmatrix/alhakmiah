<?php

namespace App\Http\Controllers\admin;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Contact;
use App\Models\Social;
use App\Http\Requests\UpdateContsSettingsRequest;
use App\Http\Requests\HomeSettingRequest;
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



class ContactController extends Controller
{
    public $data= array();
    private static $paginationLimit= 10;


    /*****************************************************/
    # ContactController
    # Function name : contactList
    # Author        :
    # Created Date  : 06-04-2021
    # Purpose       : contactList Listing
    #                 
    #                 
    # Params        : 
    /*****************************************************/

    public function contactList(Request $request){
        $this->data['page_title']="Contact Us List";
        $this->data['panel_title']="Contact Us List";
        $searchKeyword = $_GET['q'] ?? '' ;
        $contactObj= Contact::select('*');  
            if(!empty($searchKeyword))
            $contactObj->orWhere('name', 'like', '%' .trim($searchKeyword) . '%');
            $contactObj->orWhere('email', 'like', '%' .trim($searchKeyword) . '%');
            $contactObj->where('is_deleted','N')->orderBy('id','desc')->get();  
       $this->data['contactList']=$contactObj->paginate(self::$paginationLimit);
        
        return view('admin.contacts.list',$this->data);
    }

   

   
    public function resetContactStatus(Request $request){
    
        $response['has_error']=1;
        $response['msg']="Something went wrong.Please try again later.";

        $cmsId = decrypt($request->encryptCode, Config::get('Constant.ENC_KEY')); // get user-id After Decrypt with salt key.

        $homeObj = Contact::findOrFail($cmsId);
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


  
                         
        
  
    public function contactExport(){
        // $currentTimeStamp = time().'directjobpost_list';
        // $response=[];
        ob_end_clean();
        ob_start();
    return Excel::download(new CmsExport, 'cms_list-'.time().'.xlsx');
    }


    //===================================================================
    /*****************************************************/
    # ContactController
    # Function name : delete
    # Author        :
    # Created Date  : ProjectNearController
    # Purpose       : Delete contact data
    # Params        : $id
    /*****************************************************/

    public function delete($id)
    {
        try {
        $decId = decrypt($id, Config::get('Constant.ENC_KEY'));
        Contact::where('id', $decId)->delete();
        session()->flash('success', 'Record deleted successfully');
        Session::flash('alert-class', 'alert-success'); 
        return redirect('admin/contacts/list');
        
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            session()->flash('error', 'Some error occured during delete record');
            Session::flash('alert-class', 'alert-danger');
            return redirect('admin/contacts/list');
        }
        
    }

    /************ContactController*****************************************/
    # ContactController
    # Function name :contactUsSetting
    # Author        :
    # Created Date  : 05-04-2021
    # Purpose       : contact us settings
    #                 
    #                 
    # Params        : 
    /*****************************************************/


    public function contactUsSetting(Request $request) {
        $this->data['page_title']='Contact Us Settings';
        $this->data['panel_title']='Contact Us Settings';
        $encryptString= encrypt('1', Config::get('Constant.ENC_KEY'));; 
        $settingsId = decrypt($encryptString, Config::get('Constant.ENC_KEY')); // get user-id After Decrypt with salt key.
        $this->data['details'] = Social::findOrFail($settingsId);
        $this->data['encryptCode'] = $encryptString;
        //dd($this->data['details']);
        return view('admin.contacts.settings',$this->data); 
    }

    /************ContactController*****************************************/
    # ContactController
    # Function name :contactUsSave
    # Author        :
    # Created Date  : 05-04-2021
    # Purpose       : contact us settings save
    #                 
    #                 
    # Params        : 
    /*****************************************************/

    public function contactUsSave(UpdateContsSettingsRequest $request){
        
        try
        {
        	if ($request->isMethod('POST'))
        	{

                $settingsId = !empty($request->encString) ? decrypt($request->encString, Config::get('Constant.ENC_KEY')) : 0;

                
                $contactSettingModelObj =  Social::findOrFail($settingsId);
                $contactSettingModelObj->contact_us_text_en           = trim($request->contact_us_text_en, ' ');
                $contactSettingModelObj->contact_us_text_ar           = trim($request->contact_us_text_ar, ' ');
                $contactSettingModelObj->contact_us_map               = trim($request->contact_us_map, ' ');
                $save = $contactSettingModelObj->save(); 

                
                if($save){
                    return redirect()->route('admin.contacts.contact-settings')->with('success','Contact Us settings has been updated successfully.');;
                
                } else {
                    return redirect()->back()->with('error', 'An error occurred while adding the Cms');
                }
				
			}
			
		} catch (Exception $e) {
			return redirect()->back()->with('error', $e->getMessage());
        } 
    }


}