<?php

namespace App\Http\Controllers;

use App\Helpers\Helper;
use App\Models\Absensi;
use App\Models\Pegawai;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

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

    public function profil(){

        return view('user.profil');
    }

    public function updateprofil(Request $request)
    {
        $validated = $request->validate([
            'name'     => 'required|string',
            'email'    => 'required|email|unique:users,email,' . Auth::id(),
            'password' => 'nullable|string',
            'foto'     => 'nullable|image',   
        ]);
        
        $user = User::findOrFail(Auth::id());
        
        $user->name = $validated['name'];
        $user->email = $validated['email'];
        
        if (!empty($validated['password'])) {
            $user->password = Hash::make($validated['password']);
        }
        
        $user->save();

        if ($request->hasFile('foto')) {
            $pegawai = Pegawai::where('user_id', $user->id)->firstOrFail();
            if ($pegawai->foto && file_exists(public_path('image/' . $pegawai->foto))) {
                unlink(public_path('image/' . $pegawai->foto));
            }
            
            $namaAsli = $request->file('foto')->getClientOriginalName();
            $namaUnik = time() . '_' . $namaAsli;
            $request->file('foto')->move(public_path('image'), $namaUnik);
            
            $pegawai->foto = $namaUnik;
            $pegawai->save();
        }
        
        return redirect()->route('user.profil')->with('success', 'Profil berhasil diperbarui');
    }

}
