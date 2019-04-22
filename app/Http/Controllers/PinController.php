<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Auth;
use Session;
use App\model\Pin;
use App\model\ReOrderPin;
use Carbon\Carbon;

class PinController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function validates(Request $request, $type)
    {
        if ($request->password == Auth::user()->password_mirror) {
            if ($type == 1) {
                $this->validate($request, [
                    'password' => 'required',
                    'valuePin' => 'required|numeric',
                ]);
                $reorderPin = new ReOrderPin();
                $reorderPin->notrx = Carbon::now()->format('Ymdhis');
                $reorderPin->kodeproduk = 0;
                $reorderPin->expedisi = 0;
                $reorderPin->noseri = Carbon::now()->format('Ymdhis');
                $reorderPin->tglreal = Carbon::now();
                $reorderPin->tgl = Carbon::now()->format('Y-m-d');
                $reorderPin->username = Auth::user()->username;
                $reorderPin->paket = $request->valuePin;
                $reorderPin->jmlbayar = (String)((100000 * $request->valuePin) + rand(111, 999));
                $reorderPin->status = '0';
                $reorderPin->save();
                return redirect()->back();
            } else if ($type == 2) {
                return redirect('pin');
            } else {
                Session::put('error', 'Type tidak cocok dalam data kami');
                return redirect()->back();
            }
        } else {
            Session::put('error', 'Maaf Password yang anda masukan salah');
            return redirect()->back();
        }
    }

    public function index()
    {
        $pinActive    = Pin::where('stokis', Auth::user()->username)->where('status', 1)->get();
        $pin          = Pin::where('stokis', Auth::user()->username)->orderBy('tglpakai', 'desc')->get();
        $reorderPin   = ReOrderPin::where('username', Auth::user()->username)->get();
        $data = [
            'pinActive' => $pinActive,
            'pin' => $pin,
            'reorderPin' => $reorderPin
        ];
        return view('pin.index', $data);
    }

    public function edit($idPin)
    {
        $pin = Pin::find($idPin);
        $user = User::where('username', '!=', Auth::user()->username)->get();
        $data = [
            'pin' => $pin,
            'user' => $user
        ];
        return view('pin.edit', $data);
    }

    public function update(Request $request)
    {
        $this->validate($request, [
            'pin' => 'required',
            'username' => 'required',
        ]);
        $pin = Pin::find($request->pin);
        $user = User::find($request->username);
        $pin->stokis = $user->username;
        $pin->save();
        return redirect('pin');
    }
}
