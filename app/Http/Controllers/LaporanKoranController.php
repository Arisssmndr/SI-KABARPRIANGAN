<?php

namespace App\Http\Controllers;

use App\Models\TransaksiKoran;
use Illuminate\Http\Request;

class LaporanKoranController extends Controller
{
    /**
     * Display the report filter page.
     */
    public function index()
    {
        return view('page.laporankoran.index');
    }

    /**
     * Generate the printable report.
     */
    public function store(Request $request)
    {
        $dari   = $request->input('dari');
        $sampai = $request->input('sampai');
        $status = $request->input('status');

        $query = TransaksiKoran::with('iklankoran');

        if ($dari && $sampai && $dari !== 'all' && $sampai !== 'all') {
            $query->whereBetween('tanggal_transaksikoran', [$dari, $sampai]);
        }

        if ($status && $status !== 'all') {
            if ($status === 'Lunas') {
                $query->where('piutang_transaksikoran', '<=', 0);
            } elseif ($status === 'Belum Lunas') {
                $query->where('piutang_transaksikoran', '>', 0);
            }
        }

        $data = $query->orderBy('tanggal_transaksikoran', 'asc')->get();

        return view('page.laporankoran.print', compact('data', 'dari', 'sampai', 'status'));
    }
}
