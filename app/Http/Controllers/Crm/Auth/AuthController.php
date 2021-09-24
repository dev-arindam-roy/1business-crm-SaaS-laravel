<?php

namespace App\Http\Controllers\Crm\Auth;

use App\Http\Controllers\Controller;
use App\Events\AccountEmailVerificationEvent;
use App\Events\ResetPasswordEvent;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Subdomain;
use App\Models\BusinessInformation;
use App\Models\PasswordReset;
use Carbon\Carbon;
use Session;
use Helper;
use Hash;
use Auth;

class AuthController extends Controller
{
    public function __construct()
    {
        
    }

    public function createAccount(Request $request)
    {
        $DataBag = [];
        return view('crm.create-account', $DataBag);
    }

    public function createAccountProcess(Request $request)
    {
        $requestData = $request->all();
        $validationRules = [
            'first_name' => ['bail', 'required', 'min:3', 'max:30', 'regex:/^[a-z A-Z]+$/'],
            'last_name' => ['bail', 'required', 'min:3', 'max:30', 'regex:/^[a-z A-Z]+$/'],
            'email_id' => ['bail', 'required', 'email', 'max:60', 'unique:users,email_id'],
            'mobile_number' => ['bail', 'required', 'digits_between:10,12', 'unique:users,mobile_number'],
            'password' => ['bail', 'required', 'min:8', 'max:20'],
            'confirm_password' => ['bail', 'required', 'same:password'],
            'business_name' => ['bail', 'required', 'max:60'],
            'subdomain' => ['bail', 'required', 'min:3', 'max:20', 'regex:/^[a-zA-Z0-9.-]+$/', 'unique:subdomains,name']
        ];
        $validationMessages = [
            'first_name.required' => 'Please enter first name.',
            'first_name.min' => 'First name required atleast 3 characters.',
            'first_name.max' => 'First name should less than 30 characters.',
            'first_name.regex' => 'First name should be alphabetic characters',
            'last_name.required' => 'Please enter last name.',
            'last_name.min' => 'Last name required atleast 3 characters.',
            'last_name.max' => 'Last name should less than 30 characters.',
            'last_name.regex' => 'Last name should be alphabetic characters',
            'email_id.required' => 'Please enter email address.',
            'email_id.email' => 'Please enter an valid email address',
            'email_id.max' => 'Email address should less than 60 characters.',
            'email_id.unique' => 'Email address already exist, Please try another.',
            'mobile_number.required' => 'Please enter mobile number.',
            'mobile_number.digits_between' => 'Please enter valid 10-12 digits mobile number.',
            'mobile_number.unique' => 'Mobile number already exist, Please try another.',
            'password.required' => 'Please enter password.',
            'password.min' => 'Password required atleast 8 characters.',
            'password.max' => 'Password should less than 20 characters.',
            'confirm_password.required' => 'Please enter confirm password',
            'confirm_password.same' => 'Confirm password not match with password',
            'business_name.required' => 'Please enter business name.',
            'business_name.max' => 'Business name should less than 60 characters.',
            'subdomain.required' => 'Please enter business url.',
            'subdomain.regex' => 'Please enter a valid business url',
            'subdomain.min' => 'Business url required atleast 3 characters.',
            'subdomain.max' => 'Business url should less than 20 characters.',
            'subdomain.unique' => 'Business url already exist, Please try another.'
        ];
        $validator = Validator::make($requestData, $validationRules, $validationMessages);
        if ($validator->fails()) {
            return back()->withErrors($validator, 'createAccountValidation')->withInput();
        }
        if ($this->createAccountBusinessLogic($request)) {
            $successToken = base64_encode($request->input('email_id'));
            return redirect()->route('auth.createAccount.Success', array('success_token' => $successToken));
        }
        return back();
    }

    public function createAccountBusinessLogic($requestObj)
    {
        $user = new User;
        $user->first_name = $requestObj->input('first_name');
        $user->last_name = $requestObj->input('last_name');
        $user->email_id = $requestObj->input('email_id');
        $user->mobile_number = $requestObj->input('mobile_number');
        $user->password = Hash::make($requestObj->input('password'));
        $user->is_owner = 1;
        $user->email_verify_token = Helper::generateToken($user->id);
        $user->email_verify_token_expire_at = Carbon::now()->addSeconds(86400);
        if ($user->save()) {
            $subdomain = new Subdomain;
            $subdomain->name = $requestObj->input('subdomain');
            $subdomain->user_id = $user->id;
            $subdomain->save();
            $businessInformation = new BusinessInformation;
            $businessInformation->business_name = $requestObj->input('business_name');
            $businessInformation->user_id = $user->id;
            $businessInformation->save();
            AccountEmailVerificationEvent::dispatch($user);
            return true;
        }
        return false;
    }

    public function createAccountSuccess(Request $request, $successToken)
    {
        $DataBag = [];
        $DataBag['token'] = $successToken;
        $decodeToken = base64_decode($successToken);
        $user = User::where('email_id', $decodeToken)
            ->where('status', 0)
            ->whereNotNull('email_verify_token')
            ->whereNull('email_verified_at')
            ->whereNotNull('email_verify_token_expire_at')
            ->first();
        if (empty($user)) {
            return redirect()->route('auth.createAccount');
        }
        $DataBag['user'] = $user;
        return view('crm.create-account-success', $DataBag);
    }

    public function accountEmailVerification(Request $request, $token)
    {
        $user = User::where('email_verify_token', $token)->first();
        if (!empty($user) && $user->email_verify_token_expire_at != '') {
            $expiredDateTime = new Carbon($user->email_verify_token_expire_at);
            if (!$expiredDateTime->isPast() && $user->status == 0) {
                $user->status = 1;
                $user->email_verify_token = NULL;
                $user->email_verify_token_expire_at = NULL;
                $user->email_verified_at = Carbon::now()->format('Y-m-d H:i:s');
                $user->save();

                $subdomain = Subdomain::where('user_id', $user->id)->first();
                if (!empty($subdomain)) {
                    $subdomain->status = 1;
                    $subdomain->save();
                    $emailDecode = base64_encode($user->email_id);
                    $businessLoginUrl = route('auth.businessLogin', array('subdomain' => $subdomain->name)) . '?emailVerified=' . $emailDecode;
                    return redirect()->away($businessLoginUrl);
                }
            }
        }
        return redirect()->route('auth.createAccount');
    }

    public function businessLogin(Request $request, $subdomain)
    {
        $DataBag = [];
        if ($request->get('emailVerified') && $request->get('emailVerified') != '') {
            $emailId = base64_decode($request->get('emailVerified'));
            $user = User::where('email_id', $emailId)->whereNotNull('email_verified_at')->whereNull('first_login_at')->first();
            if (!empty($user)) {
                $DataBag['emailVerifiedMsg'] = true;
            }
        }
        $subdomain = Subdomain::where('name', $subdomain)->whereIn('status', [1, 2])->first();
        if (!empty($subdomain)) {
            $ownerUser = User::findOrFail($subdomain->user_id);
            $businessInformation = BusinessInformation::where('user_id', $subdomain->user_id)->first();
            if (!empty($businessInformation)) {
                $DataBag['subDomain'] = $subdomain;
                $DataBag['businessInfo'] = $businessInformation;
                $DataBag['ownerInfo'] = $ownerUser;
                return view('crm.business-sign-in', $DataBag);
            }
        }
        return redirect()->route('auth.createAccount');
    }

    public function signIn(Request $request)
    {
        $DataBag = [];
        return view('crm.sign-in', $DataBag);
    }

    public function forgotPassword(Request $request)
    {
        $DataBag = [];
        return view('crm.forgot-password', $DataBag);
    }

    public function forgotPasswordProcess(Request $request)
    {
        $requestData = $request->all();
        $validationRules = [
            'email_id' => ['bail', 'required', 'email', 'max:60']
        ];
        $validationMessages = [
            'email_id.required' => 'Please enter email address.',
            'email_id.email' => 'Please enter an valid email address',
            'email_id.max' => 'Email address should less than 60 characters.'
        ];
        $validator = Validator::make($requestData, $validationRules, $validationMessages);
        if ($validator->fails()) {
            return back()->withErrors($validator, 'forgotPasswordValidation')->withInput();
        }

        $user = User::where('email_id', $request->input('email_id'))->first();
        if (empty($user)) {
            $msgBox = [];
            $msgBox['title'] = '<strong>Sorry!</strong> This email address not associate with the system.';
            $msgBox['type'] = 'alert-danger';
            return back()->with('msgbox', $msgBox)->withInput();
        }
        PasswordReset::where('email_id', $user->email_id)->delete();
        $passwordReset = new PasswordReset;
        $passwordReset->email_id = $user->email_id;
        $passwordReset->token = Helper::generateToken($user->id);
        $passwordReset->expire_at = Carbon::now()->addSeconds(86400);
        $passwordReset->save();
        ResetPasswordEvent::dispatch($user);
        $msgBox = [];
        $msgBox['title'] = '<strong>Done!</strong> Reset password link has been sent to your mail, thanks.';
        $msgBox['type'] = 'alert-success';
        return back()->with('msgbox', $msgBox);
    }

    public function resetPassword(Request $request, $token)
    {
        $DataBag = [];
        $DataBag['token'] = $token;
        $passwordReset = PasswordReset::where('token', $token)->first();
        if (empty($passwordReset)) {
            return redirect()->route('auth.createAccount');
        }
        $expiredDateTime = new Carbon($passwordReset->expire_at);
        if ($expiredDateTime->isPast()) {
            $msgBox = [];
            $msgBox['title'] = '<strong>Sorry!</strong> Reset password token is expired, Please generate again.';
            $msgBox['type'] = 'alert-danger';
            return redirect()->route('auth.forgotPassword')->with('msgbox', $msgBox)->withInput();
        }
        return view('crm.reset-password', $DataBag);
    }

    public function resetPasswordProcess(Request $request, $token)
    {
        $requestData = $request->all();
        $validationRules = [
            'password' => ['bail', 'required', 'min:8', 'max:20'],
            'confirm_password' => ['bail', 'required', 'same:password'],
        ];
        $validationMessages = [
            'password.required' => 'Please enter password.',
            'password.min' => 'Password required atleast 8 characters.',
            'password.max' => 'Password should less than 20 characters.',
            'confirm_password.required' => 'Please enter confirm password',
            'confirm_password.same' => 'Confirm password not match with password'
        ];
        $validator = Validator::make($requestData, $validationRules, $validationMessages);
        if ($validator->fails()) {
            return back()->withErrors($validator, 'resetPasswordValidation')->withInput();
        }
        $passwordReset = PasswordReset::where('token', $token)->first();
        if (empty($passwordReset)) {
            return redirect()->route('auth.createAccount');
        }
        $expiredDateTime = new Carbon($passwordReset->expire_at);
        if ($expiredDateTime->isPast()) {
            $msgBox = [];
            $msgBox['title'] = '<strong>Sorry!</strong> Reset password token is expired, Please generate again.';
            $msgBox['type'] = 'alert-danger';
            return redirect()->route('auth.forgotPassword')->with('msgbox', $msgBox)->withInput();
        }
        $user = User::where('email_id', $passwordReset->email_id)->first();
        if (empty($user)) {
            return redirect()->route('auth.createAccount');
        }
        $user->password = Hash::make($request->input('password'));
        $user->save();
        PasswordReset::where('email_id', $passwordReset->email_id)->delete();
        $msgBox = [];
        $msgBox['title'] = '<strong>Done!</strong> New password successfully set, Please Sign In.';
        $msgBox['type'] = 'alert-success';
        return redirect()->route('auth.signIn')->with('msgbox', $msgBox);
    }

    public function signInProcess(Request $request)
    {   
        $validator = $this->loginValidations($request);
        if (!empty($validator)) {
            return back()->withErrors($validator, 'signInValidation')->withInput();
        }

        $signinId = $request->input('signin_id');
        $password = $request->input('password');
        if (Auth::attempt(['email_id' => $signinId, 'password' => $password])) {
            Session::put('signInBy', 'EmailAddress');
        } elseif (Auth::attempt(['mobile_number' => $signinId, 'password' => $password])) {
            Session::put('signInBy', 'MobileNumber');
        } else {
            $msgBox = [];
            $msgBox['title'] = '<strong>SignIn Failed!</strong> <br/> Wrong or Invalid sign-in credentials. Please try again.';
            $msgBox['type'] = 'alert-danger';
            return back()->with('msgbox', $msgBox)->withInput();
        }

        $response = $this->signInBusinessLogic($request);
        if (!empty($response) && $response['type'] == 'error') {
            $msgBox = [];
            $msgBox['title'] = $response['msg'];
            $msgBox['type'] = 'alert-danger';
            $msgBox['errorType'] = $response['errorType'];
            $msgBox['email'] = base64_encode(Auth::user()->email_id);
            Auth::logout();
            Session::forget('signInBy');
            return back()->with('msgbox', $msgBox)->withInput();
        }
        Session::put('signInDomain', $response['subdomainName']);
        $this->firstLogin();
        $this->setRememberMe($request);
        return redirect()->route('account.myDashboard', array('subdomain' => $response['subdomainName']));
    }

    public function businessLoginProcess(Request $request)
    {
        $validator = $this->loginValidations($request);
        if (!empty($validator)) {
            return back()->withErrors($validator, 'signInValidation')->withInput();
        }

        $signinId = $request->input('signin_id');
        $password = $request->input('password');
        if (Auth::attempt(['email_id' => $signinId, 'password' => $password])) {
            Session::put('signInBy', 'EmailAddress');
        } elseif (Auth::attempt(['mobile_number' => $signinId, 'password' => $password])) {
            Session::put('signInBy', 'MobileNumber');
        } else {
            $msgBox = [];
            $msgBox['title'] = '<strong>SignIn Failed!</strong> <br/> Wrong or Invalid sign-in credentials. Please try again.';
            $msgBox['type'] = 'alert-danger';
            return back()->with('msgbox', $msgBox)->withInput();
        }

        $response = $this->signInBusinessLogic($request);
        if (!empty($response) && $response['type'] == 'error') {
            $msgBox = [];
            $msgBox['title'] = $response['msg'];
            $msgBox['type'] = 'alert-danger';
            $msgBox['errorType'] = $response['errorType'];
            Auth::logout();
            Session::forget('signInBy');
            return back()->with('msgbox', $msgBox)->withInput();
        }
        Session::put('signInDomain', $response['subdomainName']);
        $this->firstLogin();
        $this->setRememberMe($request);
        return redirect()->route('account.myDashboard', array('subdomain' => $response['subdomainName']));
    }

    public function loginValidations($request)
    {
        $requestData = $request->all();
        $validationRules = [
            'signin_id' => ['bail', 'required'],
            'password' => ['bail', 'required']
        ];
        $validationMessages = [
            'signin_id.required' => 'Please enter email address or mobile number.',
            'password.required' => 'Please enter password.'
        ];
        $validator = Validator::make($requestData, $validationRules, $validationMessages);
        if ($validator->fails()) {
            return $validator;
        }
        return array();
    }

    public function signInBusinessLogic($requestObj)
    {
        $signinId = $requestObj->input('signin_id');
        $responseArr = [];
        $responseArr['msg'] = '';
        $responseArr['type'] = 'success';

        $user = Auth::user();

        if ($user->email_verified_at == '' || $user->email_verified_at == null) {
            $responseArr['msg'] = '<strong>SignIn Failed</strong> <br/> Your email address not verified. Please verify email first, thankyou.';
            $responseArr['type'] = 'error';
            $responseArr['errorType'] = 'emailVerification';
            return $responseArr;
        }

        if ($user->is_owner == 1 && $user->status != 1) {
            $responseArr['msg'] = '<strong>SignIn Failed</strong> <br/> Your account has Inactive or Blocked. Please contact to support@1businesscrm.in, thankyou.';
            $responseArr['type'] = 'error';
            $responseArr['errorType'] = 'userInactive';
            return $responseArr;
        }

        if ($user->is_owner == 0 && $user->status != 1) {
            $responseArr['msg'] = '<strong>SignIn Failed</strong> <br/> Your account has Inactive or Blocked. Please contact to Administrator, thankyou.';
            $responseArr['type'] = 'error';
            $responseArr['errorType'] = 'userInactive';
            return $responseArr;
        }

        if ($user->is_owner == 1) {
            $responseArr['subdomainName'] = $user->subdomainInfo->name;
            if ($user->subdomainInfo->status != 1) {
                $responseArr['msg'] = '<strong>SignIn Failed</strong> <br/> Business account has temporary Inactive or Blocked. Please contact to support@1businesscrm.in, thankyou.';
                $responseArr['type'] = 'error';
                $responseArr['errorType'] = 'subdomainInactive';
                return $responseArr;
            }
        }

        if ($user->is_owner == 0) {
            $subdomain = Subdomain::where('user_id', $user->owner_id)->first();
            $responseArr['subdomainName'] = $subdomain->name;
            if (!empty($subdomain) && $subdomain->status != 1) {
                $responseArr['msg'] = '<strong>SignIn Failed</strong> <br/> Business account has temporary Inactive or Blocked. Please contact to Administrator, thankyou.';
                $responseArr['type'] = 'error';
                $responseArr['errorType'] = 'subdomainInactive';
                return $responseArr;
            }
        }
        return $responseArr;
    }

    public function firstLogin()
    {
        if (Auth::user()->first_login_at != '' && Auth::user()->first_login_at != null) {
            $user = User::find(Auth::user()->id);
            $user->first_login_at = Carbon::now()->format('Y-m-d H:i:s');
            $user->save();
        }
    }

    public function setRememberMe($requestObj)
    {
        if ($requestObj->has('remember_me') && $requestObj->input('remember_me') == 1) {
            setcookie("obcSignInID", $requestObj->input('signin_id'), time() + (86400 * 30 * 30), "/");
            setcookie("obcPassword", $requestObj->input('password'), time() + (86400 * 30 * 30), "/");
        } else {
            setcookie("obcSignInID", "", time() - 3600, "/");
            setcookie("obcPassword", "", time() - 3600, "/");
            unset($_COOKIE['obcSignInID']);
            unset($_COOKIE['obcPassword']);
        }
    }

    public function subdomainLogin(Request $request, $subdomain)
    {
        return redirect()->route('auth.businessLogin', array('subdomain' => $subdomain));
    }

    public function resendVerification(Request $request, $successToken)
    {
        $decodeToken = base64_decode($successToken);
        $user = User::where('email_id', $decodeToken)
            ->where('status', 0)
            ->whereNotNull('email_verify_token')
            ->whereNull('email_verified_at')
            ->whereNotNull('email_verify_token_expire_at')
            ->first();
        if (empty($user)) {
            return redirect()->route('auth.createAccount');
        }
        AccountEmailVerificationEvent::dispatch($user);
        $msgBox = [];
        $msgBox['title'] = "<strong>Account verification mail sent successfully. Please check your mail inbox, thankyou.</strong>";
        return redirect()->back()->with('msgbox', $msgBox);
    }

    public function changeEmail(Request $request, $successToken)
    {
        $requestData = $request->all();
        $validationRules = [
            'email_id' => ['bail', 'required', 'email', 'max:60', 'unique:users,email_id']
        ];
        $validationMessages = [
            'email_id.required' => 'Please enter email address.',
            'email_id.email' => 'Please enter an valid email address',
            'email_id.max' => 'Email address should less than 60 characters.',
            'email_id.unique' => 'Email address already exist, Please try another.'
        ];
        $validator = Validator::make($requestData, $validationRules, $validationMessages);
        if ($validator->fails()) {
            return back()->withErrors($validator, 'changeEmailValidation')->withInput();
        }
        $decodeToken = base64_decode($successToken);
        $user = User::where('email_id', $decodeToken)
            ->where('status', 0)
            ->whereNotNull('email_verify_token')
            ->whereNull('email_verified_at')
            ->whereNotNull('email_verify_token_expire_at')
            ->first();
        if (empty($user)) {
            return redirect()->route('auth.createAccount');
        }
        $user->email_id = $request->input('email_id');
        $user->save();
        $successToken = base64_encode($user->email_id);
        AccountEmailVerificationEvent::dispatch($user);
        $msgBox = [];
        $msgBox['title'] = "<strong>Email address has been changed successfully.<br/>Account verification mail sent successfully. Please check your mail inbox, thankyou.</strong>";
        return redirect()->route('auth.createAccount.Success', array('success_token' => $successToken))->with('msgbox', $msgBox);
    }
}
