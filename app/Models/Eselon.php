<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Eselon extends Model
{
    protected $fillable = ['name'];

    public function pegawais()
    {
        return $this->hasMany(Pegawai::class);
    }
}

