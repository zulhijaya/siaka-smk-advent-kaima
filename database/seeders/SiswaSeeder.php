<?php

namespace Database\Seeders;

use App\Models\Siswa;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class SiswaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $siswa2 = ['Zulhi Jaya', 'Ahdiat Ahsan', 'Adammas Haris', 'Rifka Amelia', 'Silpa Robe', 'Damin Kaimudin', 'Fikri Haikal', 'Munir', 'Fadhli Nawir', 'Diana'];
        $jurusan = ['Otomotif', 'Keperawatan', 'Teknik Jaringan Komputer'];

        foreach( $siswa2 as $index => $siswa ) {
            Siswa::create([
                'nama' => $siswa,
                'nis' => '12345' . $index,
                'tempat_lahir' => 'Kota A',
                'tanggal_lahir' => '1990-08-10',
                'jenis_kelamin' => 'L',
                'agama' => 'Kristen',
                'alamat' => 'Jl. Lorem ipsum dolor sit amet consectetur adipisicing elit. Consectetur dolores veritatis dolor iusto error praesentium? Odit aspernatur sed',
                'no_tlp' => '0812484xxxxx',
                'nama_ayah' => 'xxxx',
                'nama_ibu' => 'xxxx',
                'kerja_ayah' => 'xxxx',
                'kerja_ibu' => 'xxxx',
                'jurusan_dipilih' => $jurusan[rand(0,2)]
            ]);
        }
    }
}
