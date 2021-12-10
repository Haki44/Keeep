<?php

namespace App\Models;

use App\Models\User;
use App\Models\Offer;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PrivateMessage extends Model
{
    use HasFactory, SoftDeletes;

    public $fillable = [
        'from_id',
        'to_id',
        'content',
        'read_at'
    ];

    public function userFrom()
    {
        return $this->belongsTo(User::class);
    }

    public function userTo()
    {
        return $this->belongsTo(User::class);
    }
}
