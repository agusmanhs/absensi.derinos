<?php

namespace App\Http\Controllers;

use App\Models\Libur;
use Illuminate\Http\Request;

class LiburController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $liburs = Libur::orderBy('tanggal')->get();
        return view('admin.libur', compact('liburs'));  
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
        $request->validate([
        'tanggal' => 'required|date',
        'keterangan' => 'required|string|max:255',
        ]);

        Libur::create([
            'tanggal' => $request->tanggal,
            'keterangan' => $request->keterangan,
        ]);

        return redirect()->route('admin.libur')->with('success', 'Hari libur berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Libur $libur)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Libur $libur)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Libur $libur)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $libur = Libur::findOrFail($id);
        $libur->delete();

        return redirect()->route('admin.libur')->with('delete', 'Data libur berhasil dihapus.');
    }
}
