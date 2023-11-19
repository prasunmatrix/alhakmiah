<?php

namespace App\Http\Controllers\front;

use App;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Helper, AdminHelper, Image, Auth, Hash, Redirect, Validator, View;
use Illuminate\Support\Facades\File as FileSystem;
use App\Models\Timezone;
use App\Traits\CommonVariables;
use Config;
use Carbon\Carbon;
use App\Models\User;
use App\Models\Banner;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Position;
use App\Models\HomePageSetting;
use App\Models\HomePageGallery;
use App\Models\HomeImage;
use App\Models\Service;
use App\Models\News;
use App\Models\Project;
use App\Models\Cms; 
use App\Models\Social;
use App\Models\OurAchievement;
use Session;
use DB;
use File;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Exception;

class FrontController extends Controller
{

    use CommonVariables;
    

    public function __construct() {
        // Variables assign for view page
        $this->shareVariables();
    }

      public function fonttest()
    {  
        $pageData = array();

        $pageData['switch_lang'] = '';
        $pageData['switch_link'] = '';
        
        // $projectData['page_title']="Project Management";
        // $projectData['panel_title']="Project Management";
        return view('front/en/home/fonttest',$pageData);

    }
    
    //=================================================================
    /*****************************************************/
    # FrontController
    # Function name : index
    # Author        :
    # Created Date  : FrontController
    # Purpose       : Show the list of the projects
    # Params        : 
    /*****************************************************/

	public function index()
	{
        
        $data['switch_lang']     =  'AR';
        $data['switch_link']     =  '';
       $data['banners']  =  Banner::where(['status'=>'1'])->whereNull('deleted_at')->orderBy('id', 'desc')->get();
        $data['homePageSetting'] =  HomePageSetting::where(['status'=>'A'])
                                                ->whereNull('deleted_at')
                                                ->first();
        $data['homePageGallery'] =  HomePageGallery::where(['status'=>'A'])
                                                ->whereNull('deleted_at')
                                                ->first();
        $data['homeGallery']     =  HomeImage::where(['is_checked'=>'N','status'=>'A'])
                                                ->whereNull('deleted_at')
                                                ->get();
        $data['homeService']     =  Service::where(['status'=>'A'])
	                                            ->whereNull('deleted_at')
	                                            ->orderBy('id', 'desc')
                                                ->where('show_in_front','=','1')
                                                ->take(3)
	                                            ->get();
       

        $data['homeNews']        =  News::where(['status'=>'A'])
                                         ->whereNull('deleted_at')
                                         ->orderBy('news_date', 'desc')
                                         ->take(3)
                                         ->get();

        $data['homeNewSliders']  =  OurAchievement::where(['status'=>'A'])
                                         ->whereNull('deleted_at')
                                         ->orderBy('id', 'desc')
                                         ->get();

        $data['homeProject']     =  Project::where(['status'=>'1','featured'=>'1'])
                                            ->whereNull('deleted_at')
                                            ->first();
        $data['socialLink']     =  Social::where(['status'=>'A'])
                                            ->whereNull('deleted_at')
                                            ->get();

        $homePageSetting=$data['homePageSetting'];
        $slug='home';
        $data['slug_name'] = $slug;
        $metaDetail[$slug]['title'] = $homePageSetting->meta_title; 
        $metaDetail[$slug]['meta_descriptions'] = $homePageSetting->meta_descriptions;
        $metaDetail[$slug]['meta_keyword'] = $homePageSetting->meta_keyword;
        $metaDetail[$slug]['alt_text'] = $homePageSetting->alt_text;
        $metaDetail[$slug]['canonical'] = $homePageSetting->canonical;

        $data['metaDetail'] = $metaDetail; 
        
	    return view('front/en/home/index',$data);

	}

    public function index_ar()
    { 
        
        $data['switch_lang']     = 'EN';
        $data['switch_link']     = 'en/home';
        $data['homePageSetting'] =  HomePageSetting::where(['status'=>'A'])
                                               ->whereNull('deleted_at')
                                               ->first();
        $data['homePageGallery'] =  HomePageGallery::where(['status'=>'A'])
                                               ->whereNull('deleted_at')
                                               ->first();
        $data['banners']        =  Banner::where(['status'=>'1'])
                                                ->whereNull('deleted_at')
                                                ->orderBy('id', 'desc')
                                                ->get();
      
        $data['homeGallery']     =  HomeImage::where(['is_checked'=>'N','status'=>'A'])
                                             ->whereNull('deleted_at')
                                             ->get();
        $data['homeService']     =  Service::where(['status'=>'A'])
                                             ->whereNull('deleted_at')
                                             ->orderBy('id', 'desc')
                                             ->where('show_in_front','=','1')
                                             ->take(3)
                                             ->get();
                                             
        $data['homeNews']        =  News::where(['status'=>'A'])
	                                         ->whereNull('deleted_at')
	                                         ->orderBy('news_date', 'desc')
                                             ->take(3)
	                                         ->get();
        $data['homeNewSliders']  =  OurAchievement::where(['status'=>'A'])
                                             ->whereNull('deleted_at')
                                             ->orderBy('id', 'desc')
                                             ->get();
                                             
        $data['homeProject']     =  Project::where(['status'=>'1','featured'=>'1'])
                                             ->whereNull('deleted_at')
                                             ->first();
        $data['socialLink']     =  Social::where(['status'=>'A'])
                                            ->whereNull('deleted_at')
                                            ->get();
        
                                            $homePageSetting=$data['homePageSetting'];
        $slug='home';
        $data['slug_name'] = $slug;
        $metaDetail[$slug]['title_ar'] = $homePageSetting->meta_title_ar;
        $metaDetail[$slug]['meta_descriptions_ar'] = $homePageSetting->meta_descriptions_ar;
        $metaDetail[$slug]['meta_keyword_ar'] = $homePageSetting->meta_keyword_ar;
        $metaDetail[$slug]['alt_text_ar'] = $homePageSetting->alt_text_ar;
        $metaDetail[$slug]['canonical_ar'] = $homePageSetting->canonical_ar;

        $data['metaDetail'] = $metaDetail;       
        
       return view('front/ar/home/index',$data);

    }

    public function pages($getPages){

        $data['slug_name'] = $getPages;

        $data['switch_lang'] = 'AR';
        $data['switch_link'] = 'cms/'.$getPages.'';

        $data['cmsPage']     =  Cms::where(['slug_name'=>$getPages,'status'=>'A'])
                                    ->whereNull('deleted_at')
                                    ->first();
                                    
        $data['brandlist']  =  Brand::where(['status'=>'A'])
                                    ->whereNull('deleted_at')
                                    ->orderBy('id','desc')
                                    ->get();
        /*$data['category']    =  Category::where(['status'=>'A'])
                                    ->whereNull('deleted_at')
                                    ->get();   
                                    
        $data['position']    =  Position::where(['status'=>'A'])
                                    ->whereNull('deleted_at')
                                    ->get();*/               

        $category_id = '';
        if( $getPages=='board-of-directors'){
            $category_id = 1;
        } 
        if( $getPages=='executive-management'){
            $category_id = 2;
        }
        if( $getPages=='company-committes'){
            $category_id = 12;
        }
        if( $getPages=='ceo-message'){
            $category_id = 22;
        }
        
        $data['category']    =  Category::where(['status'=>'A'])
                                ->whereNull('deleted_at');
        if(!empty($category_id)){
            $data['category'] = $data['category']->where('id',$category_id);
        }
        $data['category'] = $data['category']->get();   

        $data['position']    =  Position::where(['status'=>'A'])
                                ->whereNull('deleted_at');
        if(!empty($category_id)){
            $data['position'] = $data['position']->where('cat_id',$category_id)->where('subcat_id',0);
        }
        $data['position'] = $data['position']->get(); 

        $data['sub_position']    =  Position::where(['status'=>'A'])
        ->whereNull('deleted_at');
        if(!empty($category_id)){
        $data['sub_position'] = $data['sub_position']->where('cat_id',$category_id)->where('subcat_id','!=',0);
        }
        $data['sub_position'] = $data['sub_position']->get(); 
        
        $subcategories = [];
        if(!empty($category_id)){
            $subcategories = Category::where(['status'=>'A'])
                                ->where('parent_id',$category_id)
                                ->whereNull('deleted_at')
                                ->get(); 
        }
        $data['subcategories'] =  $subcategories;       

        return view('front/en/pages/index',$data);
        
    }

    
    public function pages_ar($getPages){

        $data['slug_name'] = $getPages;
        
        $data['switch_lang'] = 'EN';
        $data['switch_link'] = 'en/cms/'.$getPages.'';

        $data['cmsPage']     =  Cms::where(['slug_name'=>$getPages,'status'=>'A'])
                                    ->whereNull('deleted_at')
                                    ->first();
        $data['brandlist']  =  Brand::where(['status'=>'A'])
                                    ->whereNull('deleted_at')
                                    ->orderBy('id','desc')
                                    ->get();
        /*$data['category']    =  Category::where(['status'=>'A'])
                                    ->whereNull('deleted_at')
                                    ->get();   

        $data['position']    =  Position::where(['status'=>'A'])
                                    ->whereNull('deleted_at')
                                    ->get();*/   
        $category_id = '';
        if( $getPages=='board-of-directors'){
            $category_id = 1;
        } 
        if( $getPages=='executive-management'){
            $category_id = 2;
        }
        if( $getPages=='company-committes'){
            $category_id = 12;
        }
        if( $getPages=='ceo-message'){
            $category_id = 22;
        }
        
        $data['category']    =  Category::where(['status'=>'A'])
                                ->whereNull('deleted_at');
        if(!empty($category_id)){
            $data['category'] = $data['category']->where('id',$category_id);
        }
        $data['category'] = $data['category']->get();   

        $data['position']    =  Position::where(['status'=>'A'])
                                ->whereNull('deleted_at');
        if(!empty($category_id)){
            $data['position'] = $data['position']->where('cat_id',$category_id)->where('subcat_id',0);
        }
        $data['position'] = $data['position']->get(); 

        $data['sub_position']    =  Position::where(['status'=>'A'])
        ->whereNull('deleted_at');
        if(!empty($category_id)){
        $data['sub_position'] = $data['sub_position']->where('cat_id',$category_id)->where('subcat_id','!=',0);
        }
        $data['sub_position'] = $data['sub_position']->get(); 
        
        $subcategories = [];
        if(!empty($category_id)){
            $subcategories = Category::where(['status'=>'A'])
                                ->where('parent_id',$category_id)
                                ->whereNull('deleted_at')
                                ->get(); 
        }
        $data['subcategories'] =  $subcategories; 

        return view('front/ar/pages/index',$data);
        
    }



   

}