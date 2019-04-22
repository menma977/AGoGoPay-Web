<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use App\model\Calonuser;
use App\model\WithdrawBonus;
use App\model\ListProfit;
use Carbon\Carbon;

class HistoryController extends Controller
{
    public function reg(Request $request)
    {
        if (count($request->all())) {
            if ($request->date) {
                $getDate = $request->date;
                $date = explode('-', $request->date);
                $form = str_replace('/', '-', $date[0]);
                $to = str_replace('/', '-', $date[1]);
                $user = User::whereBetween('joindate', [$form, $to])->get();
                $user->map(function ($item, $key) {
                    if (ListProfit::where('username', $item->username)->first()) {
                        $item->freeUser = ListProfit::where('username', $item->username)->first()->free;
                    } else {
                        $item->freeUser = 1;
                    }
                    if (Calonuser::where('username', $item->username)->first()) {
                        $item->nilaiTransfer = Calonuser::where('username', $item->username)->first()->nilaitransfer;
                    } else {
                        $item->nilaiTransfer = 0;
                    }
                });
            } else {
                $getDate = null;
                $form = Carbon::now()->format('Y-m-d');
                $to = Carbon::now()->format('Y-m-d');
                $user = User::whereBetween('joindate', [$form, $to])->get();
                $user->map(function ($item, $key) {
                    if (ListProfit::where('username', $item->username)->first()) {
                        $item->freeUser = ListProfit::where('username', $item->username)->first()->free;
                    } else {
                        $item->freeUser = 1;
                    }
                    if (Calonuser::where('username', $item->username)->first()) {
                        $item->nilaiTransfer = Calonuser::where('username', $item->username)->first()->nilaitransfer;
                    } else {
                        $item->nilaiTransfer = 0;
                    }
                });
            }
        } else {
            $getDate = null;
            $form = Carbon::now()->format('Y-m-d');
            $to = Carbon::now()->format('Y-m-d');
            $user = User::whereBetween('joindate', [$form, $to])->get();
            $user->map(function ($item, $key) {
                if (ListProfit::where('username', $item->username)->first()) {
                    $item->freeUser = ListProfit::where('username', $item->username)->first()->free;
                } else {
                    $item->freeUser = 1;
                }
                if (Calonuser::where('username', $item->username)->first()) {
                    $item->nilaiTransfer = Calonuser::where('username', $item->username)->first()->nilaitransfer;
                } else {
                    $item->nilaiTransfer = 0;
                }
            });
        }
        $data = [
            'user' => $user,
            'date' => $getDate
        ];
        return view('admin.history.reg', $data);
    }

    public function wd(Request $request)
    {
        if (count($request->all())) {
            if ($request->date) {
                $getDate = $request->date;
                $date = explode('-', $request->date);
                $form = str_replace('/', '-', $date[0]);
                $to = str_replace('/', '-', $date[1]);
                $user = WithdrawBonus::whereBetween('tglwd', [$form, $to])->get();
                $user->map(function ($item, $key) {
                    $item->data = User::where('username', $item->username)->first();
                    $item->dataSub = Calonuser::where('username', $item->username)->first();
                });
            } else {
                $getDate = null;
                $form = Carbon::now()->format('Y-m-d');
                $to = Carbon::now()->format('Y-m-d');
                $user = WithdrawBonus::whereBetween('tglwd', [$form, $to])->get();
                $user->map(function ($item, $key) {
                    $item->data = User::where('username', $item->username)->first();
                    $item->dataSub = Calonuser::where('username', $item->username)->first();
                });
            }
        } else {
            $getDate = null;
            $form = Carbon::now()->format('Y-m-d');
            $to = Carbon::now()->format('Y-m-d');
            $user = WithdrawBonus::whereBetween('tglwd', [$form, $to])->get();
            $user->map(function ($item, $key) {
                $item->data = User::where('username', $item->username)->first();
                $item->dataSub = Calonuser::where('username', $item->username)->first();
            });
        }
        $data = [
            'user' => $user,
            'date' => $getDate
        ];
        return view('admin.history.wd', $data);
    }
}
