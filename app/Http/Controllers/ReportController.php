<?php

namespace App\Http\Controllers;

use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReportController extends Controller
{
    public function index()
    {
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

        return view('admin.reportharian', compact('absen'));
    }

    public function reportbulanan()
    {
        return view('admin.reportbulanan');
    }

    public function pdfharian()
    {
        $tanggal = gmdate('Y-m-d', time()+ (60 * 60 * 8));
        $tanggal1 = gmdate('d-m-Y', time()+ (60 * 60 * 8));
        
        $absen = User::leftJoin('absensis as b', function($join) use ($tanggal) {
        $join->on('users.id', '=', 'b.user_id')
            ->whereDate('b.tanggal', '=', $tanggal);
            })
        ->select('users.*', 'b.*')
        ->get();
        
        $pdf = Pdf::loadView('admin.pdfharian', compact('absen', 'tanggal1'));
        
        return $pdf->stream('reportharian.pdf');

    }
}
