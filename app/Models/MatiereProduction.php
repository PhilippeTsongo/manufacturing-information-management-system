<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\ProductionMatiereQuantity;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class MatiereProduction extends Model
{
    use HasFactory;

    public function production_matiere_quantities()
    {
        return $this->hasMany(ProductionMatiereQuantity::class);
    }
}
