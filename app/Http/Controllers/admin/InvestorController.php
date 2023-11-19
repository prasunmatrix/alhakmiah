<?php

namespace App\Http\Controllers\admin;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Button;
use App\Models\InvestorAchievement;
use App\Models\Investor;
use App\Http\Requests\InvestorAchievementRequest;
use App\Http\Requests\InvestorRequest;
use App\Http\Requests\updateInvestorRequest;
use Helper, AdminHelper, Image, Validator,  View;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\CmsExport;
use Auth;
use Redirect;
use Carbon\Carbon;
use Yajra\Datatables\Datatables;
use Config;



class InvestorController extends Controller
{
    public $data= array();
    private static $paginationLimit= 10;


    /*****************************************************/
    # InvestorController
    # Function name : servioceList
    # Author        :
    # Created Date  : 20-07-2020
    # Purpose       : Homepagesetting Listing
    #                 
    #                 
    # Params        : 
    /*****************************************************/

    public function investorAchievementList(Request $request){
        $this->data['page_title']="Investor Achievement List";
        $this->data['panel_title']="Investor Achievement List";
        $searchKeyword = $_GET['q'] ?? '' ;
        $InvestorAchievementObj= InvestorAchievement::select('*');  
            if(!empty($searchKeyword))
            $InvestorAchievementObj->orWhere('year', 'like', '%' .trim($searchKeyword) . '%');
            $InvestorAchievementObj->whereNull('deleted_at')->orderBy('id','desc')->get();  
       $this->data['InvestorAchievementList']=$InvestorAchievementObj->paginate(self::$paginationLimit);
        
        return view('admin.investor.list',$this->data);
    }

/*** button changes ***/




public function buttontextchange(Request $request){

	$this->data['page_title']='Investor Button Text change';
	$this->data['panel_title']='Investor Button Text change';
	$encryptString= encrypt('1', Config::get('Constant.ENC_KEY'));
        $serviceId = decrypt($encryptString, Config::get('Constant.ENC_KEY')); // get user-id After Decrypt with salt key.
        $this->data['details'] = "";
        $this->data['encryptCode'] = $encryptString;

    return view('admin.investor.button',$this->data);

}

public function buttonupdate(Request $request){

	$this->data['page_title']='Investor Button Text change';
	$this->data['panel_title']='Investor Button Text change';
	$encryptString= encrypt('1', Config::get('Constant.ENC_KEY'));
        $serviceId = decrypt($encryptString, Config::get('Constant.ENC_KEY')); // get user-id After Decrypt with salt key.
        $Insave = Button::create([
		'annual_en'          => $request->annual_en,
		'financial_en'          => $request->financial_en,
		'profit_en'          => $request->Profit_en,
		'base_en'          => $request->Basel_en,
		'annual_ar'          => $request->annual_ar,
		'financial_ar'        => $request->financial_ar,
		'profit_ar'         => $request->Profit_ar,
		'base_ar'          => $request->Basel_ar]);

    if($Insave){
                    return redirect()->route('admin.investor-relations.button')->with('success','Button text has been inserted successfully.');
                
                } else {
                    return redirect()->back()->with('error', 'An error occurred while adding the Cms');
                }

}





/*** button changes ***/

    public function investorAchievementAdd (Request $request){
        $this->data['page_title']='Investor Achievement Create ';
        $this->data['panel_title']='Investor Achievement Create ';
    
        return view('admin.investor.add',$this->data);
    }

    public function investorAchievementSave(Request $request){
        try
        {
         
            if ($request->isMethod('POST'))
            {
                $investorId = !empty($request->encString) ? decrypt($request->encString, Config::get('Constant.ENC_KEY')) : 0;
                //dd($investorId);
                
                $investorAchieveModelObj = ($investorId == 0 ) ? new InvestorAchievement : InvestorAchievement::findOrFail($investorId);
                $investorAchieveModelObj->year    = $request->year;

                $investorAchieveModelObj->status    = $request->status;
                //dd('hi');
                if($request->file('financial_pdf')) {

                    $files=$request->file('financial_pdf');
                    $fullFileName = time().'.'.$files->getClientOriginalExtension();
                    $destinationPath               = 'assets/financial-pdf';
                    $uploadResponse                = $files->move($destinationPath,$fullFileName);
                    $investorAchieveModelObj->financial_pdf=$fullFileName; 
                }

                /*annual type*/
                if($request->file('annual_pdf')) {

                    $files=$request->file('annual_pdf');
                    $fullFileName = time().'.'.$files->getClientOriginalExtension();
                    $destinationPath               = 'assets/annual-pdf';
                    $uploadResponse                = $files->move($destinationPath,$fullFileName);
                    $investorAchieveModelObj->annual_pdf=$fullFileName;
                      
                }
                /*basel type*/
                if($request->file('basel_pdf')) {

                    $files=$request->file('basel_pdf');
                    $fullFileName = time().'.'.$files->getClientOriginalExtension();
                    $destinationPath               = 'assets/basel-pdf';
                    $uploadResponse                = $files->move($destinationPath,$fullFileName);
                    $investorAchieveModelObj->basel_pdf=$fullFileName;
                
                }

                /*profit type*/
                if($request->file('profit_pdf')) {

                    $files=$request->file('profit_pdf');
                    $fullFileName = time().'.'.$files->getClientOriginalExtension();
                    $destinationPath               = 'assets/profit-pdf';
                    $uploadResponse                = $files->move($destinationPath,$fullFileName);
                    $investorAchieveModelObj->profit_pdf=$fullFileName;
               
                }

                /*arebic section*/
                if($request->file('financial_pdf_ar')) {

                    $files=$request->file('financial_pdf_ar');
                    $fullFileName = time().'.'.$files->getClientOriginalExtension();
                    $destinationPath               = 'assets/financial-pdf';
                    $uploadResponse                = $files->move($destinationPath,$fullFileName);
                    $investorAchieveModelObj->financial_pdf_ar=$fullFileName;
              
                }

                /*annual section*/
                if($request->file('annual_pdf_ar')) {

                    $files=$request->file('annual_pdf_ar');
                    $fullFileName = time().'.'.$files->getClientOriginalExtension();
                    $destinationPath               = 'assets/annual-pdf';
                    $uploadResponse                = $files->move($destinationPath,$fullFileName);
                    $investorAchieveModelObj->annual_pdf_ar=$fullFileName;
               
                }

                /*basel section*/
                if($request->file('basel_pdf_ar')) {

                    $files=$request->file('basel_pdf_ar');
                    $fullFileName = time().'.'.$files->getClientOriginalExtension();
                    $destinationPath               = 'assets/basel-pdf';
                    $uploadResponse                = $files->move($destinationPath,$fullFileName);
                    $investorAchieveModelObj->basel_pdf_ar=$fullFileName;
                      
                }

                 /*profit section*/
                if($request->file('profit_pdf_ar')) {

                    $files=$request->file('profit_pdf_ar');
                    $fullFileName = time().'.'.$files->getClientOriginalExtension();
                    $destinationPath               = 'assets/profit-pdf';
                    $uploadResponse                = $files->move($destinationPath,$fullFileName);
                    $investorAchieveModelObj->profit_pdf_ar=$fullFileName;   
                }

               // dd($investorAchieveModelObj);

                $save = $investorAchieveModelObj->save(); 
                if ($save) {
                $msg = ($investorId == 0 ) ? 'Investor Achievement has been added successfully.' : 'Investor Achievement has been updated successfully.';
                return redirect()->route('admin.investor-relations.list')->with('success',$msg);
                
                } else {
                    return redirect()->back()->with('error', 'An error occurred while adding the Cms');
                }
                
            }
            
        } catch (Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        } 
    }

    /*****************************************************/
    # ServiceController
    # Function name : serviceEdit
    # Author        :
    # Created Date  : 20-07-2020
    # Purpose       : Investor Edit
    #                 
    #                 
    # Params        : 
    /*****************************************************/


    public function investorAchievementEdit(Request $request,$encryptString) {
        $this->data['page_title']='Investor Achievement Edit';
        $this->data['panel_title']='Investor Achievement Edit';
        $nvestorAchievementId = decrypt($encryptString, Config::get('Constant.ENC_KEY')); // get user-id After Decrypt with salt key.
        $this->data['details'] = InvestorAchievement::findOrFail($nvestorAchievementId);
        $this->data['encryptCode'] = $encryptString;
        //dd($this->data['details']);
        return view('admin.investor.investor-edit',$this->data); 
    }


    
   

    /*****************************************************/
    # ServiceController
    # Function name : investorinvestorinvestor update
    # Author        :
    # Created Date  : 31-03-2021
    # Purpose       :  update
    #                 
    #                 
    # Params        : 
    /*****************************************************/

    public function update(updateInvestorRequest $request){
   
        
        try
        {
            if ($request->isMethod('POST'))
            {
                $investorId = !empty($request->encString) ? decrypt($request->encString, Config::get('Constant.ENC_KEY')) : 0;
                
                $investorModelObj =  Investor::findOrFail($investorId);
                $investorModelObj->title_en          = trim($request->title_en, ' ');
                $investorModelObj->title_ar          = trim($request->title_ar, ' ');
                $investorModelObj->description_en    = trim($request->description_en, ' '); 
                $investorModelObj->description_ar    = trim($request->description_ar, ' ');

                $investorModelObj->heading_en       = trim($request->heading_en);
                $investorModelObj->heading_ar       = trim($request->heading_ar);
                
                $investorModelObj->status            = $request->status;
                // $investorModelObj->f_type            = trim($request->type, ' ');
                // $investorModelObj->a_type            = trim($request->a_type, ' ');
                // $investorModelObj->b_type            = trim($request->b_type, ' ');
                // $investorModelObj->p_type            = trim($request->p_type, ' ');
                // /*arabic*/
                // $investorModelObj->f_type_ar         = trim($request->f_type_ar, ' ');
                // $investorModelObj->a_type_ar         = trim($request->a_type_ar, ' ');
                // $investorModelObj->b_type_ar         = trim($request->b_type_ar, ' ');
                // $investorModelObj->p_type_ar         = trim($request->p_type_ar, ' ');
          
            
                if($request->file('banner')) {

                    $files=$request->file('banner');
                    $fullFileName = time().'.'.$files->getClientOriginalExtension();
                    $destinationPath               = 'assets/images';
                    $uploadResponse                = $files->move($destinationPath,$fullFileName);
                    $investorModelObj->banner=$fullFileName;

                
                }

                // if($request->file('financial_pdf')) {

                //     $files=$request->file('financial_pdf');
                //     $fullFileName = time().'.'.$files->getClientOriginalExtension();
                //     $destinationPath               = 'assets/images';
                //     $uploadResponse                = $files->move($destinationPath,$fullFileName);
                //     $investorModelObj->financial_pdf=$fullFileName;
                //     $investorModelObj->financial_link='';

                      
                // }

                // if(!empty($request->financial_link)){

                //     $UpdateDetails1 = Investor::where('id', '=',  $investorId)->first();
                //    if($UpdateDetails1){
                //     $UpdateDetails1->financial_pdf = '';
                //     $UpdateDetails1->financial_link = $request->financial_link;
                //     $UpdateDetails1->save();

                //    }   
                // }

                /*annual type*/
                // if($request->file('annual_pdf')) {

                //     $files=$request->file('annual_pdf');
                //     $fullFileName = time().'.'.$files->getClientOriginalExtension();
                //     $destinationPath               = 'assets/images';
                //     $uploadResponse                = $files->move($destinationPath,$fullFileName);
                //     $investorModelObj->annual_pdf=$fullFileName;
                //     $investorModelObj->annual_link='';

                      
                // }

                // if(!empty($request->annual_link)){

                //     $UpdateDetails1 = Investor::where('id', '=',  $investorId)->first();
                //    if($UpdateDetails1){
                //     $UpdateDetails1->annual_pdf = '';
                //     $UpdateDetails1->annual_link = $request->annual_link;
                //     $UpdateDetails1->save();

                //    }   
                // }

                /*basel type*/
                // if($request->file('basel_pdf')) {

                //     $files=$request->file('basel_pdf');
                //     $fullFileName = time().'.'.$files->getClientOriginalExtension();
                //     $destinationPath               = 'assets/images';
                //     $uploadResponse                = $files->move($destinationPath,$fullFileName);
                //     $investorModelObj->basel_pdf=$fullFileName;
                //     $investorModelObj->basel_link='';

                      
                // }

                // if(!empty($request->basel_link)){

                //     $UpdateDetails1 = Investor::where('id', '=',  $investorId)->first();
                //    if($UpdateDetails1){
                //     $UpdateDetails1->basel_pdf = '';
                //     $UpdateDetails1->basel_link = $request->basel_link;
                //     $UpdateDetails1->save();

                //    }   
                // }

                /*profit type*/
                // if($request->file('profit_pdf')) {

                //     $files=$request->file('profit_pdf');
                //     $fullFileName = time().'.'.$files->getClientOriginalExtension();
                //     $destinationPath               = 'assets/images';
                //     $uploadResponse                = $files->move($destinationPath,$fullFileName);
                //     $investorModelObj->profit_pdf=$fullFileName;
                //     $investorModelObj->profit_link='';

                      
                // }

                // if(!empty($request->profit_link)){

                //     $UpdateDetails1 = Investor::where('id', '=',  $investorId)->first();
                //    if($UpdateDetails1){
                //     $UpdateDetails1->profit_pdf = '';
                //     $UpdateDetails1->profit_link = $request->profit_link;
                //     $UpdateDetails1->save();

                //    }   
                // }
                /*arebic section*/
                // if($request->file('financial_pdf_ar')) {

                //     $files=$request->file('financial_pdf_ar');
                //     $fullFileName = time().'.'.$files->getClientOriginalExtension();
                //     $destinationPath               = 'assets/images';
                //     $uploadResponse                = $files->move($destinationPath,$fullFileName);
                //     $investorModelObj->financial_pdf_ar=$fullFileName;
                //     $investorModelObj->financial_link_ar='';

                      
                // }

                // if(!empty($request->financial_link_ar)){

                //     $UpdateDetails1 = Investor::where('id', '=',  $investorId)->first();
                //    if($UpdateDetails1){
                //     $UpdateDetails1->financial_pdf_ar = '';
                //     $UpdateDetails1->financial_link_ar = $request->financial_link_ar;
                //     $UpdateDetails1->save();

                //    }   
                // }

                // /*annual section*/
                // if($request->file('annual_pdf_ar')) {

                //     $files=$request->file('annual_pdf_ar');
                //     $fullFileName = time().'.'.$files->getClientOriginalExtension();
                //     $destinationPath               = 'assets/images';
                //     $uploadResponse                = $files->move($destinationPath,$fullFileName);
                //     $investorModelObj->annual_pdf_ar=$fullFileName;
                //     $investorModelObj->annual_link_ar='';

                      
                // }

                // if(!empty($request->annual_link_ar)){

                //     $UpdateDetails1 = Investor::where('id', '=',  $investorId)->first();
                //    if($UpdateDetails1){
                //     $UpdateDetails1->annual_pdf_ar = '';
                //     $UpdateDetails1->annual_link_ar = $request->annual_link_ar;
                //     $UpdateDetails1->save();

                //    }   
                // }

                // /*basel section*/
                // if($request->file('basel_pdf_ar')) {

                //     $files=$request->file('basel_pdf_ar');
                //     $fullFileName = time().'.'.$files->getClientOriginalExtension();
                //     $destinationPath               = 'assets/images';
                //     $uploadResponse                = $files->move($destinationPath,$fullFileName);
                //     $investorModelObj->basel_pdf_ar=$fullFileName;
                //     $investorModelObj->basel_link_ar='';

                      
                // }

                // if(!empty($request->basel_link_ar)){

                //     $UpdateDetails1 = Investor::where('id', '=',  $investorId)->first();
                //    if($UpdateDetails1){
                //     $UpdateDetails1->basel_pdf_ar = '';
                //     $UpdateDetails1->basel_link_ar = $request->basel_link_ar;
                //     $UpdateDetails1->save();

                //    }   
                // }
                //  /*profit section*/
                // if($request->file('profit_pdf_ar')) {

                //     $files=$request->file('profit_pdf_ar');
                //     $fullFileName = time().'.'.$files->getClientOriginalExtension();
                //     $destinationPath               = 'assets/images';
                //     $uploadResponse                = $files->move($destinationPath,$fullFileName);
                //     $investorModelObj->profit_pdf_ar=$fullFileName;
                //     $investorModelObj->profit_link_ar='';

                      
                // }

                // if(!empty($request->profit_link_ar)){

                //     $UpdateDetails1 = Investor::where('id', '=',  $investorId)->first();
                //    if($UpdateDetails1){
                //     $UpdateDetails1->profit_pdf_ar = '';
                //     $UpdateDetails1->profit_link_ar = $request->profit_link_ar;
                //     $UpdateDetails1->save();

                //    }   
                // }

                $save = $investorModelObj->save(); 

                if($save){
                    return redirect()->route('admin.investor-relations.edit')->with('success','Investor has been updated successfully.');;
                
                } else {
                    return redirect()->back()->with('error', 'An error occurred while adding the Cms');
                }
                
            }
            
        } catch (Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        } 
    }





    /*****************************************************/
    # ServiceController
    # Function name : serviceEdit
    # Author        :
    # Created Date  : 20-07-2020
    # Purpose       : Investor Edit
    #                 
    #                 
    # Params        : 
    /*****************************************************/


    public function investorEdit(Request $request) {
        $this->data['page_title']='Investor Edit';
        $this->data['panel_title']='Investor Edit';
        $encryptString= encrypt('1', Config::get('Constant.ENC_KEY'));
        $serviceId = decrypt($encryptString, Config::get('Constant.ENC_KEY')); // get user-id After Decrypt with salt key.
        $this->data['details'] = Investor::findOrFail($serviceId);
        $this->data['encryptCode'] = $encryptString;
        //dd($this->data['details']);
        return view('admin.investor.edit',$this->data); 
    }

    /*****************************************************/
    # serviceController
    # Function name : serviceDelete
    # Author        :
    # Created Date  : 31-03-2021
    # Purpose       : Investor Delete
    #                 
    #                 
    # Params        : 
    /*****************************************************/
    
    public function investorAchievementDelete(Request $request,$encryptString)
    {

        $investorAchieveId = decrypt($encryptString, Config::get('Constant.ENC_KEY')); // get user-id After Decrypt with salt key.
        $details = InvestorAchievement::findOrFail($investorAchieveId);
        if ($details) {
            $details->deleted_at=Carbon::now();
            $details->save();
            return redirect()->route('admin.investor-relations.list')->with('success','Investor Achievement has been deleted successfully!');
        } else {
            $request->session()->flash('alert-danger', 'An error occurred while deleting the Investor Achievement list');
             return redirect()->back();
        }
    }
    
     /*****************************************************/
    # ServiceController
    # Function name : resetServicetatus
    # Author        :
    # Created Date  : 01-04-2021
    # Purpose       : Reset Investor Status
    #                 
    #                 
    # Params        : 
    /*****************************************************/

    public function resetInvestorAchievementStatus(Request $request){
    
        $response['has_error']=1;
        $response['msg']="Something went wrong.Please try again later.";

        $investorAchievementId= decrypt($request->encryptCode, Config::get('Constant.ENC_KEY')); // get user-id After Decrypt with salt key.

        $investorAchievementObj = InvestorAchievement::findOrFail($investorAchievementId);
        $updateStatus = $investorAchievementObj->status == 'A' ? 'I' : 'A'; 
        $investorAchievementObj->status=$updateStatus;
        $investorAchievementObj->updated_at=Carbon::now();
        $saveResponse=$investorAchievementObj->save();       
        if($saveResponse){
            $response['has_error']=0;
            $response['msg']="Successfully changed status.";
        }
        return $response;
    }

    public function PdfDelete(Request $request){

        //dd($request->all());
        $investorId= $request->pdfId;
        $resources= $request->pdfsource;
        
        $response['has_error']= 1;
        $response['msg']= 'Something went wrong. Please try again later.';

        $saveResponse = InvestorAchievement::where("id", $investorId)->update([$resources => '']);

        if($saveResponse){
            $response['has_error']= 0;
            $response['msg']= 'Successfully deleted.';
        }
    
        return json_encode( $response );
    
    }


////////////////////////// sandip button changes ///////////////////

 public function admincmschng()
    {  

        $projectCmsTxt= array();
        
        $projectCmsTxt['page_title']="CMS TEXT Chnage";
        $projectCmsTxt['panel_title']="CMS TEXT Change Dynamically";

        $projectServices = Button::paginate(self::$paginationLimit);   
        $projectCmsTxt['cmstextchange'] = $projectServices;
       //dd($projectCmsTxt);
        
        return view('admin/investor/cmslist',$projectCmsTxt);

    }

public function buttonedit(Request $request) {
                  
        $this->data['page_title']='Button text Edit';
        $this->data['panel_title']='Button text Edit';
        $encryptString= encrypt('1', Config::get('Constant.ENC_KEY'));
        $serviceId = decrypt($encryptString, Config::get('Constant.ENC_KEY')); // get user-id After Decrypt with salt key.
        $this->data['details'] = Button::findOrFail($serviceId);
        $this->data['encryptCode'] = $encryptString;       
        return view('admin.investor.editbutton',$this->data); 
    }

public function buttoneditupdate(Request $request){
$buttontextId = !empty($request->encString) ? decrypt($request->encString, Config::get('Constant.ENC_KEY')) : 0;

  $buttonModelobj =  Button::findOrFail($buttontextId);
                $buttonModelobj->annual_en          = trim($request->annual_en, ' ');
		$buttonModelobj->financial_en          = trim($request->financial_en, ' ');
		$buttonModelobj->profit_en          = trim($request->Profit_en, ' ');
		$buttonModelobj->base_en          = trim($request->Basel_en, ' ');
		$buttonModelobj->annual_ar          = trim($request->annual_ar, ' ');
		$buttonModelobj->financial_ar          = trim($request->financial_ar, ' ');
		$buttonModelobj->profit_ar          = trim($request->Profit_ar, ' ');
		$buttonModelobj->base_ar          = trim($request->Basel_ar, ' ');

		$save = $buttonModelobj->save(); 

if($save){
                    return redirect()->route('admin.investor-relations.admincmschng')->with('success','Button text has been updated successfully.');
                
                } else {
                    return redirect()->back()->with('error', 'An error occurred while adding the Cms');
                }


		}


////////////////////////// sandip button changes ///////////////////

}
