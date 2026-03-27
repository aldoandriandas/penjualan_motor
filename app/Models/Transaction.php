<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'motor_id',
        'user_id',
        'dealer_id',
        'invoice',
        'total_price',
        'status',
        'payment_method',
        'paid_at'
    ];

    public function motor()
    {
        return $this->belongsTo(Motor::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function dealer()
    {
        return $this->belongsTo(Dealer::class);
    }
}
