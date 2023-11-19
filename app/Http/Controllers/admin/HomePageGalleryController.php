<?php

namespace App\Http\Controllers\admin;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\HomePageGallery;
use App\Models\HomeImage;
use App\Http\Requests\HomePageGalleryRequest;
use Helper, AdminHelper, Image, Validator,  View;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\CmsExport;
//use Illuminate\Support\Facades\Auth;
use Auth;
use Redirect;
use Carbon\Carbon;
use Yajra\Datatables\Datatables;
use Config;



class HomePageGalleryController extends Controller
{
    public $data= array();
    private static $paginationLimit= 10;


    /*****************************************************/
    # HomePageGalleryController
    # Function name : HomePageGallery
    # Author        :
    # Created Date  : 31-03-2021
    # Purpose       : HomePageGallery Listing
    #                 
    #                 
    # Params        : 
    /*****************************************************/

    public function HomePageGallery(Request $request){
        $this->data['page_title']="Home Page Gallery List";
        $this->data['panel_title']="Home Page Gallery List";
        $searchKeyword = $_GET['q'] ?? '' ;
        $homeObj= HomePageGallery::select('*');  
            if(!empty($searchKeyword))
            $homeObj->orWhere('title_en', 'like', '%' .trim($searchKeyword) . '%');
            $homeObj->orWhere('title_ar', 'like', '%' .trim($searchKeyword) . '%');
            $homeObj->whereNull('deleted_at')->orderBy('id','desc')->get();  
       $this->data['HomePageGallery']=$homeObj->paginate(self::$paginationLimit);
        
        return view('admin.homepagegallery.list',$this->data);
    }


    /*****************************************************/
    # HomePageGalleryController
    # Function name : homeGalleryEdit
    # Author        :
    # Created Date  : 20-07-2020
    # Purpose       : homeGalleryEdit 
    #                 
    #                 
    # Params        : 
    /*****************************************************/


    public function homeGalleryEdit(Request $request) {
        $this->data['page_title']='Home Page Gallery Edit';
        $this->data['panel_title']='Home Page Gallery Edit';
        $encryptString= encrypt('1', Config::get('Constant.ENC_KEY'));; 
        $homePageId = decrypt($encryptString, Config::get('Constant.ENC_KEY')); // get user-id After Decrypt with salt key.
        $this->data['details'] = HomePageGallery::with(['Gallery'])->findOrFail($homePageId);
        $this->data['encryptCode'] = $encryptString;
        //dd($this->data['details']);
        return view('admin.homepagegallery.edit',$this->data); 
    }

   

    /*****************************************************/
    # HomePageGalleryController
    # Function name : home page setting update
    # Author        :
    # Created Date  : 31-03-2021
    # Purpose       : HomePageGallery update
    #                 
    #                 
    # Params        : 
    /*****************************************************/

    public function update(HomePageGalleryRequest $request){
 
        try
        {
        	if ($request->isMethod('POST'))
        	{
                $homePageId = !empty($request->encString) ? decrypt($request->encString, Config::get('Constant.ENC_KEY')) : 0;
                
                $homeModelObj =  HomePageGallery::findOrFail($homePageId);
              
                $homeModelObj->title_en             = trim($request->title_en, ' ');
                $homeModelObj->title_ar             = trim($request->title_ar, ' ');
                $homeModelObj->description_en      = $request->description_en;
                $homeModelObj->description_ar      = $request->description_ar;
                $homeModelObj->status              = 'A';
                $homeModelObj->created_at          = Carbon::now();
                $homeModelObj->updated_at          = Carbon::now();
                $save = $homeModelObj->save();

                $homeImages= HomeImage::where('home_id',$homePageId)->get();
                    foreach($homeImages as $homeImage){
                        if(!empty($request->galleryImage[$homeImage->id]) && $request->galleryImage[$homeImage->id] == "Y" )
                            HomeImage::where(["id"=>$homeImage->id])->update(['is_checked' => 'Y']);
                        else
                            HomeImage::where(["id"=>$homeImage->id])->update(['is_checked' => 'N']);
                    }

                    if($request->file('image')) {
                        $files=$request->file('image');
                        foreach($files as $key=>$file){
                            $file_name =time().'-'.$key;
                            $extension = $file->getClientOriginalExtension();
                            $fullFileName = $file_name.'.'.$extension; 
                            $destinationPath                        = 'assets/cms/gallery';
                            $uploadResponse                         = $file->move($destinationPath,$fullFileName); 

                            $homeImageModelObj= new HomeImage;
                            $homeImageModelObj->home_id=$homeModelObj->id;
                            $homeImageModelObj->image=$fullFileName; 
                            $homeImageModelObj->is_checked = (!empty($request->upload_image[$key]) && $request->upload_image[$key] =='Y' ) ? 'Y' : 'N';
                            $homeImageModelObj->status='A';
                          
                            $homeImageModelObj->created_at               =Carbon::now();
                            $homeImageModelObj->updated_at               =Carbon::now();
                            $saveImages=$homeImageModelObj->save();    
                        }
                    }                     

                if($save){
                    return redirect()->route('admin.home-page-gallery.edit')->with('success','Home page Gallery has been updated successfully.');;
                
                } else {
                    return redirect()->back()->with('error', 'An error occurred while adding the Cms');
                }
				
			}
			
		} catch (Exception $e) {
			return redirect()->back()->with('error', $e->getMessage());
        } 
    }

    

    /*****************************************************/
    # HomePageGalleryController
    # Function name : resetcmsStatus
    # Author        :
    # Created Date  : 20-07-2020
    # Purpose       : Reset Cms Status
    #                 
    #                 
    # Params        : 
    /*****************************************************/

    public function resetGalleryStatus(Request $request){
    
        $response['has_error']=1;
        $response['msg']="Something went wrong.Please try again later.";

        $homeId = decrypt($request->encryptCode, Config::get('Constant.ENC_KEY')); // get user-id After Decrypt with salt key.

        $homeObj = HomePageGallery::findOrFail($homeId);
        $updateStatus = $homeObj->status == 'A' ? 'I' : 'A'; 
        $homeObj->status=$updateStatus;
        $homeObj->updated_at=Carbon::now();

        $saveResponse=$homeObj->save();       
        if($saveResponse){
            $response['has_error']=0;
            $response['msg']="Succressfuuly changed status.";
        }
        return $response;
    }


  
                         
        
  
   /*****************************************************/
    # homeManageController
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
        $homeimageId = decrypt($request->encryptId, Config::get('Constant.ENC_KEY')); // get user-id After Decrypt with salt key.
    
        $homeImageModelObj = HomeImage::findOrFail($homeimageId);
        $saveResponse= $homeImageModelObj->delete();
    
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

}