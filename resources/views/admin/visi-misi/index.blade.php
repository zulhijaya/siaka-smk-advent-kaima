@extends('layouts.admin.admin', ['title' => $title])

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
                    <h3 class="box-title">Visi & Misi Sekolah</h3>
                    <div class="pull-right">
                        <a href="{{ route('admin.visi-misi.edit') }}">
                            <button type="button" class="btn-sm btn-warning">Edit Data</button>
                        </a>
                        {{-- <a href="{{ route('admin.visi-misi.tambah-misi') }}">
                            <button type="button" class="btn-sm btn-primary">Tambah Misi</button>
                        </a> --}}
                    </div>
                </div>
                

                <div class="box-body">
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Visi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>{{ $visi }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="box-body">
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Misi</th>
                                <th>Pilihan</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach( $misi2 as $misi )
                            <tr>
                                <td>{{ $misi->deskripsi }}</td>
                                <td>
                                    <div class="btn-toolbar">
                                        <form action="{{ route('admin.visi-misi.destroy-misi', $misi->id) }}" method="post">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-xs btn-danger" onclick="return confirm('Hapus misi sekolah?')">Hapus</button>
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
<script src="{{ asset('adminlte/bower_components/jquery-slimscroll/jquery.slimscroll.min.js') }}"></script>
@endpush