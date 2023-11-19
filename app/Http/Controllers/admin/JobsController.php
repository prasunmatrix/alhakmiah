<?php

namespace App\Http\Controllers\admin;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Jobs;
use App\Models\CmsImage;
use App\Http\Requests\JobsRequest;
use App\Http\Requests\updateJobsRequest;
use Helper, AdminHelper, Image, Validator,  View;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\CmsExport;
use Auth;
use Redirect;
use Carbon\Carbon;
use Yajra\Datatables\Datatables;
use Config;



class JobsController extends Controller
{
    public $data= array();
    private static $paginationLimit= 10;


    /*****************************************************/
    # JobsController
    # Function name : jobsList
    # Author        :
    # Created Date  : 16-04-2021
    # Purpose       : jobs Listing
    #                 
    #                 
    # Params        : 
    /*****************************************************/

    public function jobsList(Request $request){
        $this->data['page_title']="Jobs List";
        $this->data['panel_title']="Jobs List";
        $searchKeyword = $_GET['q'] ?? '' ;
        $newsObj= Jobs::select('*');  
            if(!empty($searchKeyword))
            $newsObj->orWhere('title_en', 'like', '%' .trim($searchKeyword) . '%');
            $newsObj->orWhere('title_ar', 'like', '%' .trim($searchKeyword) . '%');
            $newsObj->orderBy('id','desc')->get();  
       $this->data['jobsList']=$newsObj->paginate(self::$paginationLimit);
        
        return view('admin.jobs.list',$this->data);
    }


    public function jobsAdd (Request $request){
        $this->data['page_title']='Jobs Create ';
        $this->data['panel_title']='Jobs Create ';
    
        return view('admin.jobs.add',$this->data);
    }

    /*****************************************************/
    # FaqController
    # Function name : jobsSave
    # Author        :
    # Created Date  : 31-03-2021
    # Purpose       : Jobs Save
    #                 
    #                 
    # Params        : 
    /*****************************************************/

    public function jobsSave(JobsRequest $request){
        
        try
        {
            if ($request->isMethod('POST'))
            {
               
                $jobsModelObj                      = new Jobs ;
                $jobsModelObj->title_en            = trim($request->title_en, ' ');
                $jobsModelObj->title_ar            = trim($request->title_ar, ' ');
                $jobsModelObj->slug_name           = Str::slug($request->title_en, '-'); 
                $jobsModelObj->description_en      = trim($request->description_en, ' ');
                $jobsModelObj->description_ar      = trim($request->description_ar, ' ');
                if($request->file('jobs_icon')) {
                    $files1=$request->file('jobs_icon');

                    $fullFileName1 = time().'.'.$files1->getClientOriginalExtension();
                    $destinationPath = 'assets/images';
                    $uploadResponse  = $files1->move($destinationPath,$fullFileName1);
                    $jobsModelObj->jobs_icon=$fullFileName1; 
                              
                }
                
                $jobsModelObj->created_at          = Carbon::now();
                $jobsModelObj->updated_at          = Carbon::now();
                $save = $jobsModelObj->save();            

                if ($save) {
             
                    return redirect()->route('admin.jobs.jobs.list')->with('success','News has been added successfully.');;
                } else {
                    return redirect()->back()->with('error', 'An error occurred while adding the Cms');
                }
                
            }
            
        } catch (Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        } 
    }

     /*****************************************************/
    # NewsController
    # Function name : NewsEdit
    # Author        :
    # Created Date  : 20-07-2020
    # Purpose       : Jobs Edit
    #                 
    #                 
    # Params        : 
    /*****************************************************/


    public function jobsEdit(Request $request, $encryptString) {
        $this->data['page_title']='Jobs Edit';
        $this->data['panel_title']='Jobs Edit';
        $serviceId = decrypt($encryptString, Config::get('Constant.ENC_KEY')); // get user-id After Decrypt with salt key
        $this->data['details'] = Jobs::findOrFail($serviceId);
        $this->data['encryptCode'] = $encryptString;
        //dd($this->data['details']);
        return view('admin.jobs.edit',$this->data); 
    }

   

    /*****************************************************/
    # NewsController
    # Function name : jobsjobs update
    # Author        :
    # Created Date  : 31-03-2021
    # Purpose       :  update
    #                 
    #                 
    # Params        : 
    /*****************************************************/

    public function update(updateJobsRequest $request){

        try
        {
        	if ($request->isMethod('POST'))
        	{
                $newsId = !empty($request->encString) ? decrypt($request->encString, Config::get('Constant.ENC_KEY')) : 0;
                
                $jobsModelObj =  Jobs::findOrFail($newsId);


                $jobsModelObj->title_en            = trim($request->title_en, ' ');
                $jobsModelObj->title_ar            = trim($request->title_ar, ' ');
                $jobsModelObj->slug_name           = Str::slug($request->title_en, '-'); 
                $jobsModelObj->description_en      = $request->description_en;
                $jobsModelObj->description_ar      = $request->description_ar;
                $jobsModelObj->status              = $request->status;
                if($request->file('jobs_icon')) {
                    $files1=$request->file('jobs_icon');
                     
                
                    $fullFileName1 = time().'.'.$files1->getClientOriginalExtension();
                    $destinationPath1 = 'assets/images';
                    $uploadResponse1  = $files1->move($destinationPath1,$fullFileName1);
                    $jobsModelObj->jobs_icon=$fullFileName1; 
                              
                }
              
                $jobsModelObj->created_at          = Carbon::now();
                $jobsModelObj->updated_at          = Carbon::now();
                $save = $jobsModelObj->save(); 

                
                if($save){
                    return redirect()->route('admin.jobs.jobs.list')->with('success','News has been updated successfully.');;
                
                } else {
                    return redirect()->back()->with('error', 'An error occurred while adding the Cms');
                }
				
			}
			
		} catch (Exception $e) {
			return redirect()->back()->with('error', $e->getMessage());
        } 
    }

   

    /*****************************************************/
    # NewsController
    # Function name : newsDelete
    # Author        :
    # Created Date  : 31-03-2021
    # Purpose       : Jobs Delete
    #                 
    #                 
    # Params        : 
    /*****************************************************/
    
    public function jobsDelete(Request $request,$encryptString)
    {

        $jobsId = decrypt($encryptString, Config::get('Constant.ENC_KEY')); // get user-id After Decrypt with salt key.
        $details = Jobs::findOrFail($jobsId);


        if ($details) {
            $details->deleted_at=Carbon::now();
            $details->save();
            return redirect()->route('admin.jobs.jobs.list')->with('success','News has been deleted successfully!');
        } else {
            $request->session()->flash('alert-danger', 'An error occurred while deleting the Cms list');
             return redirect()->back();
        }
    }

    /*****************************************************/
    # newsController
    # Function name : resetNewsStatus
    # Author        :
    # Created Date  : 01-04-2021
    # Purpose       : Reset Jobs Status
    #                 
    #                 
    # Params        : 
    /*****************************************************/

    public function resetJobsStatus(Request $request){
    
        $response['has_error']=1;
        $response['msg']="Something went wrong.Please try again later.";

        $jobsId = decrypt($request->encryptCode, Config::get('Constant.ENC_KEY')); // get user-id After Decrypt with salt key.

        $jobsObj = Jobs::findOrFail($jobsId);
        $updateStatus = $jobsObj->status == 'A' ? 'I' : 'A'; 
        $jobsObj->status=$updateStatus;
        $jobsObj->updated_at=Carbon::now();
        $saveResponse=$jobsObj->save();       
        if($saveResponse){
            $response['has_error']=0;
            $response['msg']="Successfully changed status.";
        }
        return $response;
    }

 

}