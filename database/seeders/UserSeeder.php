<?php

namespace Database\Seeders;

use App\Models\Guru;
use App\Models\User;
use App\Models\Siswa;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'nama' => 'Mas Admin',
            'nomor_identitas' => '170100',
            'role' => 'Administrator'
        ]);

        $guru2 = ['Drs. J. Z. Rumampuk, MA', 'Sabbachiny, S.Kom', 'Sonny Sikome, S.Kom', 'Sabbathanya, S.Pd', 'Sakti Kumayas, S.Pd', 'Yohana Sara, S.Kep', 'Henry Senduk, SP', 'Yunita Pakpahan, S.Kep', 'Yosias Belung, S.Pd', 'Beazly Lumentut', 'Arky Horman, S.Pd'];

        $id_kelas = [1,2,3];
        foreach( $guru2 as $index => $guru ) {
            $user = User::create([
                'nama' => $guru,
                'nomor_identitas' => rand(100000000, 999999999),
                'role' => 'Guru' 
            ]);

            Guru::create([
                'user_id' => $user->id,
                'id_kelas' => $index < 3 ? $id_kelas[$index] : NULL,
                'tempat_lahir' => 'Kota A',
                'tanggal_lahir' => '1990-08-10',
                'jenis_kelamin' => 'L',
                'agama' => 'Kristen',
                'alamat' => 'Jl. Lorem ipsum dolor sit amet consectetur adipisicing elit. Consectetur dolores veritatis dolor iusto error praesentium? Odit aspernatur sed',
                'no_tlp' => rand(100000000000, 999999999999),
                'jabatan' => 'Guru',
            ]);
        }
        
        // $siswa2 = ['Zulhi Jaya', 'Ahdiat Ahsan', 'Adammas Haris', 'Rifka Amelia', 'Silpa Robe', 'Damin Kaimudin', 'Fikri Haikal', 'Munir', 'Fadhli Nawir', 'Diana'];
        // $jurusan = ['Otomotif', 'Keperawatan', 'Teknik Jaringan Komputer'];

        // foreach( $siswa2 as $index => $siswa ) {
        //     $user = User::create([
        //         'nama' => $siswa,
        //         'nomor_identitas' => '12345' . $index,
        //         'role' => 'Siswa' 
        //     ]);

        //     Siswa::create([
        //         'user_id' => $user->id,
        //         'tempat_lahir' => 'Kota A',
        //         'tanggal_lahir' => '1990-08-10',
        //         'jenis_kelamin' => 'L',
        //         'agama' => 'Kristen',
        //         'alamat' => 'Jl. Lorem ipsum dolor sit amet consectetur adipisicing elit. Consectetur dolores veritatis dolor iusto error praesentium? Odit aspernatur sed',
        //         'no_tlp' => '0812484xxxxx',
        //         'nama_ayah' => 'xxxx',
        //         'nama_ibu' => 'xxxx',
        //         'kerja_ayah' => 'xxxx',
        //         'kerja_ibu' => 'xxxx',
        //         'jurusan_dipilih' => $jurusan[rand(0,2)]
        //     ]);
        // }
    }
}
