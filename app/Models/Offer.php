<?php

namespace App\Models;

use App\Models\PrivateMessage;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Offer extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'description',
        'offer_day',
        'price',
        'user_id',
        'category_id',
    ];

    protected $casts = [
        'offer_day' => 'date',
    ];

    protected $with = [
        'replies'
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
}
