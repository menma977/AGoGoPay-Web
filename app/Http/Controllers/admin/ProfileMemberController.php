<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use Session;
use DB;

class ProfileMemberController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = User::all();
        $data = [
            'user' => $user
        ];
        return view('admin.profileMember.index', $data);
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
        $user = User::find($id);
        $dbUser = User::all();
        $userLine[0] = $dbUser->where('username', $user->username)->first();
        $line = 0;
        $line1 = 1;
        while (true) {
            try {
                $userLineTry[$line1] = $dbUser->where('upline', $userLine[$line]->upline)->first();
                if ($userLineTry[$line1] == null) {
                    $userLine[$line1] = $dbUser->where('username', $userLine[$line]->upline)->first();
                    break;
                } else {
                    $userLineTry[$line1] = $dbUser->where('username', $userLine[$line]->upline)->first();
                    if ($userLineTry[$line1] == null) {
                        break;
                    } else {
                        $userLine[$line1] = $dbUser->where('username', $userLine[$line]->upline)->first();
                        $line++;
                        $line1++;
                    }
                }
            } catch (\Throwable $th) {
                break;
            }
        }
        $admin = DB::table('tb_users_admin')->where('id', Session::get('user')->id)->first();
        $data = [
            'user' => $user,
            'admin' => $admin,
            'userLine' => $userLine,
            'line' => $line1
        ];
        return view('admin.profileMember.show', $data);
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
        $user = user::find($id);
        $user->paket = $request->paket;
        $user->wallet = $request->wallet;
        $user->nama = $request->nama;
        $user->phone = $request->phone;
        $user->email = $request->email;
        $user->joindate = $request->join;
        $user->suspend = $request->suspend;
        $user->save();
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
