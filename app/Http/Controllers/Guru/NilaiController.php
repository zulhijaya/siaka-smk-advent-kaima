<?php

namespace App\Http\Controllers\Guru;

use App\Models\Nilai;
use App\Models\Siswa;
use App\Models\Jadwal;
use App\Models\TahunAjaran;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Database\Eloquent\Builder;

class NilaiController extends Controller
{
    public function inputNilai()
    {
        $user = auth()->user()->load('guru.jadwal2.jurusan.kelas');

        return view('admin.guru.nilai.input-nilai', [
            'user' => $user,
            'title' => 'Pilih Kelas & Mapel'
        ]);
    }

    public function index(Jadwal $jadwal) 
    {
        $id_jurusan2 = Jadwal::where('id_mapel', $jadwal->id_mapel)->where('id_guru', $jadwal->id_guru)->pluck('id_jurusan')->toArray();
        $siswa2 = Siswa::with(['nilai2' => function($query) use ($jadwal) {
            $query->where('id_mapel', $jadwal->id_mapel)->where('id_guru', $jadwal->id_guru);
        }, 'user'])->withCount(['nilai2' => function(Builder $query) use ($jadwal) {
            $query->where('id_mapel', $jadwal->id_mapel);
        }])->whereIn('id_jurusan', $id_jurusan2)->get();

        return view('admin.guru.nilai.index', [
            'siswa2' => $siswa2,
            'id_jadwal' => $jadwal->id,
            'title' => 'Nilai Siswa'
        ]);
    }

    public function tambah(Siswa $siswa, Jadwal $jadwal) 
    {
        $siswa->load('user');
        $jadwal->load('mapel');

        return view('admin.guru.nilai.tambah', [
            'siswa' => $siswa,
            'jadwal' => $jadwal,
            'title' => 'Input Nilai'
        ]);
    }

    public function simpan(Request $request, Siswa $siswa, Jadwal $jadwal)
    {
        $request->validate([
            'nilai' => 'required'
        ]);

        Nilai::create([
            'id_siswa' => $siswa->id,
            'id_guru' => $jadwal->id_guru,
            'id_mapel' => $jadwal->id_mapel,
            'id_tahun_ajaran' => TahunAjaran::where('status', 'Aktif')->first()->id,
            'nilai' => $request->nilai
        ]);

        return redirect()->route('admin.guru.nilai.index', $jadwal->id)->with('status', 'Nilai siswa berhasil diinput!');
    }

    public function edit($id_jadwal, Nilai $nilai)
    {
        $nilai->load('siswa.user', 'mapel');

        return view('admin.guru.nilai.edit', [
            'nilai' => $nilai,
            'id_jadwal' => $id_jadwal,
            'title' => 'Edit Nilai'
        ]);
    }

    public function update(Request $request, $id_jadwal, Nilai $nilai) 
    {
        $request->validate([
            'nilai' => 'required'
        ]);

        $nilai->update([
            'nilai' => $request->nilai
        ]);

        return redirect()->route('admin.guru.nilai.index', $id_jadwal)->with('status', 'Nilai siswa berhasil diupdate!');
    }
}
