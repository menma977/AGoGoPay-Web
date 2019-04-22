@extends('layouts.admin.master') 
@section('afterHead')
<!-- DataTables -->
<link rel="stylesheet" href="{{ asset('adminLTE/plugins/datatables/dataTables.bootstrap4.css') }}">
@endsection
 
@section('contentHeader')
<div class="container-fluid">
    <div class="row mb-2">
        <div class="col-sm-6">
            <h1>Withdrawal <small>BONUS</small></h1>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Halaman Utama</a></li>
                <li class="breadcrumb-item">BONUS</li>
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
                <h3 class="card-title">BONUS</h3>
            </div>
            <div class="card-body">
                <div class="table-responsive col-12">
                    <table id="example1" class="table table-bordered table-striped ">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Tgl</th>
                                <th>Username</th>
                                <th>Rekening</th>
                                <th>Ketkom</th>
                                <th>Nilai Coin</th>
                                <th>Transfer</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($wdbon as $item)
                            <tr>
                                <td>{{ $loop->index + 1 }}</td>
                                <td>{{ $item->tgl }}</td>
                                <td>{{ $item->user->username }}</td>
                                <td>{{ $item->user->wallet }}</td>
                                <td>{{ $item->ketkom }}</td>
                                <td>{{ $item->nilaicoin }}</td>
                                <td>{{ $item->transfer }}</td>
                                <td>
                                    <a href="{{ route('admin.wd.update.bonus', $item->id) }}">
                                        <button type="button" class="btn btn-block btn-success">Bayar</button>
                                    </a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <th>#</th>
                                <th>Tgl</th>
                                <th>Username</th>
                                <th>Rekening</th>
                                <th>Ketkom</th>
                                <th>Nilai Coin</th>
                                <th>Transfer</th>
                                <th>Action</th>
                            </tr>
                        </tfoot>
                    </table>
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