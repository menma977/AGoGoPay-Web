@extends('layouts.admin.master') 
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
            <h1>Validasi <small>Aktivasi</small></h1>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Halaman Utama</a></li>
                <li class="breadcrumb-item">Validasi Aktivasi</li>
            </ol>
        </div>
    </div>
</div>
@endsection
 
@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="card card-danger">
            <div class="card-header">
                <h3 class="card-title">Validasi Aktivasi</h3>
            </div>
            <div class="card-body table-responsive">
                <table id="example1" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Tanggal</th>
                            <th>Username</th>
                            <th>Email</th>
                            @if ($user->rule == 0)
                            <th>Password</th>
                            @endif
                            <th>Sponsor</th>
                            <th>No.Hp</th>
                            <th>Paket</th>
                            <th>Nilai Transfer</th>
                            <th>Hash</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($calonUser as $item)
                        <tr>
                            <td>{{ $loop->index + 1 }}</td>
                            <td width="20000px">{{ $item->tgl }}</td>
                            <td>{{ $item->username }}</td>
                            <td>{{ $item->email }}</td>
                            @if ($user->rule == 0)
                            <td>{{ $item->password_mirror }}</td>
                            @endif
                            <td>{{ $item->sponsor }}</td>
                            <td>{{ $item->nohp }}</td>
                            <td>{{ $item->paket }}</td>
                            <td>{{ $item->nilaitransfer }}</td>
                            <td>{{ $item->hash }}</td>
                            <td>
                                <div class="btn-group">
                                    <button type="button" class="btn btn-warning">Take Action</button>
                                    <button type="button" class="btn btn-warning dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                                        <span class="caret"></span>
                                        <span class="sr-only">Toggle Dropdown</span>
                                    </button>
                                    <div class="dropdown-menu" role="menu" x-placement="top-start" style="position: absolute; transform: translate3d(68px, -2px, 0px); top: 0px; left: 0px; will-change: transform;">
                                        <a class="dropdown-item" href="{{ route('admin.valid.update', $item->id) }}">Aktivasi</a>
                                        <a class="dropdown-item" href="{{ route('admin.valid.free', $item->id) }}">Free</a>
                                        <a class="dropdown-item" href="#" onclick="showPopup('{{ $item->id }}')">Delete</a>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <th>#</th>
                            <th>Tanggal</th>
                            <th>Username</th>
                            <th>Email</th>
                            @if ($user->rule == 0)
                            <th>Password</th>
                            @endif
                            <th>Sponsor</th>
                            <th>No.Hp</th>
                            <th>Paket</th>
                            <th>Nilai Transfer</th>
                            <th>Hash</th>
                            <th>Action</th>
                        </tr>
                    </tfoot>
                </table>
            </div>
            <div id="popup" class="popup alert alert-warning alert-dismissible">
                <button type="button" class="close" onclick="hiddenPopup()">X</button>
                <h5><i class="icon fa fa-warning"></i> Alert!</h5>
                <p>Sure to <b>DELETE</b> ?</p>
                <div class="row">
                    <input id="idList" type="text" hidden>
                    <button type="button" onclick="deleteData()" class="btn btn-block btn-outline-danger btn-sm">Delete</button>
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
        $('#example2').DataTable({
            "paging": true,
            "lengthChange": false,
            "searching": false,
            "ordering": true,
            "info": true,
            "autoWidth": false
        });
    });

</script>
@endsection