@extends('layouts.admin.admin')

@push('styles')
<link rel="stylesheet" href="{{ asset('adminlte/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css') }}">
<link rel="stylesheet" href="{{ asset('adminlte/bower_components/select2/dist/css/select2.min.css') }}">
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
                    <h3 class="box-title">Data Tagihan Siswa</h3>
                    <div class="pull-right">
                        <button type="button" class="btn-sm btn-primary" data-toggle="modal" data-target="#default">Tambah Tagihan</button>
                    </div>
                </div>
                
                <div class="box-body">
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>NIS</th>
                                <th>Nama</th>
                                <th>Total</th>
                                <th>Pilihan</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach( $tagihan2 as $tagihan )
                            <tr>
                                <td>{{ $loop->iteration }}.</td>
                                <td>{{ $tagihan->siswa->user->nomor_identitas }}</td>
                                <td>{{ $tagihan->siswa->user->nama }}</td>
                                <td>Rp{{ number_format($tagihan->total, 0, '.', '.') }}</td>
                                <td>
                                    <form action="{{ route('admin.tagihan.destroy', $tagihan->id) }}" method="post">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-xs btn-danger" onclick="return confirm('Hapus tagihan?')">Hapus</button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="default">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Tambah Tagihan Siswa</h4>
                </div>
                <form action="{{ route('admin.tagihan.simpan') }}" method="POST" role="form">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <label>Siswa</label>
                            <select class="form-control select2" name="id_siswa" style="width: 100%;">
                                @foreach( $siswa2 as $siswa ) 
                                <option value="{{ $siswa->id }}">{{ $siswa->user->nama }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group @error('total') has-error @enderror">
                            <label for="total">Total Tagihan</label>
                            <input type="number" class="form-control" name="total" id="total" placeholder="masukkan total">
                            @error('total') <span class="help-block">{{ $message }}</span> @enderror
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
<script src="{{ asset('adminlte/bower_components/select2/dist/js/select2.full.min.js') }}"></script>
<script>
    $(function() {
        $('.select2').select2()
    })
</script>
<script>
    $(function () {
        $('#example1').DataTable()
    })
</script>
@endpush