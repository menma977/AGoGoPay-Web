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
            <h1>Keseluruhan</h1>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Halaman Utama</a></li>
                <li class="breadcrumb-item">Keseluruhan</li>
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
                <h3 class="card-title">Keseluruhan</h3>
            </div>
            <div class="card-body">
                <table style="margin: 0 auto;">
                    <tr>
                        <td>
                            <h3 class="card-title">Total Bonus</h3>
                        </td>
                        <td>
                            <h3 class="card-title">:</h3>
                        </td>
                        <td>
                            <h3 class="card-title">{{ $ledger->sum('kredit') }}</h3>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <h3 class="card-title">Bonus tersisa</h3>
                        </td>
                        <td>
                            <h3 class="card-title">:</h3>
                        </td>
                        <td>
                            <h3 class="card-title">{{ number_format($ledger->sum('kredit') - $ledger->sum('debet') ,'2','.','') }}</h3>
                        </td>
                    </tr>
                </table>
                <div class="table-responsive">
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th style="width: 15%;">Tanggal</th>
                                <th style="width: 50%;">Keterangan</th>
                                <th style="width: 20%;">Debet</th>
                                <th style="width: 20%;">Credit</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($ledger as $item)
                            <tr>
                                <td>{{ $loop->index + 1 }}</td>
                                <td>{{ $item->tgl }}</td>
                                <td>{{ $item->keterangan }}</td>
                                <td>{{ $item->debet }}</td>
                                <td>{{ $item->kredit }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <th>#</th>
                                <th>Tanggal</th>
                                <th>Keterangan</th>
                                <th>Debet</th>
                                <th>Credit</th>
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