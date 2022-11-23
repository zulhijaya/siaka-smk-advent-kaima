<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use App\Models\TahunAjaran;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    public function index()
    {
        $setting = Setting::first();
        $tahun_ajaran = TahunAjaran::where('status', 'Aktif')->first();

        return view('admin.setting.index', [
            'setting' => $setting,
            'tahun_ajaran' => $tahun_ajaran,
            'title' => 'Setting'
        ]);
    }

    public function edit(Setting $setting)
    {
        $tahun_ajaran2 = TahunAjaran::get();

        return view('admin.setting.edit', [
            'setting' => $setting,
            'tahun_ajaran2' => $tahun_ajaran2,
            'title' => 'Edit Data'
        ]);
    }

    public function update(Request $request, Setting $setting)
    {
        $request->validate([
            'alamat' => 'required',
            'telepon' => 'required',
            'email' => 'required|email',
            'pesan_sukses_mendaftar' => 'required'
        ]);

        TahunAjaran::query()->update([
            'status' => 'Tidak Aktif'
        ]);

        TahunAjaran::find($request->id_tahun_ajaran)->update([
            'status' => 'Aktif'
        ]);

        $setting->update([
            'alamat' => $request->alamat,
            'telepon' => $request->telepon,
            'email' => $request->email,
            'izinkan_siswa_akses_rapor' => $request->izinkan_siswa_akses_rapor,
            'pesan_sukses_mendaftar' => $request->pesan_sukses_mendaftar
        ]);

        config(['app.name' => $request->nama_sekolah]);

        return redirect()->route('admin.setting.index')->with('status', 'Data berhasil diupdate!');
    }
}
