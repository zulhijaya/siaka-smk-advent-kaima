<?php

namespace App\Http\Controllers\Guru;

use App\Models\Siswa;
use App\Models\Jadwal;
use App\Models\Absensi;
use App\Models\TahunAjaran;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Database\Eloquent\Builder;

class AbsensiController extends Controller
{
    public function inputAbsensi()
    {
        $jadwal2 = auth()->user()->load('guru.jadwal2.jurusan.kelas', 'guru.jadwal2.jurusan.siswa2')
            ->guru->jadwal2->unique(function ($item) {
                return $item['id_mapel'].$item['hari'];
            });

        return view('admin.guru.absensi.input-absensi', [
            'jadwal2' => $jadwal2,
            'title' => 'Pilih Jadwal Absensi'
        ]);
    }

    public function index(Jadwal $jadwal) 
    {
        $id_jurusan2 = Jadwal::where('id_mapel', $jadwal->id_mapel)->where('id_guru', $jadwal->id_guru)->pluck('id_jurusan')->toArray();
        $siswa2 = Siswa::with(['absensi2' => function($query) use ($jadwal) {
            $query->where('id_jadwal', $jadwal->id)->where('created_at', 'LIKE', date('Y-m-d') . '%');
        }, 'user'])->withCount(['absensi2' => function($query) use ($jadwal) {
            $query->where('id_jadwal', $jadwal->id)->where('created_at', 'LIKE', date('Y-m-d') . '%');
        }])->whereIn('id_jurusan', $id_jurusan2)->get()->sortBy('user.nama');
        
        $absensi_count = Absensi::where('id_jadwal', $jadwal->id)->where('created_at', 'LIKE', date('Y-m-d') . '%')->count();

        return view('admin.guru.absensi.index', [
            'siswa2' => $siswa2,
            'id_jadwal' => $jadwal->id,
            'absensi_count' => $absensi_count,
            'title' => 'Absensi Siswa'
        ]);
    }

    public function tambah(Siswa $siswa, Jadwal $jadwal) 
    {
        $siswa->load('user');
        $jadwal->load('mapel');

        return view('admin.guru.absensi.tambah', [
            'siswa' => $siswa,
            'jadwal' => $jadwal
        ]);
    }

    public function simpan(Request $request, Jadwal $jadwal)
    {
        $request->validate([
            'status' => 'required|array',
            'status.*' => 'required'
        ]);

        $id_jurusan2 = Jadwal::where('id_mapel', $jadwal->id_mapel)->where('id_guru', $jadwal->id_guru)->pluck('id_jurusan')->toArray();
        $id_siswa2 = Siswa::with(['absensi2' => function($query) use ($jadwal) {
            $query->where('id_jadwal', $jadwal->id)->where('created_at', 'LIKE', date('Y-m-d') . '%');
        }, 'user'])->whereIn('id_jurusan', $id_jurusan2)->get()->sortBy('user.nama')->pluck('id')->toArray();

        foreach( $id_siswa2 as $index => $id_siswa ) {
            Absensi::create([
                'id_siswa' => $id_siswa,
                'id_jadwal' => $jadwal->id,
                'status' => $request->status[$index],
                'alasan' => $request->alasan[$index],
                'created_at' => $request->tanggal,
                'updated_at' => $request->tanggal
            ]);
        }

        return redirect()->route('admin.guru.absensi.index', $jadwal->id)->with('status', 'Absensi siswa berhasil diinput!');
    }

    // public function simpan(Request $request, Siswa $siswa, Jadwal $jadwal)
    // {
    //     $request->validate([
    //         'absensi' => 'required'
    //     ]);

    //     Absensi::create([
    //         'id_siswa' => $siswa->id,
    //         'id_guru' => $jadwal->id_guru,
    //         'id_mapel' => $jadwal->id_mapel,
    //         'id_tahun_ajaran' => TahunAjaran::where('status', 'Aktif')->first()->id,
    //         'absensi' => $request->absensi
    //     ]);

    //     return redirect()->route('admin.guru.absensi.index', $jadwal->id)->with('status', 'absensi siswa berhasil diinput!');
    // }

    public function edit($id_jadwal, Absensi $absensi)
    {
        $absensi->load('siswa.user', 'mapel');

        return view('admin.guru.absensi.edit', [
            'absensi' => $absensi,
            'id_jadwal' => $id_jadwal
        ]);
    }

    public function update(Request $request, $id_jadwal, Absensi $absensi) 
    {
        $request->validate([
            'absensi' => 'required'
        ]);

        $absensi->update([
            'absensi' => $request->absensi
        ]);

        return redirect()->route('admin.guru.absensi.index', $id_jadwal)->with('status', 'absensi siswa berhasil diupdate!');
    }
}
