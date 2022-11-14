<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kelas extends Model
{
    use HasFactory;

    protected $table = 'kelas';
    protected $guarded = [];

    public function guru()
    {
        return $this->hasOne(Guru::class, 'id_kelas');
    }

    public function jurusan2() 
    {
        return $this->hasMany(Jurusan::class, 'id_kelas');
    }
}
