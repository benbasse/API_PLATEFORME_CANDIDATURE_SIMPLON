<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Model;

class Candidat extends Authenticatable
{
    use HasFactory;

    public function formations()
    {
        return $this->belongsTo(Formation::class);
    }

    protected $fillable = [
        'nom',
        'telephone',
        'is_accepted',
        'email',
        'password'
    ];
}
