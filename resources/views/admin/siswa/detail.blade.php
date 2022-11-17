@extends('layouts.admin.admin')

@section('content')
<section class="content">
    <div class="box">
        <div class="box-header">
            <h3 class="box-title">Detail Siswa</h3>
            @if( auth()->user()->role == 'Administrator' )
            <div class="pull-right">
                <a href="{{ route('admin.siswa.siswa-aktif') }}">
                    <button type="button" class="btn btn-block btn-primary">Kembali</button>
                </a>
            </div>
            @endif
        </div>
        <div class="row">
            <div class="col-md-3">
                <div class="box-body">
                    @if( $siswa->foto )
                    <div class="thumbnail">
                        <img src="{{ asset('storage/' . $siswa->foto) }}" alt="{{ $siswa->user->nama }}">
                    </div>
                    @endif
                    <div class="box-header with-border">
                        <h3 class="box-title text-uppercase">{{ $siswa->user->nama }}</h3>
                    </div>
                    @if( $siswa->aktif )
                    <table class="table table-bordered">
                        <tr>
                            <td>Status</td>
                            <td>:</td>
                            <td>@if( $siswa->aktif ) Aktif @endif</td>
                        </tr>
                        <tr>
                            <td>Kelas</td>
                            <td>:</td>
                            <td>{{ $siswa->jurusan->kelas->tingkat }}</td>
                        </tr>
                        <tr>
                            <td>Wali Kelas</td>
                            <td>:</td>
                            <td>{{ $siswa->jurusan->kelas->guru->user->nama }}</td>
                        </tr>
                    </table>
                    @endif
                </div>
            </div>
            <div class="col-md-9">
                <div>
                    <div class="box-header">
                        <h3 class="box-title">Biodata</h3>
                    </div>
                    <div class="box-body">
                        <table class="table table-bordered">
                            <tr>
                                <td>Nama</td>
                                <td>:</td>
                                <td>{{ $siswa->user->nama }}</td>
                            </tr>
                            <tr>
                                <td>NIS</td>
                                <td>:</td>
                                <td>{{ $siswa->user->nomor_identitas }}</td>
                            </tr>
                            <tr>
                                <td>Tempat, Tanggal Lahir</td>
                                <td>:</td>
                                <td>{{ $siswa->tempat_lahir }}, {{ Carbon\Carbon::createFromFormat('Y-m-d', $siswa->tanggal_lahir)
                                    ->isoFormat('D MMMM Y'); }}</td>
                            </tr>
                            <tr>
                                <td>Jenis Kelamin</td>
                                <td>:</td>
                                <td>{{ $siswa->jenis_kelamin }}</td>
                            </tr>
                            <tr>
                                <td>Agama</td>
                                <td>:</td>
                                <td>{{ $siswa->agama }}</td>
                            </tr>
                            <tr>
                                <td>Alamat</td>
                                <td>:</td>
                                <td>{{ $siswa->alamat }}</td>
                            </tr>
                            <tr>
                                <td>No HP</td>
                                <td>:</td>
                                <td>{{ $siswa->no_hp }}</td>
                            </tr>
                            <tr>
                                <td>Nama Ayah</td>
                                <td>:</td>
                                <td>{{ $siswa->nama_ayah }}</td>
                            </tr>
                            <tr>
                                <td>Nama Ibu</td>
                                <td>:</td>
                                <td>{{ $siswa->nama_ibu }}</td>
                            </tr>
                            <tr>
                                <td>Pekerjaan Ayah</td>
                                <td>:</td>
                                <td>{{ $siswa->pekerjaan_ayah }}</td>
                            </tr>
                            <tr>
                                <td>Pekerjaan Ibu</td>
                                <td>:</td>
                                <td>{{ $siswa->pekerjaan_ibu }}</td>
                            </tr>
                            <tr>
                        </table>
                    </div>
                </div>
                @if( auth()->user()->role == 'Administrator' )
                <div>
                    <div class="box-header">
                        <h3 class="box-title">Berkas</h3>
                    </div>
                    <div class="box-body">
                        <div class="btn-toolbar">
                            <a href="{{ asset('storage/' . $siswa->berkas->ijazah) }}" target="_blank">
                                <button type="button" class="btn btn-sm btn-default" style="margin-right: 0.55rem">FC Ijazah</button>
                            </a>
                            <a href="{{ asset('storage/' . $siswa->berkas->kk) }}" target="_blank">
                                <button type="button" class="btn btn-sm btn-default" style="margin-right: 0.55rem">FC FC Kartu Keluarga</button>
                            </a>
                            <a href="{{ asset('storage/' . $siswa->berkas->ktp_ortu) }}" target="_blank">
                                <button type="button" class="btn btn-sm btn-default" style="margin-right: 0.55rem">FC KTP Orang Tua</button>
                            </a>
                            @if( $siswa->berkas->kip )
                            <a href="{{ asset('storage/' . $siswa->berkas->kip) }}" target="_blank">
                                <button type="button" class="btn btn-sm btn-default" style="margin-right: 0.55rem">FC Kartu Indonesia Pintar</button>
                            </a>
                            @endif
                        </div>
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>
</section>
@endsection

@push('scripts')
<script src="{{ asset('adminlte/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js') }}"></script>
<script src="{{ asset('adminlte/bower_components/jquery-slimscroll/jquery.slimscroll.min.js') }}"></script>
@endpush