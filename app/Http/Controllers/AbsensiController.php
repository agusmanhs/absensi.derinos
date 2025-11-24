<?php

namespace App\Http\Controllers;

use App\Helpers\Helper;
use App\Models\Absensi;
use App\Models\Jabatan;
use App\Models\Lokasi;
use App\Models\Pegawai;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
        
        $jaraknya = Helper::howLong($lokasikantor, $lokasiuser);

        $hadir = Absensi::where('user_id', '=', Auth::user()->id)->where('tanggal', '=', $tanggal)->first();
        // $liburAll = Libur::get();

        $hariIni = date('Y-m-d'); 
        // $libur = Libur::where('tanggal', $tanggal)->exists();

        if($hari == 'Sunday'){
            return redirect()->route('user.dashboard')->with('info', 'Hari ini libur, Tidak ada jadwal Absensi');
        }
        else{
            if($hadir){
                if($hadir->status == 'izin'){
                    return redirect()->route('user.dashboard')->with('terimaizin', 'Hari ini anda izin');
        
                }else{
                    
                    return redirect()->route('user.dashboard')->with('warning', 'Anda sudah absen masuk!');
                }
            }
            else{
                if ($jaraknya > $jarakKantor){
                    return redirect()->route('user.dashboard')->with('warning', 'Anda terlalu jauh dari lokasi kantor untuk melakukan absensi. ')->with('jaraknya', $jaraknya);
                }
                else{
                    // dd(Auth::user()->id);
                    // $nugu = Absensi::first();
                    // dd($nugu->user->nama);
                    $absen = new Absensi();
                    $absen->user_id = Auth::user()->id;
                    $absen->tanggal = $tanggal;
                    $absen->absen_masuk = $jam;
                    $absen->lokasi_masuk = $request['latitude'].', '.$request['longitude'];
                    $absen->status = 'hadir';
                    
                    if($jam > $jam_kerja->jam_masuk){
                        $absen->ket_masuk = 'terlambat';
                    }
                    else{
                        $absen->ket_masuk = 'on time';
                    }
                    $absen->save();
                    return redirect()->route('user.dashboard')->with('success', 'Anda berhasil absen masuk')->with('jaraknya', $jaraknya);
                }
            }
        }
    }

public function keluar(Request $request) {

    return redirect()->route('user.dashboard')->with('warning', 'Anda terlalu jauh dari lokasi kantor untuk melakukan absensi. ');

}

}
