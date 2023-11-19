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
use App\Models\{News,Blog};
use App\Models\BlogBanner;
use App\Models\MediaNews;
use App\Models\PressKit;
use App\Models\BrandGuideline;
use App\Models\PageTitle; 
use App\Models\{MediaTab,BlogSeo};
use Session;
use DB;
use File;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Exception;

class BlogController extends Controller
{
  use CommonVariables;
    

  public function __construct() {
      // Variables assign for view page
      $this->shareVariables();
  }

  //=================================================================
    /*****************************************************/
    # BlogController
    # Function name : index
    # Author        :
    # Created Date  : BlogController
    # Purpose       : Show the list of the news
    # Params        : 
    /*****************************************************/

	public function index($slug)
	{
        //echo $id; die;

        $data['switch_lang'] = 'AR';
        $data['switch_link'] = 'blog-details/'.$slug;
        $data['blog']        = Blog::where(['slug_name'=>$slug,'status'=>'A'])
                                        ->whereNull('deleted_at')
                                        ->first();
        $data['blogBanner']  = BlogBanner::where(['status'=>'1'])
                                        ->first();

        $data['blogSeo'] =  BlogSeo::where(['status'=>'A'])->first();                                 
        $blogSeo=$data['blogSeo'];
        $slug='blog';
        $data['slug_name'] = $slug;
        $metaDetail[$slug]['title'] = $blogSeo->meta_title; 
        $metaDetail[$slug]['meta_descriptions'] = $blogSeo->meta_descriptions;
        $metaDetail[$slug]['meta_keyword'] = $blogSeo->meta_keyword;
        $metaDetail[$slug]['alt_text'] = $blogSeo->alt_text;
        $metaDetail[$slug]['canonical'] = $blogSeo->canonical;

        $data['metaDetail'] = $metaDetail;

	    return view('front/en/blog/blogdetails',$data);

	}

    public function index_ar($slug)
    {  

        $data['switch_lang'] = 'EN';
        $data['switch_link'] = 'en/blog-details/'.$slug;
        $data['blog']        =  Blog::where(['slug_name'=>$slug,'status'=>'A'])
                                         ->whereNull('deleted_at')
                                         ->first();
        $data['blogBanner']  = BlogBanner::where(['status'=>'1'])
                                        ->first();
        
        $data['blogSeo'] =  BlogSeo::where(['status'=>'A'])->first();                                 
        $blogSeo=$data['blogSeo'];
        $slug='blog';
        $data['slug_name'] = $slug;
        $metaDetail[$slug]['title_ar'] = $blogSeo->meta_title_ar; 
        $metaDetail[$slug]['meta_descriptions_ar'] = $blogSeo->meta_descriptions_ar;
        $metaDetail[$slug]['meta_keyword_ar'] = $blogSeo->meta_keyword_ar;
        $metaDetail[$slug]['alt_text_ar'] = $blogSeo->alt_text_ar;
        $metaDetail[$slug]['canonical_ar'] = $blogSeo->canonical_ar;

        $data['metaDetail'] = $metaDetail; 
                                       
       return view('front/ar/blog/blogdetails',$data);

    }


    public function blogListing()
    {  

        $data['switch_lang'] = 'AR';
        $data['switch_link'] = 'blog';
        $data['blog']        =  Blog::where(['status'=>'A'])
                                         ->whereNull('deleted_at')
                                         /*->orderBy('id','desc')*/
                                         ->orderBy('blog_date', 'desc')
                                         ->get();
        // $data['mediaNews']        =  MediaNews::where(['status'=>'A'])
        //                                  ->whereNull('deleted_at')
        //                                  ->orderBy('id','desc')
        //                                  ->get();
        // $data['pressKits']        =  PressKit::where(['status'=>'A'])
        //                                  ->whereNull('deleted_at')
        //                                  ->orderBy('id','desc')
        //                                  ->get();
        // $data['brandGuidelines']        =  BrandGuideline::where(['status'=>'A'])
        //                                  ->whereNull('deleted_at')
        //                                  ->orderBy('id','desc')
        //                                  ->get();
        
        $data['blogBanner']  = BlogBanner::where(['status'=>'1'])
                                         ->first();
        $data['pageTite']  = PageTitle::where(['id'=>'1'])
                                         ->first();                                 
        // $data['mediatab']  = MediaTab::where(['id'=>'1'])
        //                                  ->first();
        
        $data['blogSeo'] =  BlogSeo::where(['status'=>'A'])->first();                                 
        $blogSeo=$data['blogSeo'];
        $slug='blog';
        $data['slug_name'] = $slug;
        $metaDetail[$slug]['title'] = $blogSeo->meta_title; 
        $metaDetail[$slug]['meta_descriptions'] = $blogSeo->meta_descriptions;
        $metaDetail[$slug]['meta_keyword'] = $blogSeo->meta_keyword;
        $metaDetail[$slug]['alt_text'] = $blogSeo->alt_text;
        $metaDetail[$slug]['canonical'] = $blogSeo->canonical;

        $data['metaDetail'] = $metaDetail; 

       return view('front/en/blog/bloglisting',$data);

    }
    public function blogListingAr()
    {  

        $data['switch_lang'] = 'EN';
        $data['switch_link'] = 'en/blog';
        $data['blog']        =  Blog::where(['status'=>'A'])
                                         ->whereNull('deleted_at')
                                         /*->orderBy('id','desc')*/
                                         ->orderBy('blog_date', 'desc')
                                         ->get();
        // $data['mediaNews']        =  MediaNews::where(['status'=>'A'])
        //                                  ->whereNull('deleted_at')
        //                                  ->orderBy('id','desc')
        //                                  ->get();
        // $data['pressKits']        =  PressKit::where(['status'=>'A'])
        //                                  ->whereNull('deleted_at')
        //                                  ->orderBy('id','desc')
        //                                  ->get();
        // $data['brandGuidelines']        =  BrandGuideline::where(['status'=>'A'])
        //                                  ->whereNull('deleted_at')
        //                                  ->orderBy('id','desc')
        //                                  ->get();

        $data['blogBanner']  = BlogBanner::where(['status'=>'1'])
                                         ->first();
        $data['pageTite']  = PageTitle::where(['id'=>'1'])
                                         ->first();
        // $data['mediatab']  = MediaTab::where(['id'=>'1'])
        //                                  ->first();

        $data['blogSeo'] =  BlogSeo::where(['status'=>'A'])->first();                                 
        $blogSeo=$data['blogSeo'];
        $slug='blog';
        $data['slug_name'] = $slug;
        $metaDetail[$slug]['title_ar'] = $blogSeo->meta_title_ar; 
        $metaDetail[$slug]['meta_descriptions_ar'] = $blogSeo->meta_descriptions_ar;
        $metaDetail[$slug]['meta_keyword_ar'] = $blogSeo->meta_keyword_ar;
        $metaDetail[$slug]['alt_text_ar'] = $blogSeo->alt_text_ar;
        $metaDetail[$slug]['canonical_ar'] = $blogSeo->canonical_ar;

        $data['metaDetail'] = $metaDetail;

       return view('front/ar/blog/bloglisting',$data);

    }
}
