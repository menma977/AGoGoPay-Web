@extends('layouts.master') 
@section('afterHead')
<!-- Select2 -->
<link rel="stylesheet" href="{{ asset('adminLTE/plugins/select2/select2.min.css') }}">
@endsection
 
@section('contentHeader')
<div class="container-fluid">
    <div class="row mb-2">
        <div class="col-sm-6">
            <h1>ReInvest</h1>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{ route('home') }}">Halaman Utama</a></li>
                <li class="breadcrumb-item">ReInvest</li>
            </ol>
        </div>
    </div>
</div>
@endsection
 
@section('content')
<div class="row">
    <div class="col-md-12">
        <form method="POST" action="{{ route('reinvest.store') }}">
            {{ csrf_field() }}
            <div class="card card-danger">
                <div class="card-header">
                    <h3 class="card-title">ReInvest</h3>
                </div>
                <div class="card-body">
                    <div class="form-group has-feedback">
                        <span class="fa fa-archive form-control-feedback"></span>
                        <label>Package</label>
                        <select class="form-control" id="package" name="package">
                        @foreach ($profit as $item)
                            <option value="{{ $item->joins }}">{{ $item->id == 1 ? 'SILVER' : 'GOLD' }} (Rp {{ number_format($item->joins, 2, ',', '.') }})</option>
                        @endforeach
                    </select> @if ($errors->has('package'))
                        <span class="text-danger">
                            <strong>{{ $errors->first('package') }}</strong>
                        </span> @endif
                    </div>
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-block btn-danger">ReInvest</button>
                </div>
            </div>
        </form>
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

</script>
@endsection