<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jadwal extends Model
{
    use HasFactory;

    protected $table = 'jadwal';
    protected $guarded = [];

    public function siswa() 
    {
        return $this->belongsTo(Siswa::class, 'id_siswa');
    }

    public function mapel() 
    {
        return $this->belongsTo(Mapel::class, 'id_mapel');
    }

    public function jurusan() 
    {
        return $this->belongsTo(Jurusan::class, 'id_jurusan');
    }

    public function guru() 
    {
        return $this->belongsTo(Guru::class, 'id_guru');
    }

    public function tahun_ajaran() 
    {
        return $this->belongsTo(TahunAjaran::class, 'id_tahun_ajaran');
    }

    public function absensi()
    {
        return $this->hasOne(Absensi::class, 'id_jadwal');
    }
}
