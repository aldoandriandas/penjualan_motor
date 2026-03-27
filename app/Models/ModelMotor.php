<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ModelMotor extends Model
{
    protected $table = 'models';

    protected $fillable = [
        'merk_id',
        'nama_model'
    ];

    // Relasi ke Merk
    public function merk()
    {
        return $this->belongsTo(Merk::class, 'merk_id');
    }

    // 🔥 PENTING: relasi ke Motor (foreign key = model_id)
    public function motors()
    {
        return $this->hasMany(Motor::class, 'model_id','id');
    }
    public function dealer()
    {
        return $this->belongsTo(Dealer::class);
    }
}
