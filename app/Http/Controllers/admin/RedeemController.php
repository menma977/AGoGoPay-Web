<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\model\Redeem;
use App\model\LedgerRed;
use App\User;
use Session;
use DB;

class RedeemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(Session::get('user')) {
            $redeem = Redeem::get()->first();
            $admin = DB::table('tb_users_admin')->where('id', Session::get('user')->id)->first();
            $data = [
                'redeem' => $redeem,
                'admin' => $admin
            ];
            return view('admin.redeem.index', $data);
        } else {
            return redirect('login');
        }
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
        return view('admin.redeem.PayRedeemBonus', $data);
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
            'username' => 'required',
            'nominal' => 'required|numeric',
        ]);

        $LedgerRed               = new LedgerRed();
        $LedgerRed->notrx        = date("YmdHis");
        $LedgerRed->tgl          = date('Y-m-d');
        $LedgerRed->username     = $request->username;
        $LedgerRed->ketkom       = 'BONUS';
        $LedgerRed->debet        = $request->nominal;
        $LedgerRed->keterangan   = 'BONUS From Admin';
        $LedgerRed->kredit       = 0;
        $LedgerRed->save();

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
        $ledgerRed = LedgerRed::where('id', $id)->first();
        $data = [
            'ledgerRed' => $ledgerRed
        ];
        return $data;
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
        $this->validate($request, [
            'doge' => 'required|numeric',
            'value' => 'required|numeric',
        ]);
        $redeem = Redeem::find($id);
        $redeem->value = $request->value / 100;
        $redeem->doge = $request->doge / 100;
        $redeem->save();
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

    public function findUser($username) 
    {
        $ledgerRed = LedgerRed::where('username', $username)->where('debet', '!=', '0')->where('kredit', '0')->get();
        foreach($ledgerRed as $key => $item) {
            $data[$key] = [
                $key + 1,
                $item->tgl,
                $item->keterangan,
                $item->debet,
                $item->kredit,
                '<a class="btn btn-block btn-danger" href="#" data-toggle="modal" data-target="#modal-default1" onclick="editRedeem('.$item->id.')">Edit</a>'
            ];
        }
        return $data;
    }

    public function updateRedeem(Request $request)
    {
        $this->validate($request, [
            'editNominal' => 'required|numeric',
        ]);
        $ledgerRed = LedgerRed::where('id', $request->id)->first();
        $ledgerRed->debet = $request->editNominal;
        $ledgerRed->save();
        return redirect()->back();
    }
}
