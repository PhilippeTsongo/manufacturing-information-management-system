<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sortie extends Model
{
    use HasFactory;

    protected $fillable = ['sortie_number', 'libelle', 'montant', 'description', 'date_sortie', 'mois', 'annee'];
}
