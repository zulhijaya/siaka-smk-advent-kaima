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
                    <h3 class="box-title">Tambah Kelas</h3>
                </div>
                <form action="{{ route('admin.kelas.simpan') }}" method="POST" enctype="multipart/form-data"
                    role="form">
                    @csrf
                    <div class="box-body">
                        <div class="form-group @error('tingkat') has-error @enderror">
                            <label for="tingkat">Tingkat</label>
                            <input type="text" class="form-control" name="tingkat" id="tingkat">
                            @error('tingkat') <span class="help-block">{{ $message }}</span> @enderror
                        </div>
                        <div class="form-group @error('id_guru') has-error @enderror">
                            <label>Wali Kelas</label>
                            <select class="form-control select2" name="id_guru" style="width: 100%;">
                                <option value=""></option>
                                @foreach( $guru2 as $guru ) 
                                <option value="{{ $guru->id }}">{{ $guru->user->nama }}</option>
                                @endforeach
                            </select>
                            @error('id_guru') <span class="help-block">{{ $message }}</span> @enderror
                        </div>
                    </div>

                    <div class="box-footer">
                        <div class="pull-right btn-toolbar">
                            <a href="{{ route('admin.kelas.index') }}">
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