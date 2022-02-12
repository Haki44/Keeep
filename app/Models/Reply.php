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
        'reply',
        'is_accepted',
        'starting_code',
        'starting_code_count',
        'ending_code',
        'ending_code_count',
        'started_at',
        'ended_at',
        'quantity'
    ];

    // Cast du datetime pour la bdd
    // Le date et datetime carbon scale sur le timezone dans config/app actuellement bien configurer sur 'Europe/Paris'
    // mais ce n'est pas la valeur par défaut pensez a verifier si vous l'utiliser sur d'autre projet ♥
    protected $casts = [
        'started_at' => 'datetime:Y-m-d H:i:s',
        'ended_at' => 'datetime:Y-m-d H:i:s',
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
