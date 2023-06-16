<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmballageCasse extends Model
{
    use HasFactory;

    protected $fillable = ['number', 'type_emballage_id', 'emballage_id', 'quantity', 'date_emballage_casse', 'mois', 'annee'];

    public function emballage()
    {
        return $this->belongsTo(Emballage::class);
    }

}
