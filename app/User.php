<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Str;
use Laravel\Passport\HasApiTokens;

class User extends Authenticatable
{
    use Notifiable,HasApiTokens;
protected $table='users';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','role','verified','verification_token'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    const VERIFIED_USER='1';
    const UNVERIFIED_USER='0';
    const ADMIN_USER='true';
    const REGULAR_USER='false';

    public function isAdmin(){
        return $this->role==User::ADMIN_USER;
    }
    public function isVerified(){
        return $this->verified==User::VERIFIED_USER;
    }

    public static function generateVerificationToken(){
        return Str::random(40);
    }

    public function freebooks(){
        return $this->hasMany(Freebook::class);
    }
}
