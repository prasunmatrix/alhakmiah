<?php

namespace App\Http\Controllers\admin;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\{Blog,BlogBanner};
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

class BlogController extends Controller
{
  public $data= array();
  private static $paginationLimit= 10;

  /*****************************************************/
    # BlogController
    # Function name : blogList
    # Author        :
    # Created Date  : 01-04-2022
    # Purpose       : Blog Listing
    #                 
    #                 
    # Params        : 
    /*****************************************************/

    public function blogList(Request $request){
      $this->data['page_title']="Blog List";
      $this->data['panel_title']="Blog List";
      $searchKeyword = $_GET['q'] ?? '' ;
      $blogObj= Blog::select('*');  
          if(!empty($searchKeyword))
          $blogObj->orWhere('title_en', 'like', '%' .trim($searchKeyword) . '%');
          $blogObj->orWhere('title_ar', 'like', '%' .trim($searchKeyword) . '%');
          $blogObj->whereNull('deleted_at')->orderBy('id','desc')->get();  
     $this->data['blogList']=$blogObj->paginate(self::$paginationLimit);
      
      return view('admin.blog.list',$this->data);
    }


  public function blogAdd (Request $request){
    $this->data['page_title']='Blog Create ';
    $this->data['panel_title']='Blog Create ';
  
    return view('admin.blog.add',$this->data);
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

  public function blogSave(NewsRequest $request){
      //dd($request->all());
      try
      {
          
          if ($request->isMethod('POST'))
          {
          
              $blogModelObj                      = new Blog ;
              $blogModelObj->title_en            = trim($request->title_en, ' ');
              $blogModelObj->title_ar            = trim($request->title_ar, ' ');
              $blogModelObj->slug_name           = Str::slug($request->title_en, '-'); 
              $blogModelObj->description_en      = $request->description_en;
              $blogModelObj->description_ar      = $request->description_ar;
              $blogModelObj->show_in_front      = !empty($request->show_in_front)? $request->show_in_front:'0';
              $blogModelObj->short_description_en      = $request->short_description_en;
              $blogModelObj->short_description_ar      = $request->short_description_ar;
              $blogModelObj->blog_date      = $request->blog_date;
              if($request->file('blog_small_image')) {
                  $files1=$request->file('blog_small_image');
                  $fullFileName1 = time().'.'.$files1->getClientOriginalExtension();
                  //$destinationPath = 'assets/images';
                  //$uploadResponse  = $files1->move($destinationPath,$fullFileName1);
                  //$newsModelObj->slider_1=$fullFileName1; 
                  //$imagename = time().'.'.$upload_file_extention;
                  $destinationPath1 = 'assets/blog-images/small-image';
                  $img =Image::make($request->file('blog_small_image')->getRealPath());

                  $img->resize(405, 405, function ($constraint) {
                      $constraint->aspectRatio();
                  })->save($destinationPath1.'/'.$fullFileName1);

                  //$destinationPath = 'assets/blog-images/small-image';
                  //$files1->move($destinationPath, $fullFileName1);
                  $blogModelObj->blog_small_image=$fullFileName1;
                            
              }
              
              if($request->file('blog_big_image')) {
                  $files=$request->file('blog_big_image');
                  $fullFileName2 = time().'.'.$files->getClientOriginalExtension();
                  $destinationPath2 = 'assets/blog-images/big-image';
                  $img =Image::make($request->file('blog_big_image')->getRealPath());

                  $img->resize(640, 640, function ($constraint) {
                    $constraint->aspectRatio();
                  })->save($destinationPath2.'/'.$fullFileName2);
                  
                  //$destinationPath1 = 'assets/blog-images/big-image';
                  //$uploadResponse  = $files->move($destinationPath,$fullFileName2);
                  $blogModelObj->blog_big_image=$fullFileName2;          
              }
              $blogModelObj->created_at          = Carbon::now();
              $blogModelObj->updated_at          = Carbon::now();
              $save = $blogModelObj->save();            

              if ($save) {
           
                  return redirect()->route('admin.blog.blog.list')->with('success','Blog has been added successfully.');;
              } else {
                  return redirect()->back()->with('error', 'An error occurred while adding the Cms');
              }
              
          }
          
      } catch (Exception $e) {
          return redirect()->back()->with('error', $e->getMessage());
      } 
  }

   /*****************************************************/
  # BlogController
  # Function name : NewsEdit
  # Author        :
  # Created Date  : 20-07-2020
  # Purpose       : News Edit
  #                 
  #                 
  # Params        : 
  /*****************************************************/


  public function blogEdit(Request $request, $encryptString) {
      $this->data['page_title']='Blog Edit';
      $this->data['panel_title']='Blog Edit';
      $blogId = decrypt($encryptString, Config::get('Constant.ENC_KEY')); // get user-id After Decrypt with salt key.
      $this->data['details'] = Blog::findOrFail($blogId);
      $this->data['encryptCode'] = $encryptString;
      //dd($this->data['details']);
      return view('admin.blog.edit',$this->data); 
  }

  /*****************************************************/
  # BlogController
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
              $blogId = !empty($request->encString) ? decrypt($request->encString, Config::get('Constant.ENC_KEY')) : 0;
              
              $blogModelObj =  Blog::findOrFail($blogId);
              $blogModelObj->title_en            = trim($request->title_en, ' ');
              $blogModelObj->title_ar            = trim($request->title_ar, ' ');
              $blogModelObj->slug_name           = Str::slug($request->title_en, '-'); 
              $blogModelObj->description_en      = $request->description_en;
              $blogModelObj->description_ar      = $request->description_ar;
              $blogModelObj->short_description_en      = $request->short_description_en;
              $blogModelObj->short_description_ar      = $request->short_description_ar;
              $blogModelObj->blog_date      = $request->blog_date;
              $blogModelObj->show_in_front      = !empty($request->show_in_front)? $request->show_in_front:'0';
              $blogModelObj->status              = $request->status;
              if($request->file('blog_small_image')) {
                  $files1=$request->file('blog_small_image');
                  $fullFileName1 = time().'.'.$files1->getClientOriginalExtension();
                  $destinationPath1 = 'assets/blog-images/small-image';
                  $img =Image::make($request->file('blog_small_image')->getRealPath());

                  $img->resize(405,405, function ($constraint) {
                      $constraint->aspectRatio();
                  })->save($destinationPath1.'/'.$fullFileName1);
                  //$destinationPath = public_path('assets/orginal-images');
                  //$files1->move($destinationPath, $fullFileName1);
                  $blogModelObj->blog_small_image=$fullFileName1;         
              }
              
              if($request->file('blog_big_image')) {
                $files=$request->file('blog_big_image');
                $fullFileName2 = time().'.'.$files->getClientOriginalExtension();
                $destinationPath2 = 'assets/blog-images/big-image';
                $img =Image::make($request->file('blog_big_image')->getRealPath());

                $img->resize(640, 640, function ($constraint) {
                  $constraint->aspectRatio();
                })->save($destinationPath2.'/'.$fullFileName2);
                
                //$destinationPath1 = 'assets/blog-images/big-image';
                //$uploadResponse  = $files->move($destinationPath,$fullFileName2);
                $blogModelObj->blog_big_image=$fullFileName2;          
              }
              $blogModelObj->created_at          = Carbon::now();
              $blogModelObj->updated_at          = Carbon::now();
              $save = $blogModelObj->save(); 
              if($save){
                  return redirect()->route('admin.blog.blog.list')->with('success','Blog has been updated successfully.');;
              
              } else {
                  return redirect()->back()->with('error', 'An error occurred while adding the Cms');
              }
      
    }
    
  } catch (Exception $e) {
    return redirect()->back()->with('error', $e->getMessage());
      } 
  }

 

  /*****************************************************/
  # BlogController
  # Function name : newsDelete
  # Author        :
  # Created Date  : 31-03-2021
  # Purpose       : News Delete
  #                 
  #                 
  # Params        : 
  /*****************************************************/
  
  public function blogDelete(Request $request,$encryptString)
  {

      $blogId = decrypt($encryptString, Config::get('Constant.ENC_KEY')); // get user-id After Decrypt with salt key.
      $details = Blog::findOrFail($blogId);


      if ($details) {
          $details->deleted_at=Carbon::now();
          $details->save();
          return redirect()->route('admin.blog.blog.list')->with('success','Blog has been deleted successfully!');
      } else {
          $request->session()->flash('alert-danger', 'An error occurred while deleting the Cms list');
           return redirect()->back();
      }
  }

  /*****************************************************/
  # BlogController
  # Function name : resetNewsStatus
  # Author        :
  # Created Date  : 01-04-2021
  # Purpose       : Reset News Status
  #                 
  #                 
  # Params        : 
  /*****************************************************/

  public function resetBlogStatus(Request $request){
  
      $response['has_error']=1;
      $response['msg']="Something went wrong.Please try again later.";

      $blogId = decrypt($request->encryptCode, Config::get('Constant.ENC_KEY')); // get user-id After Decrypt with salt key.

      $blogObj = Blog::findOrFail($blogId);
      $updateStatus = $blogObj->status == 'A' ? 'I' : 'A'; 
      $blogObj->status=$updateStatus;
      $blogObj->updated_at=Carbon::now();
      //$homeObj->updated_by=Auth::guard('admin')->user()->id;
      $saveResponse=$blogObj->save();       
      if($saveResponse){
          $response['has_error']=0;
          $response['msg']="Succressfuuly changed status.";
      }
      return $response;
  }
  public function blogBannerEdit(Request $request) {
    $this->data['page_title']='Blog Banner Edit';
    $this->data['panel_title']='blog Banner Edit';
    $encryptString= encrypt('1', Config::get('Constant.ENC_KEY'));; 
    $bannerId = decrypt($encryptString, Config::get('Constant.ENC_KEY')); // get user-id After Decrypt with salt key.
    $this->data['details'] = BlogBanner::findOrFail($bannerId);
    $this->data['encryptCode'] = $encryptString;
    //dd($this->data['details']);
    return view('admin.blog.banneredit',$this->data); 
  }
  /*****************************************************/
    # BlogController
    # Function name : banner update
    # Author        :
    # Created Date  : 04-04-2022
    # Purpose       :  update
    #                 
    #                 
    # Params        : 
    /*****************************************************/

    public function blogBannerUpdate(Request $request){

      try
      {
        if ($request->isMethod('POST'))
        {
              $serviceId = !empty($request->encString) ? decrypt($request->encString, Config::get('Constant.ENC_KEY')) : 0;
              
              $bannerModelObj =  BlogBanner::findOrFail($serviceId);
     
              $bannerModelObj->status              = '1';
              $bannerModelObj->created_at          = Carbon::now();
              $bannerModelObj->updated_at          = Carbon::now();

              if($request->file('blog_banner')) {

                  $files=$request->file('blog_banner');
                  $fullFileName = time().'.'.$files->getClientOriginalExtension();
                  $destinationPath                  = 'assets/cms/banner_blog';
                  $uploadResponse                   = $files->move($destinationPath,$fullFileName);

                  $bannerModelObj->banner=$fullFileName;
              } 
              $save = $bannerModelObj->save(); 

              
              if($save){
                  return redirect()->route('admin.blog-banner.edit')->with('success','Banner has been updated successfully.');;
              
              } else {
                  return redirect()->back()->with('error', 'An error occurred while adding the Cms');
              }
      
        }
    
      } catch (Exception $e) {
        return redirect()->back()->with('error', $e->getMessage());
      } 
  }

}
