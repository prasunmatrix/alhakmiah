<?php
/*****************************************************/
# ProjectController
# Page/Class name   : ProjectController
# Author            :
# Created Date      : 30-03-2020
# Functionality     : index, add, edit. delete 
# Purpose           : Project Management
/*****************************************************/

/*namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Auth;
use Cookie;
use Illuminate\Http\Request;
use Validator;
use Input;*/
namespace App\Http\Controllers\front;

use App;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Helper, AdminHelper, Image, Auth, Hash, Redirect, Validator, View;
use Illuminate\Support\Facades\File as FileSystem;

use App\Models\Timezone;
use Config;
use Carbon\Carbon;
use App\Traits\CommonVariables;
use App\Models\{Project,SearchSeo};
use App\Models\News;

use Session;
use DB;
use File;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Exception;

class SearchController extends Controller
{
    private static $paginationLimit= 3;

    use CommonVariables;
    

    public function __construct() {
        // Variables assign for view page
        $this->shareVariables();
    }


    //=================================================================
    /*****************************************************/
    # ServiceController
    # Function name : index
    # Author        :
    # Created Date  : ServiceController
    # Purpose       : Show the list of the service
    # Params        : Request $request
    /*****************************************************/

	public function index(Request $request)
	{  
        $pageData = array();

        $pageData['switch_lang'] = 'AR';
        $pageData['switch_link'] = 'search';

        if(isset($_GET['key']) and $_GET['key']!='')
        {
            $searchKeyword = $_GET['key'];

            $projectSearchResults = Project::orWhere('name', 'like', '%' .trim($searchKeyword) . '%')->orWhere('content', 'like', '%' .trim($searchKeyword) . '%')->get();


            $newsSearchResults = News::orWhere('title_en', 'like', '%' .trim($searchKeyword) . '%')->orWhere('description_en', 'like', '%' .trim($searchKeyword) . '%')->get();

            //dd($projectSearchResults);

            //dd($newsSearchResults);


            $pageData['projectSearchResults'] = $projectSearchResults;
            $pageData['newsSearchResults'] = $newsSearchResults;

            $pageData['key'] = $searchKeyword;
        }
        else
        {
            $pageData['projectSearchResults'] = 'New search';
            $pageData['newsSearchResults'] = 'New search';

            $pageData['key'] = '';
        }
        $data['SearchSeo'] =  SearchSeo::where(['status'=>'A'])->first();                                 
        $SearchSeo=$data['SearchSeo'];
        $slug='serach';
        $pageData['slug_name'] = $slug;
        $metaDetail[$slug]['title'] = $SearchSeo->meta_title; 
        $metaDetail[$slug]['meta_descriptions'] = $SearchSeo->meta_descriptions;
        $metaDetail[$slug]['meta_keyword'] = $SearchSeo->meta_keyword;
        $metaDetail[$slug]['alt_text'] = $SearchSeo->alt_text;
        $metaDetail[$slug]['canonical'] = $SearchSeo->canonical;

        $pageData['metaDetail'] = $metaDetail;
        
		return view('front/en/search/search',$pageData);

	}


    //=================================================================
    /*****************************************************/
    # ServiceController
    # Function name : index
    # Author        :
    # Created Date  : ServiceController
    # Purpose       : Show the list of the service
    # Params        : Request $request
    /*****************************************************/

    public function indexAr(Request $request)
    {  
        $pageData = array();

        $pageData['switch_lang'] = 'EN';
        $pageData['switch_link'] = 'en/search';

        if(isset($_GET['key']) and $_GET['key']!='')
        {
            $searchKeyword = $_GET['key'];

            $projectSearchResults = Project::orWhere('name_ar', 'like', '%' .trim($searchKeyword) . '%')->orWhere('content_ar', 'like', '%' .trim($searchKeyword) . '%')->get();


            $newsSearchResults = News::orWhere('title_ar', 'like', '%' .trim($searchKeyword) . '%')->orWhere('description_ar', 'like', '%' .trim($searchKeyword) . '%')->get();


            $pageData['projectSearchResults'] = $projectSearchResults;
            $pageData['newsSearchResults'] = $newsSearchResults;

            $pageData['key'] = $searchKeyword;
        }
        else
        {
            $pageData['projectSearchResults'] = 'New search';
            $pageData['newsSearchResults'] = 'New search';

            $pageData['key'] = '';
        }

        //dd($pageData);
        $data['SearchSeo'] =  SearchSeo::where(['status'=>'A'])->first();                                 
        $SearchSeo=$data['SearchSeo'];
        $slug='serach';
        $pageData['slug_name'] = $slug;
        $metaDetail[$slug]['title_ar'] = $SearchSeo->meta_title_ar; 
        $metaDetail[$slug]['meta_descriptions_ar'] = $SearchSeo->meta_descriptions_ar;
        $metaDetail[$slug]['meta_keyword_ar'] = $SearchSeo->meta_keyword_ar;
        $metaDetail[$slug]['alt_text_ar'] = $SearchSeo->alt_text_ar;
        $metaDetail[$slug]['canonical_ar'] = $SearchSeo->canonical_ar;

        $pageData['metaDetail'] = $metaDetail;
        
        return view('front/ar/search/search',$pageData);

    }


}