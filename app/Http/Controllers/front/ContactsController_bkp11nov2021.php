<?php



namespace App\Http\Controllers\front;

use App;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Helper, AdminHelper, Image, Auth, Hash, Redirect, Validator, View;
use Illuminate\Support\Facades\File as FileSystem;
use App\Models\Timezone;
use App\Traits\CommonVariables;
use App\Models\Social;
use Config;
use Carbon\Carbon;
use App\Models\User;
use App\Models\PageTitle;
use Session;
use DB;
use Crypt;
use Mail;
use File;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Exception;

class ContactsController extends Controller
{
    use CommonVariables;
    

    public function __construct() {
        // Variables assign for view page
        $this->shareVariables();
    }
    
    //=================================================================
    /*****************************************************/
    # ContactsController
    # Function name : index
    # Author        :
    # Created Date  : ContactsController
    # Purpose       : Show the list of the news
    # Params        : 
    /*****************************************************/

    public function index()
    {
        $data['switch_lang'] = 'AR';
        $data['switch_link'] = 'ar/contact-us'; 
        $data['contactUsSettings']= Social::first();
        
        $data['pageTite']  = PageTitle::where(['id'=>'1'])
                                         ->first();

        return view('front/en/contact_us/index',$data);

    }

    public function submitForm(Request $request)
    {
        $sendMail = Social::first();

        $name     =  trim($request->name);
        $email    =  trim($request->email);
        $phone    =  trim($request->phone);
        $comment  =  trim($request->comment);

        if(empty(trim($request->comment)) || empty(trim($request->name)) || empty(trim($request->email))|| empty(trim($request->phone))){
            echo  "<span style='color:red; font-weight:bold;'>
                 All fields are required!.
                 </span>";die;
        }else{

            $contact            = new \App\Models\Contact;
            $contact->name      = $request->name;
            $contact->email     = $request->email;
            $contact->number    = $request->phone;
            $contact->comment    = $request->comment;
            $contact->site_lang = 'English';
            $contact->project_name = 'Contact Us';
            $contact->save();

            $data  = array(
                      'name'      => $name, 
                      'email'     => $email, 
                      'number'    => $phone, 
                      'msg'    => $comment, 

                    );
           try {

              Mail::send('front.en.email_templates.contact_us', $data, function($message) use($data,$sendMail){
                $message->from('contact@alhakmiah.com', 'Contact Us');
                $message->to($sendMail->contact_us_email, 'Contact Us');
                $message->subject('Al Hakmiah - Contact Us');

                });
                $status = "<span style='color:green; font-weight:bold;'>
                 Thank you for contacting us, we will get back to you shortly.
                 </span>";
            } catch (Exception $ex) {
                // Debug via $ex->getMessage();
                $status = "<span style='color:red; font-weight:bold;'>
                 Sorry! Your form submission is failed.
                 </span>";
            }

        }
        echo $status;exit();

    }

    public function index_ar()
    { 
        $data['switch_lang'] = 'EN';
        $data['switch_link'] = 'contact-us';
        $data['contactUsSettings']= Social::first(); 

        $data['pageTite']  = PageTitle::where(['id'=>'1'])
                                         ->first();
                                         
        return view('front/ar/contact_us/index',$data);

    }

    public function submitForm_ar(Request $request)
    {

        $sendMail = Social::first();

        $name     =  trim($request->name);
        $email    =  trim($request->email);
        $phone    =  trim($request->phone);
        $comment  =  trim($request->comment);

        if(empty(trim($request->comment)) || empty(trim($request->name)) || empty(trim($request->email))|| empty(trim($request->phone))){
            echo  "<span style='color:red; font-weight:bold;'>
                 جميع الحقول مطلوبة.
                 </span>";die;
        }else{

            $contact            = new \App\Models\Contact;
            $contact->name      = $request->name;
            $contact->email     = $request->email;
            $contact->number    = $request->phone;
            $contact->comment    = $request->comment;
            $contact->site_lang = 'Arabic';
            $contact->project_name = 'Contact Us';
            $contact->save();

            $data  = array(
                      'name'      => $name, 
                      'email'     => $email, 
                      'number'    => $phone, 
                      'msg'    => $comment, 

                    );
           try {

              Mail::send('front.ar.email_templates.contact_us', $data, function($message) use($data,$sendMail){
                $message->from('contact@alhakmiah.com', 'Contact Us');
                $message->to($sendMail->contact_us_email, 'Contact Us');
                $message->subject('Al Hakmiah - Contact Us');

                });
                $status = "<span style='color:green; font-weight:bold;'>
                 شكرًا على تواصلك معنا ، وسنعاود الاتصال بك قريبًا
                 </span>";
            } catch (Exception $ex) {
                // Debug via $ex->getMessage();
                $status = "<span style='color:red; font-weight:bold;'>
                 آسف! فشل إرسال النموذج الخاص بك
                 </span>";
            }

        }
        echo $status;exit();

    }

    
 

}