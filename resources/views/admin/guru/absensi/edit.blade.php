@extends('layouts.admin.admin')

@section('content')
<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">Edit Nilai {{ $nilai->mapel->nama }} untuk {{ $nilai->siswa->user->nama }}</h3>
                </div>
                <form action="{{ route('admin.guru.nilai.update', [$id_jadwal, $nilai->id]) }}" method="POST" role="form">
                    @csrf
                    @method('PUT')
                    <div class="box-body">
                        <div class="form-group @error('nilai') has-error @enderror">
                            <label for="nilai">Nilai</label>
                            <input type="number" class="form-control" name="nilai" id="nilai" value="{{ $nilai->nilai }}" placeholder="masukkan nilai">
                            @error('nilai') <span class="help-block">{{ $message }}</span> @enderror
                        </div>
                    </div>

                    <div class="box-footer">
                        <div class="pull-right btn-toolbar">
                            <a href="{{ route('admin.siswa.siswa-aktif') }}">
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