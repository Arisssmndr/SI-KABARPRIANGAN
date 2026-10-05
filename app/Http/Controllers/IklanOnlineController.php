<?php

namespace App\Http\Controllers;

use App\Models\IklanOnline;
use Illuminate\Http\Request;

class IklanOnlineController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $iklanonline = IklanOnline::paginate(5);
        $kode_iklanonline = IklanOnline::createCode();

        return view('page.iklanonline.index')->with([
            'iklanonline' => $iklanonline,
            'kode_iklanonline' => $kode_iklanonline,
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
            'kode_iklanonline'   => 'required|unique:iklanonline,kode_iklanonline',
            'jenis_iklanonline' => 'required',
        ]);

        // 2. Siapkan Array Data
        $data = [
            // PENTING: Panggil function createCode() dari Model di sini
            'kode_iklanonline'   => $request->input('kode_iklanonline'),
            'jenis_iklanonline'  => $request->input('jenis_iklanonline'),
        ];

        // 3. Simpan menggunakan MODEL (Bukan Controller)
        IklanOnline::create($data);

        // 4. Redirect dengan pesan sukses yang benar
        return redirect()->route('iklanonline.index')
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
            'kode_iklanonline' => $request->input('kode_iklanonline'),
            'jenis_iklanonline' => $request->input('jenis_iklanonline'),
        ];
        $datas = IklanOnline::findOrFail($id);
        $datas->update($data);
        return redirect()->route('iklanonline.index')
            ->with('success', 'Data Iklan Online Berhasil Di Update!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $data = IklanOnline::findOrFail($id);
        $data->delete();

        // Kembalikan JSON (bukan redirect)
        return response()->json(['status' => 'success']);
    }
}
