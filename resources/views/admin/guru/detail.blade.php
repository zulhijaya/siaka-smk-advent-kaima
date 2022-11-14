@extends('layouts.admin.admin', ['title' => $title])

@section('content')
<section class="content">
    <div class="box">
        <div class="box-header">
            <h3 class="box-title">Detail Pendidik</h3>
            @if( auth()->user()->role == 'Administrator' )
            <div class="pull-right">
                <a href="{{ route('admin.guru.index') }}">
                    <button type="button" class="btn btn-block btn-primary">Kembali</button>
                </a>
            </div>
            @endif
        </div>
        <div class="row">
            <div class="col-md-3">
                <div class="box-body">
                    @if( $guru->foto )
                    <div class="thumbnail">
                        <img src="{{ asset('storage/' . $guru->foto) }}" alt="{{ $guru->user->nama }}">
                    </div>
                    @endif
                    <div class="box-header with-border">
                        <h3 class="box-title text-uppercase">{{ $guru->user->nama }}</h3>
                    </div>
                    <table class="table table-bordered">
                        <tr>
                            <td>Jabatan</td>
                            <td>:</td>
                            <td>{{ $guru->jabatan }}</td>
                        </tr>
                        @if( $guru->id_kelas )
                        <tr>
                            <td>Wali Kelas</td>
                            <td>:</td>
                            <td>{{ $guru->kelas->tingkat }}</td>
                        </tr>
                        @endif
                    </table>
                </div>
            </div>
            <div class="col-md-9">
                <div class="box-header with-border">
                    <h3 class="box-title">Biodata</h3>
                </div>
                <div class="box-body">
                    <table class="table table-bordered">
                        <tr>
                            <td>Nama</td>
                            <td>:</td>
                            <td>{{ $guru->user->nama }}</td>
                        </tr>
                        <tr>
                            <td>NIP</td>
                            <td>:</td>
                            <td>{{ $guru->user->nomor_identitas }}</td>
                        </tr>
                        <tr>
                            <td>Tempat, Tanggal Lahir</td>
                            <td>:</td>
                            <td>{{ $guru->tempat_lahir }}, {{ Carbon\Carbon::createFromFormat('Y-m-d', $guru->tanggal_lahir)
                                ->isoFormat('D MMMM Y'); }}</td>
                        </tr>
                        <tr>
                            <td>Jenis Kelamin</td>
                            <td>:</td>
                            <td>{{ $guru->jenis_kelamin }}</td>
                        </tr>
                        <tr>
                            <td>Agama</td>
                            <td>:</td>
                            <td>{{ $guru->agama }}</td>
                        </tr>
                        <tr>
                            <td>Alamat</td>
                            <td>:</td>
                            <td>{{ $guru->alamat }}</td>
                        </tr>
                        <tr>
                            <td>No HP</td>
                            <td>:</td>
                            <td>{{ $guru->no_tlp }}</td>
                        </tr>
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
@endpush