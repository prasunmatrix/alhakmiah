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
use App\Models\Jobs;
use App\Models\Social;
use App\Models\JobsApply;
use App\Models\JobsBanner;
use App\Models\{PageTitle,JoinSeo}; 
use Session;
use DB;
use Crypt;
use Mail;
use File;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Exception;

class JobsController extends Controller
{
    use CommonVariables;
    

    public function __construct() {
        // Variables assign for view page
        $this->shareVariables();
    }
    
    //=================================================================
    /*****************************************************/
    # JobsController
    # Function name : index
    # Author        :
    # Created Date  : JobsController
    # Purpose       : Show the list of the news
    # Params        : 
    /*****************************************************/

    public function index()
    {
        

        $data['switch_lang'] = 'AR';
        $data['switch_link'] = 'ar/join-us';
        $data['jobs']        = Jobs::where(['status'=>'A'])->orderBy('id', 'DESC')->get();
        $data['jobsBanner']  = JobsBanner::where(['status'=>'1'])->first();  
        
        $data['pageTite']  = PageTitle::where(['id'=>'1'])
                                         ->first();
        
        $data['joinSeo'] =  JoinSeo::where(['status'=>'A'])->first();                                 
        $joinSeo=$data['joinSeo'];
        $slug='join-us';
        $data['slug_name'] = $slug;
        $metaDetail[$slug]['title'] = $joinSeo->meta_title; 
        $metaDetail[$slug]['meta_descriptions'] = $joinSeo->meta_descriptions;
        $metaDetail[$slug]['meta_keyword'] = $joinSeo->meta_keyword;
        $metaDetail[$slug]['alt_text'] = $joinSeo->alt_text;
        $metaDetail[$slug]['canonical'] = $joinSeo->canonical;

        $data['metaDetail'] = $metaDetail;                                 

        return view('front/en/jobs/index',$data);

    }

    public function index_ar()
    { 
        $data['switch_lang'] = 'EN';
        $data['switch_link'] = 'join-us';
        $data['jobs']        = Jobs::where(['status'=>'A'])->orderBy('id', 'DESC')->get();
        $data['jobsBanner']  = JobsBanner::where(['status'=>'1'])->first();

        $data['pageTite']  = PageTitle::where(['id'=>'1'])
                                         ->first();

        $data['joinSeo'] =  JoinSeo::where(['status'=>'A'])->first();                                 
        $joinSeo=$data['joinSeo'];
        $slug='join-us';
        $data['slug_name'] = $slug;
        $metaDetail[$slug]['title_ar'] = $joinSeo->meta_title_ar; 
        $metaDetail[$slug]['meta_descriptions_ar'] = $joinSeo->meta_descriptions_ar;
        $metaDetail[$slug]['meta_keyword_ar'] = $joinSeo->meta_keyword_ar;
        $metaDetail[$slug]['alt_text_ar'] = $joinSeo->alt_text_ar;
        $metaDetail[$slug]['canonical_ar'] = $joinSeo->canonical_ar;

        $data['metaDetail'] = $metaDetail;                                 
                                         
        return view('front/ar/jobs/index',$data);

    }

    public function jobs(Request $request,$jobId)
    { 
     
        $data['switch_lang'] = 'AR';
        $data['switch_link'] = 'ar/apply';
        $data['jobId']=$jobId;
                
        return view('front/en/jobs/apply',$data);

    }

    public function jobs_ar(Request $request,$jobId)
    { 
        $data['switch_lang'] = 'EN';
        $data['switch_link'] = 'apply';
        $data['jobId']=$jobId;
                
        return view('front/ar/jobs/apply',$data);

    }
    
    public function jobs_apply(Request $request)
    { 

        $sendMail= Social::first();
            $name    = $request->name;
            $email   = $request->email;

                $jobsApply = new \App\Models\JobsApply;
                $jobsApply->name = $request->name;
                $jobsApply->email = $request->email;
                $jobsApply->contact_info = $request->contact_info;
                if($request->file('contact_info')) {
                    $files=$request->file('contact_info');
                    $fullFileName = time().'.'.$files->getClientOriginalExtension();
                    $destinationPath                  = 'assets/cv_pdf';
                    $uploadResponse                   = $files->move($destinationPath,$fullFileName);
                    $jobsApply->contact_info=$fullFileName;
                } 
                $jobsApply->phone = $request->phone;
                $jobsApply->job_id = $request->jobId;
                $jobsApply->site_lang = 'English';
                

                $job_details=Jobs::find($request->jobId);

                $jobsApply->save();

                        $data = array(
                               'name'      => $name, 
                               'email'      => $email 
                              
                            );
                try {
                    $attachment = public_path('assets/cv_pdf/'.$fullFileName);
                   Mail::send('front.en.email_templates.jobs_apply', $data, function($message) use($data, $request,$sendMail,$job_details,$attachment){
                    if ($attachment) {
                        $message->attach($attachment);
                    }
                    $message->from('contact@alhakmiah.com', 'Jobs Apply');
                    $message->to($sendMail->join_us_email, 'Jobs Apply ');
                    $message->subject('Al Hakmiah - Jobs Apply For '.$job_details->title_en);

                    });
                   

                    $status = "<span style='color:green; font-weight:bold;'>
                     Thank you for contacting us, we will get back to you shortly.
                     </span>";
                } catch (Exception $ex) {
                    // Debug via $ex->getMessage();
                    $status = "<span style='color:red; font-weight:bold;'>
                     Sorry! Your form failed to be submitted.
                     </span>";
                }
               

                echo $status;exit();      

    }

    public function anyoneJobsApply(Request $request)
    { 

        if(empty(trim($request->name)) || empty(trim($request->email)) || empty(trim($request->contact_info))|| empty(trim($request->grecaptcha))){
            $status = "<span style='color:red; font-weight:bold;'>
                 All fields are required
                 </span>"; 

        }else{

            $sendMail= Social::first();
            $name    = $request->name;
            $email   = $request->email;
            $phone   = $request->phone;

                $jobsApply = new \App\Models\JobsApply;
                $jobsApply->name = $request->name;
                $jobsApply->email = $request->email;
                if($request->file('contact_info')) {
                    $files=$request->file('contact_info');
                    $fullFileName = time().'.'.$files->getClientOriginalExtension();
                    $destinationPath                  = 'assets/cv_pdf';
                    $uploadResponse                   = $files->move($destinationPath,$fullFileName);
                    $jobsApply->contact_info=$fullFileName;
                } 
                $jobsApply->phone = $request->phone;
                $jobsApply->job_id = '0';
                $jobsApply->site_lang = 'English';
              
                $jobsApply->save();

                        $data = array(
                               'name'      => $name, 
                               'email'      => $email, 
                               'phone'      => $phone, 
                              
                            );
                try {
                    $attachment = public_path('assets/cv_pdf/'.$fullFileName);
                   Mail::send('front.en.email_templates.jobs_apply', $data, function($message) use($data, $request,$sendMail,$attachment){
                    if ($attachment) {
                        $message->attach($attachment);
                    }
                    $message->from('contact@alhakmiah.com', 'Jobs Apply');
                    $message->to($sendMail->join_us_email, 'Jobs Apply ');
                    $message->subject('Al Hakmiah - Jobs Apply ');

                    });
                   

                    $status = "<span style='color:green; font-weight:bold;'>
                     Thank you for contacting us, we will get back to you shortly.
                     </span>";
                } catch (Exception $ex) {
                    // Debug via $ex->getMessage();
                    $status = "<span style='color:red; font-weight:bold;'>
                     Sorry! Your form failed to be submitted.
                     </span>";
                }
               
            }
                return redirect()->back()->with('message', $status);     

    }

    public function jobs_apply_ar(Request $request)
    { 
        $sendMail= Social::first();
            $name    = $request->name;
            $email   = $request->email;

                $jobsApply = new \App\Models\JobsApply;

                $jobsApply->name = $request->name;
                $jobsApply->email = $request->email;
                $jobsApply->phone = $request->phone;
                $jobsApply->job_id = $request->jobId;
                $jobsApply->site_lang = 'Arabic';
                if($request->file('contact_info')) {

                    $files=$request->file('contact_info');
                    $fullFileName =time().'.'.$files->getClientOriginalExtension();
                    $destinationPath               = 'assets/cv_pdf';
                    $uploadResponse                = $files->move($destinationPath,$fullFileName);
                    $jobsApply->contact_info=$fullFileName;
                }

                $job_details=Jobs::find($request->jobId);

                $jobsApply->save();
                $data   = array(
                          'name'      => $name, 
                          'email'      => $email, 
                          
                        );
               try {
                    $attachment = public_path('assets/cv_pdf/'.$fullFileName);
                    Mail::send('front.ar.email_templates.jobs_apply', $data, function($message) use($data, $request,$sendMail,$job_details, $attachment){
                        if ($attachment) {
                            $message->attach($attachment);
                        }
                        $message->from('contact@alhakmiah.com', 'تطبيق الوظائف');
                        $message->to($sendMail->join_us_email, 'تطبيق الوظائف');
                        $message->subject('الحاكمية - تطبيق الوظائف'.$job_details->title_ar);
                    });

              
                   $status = "<span style='color:green; font-weight:bold;'>
                     شكرًا على تواصلك معنا ، وسنعاود الاتصال بك قريبًا.
                     </span>";
                } catch (Exception $ex) {
                    // Debug via $ex->getMessage();
                    $status = "<span style='color:red; font-weight:bold;'>
                     آسف! فشل إرسال النموذج الخاص بك.
                     </span>";
                }

                echo $status;exit();
     

    }

    public function anyoneJobsApplyAr(Request $request)
    { 

        if(empty(trim($request->name)) || empty(trim($request->email)) || empty(trim($request->contact_info))|| empty(trim($request->grecaptcha))){
            $status = "<span style='color:red; font-weight:bold;'>
                 جميع الحقول مطلوبة
                 </span>"; 

        }else{

            $sendMail= Social::first();
            $name    = $request->name;
            $email   = $request->email;
            $phone = $request->phone;

                $jobsApply = new \App\Models\JobsApply;
                $jobsApply->name = $request->name;
                $jobsApply->email = $request->email; 
                $jobsApply->phone = $request->phone;
                $jobsApply->job_id = '0';
                $jobsApply->site_lang = 'Arbic';
                
                if($request->file('contact_info')) {

                    $files=$request->file('contact_info');
                    $fullFileName = time().'.'.$files->getClientOriginalExtension();
                    $destinationPath               = 'assets/cv_pdf';
                    $uploadResponse                = $files->move($destinationPath,$fullFileName);
                    $jobsApply->contact_info=$fullFileName;
                }

                // $job_details=Jobs::find($request->jobId);

                $jobsApply->save();

                        $data = array(
                               'name'      => $name, 
                               'email'      => $email, 
                               'phone'      => $phone, 
                              
                            );
                try {
                    $attachment = public_path('assets/cv_pdf/'.$fullFileName);
                   Mail::send('front.ar.email_templates.jobs_apply', $data, function($message) use($data, $request,$sendMail,$attachment){
                    if ($attachment) {
                        $message->attach($attachment);
                    }
                    $message->from('contact@alhakmiah.com', 'تطبيق الوظائف');
                    $message->to($sendMail->join_us_email, 'تطبيق الوظائف');
                    $message->subject('الحاكمية - تطبيق الوظائف');
                    });
                   

                    $status = "<span style='color:green; font-weight:bold;'>
                    شكرًا على تواصلك معنا ، وسنعاود الاتصال بك قريبًا.
                    </span>";
                } catch (Exception $ex) {
                    // Debug via $ex->getMessage();
                    $status = "<span style='color:red; font-weight:bold;'>
                     آسف! فشل إرسال النموذج الخاص بك.
                     </span>";
                }
               
            }
                return redirect()->back()->with('message', $status);     

    }
 

}