<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CashIn extends Model
{
    protected $fillable = [
    'dealer_id',
    'amount',
    'description',
    'transaction_id',
];
public function transaction()
{
    return $this->belongsTo(Transaction::class);
}
}
