<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\Controller;
use App\Models\Seller;
use App\Models\VerificationToken;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Carbon;
use constGuards;
use constDefaults;
use Illuminate\Support\Facades\DB;

class SellerController extends Controller
{
    public function login(Request $request){
        $data = [
            'pageTitle' => 'Seller Login'
        ];

        return view('back.pages.seller.auth.login', $data);
    }
    
    public function register(Request $request){
        $data = [
            'pageTitle' => 'Create Seller Account'
        ];

        return view('back.pages.seller.auth.register', $data);
    }
    
    public function home(Request $request){
        $data = [
            'pageTitle' => 'Seller Dashboard'
        ];

        return view('back.pages.seller.home', $data);
    }

    public function createSeller(Request $request){
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:sellers',
            'password' => 'min:5|required_with:confirm_password|same:confirm_password',
            'confirm_password' => 'min:5'
        ]);

        $seller = new Seller();
        $seller->name = $request->name;
        $seller->email = $request->email;
        $seller->password = Hash::make($request->password);
        $saved = $seller->save();

        if ($saved) {
            # GENERATE TOKEN
            $token = base64_encode(Str::random(64));

            VerificationToken::create([
                'user_type' => 'seller',
                'email' => $request->email,
                'token' => $token
            ]);

            $actionLink = route('seller.verify', ['token' => $token]);
            $data['action_link'] = $actionLink;
            $data['seller_name'] = $request->name;
            $data['seller_email'] = $request->email;

            // Send activation link to this seller email
            $mail_body = view('email-templates.seller-verify-template', $data)->render();

            $mailConfig = array(
                'mail_from_email' => env('EMAIL_FROM_ADDRESS'),
                'mail_from_name' => env('EMAIL_FROM_NAME'),
                'mail_recipient_email' => $request->email,
                'mail_recipient_name' => $request->name,
                'mail_subject' => 'Verify Seller Account',
                'mail_body' => $mail_body
            );

            if (sendEmail($mailConfig)) {
                return redirect()->route('seller.register-success');
            } else {
                return redirect()->route('seller.register')->with('fail', 'Something went wrong while sending 
                verificastion link.');
            }
        } else {
            return redirect()->route('seller.register')->with('fail', 'Something went wrong');
        }
    }

    public function verifyAccount(Request $request, $token){
        $verifyToken = VerificationToken::where('token', $token)->first();

        if (!is_null($verifyToken)) {
            $seller = Seller::where('email', $verifyToken->email)->first();

            if (!$seller->verified ) {
                $seller->verified = 1;
                $seller->email_verified_at = Carbon::now();
                $seller->save();

                return redirect()->route('seller.login')->with('success', 'Good!, your email is verified. Login with 
                your credentials and complete setup your seller account');
            } else {
                return redirect()->route('seller.login')->with('info', 'Your email is already verified. You can now login.');
            }
        } else {
            return redirect()->route('seller.register')->with('fail', 'Invalid token');
        }
    }
    
    public function registerSuccess(Request $request){

        return view('back.pages.seller.register-success');
    }

    public function loginHandler(Request $request){
        $fieldType = filter_var($request->login_id, FILTER_VALIDATE_EMAIL) ? 'email' : 'username';

        if($fieldType == 'email'){
            $request->validate([
                'login_id' => 'required|email|exists:sellers,email',
                'password' => 'required|min:5|max:45',
            ], [
                'login_id.required' => 'Email or Username is required',
                'login_id.email' => 'Invalid email address',
                'login_id.exists' => 'Email does not exist on system',
                'password.required' => 'Password is required'
            ]);
        } else {
            $request->validate([
                'login_id' => 'required|exists:sellers,username',
                'password' => 'required|min:5|max:45',
            ], [
                'login_id.required' => 'Email or Username is required',
                'login_id.exists' => 'Username does not exist on system',
                'password.required' => 'Password is required'
            ]);   
        }

        $creds = array(
            $fieldType => $request->login_id,
            'password' => $request->password 
        );

        if(Auth::guard('seller')->attempt($creds)){
            if (!auth('seller')->user()->verified) {
                auth('seller')->logout();
                return redirect()->route('seller.login')->withInput()->with('fail', 'Your account is not verified. Check in 
                your email and click on the link we had sent in order to verify your email for seller account.');
            } else {
                return redirect()->route('seller.home');
            }
        } else {
            // session()->flash('fail', 'Incorrect Credentials');
            return redirect()->route('seller.login')->withInput()->with('fail', 'Incorrect Password');
        }
    }

    public function logoutHandler(Request $request){
        Auth::guard('seller')->logout();
        return redirect()->route('seller.login')->withInput()->with('fail', 'You are logged out.');
    }

    public function forgotPassword(Request $request){
        $data = [
            'pageTitle' => 'Forgot Password'
        ];

        return view('back.pages.seller.auth.forgot', $data);
    }

    public function sendPasswordResetLink(Request $request){
        // Validate the form
        $request->validate([
            'email' => 'required|email|exists:sellers,email'
        ], [
            'email.required' => 'The :attribute is required',
            'email.email' => 'Invalid email address',
            'email.exists' => 'The :attribute is not exists in our system'
        ]);

        // Get seller details
        $seller = Seller::where('email', $request->email)->first();

        // Generate token
        $token = base64_encode(Str::random(64));

        // Check if their is an existing reset token for this seller
        $oldToken = DB::table('password_reset_tokens')
                    ->where(['email' => $seller->email, 'guard' => constGuards::SELLER])
                    ->first();

        if ($oldToken) {
            // UPDATE EXISTING TOKEN
            DB::table('password_reset_tokens')
                ->where(['email' => $seller->email, 'guard' => constGuards::SELLER])
                ->update([
                    'token' => $token,
                    'created_at' => Carbon::now()
                ]);
        } else {
            // INSERT NEW RESET PASSWORD TOKEN
            DB::table('password_reset_tokens')
            ->insert([
                'email' => $seller->email,
                'guard' => constGuards::SELLER,
                'token' => $token,
                'created_at' => Carbon::now()
            ]);
        }

        $actionLink = route('seller.reset-password', ['token' => $token, 'email' => 
            urlencode($seller->email)]);

        $data['actionLink'] = $actionLink;
        $data['seller'] = $seller;
        $mail_body = view('email-templates.seller-forgot-email-template', $data)->render();

        $mailConfig = array(
            'mail_from_email' => env('EMAIL_FROM_ADDRESS'),
            'mail_from_name' => env('EMAIL_FROM_NAME'),
            'mail_recipient_email' => $seller->email,
            'mail_recipient_name' => $seller->name,
            'mail_subject' => 'Reset Password',
            'mail_body' => $mail_body
        );

        if (sendEmail($mailConfig)) {
            return redirect()->route('seller.forgot-password')->with('success', 'we have emailed your password
            reset link');
        } else {
            return redirect()->route('seller.forgot-password')->with('fail', 'Something went wrong.');
        }
    }

    public function showResetForm(Request $request, $token = null){
        // Check if token exist
        $get_token = DB::table('password_reset_tokens')
                    ->where(['token' => $token, 'guard' => constGuards::SELLER])
                    ->first();

        if ($get_token) {
            // Check if this token is not expired
            $diffMins = Carbon::createFromFormat('Y-m-d H:i:s', $get_token->created_at)
                ->diffInMinutes(Carbon::now());

            if ($diffMins > constDefaults::tokenExpiredMinutes) {
                return redirect()->route('seller.forgot-password', ['token' => $token])->with
                ('fail', 'Token expired!. Request another reset password link.');
                
            } else {
                return view('back.pages.seller.auth.reset')->with(['token' => $token]);
            }
        } else {                
            return redirect()->route('seller.forgot-password', ['token' => $token])->with
            ('fail', 'Invalid token! request another reset password link.');
        }
    }

    public function resetPasswordHandler(Request $request){
        $request->validate([
            'new_password' => 'required|min:5|max:45|required_with:confirm_new_password|
                same:confirm_new_password',
            'confirm_new_password' => 'required'
        ]);
        $token = DB::table('password_reset_tokens')
                    ->where(['token' => $request->token, 'guard' => constGuards::SELLER])
                    ->first();

        // GET SELLER DETAILS
        $seller = Seller::where('email', $token->email)->first();

        // Update seller password
        Seller::where('email', $seller->email)->update([
            'password' => Hash::make($request->new_password)
        ]);

        //Delete token record
        $token = DB::table('password_reset_tokens')->where([
            'email' => $seller->email,
            'token' => $request->token,
            'guard' => constGuards::SELLER,
            ])->delete();

        $data['seller'] = $seller;
        $data['new_password'] = $request->new_password;
        $mail_body = view('email-templates.seller-reset-email-template', $data)->render();

        $mailConfig = array(
            'mail_from_email' => env('EMAIL_FROM_ADDRESS'),
            'mail_from_name' => env('EMAIL_FROM_NAME'),
            'mail_recipient_email' => $seller->email,
            'mail_recipient_name' => $seller->name,
            'mail_subject' => 'Password Changed',
            'mail_body' => $mail_body
        );

        sendEmail($mailConfig);

        return redirect()->route('seller.login')->with('success', 'Done!, your password has been changed');
    }
}
