<?php

namespace App\Models;

use App\Models\AccountType;
use App\Models\BilanConfig;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PlanComptable extends Model
{
    use HasFactory;

    protected $fillable = ['account_number', 'account_name', 'account_type_id'];

    //relationship between planComptable and AccountType
    public function account_type() 
    {
        return $this->belongsTo(AccountType::class);
    }

    //relationship between planComptable and BilanConfig
    public function bilan_configs() 
    {
        return $this->hasMany(BilanConfig::class);
    }

}
