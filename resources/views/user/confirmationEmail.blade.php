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
<div class="col-md-12">
    <div class="card card-danger">
        <div class="card-header">
            <h3 class="card-title">Confirmation</h3>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-6">
                    <form method="GET" action="{{ route('user.send.email', Auth::user()->id) }}">
                        {{ csrf_field() }}
                        <button type="submit" class="btn btn-block btn-danger">Get Code (Email)</button>
                    </form>
                </div>
                <div class="col-6">
                    <div class="form-group">
                        <input id="code" type="text" class="form-control{{ $errors->has('code') ? ' is-invalid' : '' }}" name="code" value="{{ old('code') }}"
                            placeholder="Enter Code" onchange="cekCode('{{ $emailCode }}')" required>                        @if ($errors->has('code'))
                        <span class="text-danger">
                            <strong>{{ $errors->first('code') }}</strong>
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
                    <a href="{{ route('user.edit.password', [Auth::user()->id, $emailCode]) }}">
                        <button type="submit" class="btn btn-block btn-danger" id="cPass" name="cPass" disabled>Next</button>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
 
@section('afterScript')
<!-- Select2 -->
<script src="{{ asset('adminLTE/plugins/select2/select2.full.min.js') }}"></script>
<!-- InputMask -->
<script src="{{ asset('adminLTE/plugins/input-mask/jquery.inputmask.js') }}"></script>
<script src="{{ asset('adminLTE/plugins/input-mask/jquery.inputmask.date.extensions.js') }}"></script>
<script src="{{ asset('adminLTE/plugins/input-mask/jquery.inputmask.extensions.js') }}"></script>
<script>
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

    function cekCode(code) {
        let curetCode = code;
        let inputCode = document.getElementById('code').value;
        if(curetCode == inputCode) {
            document.getElementById('cPass').disabled = false;
        } else {
            document.getElementById('cPass').disabled = true;
        }
    }

    //Money Euro
    $('[data-mask]').inputmask()

</script>
@endsection