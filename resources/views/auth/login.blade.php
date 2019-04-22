@extends('layouts.login') 
@section('content')
<div class="login-box">
    <div class="login-logo">
        <a href="{{ url('/') }}">
          <img src="{{asset('adminLTE/dist/img/logo.png')}}" class="spin" style="opacity: .9;width: 50%;">
          <label class="spin text-danger">
            <!-- AGoGoPay -->
          </label>
        </a>
    </div>
    <!-- /.login-logo -->
    @if (Session::has('emailSubject'))
    <div class="alert alert-success alert-dismissible">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
        <h5><i class="icon fa fa-check"></i> {{ Session::get('emailSubject') }}</h5>
        <p>{!! Session::get('emailDescription') !!}</p>
    </div>
        @php 
            Session::forget('emailSubject'); 
            Session::forget('emailDescription'); 
        @endphp 
    @endif
    <div class="card">
        <div class="card-body login-card-body">
            <p class="login-box-msg">Masuk untuk memulai sesi Anda</p>
            <form method="POST" action="{{ route('validates') }}">
                {{ csrf_field() }}
                <div class="form-group has-feedback">
                    <input id="username" type="text" placeholder="username" class="form-control{{ $errors->has('username') ? ' is-invalid' : '' }}"
                        name="username" value="{{ old('username') }}" required autofocus>
                    <span class="fa fa-user form-control-feedback"></span> 
                    @if ($errors->has('username'))
                        <span class="text-danger">
                            <strong>{{ __('username not valid') }}</strong>
                        </span>
                    @endif 
                    @if (Session::has('validate'))
                        <span class="text-danger">
                            <strong>{{ __('username not valid') }}</strong>
                        </span>
                    @endif
                </div>

                <div class="form-group has-feedback">
                    <input id="password" type="password" placeholder="Password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}"
                        name="password" required>
                    <span class="fa fa-lock form-control-feedback"></span> 
                    @if ($errors->has('password'))
                    <span class="text-danger">
                        <strong>{{ $errors->first('password') }}</strong>
                    </span>
                    @endif
                </div>

                <div class="row">
                    <div class="col-8">
                        <div class="checkbox icheck">
                            <label>
                                <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> {{
                                __('Ingat Saya') }}
                            </label>
                        </div>
                    </div>
                    <!-- /.col -->
                    <div class="col-4">
                        <button type="submit" class="btn btn-danger btn-block btn-flat">{{ __('Masuk') }}</button>
                    </div>
                    <!-- /.col -->
                </div>
            </form>
            <div class="row">
                <div class="col-md-6">
                    <p class="mb-1">
                        <a href="{{ route('send.view')  }}" class="text-center">Lupa Kata Sandi</a>
                    </p>
                    <p class="mb-0">
                        <a href="{{ route('register.link.ref', 'codex')  }}" class="text-center">Daftarkan Akun Baru</a>
                    </p>
                </div>
                <div class="col-md-6">
                    <a href="{{ url('https://www.agogopay.com/apk/agogopay.apk')  }}" class="btn btn-info btn-block btn-flat">Dowenload APK</a>
                </div>
            </div>
        </div>
        <!-- /.login-card-body -->
    </div>
</div>
@endsection