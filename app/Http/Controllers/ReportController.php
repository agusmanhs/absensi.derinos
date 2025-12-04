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

        return view('admin.reportharian', compact('absen'));
    }

    public function reportbulanan(Request $request)
    {
        $bulan = $request->bulan ? date('m', strtotime($request->bulan)) : date('m');
        $tahun = $request->bulan ? date('Y', strtotime($request->bulan)) : date('Y');

        $bulan1 = \Carbon\Carbon::createFromDate($tahun, $bulan, 1)
                    ->translatedFormat('F Y');

        $riwayat = DB::table('absensis')
            ->join('users', 'absensis.user_id', '=', 'users.id')
            ->select('users.name', 'absensis.*')
            ->whereMonth('absensis.tanggal', $bulan)
            ->whereYear('absensis.tanggal', $tahun)
            ->orderBy('absensis.tanggal', 'desc')
            ->get();

        return view('admin.reportbulanan', compact('riwayat', 'bulan1'));
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

    // public function pdfbulanan(Request $request)
    // {
    //     $bulan = $request->bulan ? date('m', strtotime($request->bulan)) : date('m');
    //     $tahun = $request->bulan ? date('Y', strtotime($request->bulan)) : date('Y');

    //     $bulan1 = \Carbon\Carbon::createFromDate($tahun, $bulan, 1)
    //                 ->translatedFormat('F Y');

    //     $riwayat = DB::table('absensis')
    //         ->join('users', 'absensis.user_id', '=', 'users.id')
    //         ->select('users.name', 'absensis.*')
    //         ->whereMonth('absensis.tanggal', $bulan)
    //         ->whereYear('absensis.tanggal', $tahun)
    //         ->orderBy('absensis.tanggal', 'desc')
    //         ->get();

    //     $pdf = Pdf::loadView('admin.pdfbulanan', compact('riwayat', 'bulan1'))
    //             ->setPaper('a4', 'landscape');

    //     return $pdf->stream('reportbulanan.pdf');
    // }

    public function pdfbulanan(Request $request)
    {
        $bulan = $request->bulan ? date('m', strtotime($request->bulan)) : date('m');
        $tahun = $request->bulan ? date('Y', strtotime($request->bulan)) : date('Y');
    
        $bulan1 = \Carbon\Carbon::createFromDate($tahun, $bulan, 1)
                    ->translatedFormat('F Y');
    
        $daysInMonth = \Carbon\Carbon::create($tahun, $bulan, 1)->daysInMonth;
    
        $dates = [];
        for ($i = 1; $i <= $daysInMonth; $i++) {
            $dates[] = $i; 
        }
    
        $pegawai = User::orderBy('name')->get();
    
        $absen = DB::table('absensis')
            ->whereMonth('tanggal', $bulan)
            ->whereYear('tanggal', $tahun)
            ->get();
    
        $rekap = [];
        foreach ($pegawai as $p) {
            foreach ($dates as $tgl) {
                $rekap[$p->id][$tgl] = '-';
            }
        }
    
        foreach ($absen as $a) {
            $hari = (int) date('d', strtotime($a->tanggal)); 

            
            $rekap[$a->user_id][$hari] = $a->status;
        }
    
        $pdf = Pdf::loadView('admin.pdfbulanan', compact('pegawai', 'dates', 'rekap', 'bulan1'))
            ->setPaper('a4', 'landscape');
    
        return $pdf->stream('reportbulanan.pdf');
    }

}
