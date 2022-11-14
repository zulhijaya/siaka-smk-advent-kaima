<?php

namespace App\Http\Controllers;

use App\Models\Mapel;
use Illuminate\Http\Request;

class MapelController extends Controller
{
    public function index()
    {
        $mapel2 = Mapel::get();

        return view('admin.mapel.index', [
            'mapel2' => $mapel2,
            'title' => 'Data Mapel'
        ]);
    }

    public function tambah() 
    {
        return view('admin.mapel.tambah', [
            'title' => 'Tambah Data'
        ]);
    }

    public function simpan(Request $request)
    {
        $request->validate([
            'kode' => 'required|unique:mapel,kode',
            'nama' => 'required',
            'kkm' => 'required'
        ]);

        Mapel::create([
            'kode' => $request->kode,
            'nama' => $request->nama,
            'kkm' => $request->kkm
        ]);

        return redirect()->route('admin.mapel.index')->with('status', 'Mapel berhasil ditambahkan!');
    }

    public function edit(Mapel $mapel)
    {
        return view('admin.mapel.edit', [
            'mapel' => $mapel,
            'title' => 'Edit Data'
        ]);
    }

    public function update(Request $request, Mapel $mapel)
    {
        $request->validate([
            'kode' => 'required|unique:mapel,kode,' . $mapel->id,
            'nama' => 'required',
            'kkm' => 'required'
        ]);

        $mapel->update([
            'kode' => $request->kode,
            'nama' => $request->nama,
            'kkm' => $request->kkm
        ]);

        return redirect()->route('admin.mapel.index')->with('status', 'Mapel berhasil diupdate!');
    }

    public function destroy(Mapel $mapel)
    {
        $mapel->delete();

        return redirect()->route('admin.mapel.index')->with('status', 'Mapel berhasil dihapus!');
    }
}