@extends('layouts.admin.admin')

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
                <form action="{{ route('admin.guru.absensi.simpan', $id_jadwal) }}" method="POST" role="form">
                    @csrf
                    <div class="box-header">
                        <h3 class="box-title">Input Absensi Siswa ({{ Carbon\Carbon::createFromFormat('Y-m-d', date('Y-m-d'))
                            ->isoFormat('D MMMM Y'); }})</h3>
                        <div class="pull-right">
                            <a href="{{ route('admin.guru.absensi.input-absensi') }}">
                                <button type="button" class="btn-sm btn-primary">Kembali</button>
                            </a>
                            @if( !$absensi_count )
                            <button type="submmit" class="btn-sm btn-primary">Simpan</button>
                            @endif
                        </div>
                    </div>
                    <div class="box-body">
                        @if( !$absensi_count )
                        <div class="row">
                            <div class="col-md-2">
                                <div class="form-group @error('tanggal') has-error @enderror">
                                    <label for="tanggal">Tanggal Absensi</label>
                                    <input type="date" class="form-control" name="tanggal" id="tanggal" value="{{ date('Y-m-d') }}">
                                    @error('tanggal') <span class="help-block">{{ $message }}</span> @enderror
                                </div>
                            </div>
                        </div>
                        @endif
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>NIS</th>
                                    <th>Nama</th>
                                    <th>Status</th>
                                    <th>Alasan</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach( $siswa2 as $siswa )
                                <tr>
                                    <td>{{ $loop->iteration }}.</td>
                                    <td>{{ $siswa->user->nomor_identitas }}</td>
                                    <td>{{ $siswa->user->nama }}</td>
                                    <td>
                                        <div class="form-group">
                                            <label style="margin-right: 2rem">
                                                <input type="radio" name="status[].{{ $loop->index }}" value="Hadir" 
                                                    @if( $siswa->absensi2_count ) 
                                                        @if( $siswa->absensi2[0]->status == 'Hadir' ) checked @else disabled @endif
                                                    @endif
                                                >
                                                Hadir
                                            </label>
                                            <label style="margin-right: 2rem">
                                                <input type="radio" name="status[].{{ $loop->index }}" value="Izin"  
                                                    @if( $siswa->absensi2_count ) 
                                                        @if( $siswa->absensi2[0]->status == 'Izin' ) checked @else disabled @endif
                                                    @endif
                                                >
                                                Izin
                                            </label>
                                            <label style="margin-right: 2rem">
                                                <input type="radio" name="status[].{{ $loop->index }}" value="Sakit"  
                                                    @if( $siswa->absensi2_count ) 
                                                        @if( $siswa->absensi2[0]->status == 'Sakit' ) checked @else disabled @endif
                                                    @endif
                                                >
                                                Sakit
                                            </label>
                                            <label style="margin-right: 2rem">
                                                <input type="radio" name="status[].{{ $loop->index }}" value="Alpa"  
                                                    @if( $siswa->absensi2_count ) 
                                                        @if( $siswa->absensi2[0]->status == 'Alpa' ) checked @else disabled @endif
                                                    @endif
                                                >
                                                Alpa
                                            </label>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="form-group">
                                            <input type="text" class="form-control" name="alasan[]" @if( $siswa->absensi2_count ) value="{{ $siswa->absensi2[0]->alasan }}" disabled @endif>
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