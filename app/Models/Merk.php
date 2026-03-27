<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Merk extends Model
{
    protected $fillable = ['nama_merk'];

    public function motors()
    {
        return $this->hasMany(Motor::class);
    }
}
