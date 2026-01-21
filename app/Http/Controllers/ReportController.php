<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Libur;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\DB;

class ReportController extends Controller
{
    public function index()
    {
        $tanggal = gmdate('Y-m-d', time() + (60 * 60 * 8));

        $absen = User::leftJoin('absensis as b', function ($join) use ($tanggal) {
            $join->on('users.id', '=', 'b.user_id')
                ->whereDate('b.tanggal', '=', $tanggal);
        })
            ->select('users.*', 'b.*')
            ->get();

        return view('admin.reportharian', compact('absen'));
    }

    public function reportbulanan(Request $request)
    {
        $bulan = $request->input('bulan', date('m'));
        $tahun = $request->input('tahun', date('Y'));

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
        $tanggal = gmdate('Y-m-d', time() + (60 * 60 * 8));
        $tanggal1 = gmdate('d-m-Y', time() + (60 * 60 * 8));

        $absen = User::leftJoin('absensis as b', function ($join) use ($tanggal) {
            $join->on('users.id', '=', 'b.user_id')
                ->whereDate('b.tanggal', '=', $tanggal);
        })
            ->select('users.*', 'b.*')
            ->get();

        $pdf = Pdf::loadView('admin.pdfharian', compact('absen', 'tanggal1'));

        return $pdf->stream('reportharian.pdf');
    }

    //     public function pdfbulanan(Request $request)
    // {
    //     $bulan = $request->bulan ? date('m', strtotime($request->bulan)) : date('m');
    //     $tahun = $request->bulan ? date('Y', strtotime($request->bulan)) : date('Y');

    //     $tanggalMulai = \Carbon\Carbon::createFromDate($tahun, $bulan, 25);
    //     $tanggalSelesai = \Carbon\Carbon::createFromDate($tahun, $bulan, 25)->addMonth()->subDay();

    //     $bulan1 = $tanggalMulai->translatedFormat('d F Y') . ' - ' . $tanggalSelesai->translatedFormat('d F Y');

    //     $liburNasional = \App\Models\Libur::whereBetween('tanggal', [$tanggalMulai, $tanggalSelesai])
    //         ->pluck('tanggal')
    //         ->toArray();

    //     $dates = [];
    //     $currentDate = $tanggalMulai->copy();

    //     while ($currentDate <= $tanggalSelesai) {
    //         $isHoliday = in_array($currentDate->format('Y-m-d'), $liburNasional);

    //         $dates[] = [
    //             'day' => $currentDate->day,
    //             'month' => $currentDate->month,
    //             'year' => $currentDate->year,
    //             'full_date' => $currentDate->format('Y-m-d'),
    //             'is_sunday' => $currentDate->isSunday(),
    //             'is_holiday' => $isHoliday,
    //             'is_libur' => $currentDate->isSunday() || $isHoliday
    //         ];

    //         $currentDate->addDay();
    //     }

    //     $pegawai = User::orderBy('name')->get();

    //     $absen = DB::table('absensis')
    //         ->whereBetween('tanggal', [$tanggalMulai->format('Y-m-d'), $tanggalSelesai->format('Y-m-d')])
    //         ->get();

    //     $rekap = [];
    //     foreach ($pegawai as $p) {
    //         foreach ($dates as $date) {
    //             $rekap[$p->id][$date['full_date']] = '-';
    //         }
    //     }

    //     foreach ($absen as $a) {
    //         $rekap[$a->user_id][$a->tanggal] = $a->status;
    //     }

    //     $pdf = Pdf::loadView('admin.pdfbulanan', compact('pegawai', 'dates', 'rekap', 'bulan1'))
    //         ->setPaper('a4', 'landscape');

    //     return $pdf->stream('reportbulanan.pdf');
    // }

    // public function pdfbulanan(Request $request)
    // {
    //     $bulan = $request->bulan ? date('m', strtotime($request->bulan)) : date('m');
    //     $tahun = $request->bulan ? date('Y', strtotime($request->bulan)) : date('Y');

    //     $tanggalMulai = \Carbon\Carbon::createFromDate($tahun, $bulan, 25);
    //     $tanggalSelesai = \Carbon\Carbon::createFromDate($tahun, $bulan, 25)->addMonth()->subDay();

    //     $bulan1 = $tanggalMulai->translatedFormat('d F Y') . ' - ' . $tanggalSelesai->translatedFormat('d F Y');

    //     $liburNasional = \App\Models\Libur::whereBetween('tanggal', [$tanggalMulai, $tanggalSelesai])
    //         ->pluck('tanggal')
    //         ->toArray();

    //     $dates = [];
    //     $currentDate = $tanggalMulai->copy();

    //     while ($currentDate <= $tanggalSelesai) {
    //         $isHoliday = in_array($currentDate->format('Y-m-d'), $liburNasional);

    //         $dates[] = [
    //             'day' => $currentDate->day,
    //             'month' => $currentDate->month,
    //             'year' => $currentDate->year,
    //             'full_date' => $currentDate->format('Y-m-d'),
    //             'is_sunday' => $currentDate->isSunday(),
    //             'is_holiday' => $isHoliday,
    //             'is_libur' => $currentDate->isSunday() || $isHoliday
    //         ];

    //         $currentDate->addDay();
    //     }

    //     $pegawai = User::orderBy('name')->get();

    //     $absen = DB::table('absensis')
    //         ->whereBetween('tanggal', [$tanggalMulai->format('Y-m-d'), $tanggalSelesai->format('Y-m-d')])
    //         ->get();

    //     $rekap = [];
    //     foreach ($pegawai as $p) {
    //         foreach ($dates as $date) {
    //             $rekap[$p->id][$date['full_date']] = '-';
    //         }
    //     }

    //     foreach ($absen as $a) {
    //         $rekap[$a->user_id][$a->tanggal] = $a->status;
    //     }

    //     $pdf = Pdf::loadView('admin.pdfbulanan', compact('pegawai', 'dates', 'rekap', 'bulan1'))
    //         ->setPaper('a4', 'landscape');

    //     return $pdf->stream('reportbulanan.pdf');
    // }

    public function pdfbulanan(Request $request)
    {
        // $bulan = $request->bulan ? date('m', strtotime($request->bulan)) : date('m');
        // $tahun = $request->bulan ? date('Y', strtotime($request->bulan)) : date('Y');

        $bulan = $request->input('bulan', date('m'));
        $tahun = $request->input('tahun', date('Y'));

        $today = \Carbon\Carbon::today();
        $tanggalMulai = \Carbon\Carbon::createFromDate($tahun, $bulan, 25);

        if ($tahun == $today->year && $bulan == $today->month && $today->day < 25) {
            $tanggalMulai->subMonth();
        }

        $tanggalSelesai = $tanggalMulai->copy()->addMonth()->subDay();

        $bulan1 = $tanggalMulai->translatedFormat('d F Y') . ' - ' . $tanggalSelesai->translatedFormat('d F Y');

        $liburNasional = \App\Models\Libur::whereBetween('tanggal', [$tanggalMulai, $tanggalSelesai])
            ->pluck('tanggal')
            ->toArray();

        $dates = [];
        $currentDate = $tanggalMulai->copy();

        while ($currentDate <= $tanggalSelesai) {
            $isHoliday = in_array($currentDate->format('Y-m-d'), $liburNasional);

            $dates[] = [
                'day' => $currentDate->day,
                'month' => $currentDate->month,
                'year' => $currentDate->year,
                'full_date' => $currentDate->format('Y-m-d'),
                'is_sunday' => $currentDate->isSunday(),
                'is_holiday' => $isHoliday,
                'is_libur' => $currentDate->isSunday() || $isHoliday
            ];

            $currentDate->addDay();
        }

        $pegawai = User::orderBy('name')->get();

        $absen = DB::table('absensis')
            ->whereBetween('tanggal', [$tanggalMulai->format('Y-m-d'), $tanggalSelesai->format('Y-m-d')])
            ->get();

        $rekap = [];
        foreach ($pegawai as $p) {
            foreach ($dates as $date) {
                $rekap[$p->id][$date['full_date']] = '-';
            }
        }

        foreach ($absen as $a) {
            $rekap[$a->user_id][$a->tanggal] = $a->status;
        }

        $pdf = Pdf::loadView('admin.pdfbulanan', compact('pegawai', 'dates', 'rekap', 'bulan1'))
            ->setPaper('a4', 'landscape');

        return $pdf->stream('reportbulanan.pdf');
    }


    public function pdfPegawai(Request $request)
    {
        $bulan = $request->bulan ? date('m', strtotime($request->bulan)) : date('m');
        $tahun = $request->bulan ? date('Y', strtotime($request->bulan)) : date('Y');
        $pegawaiId = $request->pegawai_id;

        $today = \Carbon\Carbon::today();
        $tanggalMulai = \Carbon\Carbon::createFromDate($tahun, $bulan, 25);

        if ($tahun == $today->year && $bulan == $today->month && $today->day < 25) {
            $tanggalMulai->subMonth();
        }

        $tanggalSelesai = $tanggalMulai->copy()->addMonth()->subDay();

        $bulan1 = $tanggalMulai->translatedFormat('d F Y') . ' - ' . $tanggalSelesai->translatedFormat('d F Y');

        $pegawai = User::findOrFail($pegawaiId);

        $dataPegawai = DB::table('pegawais')
            ->where('user_id', $pegawaiId)
            ->first();

        $jamKeluarLokasi = null;
        if ($dataPegawai && $dataPegawai->jabatan_id) {
            $jabatan = DB::table('jabatans')
                ->where('id', $dataPegawai->jabatan_id)
                ->first();

            if ($jabatan && $jabatan->lokasi_id) {
                $lokasiPegawai = DB::table('lokasis')
                    ->where('id', $jabatan->lokasi_id)
                    ->first();
                $jamKeluarLokasi = $lokasiPegawai ? $lokasiPegawai->jam_keluar : null;
            }
        }

        $liburNasional = Libur::whereBetween('tanggal', [$tanggalMulai->format('Y-m-d'), $tanggalSelesai->format('Y-m-d')])
            ->pluck('tanggal')
            ->toArray();

        $absen = DB::table('absensis')
            ->where('user_id', $pegawaiId)
            ->whereBetween('tanggal', [$tanggalMulai->format('Y-m-d'), $tanggalSelesai->format('Y-m-d')])
            ->get();

        $rekap = [];
        $currentDate = $tanggalMulai->copy();
        $index = 1;

        while ($currentDate <= $tanggalSelesai) {
            $tanggal = $currentDate->format('Y-m-d');
            $data = $absen->firstWhere('tanggal', $tanggal);

            $isSunday = $currentDate->isSunday();
            $isLiburNasional = in_array($tanggal, $liburNasional);
            $isLibur = $isSunday || $isLiburNasional;

            $ketLembur = '-';
            $jamLembur = 0;
            $ketKeluarBaru = '-';

            if (
                $data &&
                isset($data->absen_keluar) &&
                $data->absen_keluar &&
                $data->absen_keluar !== '-' &&
                $jamKeluarLokasi
            ) {
                try {
                    $absenKeluarTime = $data->absen_keluar;

                    if (strlen($absenKeluarTime) > 8) {
                        $jamKeluar = \Carbon\Carbon::parse($absenKeluarTime);
                    } else {
                        $jamKeluar = \Carbon\Carbon::parse($tanggal . ' ' . $absenKeluarTime);
                    }

                    $jamKeluarStandar = \Carbon\Carbon::parse($tanggal . ' ' . $jamKeluarLokasi);
                    $batasOntime = $jamKeluarStandar->copy()->addHour();

                    if ($jamKeluar->lt($jamKeluarStandar)) {
                        $menitCepat = floor($jamKeluar->diffInMinutes($jamKeluarStandar));

                        if ($menitCepat >= 60) {
                            $jam_cepat = floor($menitCepat / 60);
                            $menit_sisa = $menitCepat % 60;
                            $ketKeluarBaru = 'pulang cepat ' . $jam_cepat . ' jam ' . $menit_sisa . ' menit';
                        } else {
                            $ketKeluarBaru = 'pulang cepat ' . $menitCepat . ' menit';
                        }
                        $ketLembur = '-';
                    } else if ($jamKeluar->between($jamKeluarStandar, $batasOntime)) {
                        $ketKeluarBaru = 'ontime';
                        $ketLembur = 'ontime';
                        $jamLembur = 0;
                    } else {
                        $selisihMenit = $batasOntime->diffInMinutes($jamKeluar);
                        $jamLembur = floor($selisihMenit / 60);

                        if ($jamLembur > 0) {
                            $ketLembur = 'lembur ' . $jamLembur . ' jam';
                            $ketKeluarBaru = 'lembur ' . $jamLembur . ' jam';
                        } else {
                            $ketKeluarBaru = 'ontime';
                            $ketLembur = 'ontime';
                            $jamLembur = 0;
                        }
                    }
                } catch (\Exception $e) {
                    $ketKeluarBaru = $data->ket_keluar ?? '-';
                    $ketLembur = '-';
                    $jamLembur = 0;
                }
            } else {
                $ketKeluarBaru = $data ? ($data->ket_keluar ?? '-') : '-';
            }

            $rekap[$index] = [
                'tanggal' => $tanggal,
                'absen_masuk' => $data ? ($data->absen_masuk ?? '-') : '-',
                'ket_masuk' => $data ? ($data->ket_masuk ?? '-') : '-',
                'absen_keluar' => $data ? ($data->absen_keluar ?? '-') : '-',
                'ket_keluar' => $ketKeluarBaru,
                'status' => $data ? ($data->status ?? 'tidak hadir') : 'tidak hadir',
                'ket_izin' => $data ? ($data->ket_izin ?? '-') : '-',
                'ket_lembur' => $ketLembur,
                'jam_lembur' => $jamLembur,
                'is_libur' => $isLibur,
                'is_sunday' => $isSunday,
                'is_holiday' => $isLiburNasional,
            ];

            $currentDate->addDay();
            $index++;
        }

        $pdf = Pdf::loadView('admin.pdfpegawai', compact('pegawai', 'rekap', 'bulan1'))
            ->setPaper('a4', 'portrait');

        return $pdf->stream('reportpegawai.pdf');
    }
}
