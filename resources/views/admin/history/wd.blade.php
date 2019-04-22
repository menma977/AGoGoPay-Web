@extends('layouts.admin.master') 
@section('afterHead')
<!-- DataTables -->
<link rel="stylesheet" href="{{ asset('adminLTE/plugins/datatables/dataTables.bootstrap4.css') }}">
@endsection
 
@section('contentHeader')
<div class="container-fluid">
    <div class="row mb-2">
        <div class="col-sm-6">
            <h1>History <small>Penarikan</small></h1>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Halaman Utama</a></li>
                <li class="breadcrumb-item">History</li>
                <li class="breadcrumb-item">Penarikan</li>
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
                <h3 class="card-title">Penarikan</h3>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.history.wd') }}">
                    <label>Find By Range:</label>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">
                                            <i class="fa fa-calendar"></i>
                                        </span>
                                    </div>
                                    <input type="text" class="form-control float-right" id="reservation" name="date" value="{{ old('date') ? old('date') : $date }}">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <button type="submit" class="btn btn-block btn-outline-success ">
                                <i class="fa fa-search"></i> Cari
                            </button>
                        </div>
                    </div>
                </form>
                <div class="table-responsive col-12">
                    <table id="example1" class="table table-bordered table-striped ">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Tanggal Penarikan</th>
                                <th>Tanggal Bayar</th>
                                <th>Username</th>
                                <th>Rekening</th>
                                <th>Dolar</th>
                                <th>Doge</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($user as $item)
                            <tr>
                                <td>{{ $loop->index + 1 }}</td>
                                <td>{{ $item->tglwd }}</td>
                                <td>{{ $item->tglbayar }}</td>
                                <td>{{ $item->username }}</td>
                                <td>{{ $item->data->wallet }}</td>
                                <td>{{ $item->nilaicoin }}</td>
                                <td>{{ $item->transfer }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <th>#</th>
                                <th>Tanggal Penarikan</th>
                                <th>Tanggal Bayar</th>
                                <th>Username</th>
                                <th>Rekening</th>
                                <th>Dolar</th>
                                <th>Doge</th>
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
    $(function () {
        $('#reservation').daterangepicker({
            format : 'YYYY/MM/DD'
        })
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