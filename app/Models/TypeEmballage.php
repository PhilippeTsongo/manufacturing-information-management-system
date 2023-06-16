<?php

namespace App\Models;

use App\Models\Emballage;
use App\Models\PriceConfig;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class TypeEmballage extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'description'];

    public function emballages ()
    {
        return $this->hasMany(Emballage::class);
    }

    public function price_config ()
    {
        return $this->hasMany(PriceConfig::class);
    }
}
