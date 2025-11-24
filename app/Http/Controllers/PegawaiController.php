<?php

namespace App\Http\Controllers;

use App\Models\Pegawai;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use id;

class PegawaiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Pegawai::orderBy('nama')->get();
        return view('admin.pegawai', compact('data'));
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
        // dd($request->nama);
        try {
            DB::beginTransaction();

            // 1. Buat User terlebih dahulu
            $user = User::create([
                'name' => $request->nama,
                'email' => $request->email,
                'password' => Hash::make($request->password),
            ]);

            // 2. Buat Pegawai dengan user_id dari user yang baru dibuat
            $pegawai = Pegawai::create([
                'user_id' => $user->id,
                'nik' => $request->nik,
                'nama' => $request->nama,
                'jabatan' => $request->jabatan,
                'jenisKelamin' => $request->jenisKelamin,
                'notelp' => $request->notelp,
                'alamat' => $request->alamat,
            ]);
            DB::commit();

            return redirect()
                ->route('admin.pegawai')
                ->with('success', 'Pegawai berhasil ditambahkan');

        } catch (\Exception $e) {
            DB::rollBack();
            
            return redirect()
                ->back()
                ->withInput()
                ->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Pegawai $pegawai)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Pegawai $pegawai)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        try {
            DB::beginTransaction();

            $pegawai = Pegawai::findOrFail($id);

            $user = $pegawai->user;

            $user->update([
                'name' => $request->nama,
                'email' => $request->email,
            ]);

            if ($request->filled('password')) {
                $user->update([
                    'password' => Hash::make($request->password),
                ]);
            }

            $pegawai->update([
                'nik' => $request->nik,
                'nama' => $request->nama,
                'jabatan' => $request->jabatan,
                'jenisKelamin' => $request->jenisKelamin,
                'notelp' => $request->notelp,
                'alamat' => $request->alamat,
            ]);

            DB::commit();

            return redirect()
                ->route('admin.pegawai')
                ->with('success', 'Pegawai berhasil diperbarui');

        } catch (\Exception $e) {
            DB::rollBack();

            return redirect()
                ->back()
                ->withInput()
                ->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Pegawai $pegawai, $id)
    {
        $pegawai = Pegawai::findOrFail($id);
        $pegawai->delete();
        return redirect()->route('admin.pegawai')->with('delete', 'Data pegawai berhasil dihapus!');
    }
}
