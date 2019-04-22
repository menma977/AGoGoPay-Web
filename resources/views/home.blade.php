@extends('layouts.master') 
@section('contentHeader')
<div class="container-fluid">
    <div class="row mb-2">
        <div class="col-sm-6">
            <h1>Halaman Utama</h1>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item">Halaman Utama</li>
            </ol>
        </div>
    </div>
</div>
@endsection
 
@section('content') @if (count($reorderPin))
<div class="alert alert-info alert-dismissible">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
    <h5><i class="icon fa fa-warning"></i> Peringatan!</h5>
    <p>
        Anda Memiliki Tagihan Sebesar Rp {{ number_format($reorderPin->sum('jmlbayar'), 2, ',', '.') }} dengan jumlah pin sebanyak
        {{ $reorderPin->sum('paket') }}
    </p>
    <p>segera teransfer pembayaran anda ke:</p>
    <p>NAMA: {{ $wallet->name }}</p>
    <p>BANK: {{ $wallet->bank }}</p>
    <p>NOMOR REKENING: {{ $wallet->wallet }}</p>
</div>
@endif @if (Session::has('error'))
<div class="alert alert-warning alert-dismissible">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
    <h5><i class="icon fa fa-warning"></i> Peringatan!</h5>
    {!! Session::get('error') !!} @php Session::forget('error'); 
@endphp
</div>
@endif
<div class="col-12">
    <div class="card">
        <div class="card-header d-flex p-0">
            <h3 class="card-title p-3">Menu</h3>
            <ul class="nav nav-pills ml-auto p-2">
                <li class="nav-item"><a class="nav-link active" href="#tab_1" data-toggle="tab">Menu Utama</a></li>
                <li class="nav-item"><a class="nav-link" href="#tab_2" data-toggle="tab">Pin Yang Belum Terpakai</a></li>
            </ul>
        </div>
        <div class="card-body">
            <div class="tab-content">
                <div class="tab-pane active" id="tab_1">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="small-box bg-danger">
                                <div class="inner">
                                    <h3>{{ Auth::User()->typeakun }}</h3>
                                    <p>TYPE AKUN</p>
                                </div>
                                <div class="icon">
                                    <i class="ion ion-person"></i>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="small-box bg-warning">
                                <div class="inner">
                                    <h3>Rp {{ number_format( $profit, 2, ',', '.') }}</h3>
                                    <p>SALDO PPOB</p>
                                </div>
                                <div class="icon">
                                    <i class="ion ion-stats-bars"></i>
                                </div>
                            </div>
                        </div>
                        @if ($listProfit) @if ($listProfit->paket == $statusForBot)
                        <div class="col-md-6">
                            <div class="small-box bg-info">
                                <div class="inner table-responsive">
                                    <h3>{{ number_format( $bonus, 8, '.', '') }}</h3>
                                    <p>SALDO BOT</p>
                                </div>
                                <div class="icon">
                                    <i class="fa fa-code-fork"></i>
                                </div>
                            </div>
                        </div>
                        @endif @endif
                        <div class="col-md-{{$listProfit ? ($listProfit->paket == $statusForBot ? '6' : '12') : '12'}}">
                            <div class="small-box bg-success">
                                <div class="inner">
                                    <h3>Rp {{ number_format( $allBonus, 2, ',', '.') }}</h3>
                                    <p>TOTAL PENDAPATAN</p>
                                </div>
                                <div class="icon">
                                    <i class="ion ion-cash"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card card-danger">
                        <div class="card-header">
                            <h3 class="card-title">Shere Link</h3>
                        </div>
                        <div class="card-body">
                            <input type="text" class="form-control" value="{{ $refUrl }}" id="url">
                        </div>
                        <div class="card-footer">
                            <button type="button" class="btn btn-block btn-outline-primary btn-md" onclick="copy()">Copy Share URL</button>
                        </div>
                    </div>
                </div>
                <div class="tab-pane" id="tab_2">
                    <div class="table-responsive">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th style="width: 25%;">Tanggal</th>
                                    <th style="width: 30%;">Pin</th>
                                    <th style="width: 20%;">Username</th>
                                    <th style="width: 30%;">Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($pin as $item)
                                <tr class="{{ $item->status == 1 ? 'bg-info' : 'bg-success' }}">
                                    <td>{{ $loop->index + 1 }}</td>
                                    <td>{{ $item->tglpakai }}</td>
                                    <td>{{ $item->pin }}</td>
                                    <td>{{ $item->username ? $item->username : '' }}</td>
                                    @if ($item->status == 1)
                                    <td>
                                        Belum Terpakai
                                    </td>
                                    @else
                                    <td>
                                        Sudah Terpakai
                                    </td>
                                    @endif
                                </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>#</th>
                                    <th style="width: 25%;">Tanggal</th>
                                    <th style="width: 30%;">Pin</th>
                                    <th style="width: 20%;">Username</th>
                                    <th style="width: 30%;">Status</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal" id="modal-default2">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Code Unik penarikan Doge</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true" onclick="closeModal2()">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group has-feedback">
                    <span class="fa fa-lock form-control-feedback"></span>
                    <label>Code Unik</label>
                    <input id="code" type="text" class="form-control{{ $errors->has('code') ? ' is-invalid' : '' }}" name="code" value="{{ old('code') }}"
                        placeholder="Code Unik" required>
                    <span class="text-danger"><strong id="errorCode"></strong></span>
                </div>
            </div>
            <div class="model-footer">
                <button type="submit" class=" btn-block btn-primary btn-lg" onclick="finalWD()">Lajutkan</button>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="modal-default1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Login Transfer Pin</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="POST" action="{{ route('pin.validate', 2) }}">
                {{ csrf_field() }}
                <div class="modal-body">
                    <div class="form-group has-feedback">
                        <span class="fa fa-lock form-control-feedback"></span>
                        <label>Password</label>
                        <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password"
                            value="{{ old('password') }}" placeholder="Password" required> @if ($errors->has('password'))
                        <span class="text-danger">
                            <strong>{{ $errors->first('password') }}</strong>
                        </span> @endif
                    </div>
                </div>
                <div class="model-footer">
                    <button type="submit" class=" btn-block btn-primary btn-lg">Lajutkan</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
 
@section('afterScript')
<!-- DataTables -->
<script src="{{ asset('adminLTE/plugins/datatables/jquery.dataTables.js') }}"></script>
<script src="{{ asset('adminLTE/plugins/datatables/dataTables.bootstrap4.js') }}"></script>
<script>
    function copy() {
        let localUrl = document.getElementById('url');
        localUrl.select();
        document.execCommand("copy");
        alert("copy to clipboard");
    }

    $(function () {
        var chackCode = "{{ $errors->first('code') }}";
        if(chackCode) {
            document.getElementById('modal-default2').class = 'modal fade show';
            document.getElementById('modal-default2').style = 'padding-right: 17px; display: block;';
        }
        $("#example1").DataTable();
        $('#example2').DataTable({
            "paging": true,
            "lengthChange": false,
            "searching": false,
            "ordering": true,
            "info": true,
            "autoWidth": false
        });
    });

    function getWallet() {
        var setUrl = "{{ route('depositDOGE') }}";
        $.ajax({
            type: 'get',
            url: setUrl,
            success: function (data) {
                if(data.Status == 0) {
                    document.getElementById('wallet').value = data.WalletDeposit;
                } else {
                    document.getElementById('wallet').value = 'wallet gagal di proses tolong ualngi lagi';
                }
            }, error: function () {
                document.getElementById('wallet').value = 'wallet gagal di proses tolong ualngi lagi';
            }
        })
    }

    function rqWD() {
        var nominal = document.getElementById('nominal').value;
        var wallet = document.getElementById('wallet1').value;
        if(nominal <= 100) {
            document.getElementById('massageNominal').innerHTML = 'Maaf penarikan minimun yang bisa anda tarik adalah 100 DOGE';
        }else if(wallet == null || wallet == '') {
            document.getElementById('massageWallet1').innerHTML = 'Pastikan Wallet Anda terisi dengan benar';
        } else {
            var setUrl = "{{ route('wdDOGE') }}";
            var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
            document.getElementById('massageNominal').innerHTML = '';
            document.getElementById('massageWallet1').innerHTML = '';
            document.getElementById('errorMassageWD').innerHTML = '';
            var body = {
                _token: CSRF_TOKEN,
                nominal: document.getElementById('nominal').value,
                wallet: document.getElementById('wallet1').value,
            };
            $.ajax({
                type: 'post',
                url: setUrl,
                data: body,
                dataType: 'JSON',
                success: function (data) {
                    document.getElementById('modal-default2').class = 'modal fade show';
                    document.getElementById('modal-default2').style = 'padding-right: 17px; display: block;';
                }, error: function (error) {
                    document.getElementById('errorMassageWD').innerHTML = 'Ada Masalah saat memproses data tolong ulangi lagi';
                }
            })
        }
    }

    function finalWD() {
        var setUrl = "{{ route('finalDOGE') }}";
            var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
            document.getElementById('errorMassageWD').innerHTML = '';
            var body = {
                _token: CSRF_TOKEN,
                nominal: document.getElementById('nominal').value,
                wallet: document.getElementById('wallet1').value,
                code: document.getElementById('code').value,
            };
            console.log(body);
            $.ajax({
                type: 'post',
                url: setUrl,
                data: body,
                dataType: 'JSON',
                success: function (data) {
                    console.log(data);
                    if(data.Status == 0) {
                        alert('Penarikan DOGE anda suksess');
                    }else {
                        document.getElementById('modal-default2').class = 'modal fade show';
                        document.getElementById('modal-default2').style = 'padding-right: 17px; display: block;';
                        document.getElementById('errorCode').innerHTML = data.Pesan;
                    }
                }, error: function (error) {
                    console.log(error);
                    document.getElementById('errorCode').innerHTML = 'Ada Masalah saat memproses data tolong ulangi lagi';
                }
            })
    }

    function closeModal2() {
        document.getElementById('modal-default2').class = 'modal fade';
        document.getElementById('modal-default2').style = '';
    }

</script>
@endsection