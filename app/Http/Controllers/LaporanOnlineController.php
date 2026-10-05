<?php

namespace App\Http\Controllers;

use App\Models\TransaksiOnline;
use Illuminate\Http\Request;

class LaporanOnlineController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('page.laporanonline.index');
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
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // 1. Ambil Input dari Form Filter
        $dari   = $request->input('dari');
        $sampai = $request->input('sampai');
        $status = $request->input('status'); // Tambahan Input Status

        // 2. Mulai Query Builder (Agar bisa menumpuk filter)
        $query = TransaksiOnline::query();

        // 3. Logika Filter Tanggal
        // Jika tanggal diisi dan bukan 'all'
        if ($dari && $sampai && $dari !== 'all' && $sampai !== 'all') {
            $query->whereBetween('tanggal_transaksionline', [$dari, $sampai]);
        }

        // 4. Logika Filter Status
        // Menggunakan kolom piutang untuk menentukan status
        if ($status && $status !== 'all') {
            if ($status == 'Lunas') {
                // Lunas = Piutang 0 atau negatif (kembalian)
                $query->where('piutang_transaksionline', '<=', 0);
            } elseif ($status == 'Belum Lunas') {
                // Belum Lunas = Masih ada piutang (di atas 0)
                $query->where('piutang_transaksionline', '>', 0);
            }
        }

        // 5. Eksekusi Query (Ambil Data)
        // Tambahkan with('iklanonline') agar relasi jenis iklan terbawa
        $data = $query->with('iklanonline')->get();

        // 6. Kirim ke View Cetak       uuuu
        return view('page.laporanonline.print')->with([
            'data' => $data,
            'dari' => $dari,
            'sampai' => $sampai,
            'status' => $status
        ]);
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
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
