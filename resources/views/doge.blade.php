@extends('layouts.master') 
@section('contentHeader')
<div class="container-fluid">
    <div class="row mb-2">
        <div class="col-sm-6">
            <h1>Game</h1>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{ route('home') }}">Halaman Utama</a></li>
                <li class="breadcrumb-item">Game</li>
            </ol>
        </div>
    </div>
</div>
@endsection
 
@section('content')
<div class="row">
    <div class="col-md-6">
        <div class="card">
            <div class="card-body">
                <div class="form-group">
                    <label for="wallet">Wallet Doge Untuk Deposito</label>
                    <input type="text" class="form-control" id="wallet" readonly>
                </div>
            </div>
            <div class="card-footer">
                <button type="submit" class="btn btn-danger btn-block" onclick="getWallet()">Dapatkan Wallet</button>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <span class="text-danger"><strong id="errorMassageWD"></strong></span>
        <div class="card">
            <div class="card-body">
                <div class="form-group">
                    <label for="nominal">Nominal Penasikan Doge</label>
                    <input type="number" class="form-control" id="nominal" name="nominal">
                    <span class="text-danger"><strong id="massageNominal"></strong></span>
                </div>
                <div class="form-group">
                    <label for="wallet1">Wallet Doge</label>
                    <input type="text" class="form-control" id="wallet1" value="{{Auth::user()->wallet}}">
                    <span class="text-danger"><strong id="massageWallet1"></strong></span>
                </div>
            </div>
            <div class="card-footer">
                <button type="submit" class="btn btn-danger btn-block" onclick="rqWD()">penarikan Doge</button>
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
        if(nominal < 100) {
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