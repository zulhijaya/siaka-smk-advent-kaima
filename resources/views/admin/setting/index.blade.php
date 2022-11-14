@extends('layouts.admin.admin', ['title' => $title])

@section('content')
<section class="content">
    @if (session('status'))
    <div class="alert alert-success alert-dismissible" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                aria-hidden="true">&times;</span></button>
        {{ session('status') }}
    </div>
    @endif
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">Setting</h3>
                    <div class="pull-right">
                        <a href="{{ route('admin.setting.edit', $setting->id) }}">
                            <button type="button" class="btn btn-block btn-primary">Edit Data</button>
                        </a>
                    </div>
                </div>

                <div class="box-body">
                    <dl>
                        <dt>Tahun ajaran aktif :</dt>
                        <dd>{{ $tahun_ajaran->tahun . ' ' . $tahun_ajaran->semester }}</dd>
                        <br>
                        <dt>Alamat :</dt>
                        <dd>{{ $setting->alamat }}</dd>
                        <br>
                        <dt>Telepon :</dt>
                        <dd>{{ $setting->telepon }}</dd>
                        <br>
                        <dt>Email :</dt>
                        <dd>{{ $setting->email }}</dd>
                        <br>
                        <dt>Pesan setelah siswa sukses mendaftar :</dt>
                        <dd>{{ $setting->pesan_sukses_mendaftar }}</dd>
                    </dl>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@push('scripts')
<script src="{{ asset('adminlte/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js') }}"></script>
<script src="{{ asset('adminlte/bower_components/jquery-slimscroll/jquery.slimscroll.min.js') }}"></script>
@endpush