<?php

namespace App\Http\Controllers;

use App\Models\Pengumuman;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PengumumanController extends Controller
{
    public function index() 
    {
        $pengumuman2 = Pengumuman::get();

        return view('admin.pengumuman.index', [
            'pengumuman2' => $pengumuman2,
            'title' => 'Pengumuman'
        ]);
    }

    public function tambah()
    {
        return view('admin.pengumuman.tambah', [
            'title' => 'Tambah Pengumuman'
        ]);
    }

    public function simpan(Request $request)
    {
        $request->validate([
            'judul' => 'required',
            'deskripsi' => 'required'
        ]);
        
        $file = $request->file('file');
        if( $file ) {
            $nama_file = $request->judul . '.' . $file->extension();
            $request->file('file')->storeAs('pengumuman/', $nama_file );
        }

        Pengumuman::create([
            'judul' => $request->judul,
            'deskripsi' => $request->deskripsi,
            'file' => $file ? 'pengumuman/' . $nama_file : NULL
        ]);
        
        return redirect()->route('admin.pengumuman.index')->with('status', 'Pengumuman berhasil ditambahkan!');
    }

    public function edit(Pengumuman $pengumuman)
    {
        return view('admin.pengumuman.edit', [
            'pengumuman' => $pengumuman,
            'title' => 'Edit Pengumuman'
        ]);
    }

    public function update(Pengumuman $pengumuman, Request $request)
    {
        $request->validate([
            'judul' => 'required',
            'deskripsi' => 'required'
        ]);

        $file = $request->file('file');
        if( $file ) {
            if( $pengumuman->file ) Storage::delete($pengumuman->file);

            $nama_file = $request->judul . '.' . $file->extension();
            $file->storeAs('pengumuman/', $nama_file );
        }

        $pengumuman->update([
            'judul' => $request->judul,
            'deskripsi' => $request->deskripsi,
            'file' => $file ? 'pengumuman/' . $nama_file : $pengumuman->file
        ]);

        return redirect()->route('admin.pengumuman.index')->with('status', 'Pengumuman berhasil diupdate!');
    }

    public function destroy(Pengumuman $pengumuman)
    {
        if( $pengumuman->file ) Storage::delete($pengumuman->file);
        $pengumuman->delete();

        return redirect()->route('admin.pengumuman.index')->with('status', 'Pengumuman berhasil dihapus!');
    }
}
