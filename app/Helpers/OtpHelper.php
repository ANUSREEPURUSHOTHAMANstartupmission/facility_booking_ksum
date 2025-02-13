<?php

namespace App\Helpers;

use App\Models\LoginUidToken;
use App\Notifications\Uidverification;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Auth;

class OtpHelper {

    public static function createToken($uid, $email)
    {
        $otp = self::_generate(); 
        $user_email = Auth::user()->email;
        
        $token = LoginUidToken::create([
            'uid' => $uid,
            'email' => $email,
            'token' => $otp, 
            'expires_at' => now()->addMinutes(15),
        ]);

        Notification::route('mail', $email)->notify(new Uidverification($otp, $token->expires_at,  $user_email));

        return $otp; 
    }

    private static function _generate()
    {
        return str_pad(mt_rand(0, 999999), 6, '0', STR_PAD_LEFT); 
    }

    public static function checkOtp($otp, $uid)
    {
        $token = LoginUidToken::where('token', $otp)->where('uid', $uid)->where('expires_at', '>', now())->first();

        if ($token) {
            $token->delete();
            return true;
        }

        return false;
    }
}
