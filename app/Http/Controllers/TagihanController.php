<?php

namespace App\Http\Controllers;

use App\Models\Kelas;
use App\Models\Siswa;
use App\Models\Tagihan;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Builder;

class TagihanController extends Controller
{
    public function index()
    {
        $kelas2 = Kelas::get();

        return view('admin.tagihan.index', [
            'kelas2' => $kelas2,
            'title' => 'Tagihan'
        ]);
    }

    public function daftarSiswa($kelas)
    {
        $siswa2 = Siswa::with('user', 'tagihan')->whereHas('jurusan', function (Builder $query) use ($kelas) {
            $query->where('id_kelas', $kelas);
        })->get();

        return view('admin.tagihan.daftar-siswa', [
            'siswa2' => $siswa2,
            'title' => 'Tagihan Siswa'
        ]);
    }

    public function edit(Siswa $siswa)
    {
        return view('admin.tagihan.edit', [
            'siswa' => $siswa->load('tagihan', 'jurusan.kelas'),
            'title' => 'Edit Tagihan'
        ]);
    }

    public function update(Request $request, Siswa $siswa)
    {
        $siswa->load('jurusan.kelas');

        $request->validate([
            'total' => 'required'
        ]);

        Tagihan::updateOrCreate(
            ['id_siswa' => $siswa->id],
            ['id_siswa' => $siswa->id, 'total' => $request->total]
        );

        return redirect()->route('admin.tagihan.kelas.daftar-siswa', $siswa->jurusan->kelas)->with('status', 'Tagihan siswa berhasil diupdate!');
    }
}
