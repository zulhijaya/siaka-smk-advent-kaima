<?php

namespace Database\Seeders;

use App\Models\TahunAjaran;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class TahunAjaranSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        TahunAjaran::create([
            'tahun' => '2022/2023',
            'semester' => 'Ganjil',
            'status' => 'Aktif'
        ]);
        
        TahunAjaran::create([
            'tahun' => '2022/2023',
            'semester' => 'Genap',
            'status' => 'Tidak Aktif'
        ]);
    }
}
