<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'type',
        'username',
        'email',
        'password',
        'status',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function appsetting() {
        return $this->hasOne(AppSetting::class, 'userId', 'id');
    }
    public function member() {
        return $this->hasOne(Members::class, 'userId', 'id');
    }
    public function usertype() {
        return $this->hasOne(UserType::class, 'id', 'type');
    }
    public function hualarm() {
        return $this->hasOne(HuAlarm::class, 'username','username');
    }

    // public function usertype()
    // {
    //   return $this->belongsTo('App\Models\UserType');
    // }
}
