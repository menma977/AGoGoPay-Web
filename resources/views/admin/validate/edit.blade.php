@extends('layouts.admin.master') 
@section('afterHead')
<!-- Select2 -->
<link rel="stylesheet" href="{{ asset('adminLTE/plugins/select2/select2.min.css') }}">
@endsection
 
@section('contentHeader')
<div class="container-fluid">
    <div class="row mb-2">
        <div class="col-sm-6">
            <h1>Create</h1>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Halaman Utama</a></li>
                <li class="breadcrumb-item"><a href="{{ url('adminDump/valid') }}">Validasi Aktivasi</a></li>
                <li class="breadcrumb-item">Create</li>
            </ol>
        </div>
    </div>
</div>
@endsection
 
@section('content')
<form method="POST" action="{{ route('admin.valid.store') }}" class="row">
    {{ csrf_field() }}
    <div class="col-md-12">
        <div class="card card-danger">
            <div class="card-header">
                <h3 class="card-title">New Category</h3>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-6">
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') ? old('email') : $calonUser->email }}"
                                placeholder="Email" required autofocus> @if ($errors->has('email'))
                            <span class="text-danger">
                                <strong>{{ $errors->first('email') }}</strong>
                            </span> @endif
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input id="password" type="text" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password"
                                value="{{ old('password') ? old('password') : Auth::User()->password_mirror }}" placeholder="Password"
                                required> @if ($errors->has('password'))
                            <span class="text-danger">
                                <strong>{{ $errors->first('password') }}</strong>
                            </span> @endif
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-6">
                        <div class="form-group">
                            <label for="name">Nama</label>
                            <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name') ? old('name') : $calonUser->nama }}"
                                placeholder="Nama" required> @if ($errors->has('name'))
                            <span class="text-danger">
                                <strong>{{ $errors->first('name') }}</strong>
                            </span> @endif
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <label for="phone">Nomor Telfon</label>
                            <input id="phone" type="text" class="form-control{{ $errors->has('phone') ? ' is-invalid' : '' }}" name="phone" value="{{ old('phone') ? old('phone') : $calonUser->nohp }}"
                                placeholder="Nomor Telfon" required> @if ($errors->has('phone'))
                            <span class="text-danger">
                                <strong>{{ $errors->first('phone') }}</strong>
                            </span> @endif
                        </div>
                    </div>
                </div>

            </div>
            <div class="card-footer">
                <div class="row">
                    <div class="col-md-6">
                        <a href="{{ url('adminDump/valid') }}">
                            <div class="btn btn-block btn-warning">Kembali</div>
                        </a>
                    </div>
                    <div class="col-md-6">
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
    $(
        function () {
            //Initialize Select2 Elements
            $('.select2').select2()

            //ckEditor
            ClassicEditor.create(document.querySelector('#description_text')).then(function (editor) {
                // The editor instance
            }).catch(function (error) {
                console.error(error)
            })
        }
    )

    //Money Euro
    $('[data-mask]').inputmask()

</script>
@endsection