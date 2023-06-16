<?php

namespace App\Models;

use App\Models\Production;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ProductionEmballageQuantity extends Model
{
    use HasFactory;

    protected $fillable = ['production_id', 'emballage_quantity', 'number', 'unit'];
    
    public function production()
    {
        return $this->belongsTo(Production::class);
    }
}
