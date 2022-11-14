<?php

namespace Database\Seeders;

use App\Models\Jurusan;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class JurusanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Jurusan::create([
            'id_kelas' => 1,
            'nama' => 'Otomotif'
        ]);

        Jurusan::create([
            'id_kelas' => 1,
            'nama' => 'Keperawatan'
        ]);

        Jurusan::create([
            'id_kelas' => 1,
            'nama' => 'Teknik Komputer Jaringan'
        ]);

        Jurusan::create([
            'id_kelas' => 2,
            'nama' => 'Otomotif'
        ]);

        Jurusan::create([
            'id_kelas' => 2,
            'nama' => 'Keperawatan'
        ]);

        Jurusan::create([
            'id_kelas' => 2,
            'nama' => 'Teknik Komputer Jaringan'
        ]);
        Jurusan::create([
            'id_kelas' => 3,
            'nama' => 'Otomotif'
        ]);

        Jurusan::create([
            'id_kelas' => 3,
            'nama' => 'Keperawatan'
        ]);

        Jurusan::create([
            'id_kelas' => 3,
            'nama' => 'Teknik Komputer Jaringan'
        ]);
    }
}
