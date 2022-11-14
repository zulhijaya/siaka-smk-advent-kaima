<?php

namespace App\Http\Controllers;

use App\Models\Guru;
use App\Models\Kelas;
use App\Models\Mapel;
use App\Models\Jadwal;
use App\Models\Jurusan;
use App\Models\TahunAjaran;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class JadwalController extends Controller
{
    public function index(Kelas $kelas)
    {
        $jurusan = Jadwal::with('jurusan', 'mapel', 'guru.user')->whereHas('jurusan', function(Builder $query) use ($kelas) {
            $query->where('id_kelas', $kelas->id);
        })->get()->groupBy('jurusan.nama');
        
        $jurusan2 = Jurusan::where('id_kelas', $kelas->id)->get();
        $mapel2 = Mapel::get();
        $guru2 = Guru::get();

        return view('admin.kelas.jadwal.index', [
            'jurusan' => $jurusan,
            'jurusan2' => $jurusan2,
            'kelas' => $kelas,
            'mapel2' => $mapel2,
            'guru2' => $guru2,
            'title' => 'Jadwal Kelas ' . $kelas->tingkat
        ]);
    }

    public function tambah(Kelas $kelas) 
    {
        $mapel2 = Mapel::get();
        $guru2 = Guru::get();
        
        return view('admin.kelas.jadwal.tambah', [
            'kelas' => $kelas,
            'mapel2' => $mapel2,
            'guru2' => $guru2,
            'title' => 'Input Jadwal'
        ]);
    }

    public function simpanUmum(Kelas $kelas, Request $request)
    {
        $request->validate([
            'hari' => 'required',
            'jam' => 'required'
        ]);

        $id_jurusan2 = Jurusan::where('id_kelas', $kelas->id)->pluck('id')->toArray();
        foreach( $id_jurusan2 as $id_jurusan ) {
            Jadwal::create([
                'hari' => $request->hari,
                'id_mapel' => $request->id_mapel,
                'id_jurusan' => $id_jurusan,
                'id_guru' => $request->id_guru,
                'jam' => $request->jam,
                'id_tahun_ajaran' => TahunAjaran::where('status', 'Aktif')->first()->id
            ]);
        }

        return redirect()->route('admin.kelas.jadwal.index', $kelas->id)->with('status', 'Jadwal Mapel berhasil ditambahkan!');
    }

    public function simpanKejuruan(Kelas $kelas, Request $request)
    {
        $request->validate([
            'hari' => 'required',
            'jam' => 'required'
        ]);

        Jadwal::create([
            'hari' => $request->hari,
            'id_mapel' => $request->id_mapel,
            'id_jurusan' => $request->id_jurusan,
            'id_guru' => $request->id_guru,
            'jam' => $request->jam,
            'id_tahun_ajaran' => TahunAjaran::where('status', 'Aktif')->first()->id
        ]);

        return redirect()->route('admin.kelas.jadwal.index', $kelas->id)->with('status', 'Jadwal Mapel berhasil ditambahkan!');
    }

    public function destroy(Kelas $kelas, Jadwal $jadwal) 
    {
        $jadwal->delete();
        
        return redirect()->route('admin.kelas.jadwal.index', $kelas->id)->with('status', 'Jadwal Mapel berhasil dihapus!');
    }
}
