<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\model\Calonuser;
use App\model\Rate;
use App\model\Profit;
use App\model\Wallet;
use Auth;
use Crypt;
use Mail;
use Session;
use DB;
use App\model\Pin;
use Carbon\Carbon;

class GenealogiController extends Controller
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

    public function find($username) {
        $encryptUsername = Crypt::encrypt($username);
        return redirect('network/genealogi/'.$encryptUsername);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($username)
    {
        $localUsername    = Crypt::decrypt($username);
        $user             = User::where('username', $localUsername)->first();
        $usernameLeft     = Auth::user()->userkiri;
        $usernameRight    = Auth::user()->userkanan;
        $arrayDataSrc = [$usernameLeft, $usernameRight];
        $i = 0;
        while(true) {
            try{
                if($i % 2 == 0) {
                    $mirrorData_0 = User::where('username', $arrayDataSrc[$i])->first();
                    if($mirrorData_0) {
                        if($mirrorData_0->userkiri) {
                            if(!in_array($mirrorData_0->userkiri, $arrayDataSrc)) {
                                array_push($arrayDataSrc, $mirrorData_0->userkiri);
                            }
                        }
                        if($mirrorData_0->userkanan) {
                            if(!in_array($mirrorData_0->userkanan, $arrayDataSrc)) {
                                array_push($arrayDataSrc, $mirrorData_0->userkanan);
                            }
                        }
                    }
                } else {
                    $mirrorData_1 = User::where('username', $arrayDataSrc[$i])->first();
                    if($mirrorData_1) {
                        if($mirrorData_1->userkiri) {
                            if(!in_array($mirrorData_1->userkiri, $arrayDataSrc)) {
                                array_push($arrayDataSrc, $mirrorData_1->userkiri);
                            }
                        }
                        if($mirrorData_1->userkanan) {
                            if(!in_array($mirrorData_1->userkanan, $arrayDataSrc)) {
                                array_push($arrayDataSrc, $mirrorData_1->userkanan);
                            }
                        }
                    }
                }
            }catch(\Exception $e){
                //do noting
                // dump($e);
                break;
            }
            $i++;
        }
        if ($user->userkiri != null) {
            $user->userLeft = User::where('username', $user->userkiri)->first();
            if ($user->userLeft) {
                $user->userLeft->subUserLeft    = User::where('username', $user->userLeft->userkiri)->first();
                $user->userLeft->subUserRight   = User::where('username', $user->userLeft->userkanan)->first();
            } else {
                $user->userLeft->subUserLeft    = null;
                $user->userLeft->subUserRight   = null;
            }
        } else {
            $user->userLeft   = null;
        }
        if ($user->userkanan != null) {
            $user->userRight = User::where('username', $user->userkanan)->first();
            if ($user->userRight) {
                $user->userRight->subUserLeft   = User::where('username', $user->userRight->userkiri)->first();
                $user->userRight->subUserRight  = User::where('username', $user->userRight->userkanan)->first();
            } else {
                $user->userRight->subUserLeft   = null;
                $user->userRight->subUserRight  = null;
            }
        } else {
            $user->userRight  = null;
        }

        $userSession = Session::get('userLine');
        if ($userSession == null) {
            Session::push('userLine', Auth::user());
        } else {
            if (Auth::user()->id == $user->id) {
                Session::forget('userLine');
                Session::push('userLine', Auth::user());
            } else {
                if (!array_search($user, $userSession)) {
                    Session::push('userLine', $user);
                } else {
                    if (end($userSession) != $user) {
                        array_pop($userSession);
                        Session::put('userLine', $userSession);
                    }
                }
            }
        }

        $data = [
            'user' => $user,
            'arrayDataSrc' => $arrayDataSrc
        ];
        return view('network.genealogi.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($username, $posisi)
    {
        $user = User::where('username', Crypt::decrypt($username))->first();
        $pin = Pin::where('stokis', Auth::User()->username)->where('status', 1)->get();
        $profit = Profit::all();
        $data = [
            'upline' => $username,
            'position' => $posisi,
            'user' => $user,
            'profit' => $profit,
            'pin' => $pin
        ];
        return view('network.genealogi.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $username)
    {
        $this->validate($request, [
            'username' => 'required|string|max:255|unique:calonuser',
            'email' => 'required|email|max:255|unique:calonuser',
        ]);
        $this->validate($request, [
            'sponsor' => 'required|string|max:255',
            'name' => 'required|string|max:255',
            'phone' => 'required|numeric|min:11',
            'username' => 'required|string|max:255|unique:tb_users',
            'email' => 'required|email|max:255|unique:tb_users',
            'password' => 'required|string|max:255',
            'position' => 'required',
        ]);
        $validateUser = DB::table('tb_users')->where('username', $request->sponsor)->first();
        if (!$validateUser) {
            return back()->with("validateSponsor", 1);
        }
        if ($request->pin_1 != 0) {
            $pin_1 = Pin::where('id', $request->pin_1)->where('status', 1)->first();
            if (!$pin_1) {
                return back()->with("pin_1", 1);
            }
        } else {
            $pin_1 = null;
        }
        if ($request->pin_2 != 0) {
            $pin_2 = Pin::where('id', $request->pin_2)->where('status', 1)->first();
            if (!$pin_2) {
                return back()->with("pin_2", 1);
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

        $user = new Calonuser();
        $user->notrx              = date("YmdHis");
        $user->tgl                = date('Y-m-d');
        $user->tgldaftar          = date('Y-m-d H:i:s');
        $user->sponsor            = Auth::user()->username;
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
            $message->to($user->email, 'AGOGOPAY')->subject('Congratulations on your registration successfully!');
            $message->from('admin@agogopay.com', 'AGOGOPAY');
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

        return redirect('network/genealogi/' . $username);
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
