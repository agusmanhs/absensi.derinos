<?php

namespace App\Http\Controllers;

use App\Models\Jabatan;
use App\Models\Lokasi;
use Illuminate\Http\Request;

class JabatanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Jabatan::orderBy('kode_jabatan')->get();
        $lokasi = Lokasi::orderBy('nama_lokasi')->get();
        return view('admin.jabatan', compact('data', 'lokasi'));
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
        // dd($request);
        $request->validate([
        'kode_jabatan' => 'required',
        'nama_jabatan' => 'required|string|max:255',
        'lokasi_id' => 'required',
    ]);

    Jabatan::create([
        'kode_jabatan' => $request->kode_jabatan,
        'nama_jabatan' => $request->nama_jabatan,
        'lokasi_id' => $request->lokasi_id,
    ]);

    return redirect()->route('admin.jabatan')->with('success_message', 'Jabatan berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Jabatan $jabatan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Jabatan $jabatan)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Jabatan $jabatan)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Jabatan $jabatan)
    {
        //
    }
}
