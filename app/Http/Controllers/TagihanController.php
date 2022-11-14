<?php

namespace App\Http\Controllers;

use App\Models\Siswa;
use App\Models\Tagihan;
use Illuminate\Http\Request;

class TagihanController extends Controller
{
    public function index()
    {
        $tagihan2 = Tagihan::with('siswa.user')->get();
        $siswa2 = Siswa::with('user')->get();

        return view('admin.tagihan.index', [
            'tagihan2' => $tagihan2,
            'siswa2' => $siswa2,
            'title' => 'Tagihan'
        ]);
    }

    public function simpan(Request $request)
    {
        $request->validate([
            'total' => 'required'
        ]);

        Tagihan::create([
            'id_siswa' => $request->id_siswa,
            'total' => $request->total
        ]);

        return redirect()->route('admin.tagihan.index')->with('status', 'Tagihan berhasil disimpan!');
    }

    public function destroy(Tagihan $tagihan)
    {
        $tagihan->delete();

        return redirect()->route('admin.tagihan.index')->with('status', 'Tagihan berhasil dihapus!');
    }
}
