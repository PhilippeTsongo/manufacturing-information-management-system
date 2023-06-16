<?php

namespace App\Models;

use App\Models\Unit;
use App\Models\Production;
use App\Models\ProductionProvisoire;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Matiere extends Model
{
    use HasFactory;

    protected $fillable = ['id', 'name', 'type', 'quantity', 'purchase_price', 'mois', 'annee', 'unit_id', 'date_matiere', 'matiere_number'];

    //relationship between matiere and unit
    public function unit () 
    {
        return $this->belongsTo(Unit::class);
    }

    //relationship between matiere and production
    public function productions()
    {
        return $this->belongsToMany(Production::class)->withPivot('matiere_quantity');
    }

}
