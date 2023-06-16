<?php

namespace App\Models;

use App\Models\Operation;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Transaction extends Model
{
    use HasFactory;

    protected $fillable = ['transaction_number', 'name'];

    //relationship between transaction and operation
    public function operations()
    {
        return $this->hasMany(Operation::class);
    }
}
