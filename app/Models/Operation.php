<?php

namespace App\Models;

use App\Models\Transaction;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Operation extends Model
{
    use HasFactory;

    protected $fillable = ['operation_number', 'transaction_id', 'actif_account', 'passif_account'];

    //relationship between operation and transaction
    public function transaction()
    {
        return $this->belongsTo(Transaction::class);
    }
}
