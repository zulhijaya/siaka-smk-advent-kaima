@extends('layouts.admin.admin', ['title' => $title])

@section('content')
<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">Edit Tenaga Pendidik</h3>
                </div>
                <form action="{{ route('admin.guru.update', $guru->id) }}" method="POST" enctype="multipart/form-data" role="form">
                    @csrf
                    @method('PUT')
                    <div class="box-body">
                        <div class="form-group @error('nama') has-error @enderror">
                            <label for="nama">Nama</label>
                            <input type="text" class="form-control" name="nama" id="nama" value="{{ $guru->user->nama }}">
                            @error('nama') <span class="help-block">{{ $message }}</span> @enderror
                        </div>
                        <div class="form-group @error('nip') has-error @enderror">
                            <label for="nip">NIP</label>
                            <input type="number" class="form-control" name="nip" id="nip" value="{{ $guru->user->nomor_identitas }}">
                            @error('nip') <span class="help-block">{{ $message }}</span> @enderror
                        </div>
                        <div class="form-group @error('role') has-error @enderror">
                            <label for="role">Role</label>
                            <select class="form-control" name="role" id="role">
                                <option value=""></option>
                                <option value="Guru" @if( $guru->user->role == 'Guru' ) selected @endif>Guru</option>
                                <option value="Bendahara" @if( $guru->user->role == 'Bendahara' ) selected @endif>Bendahara</option>
                                <option value="Kepala Sekolah" @if( $guru->user->role == 'Kepala Sekolah' ) selected @endif>Kepala Sekolah</option>
                            </select>
                            @error('role') <span class="help-block">{{ $message }}</span> @enderror
                        </div>
                        <div class="form-group @error('tempat_lahir') has-error @enderror">
                            <label for="tempat_lahir">Tempat Lahir</label>
                            <input type="text" class="form-control" name="tempat_lahir" id="tempat_lahir" value="{{ $guru->tempat_lahir }}">
                            @error('tempat_lahir') <span class="help-block">{{ $message }}</span> @enderror
                        </div>
                        <div class="form-group @error('tanggal_lahir') has-error @enderror">
                            <label for="tanggal_lahir">Tanggal Lahir</label>
                            <input type="date" class="form-control" name="tanggal_lahir" id="tanggal_lahir" value="{{ $guru->tanggal_lahir }}">
                            @error('tanggal_lahir') <span class="help-block">{{ $message }}</span> @enderror
                        </div>
                        <div class="form-group @error('jenis_kelamin') has-error @enderror">
                            <label for="jenis_kelamin">Jenis Kelamin</label>
                            <select class="form-control" name="jenis_kelamin" id="jenis_kelamin">
                                <option value="L" @if( $guru->jenis_kelamin == 'L' ) selected @endif>Laki-laki</option>
                                <option value="P" @if( $guru->jenis_kelamin == 'P' ) selected @endif>Perempuan</option>
                            </select>
                            @error('jenis_kelamin') <span class="help-block">{{ $message }}</span> @enderror
                        </div>
                        <div class="form-group @error('agama') has-error @enderror">
                            <label for="agama">Agama</label>
                            <select class="form-control" name="agama" id="agama">
                                <option value="Islam" @if( $guru->agama == 'Islam' ) selected @endif>Islam</option>
                                <option value="Kristen" @if( $guru->agama == 'Kristen' ) selected @endif>Kristen</option>
                                <option value="Hindu" @if( $guru->agama == 'Hindu' ) selected @endif>Hindu</option>
                                <option value="Buddha" @if( $guru->agama == 'Buddha' ) selected @endif>Buddha</option>
                            </select>
                            @error('agama') <span class="help-block">{{ $message }}</span> @enderror
                        </div>
                        <div class="form-group @error('alamat') has-error @enderror">
                            <label for="alamat">Alamat</label>
                            <textarea class="form-control" name="alamat" id="alamat" rows="2">{{ $guru->alamat }}</textarea>
                            @error('alamat') <span class="help-block">{{ $message }}</span> @enderror
                        </div>
                        <div class="form-group @error('no_tlp') has-error @enderror">
                            <label for="no_tlp">Nomor HP</label>
                            <input type="number" class="form-control" name="no_tlp" id="no_tlp" value="{{ $guru->no_tlp }}">
                            @error('no_tlp') <span class="help-block">{{ $message }}</span> @enderror
                        </div>
                        <div class="form-group @error('jabatan') has-error @enderror">
                            <label for="jabatan">Jabatan</label>
                            <input type="text" class="form-control" name="jabatan" id="jabatan" value="{{ $guru->jabatan }}">
                            @error('jabatan') <span class="help-block">{{ $message }}</span> @enderror
                        </div>
                        <div class="form-group @error('foto') has-error @enderror">
                            <label for="foto">Foto</label>
                            <input type="file" name="foto" id="foto">
                        </div>
                    </div>

                    <div class="box-footer">
                        <div class="pull-right btn-toolbar">
                            <a href="{{ route('admin.guru.index') }}">
                                <button type="button" class="btn btn-default">Cancel</button>
                            </a>
                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
@endsection