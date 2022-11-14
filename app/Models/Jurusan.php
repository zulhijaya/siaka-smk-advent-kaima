<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jurusan extends Model
{
    use HasFactory;

    protected $table = 'jurusan';
    protected $guarded = [];

    public function kelas()
    {
        return $this->belongsTo(Kelas::class, 'id_kelas');
    }

    public function siswa2() 
    {
        return $this->hasMany(Siswa::class, 'id_jurusan');
    }

    public function jadwal2()
    {
        return $this->hasMany(Jadwal::class, 'id_jurusan');
    }
}
