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
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">Daftar Siswa</h3>
                    <div class="pull-right">
                        <a href="{{ route('admin.tagihan.index') }}">
                            <button type="button" class="btn-sm btn-primary">Kembali</button>
                        </a>
                    </div>
                </div>

                <div class="box-body">
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>NIS</th>
                                <th>Nama</th>
                                <th>Total</th>
                                <th>Pilihan</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach( $siswa2 as $siswa )
                            <tr>
                                <td>{{ $loop->iteration }}.</td>
                                <td>{{ $siswa->user->nomor_identitas }}</td>
                                <td>{{ $siswa->user->nama }}</td>
                                <td>@if( $siswa->tagihan ) Rp{{ number_format($siswa->tagihan->total, 0, ',', '.') }} @else 0 @endif</td>
                                <td>
                                    <div class="btn-toolbar">
                                        <a href="{{ route('admin.tagihan.siswa.edit', $siswa->id) }}">
                                            <button type="button" class="btn btn-xs btn-primary"
                                                style="margin-right: 0.55rem">Edit</button>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@push('scripts')
<script src="{{ asset('adminlte/bower_components/datatables.net/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('adminlte/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js') }}"></script>
<script src="{{ asset('adminlte/bower_components/jquery-slimscroll/jquery.slimscroll.min.js') }}"></script>
<script>
    $(function () {
        $('#example1').DataTable()
    })
</script>
@endpush
