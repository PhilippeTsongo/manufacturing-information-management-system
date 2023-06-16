<?php

namespace App\Models;

use App\Models\Logistique;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Office extends Model
{
    use HasFactory;

    // PROTECTED FILLABLE
    protected $fillable = ['office_number', 'name', 'chef'];

    //  RELATIONSHIP BETWEEN CLIENT & VENTES
    public function logistiques()
    {
        return $this->hasMany(Logistique::class);
    }

}
