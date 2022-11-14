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
                    <h3 class="box-title">Data Tahun Ajaran</h3>
                    <div class="pull-right">
                        <a href="{{ route('admin.tahun-ajaran.tambah') }}">
                            <button type="button" class="btn btn-block btn-primary">Tambah Data</button>
                        </a>
                    </div>
                </div>
                
                <div class="box-body">
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Tahun</th>
                                <th>Semester</th>
                                <th>Aktif</th>
                                <th>Pilihan</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach( $tahun_ajaran2 as $tahun_ajaran )
                            <tr>
                                <td>{{ $loop->iteration }}.</td>
                                <td>{{ $tahun_ajaran->tahun }}</td>
                                <td>{{ $tahun_ajaran->semester }}</td>
                                <td>{{ $tahun_ajaran->status }}</td>
                                <td>
                                    <div class="btn-toolbar">
                                        <a href="{{ route('admin.tahun-ajaran.edit', $tahun_ajaran->id) }}">
                                            <button type="button" class="btn btn-xs btn-warning" style="margin-right: 0.55rem">Edit</button>
                                        </a>
                                        <form action="{{ route('admin.tahun-ajaran.destroy', $tahun_ajaran->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-xs btn-danger" onclick="return confirm('Hapus tahun ajaran?')">Hapus</button>
                                        </form>
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