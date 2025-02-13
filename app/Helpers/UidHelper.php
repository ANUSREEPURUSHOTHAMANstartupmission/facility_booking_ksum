<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Http;

class UidHelper
{
  public static function checkEmail($email){

     //check if email id is in uid database
    $req = Http::withHeaders([
      'x-auth-key' => config('uid.key'),
      'x-auth-secret' => config('uid.secret')
    ])->asForm()->post(config('uid.server').'/api/v1/email/verify', [
        'email' => $email
    ]);

    if($req->successful()){
      $data = $req->json();

      return $data['unique_id'] ?? false;
    }

    return false;
  }

  public static function getUidDetails($uid){

    $req = Http::withHeaders([
      'x-auth-key' => config('uid.key'),
      'x-auth-secret' => config('uid.secret')
    ])->post(config('uid.server').'/api/v1/startup/details', [
        'unique_id' => $uid
    ]);

    if($req->successful()){
      $data = $req->json();

      return $data['data'] ?? false;      
    }

    return false;

  }

  


}