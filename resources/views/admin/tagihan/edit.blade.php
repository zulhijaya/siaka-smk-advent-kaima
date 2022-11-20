@extends('layouts.admin.admin', ['title' => $title])

@section('content')
<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">Edit Tagihan Siswa</h3>
                </div>
                <div class="box-body">
                    <form action="{{ route('admin.tagihan.update', $siswa->id) }}" method="POST" role="form">
                        @csrf
                        @method('PUT')
                        <div class="form-group @error('total') has-error @enderror">
                            <label for="total">Total</label>
                            <input type="integer" class="form-control" name="total" id="total" value="@if( $siswa->tagihan ) {{ $siswa->tagihan->total }} @else 0 @endif">
                            @error('total') <span class="help-block">{{ $message }}</span> @enderror
                        </div>

                        <div class="box-footer">
                            <div class="pull-right btn-toolbar">
                                <a href="{{ route('admin.tagihan.kelas.daftar-siswa', $siswa->jurusan->kelas) }}">
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
