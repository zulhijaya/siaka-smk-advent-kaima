<?php

namespace Database\Seeders;

use App\Models\Misi;
use App\Models\Setting;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class VisiMisiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Setting::first()->update([
            'visi' => 'Berkarakter seperti Yesus Kristus, berprestasi dalam ilmu pengetahuan dan teknologi serta mandiri'
        ]);

        Misi::create([
            'deskripsi' => 'Mewujudkan pendidikan Advent yang beriman dan suka melayani'
        ]);

        Misi::create([
            'deskripsi' => 'Mengembangkan kemampuan murid agar trampil dalam ilmu pengetahuan dan teknologi'
        ]);

        Misi::create([
            'deskripsi' => 'Menginspirasi murid agar kreatif berprestasi dan mandiri'
        ]);
    }
}
