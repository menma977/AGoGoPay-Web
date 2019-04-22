@extends('layouts.master') 
@section('afterHead')
<!-- Select2 -->
<link rel="stylesheet" href="{{ asset('adminLTE/plugins/select2/select2.min.css') }}">
@endsection
@section('contentHeader')
<div class="container-fluid">
    <div class="row mb-2">
        <div class="col-sm-6">
            <h1>Genealogy <small>{{ $user->username }}</small></h1>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{ route('home') }}">Halaman Utama</a></li>
                <li class="breadcrumb-item">Genealogy</li>
                @if (Session::get('userLine') != null) @foreach (Session::get('userLine') as $item)
                <li class="breadcrumb-item">
                    <a href="{{ route('network.genealogi.index', Crypt::encrypt($item->username)) }}">{{ $item->nama }}</a>
                </li>
                @endforeach @endif
            </ol>
        </div>
    </div>
</div>
<style>
    .backgroundImageIn {
        background-image: url('adminLTE/dist/img/avatar.png');
        background-size: cover;
    }

    .line1VerticalTop {
        border-right: 6px solid #f27e95;
        height: 50px;
        position: absolute;
        left: 50%;
        top: -20px;
    }

    .line1VerticalButtonLeft {
        border-right: 6px solid #f27e95;
        height: 70px;
        position: absolute;
        left: 24.5%;
        top: 30px;
    }

    .line1VerticalButtonRight {
        border-right: 6px solid #f27e95;
        height: 70px;
        position: absolute;
        left: 75.5%;
        top: 30px;
    }

    .line1LeftHorizontal {
        border-top: 6px solid #f27e95;
        width: 530px;
        position: absolute;
        left: 25%;
        margin-left: -3px;
        top: 30px;
    }

    /* 2 */

    .line2VerticalTop {
        border-right: 6px solid #f27e95;
        height: 50px;
        position: absolute;
        left: 50%;
        top: -17px;
    }

    .line2VerticalButtonLeft {
        border-right: 6px solid #f27e95;
        height: 70px;
        position: absolute;
        left: 24.5%;
        top: 30px;
    }

    .line2VerticalButtonRight {
        border-right: 6px solid #f27e95;
        height: 70px;
        position: absolute;
        left: 72.5%;
        top: 30px;
    }

    .line2LeftHorizontal {
        border-top: 6px solid #f27e95;
        width: 260px;
        position: absolute;
        left: 25%;
        margin-left: -3px;
        top: 30px;
    }
</style>
@endsection
 
@section('content') 
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
<label>Username</label>
<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            <select class="form-control select2" style="width: 100%;" name="username" id="username">
                <option value="{{Auth::user()->username}}" >{{Auth::user()->username}}</option>
                @foreach ($arrayDataSrc as $item)
                <option value="{{$item}}" >{{$item}}</option>
                @endforeach
            </select>
        </div>
    </div>
    <div class="col-md-6">
        <button type="button" class="btn btn-block btn-danger btn-sm" onclick="findOnClick()">Find</button>
    </div>
</div>
<div class="table-responsive">
    <div style="width: 1038px">
        <div class="row">
            <div class="col-5 align-items-center"></div>
            <div class="col-2">
                @if (count(Session::get('userLine')) > 1)
                <a href="{{ route('network.genealogi.index', Crypt::encrypt(Session::get('userLine')[count(Session::get('userLine')) - 2]->username)) }}">
                    <button type="button" class="btn btn-block btn-info btn-sm"><i class="fa fa-arrow-circle-up"></i></button>
                </a>
                <hr> @endif
                <div class="small-box {{ $user->username ? 'bg-danger' : 'backgroundImageIn' }}">
                    <div class="inner" style="text-align: center;">
                        <h6>{{ $user->username }}</h6>
                        <p>
                            <table class="col-12">
                                <tr>
                                    <td style="width: 40%">{{ $user->jmlkiri }}</td>
                                    <td style="width: 10%">|</td>
                                    <td style="width: 40%">{{ $user->jmlkanan }}</td>
                                </tr>
                            </table>
                        </p>
                    </div>
                    <a href="#" data-toggle="modal" data-target="#modal-default0" class="small-box-footer">
                        detail
                        <i class="fa fa-arrow-circle-right"></i>
                    </a>
                </div>
            </div>
            <div class="col-5"></div>
        </div>
        <div class="modal fade" id="modal-default0">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Detail Member</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <ul class="list-group list-group-unbordered mb-3">
                            <li class="list-group-item">
                                <b>Username</b> <a class="float-right">{{ $user->username }}</a>
                            </li>
                            <li class="list-group-item">
                                <b>Type Akun</b> <a class="float-right">{{ $user->typeakun }}</a>
                            </li>
                            <li class="list-group-item">
                                <b>Tanggal Gabung</b> <a class="float-right">{{ $user->joindate }}</a>
                            </li>
                            <li class="list-group-item">
                                <ul class="list-group list-group-unbordered mb-3 text-center">
                                    <b>Jumlah Perputaran Jaringan</b>
                                    <hr>
                                    <div class="row">
                                        <div class="col-6">
                                            <p><b>Kiri</b></p>
                                            <p>{{ $user->jmlkiri }}</p>
                                        </div>
                                        <div class="col-6">
                                            <p><b>Kanan</b></p>
                                            <p>{{ $user->kanan }}</p>
                                        </div>
                                    </div>
                                </ul>
                            </li>
                            <li class="list-group-item">
                                <ul class="list-group list-group-unbordered mb-3 text-center">
                                    <b>Jumlah Perputaran Jaringan Menunggu</b>
                                    <hr>
                                    <div class="row">
                                        <div class="col-6">
                                            <p><b>Kiri</b></p>
                                            <p>{{ $user->mkiri }}</p>
                                        </div>
                                        <div class="col-6">
                                            <p><b>Kanan</b></p>
                                            <p>{{ $user->mkanan }}</p>
                                        </div>
                                    </div>
                                </ul>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-12">
            <div class="line1VerticalTop"></div>
            <div class="line1LeftHorizontal"></div>
            <div class="line1VerticalButtonLeft"></div>
            <div class="line1VerticalButtonRight"></div>
            <br /><br /><br /><br />
        </div>

        {{-- line 2 --}}
        <div class="row">
            <div class="col-2"></div>
            <div class="col-2">
                <div class="small-box {{ $user->userLeft ? 'bg-danger' : 'backgroundImageIn' }}">
                    <div class="inner" style="text-align: center;">
                        <h6>{{ $user->userLeft ? $user->userLeft->username : '.' }}</h6>
                        <p>
                            <table class="col-12">
                                <tr>
                                    <td style="width: 40%">{{ $user->userLeft ? $user->userLeft->jmlkiri : '.' }}</td>
                                    <td style="width: 10%">|</td>
                                    <td style="width: 40%">{{ $user->userLeft ? $user->userLeft->jmlkanan : '.' }}</td>
                                </tr>
                            </table>
                        </p>
                    </div>
                    @if ($user->userLeft)
                    <a href="#" data-toggle="modal" data-target="#modal-default1" class="small-box-footer">
                        detail
                        <i class="fa fa-arrow-circle-right"></i>
                    </a> @else
                    <a href="{{ route('network.genealogi.create', [Crypt::encrypt($user->username), 'kiri']) }}" class="small-box-footer bg-danger">
                        Pendaftaran
                        <i class="fa fa-arrow-circle-right"></i>
                    </a> @endif
                </div>
            </div>
            <div class="col-4"></div>
            <div class="col-2">
                <div class="small-box {{ $user->userRight ? 'bg-danger' : 'backgroundImageIn' }}">
                    <div class="inner" style="text-align: center;">
                        <h6>{{ $user->userRight ? $user->userRight->username : '.' }}</h6>
                        <p>
                            <table class="col-12">
                                <tr>
                                    <td style="width: 40%">{{ $user->userRight ? $user->userRight->jmlkiri : '.' }}</td>
                                    <td style="width: 10%">|</td>
                                    <td style="width: 40%">{{ $user->userRight ? $user->userRight->jmlkanan : '.' }}</td>
                                </tr>
                            </table>
                        </p>
                    </div>
                    @if ($user->userRight)
                    <a href="#" data-toggle="modal" data-target="#modal-default2" class="small-box-footer">
                        detail
                        <i class="fa fa-arrow-circle-right"></i>
                    </a> @else
                    <a href="{{ route('network.genealogi.create', [Crypt::encrypt($user->username), 'kanan']) }}" class="small-box-footer bg-danger">
                        Pendaftaran
                        <i class="fa fa-arrow-circle-right"></i>
                    </a> @endif
                </div>
            </div>
            <div class="col-2"></div>
        </div>

        @if ($user->userLeft)
        <div class="modal fade" id="modal-default1">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Detail Member</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <ul class="list-group list-group-unbordered mb-3">
                            <li class="list-group-item">
                                <b>Username</b> <a class="float-right">{{ $user->userLeft->username }}</a>
                            </li>
                            <li class="list-group-item">
                                <b>Type Akun</b> <a class="float-right">{{ $user->userLeft->typeakun }}</a>
                            </li>
                            <li class="list-group-item">
                                <b>Tanggal Gabung</b> <a class="float-right">{{ $user->userLeft->joindate }}</a>
                            </li>
                            <li class="list-group-item">
                                <ul class="list-group list-group-unbordered mb-3 text-center">
                                    <b>Jumlah Perputaran Jaringan</b>
                                    <hr>
                                    <div class="row">
                                        <div class="col-6">
                                            <p><b>Kiri</b></p>
                                            <p>{{ $user->userLeft->jmlkiri }}</p>
                                        </div>
                                        <div class="col-6">
                                            <p><b>Kanan</b></p>
                                            <p>{{ $user->userLeft->kanan }}</p>
                                        </div>
                                    </div>
                                </ul>
                            </li>
                            <li class="list-group-item">
                                <ul class="list-group list-group-unbordered mb-3 text-center">
                                    <b>Jumlah Perputaran Jaringan Menunggu</b>
                                    <hr>
                                    <div class="row">
                                        <div class="col-6">
                                            <p><b>Kiri</b></p>
                                            <p>{{ $user->userLeft->mkiri }}</p>
                                        </div>
                                        <div class="col-6">
                                            <p><b>Kanan</b></p>
                                            <p>{{ $user->userLeft->mkanan }}</p>
                                        </div>
                                    </div>
                                </ul>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        @endif @if ($user->userRight)
        <div class="modal fade" id="modal-default2">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Detail Member</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <ul class="list-group list-group-unbordered mb-3">
                            <li class="list-group-item">
                                <b>Username</b> <a class="float-right">{{ $user->userRight->username }}</a>
                            </li>
                            <li class="list-group-item">
                                <b>Type Akun</b> <a class="float-right">{{ $user->userRight->typeakun }}</a>
                            </li>
                            <li class="list-group-item">
                                <b>Tanggal Gabung</b> <a class="float-right">{{ $user->userRight->joindate }}</a>
                            </li>
                            <li class="list-group-item">
                                <ul class="list-group list-group-unbordered mb-3 text-center">
                                    <b>Jumlah Perputaran Jaringan</b>
                                    <hr>
                                    <div class="row">
                                        <div class="col-6">
                                            <p><b>Kiri</b></p>
                                            <p>{{ $user->userRight->jmlkiri }}</p>
                                        </div>
                                        <div class="col-6">
                                            <p><b>Kanan</b></p>
                                            <p>{{ $user->userRight->kanan }}</p>
                                        </div>
                                    </div>
                                </ul>
                            </li>
                            <li class="list-group-item">
                                <ul class="list-group list-group-unbordered mb-3 text-center">
                                    <b>Jumlah Perputaran Jaringan Menunggu</b>
                                    <hr>
                                    <div class="row">
                                        <div class="col-6">
                                            <p><b>Kiri</b></p>
                                            <p>{{ $user->userRight->mkiri }}</p>
                                        </div>
                                        <div class="col-6">
                                            <p><b>Kanan</b></p>
                                            <p>{{ $user->userRight->mkanan }}</p>
                                        </div>
                                    </div>
                                </ul>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        @endif

        <div class="row">
            <div class="col-6">
                <div class="line2VerticalTop"></div>
                <div class="line2LeftHorizontal"></div>
                <div class="line2VerticalButtonLeft"></div>
                <div class="line2VerticalButtonRight"></div>
                <br /><br /><br /><br />
            </div>
            <div class="col-6">
                <div class="line2VerticalTop"></div>
                <div class="line2LeftHorizontal"></div>
                <div class="line2VerticalButtonLeft"></div>
                <div class="line2VerticalButtonRight"></div>
                <br /><br /><br /><br />
            </div>
        </div>

        {{-- line 3 --}}
        <div class="row">
            <div style="width: 50px;"></div>
            <div class="col-2">
                <div class="small-box {{ $user->userLeft ? ($user->userLeft->subUserLeft ? 'bg-danger': 'backgroundImageIn') : 'backgroundImageIn' }}">
                    <div class="inner" style="text-align: center;">
                        <h6>{{ $user->userLeft ? ($user->userLeft->subUserLeft ? $user->userLeft->subUserLeft->username : '.')
                            : '.' }}</h6>
                        <p>
                            <table class="col-12">
                                <tr>
                                    <td style="width: 40%">{{ $user->userLeft ? ($user->userLeft->subUserLeft ? $user->userLeft->subUserLeft->jmlkiri
                                        : '.') : '.' }}</td>
                                    <td style="width: 10%">|</td>
                                    <td style="width: 40%">{{ $user->userLeft ? ($user->userLeft->subUserLeft ? $user->userLeft->subUserLeft->jmlkanan
                                        : '.') : '.' }}</td>
                                </tr>
                            </table>
                        </p>
                    </div>
                    @if ($user->userLeft ? ($user->userLeft->subUserLeft ? $user->userLeft->subUserLeft->username : false) : false)
                    <a href="#" data-toggle="modal" data-target="#modal-default3" class="small-box-footer">
                        detail
                        <i class="fa fa-arrow-circle-right"></i>
                    </a> @else @if ($user->userLeft ? true : false)
                    <a href="{{ route('network.genealogi.create', [Crypt::encrypt($user->userLeft->username), 'kiri']) }}" class="small-box-footer bg-danger">
                        Pendaftaran
                        <i class="fa fa-arrow-circle-right"></i>
                    </a> @else
                    <div class="small-box-footer">.</div>
                    @endif @endif
                </div>
                @if ($user->userLeft ? ($user->userLeft->subUserLeft ? $user->userLeft->subUserLeft->username : false) : false)
                <hr>
                <a href="{{ route('network.genealogi.index', Crypt::encrypt($user->userLeft->subUserLeft->username)) }}">
                    <button type="button" class="btn btn-block btn-info btn-sm"><i class="fa fa-arrow-circle-down"></i></button>
                </a> @endif
            </div>
            <div style="width: 80px;"></div>
            <div class="col-2">
                <div class="small-box {{ $user->userLeft ? ($user->userLeft->subUserRight ? 'bg-danger': 'backgroundImageIn') : 'backgroundImageIn' }}">
                    <div class="inner" style="text-align: center;">
                        <h6>{{ $user->userLeft ? ($user->userLeft->subUserRight ? $user->userLeft->subUserRight->username : '.')
                            : '.' }}</h6>
                        <p>
                            <table class="col-12">
                                <tr>
                                    <td style="width: 40%">{{ $user->userLeft ? ($user->userLeft->subUserRight ? $user->userLeft->subUserRight->jmlkiri
                                        : '.') : '.' }}</td>
                                    <td style="width: 10%">|</td>
                                    <td style="width: 40%">{{ $user->userLeft ? ($user->userLeft->subUserRight ? $user->userLeft->subUserRight->jmlkanan
                                        : '.') : '.' }}</td>
                                </tr>
                            </table>
                        </p>
                    </div>
                    @if ($user->userLeft ? ($user->userLeft->subUserRight ? $user->userLeft->subUserRight->username : false) : false)
                    <a href="#" data-toggle="modal" data-target="#modal-default4" class="small-box-footer">
                        detail
                        <i class="fa fa-arrow-circle-right"></i>
                    </a> @else @if ($user->userLeft ? true : false)
                    <a href="{{ route('network.genealogi.create', [Crypt::encrypt($user->userLeft->username), 'kanan']) }}" class="small-box-footer bg-danger">
                        Pendaftaran
                        <i class="fa fa-arrow-circle-right"></i>
                    </a> @else
                    <div class="small-box-footer">.</div>
                    @endif @endif
                </div>
                @if ($user->userLeft ? ($user->userLeft->subUserRight ? $user->userLeft->subUserRight->username : false) : false)
                <hr>
                <a href="{{ route('network.genealogi.index', Crypt::encrypt($user->userLeft->subUserRight->username)) }}">
                    <button type="button" class="btn btn-block btn-info btn-sm"><i class="fa fa-arrow-circle-down"></i></button>
                </a> @endif
            </div>
            <div class="col-1"></div>
            <div class="col-2">
                <div class="small-box {{ $user->userRight ? ($user->userRight->subUserLeft ? 'bg-danger': 'backgroundImageIn') : 'backgroundImageIn' }}">
                    <div class="inner" style="text-align: center;">
                        <h6>{{ $user->userRight ? ($user->userRight->subUserLeft ? $user->userRight->subUserLeft->username :
                            '.') : '.' }}</h6>
                        <p>
                            <table class="col-12">
                                <tr>
                                    <td style="width: 40%">{{ $user->userRight ? ($user->userRight->subUserLeft ? $user->userRight->subUserLeft->jmlkiri
                                        : '.') : '.' }}</td>
                                    <td style="width: 10%">|</td>
                                    <td style="width: 40%">{{ $user->userRight ? ($user->userRight->subUserLeft ? $user->userRight->subUserLeft->jmlkanan
                                        : '.') : '.' }}</td>
                                </tr>
                            </table>
                        </p>
                    </div>
                    @if ($user->userRight ? ($user->userRight->subUserLeft ? $user->userRight->subUserLeft->username : false) : false)
                    <a href="#" data-toggle="modal" data-target="#modal-default5" class="small-box-footer">
                        detail
                        <i class="fa fa-arrow-circle-right"></i>
                    </a> @else @if ($user->userRight ? true : false)
                    <a href="{{ route('network.genealogi.create', [Crypt::encrypt($user->userRight->username), 'kiri']) }}" class="small-box-footer bg-danger">
                        Pendaftaran
                        <i class="fa fa-arrow-circle-right"></i>
                    </a> @else
                    <div class="small-box-footer">.</div>
                    @endif @endif
                </div>
                @if ($user->userRight ? ($user->userRight->subUserLeft ? $user->userRight->subUserLeft->username : false) : false)
                <hr>
                <a href="{{ route('network.genealogi.index', Crypt::encrypt($user->userRight->subUserLeft->username)) }}">
                    <button type="button" class="btn btn-block btn-info btn-sm"><i class="fa fa-arrow-circle-down"></i></button>
                </a> @endif
            </div>
            <div style="width: 70px;"></div>
            <div class="col-2">
                <div class="small-box {{ $user->userRight ? ($user->userRight->subUserRight ? 'bg-danger': 'backgroundImageIn') : 'backgroundImageIn' }}">
                    <div class="inner" style="text-align: center;">
                        <h6>{{ $user->userRight ? ($user->userRight->subUserRight ? $user->userRight->subUserRight->username
                            : '.') : '.' }}</h6>
                        <p>
                            <table class="col-12">
                                <tr>
                                    <td style="width: 40%">{{ $user->userRight ? ($user->userRight->subUserRight ? $user->userRight->subUserRight->jmlkiri
                                        : '.') : '.' }}</td>
                                    <td style="width: 10%">|</td>
                                    <td style="width: 40%">{{ $user->userRight ? ($user->userRight->subUserRight ? $user->userRight->subUserRight->jmlkanan
                                        : '.') : '.' }}</td>
                                </tr>
                            </table>
                        </p>
                    </div>
                    @if ($user->userRight ? ($user->userRight->subUserRight ? $user->userRight->subUserRight->username : false) : false)
                    <a href="#" data-toggle="modal" data-target="#modal-default6" class="small-box-footer">
                        detail
                        <i class="fa fa-arrow-circle-right"></i>
                    </a> @else @if ($user->userRight ? true : false)
                    <a href="{{ route('network.genealogi.create', [Crypt::encrypt($user->userRight->username), 'kanan']) }}" class="small-box-footer bg-danger">
                        Pendaftaran
                        <i class="fa fa-arrow-circle-right"></i>
                    </a> @else
                    <div class="small-box-footer">.</div>
                    @endif @endif
                </div>
                @if ($user->userRight ? ($user->userRight->subUserRight ? $user->userRight->subUserRight->username : false) : false)
                <hr>
                <a href="{{ route('network.genealogi.index', Crypt::encrypt($user->userRight->subUserRight->username)) }}">
                    <button type="button" class="btn btn-block btn-info btn-sm"><i class="fa fa-arrow-circle-down"></i></button>
                </a> @endif
            </div>
        </div>

        @if ($user->userLeft ? ($user->userLeft->subUserLeft ? $user->userLeft->subUserLeft->username : false) : false)
        <div class="modal fade" id="modal-default3">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Detail Member</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <ul class="list-group list-group-unbordered mb-3">
                            <li class="list-group-item">
                                <b>Username</b> <a class="float-right">{{ $user->userLeft ?
                                    ($user->userLeft->subUserLeft ? $user->userLeft->subUserLeft->username : false) :
                                    false }}</a>
                            </li>
                            <li class="list-group-item">
                                <b>Type Akun</b> <a class="float-right">{{ $user->userLeft ?
                                    ($user->userLeft->subUserLeft ? $user->userLeft->subUserLeft->typeakun : false) :
                                    false }}</a>
                            </li>
                            <li class="list-group-item">
                                <b>Tanggal Gabung</b> <a class="float-right">{{ $user->userLeft ?
                                    ($user->userLeft->subUserLeft ? $user->userLeft->subUserLeft->joindate : false) :
                                    false }}</a>
                            </li>
                            <li class="list-group-item">
                                <ul class="list-group list-group-unbordered mb-3 text-center">
                                    <b>Jumlah Perputaran Jaringan</b>
                                    <hr>
                                    <div class="row">
                                        <div class="col-6">
                                            <p><b>Kiri</b></p>
                                            <p>{{ $user->userLeft ? ($user->userLeft->subUserLeft ? $user->userLeft->subUserLeft->jmlkiri
                                                : false) : false }}</p>
                                        </div>
                                        <div class="col-6">
                                            <p><b>Kanan</b></p>
                                            <p>{{ $user->userLeft ? ($user->userLeft->subUserLeft ? $user->userLeft->subUserLeft->jmlkanan
                                                : false) : false }}</p>
                                        </div>
                                    </div>
                                </ul>
                            </li>
                            <li class="list-group-item">
                                <ul class="list-group list-group-unbordered mb-3 text-center">
                                    <b>Jumlah Perputaran Jaringan Menunggu</b>
                                    <hr>
                                    <div class="row">
                                        <div class="col-6">
                                            <p><b>Kiri</b></p>
                                            <p>{{ $user->userLeft ? ($user->userLeft->subUserLeft ? $user->userLeft->subUserLeft->mkiri
                                                : false) : false }}</p>
                                        </div>
                                        <div class="col-6">
                                            <p><b>Kanan</b></p>
                                            <p>{{ $user->userLeft ? ($user->userLeft->subUserLeft ? $user->userLeft->subUserLeft->mkanan
                                                : false) : false }}</p>
                                        </div>
                                    </div>
                                </ul>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        @endif @if ($user->userLeft ? ($user->userLeft->subUserRight ? $user->userLeft->subUserRight->username : false) : false)
        <div class="modal fade" id="modal-default4">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Detail Member</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <ul class="list-group list-group-unbordered mb-3">
                            <li class="list-group-item">
                                <b>Username</b> <a class="float-right">{{ $user->userLeft ?
                                    ($user->userLeft->subUserRight ? $user->userLeft->subUserRight->username : false) :
                                    false }}</a>
                            </li>
                            <li class="list-group-item">
                                <b>Type Akun</b> <a class="float-right">{{ $user->userLeft ?
                                    ($user->userLeft->subUserRight ? $user->userLeft->subUserRight->typeakun : false) :
                                    false }}</a>
                            </li>
                            <li class="list-group-item">
                                <b>Tanggal Gabung</b> <a class="float-right">{{ $user->userLeft ?
                                    ($user->userLeft->subUserRight ? $user->userLeft->subUserRight->joindate : false) :
                                    false }}</a>
                            </li>
                            <li class="list-group-item">
                                <ul class="list-group list-group-unbordered mb-3 text-center">
                                    <b>Jumlah Perputaran Jaringan</b>
                                    <hr>
                                    <div class="row">
                                        <div class="col-6">
                                            <p><b>Kiri</b></p>
                                            <p>{{ $user->userLeft ? ($user->userLeft->subUserRight ? $user->userLeft->subUserRight->jmlkiri
                                                : false) : false }}</p>
                                        </div>
                                        <div class="col-6">
                                            <p><b>Kanan</b></p>
                                            <p>{{ $user->userLeft ? ($user->userLeft->subUserRight ? $user->userLeft->subUserRight->jmlkanan
                                                : false) : false }}</p>
                                        </div>
                                    </div>
                                </ul>
                            </li>
                            <li class="list-group-item">
                                <ul class="list-group list-group-unbordered mb-3 text-center">
                                    <b>Jumlah Perputaran Jaringan Menunggu</b>
                                    <hr>
                                    <div class="row">
                                        <div class="col-6">
                                            <p><b>Kiri</b></p>
                                            <p>{{ $user->userLeft ? ($user->userLeft->subUserRight ? $user->userLeft->subUserRight->mkiri
                                                : false) : false }}</p>
                                        </div>
                                        <div class="col-6">
                                            <p><b>Kanan</b></p>
                                            <p>{{ $user->userLeft ? ($user->userLeft->subUserRight ? $user->userLeft->subUserRight->mkanan
                                                : false) : false }}</p>
                                        </div>
                                    </div>
                                </ul>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        @endif @if ($user->userRight ? ($user->userRight->subUserLeft ? $user->userRight->subUserLeft->username : false) : false)
        <div class="modal fade" id="modal-default5">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Detail Member</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <ul class="list-group list-group-unbordered mb-3">
                            <li class="list-group-item">
                                <b>Username</b> <a class="float-right">{{ $user->userRight ?
                                    ($user->userRight->subUserLeft ? $user->userRight->subUserLeft->username : false) :
                                    false }}</a>
                            </li>
                            <li class="list-group-item">
                                <b>Type Akun</b> <a class="float-right">{{ $user->userRight ?
                                    ($user->userRight->subUserLeft ? $user->userRight->subUserLeft->typeakun : false) :
                                    false }}</a>
                            </li>
                            <li class="list-group-item">
                                <b>Tanggal Gabung</b> <a class="float-right">{{ $user->userRight ?
                                    ($user->userRight->subUserLeft ? $user->userRight->subUserLeft->joindate : false) :
                                    false }}</a>
                            </li>
                            <li class="list-group-item">
                                <ul class="list-group list-group-unbordered mb-3 text-center">
                                    <b>Jumlah Perputaran Jaringan</b>
                                    <hr>
                                    <div class="row">
                                        <div class="col-6">
                                            <p><b>Kiri</b></p>
                                            <p>{{ $user->userRight ? ($user->userRight->subUserLeft ? $user->userRight->subUserLeft->jmlkiri
                                                : false) : false }}</p>
                                        </div>
                                        <div class="col-6">
                                            <p><b>Kanan</b></p>
                                            <p>{{ $user->userRight ? ($user->userRight->subUserLeft ? $user->userRight->subUserLeft->jmlkanan
                                                : false) : false }}</p>
                                        </div>
                                    </div>
                                </ul>
                            </li>
                            <li class="list-group-item">
                                <ul class="list-group list-group-unbordered mb-3 text-center">
                                    <b>Jumlah Perputaran Jaringan Menunggu</b>
                                    <hr>
                                    <div class="row">
                                        <div class="col-6">
                                            <p><b>Kiri</b></p>
                                            <p>{{ $user->userRight ? ($user->userRight->subUserLeft ? $user->userRight->subUserLeft->mkiri
                                                : false) : false }}</p>
                                        </div>
                                        <div class="col-6">
                                            <p><b>Kanan</b></p>
                                            <p>{{ $user->userRight ? ($user->userRight->subUserLeft ? $user->userRight->subUserLeft->mkanan
                                                : false) : false }}</p>
                                        </div>
                                    </div>
                                </ul>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        @endif @if ($user->userRight ? ($user->userRight->subUserRight ? $user->userRight->subUserRight->username : false) : false)
        <div class="modal fade" id="modal-default6">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Detail Member</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <ul class="list-group list-group-unbordered mb-3">
                            <li class="list-group-item">
                                <b>Username</b> <a class="float-right">{{ $user->userRight ?
                                    ($user->userRight->subUserRight ? $user->userRight->subUserRight->username : false)
                                    : false }}</a>
                            </li>
                            <li class="list-group-item">
                                <b>Type Akun</b> <a class="float-right">{{ $user->userRight ?
                                    ($user->userRight->subUserRight ? $user->userRight->subUserRight->typeakun : false)
                                    : false }}</a>
                            </li>
                            <li class="list-group-item">
                                <b>Tanggal Gabung</b> <a class="float-right">{{ $user->userRight ?
                                    ($user->userRight->subUserRight ? $user->userRight->subUserRight->joindate : false)
                                    : false }}</a>
                            </li>
                            <li class="list-group-item">
                                <ul class="list-group list-group-unbordered mb-3 text-center">
                                    <b>Jumlah Perputaran Jaringan</b>
                                    <hr>
                                    <div class="row">
                                        <div class="col-6">
                                            <p><b>Kiri</b></p>
                                            <p>{{ $user->userRight ? ($user->userRight->subUserRight ? $user->userRight->subUserRight->jmlkiri
                                                : false) : false }}</p>
                                        </div>
                                        <div class="col-6">
                                            <p><b>Kanan</b></p>
                                            <p>{{ $user->userRight ? ($user->userRight->subUserRight ? $user->userRight->subUserRight->jmlkanan
                                                : false) : false }}</p>
                                        </div>
                                    </div>
                                </ul>
                            </li>
                            <li class="list-group-item">
                                <ul class="list-group list-group-unbordered mb-3 text-center">
                                    <b>Jumlah Perputaran Jaringan Menunggu</b>
                                    <hr>
                                    <div class="row">
                                        <div class="col-6">
                                            <p><b>Kiri</b></p>
                                            <p>{{ $user->userRight ? ($user->userRight->subUserRight ? $user->userRight->subUserRight->mkiri
                                                : false) : false }}</p>
                                        </div>
                                        <div class="col-6">
                                            <p><b>Kanan</b></p>
                                            <p>{{ $user->userRight ? ($user->userRight->subUserRight ? $user->userRight->subUserRight->mkanan
                                                : false) : false }}</p>
                                        </div>
                                    </div>
                                </ul>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        @endif
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
    })
    function findOnClick() {
        var e           = document.getElementById("username");
        var value       = e.options[e.selectedIndex].value;
        var username    = e.options[e.selectedIndex].text;
        var url         = "{{ route('network.genealogi.find', '#username') }}";
        url = url.replace('#username', username)
        window.location.replace(url);
    }
</script>
@endsection