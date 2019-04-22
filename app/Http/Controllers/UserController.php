<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use Crypt;
use Mail;
use Session;
use Auth;

class UserController extends Controller
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
        $code = rand(1000, 9999);
        Session::put('emailCode', $code);
        if (Auth::user()->username999 && Auth::user()->pasword999) {
            $curl = curl_init();
            $url = 'https://www.999doge.com/api/web.aspx';
            $body = [
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
            $result =  json_decode(curl_exec($curl), true);
            curl_close($curl);
            if (count($result) <= 2) {
                $doge = '1';
            } else {
                $doge = $result['Doge']['Balance'] * 0.00000001;
            }
        } else {
            $doge = '0';
        }
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "http://36.91.157.188/trxxagogo/ceksaldo.php");
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, "nohp=" . Auth::user()->username . "&agen=" . Auth::user()->username . "&pin=1234");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $result = curl_exec($ch);
        curl_close($ch);
        if ($result) {
            $balance = str_replace('.', '', $result);
        } else {
            $balance = 0;
        }
        $data = [
            'doge' => $doge,
            'balance' => $balance
        ];
        return view('user.index', $data);
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
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function editPassword($id, $code)
    {
        if (Session::get('emailCode') == $code) {
            $user = User::find($id);
            $data = [
                'user' => $user,
            ];
            return view('user.edit', $data);
        } else {
            return redirect()->back();
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
            'name' => 'required',
            'email' => 'required',
            'phone' => 'required',
        ]);
        $user = User::find($id);
        $user->nama = $request->name;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->save();
        return redirect()->back();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updatePassword(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required',
            'norek' => 'required',
            'bank' => 'required',
            'password' => 'required',
            'password' => 'required',
        ]);
        $user                     = User::find($id);
        $user->nama               = $request->name;
        $user->norek              = $request->norek;
        $user->bank               = $request->bank;
        $user->phone              = $request->phone;
        $user->password           = bcrypt($request->password);
        $user->password_mirror    = $request->password;
        $user->save();
        return redirect('user');
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
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function email($id)
    {
        $user = User::find($id);
        $data = [
            'emailCode' => Session::get('emailCode'),
            'user' => $user
        ];
        return view('user.confirmationEmail', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function sendEmail($id)
    {
        $user = User::find($id);
        $data = [
            'emailCode' => Session::get('emailCode'),
            'user' => $user
        ];
        Mail::send('user.mail', $data, function ($message) use ($user) {
            $message->to($user->email, 'AGOGOPAY Confirm Code Password')->subject('Confirm Code Password');
            $message->from('admin@agogopay.com', 'AGOGOPAY');
        });
        return redirect()->back();
    }
}
