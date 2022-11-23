@extends('layouts.admin.admin')

@push('styles')
<link rel="stylesheet" href="{{ asset('adminlte/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css') }}">
<style>
    .nilai-huruf::first-letter {
        text-transform: capitalize;
    }
</style>
@endpush

@section('content')
<section class="content">
    <div class="box">
        <div class="box-header">
            <h3 class="box-title">Rapor Siswa</h3>
        </div>
        <div class="row">
            @if( $siswa->foto )
            <div class="col-md-2">
                <div class="box-body">
                    <div class="thumbnail">
                        {{-- <img src="{{ asset('storage/foto/siswa/zul.JPG') }}" alt="{{ $siswa->user->nama }}"> --}}
                        <img src="{{ asset('storage/' . $siswa->foto) }}" alt="{{ $siswa->user->nama }}">
                    </div>
                </div>
            </div>
            @endif
            <div class="col-md-5">
                <div class="box-body">
                    <table class="table table-bordered">
                        <tr>
                            <td>NIS</td>
                            <td>:</td>
                            <td>{{ $siswa->user->nomor_identitas }}</td>
                        </tr>
                        <tr>
                            <td>Nama</td>
                            <td>:</td>
                            <td>{{ $siswa->user->nama }}</td>
                        </tr>
                        <tr>
                            <td>Kelas</td>
                            <td>:</td>
                            <td>{{ $siswa->jurusan->kelas->tingkat }}</td>
                        </tr>
                        <tr>
                            <td>Program Keahlian</td>
                            <td>:</td>
                            <td>{{ $siswa->jurusan->nama }}</td>
                        </tr>
                    </table>
                </div>
            </div>
            <div class="col-md-5">
                <div class="box-body">
                    <table class="table table-bordered">
                        <tr>
                            <td>Tahun Ajaran</td>
                            <td>:</td>
                            <td>{{ $tahun_ajaran->tahun }}</td>
                        </tr>
                        <tr>
                            <td>Semester</td>
                            <td>:</td>
                            <td>{{ $tahun_ajaran->semester }}</td>
                        </tr>
                        <tr>
                            <td>Wali Kelas</td>
                            <td>:</td>
                            <td>{{ $siswa->jurusan->kelas->guru->user->nama }}</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-8">
                <div class="box-header">
                    <h3 class="box-title">Nilai Mapel</h3>
                </div>
                <div class="box-body">
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th colspan="2" style="text-align: center">Nilai Hasil Belajar</th>
                                <th></th>
                            </tr>
                            <tr>
                                <th>No</th>
                                <th>Mapel</th>
                                <th style="text-align: center">KKM</th>
                                <th style="text-align: center">Angka</th>
                                <th style="text-align: center">Huruf</th>
                                <th style="text-align: center">Keterangan</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                function terbilang($nilai) {
                                    if( $nilai<0 ) {
                                        $hasil = "minus ". trim(penyebut($nilai));
                                    } else {
                                        $hasil = trim(penyebut($nilai));
                                    }
                                    return $hasil;
                                }

                                function penyebut($nilai) {
                                    $nilai = abs($nilai);
                                    $huruf = array("", "satu", "dua", "tiga", "empat", "lima", "enam", "tujuh", "delapan", "sembilan", "sepuluh", "sebelas");
                                    $temp = "";
                                    if ($nilai < 12) {
                                        $temp = " ". $huruf[$nilai];
                                    } else if ($nilai <20) {
                                        $temp = penyebut($nilai - 10). " belas";
                                    } else if ($nilai < 100) {
                                        $temp = penyebut($nilai/10)." puluh". penyebut($nilai % 10);
                                    } else if ($nilai < 200) {
                                        $temp = " Seratus" . penyebut($nilai - 100);
                                    }

                                    return $temp;
                                }
                            @endphp
                            @foreach( $siswa->nilai2 as $nilai )
                            <tr>
                                <td>{{ $loop->iteration }}.</td>
                                <td>{{ $nilai->mapel->nama }}</td>
                                <td style="text-align: center">{{ $nilai->mapel->kkm }}</td>
                                <td style="text-align: center">{{ $nilai->nilai }}</td>
                                <td class="nilai-huruf">{{ terbilang($nilai->nilai) }}</td>
                                <td style="text-align: center">@if( $nilai->nilai > $nilai->mapel->kkm ) TUNTAS @else TIDAK TUNTAS @endif</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="col-md-4">
                <div class="box-header">
                    <h3 class="box-title">Absensi</h3>
                </div>
                <div class="box-body">
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th style="text-align: center" colspan="3">Ketidakhadiran</th>
                            </tr>
                            <tr>
                                <th>Sakit</th>
                                <th>Izin</th>
                                <th>Tanpa keterangan</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $absensi2 = $siswa->load('absensi2')->absensi2;
                            @endphp
                            <tr>
                                <td>@if( $absensi2->where('status', 'Sakit')->count() ) {{ $absensi['Sakit']->count() }} hari @else - @endif</td>
                                <td>@if( $absensi2->where('status', 'Izin')->count() ) {{ $absensi['Izin']->count() }} hari @else - @endif</td>
                                <td>@if( $absensi2->where('status', 'Alpa')->count() ) {{ $absensi['Alpa']->count() }} hari @else - @endif</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

{{-- <tbody>
    @php
        $absensi2 = $siswa->load('absensi2')->absensi2;
    @endphp
    <tr>
        <td rowspan="3">Ketidakhadiran</td>
        <td>Sakit</td>
        <td>@if( $absensi2->where('status', 'Sakit')->count() ) {{ $absensi['Sakit']->count() }} @endif</td>
    </tr>
    <tr>
        <td>Izin</td>
        <td>@if( $absensi2->where('status', 'Izin')->count() ) {{ $absensi['Izin']->count() }} @endif</td>
    </tr>
    <tr>
        <td>Tanpa Keterangan</td>
        <td>@if( $absensi2->where('status', 'Alpa')->count() ) {{ $absensi['Alpa']->count() }} @endif</td>
    </tr>
</tbody> --}}

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
