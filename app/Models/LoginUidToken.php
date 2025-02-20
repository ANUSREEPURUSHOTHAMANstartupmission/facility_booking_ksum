<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LoginUidToken extends Model
{
    use HasFactory;

    protected $fillable = ['uid', 'email', 'token', 'expires_at'];

    public function isValid()
    {
        return $this->expires_at > now();
    }

    public function consume()
    {
        return $this->delete();
    }
}
