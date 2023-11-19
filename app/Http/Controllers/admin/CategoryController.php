<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\User;
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

class CategoryController extends Controller
{

    public $data= array();
    private static $paginationLimit= 10;


    /*****************************************************/
    # CategoryController
    # Function name : categoryList
    # Author        :
    # Created Date  : 13-07-2021
    # Purpose       : Category List
    #                 
    #                 
    # Params        : 
    /*****************************************************/

    public function categoryList(Request $request){
        $this->data['page_title']="Category List";
        $this->data['panel_title']="Category List";
        $searchKeyword = $_GET['q'] ?? '' ;
        $catObj= Category::select('*');  
            if(!empty($searchKeyword))
            $catObj->orWhere('name_en', 'like', '%' .trim($searchKeyword) . '%');
            $catObj->orWhere('name_ar', 'like', '%' .trim($searchKeyword) . '%');
            $catObj->whereNull('deleted_at')->orderBy('id','desc')->get();  
       //$this->data['categoryList']=$catObj->paginate(self::$paginationLimit);
       $categoryList=$catObj->paginate(self::$paginationLimit);

       foreach($categoryList as $key=> $cat)
       {
            //get parent
            $categoryList[$key]['parentName']='N.A';
            if(!empty($cat->parent_id))
            {
                $parentDetails=Category::select('*')->where('id',$cat->parent_id)->first();
                $categoryList[$key]['parentName']= $parentDetails->name_en;
            }
       } 

       $this->data['categoryList']=$categoryList;

        return view('admin.category.list',$this->data);
    }


    public function categoryAdd (Request $request){
        $this->data['page_title']='Category Create ';
        $this->data['panel_title']='Category Create ';
        $this->data['categories'] = Category::where('parent_id','=','0')->where('status','=','A')->get();
        return view('admin.category.add',$this->data);
    }

    public function categorySave (Request $request){
    try
        {
        	if ($request->isMethod('POST'))
        	{
                $catModelObj                 = new Category ;
                $catModelObj->name_en       = trim($request->name_en, ' ');
                $catModelObj->name_ar       = trim($request->name_ar, ' ');
                $catModelObj->parent_id     = $request->parentcategory;
                $catModelObj->status        = $request->status;
                $catModelObj->created_at    = Carbon::now();
                $catModelObj->updated_at    = Carbon::now();

                $save = $catModelObj->save();            

                if ($save) {
             
                    return redirect()->route('admin.category.list')->with('success','Category has been added successfully.');;
                } else {
                    return redirect()->back()->with('error', 'An error occurred while adding the Category');
                }
				
			}
			
		} catch (Exception $e) {
			return redirect()->back()->with('error', $e->getMessage());
        } 
    }


    public function categoryEdit(Request $request, $encryptString) {
        $this->data['page_title']='Category Edit';
        $this->data['panel_title']='Category Edit';
        $catId = decrypt($encryptString, Config::get('Constant.ENC_KEY')); // get user-id After Decrypt with salt key.
        $this->data['details'] = Category::findOrFail($catId);
        $this->data['encryptCode'] = $encryptString;
        $this->data['categories'] = Category::where('parent_id','=','0')->where('status','=','A')->get();
        //dd($this->data['details']);
        return view('admin.category.edit',$this->data); 
    }

    /*****************************************************/
    # FaqController
    # Function name : category update
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
                $catId = !empty($request->encString) ? decrypt($request->encString, Config::get('Constant.ENC_KEY')) : 0;
                
                $catModelObj =  Category::findOrFail($catId);
                $catModelObj->name_en            = trim($request->name_en, ' ');
                $catModelObj->name_ar            = trim($request->name_ar, ' ');
                $catModelObj->parent_id          = $request->parentcategory;
                $catModelObj->status             = $request->status;
                $catModelObj->created_at         = Carbon::now();
                $catModelObj->updated_at         = Carbon::now();
                $save = $catModelObj->save(); 

                
                if($save){
                    return redirect()->route('admin.category.list')->with('success','Category has been updated successfully.');;
                
                } else {
                    return redirect()->back()->with('error', 'An error occurred while adding the Category');
                }
                
            }
            
        } catch (Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        } 
    }


    public function categoryDelete(Request $request,$encryptString)
    {

        $catId = decrypt($encryptString, Config::get('Constant.ENC_KEY')); // get user-id After Decrypt with salt key.
        $details = Category::findOrFail($catId);

        if ($details) {
            $details->deleted_at=Carbon::now();
            $details->save();
            return redirect()->route('admin.category.list')->with('success','Category has been deleted successfully!');
        } else {
            $request->session()->flash('alert-danger', 'An error occurred while deleting the Category list');
             return redirect()->back();
        }
    }


    public function resetcategoryStatus(Request $request){
    
        $response['has_error']=1;
        $response['msg']="Something went wrong.Please try again later.";

        $catId = decrypt($request->encryptCode, Config::get('Constant.ENC_KEY')); // get user-id After Decrypt with salt key.

        $catModelObj = Category::findOrFail($catId);
        $updateStatus = $catModelObj->status == 'A' ? 'I' : 'A'; 
        $catModelObj->status=$updateStatus;
        $catModelObj->updated_at=Carbon::now();
        $saveResponse=$catModelObj->save();       
        if($saveResponse){
            $response['has_error']=0;
            $response['msg']="Successfully changed status.";
        }
        return $response;
    }
    
}
