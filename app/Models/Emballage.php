<?php

namespace App\Models;

use App\Models\Unit;
use App\Models\Production;
use App\Models\TypeEmballage;
use App\Models\EmballageCasse;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Emballage extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'quantity', 'type_emballage_id', 'purchase_price', 'mois', 'annee', 'unit_id', 'date_emballage', 'emballage_number'];

    //relationship between emballage and unit
    public function unit()
    {
        return $this->belongsTo(Unit::class);
    }

    //relationship between emballage and production
    public function productions()
    {
        return $this->belongsToMany(Production::class)->withPivot('matiere_emballage');
    }

    //relationship between emballage and emballageCasse
    public function emballageCasse()
    {
        return $this->hasMany(EmballageCasse::class);
    }

    public function type_emballage ()
    {
        return $this->belongsTo(TypeEmballage::class);
    }
}
