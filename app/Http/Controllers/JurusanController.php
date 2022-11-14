<?php

namespace App\Http\Controllers;

use App\Models\Kelas;
use App\Models\Jurusan;
use Illuminate\Http\Request;

class JurusanController extends Controller
{
    public function index()
    {
        $jurusan2 = Jurusan::with('kelas')->get();

        return view('admin.jurusan.index', [
            'jurusan2' => $jurusan2,
            'title' => 'Data Jurusan'
        ]);
    }

    public function tambah() 
    {
        $kelas2 = Kelas::get();

        return view('admin.jurusan.tambah', [
            'kelas2' => $kelas2,
            'title' => 'Tambah Data'
        ]);
    }

    public function simpan(Request $request)
    {
        $request->validate([
            'id_kelas' => 'required',
            'nama' => 'required'
        ]);

        Jurusan::create([
            'id_kelas' => $request->id_kelas,
            'nama' => $request->nama
        ]);

        return redirect()->route('admin.jurusan.index')->with('status', 'Jurusan berhasil ditambahkan!');
    }

    public function edit(Jurusan $jurusan)
    {
        $kelas2 = Kelas::get();

        return view('admin.jurusan.edit', [
            'jurusan' => $jurusan,
            'title' => 'Edit Data',
            'kelas2' => $kelas2
        ]);
    }

    public function update(Request $request, Jurusan $jurusan)
    {
        $request->validate([
            'id_kelas' => 'required',
            'nama' => 'required'
        ]);

        $jurusan->update([
            'id_kelas' => $request->id_kelas,
            'nama' => $request->nama
        ]);

        return redirect()->route('admin.jurusan.index')->with('status', 'Jurusan berhasil diupdate!');
    }

    public function destroy(Jurusan $jurusan)
    {
        $jurusan->delete();

        return redirect()->route('admin.jurusan.index')->with('status', 'Jurusan berhasil dihapus!');
    }
}
