<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Siswa extends Model
{
    use HasFactory;

    protected $table = 'siswa';
    protected $guarded = [];

    public function jurusan()
    {
        return $this->belongsTo(Jurusan::class, 'id_jurusan');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function nilai2()
    {
        return $this->hasMany(Nilai::class, 'id_siswa');
    }

    public function absensi2()
    {
        return $this->hasMany(Absensi::class, 'id_siswa');
    }

    public function tagihan()
    {
        return $this->hasOne(Tagihan::class, 'id_siswa');
    }

    public function berkas()
    {
        return $this->hasOne(Berkas::class, 'id_siswa');
    }
}
