<?php

namespace App\Models;

use App\Models\Unit;
use App\Models\Office;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Logistique extends Model
{
    use HasFactory;

    protected $fillable = ['logistique_number', 'name', 'purchase_price', 'quantity', 'office_id', 'unit_id'];

    //relationship between logistique and bureau
    public function office()
    {
        return $this->belongsTo(Office::class);
    }

    //relationship between logistique and unit
    public function unit()
    {
        return $this->belongsTo(Unit::class);
    }
}
