<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Site extends Model
{
    use HasFactory;

    protected $fillable = [
        'nom',
        'code',
        'adresse',
        'responsable_nom',
        'responsable_contact',
        'responsable_email',
        'type_site',
        'latitude',
        'longitude',
        'consignes_specifiques',
        'photo',
        'description',
    ];
}
