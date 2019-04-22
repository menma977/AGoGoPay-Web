@extends('layouts.admin.master') 
@section('afterHead')
<!-- DataTables -->
<link rel="stylesheet" href="{{ asset('adminLTE/plugins/datatables/dataTables.bootstrap4.css') }}">
<!-- Select2 -->
<link rel="stylesheet" href="{{ asset('adminLTE/plugins/select2/select2.min.css') }}">
@endsection
 
@section('contentHeader')
<div class="container-fluid">
    <div class="row mb-2">
        <div class="col-sm-6">
            <h1>Pin</h1>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Halaman Utama</a></li>
                <li class="breadcrumb-item">Pin</li>
            </ol>
        </div>
    </div>
</div>
<style>
    .select2-selection__rendered {
        line-height: 31px !important;
    }

    .select2-container .select2-selection--single {
        height: 40px !important;
    }

    .select2-selection__arrow {
        height: 40px !important;
    }
</style>
@endsection
 
@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header d-flex p-0">
                <h3 class="card-title p-3">Menu</h3>
                <ul class="nav nav-pills ml-auto p-2">
                    <li class="nav-item"><a class="nav-link active" href="#tab_1" data-toggle="tab">ReOrder Pin</a></li>
                    <li class="nav-item"><a class="nav-link" href="#tab_2" data-toggle="tab">Daftar Pin Aktif</a></li>
                    <li class="nav-item"><a class="nav-link" href="#tab_3" data-toggle="tab">Kirim Pin Manual</a></li>
                </ul>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <div class="tab-content">
                    <div class="tab-pane active" id="tab_1">
                        <div class="table-responsive">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Tanggal</th>
                                        <th>Username</th>
                                        <th>Jumlah Pin</th>
                                        <th>Jumlah bayar</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($reOrderPin as $item)
                                    <tr>
                                        <td>{{ $loop->index + 1 }}</td>
                                        <td>{{ $item->tglreal }}</td>
                                        <td>{{ $item->username }}</td>
                                        <td>{{ $item->paket }}</td>
                                        <td>Rp {{ number_format($item->jmlbayar, 2, ',', '.') }}</td>
                                        <td>
                                            @if ($item->status == 0)
                                            <div>
                                                <a href="{{ route('admin.pin.activate', [$item->id, 1]) }}" class="btn btn-block btn-success btn-md">Validasi</a>
                                            </div>
                                            @else
                                            <div>
                                                <a href="#" data-toggle="modal" data-target="#modal-default0" class="btn btn-block btn-warning btn-md">Hapus Reorder</a>
                                                <div class="modal fade" id="modal-default0">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h4 class="modal-title">Hapus Reorder</h4>
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <p>Lanjutkan Untuk Menghapus {{ $item->username }}</p>
                                                                <p>
                                                                    <a href="{{ route('admin.pin.deleteReOrder', $item->id) }}" class="btn btn-block btn-warning btn-md">Lajutkan</a>
                                                                </p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            @endif
                                        </td>

                                    </tr>
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>#</th>
                                        <th>Tanggal</th>
                                        <th>Username</th>
                                        <th>Jumlah Pin</th>
                                        <th>Jumlah bayar</th>
                                        <th>Aksi</th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                    <div class="tab-pane" id="tab_2">
                        <div class="table-responsive">
                            <table id="example2" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>tanggal Pakai</th>
                                        <th>pin</th>
                                        <th>Pemilik</th>
                                        <th>Pengguna</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($activePin as $item)
                                    <tr>
                                        <td>{{ $loop->index + 1 }}</td>
                                        <td>{{ $item->tglpakai }}</td>
                                        <td>{{ $item->pin }}</td>
                                        <td>{{ $item->stokis }}</td>
                                        <td>{{ $item->username ? $item->username : 'Belum Ada Pengguna' }}</td>
                                        <td>{{ $item->status == 1 ? 'Belum di gunakan' : 'Sudah di gunakan' }}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>#</th>
                                        <th>tanggal Pakai</th>
                                        <th>pin</th>
                                        <th>Pemilik</th>
                                        <th>Pengguna</th>
                                        <th>Status</th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                    <div class="tab-pane" id="tab_3">
                        <form action="{{ route('admin.pin.changeOwnerPin') }}" method="POST">
                            {{ csrf_field() }}
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Jumlah Pin</label>
                                        <input type="number" class="form-control" id="pin" name="pin" value='1' 
                                            placeholder="Jumlah Pin" onchange="checkPin()">
                                        <span class="text-danger"><strong id='errorPin'></strong></span>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Username</label>
                                        <select class="form-control select2" style="width: 100%;" id="username" name="username">
                                            @foreach ($user as $item)
                                            <option value="{{ $item->id }}">{{ $item->username }}</option>
                                            @endforeach
                                        </select> @if ($errors->has('username'))
                                        <span class="text-danger">
                                            <strong>{{ $errors->first('username') }}</strong>
                                        </span> @endif
                                    </div>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-block btn-success btn-md">Simpan</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
 
@section('afterScript')
<!-- DataTables -->
<script src="{{ asset('adminLTE/plugins/datatables/jquery.dataTables.js') }}"></script>
<script src="{{ asset('adminLTE/plugins/datatables/dataTables.bootstrap4.js') }}"></script>
<!-- Select2 -->
<script src="{{ asset('adminLTE/plugins/select2/select2.full.min.js') }}"></script>
<!-- InputMask -->
<script src="{{ asset('adminLTE/plugins/input-mask/jquery.inputmask.js') }}"></script>
<script src="{{ asset('adminLTE/plugins/input-mask/jquery.inputmask.date.extensions.js') }}"></script>
<script src="{{ asset('adminLTE/plugins/input-mask/jquery.inputmask.extensions.js') }}"></script>
<script>
    function showPopup(value) {
        document.getElementById("idList").value = value;
        var windowPopup = document.getElementById("popup");
        windowPopup.style.display = "block";
    }

    function hiddenPopup() {
        var windowPopup = document.getElementById("popup");
        windowPopup.style.display = "none";
    }

    function deleteData() {
        var getIdList = document.getElementById("idList").value;
        window.open("admin/valid/destroy/" + getIdList, "_self")
    }

    function checkPin() {
        let pin = document.getElementById('pin').value;
        console.log(pin);
        if(pin) {
            document.getElementById('errorPin').innerHTML = '';
        } else {
            document.getElementById('errorPin').innerHTML = 'Pin Tidak Boleh Kosong';
        }
    }

    $(function () {
        $("#example1").DataTable();
        $("#example2").DataTable();
        $('.select2').select2();
    });

    $('[data-mask]').inputmask()

</script>
@endsection