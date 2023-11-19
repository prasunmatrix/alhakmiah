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
use App\Models\News;
use App\Models\NewsBanner;
use App\Models\MediaNews;
use App\Models\PressKit;
use App\Models\BrandGuideline;
use App\Models\PageTitle; 
use App\Models\{MediaTab,MediacenterSeo};
use Session;
use DB;
use File;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Exception;

class NewsController extends Controller
{

    use CommonVariables;
    

    public function __construct() {
        // Variables assign for view page
        $this->shareVariables();
    }
    
    //=================================================================
    /*****************************************************/
    # NewsController
    # Function name : index
    # Author        :
    # Created Date  : NewsController
    # Purpose       : Show the list of the news
    # Params        : 
    /*****************************************************/

	public function index($slug)
	{
        //echo $id; die;

        $data['switch_lang'] = 'AR';
        $data['switch_link'] = 'ar/news-details/'.$slug;
        $data['news']        = News::where(['slug_name'=>$slug,'status'=>'A'])
                                        ->whereNull('deleted_at')
                                        ->first();
        $data['newsBanner']  = NewsBanner::where(['status'=>'1'])
                                        ->first();

        $data['mediacenterSeo'] =  MediacenterSeo::where(['status'=>'A'])->first();                                 
        $mediacenterSeo=$data['mediacenterSeo'];
        $slug='media-center';
        $data['slug_name'] = $slug;
        $metaDetail[$slug]['title'] = $mediacenterSeo->meta_title; 
        $metaDetail[$slug]['meta_descriptions'] = $mediacenterSeo->meta_descriptions;
        $metaDetail[$slug]['meta_keyword'] = $mediacenterSeo->meta_keyword;
        $metaDetail[$slug]['alt_text'] = $mediacenterSeo->alt_text;
        $metaDetail[$slug]['canonical'] = $mediacenterSeo->canonical;

        $data['metaDetail'] = $metaDetail;

	    return view('front/en/news_details/list',$data);

	}

    public function index_ar($slug)
    {  

        $data['switch_lang'] = 'EN';
        $data['switch_link'] = 'news-details/'.$slug;
        $data['news']        =  News::where(['slug_name'=>$slug,'status'=>'A'])
                                         ->whereNull('deleted_at')
                                         ->first();
        $data['newsBanner']  = NewsBanner::where(['status'=>'1'])
                                        ->first();
        
        $data['mediacenterSeo'] =  MediacenterSeo::where(['status'=>'A'])->first();                                 
        $mediacenterSeo=$data['mediacenterSeo'];
        $slug='media-center';
        $data['slug_name'] = $slug;
        $metaDetail[$slug]['title_ar'] = $mediacenterSeo->meta_title_ar; 
        $metaDetail[$slug]['meta_descriptions_ar'] = $mediacenterSeo->meta_descriptions_ar;
        $metaDetail[$slug]['meta_keyword_ar'] = $mediacenterSeo->meta_keyword_ar;
        $metaDetail[$slug]['alt_text_ar'] = $mediacenterSeo->alt_text_ar;
        $metaDetail[$slug]['canonical_ar'] = $mediacenterSeo->canonical_ar;

        $data['metaDetail'] = $metaDetail; 
                                       
       return view('front/ar/news_details/list',$data);

    }


    public function newsListing()
    {  

        $data['switch_lang'] = 'AR';
        $data['switch_link'] = 'ar/media-center';
        $data['news']        =  News::where(['status'=>'A'])
                                         ->whereNull('deleted_at')
                                         /*->orderBy('id','desc')*/
                                         ->orderBy('news_date', 'desc')
                                         ->get();
        $data['mediaNews']        =  MediaNews::where(['status'=>'A'])
                                         ->whereNull('deleted_at')
                                         ->orderBy('id','desc')
                                         ->get();
        $data['pressKits']        =  PressKit::where(['status'=>'A'])
                                         ->whereNull('deleted_at')
                                         ->orderBy('id','desc')
                                         ->get();
        $data['brandGuidelines']        =  BrandGuideline::where(['status'=>'A'])
                                         ->whereNull('deleted_at')
                                         ->orderBy('id','desc')
                                         ->get();
        
        $data['newsBanner']  = NewsBanner::where(['status'=>'1'])
                                         ->first();
        $data['pageTite']  = PageTitle::where(['id'=>'1'])
                                         ->first();                                 
        $data['mediatab']  = MediaTab::where(['id'=>'1'])
                                         ->first();
        
        $data['mediacenterSeo'] =  MediacenterSeo::where(['status'=>'A'])->first();                                 
        $mediacenterSeo=$data['mediacenterSeo'];
        $slug='media-center';
        $data['slug_name'] = $slug;
        $metaDetail[$slug]['title'] = $mediacenterSeo->meta_title; 
        $metaDetail[$slug]['meta_descriptions'] = $mediacenterSeo->meta_descriptions;
        $metaDetail[$slug]['meta_keyword'] = $mediacenterSeo->meta_keyword;
        $metaDetail[$slug]['alt_text'] = $mediacenterSeo->alt_text;
        $metaDetail[$slug]['canonical'] = $mediacenterSeo->canonical;

        $data['metaDetail'] = $metaDetail; 

       return view('front/en/latest_news/index',$data);

    }
    public function newsListingAr()
    {  

        $data['switch_lang'] = 'EN';
        $data['switch_link'] = 'media-center';
        $data['news']        =  News::where(['status'=>'A'])
                                         ->whereNull('deleted_at')
                                         /*->orderBy('id','desc')*/
                                         ->orderBy('news_date', 'desc')
                                         ->get();
        $data['mediaNews']        =  MediaNews::where(['status'=>'A'])
                                         ->whereNull('deleted_at')
                                         ->orderBy('id','desc')
                                         ->get();
        $data['pressKits']        =  PressKit::where(['status'=>'A'])
                                         ->whereNull('deleted_at')
                                         ->orderBy('id','desc')
                                         ->get();
        $data['brandGuidelines']        =  BrandGuideline::where(['status'=>'A'])
                                         ->whereNull('deleted_at')
                                         ->orderBy('id','desc')
                                         ->get();

        $data['newsBanner']  = NewsBanner::where(['status'=>'1'])
                                         ->first();
        $data['pageTite']  = PageTitle::where(['id'=>'1'])
                                         ->first();
        $data['mediatab']  = MediaTab::where(['id'=>'1'])
                                         ->first();

        $data['mediacenterSeo'] =  MediacenterSeo::where(['status'=>'A'])->first();                                 
        $mediacenterSeo=$data['mediacenterSeo'];
        $slug='media-center';
        $data['slug_name'] = $slug;
        $metaDetail[$slug]['title_ar'] = $mediacenterSeo->meta_title_ar; 
        $metaDetail[$slug]['meta_descriptions_ar'] = $mediacenterSeo->meta_descriptions_ar;
        $metaDetail[$slug]['meta_keyword_ar'] = $mediacenterSeo->meta_keyword_ar;
        $metaDetail[$slug]['alt_text_ar'] = $mediacenterSeo->alt_text_ar;
        $metaDetail[$slug]['canonical_ar'] = $mediacenterSeo->canonical_ar;

        $data['metaDetail'] = $metaDetail;

       return view('front/ar/latest_news/index',$data);

    }


    




   

}