<?php

namespace App\Http\Controllers\admin;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Country;
use App\Models\State;
use App\Models\City;
use App\Http\Requests\CityUpdateRequest;  
use App\Http\Requests\CityRequest; 
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



class CityController extends Controller
{
    public $data= array();
    private static $paginationLimit= 10;


    /*****************************************************/
    # CityController
    # Function name : cityList
    # Author        :
    # Created Date  : 2-4-2021
    # Purpose       : city Listing
    #                 
    #                 
    # Params        : 
    /*****************************************************/

    public function cityList(Request $request){

        $this->data['page_title']="City List";
        $this->data['panel_title']="City List";
        $searchKeyword = $_GET['q'] ?? '' ;
        $cityObj= City::with(['getCountry','getState'])->select('*');  
            if(!empty($searchKeyword))
            $cityObj->orWhere('name_en', 'like', '%' .trim($searchKeyword) . '%');
            $cityObj->orWhere('name_ar', 'like', '%' .trim($searchKeyword) . '%');
            $cityObj->whereNull('deleted_at')->orderBy('id','desc')->get();  
       $this->data['cityList']=$cityObj->paginate(self::$paginationLimit);
        return view('admin.city.list',$this->data);
    }

    /*****************************************************/
    # FaqController
    # Function name : stateAdd
    # Author        :
    # Created Date  : 02-04-2021
    # Purpose       : City Add
    #                 
    #                 
    # Params        : 
    /*****************************************************/
    public function cityAdd (Request $request){
        $this->data['page_title']='City Create ';
        $this->data['panel_title']='City Create ';
        $this->data['countries']=Country::get();
        $this->data['states']=State::get();
        return view('admin.city.add',$this->data);
    }

    /*****************************************************/
    # FaqController
    # Function name : citycity
    # Author        :
    # Created Date  : 02-04-2021
    # Purpose       : City Save
    #                 
    #                 
    # Params        : 
    /*****************************************************/

    public function citySave(CityRequest $request){
        
        try
        {
        	if ($request->isMethod('POST'))
        	{
               
                $cityModelObj                = new City ;
                $cityModelObj->name_en   = trim($request->name_en, ' ');
                $cityModelObj->name_ar     = trim($request->name_ar, ' ');
                $cityModelObj->country_id         = $request->country_id;
                $cityModelObj->state_id             = $request->state_id;
                $cityModelObj->status        = $request->status;
                $cityModelObj->created_at    = Carbon::now();
                $cityModelObj->updated_at    = Carbon::now();
                $save = $cityModelObj->save();            

                if ($save) {
             
                    return redirect()->route('admin.city.city.list')->with('success','City has been added successfully.');;
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
    # Purpose       : City Edit
    #                 
    #                 
    # Params        : 
    /*****************************************************/


    public function cityEdit(Request $request, $encryptString) {
        $this->data['page_title']='City Edit';
        $this->data['panel_title']='City Edit';
        $cityId = decrypt($encryptString, Config::get('Constant.ENC_KEY')); // get user-id After Decrypt with salt key.
        $this->data['details'] = City::findOrFail($cityId);
        //dd($this->data['details']);
        $this->data['encryptCode'] = $encryptString;
        $this->data['countries']=Country::get();
        $this->data['states']=State::get();
        return view('admin.city.edit',$this->data); 
    }



    /*****************************************************/
    # FaqController
    # Function name : city update
    # Author        :
    # Created Date  : 31-03-2021
    # Purpose       :  update
    #                 
    #                 
    # Params        : 
    /*****************************************************/

    public function update(CityUpdateRequest $request){
   
        
        try
        {
            if ($request->isMethod('POST'))
            {
                $countryId = !empty($request->encString) ? decrypt($request->encString, Config::get('Constant.ENC_KEY')) : 0;
                
                $cityModelObj =  City::findOrFail($countryId);
                $cityModelObj->name_en            = trim($request->name_en, ' ');
                $cityModelObj->name_ar            = trim($request->name_ar, ' ');
                $cityModelObj->country_id         = $request->country_id;
                $cityModelObj->state_id           = $request->state_id;
                $cityModelObj->status             = $request->status;
                $cityModelObj->created_at         = Carbon::now();
                $cityModelObj->updated_at         = Carbon::now();
                $save = $cityModelObj->save(); 

                
                if($save){
                    return redirect()->route('admin.city.city.list')->with('success','City has been updated successfully.');;
                
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
    # Purpose       : city Delete
    #                 
    #                 
    # Params        : 
    /*****************************************************/
    
    public function cityDelete(Request $request,$encryptString)
    {

        $faqId = decrypt($encryptString, Config::get('Constant.ENC_KEY')); // get user-id After Decrypt with salt key.
        $details = City::findOrFail($faqId);


        if ($details) {
            $details->deleted_at=Carbon::now();
            $details->save();
            return redirect()->route('admin.city.city.list')->with('success','City has been deleted successfully!');
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


  

    public function resetCityStatus(Request $request){
    
        $response['has_error']=1;
        $response['msg']="Something went wrong.Please try again later.";

        $cmsId = decrypt($request->encryptCode, Config::get('Constant.ENC_KEY')); // get user-id After Decrypt with salt key.

        $cmsObj = City::findOrFail($cmsId);
        $updateStatus = $cmsObj->status == 'A' ? 'I' : 'A'; 
        $cmsObj->status=$updateStatus;
        $saveResponse=$cmsObj->save();       
        if($saveResponse){
            $response['has_error']=0;
            $response['msg']="Successfully changed status.";
        }
        return $response;
    }

    public function fetchState(Request $request)
    {
        $data['states'] = State::where("country_id",$request->country_id)->get(["name_en", "id"]);
        return response()->json($data);
    }


}