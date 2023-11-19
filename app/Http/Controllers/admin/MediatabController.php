<?php

namespace App\Http\Controllers\admin;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Social;
use App\Models\MediaTab;
use App\Http\Requests\SocialRequest;
use App\Http\Requests\updateSocialRequest;
use Helper, AdminHelper, Image, Validator,  View;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\CmsExport;
use Auth;
use Redirect;
use Carbon\Carbon;
use Yajra\Datatables\Datatables;
use Config;



class MediatabController extends Controller
{
    public $data= array();
    
    /************MediatabController*****************************************/
    # MediatabController
    # Function name : mediaTabEdit
    # Author        :
    # Created Date  : 19-07-2021
    # Purpose       : Media Tab Edit
    #                 
    #                 
    # Params        : 
    /*****************************************************/


    public function mediaTabEdit(Request $request) {
        $this->data['page_title']='Media Tab Title Edit';
        $this->data['panel_title']='Media Tab Title Edit';
        $encryptString= encrypt('1', Config::get('Constant.ENC_KEY'));; 
        $tabId = decrypt($encryptString, Config::get('Constant.ENC_KEY')); // get user-id After Decrypt with salt key.
        $this->data['details'] = MediaTab::findOrFail($tabId);
        $this->data['encryptCode'] = $encryptString;
        //dd($this->data['details']);
        return view('admin.mediatab.edit',$this->data); 
    }

    /*****************************************************/
    # MediatabController
    # Function name : mediaTabupdate
    # Author        :
    # Created Date  : 19-07-2021
    # Purpose       :  update media tab
    #                 
    #                 
    # Params        : 
    /*****************************************************/

    public function mediaTabupdate(Request $request){
        try
        {
        	if ($request->isMethod('POST'))
        	{
                $tabId = !empty($request->encString) ? decrypt($request->encString, Config::get('Constant.ENC_KEY')) : 0;
                
                $mediaTabModelObj =  MediaTab::findOrFail($tabId);

                $mediaTabModelObj->news_en            = trim($request->news_en, ' ');
                $mediaTabModelObj->news_ar            = trim($request->news_ar, ' ');
                $mediaTabModelObj->tv_channel_en      = trim($request->tv_channel_en, ' ');
                $mediaTabModelObj->tv_channel_ar      = trim($request->tv_channel_ar, ' ');
                $mediaTabModelObj->press_kit_en       = trim($request->press_kit_en, ' ');
                $mediaTabModelObj->press_kit_ar       = trim($request->press_kit_ar, ' ');
                $mediaTabModelObj->press_kit_heading_en       = trim($request->press_kit_heading_en, ' ');
                $mediaTabModelObj->press_kit_heading_ar       = trim($request->press_kit_heading_ar, ' ');

                $mediaTabModelObj->created_at      = Carbon::now();
                $mediaTabModelObj->updated_at      = Carbon::now();

                $save = $mediaTabModelObj->save(); 
                
                if($save){
                    return redirect()->route('admin.mediatab.editmediatab')->with('success','Media tab title has been updated successfully.');;
                
                } else {
                    return redirect()->back()->with('error', 'An error occurred while adding the Media tab title');
                }
				
			}
			
		} catch (Exception $e) {
			return redirect()->back()->with('error', $e->getMessage());
        } 
    }

}