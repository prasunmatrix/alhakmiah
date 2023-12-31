<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Auth;
use Config;
use Mail;
use Redirect;
use Validator;

class   AuthController extends Controller
{

    public $data = array();             // set global class object


    /*****************************************************/
    # AuthController
    # Function name : index
    # Author        :
    # Created Date  : 20-07-2020
    # Purpose       : Login page display
    #
    #
    # Params        : Request $request
    /*****************************************************/
    public function index(Request $request)
    {
        $this->data['page_title'] = 'Control Panel:Login';
        $this->data['panel_title'] = 'Control Panel:Login';
        if (Auth::guard('admin')->check()) {
            // If admin is logged in, redirect him to dashboard page //
            return Redirect::route('admin.dashboard');
        } else {
            return view('admin.login.admin_login', $this->data);
        }
    }

     /*****************************************************/
    # AuthController
    # Function name : verifyCredentials
    # Author        :
    # Created Date  : 20-07-2020
    # Purpose       : Verify Credentials exits or not
    #
    #
    # Params        : Request $request
    /*****************************************************/

    public function verifyCredentials(Request $request)
    {
        if (Auth::guard('admin')->check()) {
            // If admin is logged in, redirect him/her to dashboard page //
            return Redirect::Route('admin.dashboard');
        } else {
            try {
                if ($request->isMethod('post')) {
                    // Checking validation
                    $validationCondition = array(
                        'email' => 'required',
                        'password' => 'required',
                    );
                    $Validator = Validator::make($request->all(), $validationCondition);

                    if ($Validator->fails()) {
                        // If validation error occurs, load the error listing
                        return Redirect::route('admin.login')->withErrors($Validator);
                    } else {
                        $rememberMe = false; // set default boolean value for remember me

                        if ($request->input('remember_me')) // if user checked remember me
                            $rememberMe = true; // set user value

                        $email = $request->input('email');
                        $password = $request->input('password');

                        /* Check if user with same email exists, who is:-
                        1. Blocked or Not
                         */
                        $userExists = User::where(
                            array(
                                'email' => $email,
                                'is_active' => true,
                            ))->where(function ($query) {
                            $query->where('is_admin', true);
                        })->count();


                        if ($userExists > 0) {
                            // if user exists, check the password
                            $auth = auth()->guard('admin')->attempt([
                                'email' => $email,
                                'password' => $password,
                            ], $rememberMe);

                            if ($auth) {
                                return Redirect::Route('admin.dashboard');
                            } else {
                                $request->session()->flash('error', 'Invalid Password');
                                return Redirect::Route('admin.login');
                            }
                        } else {
                            $request->session()->flash('error', 'You are not an authorized user');
                            return Redirect::Route('admin.login');
                        }
                    }
                }
            } catch (Exception $e) {
                return Redirect::Route('admin.login')->with('error', $e->getMessage());
            }
        }
    }

    /*****************************************************/
    # AuthController
    # Function name : logout
    # Author        :
    # Created Date  : 20-07-2020
    # Purpose       : logout
    #
    #
    # Params        : Request $request
    /*****************************************************/

    public function logout()
    {
        if (Auth::guard('admin')->logout()) {
            return Redirect::Route('admin.login');
        } else {
            return Redirect::Route('admin.dashboard');
        }
    }

    /*****************************************************/
    # AuthController
    # Function name : forgotPassword
    # Author        :
    # Created Date  : 20-07-2020
    # Purpose       : Forgot Password
    #
    #
    # Params        : Request $request
    /*****************************************************/

    public function forgotPassword(Request $request)
    {
        $this->data['page_title'] = 'Forgot password';
        $this->data['panel_title'] = 'Forgot password';
        if (Auth::guard('admin')->check()) {
            // If admin is logged in, redirect him to dashboard page //
            return Redirect::Route('admin.dashboard');
        } else {
            try {
                if ($request->isMethod('post')) {
                    // Checking validation
                    $validationCondition = array(
                        'email' => 'required|email',
                    );
                    $validationMessages = array(
                        'email.required' => 'Please provide email id',
                        'email.email' => 'Please provide a valid email id',
                    );
                    $Validator = Validator::make($request->all(), $validationCondition, $validationMessages);

                    if ($Validator->fails()) {
                        // If validation error occurs, load the error listing
                        return Redirect::route('admin.forgot.password')->withErrors($Validator);
                    } else {
                        $email = $request->email;
                        $emailExists = User::where('email', $email)->count();
                        if ($emailExists > 0) // if this is a valid email
                        {
                            $user = User::where('email', $email)->first(); //Fetching Specific user Data
                            $encryptUserId = encrypt($user->id, Config::get('Constant.ENC_KEY')); // Encrypted user id using helper
                            $recoveryLink = route('admin.reset.password' ,['encryptCode'=>$encryptUserId ]); //making recovery link

                            // setting mail configuration
                            $toUser = $email;
                            $fromUser = env('MAIL_FROM_ADDRESS'); // getting data form .env file
                            $subject = 'Password Recovery : Bernays ';
                            $mailData = array('recoverLink' => $recoveryLink);

                            // Send mail
                            Mail::send('email.forgot-password', $mailData, function ($sent) use ($toUser, $fromUser, $subject) {
                                $sent->from($fromUser)->subject($subject);
                                $sent->to($toUser);
                            });
                            if (Mail::failures()) // if mail sending failed
                            {
                                return Redirect::Route('admin.forgot.password')->with('error', 'An error occurred while sending you the email containing the password');

                            } else // if password could not be saved successfully
                            {
                                return Redirect::Route('admin.forgot.password')->with('success', 'Password Recovery Link has been sent to your email.');
                            }
                        } else // if this email is not registered
                        {
                            return Redirect::Route('admin.forgot.password')->with('error', 'This email id is not registered');
                        }
                    }
                }
            } catch (Exception $e) {
                return Redirect::Route('admin.forgot.password')->with('error', $e->getMessage());
            }
        }
        return view('admin.forgot-password.admin-forgot-password', $this->data);
    }

    /*****************************************************/
    # AuthController
    # Function name : resetPassword
    # Author        :
    # Created Date  : 20-07-2020
    # Purpose       : Reset Password
    #
    #
    # Params        : Request $request $encryptString
    /*****************************************************/

    public function resetPassword(Request $request, $encryptString)
    {
        $this->data['page_title'] = 'Reset Password';
        $this->data['panel_title'] = 'Reset password';
        if (Auth::guard('admin')->check()) {
            // If admin is logged in, redirect him to dashboard page //
            return Redirect::Route('admin.dashboard');
        } else {
            try
            {
                if ($request->isMethod('post')) {
                    // Checking validation
                    $validationCondition = array(
                        'new_password' => 'required', // validation for new password
                        'confirm_password' => 'required|same:new_password',
                    );
                    $validationMessages = array(
                        'new_password.required' => 'New Password is required.',
                        'confirm_password.required' => 'Confirm Password is required.',
                        'confirm_password.same' => 'Confirm Password should be same as new password.',
                    );
                    $Validator = Validator::make($request->all(), $validationCondition, $validationMessages);

                    if ($Validator->fails()) {
                        // If validation error occurs, load the error listing
                        return Redirect::Route('admin.reset.password', ['encryptCode' => $encryptString])->withErrors($Validator);
                    } else {

                        $userId = decrypt($encryptString, Config::get('Constant.ENC_KEY')); // get user-id After Decrypt with salt key.

                        $user = User::findOrFail($userId);

                        if (!empty($user)) {
                            $user->password = $request->new_password;
                            $user->save();

                            return Redirect::Route('admin.login')->with('success', 'Your new password successfully updated.');
                        } else // if user not found
                        {
                            return Redirect::Route('admin.login')->with('error', 'Something went wrong.Please try again later.');
                        }
                    }
                }
            } catch (Exception $e) {
                return Redirect::Route('admin.reset.password', ['encryptCode' => $encryptString])->with('error', $e->getMessage());
            }
            $this->data['encryptCode'] = $encryptString;
            return view('admin.forgot-password.reset-password', $this->data);
        }
    }

    public function test(){
       $response= $this->compareWithCurrentTime('2020-08-18 11:00:24');
       dd($response);
    }

}
