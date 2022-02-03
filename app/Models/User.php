<?php

namespace App\Models;

use App\Models\Role;
use App\Models\Offer;
use App\Models\Reply;
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

    public function replies()
    {
        return $this->belongsToMany(Reply::class);
    }

    public function offers()
    {
        return $this->hasMany(Offer::class);
    }

    public function isAdmin()
    {
        return $this->role->name === Config::get('constants.roles.admin');
    }

    public function isReferent()
    {
        return $this->role->name === Config::get('constants.roles.referent');
    }

    public function isStudent()
    {
        return $this->role->name === 'STUDENT';
    }

    // Call cette fonction quand on veut connaitre le nombre de replies sur lesquel il n'y eu aucune action (ex dans la navbar) pour eviter d'ouvrir des balises @php dans la vue ;)
    public function getRepliesCount()
    {
        $count = 0;
        $offers = $this->offers;
        foreach ($offers as $offer) {
            $count += $offer->replies->whereNull('status')->count();
        }
        return $count;
    }

    // public function messageSends()
    // {
    //     return $this->hasMany(PrivateMessage::class, 'from_id');
    // }
}
