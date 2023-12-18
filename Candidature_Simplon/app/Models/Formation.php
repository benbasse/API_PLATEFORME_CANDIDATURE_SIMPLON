<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Formation extends Model
{
    use HasFactory;

    public function candidats()
    {
        return $this->hasMany(Candidat::class);
    }

    protected $fillable = [
        'libelle',
        'description',
        'duree'
    ];
}
