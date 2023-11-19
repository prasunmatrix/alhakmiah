<?php

namespace App\Http\Controllers\admin;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Country;
use App\Http\Requests\CountryUpdateRequest;  
use App\Http\Requests\CountryRequest; 
use Helper, AdminHelper, Image, Validator,  View;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\CmsExport;
//use Illuminate\Support\Facades\Auth;
use Session;
use Auth;
use Redirect;
use Carbon\Carbon;
use Yajra\Datatables\Datatables;
use Config;
use Exception;



class CountryController extends Controller
{
    public $data= array();
    private static $paginationLimit= 10;


    /*****************************************************/
    # CountryController
    # Function name : countryList
    # Author        :
    # Created Date  : 2-4-2021
    # Purpose       : country Listing
    #                 
    #                 
    # Params        : 
    /*****************************************************/

    public function countryList(Request $request){

        $this->data['page_title']="Country List";
        $this->data['panel_title']="Country List";
        $searchKeyword = $_GET['q'] ?? '' ;
        $faqObj= Country::select('*');  
            if(!empty($searchKeyword))
            $faqObj->orWhere('name_en', 'like', '%' .trim($searchKeyword) . '%');
            $faqObj->orWhere('name_ar', 'like', '%' .trim($searchKeyword) . '%');
            $faqObj->whereNull('deleted_at')->orderBy('id','desc')->get();  
       $this->data['countryList']=$faqObj->paginate(self::$paginationLimit);
        
        return view('admin.country.list',$this->data);
    }

    /*****************************************************/
    # FaqController
    # Function name : cmsAdd
    # Author        :
    # Created Date  : 20-07-2020
    # Purpose       : Country Add
    #                 
    #                 
    # Params        : 
    /*****************************************************/
    public function countryAdd (Request $request){
        $this->data['page_title']='Country Create ';
        $this->data['panel_title']='Country Create ';
    
        return view('admin.country.add',$this->data);
    }

    /*****************************************************/
    # FaqController
    # Function name : countrySave
    # Author        :
    # Created Date  : 02-04-2021
    # Purpose       : Country Save
    #                 
    #                 
    # Params        : 
    /*****************************************************/

    public function countrySave(CountryRequest $request){
        
        try
        {
        	if ($request->isMethod('POST'))
        	{
               
                $faqModelObj                = new Country ;
                $faqModelObj->name_en   = trim($request->name_en, ' ');
                $faqModelObj->name_ar     = trim($request->name_ar, ' ');
                $faqModelObj->status        = $request->status;
                $faqModelObj->created_at    = Carbon::now();
                $faqModelObj->updated_at    = Carbon::now();
                $save = $faqModelObj->save();            

                if ($save) {
             
                    return redirect()->route('admin.country.country.list')->with('success','country has been added successfully.');;
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
    # Function name : countryEdit
    # Author        :
    # Created Date  : 31-03-2021
    # Purpose       : Country Edit
    #                 
    #                 
    # Params        : 
    /*****************************************************/


    public function countryEdit(Request $request, $encryptString) {
        $this->data['page_title']='Country Edit';
        $this->data['panel_title']='Country Edit';
        $countryId = decrypt($encryptString, Config::get('Constant.ENC_KEY')); // get user-id After Decrypt with salt key.
        $this->data['details'] = Country::findOrFail($countryId);
        $this->data['encryptCode'] = $encryptString;
        //dd($this->data['details']);
        return view('admin.country.edit',$this->data); 
    }



    /*****************************************************/
    # FaqController
    # Function name : country update
    # Author        :
    # Created Date  : 31-03-2021
    # Purpose       :  update
    #                 
    #                 
    # Params        : 
    /*****************************************************/

    public function update(CountryUpdateRequest $request){
   
        
        try
        {
            if ($request->isMethod('POST'))
            {
                $countryId = !empty($request->encString) ? decrypt($request->encString, Config::get('Constant.ENC_KEY')) : 0;
                
                $faqModelObj =  Country::findOrFail($countryId);
                $faqModelObj->name_en            = trim($request->name_en, ' ');
                $faqModelObj->name_ar            = trim($request->name_ar, ' ');
                $faqModelObj->status              = $request->status;
                $faqModelObj->created_at          = Carbon::now();
                $faqModelObj->updated_at          = Carbon::now();
                $save = $faqModelObj->save(); 

                
                if($save){
                    return redirect()->route('admin.country.country.list')->with('success','Country has been updated successfully.');;
                
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
    # Function name : countryDelete
    # Author        :
    # Created Date  : 31-03-2021
    # Purpose       : Faq Delete
    #                 
    #                 
    # Params        : 
    /*****************************************************/
    
    public function countryDelete(Request $request,$encryptString)
    {

        $faqId = decrypt($encryptString, Config::get('Constant.ENC_KEY')); // get user-id After Decrypt with salt key.
        $details = Country::findOrFail($faqId);


        if ($details) {
            $details->deleted_at=Carbon::now();
   
            $details->save();
            return redirect()->route('admin.country.country.list')->with('success','Country has been deleted successfully!');
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


  

    public function resetCountryStatus(Request $request){
    
        $response['has_error']=1;
        $response['msg']="Something went wrong.Please try again later.";

        $cmsId = decrypt($request->encryptCode, Config::get('Constant.ENC_KEY')); // get user-id After Decrypt with salt key.

        $cmsObj = Country::findOrFail($cmsId);
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