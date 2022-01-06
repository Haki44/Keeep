<?php

namespace App\Models;

use App\Models\Role;
use App\Models\School;
use App\Models\PrivateMessage;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Facades\Config;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'name',
        'firstname',
        'address',
        'phone',
        'email',
        'password',
        'role_id',
        'register_token',
        'school_id'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    protected $with = [
        'role',
        'school'
    ];

    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    public function school()
    {
        return $this->belongsTo(School::class);
    }

    public function isAdmin()
    {
        return $this->role->name === Config::get('constants.roles.admin');
    }

    public function isReferent()
    {
        return $this->role->name === Config::get('constants.roles.referent');
    }

    // public function messageSends()
    // {
    //     return $this->hasMany(PrivateMessage::class, 'from_id');
    // }
}
