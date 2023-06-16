<?php

namespace App\Models;

use App\Models\BilanConfig;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class BilanClassement extends Model
{
    use HasFactory;

    protected $fillable = ['classement_number', 'classement'];

    public function bilan_config() 
    {
        return $this->hasMany(BilanConfig::class);
    }
}
