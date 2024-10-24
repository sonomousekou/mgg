<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Agent extends Model
{
    use HasFactory;

    protected $fillable = [
        'nom',
        'prenom',
        'date_naissance',
        'email',
        'telephone',
        'matricule',
        'adresse',
        'poste_actuel',
        'actif',
        'date_embauche',
        'photo',
        'certifications',
        'pin',
        'sexe',
        'nationalite',
        'civilite',
        'lieu_naissance',
        'dernier_diplome',
        'user_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
