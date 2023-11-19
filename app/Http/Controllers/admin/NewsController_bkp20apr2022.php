<?php

namespace App\Http\Controllers\admin;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\News;
use App\Models\BrandGuideline;
use App\Models\PressKit;
use App\Models\MediaNews;
use App\Models\CmsImage;
use App\Http\Requests\MediaNewsRequest;
use App\Http\Requests\UpdateNewsMediaRequest;
use App\Http\Requests\UpdatePresskitRequest;
use App\Http\Requests\NewsRequest;
use App\Http\Requests\PressRequest;
use App\Http\Requests\updateNewsRequest;
use App\Http\Requests\BrandGuideLineRequest;
use App\Http\Requests\updateBrandGuidelineRequest;
use Helper, AdminHelper, Image, Validator,  View;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\CmsExport;
use Auth;
use Redirect;
use Carbon\Carbon;
use Yajra\Datatables\Datatables;
use Config;



class NewsController extends Controller
{
    public $data= array();
    private static $paginationLimit= 10;


    /*****************************************************/
    # NewsController
    # Function name : newsList
    # Author        :
    # Created Date  : 20-07-2020
    # Purpose       : news Listing
    #                 
    #                 
    # Params        : 
    /*****************************************************/

    public function newsList(Request $request){
        $this->data['page_title']="News List";
        $this->data['panel_title']="News List";
        $searchKeyword = $_GET['q'] ?? '' ;
        $newsObj= News::select('*');  
            if(!empty($searchKeyword))
            $newsObj->orWhere('title_en', 'like', '%' .trim($searchKeyword) . '%');
            $newsObj->orWhere('title_ar', 'like', '%' .trim($searchKeyword) . '%');
            $newsObj->whereNull('deleted_at')->orderBy('id','desc')->get();  
       $this->data['newsList']=$newsObj->paginate(self::$paginationLimit);
        
        return view('admin.news.list',$this->data);
    }


    public function newsAdd (Request $request){
        $this->data['page_title']='News Create ';
        $this->data['panel_title']='News Create ';
    
        return view('admin.news.add',$this->data);
    }

    /*****************************************************/
    # FaqController
    # Function name : newsSave
    # Author        :
    # Created Date  : 31-03-2021
    # Purpose       : News Save
    #                 
    #                 
    # Params        : 
    /*****************************************************/

    public function newsSave(NewsRequest $request){
        
        try
        {
            
            if ($request->isMethod('POST'))
            {
            
                $newsModelObj                      = new News ;
                $newsModelObj->title_en            = trim($request->title_en, ' ');
                $newsModelObj->title_ar            = trim($request->title_ar, ' ');
                $newsModelObj->slug_name           = Str::slug($request->title_en, '-'); 
                $newsModelObj->description_en      = $request->description_en;
                $newsModelObj->description_ar      = $request->description_ar;
                $newsModelObj->show_in_front      = !empty($request->show_in_front)? $request->show_in_front:'0';
                $newsModelObj->short_description_en      = $request->short_description_en;
                $newsModelObj->short_description_ar      = $request->short_description_ar;
                $newsModelObj->news_date      = $request->news_date;
                if($request->file('slider_1')) {
                    $files1=$request->file('slider_1');
                    $fullFileName1 = time().'.'.$files1->getClientOriginalExtension();
                    //$destinationPath = 'assets/images';
                    //$uploadResponse  = $files1->move($destinationPath,$fullFileName1);
                    //$newsModelObj->slider_1=$fullFileName1; 
                    //$imagename = time().'.'.$upload_file_extention;
                    $destinationPath = public_path('assets/images');
                    $img =Image::make($request->file('slider_1')->getRealPath());

                    $img->resize(405, 405, function ($constraint) {
                        $constraint->aspectRatio();
                    })->save($destinationPath.'/'.$fullFileName1);

                    $destinationPath = public_path('assets/orginal-images');
                    $files1->move($destinationPath, $fullFileName1);
                    $newsModelObj->slider_1=$fullFileName1;
                              
                }
                
                if($request->file('slider_2')) {
                    $files=$request->file('slider_2');
                    $fullFileName2 = time().'.'.$files->getClientOriginalExtension();
                    $destinationPath = 'assets/images';
                    $uploadResponse  = $files->move($destinationPath,$fullFileName2);
                    $newsModelObj->slider_2=$fullFileName2;          
                }
                $newsModelObj->created_at          = Carbon::now();
                $newsModelObj->updated_at          = Carbon::now();
                $save = $newsModelObj->save();            

                if ($save) {
             
                    return redirect()->route('admin.news.news.list')->with('success','News has been added successfully.');;
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
    # Purpose       : News Edit
    #                 
    #                 
    # Params        : 
    /*****************************************************/


    public function newsEdit(Request $request, $encryptString) {
        $this->data['page_title']='News Edit';
        $this->data['panel_title']='News Edit';
        $serviceId = decrypt($encryptString, Config::get('Constant.ENC_KEY')); // get user-id After Decrypt with salt key.
        $this->data['details'] = News::findOrFail($serviceId);
        $this->data['encryptCode'] = $encryptString;
        //dd($this->data['details']);
        return view('admin.news.edit',$this->data); 
    }

    /*****************************************************/
    # NewsController
    # Function name : news update
    # Author        :
    # Created Date  : 31-03-2021
    # Purpose       :  update
    #                 
    #                 
    # Params        : 
    /*****************************************************/

    public function update(updateNewsRequest $request){
        try
        {
        	if ($request->isMethod('POST'))
        	{
                $newsId = !empty($request->encString) ? decrypt($request->encString, Config::get('Constant.ENC_KEY')) : 0;
                
                $newsModelObj =  News::findOrFail($newsId);
                $newsModelObj->title_en            = trim($request->title_en, ' ');
                $newsModelObj->title_ar            = trim($request->title_ar, ' ');
                $newsModelObj->slug_name           = Str::slug($request->title_en, '-'); 
                $newsModelObj->description_en      = $request->description_en;
                $newsModelObj->description_ar      = $request->description_ar;
                $newsModelObj->short_description_en      = $request->short_description_en;
                $newsModelObj->short_description_ar      = $request->short_description_ar;
                $newsModelObj->news_date      = $request->news_date;
                $newsModelObj->show_in_front      = !empty($request->show_in_front)? $request->show_in_front:'0';
                $newsModelObj->status              = $request->status;
                if($request->file('slider_1')) {
                    $files1=$request->file('slider_1');
                    $fullFileName1 = time().'.'.$files1->getClientOriginalExtension();
                    $destinationPath = public_path('assets/images');
                    $img =Image::make($request->file('slider_1')->getRealPath());

                    $img->resize(405,405, function ($constraint) {
                        $constraint->aspectRatio();
                    })->save($destinationPath.'/'.$fullFileName1);
                    $destinationPath = public_path('assets/orginal-images');
                    $files1->move($destinationPath, $fullFileName1);
                    $newsModelObj->slider_1=$fullFileName1;         
                }
                
                if($request->file('slider_2')) {
                    $files=$request->file('slider_2');
            
                    $fullFileName2 = time().'.'.$files->getClientOriginalExtension();
                    $destinationPath2 = 'assets/images';
                    $uploadResponse2  = $files->move($destinationPath2,$fullFileName2);
                    $newsModelObj->slider_2=$fullFileName2; 
                              
                }
                $newsModelObj->created_at          = Carbon::now();
                $newsModelObj->updated_at          = Carbon::now();
                $save = $newsModelObj->save(); 
                if($save){
                    return redirect()->route('admin.news.news.list')->with('success','News has been updated successfully.');;
                
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
    # Purpose       : News Delete
    #                 
    #                 
    # Params        : 
    /*****************************************************/
    
    public function newsDelete(Request $request,$encryptString)
    {

        $serviceId = decrypt($encryptString, Config::get('Constant.ENC_KEY')); // get user-id After Decrypt with salt key.
        $details = News::findOrFail($serviceId);


        if ($details) {
            $details->deleted_at=Carbon::now();
            $details->save();
            return redirect()->route('admin.news.news.list')->with('success','News has been deleted successfully!');
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
    # Purpose       : Reset News Status
    #                 
    #                 
    # Params        : 
    /*****************************************************/

    public function resetNewsStatus(Request $request){
    
        $response['has_error']=1;
        $response['msg']="Something went wrong.Please try again later.";

        $homeId = decrypt($request->encryptCode, Config::get('Constant.ENC_KEY')); // get user-id After Decrypt with salt key.

        $homeObj = News::findOrFail($homeId);
        $updateStatus = $homeObj->status == 'A' ? 'I' : 'A'; 
        $homeObj->status=$updateStatus;
        $homeObj->updated_at=Carbon::now();
        //$homeObj->updated_by=Auth::guard('admin')->user()->id;
        $saveResponse=$homeObj->save();       
        if($saveResponse){
            $response['has_error']=0;
            $response['msg']="Succressfuuly changed status.";
        }
        return $response;
    }

    /*****************************************************/
    # NewsController
    # Function name : MedianewsList
    # Author        :
    # Created Date  : 20-07-2020
    # Purpose       : Media news Listing
    #                 
    #                 
    # Params        : 
    /*****************************************************/

    public function tvChannelList(Request $request){
        $this->data['page_title']="Media News List";
        $this->data['panel_title']="Media News List";
        $searchKeyword = $_GET['q'] ?? '' ;
        $mediaNewsObj= MediaNews::select('*');  
            if(!empty($searchKeyword))
            $mediaNewsObj->orWhere('title_en', 'like', '%' .trim($searchKeyword) . '%');
            $mediaNewsObj->orWhere('title_ar', 'like', '%' .trim($searchKeyword) . '%');
            $mediaNewsObj->whereNull('deleted_at')->orderBy('id','desc')->get();  
       $this->data['mediaNewsList']=$mediaNewsObj->paginate(self::$paginationLimit);
        
        return view('admin.media-news.list',$this->data);
    }


    /*****************************************************/
    # NewsController
    # Function name : MedianewsList
    # Author        :
    # Created Date  : 20-07-2020
    # Purpose       : Media news Listing
    #                 
    #                 
    # Params        : 
    /*****************************************************/

    public function tvChannelAdd(Request $request){
        $this->data['page_title']='Tv Interviews Create ';
        $this->data['panel_title']='Tv Interviews Create';

        return view('admin.media-news.add',$this->data);
    }

     /*****************************************************/
    # FaqController
    # Function name : newsSave
    # Author        :
    # Created Date  : 31-03-2021
    # Purpose       : News Save
    #                 
    #                 
    # Params        : 
    /*****************************************************/

    public function tvChannelSave(MediaNewsRequest $request){
        try
        { 
            if ($request->isMethod('POST'))
            {
                $mediaNewsModelObj                      = new MediaNews ;
                $mediaNewsModelObj->title_en            = trim($request->title_en, ' ');
                $mediaNewsModelObj->title_ar            = trim($request->title_ar, ' '); 
                $mediaNewsModelObj->description_en      = $request->description_en;
                $mediaNewsModelObj->description_ar      = $request->description_ar;
                $mediaNewsModelObj->video_link          = $request->video_link;
                $mediaNewsModelObj->interviews_date          = $request->interviews_date;
                $mediaNewsModelObj->created_at               = Carbon::now();
                $mediaNewsModelObj->updated_at               = Carbon::now();

                if($request->file('video_thumbnail_image')) {
                    $files1=$request->file('video_thumbnail_image');
                    $fullFileName1 = time().'.'.$files1->getClientOriginalExtension();
                    $destinationPath ='admin/upload/media_center';
                    $img =Image::make($request->file('video_thumbnail_image')->getRealPath());
                    $img->resize(729, 401, function ($constraint) {
                        $constraint->aspectRatio();
                    })->save($destinationPath.'/'.$fullFileName1);
                    $files1->move($destinationPath, $fullFileName1);
                    $mediaNewsModelObj->video_thumbnail_image=$fullFileName1;    

                }
                $save = $mediaNewsModelObj->save();            
                if ($save) {
                    return redirect()->route('admin.tv-channels.list')->with('success','Media News has been added successfully.');;
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
    # Function name : mediaNewsEdit
    # Author        :
    # Created Date  : 20-07-2020
    # Purpose       : News Edit
    #                 
    #                 
    # Params        : 
    /*****************************************************/
    public function mediaNewsEdit(Request $request, $encryptString) {
        $this->data['page_title']='Media News Edit';
        $this->data['panel_title']='Media News Edit';
        $mediaNewsId = decrypt($encryptString, Config::get('Constant.ENC_KEY')); // get user-id After Decrypt with salt key.
        $this->data['details'] = MediaNews::findOrFail($mediaNewsId);
        $this->data['encryptCode'] = $encryptString;
        
        return view('admin.media-news.edit',$this->data); 
    }

    /*****************************************************/
    # NewsController
    # Function name : mediaNewsupdate
    # Author        :
    # Created Date  : 31-03-2021
    # Purpose       :  update
    #                 
    #                 
    # Params        : 
    /*****************************************************/

    public function mediaNewsupdate(UpdateNewsMediaRequest $request){

        try
        {
           
        	if ($request->isMethod('POST'))
        	{
                $mediaNewsId = !empty($request->encString) ? decrypt($request->encString, Config::get('Constant.ENC_KEY')) : 0;
                
                $mediaNewsModelObj =  MediaNews::findOrFail($mediaNewsId);
                $mediaNewsModelObj->title_en            = trim($request->title_en, ' ');
                $mediaNewsModelObj->title_ar            = trim($request->title_ar, ' ');
                $mediaNewsModelObj->description_en      = $request->description_en;
                $mediaNewsModelObj->description_ar      = $request->description_ar;
                $mediaNewsModelObj->interviews_date          = $request->interviews_date;
                
                $mediaNewsModelObj->updated_at          = Carbon::now();

                if($request->file('video_thumbnail_image')) {
                    $files1=$request->file('video_thumbnail_image');
                    $fullFileName1 = time().'.'.$files1->getClientOriginalExtension();
                    $destinationPath ='admin/upload/media_center';
                    $img =Image::make($request->file('video_thumbnail_image')->getRealPath());
                    $img->resize(729, 401, function ($constraint) {
                        $constraint->aspectRatio();
                    })->save($destinationPath.'/'.$fullFileName1);
                    $files1->move($destinationPath, $fullFileName1);
                    $mediaNewsModelObj->video_thumbnail_image=$fullFileName1;    

                }
                $save = $mediaNewsModelObj->save(); 
                if($save){
                    return redirect()->route('admin.tv-channels.list')->with('success','Media News has been updated successfully.');;
                
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
    # Purpose       : News Delete
    #                 
    #                 
    # Params        : 
    /*****************************************************/
    
    public function mediaNewsDelete(Request $request,$encryptString)
    {

        $mediaNewsId = decrypt($encryptString, Config::get('Constant.ENC_KEY')); // get user-id After Decrypt with salt key.
        $details = MediaNews::findOrFail($mediaNewsId);
        if ($details) {
            $details->deleted_at=Carbon::now();
            $details->save();
            return redirect()->route('admin.tv-channels.list')->with('success','Media News has been deleted successfully!');
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
    # Purpose       : Reset News Status
    #                 
    #                 
    # Params        : 
    /*****************************************************/

    public function resetMediaNewsStatus(Request $request){
    
        $response['has_error']=1;
        $response['msg']="Something went wrong.Please try again later.";

        $mediaNewsId = decrypt($request->encryptCode, Config::get('Constant.ENC_KEY')); // get user-id After Decrypt with salt key.
        $mediaNewsObj = MediaNews::findOrFail($mediaNewsId);
        $updateStatus = $mediaNewsObj->status == 'A' ? 'I' : 'A'; 
        $mediaNewsObj->status=$updateStatus;
        $mediaNewsObj->updated_at=Carbon::now();
        $saveResponse=$mediaNewsObj->save();       
        if($saveResponse){
            $response['has_error']=0;
            $response['msg']="Succressfuuly changed status.";
        }
        return $response;
    }


    /*****************************************************/
    # NewsController
    # Function name : pressKitList
    # Author        :
    # Created Date  : 20-07-2020
    # Purpose       : press Kit  Listing
    #                 
    #                 
    # Params        : 
    /*****************************************************/

    public function pressKitList(Request $request){
        $this->data['page_title']="Press Kits List";
        $this->data['panel_title']="Press Kits List";
        $searchKeyword = $_GET['q'] ?? '' ;
        $pressKitsObj= PressKit::select('*');  
            if(!empty($searchKeyword))
            $pressKitsObj->orWhere('title_en', 'like', '%' .trim($searchKeyword) . '%');
            $pressKitsObj->orWhere('title_ar', 'like', '%' .trim($searchKeyword) . '%');
            $pressKitsObj->whereNull('deleted_at')->orderBy('id','desc')->get();  
       $this->data['pressKitsList']=$pressKitsObj->paginate(self::$paginationLimit);
        
        return view('admin.press-kit.list',$this->data);
    }


    /*****************************************************/
    # NewsController
    # Function name : MedianewsList
    # Author        :
    # Created Date  : 20-07-2020
    # Purpose       : Media news Listing
    #                 
    #                 
    # Params        : 
    /*****************************************************/

    public function pressKitAdd(Request $request){
        $this->data['page_title']='Press Kits Create ';
        $this->data['panel_title']='Press Kits Create';

        return view('admin.press-kit.add',$this->data);
    }

    /*****************************************************/
    # FaqController
    # Function name : newsSave
    # Author        :
    # Created Date  : 31-03-2021
    # Purpose       : News Save
    #                 
    #                 
    # Params        : 
    /*****************************************************/

    public function pressKitSave(PressRequest $request){
        try
        { 
            if ($request->isMethod('POST'))
            {
                $pressKitModelObj                      = new PressKit ;
                $pressKitModelObj->title_en            = trim($request->title_en, ' ');
                $pressKitModelObj->title_ar            = trim($request->title_ar, ' '); 
                if($request->file('press_image')) {
                    $files1=$request->file('press_image');
                    $fullFileName1 = time().'.'.$files1->getClientOriginalExtension();
                    $destinationPath = 'assets/press-kit-images';
                    $uploadResponse  = $files1->move($destinationPath,$fullFileName1);
                    $pressKitModelObj->press_image=$fullFileName1; 
                              
                }
                $pressKitModelObj->format_en            = $request->format_en;
                $pressKitModelObj->format_ar            = $request->format_ar;
                $pressKitModelObj->created_at               = Carbon::now();
                $pressKitModelObj->updated_at               = Carbon::now();
                //dd($pressKitModelObj->$request);
                $save = $pressKitModelObj->save();            
                if ($save) {
                    return redirect()->route('admin.press-kits.list')->with('success','Presskits has been added successfully.');;
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
    # Function name : mediaNewsEdit
    # Author        :
    # Created Date  : 20-07-2020
    # Purpose       : News Edit
    #                 
    #                 
    # Params        : 
    /*****************************************************/
    public function pressKitEdit(Request $request, $encryptString) {
        $this->data['page_title']='Press kits Edit';
        $this->data['panel_title']='Press kits Edit';
        $pressKitId = decrypt($encryptString, Config::get('Constant.ENC_KEY')); // get user-id After Decrypt with salt key.
        $this->data['details'] = PressKit::findOrFail($pressKitId);
        $this->data['encryptCode'] = $encryptString;
        
        return view('admin.press-kit.edit',$this->data); 
    }

    /*****************************************************/
    # NewsController
    # Function name : mediaNewsupdate
    # Author        :
    # Created Date  : 31-03-2021
    # Purpose       :  update
    #                 
    #                 
    # Params        : 
    /*****************************************************/

    public function pressKitupdate(UpdatePresskitRequest $request){

        try
        {
        	if ($request->isMethod('POST'))
        	{
                $pressKitId = !empty($request->encString) ? decrypt($request->encString, Config::get('Constant.ENC_KEY')) : 0;
                
                $pressKitModelObj = PressKit::findOrFail($pressKitId);
                $pressKitModelObj->title_en            = trim($request->title_en, ' ');
                $pressKitModelObj->title_ar            = trim($request->title_ar, ' ');
                if($request->file('press_image')) {
                    $files1=$request->file('press_image');
                    $fullFileName1 = time().'.'.$files1->getClientOriginalExtension();
                    $destinationPath = 'assets/press-kit-images';
                    $uploadResponse  = $files1->move($destinationPath,$fullFileName1);
                    $pressKitModelObj->press_image=$fullFileName1; 
                              
                }
                $pressKitModelObj->format_en            = $request->format_en;
                $pressKitModelObj->format_ar            = $request->format_ar;
                $pressKitModelObj->updated_at          = Carbon::now();
                $save = $pressKitModelObj->save(); 
                if($save){
                    return redirect()->route('admin.press-kits.list')->with('success','Press Kit has been updated successfully.');;
                
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
    # Purpose       : News Delete
    #                 
    #                 
    # Params        : 
    /*****************************************************/
    
    public function pressKitDelete(Request $request,$encryptString)
    {

        $pressKitId = decrypt($encryptString, Config::get('Constant.ENC_KEY')); // get user-id After Decrypt with salt key.
        $details = PressKit::findOrFail($pressKitId);
        if ($details) {
            $details->deleted_at=Carbon::now();
            $details->save();
            return redirect()->route('admin.press-kits.list')->with('success','Press Kit has been deleted successfully!');
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
    # Purpose       : Reset News Status
    #                 
    #                 
    # Params        : 
    /*****************************************************/

    public function pressKitStatus(Request $request){
    
        $response['has_error']=1;
        $response['msg']="Something went wrong.Please try again later.";

        $pressKitId = decrypt($request->encryptCode, Config::get('Constant.ENC_KEY')); // get user-id After Decrypt with salt key.
        $pressKitModelObj = PressKit::findOrFail($pressKitId);
        $updateStatus = $pressKitModelObj->status == 'A' ? 'I' : 'A'; 
        $pressKitModelObj->status=$updateStatus;
        $pressKitModelObj->updated_at=Carbon::now();
        $saveResponse=$pressKitModelObj->save();       
        if($saveResponse){
            $response['has_error']=0;
            $response['msg']="Succressfuuly changed status.";
        }
        return $response;
    }
 
    /*****************************************************/
    # NewsController
    # Function name : brandGuidelineList
    # Author        :
    # Created Date  : 20-07-2020
    # Purpose       : BrandGuideline  Listing
    #                 
    #                 
    # Params        : 
    /*****************************************************/

    public function brandGuidelineList(Request $request){
        $this->data['page_title']="Brand Guideline List";
        $this->data['panel_title']="Brand Guideline List";
        $searchKeyword = $_GET['q'] ?? '' ;
        $brandguidelineObj= BrandGuideline::select('*');  
            if(!empty($searchKeyword))
            $brandguidelineObj->orWhere('title_en', 'like', '%' .trim($searchKeyword) . '%');
            $brandguidelineObj->orWhere('title_ar', 'like', '%' .trim($searchKeyword) . '%');
            $brandguidelineObj->whereNull('deleted_at')->orderBy('id','desc')->get();  
       $this->data['brandGuidelineList']=$brandguidelineObj->paginate(self::$paginationLimit);
        
        return view('admin.brand-guideline.list',$this->data);
    }

    /*****************************************************/
    # NewsController
    # Function name : MedianewsList
    # Author        :
    # Created Date  : 20-07-2020
    # Purpose       : Media news Listing
    #                 
    #                 
    # Params        : 
    /*****************************************************/

    public function brandGuidelineAdd(Request $request){
        $this->data['page_title']='Brand Guideline Create ';
        $this->data['panel_title']='Brand Guideline Create';

        return view('admin.brand-guideline.add',$this->data);
    }

    /*****************************************************/
    # FaqController
    # Function name : newsSave
    # Author        :
    # Created Date  : 31-03-2021
    # Purpose       : News Save
    #                 
    #                 
    # Params        : 
    /*****************************************************/

    public function brandGuidelineSave(Request $request){
        try
        { 
            if ($request->isMethod('POST'))
            {
                $brandGuidelineModelObj                      = new BrandGuideline ;
                $brandGuidelineModelObj->title_en            = trim($request->title_en, ' ');
                $brandGuidelineModelObj->title_ar            = trim($request->title_ar, ' '); 
          
                if($request->file('media')) {
                    $files1=$request->file('media');
                    $fullFileName1 = time().'.'.$files1->getClientOriginalExtension();
                    $destinationPath = 'assets/media_mp3_upload';
                    $uploadResponse  = $files1->move($destinationPath,$fullFileName1);
                    $brandGuidelineModelObj->media=$fullFileName1; 
                              
                }
                if($request->file('thumbnail_image')) {
                    $files2=$request->file('thumbnail_image');
                    $fullFileName2 = time().'.'.$files2->getClientOriginalExtension();
                    $destinationPath1 = 'assets/brand_guideline_images';
                    $uploadResponse  = $files2->move($destinationPath1,$fullFileName2);
                    $brandGuidelineModelObj->thumbnail_image=$fullFileName2; 
                              
                }

                if($request->file('pdf_upload')) {
                    $files3=$request->file('pdf_upload');
                    $fullFileName3 = time().'.'.$files3->getClientOriginalExtension();
                    $destinationPath2 = 'assets/brand-guidelines-pdf';
                    $uploadResponse  = $files3->move($destinationPath2,$fullFileName3);
                    $brandGuidelineModelObj->pdf_upload=$fullFileName3; 
                              
                }
            
                $brandGuidelineModelObj->created_at               = Carbon::now();
                $brandGuidelineModelObj->updated_at               = Carbon::now();
                //dd($pressKitModelObj->$request);
                $save = $brandGuidelineModelObj->save();            
                if ($save) {
                    return redirect()->route('admin.brand-guideline.list')->with('success','Brand GuideLine has been added successfully.');;
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
    # Function name : mediaNewsEdit
    # Author        :
    # Created Date  : 20-07-2020
    # Purpose       : News Edit
    #                 
    #                 
    # Params        : 
    /*****************************************************/
    public function brandGuidelineEdit(Request $request, $encryptString) {
        $this->data['page_title']='Brand Guideline Edit';
        $this->data['panel_title']='Brand Guideline Edit';
        $brandGuidelineId = decrypt($encryptString, Config::get('Constant.ENC_KEY')); // get user-id After Decrypt with salt key.
        $this->data['details'] = BrandGuideline::findOrFail($brandGuidelineId);
        $this->data['encryptCode'] = $encryptString;
        
        return view('admin.brand-guideline.edit',$this->data); 
    }


    /*****************************************************/
    # NewsController
    # Function name : mediaNewsupdate
    # Author        :
    # Created Date  : 31-03-2021
    # Purpose       :  update
    #                 
    #                 
    # Params        : 
    /*****************************************************/

    public function brandGuidelineupdate(updateBrandGuidelineRequest $request){

        try
        {
        	if ($request->isMethod('POST'))
        	{
                $brandGuidelineId = !empty($request->encString) ? decrypt($request->encString, Config::get('Constant.ENC_KEY')) : 0;
                
                $brandGuidelineModelObj = BrandGuideline::findOrFail($brandGuidelineId);
                $brandGuidelineModelObj->title_en            = trim($request->title_en, ' ');
                $brandGuidelineModelObj->title_ar            = trim($request->title_ar, ' ');
               
                if($request->file('media')) {
                    $files1=$request->file('media');
                    $fullFileName1 = time().'.'.$files1->getClientOriginalExtension();
                    $destinationPath = 'assets/media_mp3_upload';
                    $uploadResponse  = $files1->move($destinationPath,$fullFileName1);
                    $brandGuidelineModelObj->media=$fullFileName1; 
                              
                }
                if($request->file('thumbnail_image')) {
                    $files2=$request->file('thumbnail_image');
                    $fullFileName2 = time().'.'.$files2->getClientOriginalExtension();
                    $destinationPath1 = 'assets/brand_guideline_images';
                    $uploadResponse  = $files2->move($destinationPath1,$fullFileName2);
                    $brandGuidelineModelObj->thumbnail_image=$fullFileName2; 
                              
                }

                if($request->file('pdf_upload')) {
                    $files3=$request->file('pdf_upload');
                    $fullFileName3 = time().'.'.$files3->getClientOriginalExtension();
                    $destinationPath2 = 'assets/brand-guidelines-pdf';
                    $uploadResponse  = $files3->move($destinationPath2,$fullFileName3);
                    $brandGuidelineModelObj->pdf_upload=$fullFileName3; 
                              
                }
                $brandGuidelineModelObj->updated_at          = Carbon::now();
                $save = $brandGuidelineModelObj->save(); 
                if($save){
                    return redirect()->route('admin.brand-guideline.list')->with('success','Press Kit has been updated successfully.');;
                
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
    # Purpose       : News Delete
    #                 
    #                 
    # Params        : 
    /*****************************************************/
    
    public function brandGuidelineDelete(Request $request,$encryptString)
    {
        $brandGuidelineId = decrypt($encryptString, Config::get('Constant.ENC_KEY')); // get user-id After Decrypt with salt key.
        $details = BrandGuideline::findOrFail($brandGuidelineId);
        if ($details) {
            $details->deleted_at=Carbon::now();
            $details->save();
            return redirect()->route('admin.brand-guideline.list')->with('success','Brand Guiline has been deleted successfully!');
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
    # Purpose       : Reset News Status
    #                 
    #                 
    # Params        : 
    /*****************************************************/

    public function brandGuidelineStatus(Request $request){
    
        $response['has_error']=1;
        $response['msg']="Something went wrong.Please try again later.";

        $brandGuidelineId = decrypt($request->encryptCode, Config::get('Constant.ENC_KEY')); // get user-id After Decrypt with salt key.
        $brandGuidelineModelObj = BrandGuideline::findOrFail($brandGuidelineId);
        $updateStatus = $brandGuidelineModelObj->status == 'A' ? 'I' : 'A'; 
        $brandGuidelineModelObj->status=$updateStatus;
        $brandGuidelineModelObj->updated_at=Carbon::now();
        $saveResponse=$brandGuidelineModelObj->save();       
        if($saveResponse){
            $response['has_error']=0;
            $response['msg']="Succressfuuly changed status.";
        }
        return $response;
    }

}