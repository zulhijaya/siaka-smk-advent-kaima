@extends('layouts.admin.admin', ['title' => $title])

@push('styles')
<link rel="stylesheet" href="{{ asset('adminlte/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css') }}">
@endpush

@section('content')
<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <form action="{{ route('admin.guru.simpan-nilai', $id_jadwal) }}" method="POST" role="form">
                    @csrf
                    {{-- @method('PUT') --}}
                    <div class="box-header">
                        <h3 class="box-title">Input Nilai Siswa</h3>
                        <div class="pull-right">
                            <button type="submit" class="btn btn-block btn-primary">Simpan</button>
                        </div>
                    </div>
                    <div class="box-body">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>NIS</th>
                                    <th>Nama</th>
                                    <th>Nilai</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach( $siswa2 as $siswa )
                                <tr>
                                    <td>{{ $loop->iteration }}.</td>
                                    <td>{{ $siswa->user->nomor_identitas }}</td>
                                    <td>{{ $siswa->user->nama }}</td>
                                    <td>
                                        <div class="form-group @error('nilai') has-error @enderror">
                                            <input type="number" class="form-control input-sm" name="nilai[]">
                                            @error('nilai[]') <span class="help-block">{{ $message }}</span> @enderror
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </form>
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