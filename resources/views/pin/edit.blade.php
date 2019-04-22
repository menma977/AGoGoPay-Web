@extends('layouts.master') 
@section('afterHead')
<!-- Select2 -->
<link rel="stylesheet" href="{{ asset('adminLTE/plugins/select2/select2.min.css') }}">
@endsection
 
@section('contentHeader')
<div class="container-fluid">
    <div class="row mb-2">
        <div class="col-sm-6">
            <h1>Transfer</h1>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{ route('home') }}">Halaman Utama</a></li>
                <li class="breadcrumb-item"><a href="{{ route('pin.index') }}">Menu Transfer</a></li>
                <li class="breadcrumb-item">Transfer</li>
            </ol>
        </div>
    </div>
</div>
<style>
    .select2-selection__rendered {
        line-height: 31px !important;
    }

    .select2-container .select2-selection--single {
        height: 40px !important;
    }

    .select2-selection__arrow {
        height: 40px !important;
    }
</style>
@endsection
 
@section('content')
<form action="{{ route('pin.update') }}" method="POST">
    {{ csrf_field() }}
    <div class="col-md-12">
        <div class="card card-danger">
            <div class="card-header">
                <h3 class="card-title">Menu Transfer Pin</h3>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="pin">Pin</label>
                            <input type="text" name="pin" value="{{ $pin->id }}" hidden>
                            <input type="text" class="form-control{{ $errors->has('pin') ? ' is-invalid' : '' }}" value="{{ $pin->pin }}" placeholder="Pin"
                                readonly> @if ($errors->has('pin'))
                            <span class="text-danger">
                                <strong>{{ $errors->first('pin') }}</strong>
                            </span> @endif
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Username</label>
                            <select class="form-control select2" style="width: 100%;" id="username" name="username">
                                @foreach ($user as $item)
                                <option value="{{ $item->id }}">{{ $item->username }}</option>
                                @endforeach
                            </select> @if ($errors->has('username'))
                            <span class="text-danger">
                                <strong>{{ $errors->first('username') }}</strong>
                            </span> @endif
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <button type="submit" class="btn btn-block btn-danger">Ubah Pemilik Pin</button>
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

</script>
@endsection