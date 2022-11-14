@extends('layouts.admin.admin', ['title' => $title])

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
                    <h3 class="box-title">Data Calon Siswa</h3>
                    @if( auth()->user()->role == 'Administrator' )
                    <div class="pull-right">
                        <a href="{{ route('admin.siswa.tambah') }}">
                            <button type="button" class="btn btn-block btn-primary">Tambah Data</button>
                        </a>
                    </div>
                    @endif
                </div>
                
                <div class="box-body">
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>NIS</th>
                                <th>Nama Lengkap</th>
                                <th>TTL</th>
                                <th>JK</th>
                                @if( auth()->user()->role == 'Administrator' )
                                <th>Pilihan</th>
                                @endif
                            </tr>
                        </thead>
                        <tbody>
                            @foreach( $siswa2 as $siswa )
                            <tr>
                                <td>{{ $loop->iteration }}.</td>
                                <td>{{ $siswa->user->nomor_identitas }}</td>
                                <td>{{ $siswa->user->nama }}</td>
                                <td>{{ $siswa->tempat_lahir }}, {{ Carbon\Carbon::createFromFormat('Y-m-d', $siswa->tanggal_lahir)
                                    ->isoFormat('D MMMM Y'); }}</td>
                                <td>{{ $siswa->jenis_kelamin }}</td>
                                @if( auth()->user()->role == 'Administrator' )
                                <td>
                                    <div class="btn-toolbar">
                                        <a href="{{ route('admin.siswa.detail', $siswa->id) }}">
                                            <button type="button" class="btn btn-xs btn-primary" style="margin-right: 0.55rem">Detail</button>
                                        </a>
                                        <a href="{{ route('admin.siswa.edit', $siswa->id) }}">
                                            <button type="button" class="btn btn-xs btn-warning" style="margin-right: 0.55rem">Edit</button>
                                        </a>
                                        <form action="{{ route('admin.siswa.destroy', $siswa->id) }}" method="post">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-xs btn-danger" onclick="return confirm('Hapus siswa?')">Hapus</button>
                                        </form>
                                    </div>
                                </td>
                                @endif
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