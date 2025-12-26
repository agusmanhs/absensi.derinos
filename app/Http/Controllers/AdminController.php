<?php

namespace App\Http\Controllers;

use App\Models\Absensi;
use App\Models\Pegawai;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Telegram\Bot\Laravel\Facades\Telegram;

class AdminController extends Controller
{
    public function index()
    {
        $tanggal = gmdate('Y-m-d', time() + (60 * 60 * 8));

        $jumlahPegawai = Pegawai::count();

        $totalHadir = Absensi::where('tanggal', '=', $tanggal)->where('status', '=', 'hadir')->count();
        $totalIzin = Absensi::where('tanggal', '=', $tanggal)->where('status', '=', 'izin')->count();;
        $totalAbsen = $jumlahPegawai - $totalHadir - $totalIzin;

        $absen = User::leftJoin('absensis as b', function ($join) use ($tanggal) {
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

        return view('admin.dashboard', compact('absen', 'riwayat', 'jumlahPegawai', 'totalHadir', 'totalIzin', 'totalAbsen'));
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

        // dd($izin->status);

        if ($izin->status == 'izin') {
            $statusText = 'DITERIMA';
        } else {
            $statusText = 'DITOLAK';
        }

   

        // dd($messege);
        // exit;
        //         array:3 [▼ // app\Http\Controllers\AdminController.php:76
        //   "chat_id" => "-5046766680"
        //   "parse_mode" => "markdown"
        //   "text" => """
        //     📋 *PENGAJUAn DITERIMA*


        //     ━━━━━━━━━━━━━━━━━━━━


        //     *Pegawai: *fina


        //     *Tanggal: *26-12-2025


        //     *Keterangan: *sadsa


        //     *Status: * `DITERIMA`


        //     ━━━━━━━━━━━━━━━━━━━━
        //     """
        // ]

        Telegram::sendMessage([
            'chat_id' => '-5046766680',
            'parse_mode' => 'markdown',
            'text' => "📋 *PENGAJUAN IZIN $statusText*\n" .
                "━━━━━━━━━━━━━━━━━━━━\n" .
                "*Nama : *" . $izin->user->pegawai->nama . "\n" .
                "*Tanggal : *" . date('d-m-Y', strtotime($izin->tanggal)) . "\n" .
                "*Keterangan : *" . $izin->ket_izin . "\n" .
                "*Status : * `$statusText`\n" .
                "━━━━━━━━━━━━━━━━━━━━"
        ]);


        return redirect()->route('admin.dashboard');
    }

    public function profil()
    {

        return view('admin.profil');
    }

    // public function updateprofil(Request $request)
    // {
    //     $validated = $request->validate([
    //         'name'     => 'required|string',
    //         'email'    => 'required|email|unique:users,email,' . Auth::id(),
    //         'password' => 'nullable|string',
    //         'foto'     => 'nullable|image',   
    //     ]);

    //     $user = User::findOrFail(Auth::id());

    //     $user->name = $validated['name'];
    //     $user->email = $validated['email'];

    //     if (!empty($validated['password'])) {
    //         $user->password = Hash::make($validated['password']);
    //     }

    //     $user->save();

    //     if ($request->hasFile('foto')) {
    //         $pegawai = Pegawai::where('user_id', $user->id)->firstOrFail();
    //         if ($pegawai->foto && file_exists(public_path('image/' . $pegawai->foto))) {
    //             unlink(public_path('image/' . $pegawai->foto));
    //         }

    //         $namaAsli = $request->file('foto')->getClientOriginalName();
    //         $namaUnik = time() . '_' . $namaAsli;
    //         $request->file('foto')->move(public_path('image'), $namaUnik);

    //         $pegawai->foto = $namaUnik;
    //         $pegawai->save();
    //     }

    //     return redirect()->route('admin.profil')->with('success', 'Profil berhasil diperbarui');
    // }


    public function updateprofil(Request $request)
    {
        $validated = $request->validate([
            'name'     => 'required|string',
            'email'    => 'required|email|unique:users,email,' . Auth::id(),
            'password' => 'nullable|string',
        ]);

        $user = User::findOrFail(Auth::id());

        $user->name = $validated['name'];
        $user->email = $validated['email'];

        if (!empty($validated['password'])) {
            $user->password = Hash::make($validated['password']);
        }

        $user->save();

        return redirect()->route('admin.profil')->with('success', 'Profil berhasil diperbarui');
    }
}
