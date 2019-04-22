@extends('layouts.master') 
@section('afterHead')
<!-- Select2 -->
<link rel="stylesheet" href="{{ asset('adminLTE/plugins/select2/select2.min.css') }}">
@endsection
 
@section('contentHeader')
<div class="container-fluid">
    <div class="row mb-2">
        <div class="col-sm-6">
            <h1>Penarikan</h1>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Halaman Utama</a></li>
                <li class="breadcrumb-item">Penarikan</li>
            </ol>
        </div>
    </div>
</div>
@endsection
 
@section('content')
<div id="massage"></div>
<div class="row">
    <div class="col-md-12">
        <div class="card card-danger">
            <div class="card-header">
                <h3 class="card-title">Penarikan</h3>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <button id="sendCode" type="submit" class="btn btn-block btn-danger" onclick="sendCode()">Send Code</button>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group has-feedback">
                            <input id="code" type="text" class="form-control{{ $errors->has('code') ? ' is-invalid' : '' }}" name="code" value="{{ old('code') }}"
                                placeholder="code" required autofocus oninput="cekCode()">
                        </div>
                    </div>
                </div>
                <form method="POST" action="{{route('wallet.store')}}">
                    {{ csrf_field() }}
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group has-feedback">
                                <label>Penarikan Bonus</label>
                                <div class="input-group">
                                    <div class="input-group-append">
                                        <span class="input-group-text">Rp</span>
                                    </div>
                                    <input id="wdbone" type="number" class="form-control{{ $errors->has('wdbone') ? ' is-invalid' : '' }}" name="wdbone" value="{{ $wdBon ? 'Rp '.number_format($wdBon, 2, ',', '.') : 0 }}"
                                        placeholder="Penarikan Bonus" readonly>
                                </div>
                                @if ($errors->has('wdbone'))
                                <span class="text-danger">
                                <strong>{{ $errors->first('wdbone') }}</strong>
                            </span> @endif
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group has-feedback">
                                <label>Penarikan</label>
                                <div class="input-group">
                                    <div class="input-group-append">
                                        <span class="input-group-text">Rp</span>
                                    </div>
                                    <input id="withdraw" type="number" class="form-control{{ $errors->has('withdraw') ? ' is-invalid' : '' }}" name="withdraw"
                                        value="{{ old('withdraw') }}" placeholder="Penarikan" required disabled oninput="cekValue()">
                                </div>
                                <span class="text-danger"><strong id="error"></strong></span> @if ($errors->has('withdraw'))
                                <span class="text-danger">
                                <strong>{{ $errors->first('withdraw') }}</strong>
                                </span> @endif
                            </div>
                        </div>
                        <button id="submit" type="submit" class="btn btn-block btn-danger" disabled>Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
 
@section('afterScript')
<!-- Select2 -->
<script src="{{ asset('adminLTE/plugins/select2/select2.full.min.js') }}"></script>
<script>
    $(function () {
        $('.select2').select2()
    })

    function cekValue() {
        var wdBone = parseFloat(document.getElementById('wdbone').value);
        var withdraw = parseFloat(document.getElementById('withdraw').value);
        if(withdraw < 10) {
            document.getElementById('error').innerHTML = "minimum withdrawal is 10";
            document.getElementById('submit').disabled = true;
        } else if(wdBone < withdraw) {
            document.getElementById('error').innerHTML = "sorry, your withdraw is less than withdraw bonus";
            document.getElementById('submit').disabled = true;
        } else if(withdraw == null || withdraw == '' || isNaN(withdraw)) {
            document.getElementById('error').innerHTML = "";
            document.getElementById('submit').disabled = true;
        } else {
            document.getElementById('error').innerHTML = "";
            document.getElementById('submit').disabled = false;
        }
    }

    function cekCode() {
        var code = "{{ $code }}";
        if(code == document.getElementById('code').value) {
            document.getElementById('withdraw').disabled = false;
        } else {
            document.getElementById('withdraw').disabled = true;
        }
    }

    function sendCode() {
        document.getElementById('sendCode').disabled = true;
        var setUrl = "{{ url('wd/send/email/#code') }}";
        $.ajax({
            type: 'get',
            url: setUrl.replace('#code', '{{ $code }}'),
            success: function (data) {
                document.getElementById('massage').innerHTML = '<div class="alert alert-success alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><h5><i class="icon fa fa-check"></i> Alert!</h5>please check your email to get the code</div>';
                var time = 20;
                var runerTime = setInterval(() => {
                    if(time == 0) {
                        document.getElementById('sendCode').innerHTML = 'Sand Code';
                        document.getElementById('sendCode').disabled = false;
                        document.getElementById('massage').innerHTML = '';
                        clearInterval(runerTime);
                    } else {
                        document.getElementById('sendCode').innerHTML = 'Sand Code ' + time;
                        time--;
                    }
                }, 1000);
            }, error: function () {
                document.getElementById('massage').innerHTML = '<div class="alert alert-danger alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><h5><i class="icon fa fa-ban"></i> Alert!</h5>there is a problematic process, please repeat again</div>';
                document.getElementById('sendCode').disabled = false;
            }
        })
    };

</script>
@endsection