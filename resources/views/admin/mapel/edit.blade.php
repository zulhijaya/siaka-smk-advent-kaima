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
                    <form action="{{ route('admin.mapel.update', $mapel->id) }}" method="POST" role="form">
                        @csrf
                        @method('PUT')
                        <div class="form-group @error('kode') has-error @enderror">
                            <label for="kode">Kode</label>
                            <input type="integer" class="form-control" name="kode" id="kode" value="{{ $mapel->kode }}">
                            @error('kode') <span class="help-block">{{ $message }}</span> @enderror
                        </div>
                        <div class="form-group @error('nama') has-error @enderror">
                            <label for="nama">Nama</label>
                            <input type="text" class="form-control" name="nama" id="nama" value="{{ $mapel->nama }}">
                            @error('nama') <span class="help-block">{{ $message }}</span> @enderror
                        </div>
                        <div class="form-group @error('kkm') has-error @enderror">
                            <label for="kkm">KKM</label>
                            <input type="integer" class="form-control" name="kkm" id="kkm" value="{{ $mapel->kkm }}">
                            @error('kkm') <span class="help-block">{{ $message }}</span> @enderror
                        </div>

                        <div class="box-footer">
                            <div class="pull-right btn-toolbar">
                                <a href="{{ route('admin.mapel.index') }}">
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