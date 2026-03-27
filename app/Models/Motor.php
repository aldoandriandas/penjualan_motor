<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Motor extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'merk_id',
        'model_id',
        'dealer_id',
        'tahun',
        'harga',
        'jarak_tempuh',
        'kondisi',
        'warna',
        'deskripsi',
        'stock',
        'gambar',
        'gambar2',
        'gambar3',
        'second_id'
    ];
    protected static function booted()
    {
        static::creating(function ($motor) {
            $last = self::latest('id')->first();
            $nextId = $last ? $last->id + 1 : 1;
            $motor->second_id = 'MTR-' . str_pad($nextId, 4, '0', STR_PAD_LEFT);
        });
    }

    public function model()
    {
        return $this->belongsTo(ModelMotor::class, 'model_id', 'id');
    }

    public function merk()
    {
        return $this->belongsTo(Merk::class);
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
