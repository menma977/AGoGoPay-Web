<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\model\WithdrawBonus;
use App\model\Ledger;
use App\User;
use Carbon\Carbon;

class WithdrawController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function indexBonus()
    {
        $wdBon = WithdrawBonus::where('status', 0)->get();
        if($wdBon) {
            $wdBon->map(function($item, $key) {
                $item->user = User::where('username', $item->username)->first();
            });
        }
        $data = [
            'wdbon' => $wdBon
        ];
        return view('admin.withdraw.bonus.index', $data);
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user = User::all();
        $data = [
            'user' => $user
        ];
        return view('admin.withdraw.debet.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $ledger = new Ledger();
        $ledger->notrx = Carbon::now()->format('YmdHis');
        $ledger->tgl = $request->tgl;
        $ledger->username = $request->username;
        $ledger->keterangan = $request->keterangan;
        $ledger->debet = $request->nominal;
        $ledger->save();
        return redirect()->back();
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
    public function updateBonus(Request $request, $id)
    {
        $wdbon = WithdrawBonus::find($id);
        $wdbon->Status = 1;
        $wdbon->save();
        return redirect()->back();
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
}
