<?php

namespace App\Models;

use App\Models\PlanComptable;
use App\Models\BilanClassement;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class BilanConfig extends Model
{
    use HasFactory;

    protected $fillable = ['plan_comptable_id', 'amount', 'bilan_classement_id', 'mois', 'annee', 'bilan_config_number'];

    //relationship between Bilan config and planComptable
    public function plan_comptable() 
    {
        return $this->belongsTo(PlanComptable::class);
    }

    public function bilan_classement() 
    {
        return $this->belongsTo(BilanClassement::class);
    }

}
