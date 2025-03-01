<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function loginHandler(Request $request){
        $fieldType = filter_var($request->login_id, FILTER_VALIDATE_EMAIL) ? 'email' : 'username';

        if($fieldType == 'email'){
            $request->validate([
                'login_id' => 'required|email|exists:admins,email',
                'password' => 'required|min:5|max:45',
            ], [
                'login_id.required' => 'Email or Username is required',
                'login_id.email' => 'Invalid email address',
                'login_id.exists' => 'Email does not exist on system',
                'password.required' => 'Password is required'
            ]);
        } else {
            $request->validate([
                'login_id' => 'required|exists:admins,username',
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

        if(Auth::guard('admin')->attempt($creds)){
            return redirect()->route('admin.home');
        } else {
            session()->flash('fail', 'Incorrect Credentials');
            return redirect()->route('admin.login');
        }
    }

    public function logoutHandler(Request $request){
        Auth::guard('admin')->logout();
        session()->flash('fail', 'You are logged out');
        return redirect()->route('admin.login');
    }
}
