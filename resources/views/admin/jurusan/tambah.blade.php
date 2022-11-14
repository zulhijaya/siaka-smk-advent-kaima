@extends('layouts.admin.admin', ['title' => $title])

@section('content')
<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">Tambah Jurusan</h3>
                </div>
                <div class="box-body">
                    <form action="{{ route('admin.jurusan.simpan') }}" method="POST" role="form">
                        @csrf
                        <div class="form-group @error('id_kelas') has-error @enderror">
                            <label for="id_kelas">Kelas</label>
                            <select class="form-control" name="id_kelas" id="id_kelas">
                                <option value=""></option>
                                @foreach( $kelas2 as $kelas )
                                <option value="{{ $kelas->id }}" @if( old('id_kelas') == $kelas->id ) selected @endif>{{ $kelas->tingkat }}</option>
                                @endforeach
                            </select>
                            @error('id_kelas') <span class="help-block">{{ $message }}</span> @enderror
                        </div>
                        <div class="form-group @error('nama') has-error @enderror">
                            <label for="nama">Jurusan</label>
                            <select class="form-control" name="nama" id="nama">
                                <option value=""></option>
                                <option value="Otomotif" @if( old('nama') == 'Otomotif' ) selected @endif>Otomotif</option>
                                <option value="Keperawatan" @if( old('nama') == 'Keperawatan' ) selected @endif>Keperawatan</option>
                                <option value="Teknik Jaringan Komputer" @if( old('nama') == 'Teknik Jaringan Komputer' ) selected @endif>Teknik Jaringan Komputer</option>
                            </select>
                            @error('nama') <span class="help-block">{{ $message }}</span> @enderror
                        </div>

                        <div class="box-footer">
                            <div class="pull-right btn-toolbar">
                                <a href="{{ route('admin.jurusan.index') }}">
                                    <button type="button" class="btn btn-default">Cancel</button>
                                </a>
                                <button type="submit" class="btn btn-primary">Simpan</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection