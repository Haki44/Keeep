<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class School extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'user_id'
    ];

    public function students()
    {
        return $this->hasMany(User::class);
    }

    public function referent()
    {
        return $this->belongsTo(User::class);
    }
}
