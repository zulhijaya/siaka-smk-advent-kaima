@extends('layouts.admin.admin')

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
                    <h3 class="box-title">Tagihan</h3>
                </div>

                @php
                    $siswa = auth()->user()->siswa->load('tagihan');
                @endphp
                <div class="box-body">
                    <div class="row">
                        <div class="col-md-6">
                            <table id="example1" class="table table-bordered table-striped">
                                <tbody>
                                    <tr>
                                        <th>Total Tagihan</th>
                                        <td>@if( $siswa->tagihan ) Rp{{ number_format($siswa->tagihan->total, 0, '.', '.') }} @else 0 @endif</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@push('scripts')
<script src="{{ asset('adminlte/bower_components/jquery-slimscroll/jquery.slimscroll.min.js') }}"></script>
@endpush
