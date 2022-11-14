<?php

namespace App\Http\Controllers;

use App\Models\Guru;
use App\Models\Kelas;
use App\Models\Siswa;
use App\Models\Jurusan;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class KelasController extends Controller
{
    public function index()
    {
        $kelas2 = Kelas::with(['guru.user', 'jurusan2' => function($query) {
            $query->withCount('siswa2');
        }])->get();

        return view('admin.kelas.index', [
            'kelas2' => $kelas2,
            'title' => 'Data Kelas'
        ]);
    }

    public function tambah()
    {
        $guru2 = Guru::with('user')->doesntHave('kelas')->get();

        return view('admin.kelas.tambah', [
            'guru2' => $guru2,
            'title' => 'Tambah Data'
        ]);
    }

    public function simpan(Request $request)
    {
        $request->validate([
            'tingkat' => 'required',
            'id_guru' => 'required'
        ]);

        $kelas = Kelas::create([
            'tingkat' => $request->tingkat
        ]);

        Guru::find($request->id_guru)->update([
            'id_kelas' => $kelas->id
        ]);

        return redirect()->route('admin.kelas.index')->with('status', 'Kelas berhasil ditambahkan!');
    }

    public function detail(Kelas $kelas)
    {
        $kelas->load('jurusan2.siswa2');
        $siswa2 = Siswa::with('user')->whereNull('id_jurusan')->get();
        $jurusan2 = Jurusan::where('id_kelas', $kelas->id)->get();

        return view('admin.kelas.detail', [
            'kelas' => $kelas,
            'siswa2' => $siswa2,
            'jurusan2' => $jurusan2,
            'title' => 'Kelas ' . $kelas->tingkat
        ]);
    }

    public function edit(Kelas $kelas)
    {
        $guru2 = Guru::with('user')->where('id_kelas', $kelas->id)->orWhereNull('id_kelas')->get();

        return view('admin.kelas.edit', [
            'kelas' => $kelas,
            'guru2' => $guru2,
            'title' => 'Edit Data'
        ]);
    }

    public function update(Kelas $kelas, Request $request)
    {
        $request->validate([
            'tingkat' => 'required'
        ]);

        $kelas->update([
            'tingkat' => $request->tingkat
        ]);

        $walikelas_sebelumnya = Guru::where('id_kelas', $kelas->id)->first();
        if( $walikelas_sebelumnya ) {
            $walikelas_sebelumnya->update([
                'id_kelas' => NULL
            ]);
        }

        Guru::find($request->id_guru)->update([
            'id_kelas' => $kelas->id
        ]);

        return redirect()->route('admin.kelas.index')->with('status', 'Kelas berhasil diupdate!');
    }

    public function destroy(Kelas $kelas)
    {
        Guru::where('id_kelas', $kelas->id)->update([ 'id_kelas' => NULL ]);
        Siswa::whereHas('jurusan', function(Builder $query) use ($kelas) {
            $query->where('id_kelas', $kelas->id);
        })->update([ 'id_jurusan' => NULL ]);

        $kelas->jurusan2()->delete();
        $kelas->delete();

        return redirect()->route('admin.kelas.index')->with('status', 'Kelas berhasil dihapus!');
    }

    public function pilihSiswa(Kelas $kelas, Request $request)
    {
        $request->validate([
            'id_siswa' => 'required|array|min:1'
        ]);

        foreach( $request->id_siswa as $id ) {
            Siswa::find($id)->update([
                'id_jurusan' => $request->id_jurusan,
                'aktif' => true
            ]);
        }
    
        return redirect()->route('admin.kelas.detail', $kelas->id)->with('status', 'Siswa berhasil ditambahkan ke Kelas ' . $kelas->tingkat . '!');
    }

    public function keluarkanSiswaDariKelas(Kelas $kelas, Siswa $siswa)
    {
        $siswa->update([
            'id_jurusan' => NULL,
            'aktif' => false
        ]);

        return redirect()->route('admin.kelas.detail', $kelas->id)->with('status', 'Siswa berhasil dikeluarkan dari Kelas ' . $kelas->tingkat . '!');
    }
}
