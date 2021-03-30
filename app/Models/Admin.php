<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use App\Notifications\ResetAdminPassword;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Admin extends Authenticatable implements MustVerifyEmail
{
    use Notifiable;


    // this method to send password reset link to email
    public function sendPasswordResetNotification($token)
    {
        $this->notify(new ResetAdminPassword($token));
    }

    protected $guard = "admin";

    protected $fillable = ['name', 'email', 'password',];

    protected $hidden = ['password', 'remember_token', 'created_at', 'updated_at'];

    public $timestamps = false;

}
