<?php

namespace App\Http\Controllers;

use App\Helpers\Helper;
use App\Models\Absensi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function index() {
        $lokasikantor = Helper::lokasiKantor();
        $lock = explode(', ', $lokasikantor); 
        $lat = $lock[0];
        $long = $lock[1];
        $data = Absensi::where('user_id', '=', Auth::user()->id)->orderBy('tanggal')->get();
        return view('user.dashboard', compact('data','lat','long'));
    }


}
