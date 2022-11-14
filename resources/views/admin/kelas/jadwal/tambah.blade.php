@extends('layouts.admin.admin', ['title' => $title])

@push('styles')
<link rel="stylesheet" href="{{ asset('adminlte/bower_components/select2/dist/css/select2.min.css') }}">
@endpush

@section('content')
<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">Tambah Jadwal Mapel Kelas {{ $kelas->tingkat }}</h3>
                </div>
                <form action="{{ route('admin.kelas.jadwal.simpan', $kelas->id) }}" method="POST" role="form">
                    @csrf
                    <div class="box-body">
                        <div class="form-group">
                            <label>Hari</label>
                            <select class="form-control" name="hari">
                                <option value="Senin">Senin</option>
                                <option value="Selasa">Selasa</option>
                                <option value="Rabu">Rabu</option>
                                <option value="Kamis">Kamis</option>
                                <option value="Jumat">Jumat</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Mata Pelajaran</label>
                            <select class="form-control select2" name="id_mapel" style="width: 100%;">
                                @foreach( $mapel2 as $mapel ) 
                                <option value="{{ $mapel->id }}">{{ $mapel->nama }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Guru</label>
                            <select class="form-control select2" name="id_guru" style="width: 100%;">
                                @foreach( $guru2 as $guru ) 
                                <option value="{{ $guru->id }}">{{ $guru->nama }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group @error('jam') has-error @enderror">
                            <label for="jam">Jam</label>
                            <input type="text" class="form-control" name="jam" id="jam" placeholder="jam mulai - jam selesai">
                            @error('jam') <span class="help-block">{{ $message }}</span> @enderror
                        </div>
                    </div>

                    <div class="box-footer">
                        <div class="pull-right btn-toolbar">
                            <a href="{{ route('admin.kelas.jadwal.index', $kelas->id) }}">
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

@push('scripts')
<script src="{{ asset('adminlte/bower_components/bootstrap/dist/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('adminlte/bower_components/select2/dist/js/select2.full.min.js') }}"></script>
<script>
    $(function() {
        $('.select2').select2()
    })
</script>
@endpush