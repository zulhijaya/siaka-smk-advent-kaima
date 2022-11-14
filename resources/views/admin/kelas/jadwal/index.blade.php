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
                    <h3 class="box-title">Jadwal Kelas {{ $kelas->tingkat }}</h3>
                    <div class="pull-right">
                        <a href="{{ route('admin.kelas.detail', $kelas->id) }}">
                            <button type="button" class="btn-sm btn-primary">Kembali</button>
                        </a>
                        @if( auth()->user()->role == 'Administrator' )
                        <button type="button" class="btn-sm btn-primary" data-toggle="modal" data-target="#modal-umum">Tambah Mapel Umum</button>
                        <button type="button" class="btn-sm btn-primary" data-toggle="modal" data-target="#modal-kejuruan">Tambah Mapel Kejuruan</button>
                        @endif
                    </div>
                </div>

                @foreach( $jurusan as $nama => $jadwal2)
                <div class="box-body">
                    <div class="box-header">
                        <h3 class="box-title">{{ $nama }}</h3>
                    </div>
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Hari</th>
                                <th>Jam</th>
                                <th>Mapel</th>
                                <th>Guru</th>
                                @if( auth()->user()->role == 'Administrator' )
                                <th>Pilihan</th>
                                @endif
                            </tr>
                        </thead>
                        <tbody>
                            @foreach( $jadwal2 as $jadwal )
                            <tr>
                                <td>{{ $loop->iteration }}.</td>
                                <td>{{ $jadwal->hari }}</td>
                                <td>{{ $jadwal->jam }}</td>
                                <td>{{ $jadwal->mapel->nama }}</td>
                                <td>{{ $jadwal->guru->user->nama }}</td>
                                @if( auth()->user()->role == 'Administrator' )
                                <td>    
                                    <div class="btn-toolbar">
                                        <form action="{{ route('admin.kelas.jadwal.destroy', [$kelas->id, $jadwal->id]) }}" method="post">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-xs btn-danger"
                                                onclick="return confirm('Hapus kelas?')">Hapus</button>
                                        </form>
                                    </div>
                                </td>
                                @endif
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                @endforeach
            </div>
        </div>
    </div>

    <div class="modal fade" id="modal-umum">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Tambah Jadwal Mapel Umum</h4>
                </div>
                <form action="{{ route('admin.kelas.jadwal.simpan-umum', $kelas->id) }}" method="POST" role="form">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <label>Hari</label>
                            <select class="form-control" name="hari">
                                <option value="Senin">Senin</option>
                                <option value="Selasa">Selasa</option>
                                <option value="Rabu">Rabu</option>
                                <option value="Kamis">Kamis</option>
                                <option value="Jumat">Jumat</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Mata Pelajaran</label>
                            <select class="form-control select2" name="id_mapel" style="width: 100%;">
                                @foreach( $mapel2 as $mapel ) 
                                <option value="{{ $mapel->id }}">{{ $mapel->nama }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Guru</label>
                            <select class="form-control select2" name="id_guru" style="width: 100%;">
                                @foreach( $guru2 as $guru ) 
                                <option value="{{ $guru->id }}">{{ $guru->user->nama }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group @error('jam') has-error @enderror">
                            <label for="jam">Jam</label>
                            <input type="text" class="form-control" name="jam" id="jam" placeholder="jam mulai - jam selesai">
                            @error('jam') <span class="help-block">{{ $message }}</span> @enderror
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
    
    <div class="modal fade" id="modal-kejuruan">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Tambah Jadwal Mapel Kejuruan</h4>
                </div>
                <form action="{{ route('admin.kelas.jadwal.simpan-kejuruan', $kelas->id) }}" method="POST" role="form">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <label>Jurusan</label>
                            <select class="form-control" name="id_jurusan">
                                @foreach( $jurusan2 as $jurusan ) 
                                <option value="{{ $jurusan->id }}">{{ $jurusan->nama }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Hari</label>
                            <select class="form-control" name="hari">
                                <option value="Senin">Senin</option>
                                <option value="Selasa">Selasa</option>
                                <option value="Rabu">Rabu</option>
                                <option value="Kamis">Kamis</option>
                                <option value="Jumat">Jumat</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Mata Pelajaran</label>
                            <select class="form-control select2" name="id_mapel" style="width: 100%;">
                                @foreach( $mapel2 as $mapel ) 
                                <option value="{{ $mapel->id }}">{{ $mapel->nama }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Guru</label>
                            <select class="form-control select2" name="id_guru" style="width: 100%;">
                                @foreach( $guru2 as $guru ) 
                                <option value="{{ $guru->id }}">{{ $guru->user->nama }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group @error('jam') has-error @enderror">
                            <label for="jam">Jam</label>
                            <input type="text" class="form-control" name="jam" id="jam" placeholder="jam mulai - jam selesai">
                            @error('jam') <span class="help-block">{{ $message }}</span> @enderror
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