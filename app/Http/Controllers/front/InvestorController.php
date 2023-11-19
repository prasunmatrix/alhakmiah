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
use App\Models\Social;
use App\Models\User;
use App\Models\PageTitle; 
use Session;
use DB;
use File;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Exception;
use Crypt;
use Mail;


class InvestorController extends Controller
{

    use CommonVariables;
    

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
        $data['switch_link'] = 'ar/investor-relations';
     
        $data['investor'] = App\Models\Investor::where(['status'=>'A'])->whereNull('deleted_at')->first();
        $data['investorAchievement'] = App\Models\InvestorAchievement::where(['status'=>'A'])
                                                                        ->orderBy('id', 'desc')
                                                                        ->whereNull('deleted_at')
                                                                        ->take(3)
                                                                        ->get();
        $data['investorHeading']= Social::first();

        $data['pageTite']  = PageTitle::where(['id'=>'1'])
                                         ->first();

	    return view('front/en/investors/list',$data);

	}

    public function index_ar()
    {  

        $data['switch_lang'] = 'EN';
        $data['switch_link'] = 'investor-relations';
        $data['investor'] = App\Models\Investor::where(['status'=>'A'])->whereNull('deleted_at')->first();
        $data['investorAchievement'] = App\Models\InvestorAchievement::where(['status'=>'A'])
                                                                        ->orderBy('id', 'desc')
                                                                        ->whereNull('deleted_at')
                                                                        ->take(3)
                                                                        ->get();
       
        $data['pageTite']  = PageTitle::where(['id'=>'1'])
                                         ->first();
                                         
       return view('front/ar/investors/list',$data);

    }

//=================================================================
    /*****************************************************/
    # InvestorController
    # Function name : saveInvestorContact
    # Author        :
    # Created Date  : InvestorController
    # Purpose       : Save contact form data.
    # Params        : Request $request
    /*****************************************************/
    
    public function saveInvestorContact(Request $request)
    {
    
        try {

            $message = [

                    'fullname.required' => 'fullname is required',
                    'phone.required'    => 'phone is required',
                    'emailid.required'  => 'email is required'
                ];

            $validator = Validator::make($request->all(), [
                    'fullname' => 'required',
                    'emailid' => 'required|email',
                    'phone' => 'required',
                 
                    ], $message);
                    
            if ($validator->fails()) { 
                return redirect()->route('front.investor-page')
                                    ->withErrors($validator)
                                    ->withInput();
            } else {
                $contact = new \App\Models\Contact;

                $contact->name = $request->fullname;
                $contact->email = $request->emailid;
                $contact->number = $request->phone;
                $contact->project_name = "Investor-relations";
                $contact->site_lang = 'English';

                $contact->save();
                $data = array(
                        'name' => $request->fullname,
                        'email' => $request->emailid,
                        'phone' => $request->phone,
                        'project_name' => 'Investor-Relations',
                        'fromsite' => 'English'
                );

                $sendMail= Social::first();

                //dd($data);
                
                Mail::send('front.en.email_templates.enquiry', $data, function($message) use($data,$sendMail,$contact){
                    $message->from('contact@alhakmiah.com', 'Investor Enquiry');
                    $message->to($sendMail->contact_us_email);
                    $message->subject('Al Hakmiah - Enquiry For Investor Relations');

                    });

                session()->flash('success', 'Message submited successfully. We will contact with you soon.');
                Session::flash('alert-class', 'alert-success'); 
                return redirect()->route('front.investor-page');

            }

        }
        catch (\Exception $e) {
            Log::error($e->getMessage());
            //session()->flash('message', $e->getMessage());
            
            session()->flash('error', $e->getMessage());
            Session::flash('alert-class', 'alert-danger');
            return redirect()->route('front.investor-page');
           
        }
    }

    public function saveInvestorContactAr(Request $request)
    {
        //dd($request); die;
        try {

            $message = [

                    'fullname.required' => 'الإسم الكامل ضروري',
                    'phone.required'    => 'الهاتف مطلوب',
                    'emailid.required'  => 'البريد الالكتروني مطلوب'
                ];

            $validator = Validator::make($request->all(), [
                    'fullname' => 'required',
                    'emailid' => 'required|email',
                    'phone' => 'required',
                 
                    ], $message);
                    
            if ($validator->fails()) { 
                
                return redirect()->route('front.investor-page-ar')
                                    ->withErrors($validator)
                                    ->withInput();
            } else {
                $contact = new \App\Models\Contact;

                $contact->name = $request->fullname;
                $contact->email = $request->emailid;
                $contact->number = $request->phone;
                $contact->project_name = "Investor-relations";
                $contact->site_lang = 'Arabic';

                $contact->save();

                $data = array(
                        'name' => $request->fullname,
                        'email' => $request->emailid,
                        'phone' => $request->phone,
                        'project_name' => 'Investor Relations',
                        'fromsite' => 'Arabic'
                );
                $sendMail= Social::first();

                Mail::send('front.ar.email_templates.enquiry', $data, function($message) use($data,$sendMail,$contact){
                    $message->from('contact@alhakmiah.com', 'Investor Relations');
                    $message->to($sendMail->contact_us_email, 'Investor Relations');
                    $message->subject('الحاكمية - الاستعلام عن علاقات المستثمرين');

                    });

                session()->flash('success', 'تم إرسال الرسالة بنجاح. سوف نتواصل معك قريبا');
                Session::flash('alert-class', 'alert-success'); 
                return redirect()->route('front.investor-page-ar');
            }

        }
        catch (\Exception $e) {
            Log::error($e->getMessage());
            //session()->flash('message', $e->getMessage());
            session()->flash('error', $e->getMessage());
            Session::flash('alert-class', 'alert-danger');
            return redirect()->route('front.investor-page-ar');
           
        }
    }


}