<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Setting::create([
            'alamat' => 'Jl. Arnold Mononutu, Desa Kaima, Kec. Kauditan',
            'telepon' => '081242606776',
            'email' => 'sekolahadventkaima@gmail.com',
            // 'facebook' => NULL,
            'pesan_sukses_mendaftar' => 'Pesan setelah calon siswa baru berhasil mengisi formulir pendaftaran disini'
        ]);
    }
}
