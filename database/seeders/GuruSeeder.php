<?php

namespace Database\Seeders;

use App\Models\Guru;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class GuruSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $guru2 = ['Drs. J. Z. Rumampuk, MA', 'Sabbachiny, S.Kom', 'Sonny Sikome, S.Kom', 'Sabbathanya, S.Pd', 'Sakti Kumayas, S.Pd', 'Yohana Sara, S.Kep', 'Henry Senduk, SP', 'Yunita Pakpahan, S.Kep', 'Yosias Belung, S.Pd', 'Beazly Lumentut', 'Arky Horman, S.Pd'];

        foreach( $guru2 as $guru ) {
            Guru::create([
                'nama' => $guru,
                'nip' => rand(100000000, 999999999),
                'tempat_lahir' => 'Kota A',
                'tanggal_lahir' => '1990-08-10',
                'jenis_kelamin' => 'L',
                'agama' => 'Kristen',
                'alamat' => 'Jl. Lorem ipsum dolor sit amet consectetur adipisicing elit. Consectetur dolores veritatis dolor iusto error praesentium? Odit aspernatur sed',
                'no_tlp' => rand(100000000000, 999999999999),
                'jabatan' => 'Guru',
            ]);
        }
    }
}
