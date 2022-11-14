@extends('layouts.admin.admin', ['title' => $title])

@push('styles')
<link rel="stylesheet"
    href="{{ asset('adminlte/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css') }}">

<style>
    .example-modal .modal {
        position: relative;
        top: auto;
        bottom: auto;
        right: auto;
        left: auto;
        display: block;
        z-index: 1;
    }

    .example-modal .modal {
        background: transparent !important;
    }
</style>
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
                    <h3 class="box-title">Kelas {{ $kelas->tingkat }}</h3>
                    <div class="pull-right">
                        @if( auth()->user()->role == 'Administrator' )
                        <a href="{{ route('admin.kelas.index') }}">
                            <button type="button" class="btn-sm btn-primary">Kembali</button>
                        </a>
                        @endif
                        <a href="{{ route('admin.kelas.jadwal.index', $kelas->id) }}">
                            <button type="button" class="btn-sm btn-primary">Jadwal Mapel</button>
                        </a>
                        @if( auth()->user()->role == 'Administrator' )
                        <button type="button" class="btn-sm btn-primary" data-toggle="modal" data-target="#modal-default">Pilih Siswa</button>
                        @endif
                    </div>
                </div>

                <div class="modal fade" id="modal-default">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span></button>
                                <h4 class="modal-title">Pilih Siswa untuk Kelas {{ $kelas->tingkat }}</h4>
                            </div>
                            <form action="{{ route('admin.kelas.pilih-siswa', $kelas->id) }}" method="POST" role="form">
                                @csrf
                                @method('PUT')
                                <div class="modal-body">
                                    <div class="form-group">
                                        <label>Jurusan</label>
                                        <select class="form-control" name="id_jurusan">
                                            @foreach( $jurusan2 as $jurusan )
                                            <option value="{{ $jurusan->id }}">{{ $jurusan->nama }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group @error('id_siswa') has-error @enderror">
                                        <label>Siswa</label>
                                        @error('id_siswa') <span class="help-block">{{ $message }}</span> @enderror
                                        <table class="table table-bordered table-striped">
                                            <thead>
                                                <tr>
                                                    <th>NIS</th>
                                                    <th>Nama</th>
                                                    <th>Jurusan</th>
                                                    <th>Pilih</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach( $siswa2 as $siswa )
                                                <tr>
                                                    <td>{{ $siswa->user->nomor_identitas }}</td>
                                                    <td>{{ $siswa->user->nama }}</td>
                                                    <td>{{ $siswa->jurusan_dipilih }}.</td>
                                                    <td>
                                                        <input type="checkbox" name="id_siswa[]" value="{{ $siswa->id }}">
                                                    </td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-default pull-left"
                                        data-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary">Simpan</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <div class="box-body">
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>NIS</th>
                                <th>Nama</th>
                                <th>Jurusan</th>
                                <th>Pilihan</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach( $kelas->jurusan2 as $jurusan )
                                @foreach( $jurusan->siswa2 as $siswa )
                                <tr>
                                    <td>{{ $loop->iteration }}.</td>
                                    <td>{{ $siswa->user->nomor_identitas }}</td>
                                    <td>{{ $siswa->user->nama }}</td>
                                    <td>{{ $jurusan->nama }}</td>
                                    <td>
                                        <div class="btn-toolbar">
                                            <a href="{{ route('admin.siswa.detail', $siswa->id) }}">
                                                <button type="button" class="btn btn-xs btn-primary"
                                                    style="margin-right: 0.55rem">Detail</button>
                                            </a>
                                            @if( auth()->user()->role == 'Administrator' )
                                            <form action="{{ route('admin.kelas.keluarkan-siswa-dari-kelas', [$kelas->id, $siswa->id]) }}" method="post">
                                                @csrf
                                                @method('PUT')
                                                <button type="submit" class="btn btn-xs btn-danger"
                                                    onclick="return confirm('Keluarkan siswa dari kelas ?')">Hapus</button>
                                            </form>
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
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