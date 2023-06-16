<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TypeMatiere extends Model
{
    use HasFactory;

    protected $fillable = ['id', 'name'];

}
