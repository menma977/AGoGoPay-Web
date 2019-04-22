@extends('layouts.admin.master') 
@section('afterHead')
<!-- Select2 -->
<link rel="stylesheet" href="{{ asset('adminLTE/plugins/select2/select2.min.css') }}">
@endsection
 
@section('contentHeader')
<div class="container-fluid">
    <div class="row mb-2">
        <div class="col-sm-6">
            <h1>Redeem <small>Bonus</small></h1>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Halaman Utama</a></li>
                <li class="breadcrumb-item">Redeem Bonus</li>
            </ol>
        </div>
    </div>
</div>
@endsection
 
@section('content')
<div class="row">
    <div class="col-md-12">
        <form method="POST" action="{{ route('admin.redeem.store') }}">
            {{ csrf_field() }}
            <div class="card card-danger">
                <div class="card-header">
                    <h3 class="card-title">Redeem Bonus</h3>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Username</label>
                                <select class="form-control select2" style="width: 100%;" name="username" id="username" onchange="onUsernameChange()">
                                    @foreach ($user as $item)    
                                    <option value="{{$item->username}}" >{{$item->username}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group has-feedback">
                                <label>Nominal Penarikan</label>
                                <input id="nominal" type="text" class="form-control{{ $errors->has('nominal') ? ' is-invalid' : '' }}" name="nominal" value="{{ old('nominal') }}"
                                    placeholder="Nominal"> @if ($errors->has('nominal'))
                                <span class="text-danger">
                                    <strong>{{ $errors->first('nominal') }}</strong>
                                </span> @endif
                            </div>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th style="width: 50%;">Tanggal</th>
                                    <th style="width: 50%;">Keterangan</th>
                                    <th style="width: 5%;">Debet</th>
                                    <th style="width: 5%;">Credit</th>
                                    <th style="width: 5%;">Edit</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-block btn-danger">Simpan</button>
                </div>
            </div>
        </form>
    </div>
</div>
<div class="modal fade" id="modal-default1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Edit Redeem</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <form method="POST" action="{{ route('admin.redeem.updateRedeem') }}">
                {{ csrf_field() }}
                <div class="modal-body">
                    <div class="form-group has-feedback">
                        <label>Nominal Penarikan</label>
                        <input id="id" name="id" hidden />
                        <input id="editNominal" type="text" class="form-control{{ $errors->has('editNominal') ? ' is-invalid' : '' }}" name="editNominal"
                            placeholder="editNominal"> @if ($errors->has('editNominal'))
                        <span class="text-danger">
                        <strong>{{ $errors->first('editNominal') }}</strong>
                    </span> @endif
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-block btn-danger">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
 
@section('afterScript')
<!-- Select2 -->
<script src="{{ asset('adminLTE/plugins/select2/select2.full.min.js') }}"></script>
<script>
    $(function () {
        //Initialize Select2 Elements
        $('.select2').select2();
        $('#example1').dataTable().fnDestroy();
        var setUrl = "{{ url('adminDump/redeem/find/#username') }}";
        var username = document.getElementById('username').value;
        let ResponData = [];
        $.ajax({
            type: 'get',
            url: setUrl.replace('#username', username),
            success: function (data) {
                $('#example1').dataTable().fnDestroy();
                ResponData = data;
                $('#example1').DataTable({ data: ResponData });
            }, error: function (e) {
                $('#example1').dataTable().fnDestroy();
                ResponData = [];
                $('#example1').DataTable({ data: ResponData });
            }
        })
    })

    function onUsernameChange() {
        $('#example1').dataTable().fnDestroy();
        var setUrl = "{{ url('adminDump/redeem/find/#username') }}";
        var username = document.getElementById('username').value;
        let ResponData = [];
        $.ajax({
            type: 'get',
            url: setUrl.replace('#username', username),
            success: function (data) {
                $('#example1').dataTable().fnDestroy();
                ResponData = data;
                $('#example1').DataTable({ data: ResponData });
            }, error: function (e) {
                $('#example1').dataTable().fnDestroy();
                ResponData = [];
                $('#example1').DataTable({ data: ResponData });
            }
        })
    }

    function editRedeem(value) {
        var setUrl = "{{ url('adminDump/redeem/edit/#value') }}";
        $.ajax({
            type: 'get',
            url: setUrl.replace('#value', value),
            success: function (data) {
                document.getElementById('id').value = value;
                document.getElementById('editNominal').value = data.ledgerRed.debet;
            }, error: function (e) {
                location.reload();
            }
        })
    }

</script>
@endsection