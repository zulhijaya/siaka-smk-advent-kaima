<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TahunAjaran extends Model
{
    use HasFactory;

    protected $table = 'tahun_ajaran';
    protected $guarded = [];

    public function jadwal2()
    {
        return $this->hasMany(Jadwal::class, 'id_tahun_ajaran');
    }
}
