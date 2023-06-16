<?php

namespace App\Models;

use App\Models\Emballage;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class EmballageComptable extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'type_emballage_id', 'quantity', 'purchase_price', 'mois', 'annee', 'unit_id', 'date_emballage', 'emballage_number'];

    //relationship between emballage and unit
    public function unit()
    {
        return $this->belongsTo(Unit::class);
    }
    
    public function emballage()
    {
        return $this->belongsTo(Emballage::class);
    }

    public function type_emballage ()
    {
        return $this->belongsTo(TypeEmballage::class);
    }
}
