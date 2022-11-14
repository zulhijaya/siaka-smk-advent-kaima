<?php

namespace Database\Seeders;

use App\Models\Kelas;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class KelasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Kelas::create([
            'tingkat' => 10
        ]);
        
        Kelas::create([
            'tingkat' => 11
        ]);

        Kelas::create([
            'tingkat' => 12
        ]);
    }
}
