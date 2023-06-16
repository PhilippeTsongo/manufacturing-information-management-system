<?php

namespace App\Models;

use App\Models\Sale;
use App\Models\Unit;
use App\Models\Bonus;
use App\Models\Matiere;
use App\Models\Category;
use App\Models\Emballage;
use App\Models\CoutProduction;
use Illuminate\Database\Eloquent\Model;
use App\Models\ProductionMatiereQuantity;
use App\Models\ProductionEmballageQuantity;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Production extends Model
{
    use HasFactory;

    protected $fillable = ['id', 'number', 'quantity', 'mois', 'annee', 'unit_id', 'category_id', 'emballage_id', 'emballage_quantity', 'date_production'];

    //relationship between production and emballage
    public function emballages() 
    {
        return $this->belongsToMany(Emballage::class);
    }

    public function emballage() 
    {
        return $this->belongsTo(Emballage::class);
    }

    //relationship between production and matiere
    public function matieres() 
    {
        return $this->belongsToMany(Matiere::class);
    }

    public function production_matiere_quantities() 
    {
        return $this->hasMany(ProductionMatiereQuantity::class);
    }


    public function production_emballage_quantities() 
    {
        return $this->hasMany(ProductionEmballageQuantity::class);
        
    }

    

    //relationship between production and unit
    public function unit() 
    {
        return $this->belongsTo(Unit::class);
    }

    //relationship between production and category
    public function category() 
    {
        return $this->belongsTo(Category::class);
    }

    //relationship between production and sales
    public function sales() 
    {
        return $this->hasMany(Sale::class);
    }

    public function bonuss() 
    {
        return $this->hasMany(Bonus::class);
    }

    // public function cout_prodctions() 
    // {
    //     return $this->hasMany(CoutProduction::class);
    // }


    

    
}
