<?php

namespace App\Models;

use App\Models\TypeEmballage;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PriceConfig extends Model
{
    use HasFactory;

    protected $fillable = ['type_emballage_id', 'quantity_min', 'quantity_max', 'price'];

    public function type_emballage()
    {
        return $this->belongsTo(TypeEmballage::class);
    }
}
