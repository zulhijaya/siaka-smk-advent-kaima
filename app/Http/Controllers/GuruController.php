<?php

namespace App\Http\Controllers;

use App\Models\Guru;
use App\Models\User;
use App\Models\Nilai;
use App\Models\Siswa;
use App\Models\Jadwal;
use App\Models\TahunAjaran;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class GuruController extends Controller
{
    public function index() 
    {
        $guru2 = Guru::with('user', 'kelas:id,tingkat')->get();

        return view('admin.guru.index', [
            'guru2' => $guru2,
            'title' => 'Data Pendidik'
        ]);
    }

    public function tambah() 
    {
        return view('admin.guru.tambah', [
            'title' => 'Tambah Data'
        ]);
    }

    public function simpan(Request $request) 
    {   
        $request->validate([
            'nama' => 'required',
            'nip' => 'required|unique:users,nomor_identitas',
            'role' => 'required',
            'tempat_lahir' => 'required',
            'tanggal_lahir' => 'required',
            'jenis_kelamin' => 'required',
            'agama' => 'required',
            'alamat' => 'required',
            'no_tlp' => 'required',
            'jabatan' => 'required'
        ]);
        
        $foto = $request->file('foto');
        if( $foto ) {
            $nama_foto = $request->nama . '.' . $foto->extension();
            $foto->storeAs('foto/tenaga-pendidik/', $nama_foto );
        }

        $user = User::create([
            'nama' => $request->nama,
            'nomor_identitas' => $request->nip,
            'role' => $request->role
        ]);

        Guru::create([
            'user_id' => $user->id,
            'tempat_lahir' => $request->tempat_lahir,
            'tanggal_lahir' => $request->tanggal_lahir,
            'jenis_kelamin' => $request->jenis_kelamin,
            'agama' => $request->agama,
            'alamat' => $request->alamat,
            'no_tlp' => $request->no_tlp,
            'jabatan' => $request->jabatan,
            'foto' => $foto ? 'foto/tenaga-pendidik/' . $nama_foto : NULL,
        ]);
        
        return redirect()->route('admin.guru.index')->with('status', 'Tenaga pendidik berhasil ditambahkan!');
    }

    public function detail(Guru $guru)
    {
        $guru->load('user', 'kelas');

        return view('admin.guru.detail', [
            'guru' => $guru,
            'title' => 'Profil Pendidik'
        ]);
    }

    public function edit(Guru $guru)
    {
        $guru->load('user');

        return view('admin.guru.edit', [
            'guru' => $guru,
            'title' => 'Edit Data'
        ]);
    }

    public function update(Guru $guru, Request $request)
    {
        $guru->load('user');

        $request->validate([
            'nama' => 'required',
            'nip' => 'required|unique:users,nomor_identitas,' . $guru->user->id,
            'role' => 'required',
            'tempat_lahir' => 'required',
            'tanggal_lahir' => 'required',
            'jenis_kelamin' => 'required',
            'agama' => 'required',
            'alamat' => 'required',
            'no_tlp' => 'required',
            'jabatan' => 'required',
        ]);
    
        
        $foto = $request->file('foto');
        if( $foto ) {
            if( $guru->foto ) Storage::delete($guru->foto);
            $nama_foto = $request->nama . '.' . $foto->extension();
            $foto->storeAs('foto/tenaga-pendidik/', $nama_foto );
        }

        $guru->user->update([
            'nama' => $request->nama,
            'nomor_identitas' => $request->nip,
            'role' => $request->role
        ]);

        $guru->update([
            'tempat_lahir' => $request->tempat_lahir,
            'tanggal_lahir' => $request->tanggal_lahir,
            'jenis_kelamin' => $request->jenis_kelamin,
            'agama' => $request->agama,
            'alamat' => $request->alamat,
            'no_tlp' => $request->no_tlp,
            'jabatan' => $request->jabatan,
            'foto' => $foto ? 'foto/tenaga-pendidik/' . $nama_foto : NULL,
        ]);

        return redirect()->route('admin.guru.index')->with('status', 'Tenaga pendidik berhasil diupdate!');
    }

    public function destroy(Guru $guru)
    {
        if( $guru->foto ) Storage::delete($guru->foto);
        
        $guru->jadwal2()->delete();

        $id_user = $guru->user_id;
        $guru->delete();
        User::destroy($id_user);

        return redirect()->route('admin.guru.index')->with('status', 'Tenaga pendidik berhasil dihapus!');
    }

    public function jadwalMengajar() 
    {
        // $jadwal2 = auth()->user()->load('guru.jadwal2.jurusan.kelas', 'guru.jadwal2.jurusan.siswa2')
        // ->guru->jadwal2->unique(function ($item) {
        //     return $item['id_mapel'].$item['hari'];
        // });

        $jadwal2 = Jadwal::with('jurusan.kelas', 'jurusan.siswa2')
            ->where('id_guru', auth()->user()->guru->id)
            ->get()
            ->unique(function ($item) {
                return $item['id_mapel'].$item['hari'];
            });
        
        return view('admin.guru.jadwal-mengajar', [
            'jadwal2' =>  $jadwal2,
            'title' => 'Jadwal Mengajar'
        ]);
    }
}
