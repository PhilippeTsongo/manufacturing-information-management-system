<?php

namespace App\Models;

use App\Models\Production;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CoutProduction extends Model
{
    use HasFactory;

    protected $fillable = ['production_number', 'libelle', 'montant', 'description', 'date_production', 'mois', 'annee'];

    // public function production()
    // {
    //     return $this->belongsTo(Production::class);
    // }
}
