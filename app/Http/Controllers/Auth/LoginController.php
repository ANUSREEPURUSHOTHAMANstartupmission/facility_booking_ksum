<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\LoginToken;
use App\Models\User;
use App\Rules\StrongPassword;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Str;

class LoginController extends Controller
{
    public function form(){

        if (Auth::check()) {
            return redirect()->route('home');
        }
        return view('auth.login');
    }

    public function investor_page(){
        return view('auth.investor');
    }

    // public function verify(Request $request, $token){
    //     $token = LoginToken::where('token', hash('sha256', $token))->firstOrFail();
    //     abort_unless($request->hasValidSignature() && $token->isValid(), 401);
    //     $token->consume();
    //     Auth::login($token->user, $remember = true);
    //     return redirect()->intended('/home');
    // }

    public function verifyOtp(Request $request)
    {
        $request->validate([
            'otp' => 'required|digits:6',
        ]);
    
        $email = session('email');
        $user = User::where('email', $email)->first();
        $otpData = LoginToken::where('user_id', $user->id)->latest()->first();
    
        if (!$otpData || !$otpData->isValid()) {  
            return redirect()->back()->withErrors(['otp' => 'OTP has expired. Request a new one.']);
        }
    
        if ((int) $otpData->token !== (int) $request->otp) {
            return redirect()->back()->withErrors(['otp' => 'Invalid OTP. Please try again.']);
        }
    
        $otpData->consume();
        Auth::login($user, true);
    
        return redirect()->route('home')->with('success', 'Login successful!');
    }
    
    
    


    public function showOtpForm(){

        if (Auth::check()) {
            return redirect()->route('home');
        }
        return view('auth.verify-otp');
    }


    // public function authenticate(Request $request){

    //     $request->validate([
    //         'email' => 'required|email',
    //     ]);

    //     $user = User::where('email', $request->input('email'))->first();

    //     if($user){
    //         $user->sendLoginToken();
    //         flash("Login Link has been send to your email", "success");
    //         // return redirect()->back();
    //         return view('auth.verify-otp');

    //     }
    //     else{
    //         return redirect()->route('register', [ 'email' => $request->input('email') ]);
    //     }

    // }

    public function authenticate(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users,email',
        ]);

        $user = User::where('email', $request->email)->first();

        if (!$user) {
            return redirect()->route('register', ['email' => $request->email]);
        }

        // Generate OTP & Send Email
        $user->sendLoginToken();

        session(['email' => $request->email]);

        return redirect()->route('verify-otp')->with('success', 'OTP has been sent to your email.');
    }


    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        flash("Logged out successfully", "success");

        if($request->redirect){
            return redirect($request->redirect);
        }
        else{
            return redirect()->route('login');
        }
    }

}
