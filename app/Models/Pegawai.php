<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Pegawai extends Model
{
    use HasFactory;

    

    protected $fillable = [
        'nip', 'nama', 'tempat_lahir', 'tanggal_lahir', 'jenis_kelamin',
        'golongan_id', 'eselon_id', 'jabatan', 'unit_id', 'tempat_tugas',
        'agama', 'alamat', 'no_hp', 'npwp', 'foto'
    ];

    public function unitKerja()
    {
        return $this->belongsTo(Unit::class, 'unit_id'); 
    }

    public function golongan()
    {
        return $this->belongsTo(Golongan::class);
    }

    public function eselon()
    {
        return $this->belongsTo(Eselon::class);
    }
}
