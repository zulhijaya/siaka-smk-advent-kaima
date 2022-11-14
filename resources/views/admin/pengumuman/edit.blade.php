@extends('layouts.admin.admin')

@section('content')
<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">Edit Pengumuman</h3>
                </div>
                <form action="{{ route('admin.pengumuman.update', $pengumuman) }}" method="POST" enctype="multipart/form-data" role="form">
                    @csrf
                    @method('PUT')
                    <div class="box-body">
                        <div class="form-group @error('judul') has-error @enderror">
                            <label for="judul">Judul</label>
                            <input type="text" class="form-control" name="judul" id="judul" value="{{ $pengumuman->judul }}">
                            @error('judul') <span class="help-block">{{ $message }}</span> @enderror
                        </div>
                        <div class="form-group @error('deskripsi') has-error @enderror">
                            <label for="deskripsi">Deskripsi</label>
                            <textarea class="form-control" name="deskripsi" id="deskripsi" rows="10">{{ $pengumuman->deskripsi }}</textarea>
                            @error('deskripsi') <span class="help-block">{{ $message }}</span> @enderror
                        </div>
                        <div class="form-group @error('file') has-error @enderror">
                            <label for="file">File</label>
                            <input type="file" name="file" id="file">
                            @error('file') <span class="help-block">{{ $message }}</span> @enderror
                        </div>
                    </div>

                    <div class="box-footer">
                        <div class="pull-right btn-toolbar">
                            <a href="{{ route('admin.pengumuman.index') }}">
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