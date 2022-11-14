<?php

namespace App\Http\Controllers;

use App\Models\Misi;
use App\Models\Setting;
use Illuminate\Http\Request;

class VisiMisiController extends Controller
{
    public function index()
    {
        $visi = Setting::first()->visi;
        $misi2 = Misi::get();

        return view('admin.visi-misi.index', [
            'visi' => $visi,
            'misi2' => $misi2,
            'title' => 'Visi Misi',
        ]);
    }

    public function tambahMisi()
    {
        return view('admin.visi-misi.tambah-misi', [
            'title' => 'Tambah Misi'
        ]);
    }

    public function simpanMisi(Request $request)
    {
        $request->validate([
            'misi' => 'required'
        ]);

        Misi::create([
            'deskripsi' => $request->misi
        ]);

        return redirect()->route('admin.visi-misi.index')->with('status', 'Misi berhasil ditambahkan!');
    }

    public function edit()
    {
        $visi = Setting::first()->visi;
        $misi2 = Misi::get();

        return view('admin.visi-misi.edit', [
            'visi' => $visi,
            'misi2' => $misi2,
            'title' => 'Edit Visi Misi'
        ]);
    }

    public function update(Request $request)
    {
        $request->validate([
            'visi' => 'required',
            'misi' => 'required|array',
            'misi.*' => 'required',
        ]);

        Setting::first()->update([
            'visi' => $request->visi
        ]);

        $misi2 = Misi::get();
        foreach( $misi2 as $index => $misi ) {
            $misi->update([
                'deskripsi' => $request->misi[$index]
            ]);
        }

        return redirect()->route('admin.visi-misi.index')->with('status', 'Visi misi berhasil diupdate!');
    }

    public function destroyMisi(Misi $misi)
    {
        $misi->delete();
        
        return redirect()->route('admin.visi-misi.index')->with('status', 'Misi berhasil dihapus!');
    }
}
