<?php

namespace App\Models;

use App\Models\Matiere;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class MatiereComptable extends Model
{
    use HasFactory;

    protected $fillable = ['id', 'name', 'type', 'quantity', 'purchase_price', 'mois', 'annee', 'unit_id', 'date_matiere', 'matiere_number'];

    //relationship between matiere and unit
    public function matiere () 
    {
        return $this->belongsTo(Matiere::class);
    }
}
