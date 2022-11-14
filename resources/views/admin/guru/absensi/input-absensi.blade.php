@extends('layouts.admin.admin')

@push('styles')
<link rel="stylesheet" href="{{ asset('adminlte/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css') }}">
@endpush

@section('content')
<section class="content">
    @if (session('status'))
        <div class="alert alert-success alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            {{ session('status') }}
        </div>
    @endif
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">Absensi Siswa</h3>
                </div>
                
                <div class="box-body">
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Hari</th>
                                <th>Kelas</th>
                                <th>Mapel</th>
                                <th>Jam</th>
                                <th>Pilihan</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach( $jadwal2 as $jadwal )
                            <tr>
                                <td>{{ $loop->iteration }}.</td>
                                <td>{{ $jadwal->hari }}</td>
                                <td>{{ $jadwal->jurusan->kelas->tingkat }}</td>
                                <td>{{ $jadwal->mapel->nama }}</td>
                                <td>{{ $jadwal->jam }}</td>
                                <td>
                                    <div class="btn-toolbar">
                                        <a href="{{ route('admin.guru.absensi.index', $jadwal->id) }}">
                                            <button type="button" class="btn btn-xs btn-primary" style="margin-right: 0.55rem">Input Absensi</button>
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