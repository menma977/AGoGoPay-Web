<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\model\Calonuser;
use App\model\Profit;
use App\model\Rate;
use App\model\Wallet;
use Auth;
use Mail;
use Crypt;
use Session;

class ReInvestController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $profit = Profit::all();
        $data = [
            'profit' => $profit,
        ];
        return view('reInvest.index', $data);
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
            'package' => 'required',
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
        $random = rand(0, 9999) * 0.00000001;
        $nilaiTransfer = ($request->package * Rate::where('rate', 'DEPOSIT')->first()->jml_rate) / $state_result->ticker->last;
        $nilaiTransfer = $nilaiTransfer + $random;

        $user                     = new Calonuser();
        $user->notrx              = date("YmdHis");
        $user->tgl                = date('Y-m-d');
        $user->tgldaftar          = date('Y-m-d H:i:s');
        $user->sponsor            = Auth::User()->sponsor;
        $user->upline             = Auth::User()->upline;
        $user->username           = Auth::User()->username;
        $user->password           = bcrypt(Auth::User()->password_mirror);
        $user->password_mirror    = Auth::User()->password_mirror;
        $user->email              = Auth::User()->email;
        $user->nama               = Auth::User()->name;
        $user->nohp               = Auth::User()->phone;
        $user->posisi             = Auth::User()->position;
        $user->paket              = Auth::User()->package;
        $user->reinvest           = 1;
        $user->nilaitransfer      = number_format($nilaiTransfer, 8, '.', '');
        $user->save();

        $data = [
            'user' => $user,
            'wallet' => Wallet::first(),
        ];
        Mail::send('auth.mail', $data, function ($message) use ($user) {
            $message->to($user->email, 'AGOGOPAY')->subject('Congratulations on your registration successfully!');
            $message->from('admin@agogopay.com', 'AGOGOPAY');
        });
        Session::put('emailSubject', 'Hello ' . $user->nama);
        Session::put('emailDescription', ' please transfer doge by ' . $user->nilaitransfer . ' to wallet ' . wallet::first()->wallet);
        Auth::logout();
        return redirect('login');
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
}
