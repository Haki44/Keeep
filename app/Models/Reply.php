<?php

namespace App\Models;

use App\Models\User;
use App\Models\Offer;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Reply extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'offer_id',
        'user_id',
        'reply'
    ];

    // La réponse appartient à une offre
    public function offer()
    {
        return $this->belongsTo(Offer::class);
    }

    // Une réponse a été créé par un user
    public function user()
    {
        return $this->belongsTo(User::class);
    }

}
