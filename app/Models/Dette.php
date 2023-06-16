<?php

namespace App\Models;

use App\Models\Sale;
use App\Models\Client;
use App\Models\Emballage;
use App\Models\Production;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Dette extends Model
{
    use HasFactory;

    protected $fillable = ['montant', 'quantity', 'description', 'montant_paye', 'production_id', 'client_id', 'mois', 'annee', 'date_dette', 'dette_number'];

    //RELATIONSHIP BETWEEN DETTE & CLIENT
    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    public function emballages() 
    {
        return $this->belongsToMany(Emballage::class);
    }
    //RELATIONSHIP BETWEEN DETTE & SALE
    // public function sale()
    // {
    //     return $this->belongsTo(Sale::class);
    // }

    
    public function production()
    {
        return $this->belongsTo(Production::class);
    }
}
