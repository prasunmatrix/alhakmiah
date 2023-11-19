<?php
namespace App\Http\Controllers\front;
use App;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Helper, AdminHelper, Image, Auth, Hash, Redirect, Validator, View;
use Illuminate\Support\Facades\File as FileSystem;
use App\Models\Timezone;
use Config;
use App\Traits\CommonVariables;
use Carbon\Carbon;
use App\Models\{OurAchievement,OurachievementsSeo};
use App\Models\User;
use App\Models\Social;
use App\Models\PageTitle;
use Session;
use DB;
use File;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Exception;

class OurAchievementsController extends Controller
{

    use CommonVariables;
    private static $paginationLimit= 10;

    public function __construct() {
        // Variables assign for view page
        $this->shareVariables();
    }
    
    //=================================================================
    /*****************************************************/
    # InvestorController
    # Function name : index
    # Author        :
    # Created Date  : InvestorController
    # Purpose       : Show the list of the projects
    # Params        : 
    /*****************************************************/

	public function index()
	{
        $data['switch_lang'] = 'AR';
        $data['switch_link'] = 'ar/our-achievements';
        $data['ourAchievements'] =OurAchievement::where(['status'=>'A'])
                                                                        ->whereNull('deleted_at')
                                                                        ->orderBy('id','desc')
                                                                        ->paginate(self::$paginationLimit);
        $data['ourAchievementsHeading']= PageTitle::first();

        $data['OurachievementsSeo'] =  OurachievementsSeo::where(['status'=>'A'])->first();                                 
        $OurachievementsSeo=$data['OurachievementsSeo'];
        $slug='our-achievements';
        $data['slug_name'] = $slug;
        $metaDetail[$slug]['title'] = $OurachievementsSeo->meta_title; 
        $metaDetail[$slug]['meta_descriptions'] = $OurachievementsSeo->meta_descriptions;
        $metaDetail[$slug]['meta_keyword'] = $OurachievementsSeo->meta_keyword;
        $metaDetail[$slug]['alt_text'] = $OurachievementsSeo->alt_text;
        $metaDetail[$slug]['canonical'] = $OurachievementsSeo->canonical;

        $data['metaDetail'] = $metaDetail;
       
	    return view('front/en/our-achievement/index',$data);

	}

    public function index_ar()
    {  

        $data['switch_lang'] = 'EN';
        $data['switch_link'] = 'our-achievements';
        $data['ourAchievements'] =OurAchievement::where(['status'=>'A'])
                                                                        ->whereNull('deleted_at')
                                                                        ->orderBy('id','desc')
                                                                        ->paginate(self::$paginationLimit);
        $data['ourAchievementsHeading']= PageTitle::first();

        $data['OurachievementsSeo'] =  OurachievementsSeo::where(['status'=>'A'])->first();                                 
        $OurachievementsSeo=$data['OurachievementsSeo'];
        $slug='our-achievements';
        $data['slug_name'] = $slug;
        $metaDetail[$slug]['title_ar'] = $OurachievementsSeo->meta_title_ar; 
        $metaDetail[$slug]['meta_descriptions_ar'] = $OurachievementsSeo->meta_descriptions_ar;
        $metaDetail[$slug]['meta_keyword_ar'] = $OurachievementsSeo->meta_keyword_ar;
        $metaDetail[$slug]['alt_text_ar'] = $OurachievementsSeo->alt_text_ar;
        $metaDetail[$slug]['canonical_ar'] = $OurachievementsSeo->canonical_ar;

        $data['metaDetail'] = $metaDetail;
       
	    return view('front/ar/our-achievement/index',$data);

    }


    




   

}