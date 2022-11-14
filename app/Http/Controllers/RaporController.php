<?php

namespace App\Http\Controllers;

use App\Models\Siswa;
use App\Models\Absensi;
use App\Models\TahunAjaran;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Builder;

class RaporController extends Controller
{
    public function index()
    {
        $wali_kelas = auth()->user()->load('guru.kelas')->guru;

        $siswa2 = Siswa::with('user')->whereHas('jurusan', function(Builder $query) use ($wali_kelas) {
            $query->where('id_kelas', $wali_kelas->id_kelas);
        })->get()->sortBy('user.nama');

        return view('admin.rapor.index', [
            'siswa2' => $siswa2,
            'title' => 'Rapor Kelas ' . $wali_kelas->kelas->tingkat
        ]);
    }

    public function detail(Siswa $siswa)
    {
        $siswa->load('user', 'nilai2.mapel', 'nilai2.guru.user', 'jurusan', 'absensi2');
        $absensi = $siswa->absensi2->groupBy(['status', function($item) {
            return $item->created_at->format('Y-m-d');
        }]);

        $tahun_ajaran = TahunAjaran::where('status', 'Aktif')->first();

        return view('admin.rapor.detail', [
            'siswa' => $siswa,
            'absensi' => $absensi,
            'tahun_ajaran' => $tahun_ajaran,
            'title' => 'Rapor ' . $siswa->user->nama
        ]);
    }
}
