@extends('layouts.master') 
@section('contentHeader')
<div class="container-fluid">
    <div class="row mb-2">
        <div class="col-sm-6">
            <h1>Genealogy <small>Create</small></h1>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{ route('home') }}">Halaman Utama</a></li>
                <li class="breadcrumb-item">
                    <a href="{{ route('network.genealogi.index', $upline) }}">
                        Genealogy
                    </a>
                </li>
                <li class="breadcrumb-item">Create</li>
            </ol>
        </div>
    </div>
</div>
@endsection
 
@section('content')
<form method="POST" action="{{ route('network.genealogi.store', $upline) }}" class="row">
    {{ csrf_field() }}
    <div class="col-md-12">
        <div class="card card-danger">
            <div class="card-header">
                <h3 class="card-title">Genealogy Create</h3>
            </div>
            <div class="card-body">
                <input type="text" name="position" id="position" value="{{ $position }}" hidden>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group has-feedback">
                            <span class="fa fa-user form-control-feedback"></span>
                            <label>Sponsor</label>
                            <input type="text" class="form-control{{ $errors->has('Refferal') ? ' is-invalid' : '' }}" value="{{ old('Refferal') ? old('Refferal') : Auth::user()->username }}"
                                placeholder="Sponsor" readonly> @if ($errors->has('Refferal'))
                            <span class="text-danger">
                                <strong>{{ $errors->first('Refferal') }}</strong>
                            </span> @endif
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group has-feedback">
                            <span class="fa fa-user-secret form-control-feedback"></span>
                            <label>Up Line</label>
                            <input id="sponsor" type="text" class="form-control{{ $errors->has('sponsor') ? ' is-invalid' : '' }}" name="sponsor" value="{{ old('sponsor') ? old('sponsor') : $user->username != null ? $user->username : '' }}"
                                placeholder="Up Line" readonly> @if ($errors->has('sponsor'))
                            <span class="text-danger">
                                <strong>{{ $errors->first('sponsor') }}</strong>
                            </span> @endif @if (Session::has('validateSponsor'))
                            <span class="text-danger">
                                <strong>Sponsors do not match our data</strong>
                            </span> @endif
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group has-feedback">
                            <span class="fa fa-arrows-h form-control-feedback"></span>
                            <label>Posisi</label>
                            <input type="text" class="form-control{{ $errors->has('sponsor') ? ' is-invalid' : '' }}" value="{{ $position == 'kanan' ? 'Right' : 'Left' }}"
                                placeholder="Posisi" readonly>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group has-feedback">
                            <span class="fa fa-user form-control-feedback"></span>
                            <label>Nama</label>
                            <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name') }}"
                                placeholder="name" required autofocus> @if ($errors->has('name'))
                            <span class="text-danger">
                                <strong>{{ $errors->first('name') }}</strong>
                            </span> @endif
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group has-feedback">
                            <span class="fa fa-phone form-control-feedback"></span>
                            <label>Nomor Telfon</label>
                            <input id="phone" type="number" class="form-control{{ $errors->has('phone') ? ' is-invalid' : '' }}" name="phone" value="{{ old('phone') }}"
                                placeholder="Nomor Telfon"> @if ($errors->has('phone'))
                            <span class="text-danger">
                                <strong>{{ $errors->first('phone') }}</strong>
                            </span> @endif
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group has-feedback">
                            <span class="fa fa-user form-control-feedback"></span>
                            <label>Username</label>
                            <input id="username" type="text" class="form-control{{ $errors->has('username') ? ' is-invalid' : '' }}" name="username"
                                value="{{ old('username') }}" placeholder="username"> @if ($errors->has('username'))
                            <span class="text-danger">
                                <strong>{{ $errors->first('username') }}</strong>
                            </span> @endif
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group has-feedback">
                            <span class="fa fa-envelope form-control-feedback"></span>
                            <label>Email</label>
                            <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}"
                                placeholder="email"> @if ($errors->has('email'))
                            <span class="text-danger">
                                <strong>{{ $errors->first('email') }}</strong>
                            </span> @endif
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group has-feedback">
                            <span class="fa fa-lock form-control-feedback"></span>
                            <label>Password</label>
                            <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password"
                                placeholder="Password"> @if ($errors->has('password'))
                            <span class="text-danger">
                                <strong>{{ $errors->first('password') }}</strong>
                            </span> @endif
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group has-feedback">
                            <span class="fa fa-bank form-control-feedback"></span>
                            <label>Bank</label>
                            <input id="bank" type="text" class="form-control{{ $errors->has('bank') ? ' is-invalid' : '' }}" name="bank" value="{{ old('bank') }}"
                                placeholder="bank"> @if ($errors->has('bank'))
                            <span class="text-danger">
                                <strong>{{ $errors->first('bank') }}</strong>
                            </span> @endif
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group has-feedback">
                            <span class="fa fa-edit form-control-feedback"></span>
                            <label>Nomer Rekening</label>
                            <input id="norek" type="number" class="form-control{{ $errors->has('norek') ? ' is-invalid' : '' }}" name="norek" value="{{ old('norek') }}"
                                placeholder="Nomer Rekening"> @if ($errors->has('norek'))
                            <span class="text-danger">
                                <strong>{{ $errors->first('norek') }}</strong>
                            </span> @endif
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group has-feedback">
                            <span class="fa fa-edit form-control-feedback"></span>
                            <label>PIN 1</label>
                            <select class="form-control" id="pin_1" name="pin_1" onchange="pin()">
                            </select>@if ($errors->has('pin_1'))
                            <span class="text-danger">
                                <strong>Pin salah/sudah terpakai</strong>
                            </span> <br>@endif
                            <small>1 PIN untuk SILVER</small>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group has-feedback">
                            <span class="fa fa-edit form-control-feedback"></span>
                            <label>PIN 2</label>
                            <select class="form-control" id="pin_2" name="pin_2" onchange="pin()">
                            </select>@if ($errors->has('pin_2'))
                            <span class="text-danger">
                                <strong>Pin salah/sudah terpakai</strong>
                            </span> <br>@endif
                            <small>2 PIN untuk GOLD</small>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <div class="row">
                    <div class="col-6">
                        <a href="{{ route('network.genealogi.index', $upline) }}">
                            <div class="btn btn-block btn-warning">Kembali</div>
                        </a>
                    </div>
                    <div class="col-6">
                        <button type="submit" class="btn btn-block btn-danger" id="button" disabled>Simpan</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>
@endsection
 
@section('afterScript')
<script>
    $(function () {
        var data = [];
        @foreach ($pin as $item)
            data.push({id: '{{ $item["id"] }}', pin: '{{ $item["pin"] }}'});
        @endforeach
        var value = '<option value="0" selected>Abaikan Bila ingin di kosongi</option>';
        document.getElementById('pin_1').innerHTML += value;
        document.getElementById('pin_2').innerHTML += value;
        data.map(function(item, key) {
            var value = '<option value="'+item.id+'">'+item.pin+'</option>';
            document.getElementById('pin_1').innerHTML += value;
        });
    })

    function pin() {
        var data = [];
        var dataMirror1 = [];
        var dataMirror2 = [];
        var dataSelectPin1 = document.getElementById('pin_1').value;
        var dataSelectPin2 = document.getElementById('pin_2').value;
        if(dataSelectPin1 == 0 && dataSelectPin2 == 0) {
            document.getElementById('button').disabled = true;
        } else {
            document.getElementById('button').disabled = false;
        }
        @foreach ($pin as $item)
            data.push({id: '{{ $item["id"] }}', pin: '{{ $item["pin"] }}'});
        @endforeach
        var value = '<option value="0" selected>Abaikan Bila ingin di kosongi</option>';
        dataMirror1.push(value);
        dataMirror2.push(value);
        document.getElementById('pin_2').innerHTML = '';
        data.map(function(item, key) {
            if(dataSelectPin1 == item.id && dataSelectPin1 != dataSelectPin2) {
                var value = '<option value="'+item.id+'" selected>'+item.pin+'</option>';
                dataMirror1.push(value);
            } else if(dataSelectPin2 == item.id && dataSelectPin2 != dataSelectPin1) {
                var value = '<option value="'+item.id+'" selected>'+item.pin+'</option>';
                dataMirror2.push(value);
            } else if(dataSelectPin1 == dataSelectPin2&& dataSelectPin1 != 0) {
                var value = '<option value="'+item.id+'" disabled>'+item.pin+'</option>';
                dataMirror1.push(value);
            } else if(dataSelectPin2 == dataSelectPin1 && dataSelectPin2 != 0) {
                var value = '<option value="'+item.id+'" disabled>'+item.pin+'</option>';
                dataMirror2.push(value);
            } else {
                var value = '<option value="'+item.id+'">'+item.pin+'</option>';
                dataMirror1.push(value);
                dataMirror2.push(value);
            }
        });
        document.getElementById('pin_1').innerHTML = dataMirror1;
        document.getElementById('pin_2').innerHTML = dataMirror2;
    }

</script>
@endsection