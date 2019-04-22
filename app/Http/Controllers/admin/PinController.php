<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use App\model\Pin;
use App\model\ReOrderPin;
use Session;

class PinController extends Controller
{
    public function index()
    {
        if (Session::get('user')) {
            $user         = User::all();
            $reOrderPin   = ReOrderPin::all();
            $activePin    = Pin::where('status', '!=', 0)->get();
            $data = [
                'user' => $user,
                'reOrderPin' => $reOrderPin,
                'activePin' => $activePin
            ];
        } else {
            return redirect('login');
        }

        return view('admin.pin.index', $data);
    }

    public function activate($id, $status)
    {
        $reOrderPin   = ReOrderPin::find($id);
        $reOrderPin->status = $status;
        $reOrderPin->save();
        return redirect()->back();
    }

    public function deleteReOrder($id)
    {
        ReOrderPin::destroy($id);
        return redirect()->back();
    }

    public function changeOwnerPin(Request $request)
    {
        $this->validate($request, [
            'pin' => 'required',
            'username' => 'required',
        ]);
        $pin          = Pin::where('status', 0)->take(20)->get();
        $user           = User::find($request->username);
        foreach($pin as $key => $item) {
            $item->stokis   = $user->username;
            $item->status    = 1;
            $item->save();
        }
        return redirect()->back();
    }
}
