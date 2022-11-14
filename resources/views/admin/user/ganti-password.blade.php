@extends('layouts.admin.admin', ['title' => $title])

@section('content')
<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">Ganti Password</h3>
                </div>
                <form action="{{ route('admin.user.update-password') }}" method="POST" role="form">
                    @csrf
                    <div class="box-body">
                        <div class="form-group @error('password') has-error @enderror">
                            <label for="password">Password</label>
                            <input type="password" class="form-control" name="password" id="password" placeholder="masukkan password baru">
                            @error('password') <span class="help-block">{{ $message }}</span> @enderror
                        </div>
                    </div>

                    <div class="box-footer">
                        <div class="pull-right btn-toolbar">
                            @if( auth()->user()->role == 'Siswa' )
                            <a href="{{ route('admin.siswa.detail', auth()->user()->siswa->id) }}">
                                <button type="button" class="btn btn-default">Cancel</button>
                            </a>
                            @elseif( auth()->user()->role == 'Guru' || auth()->user()->role == 'Bendahara' )
                            <a href="{{ route('admin.guru.detail', auth()->user()->guru->id) }}">
                                <button type="button" class="btn btn-default">Cancel</button>
                            </a>
                            @else
                            {{-- <a href="{{ route('admin.guru.detail') }}">
                                <button type="button" class="btn btn-default">Cancel</button>
                            </a> --}}
                            @endif
                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
@endsection