@extends('layouts.admin.master') 
@section('afterHead')
<!-- Select2 -->
<link rel="stylesheet" href="{{ asset('adminLTE/plugins/select2/select2.min.css') }}">
@endsection
 
@section('contentHeader')
<div class="container-fluid">
    <div class="row mb-2">
        <div class="col-sm-6">
            <h1>Debet <small>Bonus</small></h1>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Halaman Utama</a></li>
                <li class="breadcrumb-item">Bonus</li>
            </ol>
        </div>
    </div>
</div>
@endsection
 
@section('content')
<form method="POST" action="{{ route('admin.wd.store') }}" class="row">
    {{ csrf_field() }}
    <div class="col-md-12">
        <div class="card card-danger">
            <div class="card-header">
                <h3 class="card-title">Bonus</h3>
            </div>
            <div class="card-body">
                <div class="form-group has-feedback">
                    <label>Tanggal</label>
                    <input id="tgl" type="text" class="form-control{{ $errors->has('tgl') ? ' is-invalid' : '' }}" name="tgl" value="{{ Carbon\Carbon::now() }}"
                        placeholder="tgl" required readonly> @if ($errors->has('tgl'))
                    <span class="text-danger">
                        <strong>{{ $errors->first('tgl') }}</strong>
                    </span> @endif
                </div>
                <div class="form-group has-feedback">
                    <label>Username</label>
                    <select class="form-control select2" style="width: 100%;" id="username" name="username" required>
                        @foreach ($user as $item)
                            <option value="{{ $item->username }}">{{ $item->username }}</option>
                        @endforeach
                    </select> @if ($errors->has('username'))
                    <span class="text-danger">
                        <strong>{{ $errors->first('username') }}</strong>
                    </span> @endif
                </div>
                <div class="form-group has-feedback">
                    <label>Keterangan</label>
                    <input id="keterangan" type="text" class="form-control{{ $errors->has('keterangan') ? ' is-invalid' : '' }}" name="keterangan"
                        value="{{ old('keterangan') }}" placeholder="Keterangan" required autofocus> @if($errors->has('keterangan'))
                    <span class="text-danger">
                        <strong>{{ $errors->first('keterangan') }}</strong>
                    </span> @endif
                </div>
                <div class="form-group has-feedback">
                    <label>Nominal</label>
                    <div class="input-group">
                        <div class="input-group-append">
                            <span class="input-group-text">$</span>
                        </div>
                        <input id="nominal" type="number" class="form-control{{ $errors->has('nominal') ? ' is-invalid' : '' }}" name="nominal" value="{{ old('nominal') }}"
                            placeholder="Nominal" required>
                    </div>
                    @if ($errors->has('nominal'))
                    <span class="text-danger">
                        <strong>{{ $errors->first('nominal') }}</strong>
                    </span> @endif
                </div>
            </div>
            <div class="card-footer">
                <button type="submit" class="btn btn-block btn-danger">Simpan</button>
            </div>
        </div>
    </div>
</form>
@endsection
 
@section('afterScript')
<!-- Select2 -->
<script src="{{ asset('adminLTE/plugins/select2/select2.full.min.js') }}"></script>
<script>
    $(function () {
        //Initialize Select2 Elements
        $('.select2').select2()
    })

</script>
@endsection