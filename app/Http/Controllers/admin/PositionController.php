<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\User;
use App\Models\Position;
use App\Models\PageTitle;
use App\Models\Category;
use App\Models\CmsImage;
use App\Http\Requests\CategoryRequest;
use App\Http\Requests\updateCategoryRequest;
use Helper, AdminHelper, Image, Validator,  View;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\CmsExport;
use Auth;
use Redirect;
use Carbon\Carbon;
use Yajra\Datatables\Datatables;
use Config;

class PositionController extends Controller
{

    public $data= array();
    private static $paginationLimit= 10;


    /*****************************************************/
    # PositionController
    # Function name : positionList
    # Author        :
    # Created Date  : 13-07-2021
    # Purpose       : Category List
    #                 
    #                 
    # Params        : 
    /*****************************************************/

    public function positionList(Request $request){
        $this->data['page_title']="Position List";
        $this->data['panel_title']="Position List";
        $searchKeyword = $_GET['q'] ?? '' ;
        $positionObj= Position::select('*');  
            if(!empty($searchKeyword))
            $positionObj->orWhere('name_en', 'like', '%' .trim($searchKeyword) . '%');
            $positionObj->orWhere('name_ar', 'like', '%' .trim($searchKeyword) . '%');
            $positionObj->whereNull('deleted_at')->orderBy('id','desc')->get();  
       $this->data['positionList']=$positionObj->paginate(self::$paginationLimit);
        
        return view('admin.position.list',$this->data);
    }


    public function positionAdd (Request $request){
        $this->data['page_title']='Position Create ';
        $this->data['panel_title']='Position Create ';

        $this->data['categories'] = Category::where('status','=','A')->where('parent_id', '=', '0')->get();

        return view('admin.position.add',$this->data);
    }

    public function positionSave (Request $request){
    try
        {
        	if ($request->isMethod('POST'))
        	{
                $positionModelObj           = new Position ;
                $positionModelObj->name_en       = trim($request->name_en, ' ');
                $positionModelObj->name_ar       = trim($request->name_ar, ' ');
                $positionModelObj->cat_id       = trim($request->category, ' ');
                $positionModelObj->subcat_id    = (isset($request->subcategory) && !empty($request->subcategory) )?trim($request->subcategory):0;
                $positionModelObj->designation_en       = trim($request->designation_en, ' ');
                $positionModelObj->designation_ar       = trim($request->designation_ar, ' ');
                $positionModelObj->description_en       = trim($request->description_en, ' ');
                $positionModelObj->description_ar       = trim($request->description_ar, ' ');

                $positionModelObj->status        = $request->status;
                $positionModelObj->created_at    = Carbon::now();
                $positionModelObj->updated_at    = Carbon::now();

                
                if($request->file('ceo_image')) {
                        
                    $files=$request->file('ceo_image');
                    $fullFileName = time().'.'.$files->getClientOriginalExtension();
                    $destinationPath                  = 'admin/upload/ceo_image';
                    $uploadResponse                   = $files->move($destinationPath,$fullFileName);

                    $positionModelObj->image=$fullFileName;
                }

                $save = $positionModelObj->save();            

                if ($save) {
             
                    return redirect()->route('admin.position.list')->with('success','Position has been added successfully.');;
                } else {
                    return redirect()->back()->with('error', 'An error occurred while adding the Position');
                }
				
			}
			
		} catch (Exception $e) {
			return redirect()->back()->with('error', $e->getMessage());
        } 
    }


    public function positionEdit(Request $request, $encryptString) {
        $this->data['page_title']='Position Edit';
        $this->data['panel_title']='Position Edit';
        $positionId = decrypt($encryptString, Config::get('Constant.ENC_KEY')); // get user-id After Decrypt with salt key.
        $this->data['details'] = Position::findOrFail($positionId);
        $this->data['encryptCode'] = $encryptString;

        $this->data['categories'] = Category::where('status','=','A')->where('parent_id', '=', '0')->get();
        $this->data['subcategory'] = Category::where('parent_id', $this->data['details']->cat_id)->orderby('id', 'ASC')->get();
        
        //dd($this->data['details']);
        return view('admin.position.edit',$this->data); 
    }

    /*****************************************************/
    # FaqController
    # Function name : position update
    # Author        :
    # Created Date  : 13-07-2021
    # Purpose       :  update
    #                 
    #                 
    # Params        : 
    /*****************************************************/

    public function update(Request $request){
        try
        {
            if ($request->isMethod('POST'))
            {
                $positionId = !empty($request->encString) ? decrypt($request->encString, Config::get('Constant.ENC_KEY')) : 0;
                
                $positionModelObj =  Position::findOrFail($positionId);
                $positionModelObj->name_en            = trim($request->name_en, ' ');
                $positionModelObj->name_ar            = trim($request->name_ar, ' ');
                $positionModelObj->cat_id       = trim($request->category, ' ');
                $positionModelObj->subcat_id    = (isset($request->subcategory) && !empty($request->subcategory) )?trim($request->subcategory):0;
                $positionModelObj->designation_en       = trim($request->designation_en, ' ');
                $positionModelObj->designation_ar       = trim($request->designation_ar, ' ');
                $positionModelObj->description_en       = trim($request->description_en, ' ');
                $positionModelObj->description_ar       = trim($request->description_ar, ' ');

                $positionModelObj->status             = $request->status;
                $positionModelObj->created_at         = Carbon::now();
                $positionModelObj->updated_at         = Carbon::now();

                if($request->file('ceo_image')) {
                        
                    $files=$request->file('ceo_image');
                    $fullFileName = time().'.'.$files->getClientOriginalExtension();
                    $destinationPath                  = 'admin/upload/ceo_image';
                    $uploadResponse                   = $files->move($destinationPath,$fullFileName);

                    $positionModelObj->image=$fullFileName;
                }
                
                $save = $positionModelObj->save(); 

                
                if($save){
                    return redirect()->route('admin.position.list')->with('success','Position has been updated successfully.');;
                
                } else {
                    return redirect()->back()->with('error', 'An error occurred while adding the Category');
                }
                
            }
            
        } catch (Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        } 
    }


    public function positionDelete(Request $request,$encryptString)
    {

        $positionId = decrypt($encryptString, Config::get('Constant.ENC_KEY')); // get user-id After Decrypt with salt key.
        $details = Position::findOrFail($positionId);

        if ($details) {
            $details->deleted_at=Carbon::now();
            $details->save();
            return redirect()->route('admin.position.list')->with('success','Position has been deleted successfully!');
        } else {
            $request->session()->flash('alert-danger', 'An error occurred while deleting the Position list');
             return redirect()->back();
        }
    }


    public function resetpositionStatus(Request $request){
    
        $response['has_error']=1;
        $response['msg']="Something went wrong.Please try again later.";

        $positionId = decrypt($request->encryptCode, Config::get('Constant.ENC_KEY')); // get user-id After Decrypt with salt key.

        $positionModelObj = Position::findOrFail($positionId);
        $updateStatus = $positionModelObj->status == 'A' ? 'I' : 'A'; 
        $positionModelObj->status=$updateStatus;
        $positionModelObj->updated_at=Carbon::now();
        $saveResponse=$positionModelObj->save();       
        if($saveResponse){
            $response['has_error']=0;
            $response['msg']="Successfully changed status.";
        }
        return $response;
    }

    public function ceoPdfEdit(Request $request) {
        $this->data['page_title']='CEO Brochure Edit';
        $this->data['panel_title']='CEO Brochure Edit';
        $encryptString= encrypt('1', Config::get('Constant.ENC_KEY'));; 
        $positionId = decrypt($encryptString, Config::get('Constant.ENC_KEY'));

        $this->data['details'] = PageTitle::findOrFail($positionId);
        $this->data['encryptCode'] = $encryptString;
        //dd($this->data['details']);
        return view('admin.ceopdf.edit',$this->data); 
    }

    public function ceoPdfupdate(Request $request){
        try
        {
        	if ($request->isMethod('POST'))
        	{
                $positionId = !empty($request->encString) ? decrypt($request->encString, Config::get('Constant.ENC_KEY')) : 0;
                
                $pTitleModelObj =  PageTitle::findOrFail($positionId);

                /* Brochure */
                $brochure = $request->file('brochure_en');
                if(!empty($brochure)) 
                {
                    $brochurename = pathinfo($brochure->getClientOriginalName(), PATHINFO_FILENAME).'_'.time().'.'.$brochure->getClientOriginalExtension();  
                    $brochure_destinationPath = public_path('/admin/upload/ceo_brochure/english');
                    $brochure->move($brochure_destinationPath, $brochurename);
                } 
                else 
                {
                    $brochurename = $_POST['old_brochure'];
                }
                /* Brochure END */

                /* Brochure Ar */
                $brochure_ar = $request->file('brochure_ar');
                if(!empty($brochure_ar)) 
                {
                    $brochurename_ar = pathinfo($brochure_ar->getClientOriginalName(), PATHINFO_FILENAME).'_'.time().'.'.$brochure_ar->getClientOriginalExtension(); 
                    $brochure_destinationPath_ar = public_path('/admin/upload/ceo_brochure/arabic');
                    $brochure_ar->move($brochure_destinationPath_ar, $brochurename_ar);
                } 
                else 
                {
                    $brochurename_ar = $_POST['old_brochure_ar'];
                }
                /* Brochure Ar END */

                $pTitleModelObj->brochure_en = $brochurename;
                $pTitleModelObj->brochure_ar = $brochurename_ar;

                $pTitleModelObj->created_at      = Carbon::now();
                $pTitleModelObj->updated_at      = Carbon::now();

                $save = $pTitleModelObj->save(); 
                
                if($save){
                    return redirect()->route('admin.position.editceopdf')->with('success','Brochure been updated successfully.');;
                
                } else {
                    return redirect()->back()->with('error', 'An error occurred while adding the Brochure');
                }
				
			}
			
		} catch (Exception $e) {
			return redirect()->back()->with('error', $e->getMessage());
        } 
    }

    public function getSubCategory(Request $request)
	{
		$id=$request->cat_id;
        $dataArea['record'] = Category::orderby("id","asc")
        			->select('id','name_en','name_ar','parent_id')
        			->where('parent_id',$id)
        			->get();
        return response()->json($dataArea);            
	}
}