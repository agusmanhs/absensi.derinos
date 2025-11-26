<?php

namespace App\Http\Controllers;

use App\Models\Absensi;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    public function index() {
        $tanggal = gmdate('Y-m-d', time()+ (60 * 60 * 8));

        $absen = User::leftJoin('absensis as b', function($join) use ($tanggal) {
            $join->on('users.id', '=', 'b.user_id')
                ->whereDate('b.tanggal', '=', $tanggal);
            })
        ->select('users.*', 'b.*')
        ->get();

        $riwayat = DB::table('absensis')
        ->join('users', 'absensis.user_id', '=', 'users.id')
        ->select('users.name', 'absensis.*')
        ->orderBy('absensis.tanggal', 'desc')
        ->get();

        return view('admin.dashboard', compact('absen', 'riwayat'));
    }


    public function terimaizin(Request $request)
    {
        $request->validate([
            'alasan'  => ['required', 'string'],

        ]);
        $tanggal = gmdate('Y-m-d', time() + (60 * 60 * 8));


        $hadir = Absensi::where('user_id', '=', $request->user_id)->where('tanggal', '=', $tanggal)->first();
        // dd($hadir);
        $izin = Absensi::findOrFail($hadir->id);
            $izin->status = $request->alasan;
            $izin->update();


        return redirect()->route('admin.dashboard');     
    }
}
