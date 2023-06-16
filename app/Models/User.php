<?php

namespace App\Models;

use App\Models\UserType;
use App\Models\UserToken;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

   
    protected $fillable = [
        'name',
        'email',
        'image',
        'password',
        'password_confirmation',
        'user_type_id'
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function userToken(){
        return $this->hasOne(UserToken::class);
    }

    public function userType()
    {
        return $this->belongsTo(UserType::class);
    }
}
