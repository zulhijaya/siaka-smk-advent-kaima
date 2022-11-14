<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>{{ config('app.name') }} - Pendaftaran Calon Siswa Baru</title>   
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

    <link rel="stylesheet" href="{{ asset('adminlte/bower_components/bootstrap/dist/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('adminlte/bower_components/font-awesome/css/font-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('adminlte/bower_components/Ionicons/css/ionicons.min.css') }}">
    <link rel="stylesheet" href="{{ asset('adminlte/dist/css/AdminLTE.min.css') }}">
    <link rel="stylesheet" href="{{ asset('adminlte/dist/css/skins/_all-skins.min.css') }}">
    @stack('styles')

    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>

<body class="hold-transition skin-blue sidebar-mini">
    <div class="wrapper">
        <header class="main-header">
            <!-- Logo -->
            <a href="index2.html" class="logo">
                <!-- mini logo for sidebar mini 50x50 pixels -->
                <span class="logo-mini">{{ explode(' ', config('app.name'))[0] }}</span>
                <!-- logo for regular state and mobile devices -->
                <span class="logo-lg">{{ config('app.name') }}</span>
            </a>
            <!-- Header Navbar: style can be found in header.less -->
            <nav class="navbar navbar-static-top">
                <!-- Sidebar toggle button-->
                <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
                    <span class="sr-only">Toggle navigation</span>
                </a>
        
                <div class="navbar-custom-menu">
                    <ul class="nav navbar-nav">
                        <!-- User Account: style can be found in dropdown.less -->
                        <li class="dropdown user user-menu">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <img src="{{ 'https://eu.ui-avatars.com/api/?name=' . implode('+', explode(' ', 'Siswa Baru')) }}" class="user-image" alt="User Image">
                                <span class="hidden-xs">Calon Siswa Baru</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </nav>
        </header>
        <aside class="main-sidebar">
            <!-- sidebar: style can be found in sidebar.less -->
            <section class="sidebar">
                <ul class="sidebar-menu" data-widget="tree">
                    <li class="header">MENU</li>
                    <li>
                        <a href="{{ route('index') }}">
                            <i class="fa fa-table"></i> <span>Kembali</span>
                        </a>
                    </li>
                </ul>
            </section>
            <!-- /.sidebar -->
        </aside>
    
        <div class="content-wrapper">
            <section class="content">
                @if( session('status') )
                <div class="row">
                    <div class="col-xs-12">
                        <div class="box">
                            <div class="box-header">
                                <h3 class="box-title">Formulir pendaftaran Anda berhasil dikirim</h3>
                            </div>
                            <div class="box-body">
                                {{ $pesan }}
                            </div>
                        </div>
                    </div>
                </div>
                @else
                <div class="row">
                    <div class="col-xs-12">
                        <form action="{{ route('calon-siswa.simpan') }}" method="POST" enctype="multipart/form-data" role="form">
                            @csrf
                            <div class="box">
                                <div class="box-header">
                                    <h3 class="box-title">Biodata</h3>
                                </div>
                                <div class="box-body">
                                    <div class="form-group @error('nama') has-error @enderror">
                                        <label for="nama">Nama Lengkap<span style="color: red">*</span></label>
                                        <input type="text" class="form-control" name="nama" id="nama" value="{{ old('nama') }}">
                                        @error('nama') <span class="help-block">{{ $message }}</span> @enderror
                                    </div>
                                    <div class="form-group @error('jenis_kelamin') has-error @enderror">
                                        <label for="jenis_kelamin">Jenis Kelamin<span style="color: red">*</span></label>
                                        <select class="form-control" name="jenis_kelamin" id="jenis_kelamin">
                                            <option value=""></option>
                                            <option value="L" @if( old('jenis_kelamin') == 'L' ) selected @endif>Laki-laki</option>
                                            <option value="P" @if( old('jenis_kelamin') == 'P' ) selected @endif>Perempuan</option>
                                        </select>
                                        @error('jenis_kelamin') <span class="help-block">{{ $message }}</span> @enderror
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group @error('nisn') has-error @enderror">
                                                <label for="nisn">NISN<span style="color: red">*</span></label>
                                                <input type="number" class="form-control" name="nisn" id="nisn" value="{{ old('nisn') }}">
                                                @error('nisn') <span class="help-block">{{ $message }}</span> @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group @error('nis') has-error @enderror">
                                                <label for="nis">NIS<span style="color: red">*</span></label>
                                                <input type="number" class="form-control" name="nis" id="nis" value="{{ old('nis') }}">
                                                @error('nis') <span class="help-block">{{ $message }}</span> @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group @error('no_seri_ijazah_smp') has-error @enderror">
                                        <label for="no_seri_ijazah_smp">Nomor Seri Ijazah SMP<span style="color: red">*</span></label>
                                        <input type="text" class="form-control" name="no_seri_ijazah_smp" id="no_seri_ijazah_smp" value="{{ old('no_seri_ijazah_smp') }}">
                                        @error('no_seri_ijazah_smp') <span class="help-block">{{ $message }}</span> @enderror
                                    </div>
                                    <div class="form-group @error('sekolah_asal_smp') has-error @enderror">
                                        <label for="sekolah_asal_smp">Sekolah Asal SMP<span style="color: red">*</span></label>
                                        <input type="text" class="form-control" name="sekolah_asal_smp" id="sekolah_asal_smp" value="{{ old('sekolah_asal_smp') }}">
                                        @error('sekolah_asal_smp') <span class="help-block">{{ $message }}</span> @enderror
                                    </div>
                                    <div class="form-group @error('no_ujian_nasional_smp') has-error @enderror">
                                        <label for="no_ujian_nasional_smp">Nomor Ujian Nasional SMP<span style="color: red">*</span></label>
                                        <input type="string" class="form-control" name="no_ujian_nasional_smp" id="no_ujian_nasional_smp" value="{{ old('no_ujian_nasional_smp') }}">
                                        @error('no_ujian_nasional_smp') <span class="help-block">{{ $message }}</span> @enderror
                                    </div>
                                    <div class="form-group @error('nik') has-error @enderror">
                                        <label for="nik">NIK</label>
                                        <input type="text" class="form-control" name="nik" id="nik" value="{{ old('nik') }}">
                                        @error('nik') <span class="help-block">{{ $message }}</span> @enderror
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group @error('tempat_lahir') has-error @enderror">
                                                <label for="tempat_lahir">Tempat Lahir<span style="color: red">*</span></label>
                                                <input type="text" class="form-control" name="tempat_lahir" id="tempat_lahir" value="{{ old('tempat_lahir') }}">
                                                @error('tempat_lahir') <span class="help-block">{{ $message }}</span> @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group @error('tanggal_lahir') has-error @enderror">
                                                <label for="tanggal_lahir">Tanggal Lahir<span style="color: red">*</span></label>
                                                <input type="date" class="form-control" name="tanggal_lahir" id="tanggal_lahir" value="{{ old('tanggal_lahir') }}">
                                                @error('tanggal_lahir') <span class="help-block">{{ $message }}</span> @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group @error('agama') has-error @enderror">
                                        <label for="agama">Agama<span style="color: red">*</span></label>
                                        <select class="form-control" name="agama" id="agama">
                                            <option value="" @if( old('agama') == '' ) selected @endif></option>
                                            <option value="Islam" @if( old('agama') == 'Islam' ) selected @endif>Islam</option>
                                            <option value="kristen" @if( old('agama') == 'Kristen' ) selected @endif>Kristen</option>
                                            <option value="Hindu" @if( old('agama') == 'Hindu' ) selected @endif>Hindu</option>
                                            <option value="Buddha" @if( old('agama') == 'Buddha' ) selected @endif>Buddha</option>
                                        </select>
                                        @error('agama') <span class="help-block">{{ $message }}</span> @enderror
                                    </div>
                                    <div class="form-group @error('kebutuhan_khusus') has-error @enderror">
                                        <label for="kebutuhan_khusus">Kebutuhan Khusus</label>
                                        <input type="text" class="form-control" name="kebutuhan_khusus" id="kebutuhan_khusus" value="{{ old('kebutuhan_khusus') }}">
                                        @error('kebutuhan_khusus') <span class="help-block">{{ $message }}</span> @enderror
                                    </div>
                                    <div class="form-group @error('alamat') has-error @enderror">
                                        <label for="alamat">Alamat Lengkap<span style="color: red">*</span></label>
                                        <textarea class="form-control" name="alamat" id="alamat" rows="2">{{ old('alamat') }}</textarea>
                                        @error('alamat') <span class="help-block">{{ $message }}</span> @enderror
                                    </div>
                                    <div class="form-group @error('transportasi_ke_sekolah') has-error @enderror">
                                        <label for="transportasi_ke_sekolah">Alat Tranportasi ke Sekolah<span style="color: red">*</span></label>
                                        <input type="text" class="form-control" name="transportasi_ke_sekolah" id="transportasi_ke_sekolah" value="{{ old('transportasi_ke_sekolah') }}">
                                        @error('transportasi_ke_sekolah') <span class="help-block">{{ $message }}</span> @enderror
                                    </div>
                                    <div class="form-group @error('jenis_tinggal') has-error @enderror">
                                        <label for="jenis_tinggal">Jenis Tinggal<span style="color: red">*</span></label>
                                        <input type="text" class="form-control" name="jenis_tinggal" id="jenis_tinggal" value="{{ old('jenis_tinggal') }}">
                                        @error('jenis_tinggal') <span class="help-block">{{ $message }}</span> @enderror
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group @error('no_telepon_rumah') has-error @enderror">
                                                <label for="no_telepon_rumah">Nomor Telepon Rumah</label>
                                                <input type="number" class="form-control" name="no_telepon_rumah" id="no_telepon_rumah" value="{{ old('no_telepon_rumah') }}">
                                                @error('no_telepon_rumah') <span class="help-block">{{ $message }}</span> @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group @error('no_hp') has-error @enderror">
                                                <label for="no_hp">Nomor HP<span style="color: red">*</span></label>
                                                <input type="number" class="form-control" name="no_hp" id="no_hp" value="{{ old('no_hp') }}">
                                                @error('no_hp') <span class="help-block">{{ $message }}</span> @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="email">Email</label>
                                        <input type="email" class="form-control" name="email" id="email" value="{{ old('email') }}">
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group @error('penerima_kps') has-error @enderror">
                                                <label for="penerima_kps">Penerima KPS<span style="color: red">*</span></label>
                                                <select class="form-control" name="penerima_kps" id="penerima_kps">
                                                    <option value="" selected></option>
                                                    <option value="1" {{ old('penerima_kps') == '1' ? 'selected' : '' }}>Ya</option>
                                                    <option value="0" {{ old('penerima_kps') == '0' ? 'selected' : '' }}>Tidak</option>
                                                </select>
                                                @error('penerima_kps') <span class="help-block">{{ $message }}</span> @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group @error('no_kps') has-error @enderror">
                                                <label for="no_kps">Nomor KPS</label>
                                                <input type="number" class="form-control" name="no_kps" id="no_kps" value="{{ old('no_kps') }}">
                                                @error('no_kps') <span class="help-block">{{ $message }}</span> @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group @error('nama_ayah') has-error @enderror">
                                        <label for="nama_ayah">Nama Ayah<span style="color: red">*</span></label>
                                        <input type="text" class="form-control" name="nama_ayah" id="nama_ayah" value="{{ old('nama_ayah') }}">
                                        @error('nama_ayah') <span class="help-block">{{ $message }}</span> @enderror
                                    </div>
                                    <div class="form-group @error('kebutuhan_khusus_ayah') has-error @enderror">
                                        <label for="kebutuhan_khusus_ayah">Kebutuhan Khusus Ayah</label>
                                        <input type="text" class="form-control" name="kebutuhan_khusus_ayah" id="kebutuhan_khusus_ayah" value="{{ old('kebutuhan_khusus_ayah') }}">
                                        @error('kebutuhan_khusus_ayah') <span class="help-block">{{ $message }}</span> @enderror
                                    </div>
                                    <div class="form-group @error('pekerjaan_ayah') has-error @enderror">
                                        <label for="pekerjaan_ayah">Pekerjaan Ayah<span style="color: red">*</span></label>
                                        <input type="text" class="form-control" name="pekerjaan_ayah" id="pekerjaan_ayah" value="{{ old('pekerjaan_ayah') }}">
                                        @error('pekerjaan_ayah') <span class="help-block">{{ $message }}</span> @enderror
                                    </div>
                                    <div class="form-group @error('pendidikan_ayah') has-error @enderror">
                                        <label for="pendidikan_ayah">Pendidikan Ayah<span style="color: red">*</span></label>
                                        <input type="text" class="form-control" name="pendidikan_ayah" id="pendidikan_ayah" value="{{ old('pendidikan_ayah') }}">
                                        @error('pendidikan_ayah') <span class="help-block">{{ $message }}</span> @enderror
                                    </div>
                                    <div class="form-group @error('penghasilan_bulanan_ayah') has-error @enderror">
                                        <label for="penghasilan_bulanan_ayah">Penghasilan Bulanan Ayah<span style="color: red">*</span></label>
                                        <input type="text" class="form-control" name="penghasilan_bulanan_ayah" id="penghasilan_bulanan_ayah" value="{{ old('penghasilan_bulanan_ayah') }}">
                                        @error('penghasilan_bulanan_ayah') <span class="help-block">{{ $message }}</span> @enderror
                                    </div>
                                    <div class="form-group @error('nama_ibu') has-error @enderror">
                                        <label for="nama_ibu">Nama Ibu<span style="color: red">*</span></label>
                                        <input type="text" class="form-control" name="nama_ibu" id="nama_ibu" value="{{ old('nama_ibu') }}">
                                        @error('nama_ibu') <span class="help-block">{{ $message }}</span> @enderror
                                    </div>
                                    <div class="form-group @error('kebutuhan_khusus_ibu') has-error @enderror">
                                        <label for="kebutuhan_khusus_ibu">Kebutuhan Khusus Ibu</label>
                                        <input type="text" class="form-control" name="kebutuhan_khusus_ibu" id="kebutuhan_khusus_ibu" value="{{ old('kebutuhan_khusus_ibu') }}">
                                        @error('kebutuhan_khusus_ibu') <span class="help-block">{{ $message }}</span> @enderror
                                    </div>
                                    <div class="form-group @error('pekerjaan_ibu') has-error @enderror">
                                        <label for="pekerjaan_ibu">Pekerjaan Ibu<span style="color: red">*</span></label>
                                        <input type="text" class="form-control" name="pekerjaan_ibu" id="pekerjaan_ibu" value="{{ old('pekerjaan_ibu') }}">
                                        @error('pekerjaan_ibu') <span class="help-block">{{ $message }}</span> @enderror
                                    </div>
                                    <div class="form-group @error('pendidikan_ibu') has-error @enderror">
                                        <label for="pendidikan_ibu">Pendidikan Ibu<span style="color: red">*</span></label>
                                        <input type="text" class="form-control" name="pendidikan_ibu" id="pendidikan_ibu" value="{{ old('pendidikan_ibu') }}">
                                        @error('pendidikan_ibu') <span class="help-block">{{ $message }}</span> @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="penghasilan_bulanan_ibu">Penghasilan Bulanan Ibu</label>
                                        <input type="text" class="form-control" name="penghasilan_bulanan_ibu" id="penghasilan_bulanan_ibu" value="{{ old('penghasilan_bulanan_ibu') }}">
                                    </div>
                                    <div class="form-group">
                                        <label for="nama_wali">Nama Wali</label>
                                        <input type="text" class="form-control" name="nama_wali" id="nama_wali" value="{{ old('nama_wali') }}">
                                        @error('nama_wali') <span class="help-block">{{ $message }}</span> @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="pekerjaan_wali">Pekerjaan Wali</label>
                                        <input type="text" class="form-control" name="pekerjaan_wali" id="pekerjaan_wali" value="{{ old('pekerjaan_wali') }}">
                                        @error('pekerjaan_wali') <span class="help-block">{{ $message }}</span> @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="pendidikan_wali">Pendidikan Wali</label>
                                        <input type="text" class="form-control" name="pendidikan_wali" id="pendidikan_wali" value="{{ old('pendidikan_wali') }}">
                                    </div>
                                    <div class="form-group">
                                        <label for="penghasilan_bulanan_wali">Penghasilan Wali</label>
                                        <input type="text" class="form-control" name="penghasilan_bulanan_wali" id="penghasilan_bulanan_wali" value="{{ old('penghasilan_bulanan_wali') }}">
                                    </div>
                                    <div class="form-group @error('jurusan_dipilih') has-error @enderror">
                                        <label for="jurusan_dipilih">Jurusan<span style="color: red">*</span></label>
                                        <select class="form-control" name="jurusan_dipilih" id="jurusan_dipilih">
                                            <option value="" @if( old('jurusan_dipilih') == '' ) selected @endif></option>
                                            <option value="Otomotif" @if( old('jurusan_dipilih') == 'Otomotif' ) selected @endif>Otomotif</option>
                                            <option value="Keperawatan" @if( old('jurusan_dipilih') == 'Keperawatan' ) selected @endif>Keperawatan</option>
                                            <option value="Teknik Jaringan Komputer" @if( old('jurusan_dipilih') == 'Teknik Jaringan Komputer' ) selected @endif>Teknik Jaringan Komputer</option>
                                        </select>
                                        @error('jurusan_dipilih') <span class="help-block">{{ $message }}</span> @enderror
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group @error('tinggi_badan') has-error @enderror">
                                                <label for="tinggi_badan">Tinggi Badan (cm)<span style="color: red">*</span></label>
                                                <input type="text" class="form-control" name="tinggi_badan" id="tinggi_badan" value="{{ old('tinggi_badan') }}">
                                                @error('tinggi_badan') <span class="help-block">{{ $message }}</span> @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group @error('berat_badan') has-error @enderror">
                                                <label for="berat_badan">Berat Badan (kg)<span style="color: red">*</span></label>
                                                <input type="text" class="form-control" name="berat_badan" id="berat_badan" value="{{ old('berat_badan') }}">
                                                @error('berat_badan') <span class="help-block">{{ $message }}</span> @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group @error('jarak_ke_sekolah') has-error @enderror">
                                        <label for="jarak_ke_sekolah">Jarak Tempat Tinggal ke Sekolah (km)<span style="color: red">*</span></label>
                                        <input type="text" class="form-control" name="jarak_ke_sekolah" id="jarak_ke_sekolah" value="{{ old('jarak_ke_sekolah') }}">
                                        @error('jarak_ke_sekolah') <span class="help-block">{{ $message }}</span> @enderror
                                    </div>
                                    <div class="form-group @error('waktu_tempuh_ke_sekolah') has-error @enderror">
                                        <label for="waktu_tempuh_ke_sekolah">Waktu Tempuh Berangkat ke Sekolah (menit)<span style="color: red">*</span></label>
                                        <input type="text" class="form-control" name="waktu_tempuh_ke_sekolah" id="waktu_tempuh_ke_sekolah" value="{{ old('waktu_tempuh_ke_sekolah') }}">
                                        @error('waktu_tempuh_ke_sekolah') <span class="help-block">{{ $message }}</span> @enderror
                                    </div>
                                    <div class="form-group @error('jumlah_saudara_kandung') has-error @enderror">
                                        <label for="jumlah_saudara_kandung">Jumlah Saudara Kandung<span style="color: red">*</span></label>
                                        <input type="number" class="form-control" name="jumlah_saudara_kandung" id="jumlah_saudara_kandung" value="{{ old('jumlah_saudara_kandung') }}">
                                        @error('jumlah_saudara_kandung') <span class="help-block">{{ $message }}</span> @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="box">
                                <div class="box-header">
                                    <h3 class="box-title">Berkas</h3>
                                </div>
                                <div class="box-body">
                                    <div class="form-group @error('ijazah') has-error @enderror">
                                        <label for="ijazah">FC Ijazah SMP<span style="color: red">*</span></label>
                                        <input type="file" class="form-control" name="ijazah" id="ijazah">
                                        @error('ijazah') <span class="help-block">{{ $message }}</span> @enderror
                                    </div>
                                    <div class="form-group @error('kk') has-error @enderror">
                                        <label for="kk">FC Kartu Keluarga<span style="color: red">*</span></label>
                                        <input type="file" class="form-control" name="kk" id="kk">
                                        @error('kk') <span class="help-block">{{ $message }}</span> @enderror
                                    </div>
                                    <div class="form-group @error('ktp_ortu') has-error @enderror">
                                        <label for="ktp_ortu">FC KTP Orang Tua<span style="color: red">*</span></label>
                                        <input type="file" class="form-control" name="ktp_ortu" id="ktp_ortu">
                                        @error('ktp_ortu') <span class="help-block">{{ $message }}</span> @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="kip">FC Kartu Indonesia Pintas</label>
                                        <input type="file" class="form-control" name="kip" id="kip">
                                    </div>
                                </div>
                            </div>
            
                            <div class="box-footer">
                                <div class="pull-right btn-toolbar">
                                    <button type="submit" class="btn btn-primary">Kirim</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                @endif
            </section>
        </div>
    
        @include('layouts/admin/footer')
    </div>  

    <script src="{{ asset('adminlte/bower_components/bootstrap/dist/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('adminlte/bower_components/fastclick/lib/fastclick.js') }}"></script>
    <script src="{{ asset('adminlte/dist/js/adminlte.min.js') }}"></script>
    @stack('scripts')
</body>

</html>