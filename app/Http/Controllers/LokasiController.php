<?php

namespace App\Http\Controllers;

use App\Models\Lokasi;
use Illuminate\Http\Request;

class LokasiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Lokasi::orderBy('nama_lokasi')->get();

        return view('admin.lokasi', compact('data'));
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
        $validated = $request->validate([
            'nama_lokasi' => 'required',
            'jam_masuk' => 'required|date_format:H:i',
            'jam_keluar' => 'required|date_format:H:i',
            'lokasi' => 'required|string',
            'batas_jarak' => 'required|numeric',
        ]);

        if($request->jam_masuk < $request->jam_keluar){
                Lokasi::create($validated);
            return redirect()->route('admin.lokasi')->with('success', 'Pengaturan Absensi berhasil disimpan!');
        }else{
            return redirect()->route('admin.lokasi')->with('error', 'Pengaturan Anda gagal disimpan!');
            
        }

    }

    /**
     * Display the specified resource.
     */
    public function show(Lokasi $lokasi)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Lokasi $lokasi)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Lokasi $lokasi)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Lokasi $lokasi)
    {
        //
    }
}
