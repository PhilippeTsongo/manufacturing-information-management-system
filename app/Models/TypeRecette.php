<?php

namespace App\Models;

use App\Models\AutreRecette;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class TypeRecette extends Model
{
    use HasFactory;

    protected $fillable = ['name'];

    public function autre_recettes ()
    {
        return $this->hasMany(AutreRecette::class);
    }
}
