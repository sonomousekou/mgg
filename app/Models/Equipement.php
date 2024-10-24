<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Equipement extends Model
{
    use HasFactory;

    protected $fillable = [
        'nom',
        'model',
        'site_id',
    ];

    public function site()
    {
        return $this->belongsTo(Site::class);
    }
}
