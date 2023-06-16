<?php

namespace App\Models;

use App\Models\Sale;
use App\Models\Dette;
use App\Models\Consignation;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Client extends Model
{
    use HasFactory;

    // PROTECTED FILLABLE
    protected $fillable = ['name', 'email', 'address', 'tel', 'client_number'];

    //  RELATIONSHIP BETWEEN CLIENT & VENTES
    public function ventes()
    {
        return $this->hasMany(Sale::class);
    }

    //  RELATIONSHIP BETWEEN CLIENT & DETTES
    public function dettes()
    {
        return $this->hasMany(Dette::class);
    }

    //  RELATIONSHIP BETWEEN CLIENT & DETTES
    public function consignations()
    {
        return $this->hasMany(Consignation::class);
    }
}
