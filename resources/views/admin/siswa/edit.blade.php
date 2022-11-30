@extends('layouts.admin.admin')

@section('content')
<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">Edit Data Calon Siswa</h3>
                    <div class="pull-right">
                        <a href="{{ route('admin.siswa.calon-siswa') }}">
                            <button type="button" class="btn btn-block btn-primary">Kembali</button>
                        </a>
                    </div>
                </div>
            </div>
            <form action="{{ route('admin.siswa.update', $siswa->id) }}" method="POST" enctype="multipart/form-data" role="form">
                @csrf
                @method('PUT')
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">Biodata</h3>
                    </div>
                    <div class="box-body">
                        <div class="form-group @error('nama') has-error @enderror">
                            <label for="nama">Nama Lengkap</label>
                            <input type="text" class="form-control" name="nama" id="nama" value="{{ $siswa->user->nama }}">
                            @error('nama') <span class="help-block">{{ $message }}</span> @enderror
                        </div>
                        <div class="form-group @error('jenis_kelamin') has-error @enderror">
                            <label for="jenis_kelamin">Jenis Kelamin</label>
                            <select class="form-control" name="jenis_kelamin" id="jenis_kelamin">
                                <option value="L" @if( $siswa->jenis_kelamin == 'L' ) selected @endif>Laki-laki</option>
                                <option value="P" @if( $siswa->jenis_kelamin == 'P' ) selected @endif>Perempuan</option>
                            </select>
                            @error('jenis_kelamin') <span class="help-block">{{ $message }}</span> @enderror
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group @error('nisn') has-error @enderror">
                                    <label for="nisn">NISN</label>
                                    <input type="number" class="form-control" name="nisn" id="nisn" value="{{ $siswa->nisn }}">
                                    @error('nisn') <span class="help-block">{{ $message }}</span> @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group @error('nis') has-error @enderror">
                                    <label for="nis">NIS</label>
                                    <input type="number" class="form-control" name="nis" id="nis" value="{{ $siswa->user->nomor_identitas }}">
                                    @error('nis') <span class="help-block">{{ $message }}</span> @enderror
                                </div>
                            </div>
                        </div>
                        <div class="form-group @error('no_seri_ijazah_smp') has-error @enderror">
                            <label for="no_seri_ijazah_smp">Nomor Seri Ijazah SMP</label>
                            <input type="text" class="form-control" name="no_seri_ijazah_smp" id="no_seri_ijazah_smp" value="{{ $siswa->no_seri_ijazah_smp }}">
                            @error('no_seri_ijazah_smp') <span class="help-block">{{ $message }}</span> @enderror
                        </div>
                        <div class="form-group @error('sekolah_asal_smp') has-error @enderror">
                            <label for="sekolah_asal_smp">Sekolah Asal SMP</label>
                            <input type="text" class="form-control" name="sekolah_asal_smp" id="sekolah_asal_smp" value="{{ $siswa->sekolah_asal_smp }}">
                            @error('sekolah_asal_smp') <span class="help-block">{{ $message }}</span> @enderror
                        </div>
                        <div class="form-group @error('no_ujian_nasional_smp') has-error @enderror">
                            <label for="no_ujian_nasional_smp">Nomor Ujian Nasional SMP</label>
                            <input type="string" class="form-control" name="no_ujian_nasional_smp" id="no_ujian_nasional_smp" value="{{ $siswa->no_ujian_nasional_smp }}">
                            @error('no_ujian_nasional_smp') <span class="help-block">{{ $message }}</span> @enderror
                        </div>
                        <div class="form-group @error('nik') has-error @enderror">
                            <label for="nik">NIK</label>
                            <input type="text" class="form-control" name="nik" id="nik" value="{{ $siswa->nik }}">
                            @error('nik') <span class="help-block">{{ $message }}</span> @enderror
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group @error('tempat_lahir') has-error @enderror">
                                    <label for="tempat_lahir">Tempat Lahir</label>
                                    <input type="text" class="form-control" name="tempat_lahir" id="tempat_lahir" value="{{ $siswa->tempat_lahir }}">
                                    @error('tempat_lahir') <span class="help-block">{{ $message }}</span> @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group @error('tanggal_lahir') has-error @enderror">
                                    <label for="tanggal_lahir">Tanggal Lahir</label>
                                    <input type="date" class="form-control" name="tanggal_lahir" id="tanggal_lahir" value="{{ $siswa->tanggal_lahir }}">
                                    @error('tanggal_lahir') <span class="help-block">{{ $message }}</span> @enderror
                                </div>
                            </div>
                        </div>
                        <div class="form-group @error('agama') has-error @enderror">
                            <label for="agama">Agama</label>
                            <select class="form-control" name="agama" id="agama">
                                <option value="Islam" @if( $siswa->agama == 'Islam' ) selected @endif>Islam</option>
                                <option value="kristen" @if( $siswa->agama == 'Kristen' ) selected @endif>Kristen</option>
                                <option value="Hindu" @if( $siswa->agama == 'Hindu' ) selected @endif>Hindu</option>
                                <option value="Buddha" @if( $siswa->agama == 'Buddha' ) selected @endif>Buddha</option>
                            </select>
                            @error('agama') <span class="help-block">{{ $message }}</span> @enderror
                        </div>
                        <div class="form-group @error('kebutuhan_khusus') has-error @enderror">
                            <label for="kebutuhan_khusus">Kebutuhan Khusus</label>
                            <select class="form-control" name="kebutuhan_khusus" id="kebutuhan_khusus">
                                <option value="" @if( !$siswa->kebutuhan_khusus ) selected @endif></option>
                                <option value="Iya" @if( $siswa->kebutuhan_khusus == 'Iya' ) selected @endif>Iya</option>
                                <option value="Tidak" @if( $siswa->kebutuhan_khusus == 'Tidak' ) selected @endif>Tidak</option>
                            </select>
                            @error('kebutuhan_khusus') <span class="help-block">{{ $message }}</span> @enderror
                        </div>
                        <div class="form-group @error('alamat') has-error @enderror">
                            <label for="alamat">Alamat Lengkap</label>
                            <textarea class="form-control" name="alamat" id="alamat" rows="2">{{ $siswa->alamat }}</textarea>
                            @error('alamat') <span class="help-block">{{ $message }}</span> @enderror
                        </div>
                        <div class="form-group @error('transportasi_ke_sekolah') has-error @enderror">
                            <label for="transportasi_ke_sekolah">Alat Transportasi ke Sekolah</label>
                            <input type="text" class="form-control" name="transportasi_ke_sekolah" id="transportasi_ke_sekolah" value="{{ $siswa->transportasi_ke_sekolah }}">
                            @error('transportasi_ke_sekolah') <span class="help-block">{{ $message }}</span> @enderror
                        </div>
                        <div class="form-group @error('jenis_tinggal') has-error @enderror">
                            <label for="jenis_tinggal">Jenis Tinggal</label>
                            <input type="text" class="form-control" name="jenis_tinggal" id="jenis_tinggal" value="{{ $siswa->jenis_tinggal }}">
                            @error('jenis_tinggal') <span class="help-block">{{ $message }}</span> @enderror
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group @error('no_telepon_rumah') has-error @enderror">
                                    <label for="no_telepon_rumah">Nomor Telepon Rumah</label>
                                    <input type="number" class="form-control" name="no_telepon_rumah" id="no_telepon_rumah" value="{{ $siswa->no_telepon_rumah }}">
                                    @error('no_telepon_rumah') <span class="help-block">{{ $message }}</span> @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group @error('no_hp') has-error @enderror">
                                    <label for="no_hp">Nomor HP</label>
                                    <input type="number" class="form-control" name="no_hp" id="no_hp" value="{{ $siswa->no_hp }}">
                                    @error('no_hp') <span class="help-block">{{ $message }}</span> @enderror
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" class="form-control" name="email" id="email" value="{{ $siswa->email }}">
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group @error('penerima_kps') has-error @enderror">
                                    <label for="penerima_kps">Penerima KPS</label>
                                    <select class="form-control" name="penerima_kps" id="penerima_kps">
                                        <option value="" selected></option>
                                        <option value="1" {{ $siswa->penerima_kps == '1' ? 'selected' : '' }}>Ya</option>
                                        <option value="0" {{ $siswa->penerima_kps == '0' ? 'selected' : '' }}>Tidak</option>
                                    </select>
                                    @error('penerima_kps') <span class="help-block">{{ $message }}</span> @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group @error('no_kps') has-error @enderror">
                                    <label for="no_kps">Nomor KPS</label>
                                    <input type="number" class="form-control" name="no_kps" id="no_kps" value="{{ $siswa->no_kps }}">
                                    @error('no_kps') <span class="help-block">{{ $message }}</span> @enderror
                                </div>
                            </div>
                        </div>
                        <div class="form-group @error('nama_ayah') has-error @enderror">
                            <label for="nama_ayah">Nama Ayah</label>
                            <input type="text" class="form-control" name="nama_ayah" id="nama_ayah" value="{{ $siswa->nama_ayah }}">
                            @error('nama_ayah') <span class="help-block">{{ $message }}</span> @enderror
                        </div>
                        <div class="form-group @error('kebutuhan_khusus_ayah') has-error @enderror">
                            <label for="kebutuhan_khusus_ayah">Kebutuhan Khusus Ayah</label>
                            <select class="form-control" name="kebutuhan_khusus_ayah" id="kebutuhan_khusus_ayah">
                                <option value="" @if( !$siswa->kebutuhan_khusus_ayah ) selected @endif></option>
                                <option value="Iya" @if( $siswa->kebutuhan_khusus_ayah == 'Iya' ) selected @endif>Iya</option>
                                <option value="Tidak" @if( $siswa->kebutuhan_khusus_ayah == 'Tidak' ) selected @endif>Tidak</option>
                            </select>
                            @error('kebutuhan_khusus_ayah') <span class="help-block">{{ $message }}</span> @enderror
                        </div>
                        <div class="form-group @error('pekerjaan_ayah') has-error @enderror">
                            <label for="pekerjaan_ayah">Pekerjaan Ayah</label>
                            <input type="text" class="form-control" name="pekerjaan_ayah" id="pekerjaan_ayah" value="{{ $siswa->pekerjaan_ayah }}">
                            @error('pekerjaan_ayah') <span class="help-block">{{ $message }}</span> @enderror
                        </div>
                        <div class="form-group @error('pendidikan_ayah') has-error @enderror">
                            <label for="pendidikan_ayah">Pendidikan Ayah</label>
                            <input type="text" class="form-control" name="pendidikan_ayah" id="pendidikan_ayah" value="{{ $siswa->pendidikan_ayah }}">
                            @error('pendidikan_ayah') <span class="help-block">{{ $message }}</span> @enderror
                        </div>
                        <div class="form-group @error('penghasilan_bulanan_ayah') has-error @enderror">
                            <label for="penghasilan_bulanan_ayah">Penghasilan Bulanan Ayah</label>
                            <input type="text" class="form-control" name="penghasilan_bulanan_ayah" id="penghasilan_bulanan_ayah" value="{{ $siswa->penghasilan_bulanan_ayah }}">
                            @error('penghasilan_bulanan_ayah') <span class="help-block">{{ $message }}</span> @enderror
                        </div>
                        <div class="form-group @error('nama_ibu') has-error @enderror">
                            <label for="nama_ibu">Nama Ibu</label>
                            <input type="text" class="form-control" name="nama_ibu" id="nama_ibu" value="{{ $siswa->nama_ibu }}">
                            @error('nama_ibu') <span class="help-block">{{ $message }}</span> @enderror
                        </div>
                        <div class="form-group @error('kebutuhan_khusus_ibu') has-error @enderror">
                            <label for="kebutuhan_khusus_ibu">Kebutuhan Khusus Ibu</label>
                            <select class="form-control" name="kebutuhan_khusus_ibu" id="kebutuhan_khusus_ibu">
                                <option value="" @if( !$siswa->kebutuhan_khusus_ibu ) selected @endif></option>
                                <option value="Iya" @if( $siswa->kebutuhan_khusus_ibu == 'Iya' ) selected @endif>Iya</option>
                                <option value="Tidak" @if( $siswa->kebutuhan_khusus_ibu == 'Tidak' ) selected @endif>Tidak</option>
                            </select>
                            @error('kebutuhan_khusus_ibu') <span class="help-block">{{ $message }}</span> @enderror
                        </div>
                        <div class="form-group @error('pekerjaan_ibu') has-error @enderror">
                            <label for="pekerjaan_ibu">Pekerjaan Ibu</label>
                            <input type="text" class="form-control" name="pekerjaan_ibu" id="pekerjaan_ibu" value="{{ $siswa->pekerjaan_ibu }}">
                            @error('pekerjaan_ibu') <span class="help-block">{{ $message }}</span> @enderror
                        </div>
                        <div class="form-group @error('pendidikan_ibu') has-error @enderror">
                            <label for="pendidikan_ibu">Pendidikan Ibu</label>
                            <input type="text" class="form-control" name="pendidikan_ibu" id="pendidikan_ibu" value="{{ $siswa->pendidikan_ibu }}">
                            @error('pendidikan_ibu') <span class="help-block">{{ $message }}</span> @enderror
                        </div>
                        <div class="form-group @error('penghasilan_bulanan_ibu') has-error @enderror">
                            <label for="penghasilan_bulanan_ibu">Penghasilan Bulanan Ibu</label>
                            <input type="text" class="form-control" name="penghasilan_bulanan_ibu" id="penghasilan_bulanan_ibu" value="{{ $siswa->penghasilan_bulanan_ibu }}">
                            @error('penghasilan_bulanan_ibu') <span class="help-block">{{ $message }}</span> @enderror
                        </div>
                        <div class="form-group @error('nama_wali') has-error @enderror">
                            <label for="nama_wali">Nama Wali</label>
                            <input type="text" class="form-control" name="nama_wali" id="nama_wali" value="{{ $siswa->nama_wali }}">
                            @error('nama_wali') <span class="help-block">{{ $message }}</span> @enderror
                        </div>
                        <div class="form-group @error('pekerjaan_wali') has-error @enderror">
                            <label for="pekerjaan_wali">Pekerjaan Wali</label>
                            <input type="text" class="form-control" name="pekerjaan_wali" id="pekerjaan_wali" value="{{ $siswa->pekerjaan_wali }}">
                            @error('pekerjaan_wali') <span class="help-block">{{ $message }}</span> @enderror
                        </div>
                        <div class="form-group @error('pendidikan_wali') has-error @enderror">
                            <label for="pendidikan_wali">Pendidikan Wali</label>
                            <input type="text" class="form-control" name="pendidikan_wali" id="pendidikan_wali" value="{{ $siswa->pendidikan_wali }}">
                            @error('pendidikan_wali') <span class="help-block">{{ $message }}</span> @enderror
                        </div>
                        <div class="form-group @error('penghasilan_bulanan_wali') has-error @enderror">
                            <label for="penghasilan_bulanan_wali">Penghasilan Wali</label>
                            <input type="text" class="form-control" name="penghasilan_bulanan_wali" id="penghasilan_bulanan_wali" value="{{ $siswa->penghasilan_bulanan_wali }}">
                            @error('penghasilan_bulanan_wali') <span class="help-block">{{ $message }}</span> @enderror
                        </div>
                        <div class="form-group @error('jurusan_dipilih') has-error @enderror">
                            <label for="jurusan_dipilih">Jurusan</label>
                            <select class="form-control" name="jurusan_dipilih" id="jurusan_dipilih">
                                <option value="Otomotif" @if( $siswa->jurusan_dipilih == 'Otomotif' ) selected @endif>Otomotif</option>
                                <option value="Keperawatan" @if( $siswa->jurusan_dipilih == 'Keperawatan' ) selected @endif>Keperawatan</option>
                                <option value="Teknik Jaringan Komputer" @if( $siswa->jurusan_dipilih == 'Teknik Jaringan Komputer' ) selected @endif>Teknik Jaringan Komputer</option>
                            </select>
                            @error('jurusan_dipilih') <span class="help-block">{{ $message }}</span> @enderror
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group @error('tinggi_badan') has-error @enderror">
                                    <label for="tinggi_badan">Tinggi Badan (cm)</label>
                                    <input type="text" class="form-control" name="tinggi_badan" id="tinggi_badan" value="{{ $siswa->tinggi_badan }}">
                                    @error('tinggi_badan') <span class="help-block">{{ $message }}</span> @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group @error('berat_badan') has-error @enderror">
                                    <label for="berat_badan">Berat Badan (kg)</label>
                                    <input type="text" class="form-control" name="berat_badan" id="berat_badan" value="{{ $siswa->berat_badan }}">
                                    @error('berat_badan') <span class="help-block">{{ $message }}</span> @enderror
                                </div>
                            </div>
                        </div>
                        <div class="form-group @error('jarak_ke_sekolah') has-error @enderror">
                            <label for="jarak_ke_sekolah">Jarak Tempat Tinggal ke Sekolah (km)</label>
                            <input type="text" class="form-control" name="jarak_ke_sekolah" id="jarak_ke_sekolah" value="{{ $siswa->jarak_ke_sekolah }}">
                            @error('jarak_ke_sekolah') <span class="help-block">{{ $message }}</span> @enderror
                        </div>
                        <div class="form-group @error('waktu_tempuh_ke_sekolah') has-error @enderror">
                            <label for="waktu_tempuh_ke_sekolah">Waktu Tempuh Berangkat ke Sekolah (menit)</label>
                            <input type="text" class="form-control" name="waktu_tempuh_ke_sekolah" id="waktu_tempuh_ke_sekolah" value="{{ $siswa->waktu_tempuh_ke_sekolah }}">
                            @error('waktu_tempuh_ke_sekolah') <span class="help-block">{{ $message }}</span> @enderror
                        </div>
                        <div class="form-group @error('jumlah_saudara_kandung') has-error @enderror">
                            <label for="jumlah_saudara_kandung">Jumlah Saudara Kandung</label>
                            <input type="number" class="form-control" name="jumlah_saudara_kandung" id="jumlah_saudara_kandung" value="{{ $siswa->jumlah_saudara_kandung }}">
                            @error('jumlah_saudara_kandung') <span class="help-block">{{ $message }}</span> @enderror
                        </div>
                        <div class="form-group">
                            <label for="foto">Foto</label>
                            <input type="file" class="form-control" name="foto" id="foto">
                        </div>
                    </div>
                </div>
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">Berkas</h3>
                    </div>
                    <div class="box-body">
                        <div class="form-group">
                            <label for="ijazah">FC Ijazah SMP</label>
                            <input type="file" class="form-control" name="ijazah" id="ijazah">
                        </div>
                        <div class="form-group">
                            <label for="kk">FC Kartu Keluarga</label>
                            <input type="file" class="form-control" name="kk" id="kk">
                        </div>
                        <div class="form-group">
                            <label for="ktp_ortu">FC KTP Orang Tua</label>
                            <input type="file" class="form-control" name="ktp_ortu" id="ktp_ortu">
                        </div>
                        <div class="form-group">
                            <label for="kip">FC Kartu Indonesia Pintas</label>
                            <input type="file" class="form-control" name="kip" id="kip">
                        </div>
                    </div>
                </div>

                <div class="box-footer">
                    <div class="pull-right btn-toolbar">
                        <a href="{{ route('admin.siswa.calon-siswa') }}">
                            <button type="button" class="btn btn-default">Cancel</button>
                        </a>
                        <button type="submit" class="btn btn-primary">Update</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</section>
@endsection
