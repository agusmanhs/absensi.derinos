<?php

namespace App\Http\Controllers;

use App\Helpers\Helper;
use App\Models\Absensi;
use App\Models\Jabatan;
use App\Models\Libur;
use App\Models\Lokasi;
use App\Models\Pegawai;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Telegram\Bot\Laravel\Facades\Telegram;

class AbsensiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Absensi $absensi)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Absensi $absensi)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Absensi $absensi)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Absensi $absensi)
    {
        //
    }

    public function masuk(Request $request) {

        // dd($request['latitude']);
        $timezone = time()+ (60 * 60 * 8);
        $tanggal = gmdate('Y-m-d', $timezone);
        $jam    = gmdate('H:i:s', $timezone);
        $hari     =  gmdate('l', $timezone);
        
        $lokasikantor = Helper::lokasiKantor();
        $jarakKantor = Helper::jarakKantor();
        $lock = explode(', ', $lokasikantor); 

        // $jam_kerja = SettingAbsen::first();

        $jabatan = Jabatan::where('id', '=', Auth::user()->pegawai->jabatan_id)->first();
        $jam_kerja = Lokasi::where('id', '=', $jabatan->lokasi_id)->first();
        // dd($jam_kerja);

        
        $lokasikantor = ['latitude' => $lock[0],  'longitude' => $lock[1]];  
        $lokasiuser = ['latitude' => $request['latitude'],  'longitude' => $request['longitude']];  
        // dd($lokasiuser);
        
        $jaraknya = Helper::howLong($lokasikantor, $lokasiuser);

        $hadir = Absensi::where('user_id', '=', Auth::user()->id)->where('tanggal', '=', $tanggal)->first();
        $liburAll = Libur::get();

        $hariIni = date('Y-m-d'); 
        $libur = Libur::where('tanggal', $tanggal)->exists();

        if($hari == 'Sunday' or $libur){
            return redirect()->route('user.dashboard')->with('info', 'Hari ini libur, Tidak ada jadwal Absensi');
        }
        else{
            if($hadir){
                if($hadir->status == 'izin'){
                    return redirect()->route('user.dashboard')->with('info', 'Hari ini anda izin');
        
                }else{
                    
                    return redirect()->route('user.dashboard')->with('warning', 'Anda sudah absen masuk!');
                }
            }
            else{
                if ($jaraknya > $jarakKantor){
                    return redirect()->route('user.dashboard')->with('warning', 'Anda terlalu jauh dari lokasi kantor untuk melakukan absensi. ')->with('jaraknya', $jaraknya);
                }
                else{
                    $absen = new Absensi();
                    $absen->user_id = Auth::user()->id;
                    $absen->tanggal = $tanggal;
                    $absen->absen_masuk = $jam;
                    $absen->lokasi_masuk = $request['latitude'].', '.$request['longitude'];
                    $absen->status = 'hadir';
                    
                    if($jam > $jam_kerja->jam_masuk){
                        $jamMasukSeharusnya = Carbon::parse($jam_kerja->jam_masuk);
                        $jamMasukAktual = Carbon::parse($jam);
                        $menitTerlambat = $jamMasukSeharusnya->diffInMinutes($jamMasukAktual);

                        
                        
                        if($menitTerlambat >= 60){
                            $jam_terlambat = floor($menitTerlambat / 60);
                            $menit_sisa = $menitTerlambat % 60;
                            if($menit_sisa > 1){
                                $absen->ket_masuk = 'terlambat ' . $jam_terlambat . ' jam ' . $menit_sisa . ' menit';
                            } else {
                                $absen->ket_masuk = 'terlambat ' . $jam_terlambat . ' jam';
                            }
                        } else {
                            $absen->ket_masuk = 'terlambat ' . $menitTerlambat . ' menit';
                        }
                    }
                    else{
                        $absen->ket_masuk = 'on time';
                    }
                    $absen->save();
                    Telegram::sendMessage([
                        'chat_id' => '-5046766680',
                        'text' => "Pegawai dengan username " .Auth::user()->name." telah melakukan absensi masuk"
                    ]);
                    return redirect()->route('user.dashboard')->with('success', 'Anda berhasil absen masuk')->with('jaraknya', $jaraknya);
                }
            }
        }
    }

    // public function keluar(Request $request)
    // {
    //     $timezone = time() + (60 * 60 * 8);
    //     $tanggal = gmdate('Y-m-d', $timezone);
    //     $jam    = gmdate('H:i:s', $timezone);
    //     $hari     =  gmdate('l', $timezone);

    //     $lokasikantor = Helper::lokasiKantor();
    //     $jarakKantor = Helper::jarakKantor();
    //     $lock = explode(', ', $lokasikantor);

    //     $jabatan = Jabatan::where('id', '=', Auth::user()->pegawai->jabatan_id)->first();
    //     $jam_kerja = Lokasi::where('id', '=', $jabatan->lokasi_id)->first();

    //     $lokasikantor = ['latitude' => $lock[0],  'longitude' => $lock[1]];
    //     $lokasiuser = ['latitude' => $request['latitude'],  'longitude' => $request['longitude']];
    //     // dd($lokasiuser);
    //     $jaraknya = Helper::howLong($lokasikantor, $lokasiuser);

    //     $hadir = Absensi::where('user_id', '=', Auth::user()->id)->where('tanggal', '=', $tanggal)->first();
    //     $liburAll = Libur::get();

    //     $hariIni = date('Y-m-d');
    //     $libur = Libur::where('tanggal', $tanggal)->exists();

    //     // dd($hadir->id);
    //     if ($hari == 'Sunday' or $libur) {
    //         return redirect()->route('user.dashboard')->with('info', 'Hari ini libur, Tidak ada jadwal Absensi');
    //     } else {
    //         if ($hadir) {
    //             if ($hadir->status == 'izin') {
    //                 return redirect()->route('user.dashboard')->with('info', 'Hari ini anda izin');
    //             } else {
    //                 if ($jaraknya > $jarakKantor) {
    //                     return redirect()->route('user.dashboard')->with('warning', 'Anda terlalu jauh dari lokasi kantor untuk melakukan absensi. ')->with('jaraknya', $jaraknya);
    //                 } else {
    //                     // dd(Auth::user()->id);
    //                     // $nugu = Absensi::first();
    //                     // dd($nugu->user->nama);
    //                     $jamKeluarSeharusnya = Carbon::parse($tanggal . ' ' . $jam_kerja->jam_keluar);
    //                     $jamKeluarAktual = Carbon::parse($tanggal . ' ' . $jam);
                        
    //                     $absen = Absensi::findOrFail($hadir->id);
    //                     $absen->absen_keluar = $jam;
    //                     $absen->lokasi_keluar = $request['lat'].', '.$request['long'];
    //                     // dd($jam_kerja);
    //                     if($jam < $jam_kerja->jam_keluar){
    //                         $menitCepat = floor($jamKeluarAktual->diffInMinutes($jamKeluarSeharusnya));
                            
    //                         if($menitCepat >= 60){
    //                             $jam_cepat = floor($menitCepat / 60);
    //                             $menit_sisa = $menitCepat % 60;
    //                             $absen->ket_keluar = 'pulang cepat ' . $jam_cepat . ' jam ' . $menit_sisa . ' menit';
    //                         } else {
    //                             $absen->ket_keluar = 'pulang cepat ' . $menitCepat . ' menit';
    //                         }
    //                     }
    //                     else{
    //                         $absen->ket_keluar = 'on time';
    //                     }
    //                     $absen->update();
    //                     Telegram::sendMessage([
    //                         'chat_id' => '-5046766680',
    //                         'parse_mode'=> 'markdown',
    //                         'text' => "Pegawai dengan username *" .Auth::user()->name."* telah melakukan absensi keluar"
    //                     ]);
    //                     return redirect()->route('user.dashboard')->with('success', 'Anda berhasil absen keluar')->with('jaraknya', $jaraknya);
    //                 }
    //             }
    //         } else {
    //             return redirect()->route('user.dashboard')->with('info', 'Anda belum absen masuk!');
    //         };
    //     }
    // }

    public function keluar(Request $request)
{
    $timezone = time() + (60 * 60 * 8);
    $tanggal = gmdate('Y-m-d', $timezone);
    $jam    = gmdate('H:i:s', $timezone);
    $hari     =  gmdate('l', $timezone);

    $lokasikantor = Helper::lokasiKantor();
    $jarakKantor = Helper::jarakKantor();
    $lock = explode(', ', $lokasikantor);

    $jabatan = Jabatan::where('id', '=', Auth::user()->pegawai->jabatan_id)->first();
    $jam_kerja = Lokasi::where('id', '=', $jabatan->lokasi_id)->first();

    $lokasikantor = ['latitude' => $lock[0],  'longitude' => $lock[1]];
    $lokasiuser = ['latitude' => $request['latitude'],  'longitude' => $request['longitude']];
    $jaraknya = Helper::howLong($lokasikantor, $lokasiuser);

    $hadir = Absensi::where('user_id', '=', Auth::user()->id)->where('tanggal', '=', $tanggal)->first();
    $liburAll = Libur::get();

    $hariIni = date('Y-m-d');
    $libur = Libur::where('tanggal', $tanggal)->exists();

    if ($hari == 'Sunday' or $libur) {
        return redirect()->route('user.dashboard')->with('info', 'Hari ini libur, Tidak ada jadwal Absensi');
    } else {
        if ($hadir) {
            if ($hadir->status == 'izin') {
                return redirect()->route('user.dashboard')->with('info', 'Hari ini anda izin');
            } else {
                if ($jaraknya > $jarakKantor) {
                    return redirect()->route('user.dashboard')->with('warning', 'Anda terlalu jauh dari lokasi kantor untuk melakukan absensi. ')->with('jaraknya', $jaraknya);
                } else {
                    $jamKeluarSeharusnya = Carbon::parse($tanggal . ' ' . $jam_kerja->jam_keluar);
                    $jamKeluarAktual = Carbon::parse($tanggal . ' ' . $jam);
                    
                    $batasOnTime = $jamKeluarSeharusnya->copy()->addHour();
                    
                    $absen = Absensi::findOrFail($hadir->id);
                    $absen->absen_keluar = $jam;
                    $absen->lokasi_keluar = $request['lat'].', '.$request['long'];
                    
                    if($jam < $jam_kerja->jam_keluar){
                        $menitCepat = floor($jamKeluarAktual->diffInMinutes($jamKeluarSeharusnya));
                        
                        if($menitCepat >= 60){
                            $jam_cepat = floor($menitCepat / 60);
                            $menit_sisa = $menitCepat % 60;
                            $absen->ket_keluar = 'pulang cepat ' . $jam_cepat . ' jam ' . $menit_sisa . ' menit';
                        } else {
                            $absen->ket_keluar = 'pulang cepat ' . $menitCepat . ' menit';
                        }
                    }
                    else if($jamKeluarAktual->lte($batasOnTime)){
                        $absen->ket_keluar = 'on time';
                    }
                    else {
                        $menitLembur = floor($jamKeluarAktual->diffInMinutes($jamKeluarSeharusnya));
                        $jamLembur = floor($menitLembur / 60);
                        
                        $absen->ket_keluar = 'lembur ' . $jamLembur . ' jam';
                    }
                    
                    $absen->update();
                    Telegram::sendMessage([
                        'chat_id' => '-5046766680',
                        'parse_mode'=> 'markdown',
                        'text' => "Pegawai dengan username *" .Auth::user()->name."* telah melakukan absensi keluar"
                    ]);
                    return redirect()->route('user.dashboard')->with('success', 'Anda berhasil absen keluar')->with('jaraknya', $jaraknya);
                }
            }
        } else {
            return redirect()->route('user.dashboard')->with('info', 'Anda belum absen masuk!');
        };
    }
}

    public function izin(Request $request)
    {
        $request->validate([
            'tanggal' => ['required', 'date', 'after_or_equal:today'],
            // 'alasan'  => ['required', 'string'],
            'ket_izin' => ['required', 'string'],

        ]);
        $tanggal = gmdate('Y-m-d', time() + (60 * 60 * 8));

        $hadir = Absensi::where('user_id', '=', Auth::user()->id)->where('tanggal', '=', $tanggal)->first();

        if ($hadir) {
            $izin = Absensi::findOrFail($hadir->id);
            $izin->ket_izin = $request->input('ket_izin');
            $izin->status     = 'pending';
            $izin->update();
        } else {
            $izin = new Absensi();
            $izin->user_id    = Auth::user()->id;
            $izin->tanggal    = $request->input('tanggal');
            // $izin->alasan     = $request->input('alasan');
            $izin->ket_izin = $request->input('ket_izin');
            $izin->status     = 'pending';
            $izin->save();
        }

        return redirect()->route('user.dashboard')->with('success', 'Pengajuan izin berhasil dikirim!');
    }
}
