<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Helpers\UidHelper;
use App\Helpers\OtpHelper;
use App\Models\User;
use Illuminate\Support\Facades\Auth;


class UserControlleruid extends Controller
{
    public function verifyUser(Request $request)
    {
        $request->validate([
            'user_id' => 'required'
        ]);
    
        $uid_details = UidHelper::getUidDetails($request->user_id);
    
        if (!$uid_details || !isset($uid_details['login_email'])) {
            return redirect()->route('otp.form')->with('error', 'Unique ID details not found.');
        }
    
        $email = $uid_details['login_email'];
        $uid = $uid_details['unique_id'];
    
        $existingUser = User::where('uid', $uid)->first();
    
        if ($existingUser && $existingUser->id !== Auth::id()) {
            return redirect()->route('otp.form')->with('error', 'This Unique ID is already linked to a different account.');
        }
    
        OtpHelper::createToken($uid, $email);
    
        session([
            'uid' => $uid,
            'uid_email' => $email,
            'show_otp' => true
        ]);
    
        return redirect()->route('otp.form')->with('success', 'OTP sent to ' . $email);
    }
    




    
    public function verifyOtp(Request $request)
    {
        $request->validate([
            'otp' => 'required|numeric|digits:6'
        ]);
    
        $uid = session('uid');
    
        if (OtpHelper::checkOtp($request->otp, $uid)) {
            // Get the authenticated user
            $user = Auth::user();
    
            if ($user) {
                $user->update([
                    'uid' => $uid,
                    'is_verified' => 1
                ]);
    
                // Retrieve the stored booking URL or fallback to home
                $previousUrl = session('previous_url', route('home'));
    
                // Clear session data
                session()->forget(['uid', 'uid_email', 'show_otp', 'previous_url']);
    
                // return redirect($previousUrl)->with('success', 'Verification successful.');
                return redirect()->route('home')->with('success', 'Verification successful.');

            } else {
                return back()->withErrors(['otp' => 'User not authenticated.']);
            }
        }
    
        return back()->withErrors(['otp' => 'Invalid or expired OTP.']);
    }
    
}
