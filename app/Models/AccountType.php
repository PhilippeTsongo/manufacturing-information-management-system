<?php

namespace App\Models;

use App\Models\PlanComptable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class AccountType extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'classification_number', 'range'];

    //  RELATIONSHIP AccountType AND PlanComptable(Compte)
    public function plan_comptables()
    {
        return $this->hasMany(PlanComptable::class);
    }
}
