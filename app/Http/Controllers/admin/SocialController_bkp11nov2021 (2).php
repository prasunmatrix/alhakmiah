<?php

namespace App\Http\Controllers\admin;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Social;
use App\Models\PageTitle;
use App\Models\ContactSeo;
use App\Http\Requests\SocialRequest;
use App\Http\Requests\updateSocialRequest;
use Helper, AdminHelper, Image, Validator,  View;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\CmsExport;
use Auth;
use Redirect;
use Carbon\Carbon;
use Yajra\Datatables\Datatables;
use Config;



class SocialController extends Controller
{
    public $data= array();
   

    /************SocialController*****************************************/
    # SocialController
    # Function name : socialEdit
    # Author        :
    # Created Date  : 05-04-2021
    # Purpose       : Social Edit
    #                 
    #                 
    # Params        : 
    /*****************************************************/


    public function socialEdit(Request $request) {
        $this->data['page_title']='Social Edit';
        $this->data['panel_title']='Social Edit';
        $encryptString= encrypt('1', Config::get('Constant.ENC_KEY'));; 
        $socialId = decrypt($encryptString, Config::get('Constant.ENC_KEY')); // get user-id After Decrypt with salt key.
        $this->data['details'] = Social::findOrFail($socialId);
        $this->data['encryptCode'] = $encryptString;
        //dd($this->data['details']);
        return view('admin.social_link.edit',$this->data); 
    }

    /*****************************************************/
    # SocialController
    # Function name : service update
    # Author        :
    # Created Date  : 31-03-2021
    # Purpose       :  update
    #                 
    #                 
    # Params        : 
    /*****************************************************/

    public function update(updateSocialRequest $request){
   
        
        try
        {
        	if ($request->isMethod('POST'))
        	{

                $socialId = !empty($request->encString) ? decrypt($request->encString, Config::get('Constant.ENC_KEY')) : 0;
                
                $socialModelObj =  Social::findOrFail($socialId);
                $socialModelObj->facebook        = trim($request->facebook, ' ');
                $socialModelObj->youtube         = trim($request->youtube, ' ');
                $socialModelObj->linkedin        = trim($request->linkedin, ' ');
                $socialModelObj->instagram       = trim($request->instagram, ' ');
                $socialModelObj->twitter         = trim($request->twitter, ' ');
                $socialModelObj->whatsapp        = trim($request->whatsapp, ' ');
                $socialModelObj->linkedin        = trim($request->linkedin, ' ');
                $socialModelObj->project_details_service_heading_en     = trim($request->project_details_service_heading_en, ' ');
                $socialModelObj->project_details_service_heading_ar     = trim($request->project_details_service_heading_ar, ' ');
                $socialModelObj->project_details_unit_heading_en        = trim($request->project_details_unit_heading_en, ' ');
                $socialModelObj->project_details_unit_heading_ar        = trim($request->project_details_unit_heading_ar, ' ');
                $socialModelObj->our_responsibility_heading             = trim($request->our_responsibility_heading, ' ');
                $socialModelObj->our_responsibility_heading_ar             = trim($request->our_responsibility_heading_ar, ' ');
                
                /*$socialModelObj->achievement_title_en            = trim($request->achievement_title_en, '');
                $socialModelObj->achievement_title_ar            = trim($request->achievement_title_ar, '');

                $socialModelObj->latest_news_title_en            = trim($request->latest_news_title_en, '');
                $socialModelObj->latest_news_title_ar            = trim($request->latest_news_title_ar, '');

                $socialModelObj->service_title_en            = trim($request->service_title_en, '');
                $socialModelObj->service_title_ar            = trim($request->service_title_ar, '');*/
                
                $socialModelObj->email           = trim($request->email, ' ');
                $socialModelObj->contact_us_email           = trim($request->contact_us_email, ' ');
                $socialModelObj->join_us_email           = trim($request->join_us_email, ' ');
                $socialModelObj->project_email           = trim($request->project_email, ' ');
                $socialModelObj->phone           = trim($request->phone, ' ');

                $socialModelObj->ach_title_en           = trim($request->ach_title_en, ' ');
                $socialModelObj->ach_title_ar           = trim($request->ach_title_ar, ' ');
                if($request->file('header_logo')) {
                    $files=$request->file('header_logo');
                    $fullFileName = time().'.'.$files->getClientOriginalExtension();
                    $destinationPath               = 'assets/images';
                    $uploadResponse                = $files->move($destinationPath,$fullFileName);
                    $socialModelObj->header_logo=$fullFileName;
                }
                if($request->file('footer_logo')) {
                    $files=$request->file('footer_logo');
                    $fullFileName = time().'.'.$files->getClientOriginalExtension();
                    $destinationPath               = 'assets/images';
                    $uploadResponse                = $files->move($destinationPath,$fullFileName);
                    $socialModelObj->footer_logo=$fullFileName;
                }
                if($request->file('banner_image')) {
                    $files=$request->file('banner_image');
                    $fullFileName = time().'.'.$files->getClientOriginalExtension();
                    $destinationPath               = 'assets/images';
                    $uploadResponse                = $files->move($destinationPath,$fullFileName);
                    $socialModelObj->banner_image=$fullFileName;
                }

                $socialModelObj->status          = $request->status;
                $socialModelObj->created_at      = Carbon::now();
                $socialModelObj->updated_at      = Carbon::now();
                $save = $socialModelObj->save(); 

                
                if($save){
                    return redirect()->route('admin.social.edit')->with('success','social has been updated successfully.');;
                
                } else {
                    return redirect()->back()->with('error', 'An error occurred while adding the Cms');
                }
				
			}
			
		} catch (Exception $e) {
			return redirect()->back()->with('error', $e->getMessage());
        } 
    }

    
    /************SocialController*****************************************/
    # SocialController
    # Function name : socialPageTitleEdit
    # Author        :
    # Created Date  : 14-07-2021
    # Purpose       : social Page TitleEdit
    #                 
    #                 
    # Params        : 
    /*****************************************************/


    public function socialPageTitleEdit(Request $request) {
        $this->data['page_title']='Page Banner Title Edit';
        $this->data['panel_title']='Page Banner Title Edit';
        $encryptString= encrypt('1', Config::get('Constant.ENC_KEY'));; 
        $socialId = decrypt($encryptString, Config::get('Constant.ENC_KEY')); // get user-id After Decrypt with salt key.
        $this->data['details'] = PageTitle::findOrFail($socialId);
        $this->data['encryptCode'] = $encryptString;
        //dd($this->data['details']);
        return view('admin.page_banner_title.edit',$this->data); 
    }

    /*****************************************************/
    # SocialController
    # Function name : page title update
    # Author        :
    # Created Date  : 14-07-2021
    # Purpose       :  update
    #                 
    #                 
    # Params        : 
    /*****************************************************/

    public function pagetitleupdate(Request $request){
        try
        {
        	if ($request->isMethod('POST'))
        	{
                $socialId = !empty($request->encString) ? decrypt($request->encString, Config::get('Constant.ENC_KEY')) : 0;
                
                $pTitleModelObj =  PageTitle::findOrFail($socialId);

                $pTitleModelObj->communities_en         = trim($request->communities_en, ' ');
                $pTitleModelObj->communities_ar         = trim($request->communities_ar, ' ');
                $pTitleModelObj->service_en             = trim($request->service_en, ' ');
                $pTitleModelObj->service_ar             = trim($request->service_ar, ' ');
                $pTitleModelObj->investor_relation_en   = trim($request->investor_relation_en, ' ');
                $pTitleModelObj->investor_relation_ar   = trim($request->investor_relation_ar, ' ');
                $pTitleModelObj->media_center_en        = trim($request->media_center_en, ' ');
                $pTitleModelObj->media_center_ar        = trim($request->media_center_ar, ' ');
                $pTitleModelObj->join_us_en             = trim($request->join_us_en, ' ');
                $pTitleModelObj->join_us_ar             = trim($request->join_us_ar, ' ');
                $pTitleModelObj->contact_us_en          = trim($request->contact_us_en, ' ');
                $pTitleModelObj->contact_us_ar          = trim($request->contact_us_ar, ' ');

                $pTitleModelObj->our_achievement_heading_en  = trim($request->our_achievement_heading_en, ' ');
                $pTitleModelObj->our_achievement_heading_ar  = trim($request->our_achievement_heading_ar, ' ');
                $pTitleModelObj->ach_title_en                = trim($request->ach_title_en, ' ');
                $pTitleModelObj->ach_title_ar                = trim($request->ach_title_ar, ' ');

                $pTitleModelObj->ach_description_en          = trim($request->ach_description_en, ' ');
                $pTitleModelObj->ach_description_ar          = trim($request->ach_description_ar, ' ');

                $pTitleModelObj->project_details_service_heading_en = trim($request->project_details_service_heading_en, ' ');
                $pTitleModelObj->project_details_service_heading_ar = trim($request->project_details_service_heading_ar, ' ');
                $pTitleModelObj->project_details_unit_heading_en    = trim($request->project_details_unit_heading_en, ' ');
                $pTitleModelObj->project_details_unit_heading_ar    = trim($request->project_details_unit_heading_ar, ' ');

                if($request->file('banner_image')) {
                    $files=$request->file('banner_image');
                    $fullFileName = time().'.'.$files->getClientOriginalExtension();
                    $destinationPath               = 'assets/images';
                    $uploadResponse                = $files->move($destinationPath,$fullFileName);
                    $pTitleModelObj->banner_image=$fullFileName;
                }
                if($request->file('contact_banner_image')) {
                    $files=$request->file('contact_banner_image');
                    $fullFileName = time().'.'.$files->getClientOriginalExtension();
                    $destinationPath               = 'assets/images';
                    $uploadResponse                = $files->move($destinationPath,$fullFileName);
                    $pTitleModelObj->contact_banner_image=$fullFileName;
                }
                if($request->file('achievement_banner_image')) {
                    $files=$request->file('achievement_banner_image');
                    $fullFileName = time().'.'.$files->getClientOriginalExtension();
                    $destinationPath               = 'assets/images';
                    $uploadResponse                = $files->move($destinationPath,$fullFileName);
                    $pTitleModelObj->achievement_banner_image=$fullFileName;
                }
                
                $pTitleModelObj->created_at      = Carbon::now();
                $pTitleModelObj->updated_at      = Carbon::now();

                $save = $pTitleModelObj->save(); 
                
                if($save){
                    return redirect()->route('admin.social.editpagetilte')->with('success','Page Title has been updated successfully.');;
                
                } else {
                    return redirect()->back()->with('error', 'An error occurred while adding the Page Title');
                }
				
			}
			
		} catch (Exception $e) {
			return redirect()->back()->with('error', $e->getMessage());
        } 
    }

    /************SocialController*****************************************/
    # SocialController
    # Function name : contactSeoEdit
    # Author        :
    # Created Date  : 09-11-2021
    # Purpose       : contact Page Seo Edit
    #                 
    #                 
    # Params        : 
    /*****************************************************/


    public function contactSeoEdit(Request $request) {
        $this->data['page_title']='Contact Page SEO Edit';
        $this->data['panel_title']='Contact Page SEO Edit';
        $encryptString= encrypt('1', Config::get('Constant.ENC_KEY'));; 
        $socialId = decrypt($encryptString, Config::get('Constant.ENC_KEY')); // get user-id After Decrypt with salt key.
        $this->data['details'] = ContactSeo::findOrFail($socialId);
        $this->data['encryptCode'] = $encryptString;
        //dd($this->data['details']);
        return view('admin.contact_seo.edit',$this->data); 
    }

    /*****************************************************/
    # SocialController
    # Function name : Contact Page SEO update
    # Author        :
    # Created Date  : 09-11-2021
    # Purpose       :  update
    #                 
    #                 
    # Params        : 
    /*****************************************************/

    public function contactSeoupdate(Request $request){
        try
        {
        	if ($request->isMethod('POST'))
        	{
                $socialId = !empty($request->encString) ? decrypt($request->encString, Config::get('Constant.ENC_KEY')) : 0;
                
                $contatSeoModelObj =  ContactSeo::findOrFail($socialId);

                $contatSeoModelObj->meta_title = $request->meta_title;
                $contatSeoModelObj->meta_descriptions = $request->meta_descriptions;
                $contatSeoModelObj->meta_keyword = $request->meta_keyword;
                $contatSeoModelObj->alt_text = $request->alt_text;
                $contatSeoModelObj->canonical = $request->canonical;

                $contatSeoModelObj->meta_title_ar             = trim($request->meta_title_ar, ' ');
                $contatSeoModelObj->meta_descriptions_ar      = trim($request->meta_descriptions_ar, ' ');
                $contatSeoModelObj->meta_keyword_ar           = trim($request->meta_keyword_ar, ' ');
                $contatSeoModelObj->alt_text_ar               = trim($request->alt_text_ar, ' ');
                $contatSeoModelObj->canonical_ar              = trim($request->canonical_ar, ' ');
               

                $contatSeoModelObj->created_at      = Carbon::now();
                $contatSeoModelObj->updated_at      = Carbon::now();

                $save = $contatSeoModelObj->save(); 
                
                if($save){
                    return redirect()->route('admin.social.editcontactseo')->with('success','Contact Page SEO has been updated successfully.');;
                
                } else {
                    return redirect()->back()->with('error', 'An error occurred while adding the Page Title');
                }
				
			}
			
		} catch (Exception $e) {
			return redirect()->back()->with('error', $e->getMessage());
        } 
    }


}