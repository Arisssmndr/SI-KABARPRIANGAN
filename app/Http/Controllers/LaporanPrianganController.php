<?php

namespace App\Http\Controllers;

use App\Models\TransaksiPriangan;
use Illuminate\Http\Request;

class LaporanPrianganController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('page.laporanpriangan.index');
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
        $dari   = $request->input('dari');
        $sampai = $request->input('sampai');
        $status = $request->input('status'); // Tambahan Input Status

        $query = TransaksiPriangan::query();

        if ($dari && $sampai && $dari !== 'all' && $sampai !== 'all') {
            $query->whereBetween('tanggal_transaksipriangan', [$dari, $sampai]);
        }

        if ($status && $status !== 'all') {
            if ($status == 'Lunas') {
                $query->where('piutang_transaksipriangan', '<=', 0);
            } elseif ($status == 'Belum Lunas') {
                $query->where('piutang_transaksipriangan', '>', 0);
            }
        }

        $data = $query->with('iklanpriangan')->get();
        return view('page.laporanpriangan.print')->with([
            'data' => $data,
            'dari' => $dari,
            'sampai' => $sampai,
            'status' => $status
        ]);







        // $dari = request('dari', 'all');
        // $sampai = request('sampai', 'all');

        // $dari = ($dari === 'all') ? null : $dari;
        // $sampai = ($sampai === 'all') ? null : $sampai;

        // if ($dari === null) {
        //     $data = TransaksiPriangan::all();
        // } else {
        //     $data = TransaksiPriangan::whereBetween('tanggal_transaksipriangan', [$dari, $sampai])->get();
        // }

        // return view('page.laporanpriangan.print')->with(['data' => $data]);
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
