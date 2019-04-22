<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\model\Profit;
use Session;
use DB;

class InputProfitController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Session::get('user')) {
            $profit = Profit::all();
            $admin = DB::table('tb_users_admin')->where('id', Session::get('user')->id)->first();
            $data = [
                'profit' => $profit,
                'admin' => $admin
            ];
            return view('admin.inputProfit.index', $data);
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
        if (Session::get('user')) {
            $profit = Profit::find($id);

            $data = [
                'profit' => $profit,
            ];
            return view('admin.inputProfit.edit', $data);
        } else {
            return redirect('login');
        }
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
            'join' => 'required|numeric',
            'sponsor' => 'required|numeric',
            'pairing' => 'required|numeric',
            'day' => 'required|numeric',
        ]);

        $profit = Profit::find($id);
        $profit->sponsor = $request->sponsor / 100;
        $profit->pairing = $request->pairing / 100;
        $profit->day = $request->day;
        $profit->save();
        return redirect('adminDump/profit');
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
