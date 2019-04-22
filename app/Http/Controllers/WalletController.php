<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\model\Ledger;
use App\model\WithdrawBonus;
use App\model\ListProfit;
use App\model\Rate;
use App\model\Redeem;
use App\model\LedgerRed;
use Carbon\Carbon;
use Auth;
use Mail;

class WalletController extends Controller
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
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $wdBon = Ledger::where('username', Auth::user()->username)->sum('kredit') - Ledger::where('username', Auth::user()->username)->sum('debet');
        $wdBon = number_format($wdBon, '2', '.', '');
        $code = rand(1000, 9999);
        $data = [
            'wdBon' => $wdBon,
            'code' => $code
        ];
        return view('withdraw.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'wdbone' => 'required',
            'withdraw' => 'required',
        ]);

        $url = "https://indodax.com/api/doge_idr/ticker ";
        $headers = array();
        $headers[] = "X-Auth-Token: api-key xxxxxxxxx";
        $state_ch = curl_init();
        curl_setopt($state_ch, CURLOPT_URL, $url);
        curl_setopt($state_ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($state_ch, CURLOPT_HTTPHEADER, $headers);
        $state_result = curl_exec($state_ch);
        $state_result = json_decode($state_result);
        $nilaiTransfer = number_format((($request->withdraw * Redeem::first()->doge) * Rate::where('rate', 'DEPOSIT')->first()->jml_rate) / $state_result->ticker->last, '8', '.', '');

        $ledger               = new Ledger();
        $ledger->notrx        = date("YmdHis");
        $ledger->tgl          = date('Y-m-d');
        $ledger->username     = Auth::user()->username;
        $ledger->ketkom       = 'BONUS';
        $ledger->debet        = $request->withdraw;
        $ledger->keterangan   = 'withdraw from ' . Auth::user()->username;
        $ledger->kredit       = 0;

        $LedgerRed               = new LedgerRed();
        $LedgerRed->notrx        = date("YmdHis");
        $LedgerRed->tgl          = date('Y-m-d');
        $LedgerRed->username     = Auth::user()->username;
        $LedgerRed->ketkom       = 'BONUS';
        $LedgerRed->debet        = 0;
        $LedgerRed->keterangan   = 'withdraw from ' . Auth::user()->username;
        $LedgerRed->kredit       = $request->withdraw * Redeem::first()->value;

        $wdBon              = new WithdrawBonus();
        $wdBon->notrx       = date("YmdHis");
        $wdBon->tgl         = date('Y-m-d');
        $wdBon->tglwd       = Carbon::now();
        $wdBon->username    = Auth::user()->username;
        $wdBon->nama        = Auth::user()->nama;
        $wdBon->transfer    = $nilaiTransfer;
        $wdBon->nilaicoin   = $request->withdraw * Redeem::first()->doge;
        $wdBon->ketkom      = 'BONUS';
        $wdBon->status      = 0;

        $listPackage = ListProfit::where('username', Auth::user()->username)->where('terwd', '>', 'withdraw')->first();
        $listPackage->withdraw = $listPackage->withdraw + $request->withdraw;

        $ledger->save();
        $LedgerRed->save();
        $wdBon->save();
        $listPackage->save();
        return redirect('home');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function email($code)
    {
        $user = Auth::user();
        $data = [
            'code' => $code,
            'user' => $user
        ];
        Mail::send('withdraw.email', $data, function ($message) use ($user) {
            $message->to($user->email, 'AGOGOPAY Confirm Code Withdraw')->subject('Confirm Code Withdraw');
            $message->from('admin@agogopay.com', 'AGOGOPAY');
        });
    }
}
