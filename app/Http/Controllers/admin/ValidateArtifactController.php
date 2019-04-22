<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\model\Calonuser;
use Session;
use DB;

class ValidateArtifactController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(Session::get('user')) {
            $user =  DB::table('tb_users_admin')->where('id', Session::get('user')->id)->first();
            $calonUser = Calonuser::where('status', 0)->get();
            $data = [
                'calonUser' => $calonUser,
                'user' => $user
            ];
            return view('admin.validate.index', $data);
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
        if(Session::get('user')) {
            $calonUser = Calonuser::find($id);
            $data = [
                'calonUser' => $calonUser
            ];
            return view('admin.validate.edit', $data);
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
    public function update($id)
    {
        if(Session::get('user')) {
            $calonUser = Calonuser::find($id);
            $calonUser->status = 1;
            $calonUser->save();
            return redirect()->back();
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
    public function free($id)
    {
        if(Session::get('user')) {
            $calonUser = Calonuser::find($id);
            $calonUser->status = 1;
            $calonUser->free = 1;
            $calonUser->save();
            return redirect()->back();
        } else {
            return redirect('login');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Calonuser::destroy($id);
        return redirect()->back();
    }
}
