<?php

namespace App\Helpers;

use App\Models\Jabatan;
use App\Models\Lokasi;
use App\Models\SettingAbsen;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class Helper
{

    // get hari
    public static function getHari($hari)
    {
        switch ($hari) {
            case "Sun":
                $hari = "Minggu";
                break;
            case "Mon":
                $hari = "Senin";
                break;
            case "Tue":
                $hari = "Selasa";
                break;
            case "Wed":
                $hari = "Rabu";
                break;
            case "Thu":
                $hari = "Kamis";
                break;
            case "Fri":
                $hari = "Jumat";
                break;
            case "Sat":
                $hari = "Sabtu";
                break;
        }
        return isset($hari) ? $hari : null;
    }

    // format 17-01-2021
    public static function getDateIndos($tgl)
    {
        $tanggal = substr($tgl, 8, 2);
        $bulan = substr($tgl, 5, 2);
        $tahun = substr($tgl, 0, 4);
        $tgl = $tanggal . " " . $bulan . " " . $tahun;
        if ($tgl != "--") {
            return $tanggal . "-" . $bulan . "-" . $tahun;
        }
    }

    // format 17 Januari 2021
    public static function getDateIndo($tgl)
    {
        $tanggal = substr($tgl, 8, 2);
        $bulan = Helper::getBulan((int)substr($tgl, 5, 2));
        $tahun = substr($tgl, 0, 4);
        $tgl = $tanggal . " " . $bulan . " " . $tahun;
        if ($tgl != "--") {
            return $tanggal . " " . $bulan . " " . $tahun;
        }
    }

    // format Januari 17, 2021
    public static function getDateIndo2($tgl)
    {
        $tanggal = substr($tgl, 8, 2);
        $bulan = Helper::getBulan((int)substr($tgl, 5, 2));
        $tahun = substr($tgl, 0, 4);
        $tgl = $tanggal . " " . $bulan . " " . $tahun;
        if ($tgl != "--") {
            return $bulan . " " . $tanggal . ", " . $tahun;
        }
    }

    public static function getBulan($bln)
    {
        if ($bln == 1)
            return "Januari";
        elseif ($bln == 2)
            return "Februari";
        elseif ($bln == 3)
            return "Maret";
        elseif ($bln == 4)
            return "April";
        elseif ($bln == 5)
            return "Mei";
        elseif ($bln == 6)
            return "Juni";
        elseif ($bln == 7)
            return "Juli";
        elseif ($bln == 8)
            return "Agustus";
        elseif ($bln == 9)
            return "September";
        elseif ($bln == 10)
            return "Oktober";
        elseif ($bln == 11)
            return "November";
        elseif ($bln == 12)
            return "Desember";
    }

    public static function howLong(array $placeA,array $placeB){
        $radius = 6364.963; // kilometers
        $longDiff = $placeA['longitude'] - $placeB['longitude'];
        $longDiffRad = deg2rad($longDiff);
        $cosThetaRad = cos($longDiffRad);
        $latARad = deg2rad($placeA['latitude']);
        $latBRad = deg2rad($placeB['latitude']);
        $sinLatARad = sin($latARad);
        $sinLatBRad = sin($latBRad);
        $cosLatARad = cos($latARad);
        $cosLatBRad = cos($latBRad);
      
        $dist = $sinLatARad * $sinLatBRad + $cosLatARad * $cosLatBRad * $cosThetaRad;
        $arcCosDist = acos($dist);
      
        return round($arcCosDist * $radius*1000, 2);
     }

     public static function lokasiKantor()
     {
        $jabatan = Jabatan::where('id', '=', Auth::user()->pegawai->jabatan_id)->first();
        $lokasi = Lokasi::where('id', '=', $jabatan->lokasi_id)->first();

        return $lokasi->lokasi;
        
     }
     public static function jarakKantor()
     {
        $jabatan = Jabatan::where('id', '=', Auth::user()->pegawai->jabatan_id)->first();
        $jarak = Lokasi::where('id', '=', $jabatan->lokasi_id)->first();

        return $jarak->batas_jarak;
        
     }
     
     public static function listJabatan()
     {
        $jarak = Jabatan::all();

        return $jarak->batas_jarak;
        
     }
     
     public static function listKantor()
     {
        $jarak = Lokasi::all();

        return $jarak->batas_jarak;
        
     }

}