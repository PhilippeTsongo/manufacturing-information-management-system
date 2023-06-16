<?php

namespace App\Models;

use App\Models\Matiere;
use App\Models\Emballage;
use App\Models\Logistique;
use App\Models\Production;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Unit extends Model
{
    use HasFactory;

    protected $fillable = ['id', 'name'];

    //relationship between matiere and unit
    public function matieres () 
    {
        return $this->hasMany(Matiere::class);
    }

    //relationship between emballages and unit
    public function emballages() 
    {
        return $this->hasMany(Emballage::class);
    }

    //relationship between logistique and unit
    public function logistiques() 
    {
        return $this->hasMany(Logistique::class);
    }

    //relationship between production and unit
    public function productions() 
    {
        return $this->hasMany(Production::class);
    }

}
