@extends('layouts.master') 
@section('afterHead')
<!-- Select2 -->
<link rel="stylesheet" href="{{ asset('adminLTE/plugins/select2/select2.min.css') }}">
@endsection
 
@section('contentHeader')
<div class="container-fluid">
    <div class="row mb-2">
        <div class="col-sm-6">
            <h1>Edit</h1>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{ route('home') }}">Halaman Utama</a></li>
                <li class="breadcrumb-item"><a href="{{ route('user.index') }}">User</a></li>
                <li class="breadcrumb-item">Edit</li>
            </ol>
        </div>
    </div>
</div>
@endsection
 
@section('content')
<form method="POST" action="{{ route('user.update.password', Auth::user()->id) }}" class="row">
    {{ csrf_field() }}
    <div class="col-md-12">
        <div class="card card-danger">
            <div class="card-header">
                <h3 class="card-title">Edit User</h3>
            </div>
            <div class="card-body">
                <div class="form-group">
                    <label for="name">Nama</label>
                    <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name') ? old('name') : $user->nama }}"
                        placeholder="Nama" required autofocus> @if ($errors->has('name'))<span class="text-danger"><strong>{{ $errors->first('name') }}</strong></span>                    @endif
                </div>
                <div class="row">
                    <div class="col-6">
                        <div class="form-group">
                            <label for="password">Password</label>
                            <div class="input-group mb-3">
                                <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password"
                                    value="{{ old('password') ? old('password') : $user->password_mirror }}" placeholder="Password"
                                    required>
                                <a href="#" class="input-group-text" onclick="changeTypePassword()">
                                    <div class="input-group-append">
                                        <i id="eyes" class="fa fa-eye-slash"></i>
                                    </div>
                                </a>
                            </div>
                            @if ($errors->has('password'))
                            <span class="text-danger">
                                <strong>{{ $errors->first('password') }}</strong>
                            </span> @endif
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <label for="phone">Nomor Telfon</label>
                            <input id="phone" type="number" class="form-control{{ $errors->has('phone') ? ' is-invalid' : '' }}" name="phone" value="{{ old('phone') ? old('phone') : $user->phone }}"
                                placeholder="Nomor Telfon" required> @if ($errors->has('phone'))
                            <span class="text-danger">
                                <strong>{{ $errors->first('phone') }}</strong>
                            </span> @endif
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-6">
                        <div class="form-group">
                            <label for="norek">Nomor Rekening</label>
                            <input id="norek" type="number" class="form-control{{ $errors->has('norek') ? ' is-invalid' : '' }}" name="norek" value="{{ old('norek') ? old('norek') : $user->norek }}"
                                placeholder="Nomor Rekening" required> @if ($errors->has('norek'))
                            <span class="text-danger">
                                <strong>{{ $errors->first('norek') }}</strong>
                            </span> @endif
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <label for="bank">Bank</label>
                            <input id="bank" type="text" class="form-control{{ $errors->has('bank') ? ' is-invalid' : '' }}" name="bank" value="{{ old('bank') ? old('bank') : $user->bank }}"
                                placeholder="Bank" required> @if ($errors->has('bank'))
                            <span class="text-danger">
                                <strong>{{ $errors->first('bank') }}</strong>
                            </span> @endif
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <div class="row">
                    <div class="col-6">
                        <a href="{{ route('user.index') }}">
                            <div class="btn btn-block btn-warning">Kembali</div>
                        </a>
                    </div>
                    <div class="col-6">
                        <button type="submit" class="btn btn-block btn-danger">Simpan</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>
@endsection
 
@section('afterScript')
<!-- Select2 -->
<script src="{{ asset('adminLTE/plugins/select2/select2.full.min.js') }}"></script>
<!-- InputMask -->
<script src="{{ asset('adminLTE/plugins/input-mask/jquery.inputmask.js') }}"></script>
<script src="{{ asset('adminLTE/plugins/input-mask/jquery.inputmask.date.extensions.js') }}"></script>
<script src="{{ asset('adminLTE/plugins/input-mask/jquery.inputmask.extensions.js') }}"></script>
<script>
    let typeEyes = 0;
    $(function () {
        //Initialize Select2 Elements
        $('.select2').select2()
        //ckEditor
        ClassicEditor.create(document.querySelector('#description_text')).then(function (editor) {
            // The editor instance
        }).catch(function (error) {
            // console.error(error)
        })
    })

    //Money Euro
    $('[data-mask]').inputmask()

    function changeTypePassword() {
        if(typeEyes == 0) {
            typeEyes = 1;
            document.getElementById('eyes').className = "fa fa-eye";
            document.getElementById('password').type = "text";
        } else {
            typeEyes = 0;
            document.getElementById('eyes').className = "fa fa-eye-slash";
            document.getElementById('password').type = "password";
        }
    }

</script>
@endsection