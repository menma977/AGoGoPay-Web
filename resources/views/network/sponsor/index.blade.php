@extends('layouts.master') 
@section('contentHeader')
<div class="container-fluid">
    <div class="row mb-2">
        <div class="col-sm-6">
            <h1>Sponsor</h1>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{ route('home') }}">Halaman Utama</a></li>
                <li class="breadcrumb-item">Sponsor</li>
            </ol>
        </div>
    </div>
</div>
@endsection
 
@section('content')
<style>
    ul.tree,
    ul.tree ul {
        list-style: none;
        margin: 0;
        padding: 0;
    }

    ul.tree ul {
        margin-left: 10px;
    }

    ul.tree li {
        margin: 0;
        padding: 0 7px;
        line-height: 20px;
        font-weight: bold;
        border-left: 1px solid rgb(100, 100, 100);

    }

    ul.tree li:last-child {
        border-left: none;
    }

    ul.tree li:before {
        position: relative;
        top: -0.3em;
        height: 1em;
        width: 12px;
        color: white;
        border-bottom: 1px solid rgb(100, 100, 100);
        content: "";
        display: inline-block;
        left: -7px;
    }

    ul.tree li:last-child:before {
        border-left: 1px solid rgb(100, 100, 100);
    }
</style>

<div class="table-responsive">
    <ul class="tree">
        <li>
            <span class="fa fa-plus-circle">
                {{ Auth::user()->username }}
            </span>
            <ul class="nested">
                @if (Auth::user()->userkiri)
                <li>
                    <a href="#" id="caret-{{ Auth::user()->userkiri }}" class="fa fa-plus-circle" onclick="addCaret('{{ Auth::user()->userkiri }}')">
                        {{ Auth::user()->userkiri }}
                    </a>
                    <div id="{{ Auth::user()->userkiri }}"></div>
                </li>
                @endif @if (Auth::user()->userkanan)
                <li>
                    <a href="#" id="caret-{{ Auth::user()->userkanan }}" class="fa fa-plus-circle" onclick="addCaret('{{ Auth::user()->userkanan }}')">
                        {{ Auth::user()->userkanan }}
                    </a>
                    <div id="{{ Auth::user()->userkanan }}"></div>
                </li>
                @endif
            </ul>
        </li>
    </ul>
</div>
@endsection
 
@section('afterScript')
<script>
    function addCaret(user) {
        document.getElementById('caret-' + user).className = "fa fa-minus-circle";
        var url = "{{ route('network.sponsor.get', '%data%') }}";
        url = url.replace('%data%', user);
        fetch(url, {
            method: 'GET',
            headers: new Headers({
                'Content-Type': 'application/x-www-form-urlencoded',
                "X-CSRF-TOKEN": $("input[name='_token']").val()
            }),
        }).then((response) => response.json()).then((responseData) => {
            var leftUser = '';
            var rightUser = '';
            if (responseData.leftUser) {
                leftUser = '<li>' +
                    '<a href="#" id="caret-' + responseData.leftUser +
                    '" class="fa fa-plus-circle" onclick="addCaret(`%data%`)">' +
                    responseData.leftUser +
                    '</a> <div id="' + responseData.leftUser + '"></div>' +
                    '</li>';
                leftUser = leftUser.replace('%data%', responseData.leftUser);
            }
            if (responseData.rightUser) {
                rightUser = '<li>' +
                    '<a href="#" id="caret-' + responseData.rightUser +
                    '" class="fa fa-plus-circle" onclick="addCaret(`%data%`)">' +
                    responseData.rightUser +
                    '</a> <div id="' + responseData.rightUser + '"></div>' +
                    '</li>';
                rightUser = rightUser.replace('%data%', responseData.rightUser);
            }
            var htmlBody = '<ul class="nested active">' + leftUser + ' ' + rightUser + '</ul>';
            document.getElementById(user).innerHTML = htmlBody;
        }).catch((error) => {
            // console.log(error);
        });
    }

</script>
@endsection