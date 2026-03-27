<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Dealer extends Model
{
    protected $table = "dealers";
    protected $fillable = [
        'nama_dealer',
        'alamat_dealer',
        'no_hp_dealer',
        'email_dealer',
        'logo_dealer',
        'kota_dealer',
    ];
    public function motors()
    {
        return $this->hasMany(Motor::class);
    }
    public function users()
    {
        return $this->hasMany(User::class);
    }
}
