@extends('layouts.admin.admin', ['title' => $title])

@push('styles')
<link rel="stylesheet"
    href="{{ asset('adminlte/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css') }}">
@endpush

@section('content')
<section class="content">
    @if (session('status'))
    <div class="alert alert-success alert-dismissible" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                aria-hidden="true">&times;</span></button>
        {{ session('status') }}
    </div>
    @endif
    @php
        $user = auth()->user();
    @endphp
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">Pengumuman</h3>
                    @if( $user->role == 'Administrator' || $user->role == 'Kepala Sekolah')
                    <div class="pull-right">
                        <a href="{{ route('admin.pengumuman.tambah') }}">
                            <button type="button" class="btn btn-block btn-primary">Tambah Pengumuman</button>
                        </a>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    @foreach( $pengumuman2 as $pengumuman )
    <div class="row">
        <div class="col-xs-12">
            <div class="box box-solid">
                <div class="box-header with-border">
                    <h3 class="box-title">{{ $pengumuman->judul }}</h3>
                </div>
                <div class="box-body">
                    <div style="margin-bottom: 2rem">Diposting pada {{ $pengumuman->created_at->format('d-m-Y') }}</div>
                    <p style="margin-bottom: 2rem">{{ $pengumuman->deskripsi }}</p>
                    <div class="btn-toolbar">
                        @if( $pengumuman->file )
                        <a href="{{ asset('storage/' . $pengumuman->file) }}" target="_blank">
                            <button type="button" class="btn btn-sm btn-primary" style="margin-right: 0.55rem">Tampilkan</button>
                        </a>
                        @endif
                        @if( $user->role == 'Administrator' || $user->role == 'Kepala Sekolah')
                        <a href="{{ route('admin.pengumuman.edit', $pengumuman) }}">
                            <button type="button" class="btn btn-sm btn-warning" style="margin-right: 0.55rem">Edit</button>
                        </a>
                        <form action="{{ route('admin.pengumuman.destroy', $pengumuman) }}" method="post">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Hapus pengumuman?')">Hapus</button>
                        </form>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endforeach
</section>
@endsection

@push('scripts')
<script src="{{ asset('adminlte/bower_components/datatables.net/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('adminlte/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js') }}"></script>
<script src="{{ asset('adminlte/bower_components/jquery-slimscroll/jquery.slimscroll.min.js') }}"></script>
<script>
    $(function () {
        $('#example1').DataTable()
        $('#example2').DataTable({
        'paging'      : true,
        'lengthChange': false,
        'searching'   : false,
        'ordering'    : true,
        'info'        : true,
        'autoWidth'   : false
        })
    })
</script>
@endpush