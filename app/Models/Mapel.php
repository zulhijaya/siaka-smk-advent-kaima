<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mapel extends Model
{
    use HasFactory;

    protected $table = 'mapel';
    protected $guarded = [];

    public function jadwal2()
    {
        return $this->hasMany(Jadwal::class, 'id_mapel');
    }
}
