<?php

namespace App\Models;

use App\Models\PrivateMessage;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Offer extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'description',
        'offer_day',
        'price',
        'img',
        'user_id',
        'category_id',
        'pricing',  
    ];

    protected $casts = [
        'offer_day' => 'date',
    ];

    protected $with = [
        'replies'
    ];

    static public $pricing_values = [
        0 => 'fixe',
        1 => 'heure',
        2 => 'jour',
        3 => 'semaine'
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function privateMessages()
    {
        return $this->belongsToMany(PrivateMessage::class);
    }

    // L'offre peut avoir plusieurs réponses
    public function replies()
    {
        return $this->hasMany(Reply::class)->where('deleted_at', NULL);
    }

    public function getPricingNameAttribute()
    {
        return static::$pricing_values[$this->pricing];
    }

    // Une offre "acceptée" n'a qu'une réponse, pour l'enregistrement de la transaction
    public function reply()
    {
        return $this->hasOne(Reply::class);
    }
}
