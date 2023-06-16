<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\ProductionEmballageQuantity;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class EmballageProduction extends Model
{
    use HasFactory;

    public function production_emballage_quantities()
    {
        return $this->hasMany(ProductionEmballageQuantity::class);
    }
}
