<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\model\Calonuser;
use App\model\WithdrawBonus;
use Session;
use DB;
use Auth;
use DateTime;
use DatePeriod;
use DateInterval;
use Carbon\Carbon;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function login()
    {
        dump(Auth::user());
        if(Auth::user()) {
            return redirect('home');
        } else {
            return view('admin.login');
        }
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function validates(Request $request)
    {
        $username = $request->username;
        $password = $request->password;
        $user = DB::table('tb_users_admin')->where('username', $username)->where('password', $password)->first();
        if($user) {
            Session::put('user', $user);
            return redirect('adminDump');
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
        if(Auth::user()) {
            return redirect('home');
        } else if(Session::get('user')) {
            $totalUser        = User::count();
            $totalUserToday   = User::where('joindate', Carbon::now()->format('Y-m-d'))->count();
            $userX            = Calonuser::count();
            $halfUser         = [];
            $wdBon            = [];
            $begin            = Carbon::now()->subDays(30);
            $end              = Carbon::now();
            $interval         = DateInterval::createFromDateString('1 day');
            $period           = new DatePeriod($begin, $interval, $end);
            $key              = 0;
            foreach ($period as $date) {
                $seeInfest = Calonuser::whereDate('tgl', $date->format('Y-m-d'))->get();
                if($seeInfest) {
                    $halfUser[$key] = ['date'=> $date->format('Y-m-d'), 'paket'=> $seeInfest->sum('paket')];
                } else {
                    $halfUser[$key] = ['date'=> $date->format('Y-m-d'), 'paket'=> 0];
                }
                $seeWD = WithdrawBonus::whereDate('tglwd', $date->format('Y-m-d'))->get();
                if($seeWD) {
                    $wdBon[$key] = ['date'=> $date->format('Y-m-d'), 'nilaicoin'=> $seeWD->sum('nilaicoin')];
                } else {
                    $wdBon[$key] = ['date'=> $date->format('Y-m-d'), 'nilaicoin'=> 0];
                }
                $key++;
            }
            $data = [
                'totalUser' => $totalUser,
                'totalUserToday' => $totalUserToday,
                'userX' => $userX,
                'halfUser' => $halfUser,
                'wdBon' => $wdBon,
                'date' => Carbon::now()->subDays(30)->format('Y/m/d').' - '.Carbon::now()->format('Y/m/d')
            ];
            return view('admin.index', $data);
        } else {
            return view('admin.login');
        }
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function find(Request $request)
    {
        if(Auth::user()) {
            return redirect('home');
        } else if(Session::get('user')) {
            $getDate = $request->date;
            if($getDate) {
                $date = explode('-', $request->date);
                $from = str_replace('/', '-', $date[0]);
                $to = str_replace('/', '-', $date[1]);
            } else {
                $from = Carbon::now()->format('Y-m-d');
                $to = Carbon::now()->format('Y-m-d');
            }
            $totalUser        = User::count();
            $totalUserToday   = User::where('joindate', Carbon::now()->format('Y-m-d'))->count();
            $userX            = Calonuser::count();
            $halfUser         = [];
            $wdBon            = [];
            $begin            = new DateTime($from);
            $end              = new DateTime($to);
            $interval         = DateInterval::createFromDateString('1 day');
            $period           = new DatePeriod($begin, $interval, $end);
            $key              = 0;
            foreach ($period as $date) {
                $seeInfest = Calonuser::whereDate('tgl', $date->format('Y-m-d'))->get();
                if($seeInfest) {
                    $halfUser[$key] = ['date'=> $date->format('Y-m-d'), 'paket'=> $seeInfest->sum('paket')];
                } else {
                    $halfUser[$key] = ['date'=> $date->format('Y-m-d'), 'paket'=> 0];
                }
                $seeWD = WithdrawBonus::whereDate('tglwd', $date->format('Y-m-d'))->get();
                if($seeWD) {
                    $wdBon[$key] = ['date'=> $date->format('Y-m-d'), 'nilaicoin'=> $seeWD->sum('nilaicoin')];
                } else {
                    $wdBon[$key] = ['date'=> $date->format('Y-m-d'), 'nilaicoin'=> 0];
                }
                $key++;
            }
            $data = [
                'totalUser' => $totalUser,
                'totalUserToday' => $totalUserToday,
                'userX' => $userX,
                'halfUser' => $halfUser,
                'wdBon' => $wdBon,
                'date' => Carbon::parse($from)->format('Y/m/d').' - '.Carbon::parse($to)->format('Y/m/d')
            ];
            return view('admin.index', $data);
        } else {
            return view('admin.login');
        }
    }
}
