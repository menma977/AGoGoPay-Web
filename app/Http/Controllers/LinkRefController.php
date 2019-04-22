<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\model\Calonuser;
use App\model\Wallet;
use App\model\Pin;
use DB;
use Mail;
use Session;
use Carbon\Carbon;
use App\model\Profit;
use Request as rqs;

class LinkRefController extends Controller
{
    /**
     * Get username property.
     *
     * @return string
     */
    public function validates(Request $request)
    {
        if (Calonuser::where('username', $request->username)->where('status', 0)->count()) {
            $calon = Calonuser::where('username', $request->username)->where('status', 0)->first();
            if ($calon->password_mirror == $request->password) {
                $wallet = Wallet::get()->first();
                $data = [
                    'user' => $calon,
                    'wallet' => $wallet
                ];
                return view('validateTransfer', $data);
            } else {
                return back()->with("validate", 1);
            }
        } else if (User::where('username', $request->username)->count()) {
            $user = User::where('username', $request->username)->first();
            if ($user->password_mirror == $request->password) {
                $data = [
                    'username' => $request->username,
                    'password' => $request->password,
                ];
                return view('auth.byPass', $data);
            } else {
                return back()->with("validate", 1);
            }
        } else {
            return back()->with("validate", 1);
        }
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($ref)
    {
        if ($ref != 'codex') {
            $user = $ref;
            $dataUser = User::where('username', $user)->first();
        } else {
            $user = null;
            $dataUser = null;
        }
        $data = [
            'linkUsername' => $user,
            'dataUser' => $dataUser
        ];
        return view('auth.link', $data);
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
            'sponsor' => 'required|string|max:255',
            'name' => 'required|string|max:255',
            'phone' => 'required|numeric|min:11',
            'username' => 'required|string|max:255|unique:tb_users|unique:calonuser',
            'email' => 'required|email|max:255|unique:tb_users|unique:calonuser',
            'password' => 'required|string|max:255',
            'bank' => 'required',
            'norek' => 'required',
            'position' => 'required',
        ]);
        $validateUser = DB::table('tb_users')->where('username', $request->sponsor)->first();
        if (!$validateUser) {
            return back()->with("validateSponsor", 1);
        }
        if ($request->pin_1) {
            $pin_1 = Pin::where('pin', $request->pin_1)->where('status', 1)->first();
            if (!$pin_1) {
                return back()->with("pin_1", 1);
            } else {
                $package = Profit::find(1)->joins;
            }
        } else {
            $pin_1 = null;
        }
        if ($request->pin_2) {
            $pin_2 = Pin::where('pin', $request->pin_2)->where('status', 1)->first();
            if (!$pin_2) {
                return back()->with("pin_2", 1);
            } else {
                $package = Profit::find(2)->joins;
            }
        } else {
            $pin_2 = null;
        }

        if ($pin_1 && $pin_2) {
            $package = Profit::find(2)->joins;
        } else {
            $package = Profit::find(1)->joins;
        }

        $random = rand(100, 999);
        $nilaiTransfer = $package;
        $nilaiTransfer = $nilaiTransfer + $random;

        $user                     = new Calonuser();
        $user->notrx              = date("YmdHis");
        $user->tgl                = date('Y-m-d');
        $user->tgldaftar          = date('Y-m-d H:i:s');
        $user->sponsor            = $request->sponsor;
        $user->upline             = $request->sponsor;
        $user->username           = $request->username;
        $user->password           = bcrypt($request->password);
        $user->password_mirror    = $request->password;
        $user->email              = $request->email;
        $user->nama               = $request->name;
        $user->nohp               = $request->phone;
        $user->posisi             = $request->position;
        $user->paket              = $package;
        $user->bank               = $request->bank;
        $user->norek              = $request->norek;
        $user->nilaitransfer      = $nilaiTransfer;

        if ($pin_1) {
            $pin_1->tglpakai = Carbon::now()->format('Y-m-d');
            $pin_1->username = $user->username;
            $pin_1->status = 2;
            $pin_1->save();
        }

        if ($pin_2) {
            $pin_2->tglpakai = Carbon::now()->format('Y-m-d');
            $pin_2->username = $user->username;
            $pin_2->status = 2;
            $pin_2->save();
        }

        $user->save();

        $data = [
            'user' => $user,
            'wallet' => wallet::first(),
        ];
        Mail::send('auth.mail', $data, function ($message) use ($user) {
            $message->to($user->email, 'Agogo')->subject('Congratulations on your registration successfully!');
            $message->from('admin@agogopay.com', 'Agogo');
        });
        $wallet = Wallet::get()->first();
        Session::put('emailSubject', 'Hello ' . $user->nama);
        $message = '<p><b>-Hai ' . $user->nama . '-</b></p>
            <p>Silahkan Transfer ke BANK <b>' . $wallet->bank . '</b> sebelum tanggal (<b>' . Carbon::parse($user->created_at)->addDays(3) . '</b>)</p>
            <div>
                Nama
                <div class="float-right">' . $wallet->name . '</div>
            </div>
            <div>
                Nomor Rekening
                <div class="float-right">' . $wallet->wallet . '</div>
            </div>
            <div>
                Nilai Teransfer Sejumlah
                <div class="float-right">Rp ' . number_format($user->nilaitransfer, 2, ',', '.') . ' </div>
            </div>';
        Session::put('emailDescription', $message);

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

    public function sendView()
    {
        return view('auth.sendPass');
    }

    public function sendPass(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email|max:255',
        ]);
        $user = User::where('email', $request->email)->first();
        if ($user) {
            $data = [
                'user' => $user
            ];
            Mail::send('user.passMail', $data, function ($message) use ($user) {
                $message->to($user->email, 'AGOGOPAY Confirm Code Password')->subject('Your Password');
                $message->from('admin@agogopay.com', 'AGOGOPAY');
            });
            return redirect('login');
        } else {
            return back()->with("validate", 1);
        }
    }
}
