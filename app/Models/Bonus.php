<?php

namespace App\Models;

use App\Models\Client;
use App\Models\Production;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Bonus extends Model
{
    use HasFactory;

    protected $fillable = ['quantity', 'price', 'mois', 'annee', 'production_id' , 'date_bonus', 'bonus_number', 'client_id'];

    //relationship between bonus and client
    public function client()
    {
        return $this->belongsTo(Client::class);
    }
    public function production()
    {
        return $this->belongsTo(Production::class);
    }
    
}
