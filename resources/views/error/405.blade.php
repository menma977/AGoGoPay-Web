@extends('layouts.login') 
@section('content')
<div class="login-box">
  <div class="login-logo">
    <a href="{{ url('/') }}">
          <img src="{{asset('adminLTE/dist/img/logo.png')}}" class="spin" style="opacity: .9;width: 50%;">
          <label class="spin text-danger">
            <!-- AGOGOPAY -->
          </label>
        </a>
  </div>
  <div class="alert alert-warning alert-dismissible">
    <h5><i class="icon fa fa-warning"></i> Oops! Page not found.</h5>
    We could not find the page you were looking for. Meanwhile, you may return to <a href="{{ route('home') }}">HOME</a>
  </div>
</div>
@endsection