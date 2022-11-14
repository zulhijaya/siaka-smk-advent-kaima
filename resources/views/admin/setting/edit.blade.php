@extends('layouts.admin.admin', ['title' => $title])

@section('content')
<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">Edit Setting</h3>
                </div>
                <div class="box-body">
                    <form action="{{ route('admin.setting.update', $setting->id) }}" method="POST" role="form">
                        @csrf
                        @method('PUT')
                        <div class="form-group @error('id_tahun_ajaran') has-error @enderror">
                            <label for="id_tahun_ajaran">Tahun Ajaran Aktif</label>
                            <select class="form-control" name="id_tahun_ajaran" id="id_tahun_ajaran">
                                @foreach( $tahun_ajaran2 as $tahun_ajaran )
                                <option value="{{ $tahun_ajaran->id }}" @if( $tahun_ajaran->status == 'Aktif' ) selected @endif>{{ $tahun_ajaran->tahun . ' ' . $tahun_ajaran->semester }}</option>
                                @endforeach
                            </select>
                            @error('id_tahun_ajaran') <span class="help-block">{{ $message }}</span> @enderror
                        </div>
                        <div class="form-group @error('alamat') has-error @enderror">
                            <label for="alamat">Alamat</label>
                            <textarea class="form-control" name="alamat" id="alamat" rows="2">{{ $setting->alamat }}</textarea>
                            @error('alamat') <span class="help-block">{{ $message }}</span> @enderror
                        </div>
                        <div class="form-group @error('telepon') has-error @enderror">
                            <label for="telepon">Telepon</label>
                            <input type="text" class="form-control" name="telepon" id="telepon" value="{{ $setting->telepon }}">
                            @error('telepon') <span class="help-block">{{ $message }}</span> @enderror
                        </div>
                        <div class="form-group @error('email') has-error @enderror">
                            <label for="email">Email</label>
                            <input type="email" class="form-control" name="email" id="email" value="{{ $setting->email }}">
                            @error('email') <span class="help-block">{{ $message }}</span> @enderror
                        </div>
                        <div class="form-group @error('pesan_sukses_mendaftar') has-error @enderror">
                            <label for="pesan_sukses_mendaftar">Pesan setelah siswa sukses mendaftar</label>
                            <textarea class="form-control" name="pesan_sukses_mendaftar" id="pesan_sukses_mendaftar" rows="5">{{ $setting->pesan_sukses_mendaftar }}</textarea>
                            @error('pesan_sukses_mendaftar') <span class="help-block">{{ $message }}</span> @enderror
                        </div>

                        <div class="box-footer">
                            <div class="pull-right btn-toolbar">
                                <a href="{{ route('admin.setting.index') }}">
                                    <button type="button" class="btn btn-default">Cancel</button>
                                </a>
                                <button type="submit" class="btn btn-primary">Update</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection