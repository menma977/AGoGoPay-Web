<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\model\Ledger;
use App\model\ListProfit;
use App\model\Profit;
use App\model\Calonuser;
use App\model\Pin;
use Auth;
use Request as Req;
use App\model\ReOrderPin;
use App\model\Wallet;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "http://36.91.157.188/trxxagogo/ceksaldo.php");
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, "nohp=" . Auth::user()->username . "&agen=" . Auth::user()->username . "&pin=1234");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $result = curl_exec($ch);
        curl_close($ch);
        $pin          = Pin::where('stokis', Auth::user()->username)->where('status', 1)->orderBy('tglpakai', 'desc')->get();
        $reorderPin   = ReOrderPin::where('username', Auth::user()->username)->get();
        $wallet       = Wallet::first();
        $refUlr       = Req::root() . '/link/ref/' . Auth::user()->username;
        $profit       = $result ? str_replace('.', '', $result) : 0;
        $statusForBot = Profit::find(2)->joins;
        if (Auth::user()->username999 && Auth::user()->pasword999) {
            $curl   = curl_init();
            $url    = 'https://www.999doge.com/api/web.aspx';
            $body   = [
                'a' => 'Login',
                'Key' => '3fb940c11aeb45cda5adc14503dff818',
                'Username' => Auth::user()->username999,
                'Password' => Auth::user()->pasword999,
                'Totp' => ''
            ];
            curl_setopt($curl, CURLOPT_URL, $url);
            curl_setopt($curl, CURLOPT_POST, true);
            curl_setopt($curl, CURLOPT_POSTFIELDS, $body);
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0);
            curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 0);
            $result = curl_exec($curl);
            curl_close($curl);
            $bonus = json_decode($result, true)['Doge']['Balance'] * 0.00000001;
        } else {
            $bonus = 0;
        }
        $allBonus = Ledger::where('username', Auth::user()->username)->sum('kredit') - Ledger::where('username', Auth::user()->username)->sum('debet');
        $halfUser = Calonuser::where('username', Auth::user()->username)->first();
        if ($halfUser) {
            $listProfit = ListProfit::where('username', Auth::user()->username)->first();
            if ($listProfit) {
                $listProfit->profit         = Profit::where('joins', $listProfit->paket)->first();
                $listProfit->countPacked    = number_format(($listProfit->profit->joins * $listProfit->profit->roi), '8', '.', '');
            } else {
                $listProfit = null;
            }
        } else {
            $listProfit = null;
        }

        $data = [
            'refUrl' => $refUlr,
            'profit' => $profit,
            'bonus' => $bonus,
            'allBonus' => $allBonus,
            'listProfit' => $listProfit,
            'userC' => $halfUser,
            'pin' => $pin,
            'reorderPin' => $reorderPin,
            'wallet' => $wallet,
            'statusForBot' => $statusForBot
        ];
        return view('home', $data);
    }

    public function doge() {
        return view('doge');
    }

    public function getProfit(Request $request)
    {
        $listProfit             = ListProfit::where('username', Auth::user()->username)->first();
        $listProfit->tercapai   = $listProfit->tercapai + $request->profit;
        $ledger                 = new Ledger();
        $ledger->notrx          = date("YmdHis");
        $ledger->tgl            = date('Y-m-d');
        $ledger->username       = Auth::user()->username;
        $ledger->ketkom         = 'PROFIT';
        $ledger->debet          = 0;
        $ledger->keterangan     = 'Profit Bonus ' . Auth::user()->username . ' from ' . $listProfit->paket;
        $ledger->kredit         = $request->profit;
        $listProfit->save();
        $ledger->save();
        return redirect()->back();
    }

    public function depositDOGE()
    {
        $curl   = curl_init();
        $url    = 'https://agogopay.com/api/index.php';
        $body   = [
            'a' => 'DepositSuck',
            'username' => Auth::user()->username,
        ];
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $body);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 0);
        $result = curl_exec($curl);
        curl_close($curl);
        return json_decode($result, true);
    }

    public function wdDOGE(Request $request)
    {
        $curl   = curl_init();
        $url    = 'https://agogopay.com/api/index.php';
        $body   = [
            'a' => 'RequestWD',
            'username' => Auth::user()->username,
            'nominal' => $request->nominal,
            'wallet' => $request->wallet,
        ];
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $body);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 0);
        $result = curl_exec($curl);
        curl_close($curl);
        return json_decode($result, true);
    }

    public function finalDOGE(Request $request)
    {
        $curl   = curl_init();
        $url    = 'https://agogopay.com/api/index.php';
        $body   = [
            'a' => 'WDFinal',
            'username' => Auth::user()->username,
            'nominal' => $request->nominal,
            'wallet' => $request->wallet,
            'kodeunik' => $request->code,
        ];
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $body);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 0);
        $result = curl_exec($curl);
        curl_close($curl);
        return json_decode($result, true);
    }
}
