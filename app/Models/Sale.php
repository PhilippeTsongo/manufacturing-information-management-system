<?php

namespace App\Models;

use App\Models\Dette;
use App\Models\Client;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Sale extends Model
{
    use HasFactory;

    protected $fillable = ['quantity', 'price', 'mois', 'annee', 'production_id' , 'date_sale', 'sale_number', 'client_id'];

    //relationship between sale and production
    public function production()
    {
        return $this->belongsTo(Production::class);
    }

    //relationship between sale and client
    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    //relationship between sale and client
    public function dette()
    {
        return $this->hasOne(Dette::class);
    }
}
