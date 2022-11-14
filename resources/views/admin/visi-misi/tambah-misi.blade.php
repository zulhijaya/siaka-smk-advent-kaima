@extends('layouts.admin.admin', ['title' => $title])

@section('content')
<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">Tambah Misi</h3>
                </div>
                <div class="box-body">
                    <form action="{{ route('admin.visi-misi.simpan-misi') }}" method="POST" role="form">
                        @csrf
                        <div class="form-group @error('misi') has-error @enderror">
                            <label for="misi">Misi</label>
                            <textarea class="form-control" name="misi" id="misi" rows="2"></textarea>
                            @error('misi') <span class="help-block">{{ $message }}</span> @enderror
                        </div>

                        <div class="box-footer">
                            <div class="pull-right btn-toolbar">
                                <a href="{{ route('admin.visi-misi.index') }}">
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