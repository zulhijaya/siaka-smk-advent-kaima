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
                    <h3 class="box-title">Update Data Kelas</h3>
                </div>
                <form action="{{ route('admin.kelas.update', $kelas) }}" method="POST" enctype="multipart/form-data"
                    role="form">
                    @csrf
                    @method('PUT')
                    <div class="box-body">
                        <div class="form-group @error('tingkat') has-error @enderror">
                            <label for="tingkat">Tingkat</label>
                            <input type="text" class="form-control" name="tingkat" id="tingkat" value="{{ $kelas->tingkat }}" placeholder="masukkan tingkat">
                            @error('tingkat') <span class="help-block">{{ $message }}</span> @enderror
                        </div>
                        <div class="form-group">
                            <label>Wali Kelas</label>
                            <select class="form-control select2" name="id_guru" style="width: 100%;">
                                @foreach( $guru2 as $guru ) 
                                <option value="{{ $guru->id }}" @if( $kelas->id == $guru->id_kelas ) selected @endif>{{ $guru->user->nama }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="box-footer">
                        <div class="pull-right btn-toolbar">
                            <a href="{{ route('admin.kelas.index') }}">
                                <button type="button" class="btn btn-default">Cancel</button>
                            </a>
                            <button type="submit" class="btn btn-primary">Update</button>
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