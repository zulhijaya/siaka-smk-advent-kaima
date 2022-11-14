@extends('layouts.admin.admin', ['title' => $title])

@section('content')
<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">Edit Visi Misi</h3>
                </div>
                <div class="box-body">
                    <form action="{{ route('admin.visi-misi.update') }}" method="POST" role="form">
                        @csrf
                        <div class="form-group @error('visi') has-error @enderror">
                            <label for="visi">Visi</label>
                            <textarea class="form-control" name="visi" id="visi" rows="2">{{ $visi }}</textarea>
                            @error('visi') <span class="help-block">{{ $message }}</span> @enderror
                        </div>
                        
                        <label>Misi</label>
                        @foreach( $misi2 as $index => $misi )
                        <div class="form-group @error('misi.' . $index) has-error @enderror">
                            <textarea class="form-control" name="misi[]" id="misi[]" rows="2">{{ $misi->deskripsi }}</textarea>
                            @error('misi.' . $index) <span class="help-block">{{ $message }}</span> @enderror
                        </div>
                        @endforeach

                        <div class="box-footer">
                            <div class="pull-right btn-toolbar">
                                <a href="{{ route('admin.visi-misi.index') }}">
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