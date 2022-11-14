<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Nilai;
use App\Models\Siswa;
use App\Models\Berkas;
use App\Models\Absensi;
use App\Models\Jurusan;
use App\Models\Setting;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Builder;

class SiswaController extends Controller
{
    public function calonSiswa() 
    {
        $siswa2 = Siswa::with('user')->where('aktif', false)->get();

        return view('admin.siswa.calon-siswa', [
            'siswa2' => $siswa2,
            'title' => 'Data Calon Siswa Baru'
        ]);
    }

    public function siswaAktif() 
    {
        $siswa2 = Siswa::with('user', 'jurusan.kelas')->where('aktif', true)->get();

        return view('admin.siswa.siswa-aktif', [
            'siswa2' => $siswa2,
            'title' => 'Data Siswa Aktif'
        ]);
    }

    public function tambah() 
    {
        $jurusan2 = Jurusan::get();

        return view('admin.siswa.tambah', [
            'jurusan2' => $jurusan2,
            'title' => 'Tambah Data'
        ]);
    }

    public function simpan(Request $request) 
    {   
        $request->validate([
            'nama' => 'required',
            'jenis_kelamin' => 'required',
            'nisn' => 'required|unique:siswa,nisn',
            'nis' => 'required|unique:users,nomor_identitas',
            'no_seri_ijazah_smp' => 'required',
            'sekolah_asal_smp' => 'required',
            'no_ujian_nasional_smp' => 'required',
            'tempat_lahir' => 'required',
            'tanggal_lahir' => 'required',
            'agama' => 'required',
            'alamat' => 'required',
            'transportasi_ke_sekolah' => 'required',
            'jenis_tinggal' => 'required',
            'no_hp' => 'required',
            'penerima_kps' => 'required',
            'no_kps' => 'required_if:penerima_kps,1',
            'nama_ayah' => 'required',
            'pekerjaan_ayah' => 'required',
            'pendidikan_ayah' => 'required',
            'penghasilan_bulanan_ayah' => 'required',
            'nama_ibu' => 'required',
            'pekerjaan_ibu' => 'required',
            'pendidikan_ibu' => 'required',
            'tinggi_badan' => 'required',
            'berat_badan' => 'required',
            'jarak_ke_sekolah' => 'required',
            'waktu_tempuh_ke_sekolah' => 'required',
            'jumlah_saudara_kandung' => 'required',
            'jurusan_dipilih' => 'required',
            'ijazah' => 'required|file',
            'kk' => 'required|file',
            'ktp_ortu' => 'required|file'
        ]);

        $user = User::create([
            'nama' => Str::title($request->nama),
            'nomor_identitas' => $request->nis,
            'role' => 'Siswa'
        ]);

        $siswa = Siswa::create([
            'user_id' => $user->id,
            'jenis_kelamin' => $request->jenis_kelamin,
            'nisn' => $request->nisn,
            'no_seri_ijazah_smp' => $request->no_seri_ijazah_smp,
            'sekolah_asal_smp' => $request->sekolah_asal_smp,
            'no_ujian_nasional_smp' => $request->no_ujian_nasional_smp,
            'nik' => $request->nik,
            'tempat_lahir' => $request->tempat_lahir,
            'tanggal_lahir' => $request->tanggal_lahir,
            'agama' => $request->agama,
            'kebutuhan_khusus' => $request->kebutuhan_khusus,
            'alamat' => $request->alamat,
            'transportasi_ke_sekolah' => $request->transportasi_ke_sekolah,
            'jenis_tinggal' => $request->jenis_tinggal,
            'no_telepon_rumah' => $request->no_telepon_rumah,
            'no_hp' => $request->no_hp,
            'email' => $request->email,
            'penerima_kps' => $request->penerima_kps,
            'no_kps' => $request->no_kps,
            'no_kps' => $request->no_kps,
            'nama_ayah' => $request->nama_ayah,
            'kebutuhan_khusus_ayah' => $request->kebutuhan_khusus_ayah,
            'pekerjaan_ayah' => $request->pekerjaan_ayah,
            'pendidikan_ayah' => $request->pendidikan_ayah,
            'penghasilan_bulanan_ayah' => $request->penghasilan_bulanan_ayah,
            'nama_ibu' => $request->nama_ibu,
            'kebutuhan_khusus_ibu' => $request->kebutuhan_khusus_ibu,
            'pekerjaan_ibu' => $request->pekerjaan_ibu,
            'pendidikan_ibu' => $request->pendidikan_ibu,
            'penghasilan_bulanan_ibu' => $request->penghasilan_bulanan_ibu,
            'nama_wali' => $request->nama_wali,
            'pekerjaan_wali' => $request->pekerjaan_wali,
            'pendidikan_wali' => $request->pendidikan_wali,
            'penghasilan_bulanan_wali' => $request->penghasilan_bulanan_wali,
            'tinggi_badan' => $request->tinggi_badan,
            'berat_badan' => $request->berat_badan,
            'jarak_ke_sekolah' => $request->jarak_ke_sekolah,
            'waktu_tempuh_ke_sekolah' => $request->waktu_tempuh_ke_sekolah,
            'jumlah_saudara_kandung' => $request->jumlah_saudara_kandung,
            'jurusan_dipilih' => $request->jurusan_dipilih
        ]);

        $ijazah = $request->file('ijazah');
        $ijazah->storeAs('calon-siswa/berkas/' . $request->nama, 'FC Ijazah SMP.' . $ijazah->extension() );

        $kk = $request->file('kk');
        $kk->storeAs('calon-siswa/berkas/' . $request->nama, 'FC Kartu Keluarga.' . $kk->extension() );

        $ktp_ortu = $request->file('ktp_ortu');
        $ktp_ortu->storeAs('calon-siswa/berkas/' . $request->nama, 'FC KTP Orang Tua.' . $ktp_ortu->extension() );

        $kip = $request->file('kip');
        if( $kip ) {
            $kip->storeAs('calon-siswa/berkas/' . $request->nama, 'FC Kartu Indonesia Pintar.' . $kip->extension() );
        }

        Berkas::create([
            'id_siswa' => $siswa->id,
            'ijazah' => 'calon-siswa/berkas/' . $request->nama . '/FC Ijazah SMP.' . $ijazah->extension(),
            'kk' => 'calon-siswa/berkas/' . $request->nama . '/FC Kartu keluarga.' . $kk->extension(),
            'ktp_ortu' => 'calon-siswa/berkas/' . $request->nama . '/FC KTP Orang Tua.' . $ktp_ortu->extension(),
            'kip' => $kip ? 'calon-siswa/berkas/' . $request->nama . '/FC Kartu Indonesia Pintar.' . $kip->extension() : NULL,
        ]);
        
        return redirect()->route(auth()->user() ? 'admin.siswa.calon-siswa' : 'calon-siswa.tambah')->with('status', 'Calon siswa berhasil ditambahkan!');
    }

    public function detail(Siswa $siswa)
    {
        $siswa->load('user', 'berkas', 'jurusan.kelas.guru.user');

        return view('admin.siswa.detail', [
            'siswa' => $siswa,
            'title' => 'Profil Siswa'
        ]);
    }

    public function edit(Siswa $siswa)
    {
        $siswa->load('user');

        return view('admin.siswa.edit', [
            'siswa' => $siswa,
            'title' => 'Edit Data'
        ]);
    }

    public function update(Siswa $siswa, Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'jenis_kelamin' => 'required',
            'nisn' => 'required|unique:siswa,nisn,' . $siswa->id,
            'nis' => 'required|unique:users,nomor_identitas,' . $siswa->user->id,
            'no_seri_ijazah_smp' => 'required',
            'sekolah_asal_smp' => 'required',
            'no_ujian_nasional_smp' => 'required',
            'tempat_lahir' => 'required',
            'tanggal_lahir' => 'required',
            'agama' => 'required',
            'alamat' => 'required',
            'transportasi_ke_sekolah' => 'required',
            'jenis_tinggal' => 'required',
            'no_hp' => 'required',
            'penerima_kps' => 'required',
            'no_kps' => 'required_if:penerima_kps,1',
            'nama_ayah' => 'required',
            'pekerjaan_ayah' => 'required',
            'pendidikan_ayah' => 'required',
            'penghasilan_bulanan_ayah' => 'required',
            'nama_ibu' => 'required',
            'pekerjaan_ibu' => 'required',
            'pendidikan_ibu' => 'required',
            'tinggi_badan' => 'required',
            'berat_badan' => 'required',
            'jarak_ke_sekolah' => 'required',
            'waktu_tempuh_ke_sekolah' => 'required',
            'jumlah_saudara_kandung' => 'required'
        ]);

        $siswa->load('user', 'berkas');

        $siswa->user->update([
            'nama' => Str::title($request->nama),
            'nomor_identitas' => $request->nis
        ]);

        $foto = $request->file('foto');
        if( $foto ) {
            $nama_foto = $request->nama . '.' . $foto->extension();
            $foto->storeAs('foto/siswa', $nama_foto);
        }

        $siswa->update([
            'jenis_kelamin' => $request->jenis_kelamin,
            'nisn' => $request->nisn,
            'no_seri_ijazah_smp' => $request->no_seri_ijazah_smp,
            'sekolah_asal_smp' => $request->sekolah_asal_smp,
            'no_ujian_nasional_smp' => $request->no_ujian_nasional_smp,
            'nik' => $request->nik,
            'tempat_lahir' => $request->tempat_lahir,
            'tanggal_lahir' => $request->tanggal_lahir,
            'agama' => $request->agama,
            'kebutuhan_khusus' => $request->kebutuhan_khusus,
            'alamat' => $request->alamat,
            'transportasi_ke_sekolah' => $request->transportasi_ke_sekolah,
            'jenis_tinggal' => $request->jenis_tinggal,
            'no_telepon_rumah' => $request->no_telepon_rumah,
            'no_hp' => $request->no_hp,
            'email' => $request->email,
            'penerima_kps' => $request->penerima_kps,
            'no_kps' => $request->no_kps,
            'no_kps' => $request->no_kps,
            'nama_ayah' => $request->nama_ayah,
            'kebutuhan_khusus_ayah' => $request->kebutuhan_khusus_ayah,
            'pekerjaan_ayah' => $request->pekerjaan_ayah,
            'pendidikan_ayah' => $request->pendidikan_ayah,
            'penghasilan_bulanan_ayah' => $request->penghasilan_bulanan_ayah,
            'nama_ibu' => $request->nama_ibu,
            'kebutuhan_khusus_ibu' => $request->kebutuhan_khusus_ibu,
            'pekerjaan_ibu' => $request->pekerjaan_ibu,
            'pendidikan_ibu' => $request->pendidikan_ibu,
            'penghasilan_bulanan_ibu' => $request->penghasilan_bulanan_ibu,
            'nama_wali' => $request->nama_wali,
            'pekerjaan_wali' => $request->pekerjaan_wali,
            'pendidikan_wali' => $request->pendidikan_wali,
            'penghasilan_bulanan_wali' => $request->penghasilan_bulanan_wali,
            'tinggi_badan' => $request->tinggi_badan,
            'berat_badan' => $request->berat_badan,
            'jarak_ke_sekolah' => $request->jarak_ke_sekolah,
            'waktu_tempuh_ke_sekolah' => $request->waktu_tempuh_ke_sekolah,
            'jumlah_saudara_kandung' => $request->jumlah_saudara_kandung,
            'jurusan_dipilih' => $request->jurusan_dipilih,
            'foto' => $foto ? 'foto/siswa/' . $nama_foto : $siswa->foto,
        ]);
    
        $ijazah = $request->file('ijazah');
        if( $ijazah ) {
            Storage::delete($siswa->berkas->ijazah);
            $nama_ijazah = 'FC Ijazah SMP.' . $ijazah->extension();
            $ijazah->storeAs('calon-siswa/berkas/' . $request->nama, $nama_ijazah);
        }

        $kk = $request->file('kk');
        if( $kk ) {
            Storage::delete($siswa->berkas->kk);
            $nama_kk = 'FC Kartu Keluarga.' . $kk->extension();
            $kk->storeAs('calon-siswa/berkas/' . $request->nama, $nama_kk);
        }

        $ktp_ortu = $request->file('ktp_ortu');
        if( $ktp_ortu ) {
            Storage::delete($siswa->berkas->ktp_ortu);
            $nama_ktp_ortu = 'FC KTP Orang Tua.' . $ktp_ortu->extension();
            $ktp_ortu->storeAs('calon-siswa/berkas/' . $request->nama, $nama_ktp_ortu);
        }

        $kip = $request->file('kip');
        if( $kip ) {
            if( $siswa->berkas->kip ) Storage::delete($siswa->berkas->kip);
            $nama_kip = 'FC Kartu Indonesia Pintar.' . $kip->extension();
            $kip->storeAs('calon-siswa/berkas/' . $request->nama, $nama_kip);
        }

        $siswa->berkas->update([
            'ijazah' => $ijazah ? 'calon-siswa/berkas/' . $request->nama . '/' . $nama_ijazah : $siswa->berkas->ijazah,
            'kk' => $kk ? 'calon-siswa/berkas/' . $request->nama . '/' . $nama_kk : $siswa->berkas->kk,
            'ktp_ortu' => $ktp_ortu ? 'calon-siswa/berkas/' . $request->nama . '/' . $nama_ktp_ortu : $siswa->berkas->ktp_ortu,
            'kip' => $kip ? 'calon-siswa/berkas/' . $request->nama . '/' . $nama_kip : $siswa->berkas->kip,
        ]);
        
        return redirect()->route($siswa->aktif ? 'admin.siswa.siswa-aktif' : 'admin.siswa.calon-siswa')->with('status', 'Data siswa berhasil diupdate!');
    }

    public function destroy(Siswa $siswa)
    {
        Storage::delete($siswa->berkas->ijazah);
        Storage::delete($siswa->berkas->kk);
        Storage::delete($siswa->berkas->ktp_ortu);
        if( $siswa->berkas->kip ) Storage::delete($siswa->berkas->kip);
        $siswa->berkas->delete();

        if( $siswa->foto ) Storage::delete($siswa->foto);

        $siswa->nilai2()->delete();
        $siswa->absensi2()->delete();
        $siswa->tagihan2()->delete();

        $id_user = $siswa->user_id;
        $aktif = $siswa->aktif;
        $siswa->delete();
        User::destroy($id_user);

        return redirect()->route($aktif ? 'admin.siswa.siswa-aktif' : 'admin.siswa.calon-siswa')->with('status', 'Siswa berhasil dihapus!');
    }

    public function jadwalMapel() 
    {
        $jadwal2 = auth()->user()->load('siswa.jurusan.jadwal2.mapel', 'siswa.jurusan.jadwal2.guru.user')->siswa->jurusan->jadwal2;
        
        return view('admin.siswa.jadwal-mapel', [
            'jadwal2' =>  $jadwal2,
            'title' => 'Jadwal Mapel'
        ]);
    }

    public function nilai()
    {
        $nilai2 = Nilai::with('guru', 'mapel')->where('id_siswa', auth()->user()->siswa->id)->whereHas('tahun_ajaran', function(Builder $query) {
            $query->where('status', 'Aktif');
        })->get();

        return view('admin.siswa.nilai', [
            'nilai2' => $nilai2,
            'title' => 'Nilai Mapel'
        ]);
    }

    public function absensi()
    {
        $absensi2 = Absensi::with('jadwal.mapel')->where('id_siswa', auth()->user()->siswa->id)->whereHas('jadwal.tahun_ajaran', function(Builder $query) {
            $query->where('status', 'Aktif');
        })->get();

        return view('admin.siswa.absensi', [
            'absensi2' => $absensi2,
            'title' => 'Absensi'
        ]);
    }

    public function tagihan()
    {
        $tagihan2 = auth()->user()->load('siswa.tagihan2')->siswa->tagihan2;

        return view('admin.siswa.tagihan', [
            'tagihan2' => $tagihan2,
            'title' => 'Tagihan'
        ]);
    }

    public function daftarSiswaBaru()
    {
        $pesan = Setting::first()->pesan_sukses_mendaftar;
        
        return view('daftar-siswa-baru', [
            'pesan' => $pesan,
            'title' => 'Pendaftaran Calon Siswa Baru'
        ]);
    }
}
