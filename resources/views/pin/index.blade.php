@extends('layouts.master') 
@section('afterHead')
<!-- DataTables -->
<link rel="stylesheet" href="{{ asset('adminLTE/plugins/datatables/dataTables.bootstrap4.css') }}">
<style>
    .popup {
        display: none;
        /* Hidden by default */
        position: fixed;
        /* Stay in place */
        z-index: 5;
        /* Sit on top */
        overflow: auto;
        /* Enable scroll if needed */
        left: 40%;
        top: 45%;
    }
</style>
@endsection
 
@section('contentHeader')
<div class="container-fluid">
    <div class="row mb-2">
        <div class="col-sm-6">
            <h1>Pin</h1>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{ route('home') }}">Halaman Utama</a></li>
                <li class="breadcrumb-item">Pin</li>
            </ol>
        </div>
    </div>
</div>
@endsection
 
@section('content')
@if (!count($reorderPin))
<hr>
<div>
    <button type="button" data-toggle="modal" data-target="#modal-default0" class="btn btn-block btn-primary btn-lg">Order Pin</button>
</div>
<hr>
@endif
<div class="row">
    <div class="col-12">
        <div class="card card-danger">
            <div class="card-header d-flex p-0">
            <h3 class="card-title p-3">Menu Pin</h3>
            <ul class="nav nav-pills ml-auto p-2">
                <li class="nav-item"><a class="nav-link active" href="#tab_1" data-toggle="tab">Transfer Pin</a></li>
                <li class="nav-item"><a class="nav-link" href="#tab_2" data-toggle="tab">Hispori Pin</a></li>
            </ul>
            </div>
            <div class="card-body">
                <div class="tab-content">
                    <div class="tab-pane active" id="tab_1">
                        <div class="table-responsive">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>pin</th>
                                        <th>Transfer</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($pinActive as $item)
                                    <tr>
                                        <td>{{ $loop->index + 1 }}</td>
                                        <td>{{ $item->pin }}</td>
                                        <td>
                                            <a href="{{ route('pin.edit', $item->id) }}" class="btn btn-block btn-primary btn-md">Menu Transfer</a>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>#</th>
                                        <th>pin</th>
                                        <th>Transfer</th>
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
                                        <th style="width: 25%;">Tanggal</th>
                                        <th style="width: 30%;">Pin</th>
                                        <th style="width: 20%;">Username</th>
                                        <th style="width: 30%;">Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($pin as $item)
                                    <tr class="{{ $item->status == 1 ? 'bg-info' : 'bg-success' }}">
                                        <td>{{ $loop->index + 1 }}</td>
                                        <td>{{ $item->tglpakai }}</td>
                                        <td>{{ $item->pin }}</td>
                                        <td>{{ $item->username ? $item->username : '' }}</td>
                                        @if ($item->status == 1)
                                        <td>
                                            Belum Terpakai
                                        </td>
                                        @else
                                        <td>
                                            Sudah Terpakai
                                        </td>
                                        @endif
                                    </tr>
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>#</th>
                                        <th style="width: 25%;">Tanggal</th>
                                        <th style="width: 30%;">Pin</th>
                                        <th style="width: 20%;">Username</th>
                                        <th style="width: 30%;">Status</th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@if (!count($reorderPin))
<div class="modal fade" id="modal-default0">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Oreder Pin</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="POST" action="{{ route('pin.validate', 1) }}">
                {{ csrf_field() }}
                <div class="modal-body">
                    <div class="form-group has-feedback">
                        <span class="fa fa-lock form-control-feedback"></span>
                        <label>Password</label>
                        <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password"
                            value="{{ old('password') }}" placeholder="Password" required>
                        <div>
                            @if ($errors->has('password'))
                            <div>
                                <span class="text-danger">
                                    <strong>{{ $errors->first('password') }}</strong>
                                </span>
                            </div>
                            @endif
                        </div>
                    </div>
                    <div class="form-group has-feedback">
                        <span class="fa fa-edit form-control-feedback"></span>
                        <label>Jumlah Pin</label>
                        <input id="valuePin" type="number" class="form-control{{ $errors->has('valuePin') ? ' is-invalid' : '' }}" name="valuePin"
                            value="{{ old('valuePin') }}" placeholder="Jumlah Pin" required>
                        <div>
                            @if ($errors->has('valuePin'))
                            <div>
                                <span class="text-danger">
                                    <strong>{{ $errors->first('valuePin') }}</strong>
                                </span>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="model-footer">
                    <button type="submit" class=" btn-block btn-primary btn-lg">Lajutkan</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endif
@endsection
 
@section('afterScript')
<!-- DataTables -->
<script src="{{ asset('adminLTE/plugins/datatables/jquery.dataTables.js') }}"></script>
<script src="{{ asset('adminLTE/plugins/datatables/dataTables.bootstrap4.js') }}"></script>
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

    $(function () {
        $("#example1").DataTable();
        $("#example2").DataTable();
    });

</script>
@endsection