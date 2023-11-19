<?php

namespace App\Http\Controllers\admin;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Faq;
use App\Models\CmsImage;
use App\Models\Project;
use App\Http\Requests\FaqUpdateRequest;  
use App\Http\Requests\FaqRequest; 
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



class FaqController extends Controller
{
    public $data= array();
    private static $paginationLimit= 10;


    /*****************************************************/
    # FaqController
    # Function name : faqIndex
    # Author        :
    # Created Date  : 20-07-2020
    # Purpose       : Cms Listing
    #                 
    #                 
    # Params        : 
    /*****************************************************/

    public function faqIndex(Request $request){
        $this->data['page_title']="Faq List";
        $this->data['panel_title']="Faq List";
        $searchKeyword = $_GET['q'] ?? '' ;
        $faqObj= Faq::select('*');  
            if(!empty($searchKeyword))
            $faqObj->orWhere('question_en', 'like', '%' .trim($searchKeyword) . '%');
            $faqObj->whereNull('deleted_at')->orderBy('id','desc')->get();  
       $this->data['faqList']=$faqObj->paginate(self::$paginationLimit);
        
        return view('admin.faq.list',$this->data);
    }

    /*****************************************************/
    # FaqController
    # Function name : cmsAdd
    # Author        :
    # Created Date  : 20-07-2020
    # Purpose       : Faq Add
    #                 
    #                 
    # Params        : 
    /*****************************************************/
    public function faqAdd (Request $request){
        $this->data['page_title']='Faq Create ';
        $this->data['panel_title']='Faq Create ';
        
        $this->data['projects'] = Project::whereNull('deleted_at')->where('status','=','1')->get();

        return view('admin.faq.add',$this->data);
    }

    /*****************************************************/
    # FaqController
    # Function name : faqSave
    # Author        :
    # Created Date  : 31-03-2021
    # Purpose       : Faq Save
    #                 
    #                 
    # Params        : 
    /*****************************************************/

    public function faqSave(FaqRequest $request){
        
        try
        {
        	if ($request->isMethod('POST'))
        	{
               
                $faqModelObj                = new Faq ;
                $faqModelObj->question_en   = trim($request->question_en, ' ');
                $faqModelObj->answer_en     = trim($request->answer_en, ' ');
                $faqModelObj->question_ar   = $request->question_ar;
                $faqModelObj->answer_ar     = $request->answer_ar;
                $faqModelObj->project_id    = trim($request->project, ' ');
                $faqModelObj->status        = $request->status;
                $faqModelObj->created_at    = Carbon::now();
                $faqModelObj->updated_at    = Carbon::now();
                $save = $faqModelObj->save();            

                if ($save) {
             
                    return redirect()->route('admin.project.faq.index')->with('success','faq has been added successfully.');;
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
    # Function name : faqEdit
    # Author        :
    # Created Date  : 31-03-2021
    # Purpose       : Faq Edit
    #                 
    #                 
    # Params        : 
    /*****************************************************/


    public function faqEdit(Request $request, $encryptString) {
        $this->data['page_title']='Faq Edit';
        $this->data['panel_title']='Faq Edit';
        $faqId = decrypt($encryptString, Config::get('Constant.ENC_KEY')); // get user-id After Decrypt with salt key.
        $this->data['details'] = Faq::findOrFail($faqId);
        $this->data['encryptCode'] = $encryptString;

        $this->data['projects'] = Project::whereNull('deleted_at')->where('status','=','1')->get();
        //dd($this->data['details']);
        return view('admin.faq.edit',$this->data); 
    }



    /*****************************************************/
    # FaqController
    # Function name : faq faqUpdate
    # Author        :
    # Created Date  : 31-03-2021
    # Purpose       :  faqUpdate
    #                 
    #                 
    # Params        : 
    /*****************************************************/

    public function faqUpdate(FaqUpdateRequest $request){
   
        
        try
        {
            if ($request->isMethod('POST'))
            {
                $faqId = !empty($request->encString) ? decrypt($request->encString, Config::get('Constant.ENC_KEY')) : 0;
                
                $faqModelObj =  Faq::findOrFail($faqId);
                $faqModelObj->question_en            = trim($request->question_en, ' ');
                $faqModelObj->answer_en            = trim($request->answer_en, ' ');
                $faqModelObj->question_ar      = $request->question_ar;
                $faqModelObj->answer_ar      = $request->answer_ar;
                $faqModelObj->project_id    = trim($request->project, ' ');
                $faqModelObj->status              = $request->status;
                $faqModelObj->created_at          = Carbon::now();
                $faqModelObj->updated_at          = Carbon::now();
                $save = $faqModelObj->save(); 

                
                if($save){
                    return redirect()->route('admin.project.faq.index')->with('success','Faq has been updated successfully.');;
                
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
    # Function name : faqDelete
    # Author        :
    # Created Date  : 31-03-2021
    # Purpose       : Faq Delete
    #                 
    #                 
    # Params        : 
    /*****************************************************/
    
    public function faqDelete(Request $request,$encryptString)
    {

        $faqId = decrypt($encryptString, Config::get('Constant.ENC_KEY')); // get user-id After Decrypt with salt key.
        $details = Faq::findOrFail($faqId);


        if ($details) {
            $details->deleted_at=Carbon::now();
            $details->save();
            return redirect()->route('admin.project.faq.index')->with('success','Faq has been deleted successfully!');
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


  

    public function set_status(Request $request){
    
        $response['has_error']=1;
        $response['msg']="Something went wrong.Please try again later.";

        $cmsId = decrypt($request->encryptCode, Config::get('Constant.ENC_KEY')); // get user-id After Decrypt with salt key.

        $cmsObj = Faq::findOrFail($cmsId);
        $updateStatus = $cmsObj->status == 'A' ? 'I' : 'A'; 
        $cmsObj->status=$updateStatus;
        $cmsObj->updated_at=Carbon::now();
        $saveResponse=$cmsObj->save();       
        if($saveResponse){
            $response['has_error']=0;
            $response['msg']="Successfully changed status.";
        }
        return $response;
    }

    /*****************************************************/
    # FaqController
    # Function name : chatAdmin
    # Author        :
    # Created Date  : 20-07-2020
    # Purpose       : Chat Admin Panel
    #                 
    #                 
    # Params        : 
    /*****************************************************/
    public function chatAdmin (Request $request){
        $this->data['page_title']='Faq Sopport Chat Admin';
        $this->data['panel_title']='Faq Sopport Chat Admin';
    
        return view('admin.faq.chat-admin',$this->data);
    }



}