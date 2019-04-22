<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\model\Rate;
use Session;
use DB;

class InputRateController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(Session::get('user')) {
            $deposit = Rate::where('rate', 'DEPOSIT')->first();
            $withdraw = Rate::where('rate', 'WITHDRAW')->first();
            $admin = DB::table('tb_users_admin')->where('id', Session::get('user')->id)->first();
            $data = [
                'deposit' => $deposit->jml_rate,
                'withdraw' => $withdraw->jml_rate,
                'admin' => $admin
            ];
            return view('admin.inputRate.index', $data);
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
        //
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
    public function update(Request $request, $id, $id1)
    {
        $this->validate($request, [
            'deposit' => 'required|numeric',
            'withdraw' => 'required|numeric',
        ]);
        $deposit = Rate::find($id);
        $deposit->jml_rate = $request->deposit;
        $deposit->save();
        $withdraw = Rate::find($id1);
        $withdraw->jml_rate = $request->withdraw;
        $withdraw->save();
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
