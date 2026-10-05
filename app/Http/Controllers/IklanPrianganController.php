<?php

namespace App\Http\Controllers;

use App\Models\IklanPriangan;
use Illuminate\Http\Request;

class IklanPrianganController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $iklanpriangan = IklanPriangan::paginate(5);
        $kode_iklanpriangan = IklanPriangan::createCode();

        return view('page.iklanpriangan.index')->with([
            'iklanpriangan' => $iklanpriangan,
            'kode_iklanpriangan' => $kode_iklanpriangan,
        ]);
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
            'kode_iklanpriangan'   => 'required|unique:iklanpriangan,kode_iklanpriangan',
            'jenis_iklanpriangan' => 'required',
        ]);

        // 2. Siapkan Array Data
        $data = [
            // PENTING: Panggil function createCode() dari Model di sini
            'kode_iklanpriangan'   => $request->input('kode_iklanpriangan'),
            'jenis_iklanpriangan'  => $request->input('jenis_iklanpriangan'),
        ];

        // 3. Simpan menggunakan MODEL (Bukan Controller)
        IklanPriangan::create($data);

        // 4. Redirect dengan pesan sukses yang benar
        return redirect()->route('iklanpriangan.index')
            ->with('success', 'Data Iklan Online Berhasil Ditambahkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $data = [
            'kode_iklanpriangan' => $request->input('kode_iklanpriangan'),
            'jenis_iklanpriangan' => $request->input('jenis_iklanpriangan'),
        ];
        $datas = IklanPriangan::findOrFail($id);
        $datas->update($data);
        return redirect()->route('iklanpriangan.index')
            ->with('success', 'Data Iklan Online Berhasil Di Update!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $data = IklanPriangan::findOrFail($id);
        $data->delete();
        return back()->with('message_delete', 'Data Iklan Sudah dihapus');
    }
}
