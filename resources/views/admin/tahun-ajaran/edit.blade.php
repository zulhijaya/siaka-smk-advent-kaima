@extends('layouts.admin.admin', ['title' => $title])

@section('content')
<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">Edit Tahun Ajaran</h3>
                </div>
                <div class="box-body">
                    <form action="{{ route('admin.tahun-ajaran.update', $tahun_ajaran->id) }}" method="POST" role="form">
                        @csrf
                        @method('PUT')
                        <div class="form-group @error('tahun') has-error @enderror">
                            <label for="tahun">Tahun</label>
                            <input type="text" class="form-control" name="tahun" id="tahun" value="{{ $tahun_ajaran->tahun }}">
                            @error('tahun') <span class="help-block">{{ $message }}</span> @enderror
                        </div>
                        <div class="form-group @error('semester') has-error @enderror">
                            <label for="semester">Semester</label>
                            <select class="form-control" name="semester" id="semester">
                                <option value="Ganjil" @if( $tahun_ajaran->semester == 'Ganjil' ) selected @endif>Ganjil</option>
                                <option value="Genap" @if( $tahun_ajaran->semester == 'Genap' ) selected @endif>Genap</option>
                            </select>
                            @error('semester') <span class="help-block">{{ $message }}</span> @enderror
                        </div>

                        <div class="box-footer">
                            <div class="pull-right btn-toolbar">
                                <a href="{{ route('admin.tahun-ajaran.index') }}">
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