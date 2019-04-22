@extends('layouts.login') 
@section('content')
<div class="register-box">
    <div class="register-logo">
        <a href="{{ url('/') }}">
            <img src="{{asset('adminLTE/dist/img/logo.png')}}" class="spin" style="opacity: .9;width: 50%;">
            <label class="spin text-danger">
                <!-- AGoGoPay -->
            </label>
        </a>
    </div>

    <div class="card">
        <div class="card-body register-card-body">
            <p class="login-box-msg">Daftarkan Akun Baru</p>
            <form method="POST" action="{{ route('register.link.reg') }}">
                {{ csrf_field() }}
                <div class="form-group has-feedback">
                    <span class="fa fa-sitemap form-control-feedback"></span>
                    <label>Sponsor</label>
                    <input id="sponsor" type="text" class="form-control{{ $errors->has('sponsor') ? ' is-invalid' : '' }}" name="sponsor" value="{{ old('sponsor') ? old('sponsor') : $linkUsername }}"
                        placeholder="Sponsor" required autofocus> @if ($errors->has('sponsor'))
                    <span class="text-danger">
                        <strong>{{ $errors->first('sponsor') }}</strong>
                    </span> @endif @if (Session::has('validateSponsor'))
                    <span class="text-danger">
                        <strong>Sponsors do not match our data</strong>
                    </span> @endif
                </div>
                <div class="form-group has-feedback">
                    <span class="fa fa-user form-control-feedback"></span>
                    <label>Nama</label>
                    <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name') }}"
                        placeholder="Nama"> @if ($errors->has('name'))
                    <span class="text-danger">
                        <strong>{{ $errors->first('name') }}</strong>
                    </span> @endif
                </div>
                <div class="form-group has-feedback">
                    <span class="fa fa-phone form-control-feedback"></span>
                    <label>Nomor Telfon</label>
                    <input id="phone" type="number" class="form-control{{ $errors->has('phone') ? ' is-invalid' : '' }}" name="phone" value="{{ old('phone') }}"
                        placeholder="Nomor Telfon"> @if ($errors->has('phone'))
                    <span class="text-danger">
                        <strong>{{ $errors->first('phone') }}</strong>
                    </span> @endif
                </div>
                <div class="form-group has-feedback">
                    <span class="fa fa-user form-control-feedback"></span>
                    <label>Username</label>
                    <input id="username" type="text" class="form-control{{ $errors->has('username') ? ' is-invalid' : '' }}" name="username"
                        value="{{ old('username') }}" placeholder="Username"> @if ($errors->has('username'))
                    <span class="text-danger">
                        <strong>{{ $errors->first('username') }}</strong>
                    </span> @endif
                </div>
                <div class="form-group has-feedback">
                    <span class="fa fa-envelope form-control-feedback"></span>
                    <label>Email</label>
                    <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}"
                        placeholder="Email"> @if ($errors->has('email'))
                    <span class="text-danger">
                        <strong>{{ $errors->first('email') }}</strong>
                    </span> @endif
                </div>
                <div class="form-group has-feedback">
                    <span class="fa fa-lock form-control-feedback"></span>
                    <label>Password</label>
                    <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password"
                        placeholder="Password"> @if ($errors->has('password'))
                    <span class="text-danger">
                        <strong>{{ $errors->first('password') }}</strong>
                    </span> @endif
                </div>
                <div class="form-group has-feedback">
                    <span class="fa fa-bank form-control-feedback"></span>
                    <label>Bank</label>
                    <input id="bank" type="text" class="form-control{{ $errors->has('bank') ? ' is-invalid' : '' }}" name="bank" value="{{ old('bank') }}"
                        placeholder="bank"> @if ($errors->has('bank'))
                    <span class="text-danger">
                        <strong>{{ $errors->first('bank') }}</strong>
                    </span> @endif
                </div>
                <div class="form-group has-feedback">
                    <span class="fa fa-edit form-control-feedback"></span>
                    <label>Nomer Rekening</label>
                    <input id="norek" type="number" class="form-control{{ $errors->has('norek') ? ' is-invalid' : '' }}" name="norek" value="{{ old('norek') }}"
                        placeholder="Nomer Rekening"> @if ($errors->has('norek'))
                    <span class="text-danger">
                        <strong>{{ $errors->first('norek') }}</strong>
                    </span> @endif
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group has-feedback">
                            <span class="fa fa-edit form-control-feedback"></span>
                            <label>PIN 1</label>
                            <input id="pin_1" type="text" class="form-control{{ $errors->has('pin_1') ? ' is-invalid' : '' }}" name="pin_1" value="{{ old('pin_1') }}"
                                placeholder="1 PIN untuk SILVER"> @if (Session::has('pin_1'))
                            <span class="text-danger">
                                <strong>Pin salah/sudah terpakai</strong>
                            </span> @endif
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group has-feedback">
                            <span class="fa fa-edit form-control-feedback"></span>
                            <label>PIN 2</label>
                            <input id="pin_2" type="text" class="form-control{{ $errors->has('pin_2') ? ' is-invalid' : '' }}" name="pin_2" value="{{ old('pin_2') }}"
                                placeholder="2 PIN untuk GOLD"> @if (Session::has('pin_2'))
                            <span class="text-danger">
                                <strong>Pin salah/sudah terpakai</strong>
                            </span> @endif
                        </div>
                    </div>
                </div>
                <div class="form-group has-feedback">
                    <span class="fa fa-arrows-h form-control-feedback"></span>
                    <label>Posisi</label>
                    <select class="form-control" id="position" name="position">
                        @if ($dataUser)
                            <option value="kiri" selected="{{ $dataUser->jmlkanan < $dataUser->jmlkiri ? 'true' : 'false' }}">Kiri</option>
                            <option value="kanan" selected="{{ $dataUser->jmlkanan > $dataUser->jmlkiri ? 'true' : 'false' }}">Kanan</option>
                        @else
                            <option value="kiri">Kiri</option>
                            <option value="kanan">Kanan</option>
                        @endif
                    </select> @if ($errors->has('position'))
                    <span class="text-danger">
                            <strong>{{ $errors->first('position') }}</strong>
                        </span> @endif
                </div>
                <div class="row">
                    <!-- /.col -->
                    <div class="col-4">
                        <button type="submit" class="btn btn-danger btn-block btn-flat">Daftar</button>
                    </div>
                    <!-- /.col -->
                </div>
            </form>
            <p class="mb-1">
                <a href="{{ route('login')  }}" class="text-center">Sudah Punya Akun ?</a>
            </p>
        </div>
        <!-- /.form-box -->
    </div>
    <!-- /.card -->
</div>
<!-- /.register-box -->
@endsection