<?php

namespace Database\Seeders;

use App\Models\Mapel;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class MapelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $mapel2 = ['Agama', 'Pancasila', 'Matematika', 'Bahasa Indonesia', 'Bahasa Inggris', 'PJOK', 'Sejarah', 'SEBU', 'KWU', 'INFO/KPPI', 'IPA/SOS', 'MULOK', 'Dasar Prog. keahlian', 'Kompetensi Kejuruan', 'Pathfinder', 'Penataan Lab.'];
        
        foreach( $mapel2 as $index => $mapel ) {  
            Mapel::create([
                'kode' => $index + 1,
                'nama' => $mapel,
                'kkm' => 70
            ]);
        }
    }
}
