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
                    <h3 class="box-title">Data Mata Pelajaran</h3>
                    <div class="pull-right">
                        <a href="{{ route('admin.mapel.tambah') }}">
                            <button type="button" class="btn btn-block btn-primary">Tambah Data</button>
                        </a>
                    </div>
                </div>
                
                <div class="box-body">
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Kode</th>
                                <th>Mata Pelajaran</th>
                                <th>KKM</th>
                                <th>Pilihan</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach( $mapel2 as $mapel )
                            <tr>
                                <td>{{ $loop->iteration }}.</td>
                                <td>{{ $mapel->kode }}</td>
                                <td>{{ $mapel->nama }}</td>
                                <td>{{ $mapel->kkm }}</td>
                                <td>
                                    <div class="btn-toolbar">
                                        <a href="{{ route('admin.mapel.edit', $mapel->id) }}">
                                            <button type="button" class="btn btn-xs btn-warning" style="margin-right: 0.55rem">Edit</button>
                                        </a>
                                        <form action="{{ route('admin.mapel.destroy', $mapel->id) }}" method="post">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-xs btn-danger" onclick="return confirm('Hapus mata pelajaran?')">Hapus</button>
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