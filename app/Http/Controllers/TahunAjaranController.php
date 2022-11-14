<?php

namespace App\Http\Controllers;

use App\Models\TahunAjaran;
use Illuminate\Http\Request;

class TahunAjaranController extends Controller
{
    public function index()
    {
        $tahun_ajaran2 = TahunAjaran::get();
        
        return view('admin.tahun-ajaran.index', [
            'tahun_ajaran2' => $tahun_ajaran2,
            'title' => 'Tahun Ajaran'
        ]);
    }

    public function tambah() 
    {
        return view('admin.tahun-ajaran.tambah', [
            'title' => 'Tambah Data'
        ]);
    }

    public function simpan(Request $request)
    {
        $request->validate([
            'tahun' => 'required',
            'semester' => 'required'
        ]);

        TahunAjaran::create([
            'tahun' => $request->tahun,
            'semester' => $request->semester
        ]);

        return redirect()->route('admin.tahun-ajaran.index')->with('status', 'Tahun ajaran berhasil ditambahkan!');
    }

    public function edit(TahunAjaran $tahun_ajaran)
    {
        return view('admin.tahun-ajaran.edit', [
            'tahun_ajaran' => $tahun_ajaran,
            'title' => 'Edit Data'
        ]);
    }

    public function update(Request $request, TahunAjaran $tahun_ajaran)
    {
        $request->validate([
            'tahun' => 'required',
            'semester' => 'required'
        ]);

        $tahun_ajaran->update([
            'tahun' => $request->tahun,
            'semester' => $request->semester
        ]);

        return redirect()->route('admin.tahun-ajaran.index')->with('status', 'Tahun ajaran berhasil diupdate!');
    }

    public function destroy(TahunAjaran $tahun_ajaran)
    {
        $tahun_ajaran->delete();

        return redirect()->route('admin.tahun-ajaran.index')->with('status', 'Tahun ajaran berhasil dihapus!');
    }
}
