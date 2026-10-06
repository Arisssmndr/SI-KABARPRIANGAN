<?php

namespace App\Http\Controllers;

use App\Models\IklanKoran;
use Illuminate\Http\Request;

class IklanKoranController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $iklankoran = IklanKoran::latest()->paginate(10);
        $kode_iklankoran = IklanKoran::createCode();

        return view('page.iklankoran.index', compact('iklankoran', 'kode_iklankoran'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'kode_iklankoran'  => 'required|unique:iklankoran,kode_iklankoran',
            'jenis_iklankoran' => 'required|string|max:255',
        ]);

        IklanKoran::create([
            'kode_iklankoran'  => $request->input('kode_iklankoran'),
            'jenis_iklankoran' => $request->input('jenis_iklankoran'),
        ]);

        return redirect()->route('iklankoran.index')
            ->with('success', 'Jenis Iklan Koran berhasil ditambahkan!');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'jenis_iklankoran' => 'required|string|max:255',
        ]);

        $iklan = IklanKoran::findOrFail($id);
        $iklan->update([
            'jenis_iklankoran' => $request->input('jenis_iklankoran'),
        ]);

        return redirect()->route('iklankoran.index')
            ->with('success', 'Jenis Iklan Koran berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $iklan = IklanKoran::findOrFail($id);

        if ($iklan->transaksikoran()->exists()) {
            return response()->json([
                'status' => 'error',
                'message' => 'Jenis iklan ini tidak dapat dihapus karena masih digunakan dalam data transaksi koran.'
            ], 422);
        }

        $iklan->delete();

        return response()->json(['status' => 'success']);
    }
}
